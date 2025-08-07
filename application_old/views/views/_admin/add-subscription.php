<?php include('header.php'); ?>
<style type="text/css">
    .error {
        font-weight: bold;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Subscription Master
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Add Subscription <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="subscription_name"
                                        id="subscription_name" value="<?php if (!empty($single)) {
                                            echo $single->subscription_name;
                                        } ?>" placeholder="Enter subscription name">
                                    <div class="error" id="subscription_name_error"></div>
                                    <input autocomplete="off" type="hidden" class="form-control input-box" name="id" id="id" value="<?php if (!empty($single)) {
                                        echo $single->id;
                                    } ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Pincode <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="pincode" id="pincode" value="<?php if (!empty($single)) {echo $single->pincode; } ?>" placeholder="Enter pincode">
                                    <div class="error" id="subscription_name_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="">Select Category <b class="require">*</b></label>
                                    <select class="form-select form-control input-content-option chosen-select" name="category" id="category">
                                        <option value="">Select</option>
                                        <option value="Male" <?php if (!empty($single) && $single->category == 'Male') echo 'selected="selected"'; ?>>Male</option>
                                        <option value="Female" <?php if (!empty($single) && $single->category == 'Female') echo 'selected="selected"'; ?>>Female</option>
                                        <option value="Unisex" <?php if (!empty($single) && $single->category == 'Unisex') echo 'selected="selected"'; ?>>Unisex</option>
                                    </select>

                                    <label style="margin-left: 0px; display: none;" id="category-error"
                                        class="error col-md-12" for="category"></label>
                                </div>

                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>No. of Stylist <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="stylist" id="stylist" value="<?php if (!empty($single)) {
                                        echo $single->stylist;
                                    } ?>" placeholder="Enter no of stylist">
                                    <div class="error" id="subscription_name_error"></div>
                                </div>


                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Total Amount <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="amount" id="amount" value="<?php if (!empty($single)) {
                                        echo $single->amount;
                                    } ?>" placeholder="Enter amount">
                                    <div class="error" id="subscription_name_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>No. of Installments <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="installment" id="installment" value="<?php if (!empty($single)) {
                                        echo $single->installment;
                                    } ?>" placeholder="Enter no of installments">
                                    <div class="error" id="subscription_name_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Percent of Amount <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="percent_amount" id="percent_amount"
                                        value="<?php if (!empty($single)) {
                                            echo $single->percent_amount;
                                        } ?>" placeholder="Enter percent amount">
                                    <div class="error" id="subscription_name_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Duration <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="duration" id="duration" value="<?php if (!empty($single)) {
                                        echo $single->duration;
                                    } ?>" placeholder="Enter duration">
                                    <div class="error" id="subscription_name_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <button style="margin-top: 20px;" type="submit" id="submit"
                                        class="btn btn-success">Submit</button>
                                </div>
                        </form> <!------------end of form---->
                    </div> <!----------end of container-------->

                </div>
            </div>

        </div>




    </div>

</div>
</div>
<?php include('footer.php');
$id = '0';
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
    $(document).ready(function () {
        jQuery.validator.addMethod("validate_email", function (value, element) {
            if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid Email.");
        jQuery.validator.addMethod("noHTMLtags", function (value, element) {
            if (this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)) {
                if (value == "") {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }, "HTML tags are Not allowed.");
        $('#master_form').validate({
            rules: {
                subscription_name: 'required',
                pincode: 'required',
                category: 'required',
                stylist: 'required',
                amount: 'required',
                installment: 'required',
                percent_amount: 'required',
                duration: 'required',

            },
            messages: {
                subscription_name: "Please enter subscription name!",
                pincode: "Please enter pincode!",
                category: "Please enter category!",
                stylist: "Please enter stylist!",
                amount: "Please enter amount!",
                installment: "Please enter installment!",
                percent_amount: "Please enter percent amount!",
                duration: "Please enter duration!",
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
    $("#subscription_name").keyup(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_unique_subscription_name",
            data: { 'subscription_name': $("#subscription_name").val(), 'id': '<?= $id ?>' },
            success: function (data) {
                console.log(data);
                if (data == "0") {
                    $("#subscription_name_error").html('');
                    $("#submit").show();
                } else {
                    $("#subscription_name_error").html('This subscription is already added');
                    $("#submit").hide();
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });	 
</script>
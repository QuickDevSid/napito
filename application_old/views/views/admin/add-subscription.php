<?php include('header.php'); ?>
<style type="text/css">
    .error {
        font-weight: bold;
    }
    .page-title .title_left h3 {
        margin: 10px 0px;}

    .checkbox-container {
        max-height: 300px;
        /* Adjust the height as needed */
        overflow-y: auto;
        /* Make the container scrollable */
        border: 1px solid #ddd;
        /* Optional: add a border */
        padding: 10px;
        /* Optional: add padding */
    }

    .checkbox-container label {
        display: block;
        /* Ensures each checkbox is on a new line */
        margin-bottom: 5px;
        /* Adds space between checkboxes */
    }

  
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Subscription
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="master_form" id="master_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Subscription Name <b class="require">*</b></label>
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
                                <!-- <div class="col-md-3 col-sm-3 col-xs-3">
                                    <div class="form-group">
                                        <label class="">Select Category <b class="require">*</b></label>
                                        <select class="form-select form-control input-content-option chosen-select" name="category" id="category">
                                            <option value="">Select</option>
                                            <option value="0" <?php if (!empty($single) && $single->category == '0') echo 'selected="selected"'; ?>>Male</option>
                                            <option value="1" <?php if (!empty($single) && $single->category == '1') echo 'selected="selected"'; ?>>Female</option>
                                            <option value="2" <?php if (!empty($single) && $single->category == '2') echo 'selected="selected"'; ?>>Unisex</option>
                                        </select>
                                        <label style="margin-left: 0px; display: none;" id="category-error"
                                            class="error col-md-12" for="category"></label>
                                    </div>
                                </div> -->
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Total Amount <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control" name="amount" id="amount" value="<?php if (!empty($single)) {
                                                                                                                                        echo $single->amount;
                                                                                                                                    } ?>" placeholder="Enter amount">
                                        <div class="error" id="subscription_name_error"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Validity <b class="require">*</b> <small>(In Days)</small></label>
                                        <input autocomplete="off" type="text" class="form-control" name="validity" id="validity" value="<?php if (!empty($single)) {
                                                                                                                                            echo $single->duration;
                                                                                                                                        } ?>" placeholder="Enter Validity">
                                        <div class="error" id="subscription_name_error"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="position:relative">
                                    <div class="service_name_validation">
                                        <label>Select Features <b class="require">*</b></label>
                                    </div>
                                    <div class="service_name_validation text-right" style="position: absolute;right: 16px;top: 3px;font-size: 12px;">
                                        <label>Check All</label>
                                        <input type="checkbox" class="" name="all_features" id="all_features">
                                    </div>
                                    <div  class="">
                                        <input type="text" class="form-control" id="search_features" placeholder="Search Features">
                                    </div>
                                    <div class="checkbox-container">
                                        <div id="feature-list">
                                            <?php
                                            if (!empty($feature_list)) {
                                                $service_exp = [];
                                                if (!empty($single)) {
                                                    $service_exp = explode(",", $single->features);
                                                }
                                                $required_features = ['3', '28', '25', '22', '26'];
                                                foreach ($feature_list as $service_name) {
                                            ?>
                                                    <label class="service-name">
                                                        <input type="checkbox" class="services-checkbox" name="feature[]" id="feature_<?= $service_name->id ?>" <?php if (in_array($service_name->id, $required_features)) {
                                                                                                                                                                    echo 'checked disabled';
                                                                                                                                                                } elseif (in_array($service_name->id, $service_exp)) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?> value="<?= $service_name->id ?>">
                                                        <?= $service_name->feature; ?>
                                                    </label>
                                                <?php }
                                            } else { ?>
                                                <label class="service-name">
                                                    Features not available
                                                </label>
                                            <?php } ?>
                                        </div>
                                        <div class="no-data-message error" id="no_data_message" style="display: none;">No data found</div>
                                    </div>
                                    <div class="error" id="service_name_error"></div>
                                </div>
                            
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <button style="margin-top: 25px;" type="submit" id="submit"
                                        class="btn btn-success">Submit</button>
                                </div>
                                </div>
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
    $(document).ready(function() {
        function updateCheckAll() {
            var allChecked = $('.services-checkbox').length === $('.services-checkbox:checked').length;
            $('#all_features').prop('checked', allChecked);
        }

      // Check or uncheck all checkboxes when the "Check All" checkbox is clicked
      $('#all_features').change(function() {
        var isChecked = $(this).is(':checked');
        $('.services-checkbox').prop('checked', isChecked);
      });

      // Update the "Check All" checkbox state when individual checkboxes change
      $('.services-checkbox').change(function() {
        updateCheckAll();
      });

      // Initialize the "Check All" checkbox state on page load
      updateCheckAll();

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
        $.validator.addMethod("noCommas", function(value, element) {
            return this.optional(element) || /^\d+$/.test(value); // Only digits allowed
        }, "Please enter a valid amount without commas.");
        $('#master_form').validate({
            ignore:[],
            rules: {
                subscription_name: 'required',
                category: 'required',
                amount: {
                    required: true,
                    noCommas: true,
                    number: true,
                    min: 1
                },
                installment: 'required',
                percent_amount: 'required',
                duration: 'required',
                validity: {
                    required: true,
                    number: true,
                    min: 1,
                },
                'feature[]': 'required'
            },
            messages: {
                subscription_name: "Please enter subscription name!", 
                category: "Please enter category!",
                amount: {
                    required: "Please enter amount!",
                    noCommas: "Please enter numbers only!",
                    number: "Please enter numbers only!",
                    min: "Minimum value 1 allowed!"
                },
                installment: "Please enter installment!",
                percent_amount: "Please enter percent amount!",
                validity: {
                    required: "Please enter validity!",
                    number: "Please enter numbers only!",
                    min: "Minimum value 1 allowed!",
                },
                'feature[]': 'Please select atleast one feature!'
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

document.getElementById('search_features').addEventListener('keyup', function() {
    var searchTerm = this.value.toLowerCase();
    var featureLabels = document.querySelectorAll('#feature-list .service-name');
    var noDataMessage = document.getElementById('no_data_message');
    var found = false; // Flag to track if any feature matches

    featureLabels.forEach(function(label) {
      var featureName = label.textContent.toLowerCase();
      if (featureName.includes(searchTerm)) {
        label.style.display = '';
        found = true; // A match was found
      } else {
        label.style.display = 'none';
      }
    });

    // Show or hide the "No data found" message based on the found flag
    if (!found) {
      noDataMessage.style.display = 'block';
    } else {
      noDataMessage.style.display = 'none';
    }
});
</script>
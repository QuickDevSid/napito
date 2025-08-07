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

  
    input[class="dashboardToggle"] {
        position: relative;
        appearance: none;
        width: 50px;
        height: 25px;
        background: #ff000085;
        border-radius: 50px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: 0.4s;
    }



    input[class="dashboardToggle"]::after {
        position: absolute;
        content: "";
        width: 25px;
        height: 25px;
        top: 0;
        left: 0;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        transform: scale(1.1);
        transition: 0.4s;
    }

    input:checked[class="dashboardToggle"] {
        background: #1aab00b3;
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
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
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
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Total Amount <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control" name="amount" id="amount" value="<?php if (!empty($single)) {
                                                                                                                                        echo $single->amount;
                                                                                                                                    } ?>" placeholder="Enter amount">
                                        <div class="error" id="subscription_name_error"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Validity <b class="require">*</b> <small>(In Days)</small></label>
                                        <input autocomplete="off" type="text" class="form-control" name="validity" id="validity" value="<?php if (!empty($single)) {
                                                                                                                                            echo $single->duration;
                                                                                                                                        } ?>" placeholder="Enter Validity">
                                        <div class="error" id="subscription_name_error"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group">
                                    <label for="fullname">Include Whatsapp Notifications?</label><br>
                                    <input style="height: 25px !important;" <?php if (!empty($single) && $single->include_wp == '1'){ echo 'checked'; } ?> type="checkbox" name="include_wp" id="include_wp" class="dashboardToggle">
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
                                                    if($service_name->id != "51"){
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
                                            }} else { ?>
                                                <label class="service-name">
                                                    Features not available
                                                </label>
                                            <?php } ?>
                                        </div>
                                        <div class="no-data-message error" id="no_data_message" style="display: none;">No data found</div>
                                    </div>
                                    <div class="error" id="service_name_error"></div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 wp_div" style="display:none;position:relative">
                                        <div class="service_name_validation">
                                            <label>Select Whatsapp Features <b class="require">*</b></label>
                                        </div>
                                        <div class="service_name_validation text-right" style="position: absolute;right: 16px;top: 3px;font-size: 12px;">
                                            <label>Check All</label>
                                            <input type="checkbox" class="" name="all_wp_features" id="all_wp_features">
                                        </div>
                                        <div  class="">
                                            <input type="text" class="form-control" id="search_wp_features" placeholder="Search Whatsapp Features">
                                        </div>
                                        <div class="checkbox-container">
                                            <div id="wp-feature-list">
                                                <?php
                                                if (!empty($wp_feature_list)) {
                                                    $service_exp = [];
                                                    if (!empty($single)) {
                                                        $service_exp = explode(",", $single->whatsapp_notification_features);
                                                    }
                                                    foreach ($wp_feature_list as $service_name) {
                                                ?>
                                                        <label class="service-name">
                                                            <input type="checkbox" class="wp-services-checkbox" name="wp_feature[]" id="wp_feature_<?= $service_name->slug ?>" <?php if (in_array($service_name->slug, $service_exp)) {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    } ?> value="<?= $service_name->slug ?>">
                                                            <?= $service_name->description; ?>
                                                        </label>
                                                    <?php }
                                                } else { ?>
                                                    <label class="service-name">
                                                        Features not available
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="no-data-message error" id="no_data_message_wp" style="display: none;">No data found</div>
                                        </div>
                                    </div>  
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 wp_div" style="display:none;">
                                        <div class="form-group">
                                            <label>Whatsapp Coins Quantity <b class="require">*</b></label>
                                            <input autocomplete="off" type="number" class="form-control" name="wp_coins_qty" id="wp_coins_qty" value="<?php if (!empty($single)) {
                                                                                                                                            echo $single->wp_coins_qty;
                                                                                                                                        } ?>" placeholder="Enter Whatsapp Coins Quantity">
                                        </div>
                                    </div>                         
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
        toggleWpDiv();

        // On checkbox change
        $('#include_wp').change(function() {
            toggleWpDiv();
        });

        function toggleWpDiv() {
            if ($('#include_wp').is(':checked')) {
                $('.wp_div').show();
            } else {
                $('.wp_div').hide();
            }
        }

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
      
        function updateWPCheckAll() {
            var allChecked = $('.wp-services-checkbox').length === $('.wp-services-checkbox:checked').length;
            $('#all_wp_features').prop('checked', allChecked);
        }

      // Check or uncheck all checkboxes when the "Check All" checkbox is clicked
      $('#all_wp_features').change(function() {
        var isChecked = $(this).is(':checked');
        $('.wp-services-checkbox').prop('checked', isChecked);
      });

      // Update the "Check All" checkbox state when individual checkboxes change
      $('.wp-services-checkbox').change(function() {
        updateWPCheckAll();
      });

      // Initialize the "Check All" checkbox state on page load
      updateWPCheckAll();

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
                'wp_feature[]': {
                    required: function(element) {
                        return $('#include_wp').is(':checked');
                    },
                },
                subscription_name: 'required',
                amount: {
                    required: true,
                    noCommas: true,
                    number: true,
                    min: 1
                },
                validity: {
                    required: true,
                    number: true,
                    min: 1,
                },
                wp_coins_qty: {
                    required: function(element) {
                        return $('#include_wp').is(':checked');
                    },
                    number: true,
                    min: 1,
                },
                'feature[]': 'required'
            },
            messages: {
                'wp_feature[]': "Please select atleast one feature!", 
                subscription_name: "Please enter subscription name!", 
                amount: {
                    required: "Please enter amount!",
                    noCommas: "Please enter numbers only!",
                    number: "Please enter numbers only!",
                    min: "Minimum value 1 allowed!"
                },
                validity: {
                    required: "Please enter validity!",
                    number: "Please enter numbers only!",
                    min: "Minimum value 1 allowed!",
                },
                wp_coins_qty: {
                    required: "Please enter whatsapp coins quantity!",
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
            },
            submitHandler: function(form) {
                $('#submit').remove();
                form.submit();
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
document.getElementById('search_wp_features').addEventListener('keyup', function() {
    var searchTerm = this.value.toLowerCase();
    var featureLabels = document.querySelectorAll('#wp-feature-list .service-name');
    var noDataMessage = document.getElementById('no_data_message_wp');
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
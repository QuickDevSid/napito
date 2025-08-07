<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    input[type="file"] {
        height: 50px;
    }

    #viewButtonsContainer a {

        margin-left: 30px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Saloon
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
            <div class="x_panel">
                <div class="x_title">
                    <h2><b>Add Salon</b></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Salon Name <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="salon_name" id="salon_name" value="<?php if (!empty($single)) {
                                        echo $single->salon_name;
                                    } ?>" placeholder="Enter salon name">
                                    <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {
                                        echo $single->id;
                                    } ?>">
                                    <label style="display: none;" id="salon_name-error" class="error col-md-12"
                                        for="salon_name"></label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Salon Owner Name <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="salon_owner_name"
                                        id="salon_owner_name" value="<?php if (!empty($single)) {
                                            echo $single->salon_owner_name;
                                        } ?>" placeholder="Enter salon owner name">
                                    <label style="display: none;" id="salon_owner_name-error" class="error col-md-12"
                                        for="salon_owner_name"></label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Salon Owner Number <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="salon_owner_number"
                                        id="salon_owner_number" value="<?php if (!empty($single)) {
                                            echo $single->salon_owner_number;
                                        } ?>" placeholder="Enter salon owner number">
                                    <label style="display: none;" id="salon_owner_number-error" class="error col-md-12"
                                        for="salon_owner_number"></label>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Email <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="email" id="email" value="<?php if (!empty($single)) {
                                        echo $single->email;
                                    } ?>" placeholder="Enter salon email">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label >Aadhar Number</label>
                                    <input maxlength="12" autocomplete="off" type="text" class="form-control" name="aadhar_number" id="aadhar_number"
                                        value="<?php if (!empty($single)) {
                                            echo $single->aadhar_number;
                                        } ?>" placeholder="Enter salon owner aadhar number">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Upload Aadhar Front Side</label>
                                    <input autocomplete="off" type="file" accept=".png, .jpg, .jpeg, .pdf" class="form-control"
                                        name="aadhar_front" id="aadhar_front" value="<?php if (!empty($single)) {
                                            echo $single->aadhar_front;
                                        } ?>">
                                    <!-- <div id="viewButtonsContainer"></div> -->
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <div class="form-group">
                                    <label>Upload Aadhar Back Side</label>
                                    <input autocomplete="off" type="file" accept=".png, .jpg, .jpeg .pdf" class="form-control"
                                        name="aadhar_back" id="aadhar_back" value="<?php if (!empty($single)) {
                                            echo $single->aadhar_back;
                                        } ?>">
                                    <!-- <div id="viewButtonsContainer"></div> -->
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Upload Salon Photo <b class="require">*</b></label>
                                    <input autocomplete="off" type="file" accept=".png, .jpg, .jpeg .pdf" class="form-control"
                                        name="salon_photo" id="salon_photo" value="<?php if (!empty($single)) {
                                            echo $single->salon_photo;
                                        } ?>" multiple>
                                    <label style="display: none;" id="salon_photo-error" class="error col-md-12"
                                        for="salon_photo"></label>
                                    <!-- <div id="viewButtonsContainer"></div> -->
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group col-md-0 col-xs-12" style="margin-top: 20px;">
                                    <button type="submit" class="btn btn-success">Submit</button>
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
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script>
    $(document).ready(function () {
        jQuery.validator.addMethod("validate_email", function(value, element) {
                if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
                    return true;
                }else {
                    return false;
                }
            }, "Please enter a valid Email.");  
        $('#customer_form').validate({
            rules: {
                email: {
                       
                        required: true, 
                        validate_email:true,
                        noHTMLtags: true,
                    },
                salon_name: 'required',
                salon_owner_name: 'required',
                <?php if (empty($single)) {?>
                    salon_photo: 'required', 
                <?php }?>
                salon_owner_number:{
                required: true,
                minlength: 10, 
                maxlength: 10,
                number: true,
                },
            },
            messages: {
                salon_name: 'Please enter salon name!',
                salon_owner_name: 'Please enter salon owner name!',
                    salon_photo: 'Please upload salon photo!',
                salon_owner_number:{
                        required: "Please enter contact number!",
                        number: "Please enter number!",
                        minlength: "Enter valid contact number!", 
                        maxlength: "Length of contact number is too large!",
                        },
                        email: {
                        required: "Please enter email!", 
                        validate_email: "Please enter valid email!",
                        noHTMLtags: "HTML tags not allowed!",
                    },
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
        });
    });


</script>


<script>
    function generateViewButton(fileInputId) {
        var files = document.getElementById(fileInputId).files;
        var viewButtonsContainer = $('#viewButtonsContainer');

        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();
            reader.onload = (function (file) {
                return function (e) {
                    var viewButton = $('<a class="btn btn-info" target="_blank" href="' + e.target.result + '">View</a>');
                    viewButtonsContainer.append(viewButton);
                };
            })(files[i]);

            reader.readAsDataURL(files[i]);
        }
    }

    $('#aadhar_front, #aadhar_back, #salon_photo').on('change', function () {
        generateViewButton(this.id);
    });
</script>
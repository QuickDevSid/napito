<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Napito - Admin Panel| Login</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="<?= base_url() ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>admin_assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?= base_url() ?>admin_assets/css/custom.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/icheck/flat/green.css" rel="stylesheet">


    <script src="<?= base_url() ?>admin_assets/js/jquery.min.js"></script>

    <script type="text/javascript" src="<?= base_url() ?>admin_assets/js/jquery.validate.min.js"></script>
    <!------this script is use for validation for login ------->
    <style>
        .error {
            color: red;
        }

        .login_content {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 15px;
            border-radius: 10px;
        }
    </style>



</head>

<body style="background: lightblue;">

    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form" style="background:#F7F7F7;">
                <section class="login_content">
                    <form method="post" name="login_form" id="login_form">
                        <!-- <h1>Admin Login</h1> -->
                        <div style="padding: 10px;">
                            <img style="width: 80%;height: 75px;" src="<?=base_url();?>assets/images/napito_logo.jpg">
                        </div>
                        <div>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Username" />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password" />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-info submit">Log in</button>
                            <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <!--
                            <p class="change_link">New to site?
                                <a href="#toregister" class="to_register"> Create Account </a>
                            </p>
                            -->
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa-solid fa-scissors" style="font-size: 26px;"></i> Salon !</h1>

                                <p>©2015 All Rights Reserved. Salon. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>

        </div>
    </div>


    <?php if ($this->session->flashdata('success') != "") { ?>
    <div class="login_hide_show" style="position: fixed; bottom: 20px; right: 20px;">
        <div class="alert alert-success animated fadeInUp" style="color: #297401;">
            <strong style="color: #297401;">Success!</strong> <?= $this->session->flashdata('success') ?>
        </div>
    </div>
<?php } else if ($this->session->flashdata('message') != "") { ?>
    <div class="login_hide_show" style="position: fixed; bottom: 20px; right: 20px;">
        <div class="alert alert-danger animated fadeInUp">
            <strong>Error!</strong> <?= $this->session->flashdata('message') ?>
        </div>
    </div>
<?php } elseif (validation_errors() != '') { ?>
    <div class="login_hide_show" style="position: fixed; bottom: 20px; right: 20px;">
        <div class="alert alert-danger animated fadeInUp">
            <strong>Error!</strong>
            <?= validation_errors() ?>
        </div>
    </div>
<?php } ?>

    <!-- this code which is used for message with color and fadein fadeout -->


</body>

</html>





<script>
    $(".alert").fadeTo(5000, 500).slideUp(500, function () {
        $(".alert").slideUp(500);
    }); 
</script>
<script>



    //validation code


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
        $('#login_form').validate({
            rules: {
                email: {
                    required: true,
                    validate_email: true,
                    noHTMLtags: true,
                },
                password: {
                    required: true,
                    noHTMLtags: true,
                },
            },
            messages: {
                email: {
                    required: "Please enter email",
                    validate_email: "Please enter valid email",
                    noHTMLtags: "HTML tags not allowed!",
                },
                password: {
                    required: "Please enter password",
                    noHTMLtags: "HTML tags not allowed!",
                },
            },

        });
    });

</script>
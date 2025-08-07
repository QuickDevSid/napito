<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Napito Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="<?= base_url() ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>admin_assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?= base_url() ?>salon_assets/css/custom-front.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/icheck/flat/green.css" rel="stylesheet">


    <script src="<?= base_url() ?>admin_assets/js/jquery.min.js"></script>

    <script type="text/javascript" src="<?= base_url() ?>admin_assets/js/jquery.validate.min.js"></script> <!------this script is use for validation for login ------->
    <style>
        .error {
            color: red;
        }

        .real {
            position: relative;
        }

        .real input {
            padding-left: 25px;
        }

        .login_content {
            box-shadow: 0 4px 8px 0 rgb(255 241 214 / 37%), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 15px;
            border-radius: 10px;
        }

        .icon {


            position: absolute;
            left: 8px;
            top: 9px;
            font-size: 18px;
            color: #c75bb3;

        }

        label#email-error,
        label#password-error {
            position: relative;

            top: -15px;

        }

        body {
            height: 100vh;
            width: 100%;
        }


        .submit_button {
            background: linear-gradient(271deg, #800080, #ff69b4);
        }

        .container_log {
            height: 100%;
        }

        #login {

            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .login_content{
            max-width: 350px;
        }
        

        .login_hide_show {
            position: fixed;
            top: 50px;
            right: 20px;
            transform: translateX(-15%);
            height: 50px;
            width: auto;
            display: flex;

            background-color: transparent;
        }
    </style>



</head>

<body class="background_GB">

    <div class="container_log">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>


        <div id="login" class="animate form">
            <section class="login_content">
                <form method="post" name="login_form" id="login_form">
                    <!-- <h1><i class="fa-solid fa-scissors" style="font-size: 26px;"></i> Salon !</h1> -->
                    <div style="padding: 16px;">
                        <img style="    width: 35%;
    border-radius: 50%;" src="<?= base_url(); ?>assets/images/napito_logo.jpg">
                    </div>
                    <div class="real">
                        <label class="icon" for="email"><i class="fa fa-envelope"></i></label>

                        <input autocomplete="off" type="text" class="form-control" name="email" id="email" placeholder="Username" />
                    </div>
                    <div class="real">
                        <label class="icon" for="password"><i class="fa fa-lock"></i> </label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                    </div>
                    <div>
                        <button class="submit_button" style="text-transform:uppercase;box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 3px 10px 0 rgba(0, 0, 0, 0.10);" type="submit" class="btn btn-light submit">Log In</button>
                        <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
                    </div>
                    <div class="clearfix"></div>
                    <div class="">
                        <!--
                            <p class="change_link">New to site?
                                <a href="#toregister" class="to_register"> Create Account </a>
                            </p>
							-->
                        <!-- <div class="clearfix"></div> -->
                        <br />
                        <div>


                            <p style="text-transform:uppercase;color:#434343;">©2024 SCHEDULE SAVVY SOLUTION PRIVATE LIMITED | All Rights Reserved</p>
                        </div>
                    </div>
                </form>
                <!-- form -->
            </section>
            <!-- content -->
        </div>

    </div>



<?php if ($this->session->flashdata('success') != "") { ?>
    <div class="login_hide_show alert alert-success animated fadeInUp" style="color:#297401;">
        <strong style="color:#297401;"></strong> <?= $this->session->flashdata('success') ?>
    </div>
<?php } else if ($this->session->flashdata('message') != "") { ?>
    <div class="login_hide_show alert alert-danger animated fadeInUp" style="background-color: red;">
        <strong></strong> <?= $this->session->flashdata('message') ?>
    </div>
<?php } elseif (validation_errors() != '') { ?>
    <div class="login_hide_show alert alert-danger animated fadeInUp" style="background-color: red;">
        <strong></strong> <?= validation_errors() ?>
    </div>
<?php } ?>



</body>

</html>






<script>
    $(".alert").fadeTo(5000, 500).slideUp(500, function() {
        $(".alert").slideUp(500);
    });



    //validation code


    $(document).ready(function() {
        jQuery.validator.addMethod("validate_email", function(value, element) {
            if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid Email.");
        jQuery.validator.addMethod("noHTMLtags", function(value, element) {
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

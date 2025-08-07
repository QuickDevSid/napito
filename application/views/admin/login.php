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

        button {
            width: 100%;
            background: linear-gradient(271deg, #800080, #ff69b4) !important;
            margin-top: 15px;
            border-color: white !important;
        }

        .login_content {
            box-shadow:0 4px 8px 0 rgb(255 241 214 / 37%), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 15px;
            border-radius: 10px;
        }

        .login_content form input[type="text"],
        .login_content form input[type="email"],
        .login_content form input[type="password"] {
            border: none;
            background: white;
            box-shadow: none;
            border-radius: 0;
            border-bottom: 1px solid black;
            padding-left: 37px;
            margin-bottom: 0;
            /* font-weight: 600; */
            font-family: sans-serif;

        }

        .login_content form input[type="text"]:focus,
        .login_content form input[type="email"]:focus,
        .login_content form input[type="password"]:focus {
            border: none;
            border-bottom: 1px solid black;
        }

        .log {
            position: relative;
        }

        .log i {
            position: absolute;
            top: 31px;
            left: 10px;
            font-size: 20px;
            color: #c75bb3;
        }

        label#email-error,
        label#password-error {
            position: relative;
            /* left: -83px; */
            top: 5px;

        }

        h1 {
            position: absolute;
            top: -42px;
            left: 32%;
        }
    </style>



</head>

<body style="background: white;">

    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form" style="background:white;">
                <section class="login_content">
                    <form method="post" name="login_form" id="login_form">
                        <!-- <h1>Admin Login</h1> -->
                        <div style="padding: 10px;margin-top:35px">
                            <img style="    width: 35%;
    
    border-radius: 50%" src="<?= base_url(); ?>assets/images/napito_logo.jpg">
                        </div>
                        <div class="log">
                            <label for="email"><i class="fa fa-envelope"></i></label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Username" />
                        </div>
                        <div class="log">
                            <label for="password"><i class="fa fa-lock"></i></label>
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
                                <h1><i class="fa-solid fa-scissors" style="font-size: 26px;color:#434343"></i> Salon !</h1>

                                <p>©2024 SCHEDULE SAVVY SOLUTION PRIVATE LIMITED | ALL RIGHTS RESERVED</p>
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
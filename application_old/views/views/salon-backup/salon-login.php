<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Salon Login</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="<?=base_url()?>admin_assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?=base_url()?>admin_assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=base_url()?>admin_assets/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?= base_url() ?>salon_assets/css/custom-front.css" rel="stylesheet">
    <link href="<?=base_url()?>admin_assets/css/icheck/flat/green.css" rel="stylesheet">


    <script src="<?=base_url()?>admin_assets/js/jquery.min.js"></script>

    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/jquery.validate.min.js"></script>  <!------this script is use for validation for login ------->
    <style>
        .error{
            color:red;
        }
      
    </style>

   

</head>

<body class="background_GB">
    
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <form method="post" name="login_form" id="login_form">
                         <h1><i class="fa-solid fa-scissors" style="font-size: 26px;"></i> Salon !</h1>
                        <div>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Username" />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                        </div>
                        <div>
                            <button class="submit_button" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 3px 10px 0 rgba(0, 0, 0, 0.10);" type="submit" class="btn btn-light submit" >Log in</button>
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
                               

                                <p>©2023 SCHEDULE SAVVY SOLUTION PRIVATE LIMITED | All Rights Reserved</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <div id="register" class="animateform">
                <section class="login_content">
                    <form>
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <a class="btn btn-default submit" href="index.html">Submit</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                           <!-- <p class="change_link">Already a member ?
                                <a href="#tologin" class="to_register"> Log in </a>
                            </p>-->
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Bumpload!</h1>

                                <p>©2015 All Rights Reserved. Bumpload. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>



<?php if($this->session->flashdata('success') !=""){?>
        <div class="alert alert-success animated fadeInUp">
            <strong>Success!</strong> <?=$this->session->flashdata('success')?>
        </div>
    <?php }else if($this->session->flashdata('message') !=""){?>
        <div class="alert alert-danger animated fadeInUp">
            <strong>Error!</strong> <?=$this->session->flashdata('message')?>
        </div>
    <?php }elseif(validation_errors()!=''){?>
        <div class="alert alert-danger animated fadeInUp">
            <strong>Error!</strong> <?=validation_errors()?>
        </div>
    <?php }?>
    <!-- this code which is used for message with color and fadein fadeout -->


</body>

</html>






<script>
    $(".alert").fadeTo(5000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });   //after login message display and after 5 sec it will disappear



//validation code


                    $(document).ready(function () {     
            jQuery.validator.addMethod("validate_email", function(value, element) {
                if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
                    return true;
                }else {
                    return false;
                }
            }, "Please enter a valid Email.");  
            jQuery.validator.addMethod("noHTMLtags", function(value, element){
                if(this.optional(element) || /<\/?[^>]+(>|$)/g.test(value)){
                    if(value == ""){
                        return true;
                    }else{
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
                        validate_email:true,
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






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
                            <input autocomplete="off" type="date" class="form-control" name="date" id="date" placeholder="date" />
                        </div>
                        <div>
                            <input autocomplete="off" type="time" class="form-control" name="time" id="time" placeholder="time" />
                        </div>
                        <div>
                            <input type="text" class="form-control" name="stylist" id="stylist" placeholder="stylist" value="13"/>
                        </div>
                        <div>
                            <input type="text" class="form-control" name="service" id="service" placeholder="service" value="12"/>
                        </div>
                        <div>
                            <button class="submit_button" id="submit_button" name="submit_button" value="submit_button" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 3px 10px 0 rgba(0, 0, 0, 0.10);" type="submit" class="btn btn-light submit">Log in</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <p>©2023 salon PRIVATE LIMITED | All Rights Reserved</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <?php if ($this->session->flashdata('success') != "") { ?>
        <div class="alert alert-success animated fadeInUp">
            <strong>Success!</strong> <?= $this->session->flashdata('success') ?>
        </div>
    <?php } else if ($this->session->flashdata('message') != "") { ?>
        <div class="alert alert-danger animated fadeInUp">
            <strong>Error!</strong> <?= $this->session->flashdata('message') ?>
        </div>
    <?php } elseif (validation_errors() != '') { ?>
        <div class="alert alert-danger animated fadeInUp">
            <strong>Error!</strong> <?= validation_errors() ?>
        </div>
    <?php } ?>
</body>
</html>
<script>
    $(".alert").fadeTo(5000, 500).slideUp(500, function() {
        $(".alert").slideUp(500);
    });
    $(document).ready(function() {
        $('#login_form').validate({
            rules: {
                date: {
                    required: true,
                },
                time: {
                    required: true,
                },
                title: {
                    required: true,
                },
                stylist: {
                    required: true,
                },
            },
            messages: {
                date: {
                    required: "Please enter date",
                },
                time: {
                    required: "Please enter time",
                },
                title: {
                    required: "Please enter title",
                },
                stylist: {
                    required: "Please enter stylist",
                },
            },
            // submitHandler: function(form) {
            //     var date = $('#date').val();
            //     var time = $('#time').val();
            //     var title = $('#title').val();

            //     var ws = new WebSocket('ws://localhost:8080');

            //     ws.onopen = function() {
            //         var credentials = JSON.stringify({ time: time, title: title, date: date });
            //         ws.send(credentials);
            //     };

            //     ws.onmessage = function(event) {
            //         console.log('Server: ' + event.data);
            //     };

            //     ws.onclose = function() {
            //         console.log('Connection closed');
            //     };

            //     ws.onerror = function(error) {
            //         console.log('WebSocket Error: ' + error);
            //     };

            //     return false; // Prevent form submission
            // }
        });
    });
</script>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url() ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/fontawesome.min.css"
        integrity="sha512-siarrzI1u3pCqFG2LEzi87McrBmq6Tp7juVsdmGY1Dr8Saw+ZBAzDzrGwX3vgxX1NkioYNCFOVC0GpDPss10zQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?= base_url() ?>admin_assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/salon-style.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/jquery-ui.css'); ?>" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="<?= base_url() ?>admin_assets/css/custom.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/jquery.timesetter.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/chosen.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/chosen.min.css" rel="stylesheet">
    <link rel="<?= base_url() ?>admin_assets/stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="<?= base_url() ?>admin_assets/css/floatexamples.css" rel="stylesheet" type="text/css" />
    <script src="<?=base_url()?>admin_assets/js/jquery.min.js"></script>
  </head>
  <style>
    .img-preview {
      height: 200px; 
      width: 200px; 
      margin: auto;
    }
    div.row.applicant {
      display: flex;
      align-items: center;
    }
  </style>
  <div class="container body">
    <div class="main_container">
      <div class="">
        <div class="clearfix"></div>
        <div class="container">
          <div class="">
            <div class="x_panel" style="width: 80%; margin-left: 150px; margin-top: 100px;">
              <div class="x_title">
                  <h2 style="width:100%;color:black;">Thank you, survey details submitted successfully ...!!
                    <a style="float:right;" class="btn btn-info" href="<?=base_url();?>survey">Restart Survey</a>
                  </h2>
                  <div class="clearfix"></div>
              </div>
              <div class="container body"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?=base_url()?>admin_assets/js/jquery-ui.js"></script>
  <script src="<?=base_url()?>admin_assets/js/bootstrap.min.js"></script>
  <!-- bootstrap progress js -->
  <script src="<?=base_url()?>admin_assets/js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="<?=base_url()?>admin_assets/js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/moment.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/datepicker/daterangepicker.js"></script>
  <script src="<?=base_url()?>admin_assets/js/custom.js"></script>
  <!-- flot js -->
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.js"></script>
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.orderBars.js"></script>
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.time.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/date.js"></script>
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.spline.js"></script>
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.stack.js"></script>
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/curvedLines.js"></script>
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.resize.js"></script>
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.jquery.js"></script>
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.jquery.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.proto.js"></script>
  <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.proto.min.js"></script>
  <script>
    $(".alert").fadeTo(5000, 500).slideUp(500, function(){
      $(".alert").slideUp(500);
    });
  </script>
</html>
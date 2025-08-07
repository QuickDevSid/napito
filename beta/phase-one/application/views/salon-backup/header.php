<?php
$profile = $this->Salon_model->get_user_profile();
?>
<!--------which is used for session variable ie name show in dashboard or other files heading an d this get_user_profile called in admin_model.php file-------->




<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .login_hide_show {
            position: fixed;
            bottom: 0;
            right: 20px;
        }

        .nav-icon {
            font-size: 18px;
        }

        .nav-title {
            margin-left: 15px;
            margin-top: 5px;
            font-size: 12px;
        }

        .down-icon {
            margin-top: 5px;
        }
    </style>
<!-- for salary and attendece  -->





    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> <?php echo $this->session->userdata('branch_name'); ?> | Salon </title>
    <link rel="icon" type="image/x-icon">

    <!-- Bootstrap core CSS -->

    <link href="<?= base_url() ?>salon_assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= base_url() ?>salon_assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>salon_assets/css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/salon-style.css" rel="stylesheet">
    <link href="<?=base_url('assets/css/jquery-ui.css');?>" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?= base_url() ?>salon_assets/css/custom-front.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/chosen.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/chosen.min.css" rel="stylesheet">
    <link rel="<?= base_url() ?>salon_assets/stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="<?= base_url() ?>salon_assets/css/icheck/flat/green.css" rel="stylesheet" />
    <link href="<?= base_url() ?>salon_assets/css/floatexamples.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>salon_assets/css/icheck/flat/green.css" rel="stylesheet">
    <link href="<?= base_url() ?>salon_assets/css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
    <link href="<?= base_url() ?>salon_assets/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
    <script src="<?= base_url() ?>salon_assets/js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>salon_assets/css/datatables.min.css" />
    <script type="text/javascript" src="<?= base_url() ?>salon_assets/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>salon_assets/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>salon_assets/js/datatables.min.js"></script>
    <style>
        .error {
            color: red;
        }
    </style>


</head>


<body class="nav-md">
<div class="loader_Box">
<span class="loader"></span>
<div class="loaders">Time to Shine, Time to Dazzle</div>

</div>
    <div class="container body">


        <div class="main_container">

            <div class="left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
						<div class="col-lg-6 col-md-6 col-xs-6">
							 <a href="<?= base_url(); ?>" class="site_title"><i class="fa-solid fa-scissors"></i> <span>
                                <?php echo $this->session->userdata('branch_name'); ?>
                            </span></a>
						</div>
                       <div class="col-lg-6 col-md-6 col-xs-6 ">
							<ul class="port_a">
								<li class="bell_open"> <i class="fa fa-bell-o" aria-hidden="true"></i><span class="notfication_c">10</span> 
									<div class="bell_open_cc">
									<h3>Notification <a href="#" class="number">10</a></h3>
										<ul class="bell_open_cc_s">
											<li><a href="#"><div class="notification_bell"> <i class="fa fa-bell-o" aria-hidden="true"></i></div><div class="infor_para">Font Awesome licensed under SIL OFL 1.1 · Code licensed under MIT License · Documentation licensed under CC BY 3.0</div></a></li>
											<li><a href="#"><div class="notification_bell"> <i class="fa fa-bell-o" aria-hidden="true"></i></div><div class="infor_para">Font Awesome licensed under SIL OFL 1.1 · Code licensed under MIT License · Documentation licensed under CC BY 3.0</div></a></li>
											<li><a href="#"><div class="notification_bell"> <i class="fa fa-bell-o" aria-hidden="true"></i></div><div class="infor_para">Font Awesome licensed under SIL OFL 1.1 · Code licensed under MIT License · Documentation licensed under CC BY 3.0</div></a></li>
											<li><a href="#"><div class="notification_bell"> <i class="fa fa-bell-o" aria-hidden="true"></i></div><div class="infor_para">Font Awesome licensed under SIL OFL 1.1 · Code licensed under MIT License · Documentation licensed under CC BY 3.0</div></a></li>
											<li><a href="#"><div class="notification_bell"> <i class="fa fa-bell-o" aria-hidden="true"></i></div><div class="infor_para">Font Awesome licensed under SIL OFL 1.1 · Code licensed under MIT License · Documentation licensed under CC BY 3.0</div></a></li>
											<li><a href="#"><div class="notification_bell"> <i class="fa fa-bell-o" aria-hidden="true"></i></div><div class="infor_para">Font Awesome licensed under SIL OFL 1.1 · Code licensed under MIT License · Documentation licensed under CC BY 3.0</div></a></li>
										</ul>
									</div>
								</li>
								<li class="logout_box"> <button class="logout_area"><a href="<?= base_url(); ?>do-logout"><b><i class="fa-solid fa-right-from-bracket"></i></b></a></button></li>
								
							</ul>
							
                           
						</div>
						
                    </div>
                    <div class="clearfix"></div>


                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">

                            <ul class="nav side-menu">
                                <li><a href="<?= base_url(); ?>salon-dashboard"><i class="fa fa-home"></i><b>Dashboard</b></a>
                                </li>
                                <li>
									<a><i class="fa-brands fa-product-hunt nav-icon"></i><b class="nav-title">Product
                                            Management</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url(); ?>product-master">Add Product category</a></li>
                                      
										<li><a href="<?= base_url(); ?>add-package">Add Package</a></li>
                                        <li><a href="<?= base_url(); ?>package-list">Package List</a></li>
                                    </ul>

                                </li>
                              
                                <li><a><i class="fa-brands fa-servicestack nav-icon"></i><b class="nav-title">Service
                                            Management</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url(); ?>add-salon-service">Add Service</a></li>
                                        <li><a href="<?= base_url(); ?>add-special-service">Add Special Service</a></li>
										  <li><a href="<?= base_url(); ?>add-product">Add Product</a></li>
                                        <li><a href="<?= base_url(); ?>product-list">Product List</a></li>
											<li><a href="<?= base_url(); ?>add-offers">Add Offer</a></li>
										  <li><a href="<?= base_url(); ?>offers-list">Offers List</a></li>
										  <li><a href="<?= base_url(); ?>add-coupon-code">Add Coupon Code</a></li>
										  <li><a href="<?= base_url(); ?>add-reward-point">Add Reward Points</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa-solid fa-users nav-icon"></i><b class="nav-title">Employee
                                            Managment</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
										<li><a href="<?= base_url(); ?>add-shift">Manage Employee Shift </a></li>
                                        <li><a href="<?= base_url(); ?>add-designation">Manage Employee Designation</a></li>
                                        <li><a href="<?= base_url(); ?>add-salon-employee">Add Employee</a></li>
										<li><a href="<?= base_url(); ?>add-facilities">Add Facilities</a></li>
                                        <li><a href="<?= base_url(); ?>salon-employee-list">Employee List</a></li>
                                        <li><a href="<?= base_url(); ?>generate_salary_slip">Add Salary</a></li>
                                        <li><a target="_blank" href="<?= base_url(); ?>add_staff_attendance">Add Attendance</a></li>
                                    </ul>

                                </li>
                                
                                <li>
                                    <ul class="nav child_menu" style="display: none">
                                        <li></li>
                                    </ul>

                                </li>
                                <li><a><i class="fa-solid fa-graduation-cap nav-icon"></i><b class="nav-title">Course
                                            Master</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url(); ?>add-course">Add Course</a></li>
                                        <li><a href="<?= base_url(); ?>course-list">Course List</a></li>
										   <li><a href="<?= base_url(); ?>add-student">Add Student</a></li>
                                        <li><a href="<?= base_url(); ?>student-list">Student List</a></li>
                                        <li><a href="<?= base_url(); ?>payment-entry">Make Payment</a></li>
                                    </ul>

                                </li>
                             
                              
                                <li><a><i class="fa-solid fa-podcast nav-icon"></i><b class="nav-title">Expense Management</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                    <li><a href="<?= base_url(); ?>add-salon-expense">Add Expense</a></li>
                                    </ul>

                                </li>
                            </ul>
                        </div>


                    </div>
                    <!-- /sidebar menu -->


                    
                </div>
            </div>

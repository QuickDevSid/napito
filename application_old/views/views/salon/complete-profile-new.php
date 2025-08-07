<?php include('header.php'); ?>

<style>
    button#backButton {
        display: none !important;
    }

    .slides-container {
        width: 70%;
        margin: 0 auto;
        position: relative;
    }

    .right_col {
        margin-left: 240px;
        min-height: auto;
        display: flex;
        align-items: center;
    }

    .slide {
        display: flex !important;
        height: 450px;
        border: 1px solid #eee;
        box-shadow: 0px 0px 15px 1px rgba(235, 235, 235, 1);
    }

    .slide__inner {
        width: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    a#skip_button:hover {
        color: var(--hover);
        background: #000000;
        border-color: var(--hover);
        transition: 0.5s ease;
    }

    .slide--left {
        background: #deebfe;
    }

    .slick-slide img {
        width: 100%;
    }

    body .container.body .right_col {
        background-color: transparent;
    }

    .slick-arrow {
        height: auto;
        align-self: center;
        font-size: 30px;
        background: white;

    }


    .slide--right {
        background: #fff;
        padding: 3%;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    p {
        font-size: 14px;
        color: #666;
        line-height: 1.8;
    }

    .card {
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin: 10px 0;
        padding: 10px;
        display: flex;
        align-items: center;
    }

    .intro-container {
        /* height: 100%; */
        margin-top: 30px;

    }

    /* .slides-container {
        display: flex;

    } */




    .loading-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: rgba(255, 255, 255, 0.9);
        /* Light transparent background */
        z-index: 9999;
        /* Ensure the loader is on top */
        animation: fadeOut 10s forwards; 
    }
    @keyframes fadeOut {
        0% {
            opacity: 1;
            visibility: visible;
        }
        83.33% { /* Visible for ~5 seconds */
            opacity: 1;
        }
        100% {
            opacity: 0;
            visibility: hidden; /* Ensures the element is no longer interactive */
        }
    }

    /* Styling the loading gif */
    .loading-gif {
        width: 60px;
        height: 60px;
        transform: rotate(90deg);
    }
    .check-gif {
        width: 60px;
        height: 60px;
        display: none;
     
    }

    /* Styling the text */
    .loading-text {
        margin-top: 20px;
        font-size: 18px;
        color: #333;
        font-weight: bold;
    }


    .slide-content {
        text-align: center;
        /* max-width: 600px; */
    }

    h2 {
        font-size: 24px;
        margin-bottom: 15px;
        color: #333;
    }

    p {
        font-size: 16px;
        color: #666;
    }

    .complete_profile_container {
        position: relative;
        width: 100%;
    }

    #skip_button {
        position: absolute;
        top: 0;
        border: 1px solid #ccc;
        width: auto;
        text-align: center;
        border-radius: 24px;
        height: 30px;
        line-height: 28px;
        text-decoration: none;
        transition: 0.5s ease;
        padding-left: 10px;
        padding-right: 10px;
    }
   

    /* HTML: <div class="loader"></div> */
    .loader {
        color: #000;
        width: 4px;
        height: 4px;
        aspect-ratio: 1;
        border-radius: 50%;
        box-shadow: 19px 0 0 7px, 38px 0 0 3px, 57px 0 0 0;
        transform: translateX(-38px);
        animation: l21 .5s infinite alternate linear;
    }

    @keyframes l21 {
        50% {
            box-shadow: 19px 0 0 3px, 38px 0 0 7px, 57px 0 0 3px
        }

        100% {
            box-shadow: 19px 0 0 0, 38px 0 0 3px, 57px 0 0 7px
        }
    }

    .slides-anime {
    
        animation: animeSlider 5s linear;
    }


    @keyframes animeSlider {
        0% {
         
            opacity: 0;
        }

        100% {
         
            opacity: 1;
        }
    }

    .loader-spin {
       
        
        width: 48px;
        height: 48px;
        display: inline-block;
        position: relative;
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        margin: 0px auto;
        text-align: center;
        top: 50%;
       
    }

    .slide-content h2 {
        font-size: 18px;
        margin-top: 0px;
        padding-top: 25px;
        margin-bottom: 4px;
        font-weight: 600;

    }

    .loader-spin::after,
    .loader-spin::before {
        content: '';
        box-sizing: border-box;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 2px solid #817777;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0.2;
        animation: animloaderspin 2s linear infinite;


    }

  

    .loader-spin::after {
        animation-delay: 1s;
    }

    @keyframes animloaderspin {
        0% {
            transform: scale(0);
            opacity: 1;
        }

        100% {
            transform: scale(1);
            opacity: 0;
        }
    }
</style>
<?php 
$loading = isset($_GET['loader']) && $_GET['loader'] == "true" ? true : false;
if ($loading) {
?>
    <div class="loading-container">
        <img src="<?= base_url() ?>assets/images/sc.gif" alt="Loading" class="loading-gif"> 
        <img src="<?= base_url() ?>assets/images/check.gif" alt="Loading" class="check-gif"> 
        
        <p class="loading-text">We are setting up your profile</p>    
        <!-- <div class="loader"></div>     -->
    </div>
<?php
}
?>
<div class="right_col" role="main">



<div class="complete_profile_container">
    <div class="slide-content">
        <?php
            $onboarding_status_index = !empty($profile) ? $profile->onboarding_status : '';
            if ($onboarding_status_index == '18') {
        ?>

        <?php }else{ ?>
            <h2>Welcome to Napito!</h2>
            <p>We're getting your style ready—scissors in hand, beauty awaits!</p>
        <?php } ?>
    </div>
    <span class="loader-spin"></span>
                <!-- condition for onboarding completed scenario starts -->
                <?php
                $onboarding_status_index = !empty($profile) ? $profile->onboarding_status : '';
                if ($onboarding_status_index == '18') {
                ?>
                    <div class="x_panel">
                        <!-- <div class="x_title" style="text-align: center;">
                            <img src="<?= base_url(); ?>\admin_assets\images\no_data\c_store_complete.jpg">
                        </div> -->
                        <div style="text-align: center;font-size: 15px;">
                            Congratulations! Onboarding Completed Successfully. 
                            <p>
                                Thank you for becoming a part of Napito!
                                Your initial onboarding process has been successfully completed.
                                While we review your application, you can still
                                Seamlessly accept and manage Walk-in Appointments.
                            </p>
                            <a style="text-decoration:underline;color:blue;" href="<?= base_url(); ?>salon-dashboard-new">Start Now</a>
                        </div>
                    </div>
                <?php } ?>
                <!-- condition for onboarding completed scenario ends -->


    <div class="intro-container">

        <div class="row">
            

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="slides-container">
                    <!-- Slide 1 -->
                    <div class="slide">
                        <div class="slide__inner slide--left">
                            <div class="container container--slide-1">
                                <div class="container__logo">
                                    <!-- <i class="material-icons">trending_up</i> -->
                                    <img src="<?= base_url(); ?>\admin_assets\images\no_data\appointment.jpg">
                                </div>
                                <div class="container__stripe container__stripe--long"></div>
                                <div class="container__stripe container__stripe--short"></div>
                            </div>
                        </div>
                        <div class="slide__inner slide--right">
                            <h1>Effortless Appointment Scheduling</h1>
                            <p>Streamline your salon's booking process with an intuitive and efficient system. Manage appointments seamlessly, reduce no-shows, and provide a hassle-free experience for your customers.</p>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="slide">
                        <div class="slide__inner slide--left">
                            <div class="card card--profile">
                                <div class="card__logo card--profile__logo">
                                    <!-- <i class="material-icons">person</i> -->
                                    <img src="<?= base_url(); ?>\admin_assets\images\no_data\service_product_setup.jpg">
                                </div>
                                <!-- <div class="card__info card--profile__info">
                                    <h5 class="card__info__name card--profile__info__name">Kevin Badge</h5>
                                    <div class="card__data card--profile__data">
                                        <div class="card__data__stats"><i class="material-icons">work</i><span>413</span></div>
                                        <div class="card__data__stats"><i class="material-icons">home</i><span>221</span></div>
                                        <div class="card__data__stats"><span>Admin</span></div>
                                    </div>
                                </div> -->
                                <div class="container__stripe container__stripe--long"></div>
                                <div class="container__stripe container__stripe--short"></div>
                            </div>
                            <!-- Add other profile cards as needed -->
                        </div>
                        <div class="slide__inner slide--right">
                            <h1>Simple Setup for Services and Products</h1>
                            <p>Easily configure your salon’s services and products with a user-friendly interface. Keep your offerings organized and up to date, ensuring smooth operations.</p>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="slide">
                        <div class="slide__inner slide--left">
                            <div class="container container--slide-3">
                                <header class="header--slide-3">
                                    <nav class="header__nav">
                                        <div class="header__nav__logo">
                                            <!-- <p>LOGO</p> -->
                                            <img src="<?= base_url(); ?>\admin_assets\images\no_data\personlaised_offers.jpg">
                                        </div>
                                        <!-- <div class="header__nav__cta">Lorem</div> -->
                                    </nav>
                                    <div class="header__hero">
                                        <div class="header__hero__table"></div>
                                        <div class="header__hero__chair"></div>
                                    </div>
                                </header>
                            </div>
                        </div>
                        <div class="slide__inner slide--right">
                            <h1>Personalized Offer Creation</h1>
                            <p>Create and customize special offers tailored to your customers' preferences. Boost engagement and loyalty with exclusive deals that stand out.</p>
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="slide">
                        <div class="slide__inner slide--left">
                            <div class="container container--slide-3">
                                <header class="header--slide-3">
                                    <nav class="header__nav">
                                        <div class="header__nav__logo">
                                            <!-- <p>LOGO</p> -->
                                            <img src="<?= base_url(); ?>\admin_assets\images\no_data\accounting_reports.jpg">
                                        </div>
                                        <!-- <div class="header__nav__cta">Lorem</div> -->
                                    </nav>
                                    <div class="header__hero">
                                        <div class="header__hero__table"></div>
                                        <div class="header__hero__chair"></div>
                                    </div>
                                </header>
                            </div>
                        </div>
                        <div class="slide__inner slide--right">
                            <h1>Financial Tracking Made Easy</h1>
                            <p>Monitor your salon's finances effortlessly. Track revenue, expenses, and profitability in real-time with intuitive tools designed to simplify financial management.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php if ($onboarding_status_index == '18') { ?>

        <?php }else{ ?>
            <div>
                <?php if($this->uri->segment(1) == "complete-profile"){?>
                    <a id="skip_button" href="<?=base_url();?>store-profile">Skip To Continue</a>
                <?php }else{?>
                    <a id="skip_button" onclick="return confirm('Are you sure you want to skip <?=$next_status_name; ?>?');" href="<?=base_url();?>skip-onboarding?status=<?=base64_encode($next_status_flag); ?>&redirect=<?=base64_encode($skip_link); ?>&skip_step=<?=base64_encode($next_status_name); ?>">Skip <?=$next_status_name; ?></a>
                <?php }?>
            </div>
        <?php } ?>
    </div>



</div>
<script>
    $(document).ready(function() {
        $('.slides-container').addClass('slides-anime')
       
        $('.slides-container').slick({
            infinite: true,
            autoplay: true,
            autoplaySpeed: 2000,
            dots: true,
            arrows: false,
            // prevArrow: '<button class="btn btn__muted"><</button>',
            // nextArrow: '<button class="btn btn__highlighted">></button>',
            adaptiveHeight: true,
        });

        setTimeout(function() {
            // Hide the loading spinner when the action is complete
            
            $('.loading-gif').hide(1000);
            $('.check-gif').show(1000);
            
          
          
        }, 5000);


        setTimeout(function() {
            // Hide the loading spinner when the action is complete
            
            $('.loader-spin').fadeOut();
          
          
        }, 2000);
    });
</script>
<?php include('footer.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Napito | Privacy Policy</title>
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
       
                <h4 style="    text-align: center;">Privacy Policy</h4>
                    <p style="
    text-align: left;
    padding: 10px;
">
                        
                        Introducing our all-in-one salon app designed to provide a seamless and personalized hair styling experience. Whether you need a quick trim or a complete makeover, our app allows you to easily book your appointment and select your preferred stylist at a time that suits you. With an engaging and intuitive user interface, the app makes scheduling your next haircut or beauty service effortless.

Scheduling a haircut has never been easier. Browse a variety of haircuts and book an appointment with just a few taps. You can select your preferred date and time, ensuring you get a spot that fits your busy schedule. Our app offers a wide range of trendy and classic hairstyle options. Whether you’re looking for a new cut or want to stick to your signature look, explore our comprehensive catalog and choose the style that suits your personality.

The app allows you to choose your preferred stylist, so you can always get the professional touch you trust. Each stylist has a detailed profile with customer reviews and ratings, helping you make an informed decision. If you need to reschedule your appointment, the app makes it simple. You can change the time or date of your booking with no hassle, ensuring that you never miss out on your hair transformation.

Our app offers multiple time slots to choose from, allowing you to find the best time for your haircut. Whether you're booking for early morning, evening, or a weekend slot, we have you covered. The user interface of our app is designed to be sleek, minimalistic, and visually appealing, ensuring a smooth and enjoyable booking experience. Every step, from browsing services to confirming your appointment, is simplified to make your journey hassle-free.

Take your salon experience to the next level by purchasing a membership plan. With exclusive perks, discounts, and priority booking, our membership options give you added value for regular visits. Stay stylish while enjoying savings! Looking for the perfect gift? Our app offers digital gift cards, making it easy to treat your friends and family to a luxury hair salon experience. Perfect for birthdays, anniversaries, or any occasion!

As a member or gift card holder, you’ll unlock amazing discounts on services, styling products, and future bookings. Keep an eye out for exclusive promotions and seasonal offers to make your visits even more affordable. Our app is designed to cater to your unique needs. Save your favorite styles, stylists, and appointment times for a personalized experience each time you visit. You’ll never have to worry about remembering your preferences again.

The app provides you with convenience, allowing you to book, reschedule, or cancel your appointment anytime, from anywhere. With flexibility, you can choose from a variety of time slots and stylists, ensuring you get the best service at your convenience. Benefit from membership perks, gift cards, and discounts on every visit, and enjoy a seamless experience through a modern, sleek interface.

Whether you're a first-time visitor or a regular customer, our salon app provides everything you need for a professional and personalized salon experience. Download now to book your appointment, explore different hairstyles, and discover exclusive benefits like memberships and gift cards, all at your fingertips.

Don't wait for the perfect moment—make it happen today!
full description
                    </p>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
       


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


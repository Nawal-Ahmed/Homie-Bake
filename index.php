<?php
session_start();
?>


<?php

// Define variables for success/error messages
$successMsg = '';
$errorMsg = '';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $servername = "localhost";     
    $username = "root";       
    $password = "";       
    $dbname = "homie_bake_db";   

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get and sanitize form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert data into the Feedback table
    $sql = "INSERT INTO Feedback (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        $successMsg = "Feedback submitted successfully!";
    } else {
        $errorMsg = "Error: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>


<!doctype html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Homie Bake</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Cemre Tellioğlu Tunçay">

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <!-- Place favicon.ico in the root directory -->
    <link rel="icon" type="image/png" href="Untitled_design-removebg-preview.png" sizes="32x32" />
    <!-- <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" /> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/side.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

</head>

<body>
    <!-- Header Area Start -->
    <header class="top">
        <div class="fixedArea">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 noPadding">
                    <div class="content-wrapper one">
                        <!-- Main Menu Start -->
                        <!-- Navbar-->
                        <header class="header">
                            <nav class="navbar navbar-default myNavBar">
                                <div class="container">

                                    <!-- Brand and toggle get grouped for better mobile display -->
                                    <div class="navbar-header">
                                        <div class="row">
                                            <div class="col-md-9 col-sm-9 col-xs-9">
                                                <div class="row">
                                                    <div class="col-md-3 col-xs-3 col-sm-3">
                                                        <a style="padding-top:0px;"
                                                            class="navbar-brand navBrandText text-uppercase font-weight-bold"
                                                            href="index.php"></a>

                                                    </div>
                                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                                        <a href="index.php"><img class="img-responsive logo"
                                                                src="img/logo/Homie Bake logo.png"
                                                                alt="restorant" /></a>

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <button type="button" class="navbar-toggle collapsed"
                                                    data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                                                    aria-expanded="false">
                                                    <span class="sr-only">Toggle navigation</span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                        <ul class="nav navbar-nav navbar-right navBar">
                                            <li class="nav-item"><a href="#section0"
                                                    class="nav-link text-uppercase font-weight-bold js-scroll-trigger">Home
                                                    </a></li>
                                            <li class="nav-item"><a href="about.php"
                                                    class="nav-link text-uppercase font-weight-bold js-scroll-trigger">About Us</a>
                                            </li>
                                            <li class="nav-item"><a href="menu.php"
                                                    class="nav-link text-uppercase font-weight-bold js-scroll-trigger">Menu
                                                    </a></li>
                                            <li class="nav-item"><a href="contact.php"
                                                    class="nav-link text-uppercase font-weight-bold js-scroll-trigger">Contact
                                                    Us</a></li>
                                                    <li class="nav-item">
                                                <a id="cart-icon" href="javascript:void(0)" class="nav-link text-uppercase font-weight-bold js-scroll-trigger">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    <span>(<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </header>
                        <!-- Main Menu End -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->

    <!-- Cart Sidebar -->
<div id="cart-sidebar" class="cart-sidebar">
    <div class="close-btn" onclick="closeCart()">×</div> <!-- Styled close button -->
    <h2 class="cart-heading">Your Cart</h2>
    <div id="cart-items">
        <?php
        if (isset($_SESSION['cart'])) {
            $total = 0; // Initialize total amount
            foreach ($_SESSION['cart'] as $item) {
                $itemTotal = $item['price'] * $item['quantity'];
                $total += $itemTotal;
                echo "<div class='cart-item' data-price='{$item['price']}' data-quantity='{$item['quantity']}'>
                    <p>{$item['name']} - \${$item['price']} x {$item['quantity']}</p>
                </div>";
            }
            echo "<div class='cart-total'>Total: $<span id='cartTotal'>" . number_format($total, 2) . "</span></div>";
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
    </div>
    <button id="checkout-btn" class="checkout-btn" onclick="goToCheckout()">Checkout</button> <!-- Checkout button -->
</div>

    <!-- Hero Section Start -->
    <section id="section0" class="slider-area">
        <div class="main-slider owl-theme owl-carousel">
            <!-- Start Single Slide 01-->
            <div class="single-slide item"
                style="background: url(img/slider/cakeslider.jpg) no-repeat center center/cover;">
                <!-- Start Slider Content -->
                <div class="slider-content-area">
                    <div class="row">
                        <div class="slide-content-wrapper text-center">
                            <div class="slide-content">
                                <img class="classic" src="img/logo/Homie Bake Slider.png">
                                <h3>Dreams Up </h3>
                                <h2>Delicious Cakes</h2>
                                <p>Freshly baked cakes, perfect for any occasion. Choose from chocolate, vanilla, and more</p>
                                <a class="default-btn" href="menu.php#cake-section">Order Cakes</a>
                                <img class="shape" src="img/new/icon.png">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Slider Content -->
            </div>
            <!-- End Single Slide 01-->
            <!-- Start Single Slide 02-->
            <div class="single-slide item"
                style="background: url(img/slider/cupcakeslider.png) no-repeat center center/cover">
                <!-- Start Slider Content -->
                <div class="slider-content-area">
                    <div class="row">
                        <div class="slide-content-wrapper text-center">
                            <div class="slide-content">
                                <img class="classic" src="img/logo/Homie Bake Slider.png">
                                <h3>Whips Up</h3>
                                <h2>Tempting Cupcakes</h2>
                                <p>Sweet treats in all the flavors you love. Topped with creamy goodness.</p>
                                <a class="default-btn" href="menu.php#cupcake-section">Order Cupcakes</a>
                                <img class="shape" src="img/new/icon.png">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Slider Content -->
            </div>
            <!-- End Single Slide 02-->
            <!-- Start Single Slide 03-->
            <div class="single-slide item"
                style="background: url(img/slider/cookieslider.jpg) no-repeat center center/cover;">
                <!-- Start Slider Content -->
                <div class="slider-content-area">
                    <div class="row">
                        <div class="slide-content-wrapper text-center">
                            <div class="slide-content">
                                <img class="classic" src="img/logo/Homie Bake Slider.png">
                                <h3>Crafts Up</h3>
                                <h2>Homemade Cookies</h2>
                                <p>Soft inside, crispy outside. Chocolate chip, oatmeal, you name it.</p>
                                <a class="default-btn" href="menu.php#cookie-section">Order Cookies</a>
                                <img class="shape" src="img/new/icon.png">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Slider Content -->
            </div>
            <!-- End Single Slide 03-->
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Section Start -->
    <section id="about-section" class="bakery-intro">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="text-center col-md-6 col-sm-6 col-xs-12 noPadding">
                            <img src="img/new/baking-2589517_640.jpg" alt="Baked goods display">
                        </div>
                        <div class="bakery-section-description col-md-6 col-sm-6 col-xs-12 noPadding text-center">
                            
                            <h2>Indulge in the Finest Baked Goods</h2>
                            <h4>From Our Oven to Your Table</h4>
                            <hr>
                            <p>
                                Welcome to Homie Bake! Our bakery is built on a passion for creating treats that not only taste great but are made with the finest, locally sourced ingredients. Every creation, from our cakes to our pastries, is thoughtfully crafted with the utmost attention to detail. We bake with love and care, ensuring that every bite brings warmth and sweetness into your day.
                            </p>
                            <p>
                                At Homie Bake, our goal is to bring you comfort and joy through our delicious offerings. Whether you're celebrating a special occasion or simply indulging in a sweet moment, our treats are here to make every occasion memorable. From family recipes to modern classics, we’ve got something to please everyone’s taste buds.
                            </p>
                            <p>
                                Explore our menu and discover how each baked good is a little piece of home, made with the same dedication we’d bring to our own family’s table. Whether you're in for a rich, decadent cake or a flaky pastry, our bakery is here to satisfy all your cravings.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Choose us Section Start -->
    <section id="section2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 ">
                    <div class="maintext text-center">
                        <span>Home-Baked Happiness</span>
                        <h2>Why Choose Us?</h2>
                        <p>Experience the best in home-baked goods, crafted with care and delivered with love.</p>
                    </div>
                </div>
            </div>
            <div class="row shapes">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 minHeightProp">
                            <img class="imgback" src="img/shape/shape2.png">
                        </div>
                        <div class="col-md-12">
                            <div class="text-center">
                                <span>Fresh Ingredients</span>
                                <p>We use only the freshest ingredients to ensure top quality in every bite.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 minHeightProp">
                            <img class="imgback" src="img/shape/shape1.png">
                        </div>
                        <div class="col-md-12">
                            <div class="text-center">
                                <span>Fast Delivery</span>
                                <p>Get your baked goods delivered to your doorstep quickly and with care.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 minHeightProp">
                            <img class="imgback" src="img/shape/shape3.png">
                        </div>
                        <div class="col-md-12">
                            <div class="text-center">
                                <span>Quality Guaranteed</span>
                                <p>Our baked treats are made to perfection, ensuring satisfaction every time.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Choose us Section End -->

    <!-- Products Section Start -->
    <section id="catering-events" class="catering-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="section-title">Catering & Events</h2>
                    <h4 class="sub-title">For the Sweetest Moments in Life</h4>
                    <p class="description">
                        We offer catering for events of all sizes, making your special day even more memorable with our handmade treats. From weddings to corporate events, we customize every order to fit your needs. Whether it's cupcakes, pastries, or custom cakes, we ensure your guests are delighted!
                    </p>
                    <a href="menu.php" class="view-selection-btn">View Selection ></a>
                </div>
                <div class="col-md-6">
                    <div class="small-image-grid">
                        <div class="small-image-box">
                            <img src="img/new/cake1.png" alt="Event Image 1">
                        </div>
                        <div class="small-image-box">
                            <img src="img/new/cake2.png" alt="Event Image 2">
                        </div>
                        <div class="small-image-box">
                            <img src="img/new/cake3.png" alt="Event Image 3">
                        </div>
                        <div class="small-image-box">
                            <img src="img/new/cake4.png" alt="Event Image 4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Products Section End -->

    <!-- Testimonial Area Start -->
    <section id="section4" class="parallax-window" data-parallax="scroll" data-image-src="img/testimonial/quote.jpg">
        <!-- <h3>What We Say</h3> -->
        <p class="quote">"Baking is about transformation.<br> Turning flour into cakes, eggs into custard, and ideas into something real."</p>
        <p class="writer">~Barbara Kafka</p>

    </section>
    <!-- Testimonial Area End -->

    <!-- Contact Start -->
    <section id="section6" class="contact">
        <div class="contact100-form-title container">
            <h3>Keep In Touch</h3>
            <h2>Send A Message</h2>

            <!-- Display success/error messages -->
            <?php if (!empty($successMsg)) { echo "<p class='success'>$successMsg</p>"; } ?>
            <?php if (!empty($errorMsg)) { echo "<p class='error'>$errorMsg</p>"; } ?>


            <form method="POST" action="" class="contact100-form validate-form" >
                <div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Name is required">
                    <span class="label-input100">Full Name</span>
                    <input class="input100" type="text" name="name" placeholder="Enter your name" required>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 rs1-wrap-input100 validate-input"
                    data-validate="Valid email is required: ex@abc.xyz">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="text" name="email" placeholder="Enter your email address" required>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Message is required">
                    <span class="label-input100">Message</span>
                    <textarea class="input100" name="message" placeholder="Your message here..." required></textarea>
                    <span class="focus-input100"></span>
                </div>

                <div class="container-contact100-form-btn">
                    <button class="contact100-form-btn">
                        <span>
                            Submit
                            <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>

                <!-- <div class="container-contact100-form-btn response" style="margin-top: 30px;">
                    <p class="error">
                    </p>
                </div> -->
            </form>
        </div>
    </section>
    <!-- Contact End -->
    
       
    <!-- Footer Start -->
    <footer class="footer-area">
        <div class="container main-footer">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="single-widget pr-60">
                        <div class="footer-logo pb-25">
                            <div class="col-md-12 noPadding logo-text">
                                <a class="" href="index.php"><img class="img-responsive"
                                        src="img/logo/Homie Bake Slider - Copy.png" alt="restorant" /></a>
                            </div>
                        </div>
                        <p>From our ovens to your table, we create delicious, homemade treats that bring joy to every occasion.</p>
                        
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="single-widget">
                        <h3>Information</h3>
                        <p class="lock"></p>
                        <ul>
                            <li class="footer-section">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2 text-center">
                                        <div class="footer-icon"></div>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <a href="index.php#about-section">
                                            <p>About Our Bakery</p>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="footer-section">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="footer-icon"></div>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <a href="menu.php">
                                            <p>Our Menu</p>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="footer-section">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="footer-icon"></div>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <a href="index.php#section2">
                                            <p>Why Choose Us</p>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="footer-section">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="footer-icon"></div>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <a href="about.php#promise">
                                            <p>Our Promise</p>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="single-widget">
                        <h3>Quick links</h3>
                        <p class="lock"></p>
                        <ul>
                            <li class="footer-section">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="footer-icon"></div>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <a href="menu.php">
                                            <p>Order Now</p>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="footer-section">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="footer-icon"></div>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <a href="index.php#catering-events">
                                            <p>Caterings & Events</p>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="footer-section">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="footer-icon"></div>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <a href="about.php#meet-the-team">
                                            <p>Meet the Team</p>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="footer-section">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="footer-icon"></div>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <a href="contact.php">
                                            <p>Contact Us</p>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="single-widget">
                        <h3>Bakery Address</h3>
                        <p class="lock"></p>
                        <ul>
                            <li class="address-section">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10 single-widget-description noPadding">
                                        <span>123 Street, Hyderabad, Pakistan</span>
                                    </div>
                                </div>
                            </li>
                            <li class="address-section">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10 single-widget-description noPadding">
                                        <span>+92 333 1234567</span>
                                    </div>
                                </div>
                            </li>
                            <li class="address-section">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10 single-widget-description noPadding">
                                        <span>info@homiebake.com</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p>Copyright © Homie Bake 2024. All Right
                            Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->
     
    <script src="js/vendor/jquery-1.12.0.min.js"></script>
    <script src="js/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/parallax.min.js"></script>
    <script src="js/ajax-mail.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/cart.js"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyIMWhs-crjT0yhctbRjfJFq75FlEhSzE&callback=initMap">
        </script>
</body>

</html>
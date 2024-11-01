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
                                                        <a href="index.php"><img class="img-responsive"
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
                                            <li class="nav-item"><a href="index.php"
                                                    class="nav-link text-uppercase font-weight-bold js-scroll-trigger">Home
                                                    </a></li>
                                            <li class="nav-item"><a href="about.php"
                                                    class="nav-link text-uppercase font-weight-bold js-scroll-trigger">About Us</a>
                                            </li>
                                            <li class="nav-item"><a href="menu.php"
                                                    class="nav-link text-uppercase font-weight-bold js-scroll-trigger">Menu</a></li>
                                            <li class="nav-item"><a href="contact.php"
                                                    class="nav-link text-uppercase font-weight-bold js-scroll-trigger">Contact
                                                    Us<span class="sr-only">(current)</span></a></li>
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

    <!-- Testimonial Area Start -->
    <section id="section4" class="parallax-window" data-parallax="scroll" data-image-src="img/testimonial/top.jpg">
        <div>
        <h2>Contact Us</h2>
        <p class="writer-white">Call Us Now</p>
        <p class="writer-white"><i class="fa fa-phone"></i> +92 333 1234567</p>
    </div>
              
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

     <!-- Address Section Start -->
     <section id="section7" class="row address parallax-window" data-parallax="scroll" data-image-src="img/address/bun.jpg">
        <div class="col-md-12">
                <div class="row">

                    <div class="col-md-5 col-md-offset-1 addess-description">
                        <span>Homie Bake Location</span>
                        <h2>Homie Bake Address</h2>
                        <p>I must explain to you how all this mistaken idea of denouncing pleure and praising pain was born.</p>
                        <ul>
                            <li class="address-section">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <i class="fa fa-address-card"></i>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10 lineHeight mt-10">
                                        123 Street, Hyderabad, Pakistan
                                    </div>
                                </div>
                            </li>
                            <li class="address-section">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <i class="fa fa-phone"></i>                                       
                                     </div>
                                     <div class="col-md-10 col-sm-10 col-xs-10 lineHeight mt-10">
                                        +92 333 1234567
                                    </div>
                                </div>
                                </li>
                            <li class="address-section">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <i class="fa fa-envelope"></i>                                       
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10 lineHeight mt-10">
                                        info@homiebake.com
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 addess-map">
                        <div id="map"></div>
                    </div>
        </div>
    </div>
    </section>

    <!-- Adress Section End -->

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
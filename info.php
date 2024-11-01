<?php
session_start();
$total = isset($_SESSION['total_bill']) ? $_SESSION['total_bill'] : 0.00; // Retrieve total from session
?>


<!DOCTYPE html>
<html lang="en"> 
<head>     
    <meta charset="utf-8">     
    <meta http-equiv="x-ua-compatible" content="ie=edge">     
    <title>Homie Bake</title>     
    <meta name="description" content="">     
    <meta name="viewport" content="width=device-width, initial-scale=1">     
    <meta name="author" content="Cemre Tellioğlu Tunçay">      
    <link rel="icon" type="image/png" href="Untitled_design-removebg-preview.png" sizes="32x32" />     
    <link rel="stylesheet" href="css/styles.css">     
    <link rel="stylesheet" href="css/animate.css">     
    <link rel="stylesheet" href="css/responsive.css">     
    <script src="js/vendor/modernizr-2.8.3.min.js"></script> 
</head> 
<body>     
    <div class="container">         
        <div class="form-card">             
            <!-- Info Form -->             
            <form id="signupForm" class="form-content" action="confirm_order.php" method="POST"> <!-- Added method="POST" to send form data -->                
                <h2>Customer Information</h2>                 
                <div class="form-group">                     
                    <label for="name">Name</label>                     
                    <input type="text" id="name" name="name" placeholder="Enter your name" required> <!-- Added name attribute -->                 
                </div>                 
                <div class="form-group">                     
                    <label for="signup-email">Email</label>                     
                    <input type="email" id="signup-email" name="email" placeholder="Enter your email" required>                 
                </div>                 
                <div class="form-group">                     
                    <label for="phone">Phone Number</label>                     
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>                 
                </div>                 
                <div class="form-group">                     
                    <label for="address">Address</label>                     
                    <input type="text" id="address" name="address" placeholder="Enter your complete address" required>                 
                </div>
                <div class="form-group">                     
                    <label for="total-bill">Total Bill</label>                     
                    <input type="text" id="total-bill" name="total_bill" value="<?php echo number_format($total, 2); ?>" readonly>                 
                </div>
                 
                <button type="submit" class="btn">Confirm</button>             
            </form>         


        </div>     
    </div>       

    <script src="js/main.js"></script>
    <script src="js/cart.js"></script>       
</body> 
</html>
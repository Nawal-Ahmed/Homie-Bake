document.addEventListener("DOMContentLoaded", function() {
    // Open the cart sidebar and calculate total when cart icon is clicked
    const cartIcon = document.getElementById('cart-icon');
    if (cartIcon) {
        cartIcon.addEventListener('click', function() {
            document.getElementById('cart-sidebar').style.display = 'block'; // Show cart sidebar
            calculateTotal(); // Update total display in the sidebar
        });
    }

    // Close the cart sidebar
    const closeButton = document.querySelector('.close-btn'); // Select by class since there's no id
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            document.getElementById('cart-sidebar').style.display = 'none';
        });
    }

    // Add event listeners to 'Add to Cart' buttons
    document.querySelectorAll('.cart-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            
            const form = event.target.closest('form');
            const formData = new FormData(form);
    
            fetch('add_to_cart.php', { // Check that this path is correct
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(count => {
                console.log('Items in cart:', count); // Log the response to ensure it's working
                document.querySelector('#cart-icon span').textContent = count; // Update cart count with the response
            })
            .catch(error => console.error('Error:', error));
        });
    });

    // Calculate the total amount in the cart and update the display in the sidebar
    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            const price = parseFloat(item.getAttribute('data-price'));
            const quantity = parseInt(item.getAttribute('data-quantity'));
            total += price * quantity; // Add item's total to cart total
        });
        document.getElementById('cartTotal').textContent = total.toFixed(2); // Display the total in the sidebar
    }

    // When checkout button is clicked, send total bill to server and redirect to checkout page
    const checkoutButton = document.getElementById('checkout-btn');
    if (checkoutButton) {
        checkoutButton.addEventListener('click', function() {
            const totalBill = parseFloat(document.getElementById('cartTotal').textContent);

            // Send total bill to PHP to save in session
            fetch('save_total.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'total_bill=' + encodeURIComponent(totalBill) // Use URL-encoded string format
            })
            .then(response => response.text())
            .then(() => {
                window.location.href = 'info.php'; // Redirect to the checkout page
            })
            .catch(error => console.error('Error during checkout:', error));
        });
    }
});
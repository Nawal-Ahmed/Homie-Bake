document.getElementById('cart-icon').addEventListener('click', function() {
    document.getElementById('cart-sidebar').style.display = 'block';
});
document.getElementById('close-cart').addEventListener('click', function() {
    document.getElementById('cart-sidebar').style.display = 'none';
});
document.querySelectorAll('.cart-btn').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        
        const form = event.target.closest('form');
        const formData = new FormData(form);

        fetch('add_to_cart.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(() => {
            updateCartCount();
        })
        .catch(error => console.error('Error:', error));
    });
});

function updateCartCount() {
    fetch('update_cart_count.php')
        .then(response => response.text())
        .then(count => {
            document.querySelector('#cart-icon span').textContent = `(${count})`;
        });
}
function closeCart() {
    document.getElementById('cart-sidebar').style.display = 'none';
}

function goToCheckout() {
    window.location.href = 'login.php'; // Redirects to the login page
}

// Optional: If you dynamically add items, use this function to calculate the total
function calculateTotal() {
    let total = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        const price = parseFloat(item.getAttribute('data-price'));
        const quantity = parseInt(item.getAttribute('data-quantity'));
        total += price * quantity;
    });
    document.getElementById('cartTotal').textContent = total.toFixed(2);
}

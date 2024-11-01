// function showSection(sectionId) {
//     const sections = document.querySelectorAll('.section');
//     sections.forEach(section => section.classList.remove('active'));

//     const buttons = document.querySelectorAll('.sidebar button');
//     buttons.forEach(button => button.classList.remove('active'));

//     document.getElementById(sectionId).classList.add('active');
//     document.querySelector(`.sidebar button[onclick="showSection('${sectionId}')"]`).classList.add('active');
// }

// function addProduct() {
//     const productName = document.getElementById('product-name').value;
//     const productDescription = document.getElementById('product-description').value;
//     const productPrice = document.getElementById('product-price').value;
//     const productImage = document.getElementById('product-image').value;
//     const productCategory = document.getElementById('product-category').value;

//     if (productName && productDescription && productPrice && productImage && productCategory) {
//         const productTable = document.getElementById('product-table');
//         const newRow = productTable.insertRow();
//         newRow.innerHTML = `
//             <td>New</td>
//             <td>${productName}</td>
//             <td>${productDescription}</td>
//             <td>$${productPrice}</td>
//             <td><img src="${productImage}" alt="${productName}" class="product-img"></td>
//             <td>${productCategory}</td>
//             <td><button class="btn delete-btn" onclick="deleteProduct(this)">Delete</button></td>
//         `;
//     }
// }

// function deleteProduct(button) {
//     const row = button.parentElement.parentElement;
//     row.remove();
// }


function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => section.classList.remove('active'));

    const buttons = document.querySelectorAll('.sidebar button');
    buttons.forEach(button => button.classList.remove('active'));

    document.getElementById(sectionId).classList.add('active');
    document.querySelector(`.sidebar button[onclick="showSection('${sectionId}')"]`).classList.add('active');
}

function addProduct() {
    const productName = document.getElementById('product-name').value;
    const productDescription = document.getElementById('product-description').value;
    const productPrice = document.getElementById('product-price').value;
    const productImage = document.getElementById('product-image').files[0];
    const productCategory = document.getElementById('product-category').value;

    if (productName && productDescription && productPrice && productImage && productCategory) {
        const formData = new FormData();
        formData.append("product_name", productName);
        formData.append("product_description", productDescription);
        formData.append("product_price", productPrice);
        formData.append("product_image", productImage);
        formData.append("product_category", productCategory);

        fetch("admin.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert("Product added successfully!");
            location.reload(); // Reload the page to see new product
        })
        .catch(error => console.error("Error:", error));
    } else {
        alert("Please fill in all fields.");
    }
}

function deleteProduct(button, productId) {
    if (confirm("Are you sure you want to delete this product?")) {
        fetch("admin.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `delete_product=1&product_id=${productId}`
        })
        .then(response => response.text())
        .then(data => {
            alert("Product deleted successfully!");
            button.closest("tr").remove(); // Remove row from table
        })
        .catch(error => console.error("Error:", error));
    }
}

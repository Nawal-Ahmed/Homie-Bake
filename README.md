# 🍰 HomieBake: A Home Baker's Online Store

## 📝 Project Overview

HomieBake is an online platform designed to connect home-based bakers with customers, providing a convenient way for bakers to showcase their products, manage orders, and handle custom requests. The website offers a user-friendly experience for customers to browse and order baked goods, while also providing an efficient admin dashboard for bakers to manage their online business.

## 🌟 Key Features

* **User-Friendly Interface:** Customers can easily browse baked goods, place orders, and request custom products.
* **Online Ordering System:** A seamless process for adding items to the cart and proceeding to checkout.
* **Custom Order Functionality:** Customers can specify their preferences for custom-made products, such as flavors and designs.
* **Admin Dashboard:**
    * Product Management: Add, delete, and manage product details (name, description, price, category, image).
    * Order Management: Approve/cancel orders and track order status.
    * Feedback Management: View user feedback.
* **Responsive Design:** The website adapts to various screen sizes and devices.

## 🛠️ Tech Stack

* **Frontend:**
    * HTML5
        * ![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
    * CSS3
        * ![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
    * JavaScript
        * ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
* **Backend:**
    * PHP
        * ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
* **Database:**
    * MySQL
        * ![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

## 💻 Technical Details

### Frontend

* **HTML5:** Provides the structure and semantic markup for the website.
    * Implemented a well-organized structure with sections like header, navigation, main content, and footer.
    * Utilized semantic elements (e.g., `<article>`, `<section>`, `<nav>`) to improve accessibility and SEO.
* **CSS3:** Styles the website and ensures a responsive layout.
    * Employed CSS Grid and Flexbox for layout management.
    * Used media queries to create a responsive design that adapts to different screen sizes (mobile-first approach).
    * Implemented visually appealing designs, including custom typography, color schemes, and animations.
* **JavaScript:** Enhances interactivity and user experience.
    * Implemented dynamic cart updates using JavaScript to allow users to add, remove, and modify items without page reloads.
    * Used JavaScript for form validation on both the client-side to ensure data accuracy before submission.
    * Implemented interactive elements such as modal windows, image sliders, and dynamic content loading.

### Backend

* **PHP:** Handles server-side logic and interacts with the database.
    * Implemented user authentication and authorization to secure the admin panel and user data.
    * Managed order processing, including creating, updating, and retrieving order information from the database.
    * Developed API endpoints for the frontend to fetch product data, manage user sessions, and handle form submissions.
    * Utilized prepared statements and parameterized queries to prevent SQL injection vulnerabilities.
* **MySQL:** Stores website data, including product information, user details, and order history.
    * Designed a normalized database schema to reduce data redundancy and improve data integrity.
    * Used appropriate data types for each field (e.g., VARCHAR, INT, DECIMAL, TEXT) to optimize storage and performance.
    * Implemented relationships between tables using foreign keys to ensure data consistency.

### Admin Panel

* **Product Management:**
    * Implemented CRUD (Create, Read, Update, Delete) operations for managing products in the database.
    * Provided an interface for adding new products, including details such as name, description, price, and category.
    * Enabled image uploading and storage for product images.
* **Order Management:**
    * Displayed a list of orders with details such as customer information, order date, and order status.
    * Allowed administrators to update the status of orders (e.g., pending, confirmed, completed).
* **Feedback Management:**
    * Provided an interface for administrators to view user feedback and messages.

## 🗂️ Database Schema

### ER Diagram

![ER Diagram](https://github.com/user-attachments/assets/270e025f-72a8-46d7-a110-a56833f594f2)


### Tables

* **Products:**
    * product_id (INT, Primary Key)
    * product_name (VARCHAR(50))
    * description (TEXT)
    * price (DECIMAL(10, 2))
    * image_data (LONGBLOB)
    * category (ENUM('Cakes', 'Cupcakes', 'Cookies'))
* **Orders:**
    * order_id (INT, Primary Key)
    * customer_id (INT, Foreign Key)
    * order_date (DATETIME)
    * status (ENUM('Pending', 'Completed', 'Cancelled'))
    * total_price (DECIMAL (10,2))
* **Order Items:**
    * order_item_id (INT, Primary Key)
    * order_id (INT, Foreign Key)
    * product_id (INT, Foreign Key)
    * quantity (INT)
* **Customers:**
    * customer_id (INT, Primary Key)
    * name (VARCHAR(20))
    * email (VARCHAR(50))
    * address (VARCHAR(100))
    * phone_number (VARCHAR(15))
* **Feedback:**
    * feedback_id (INT, Primary Key)
    * name (VARCHAR(50))
    * email (VARCHAR(50))
    * message (TEXT)

## 🚀 Setup Instructions

1.  **Database Setup:**
    * Set up a MySQL database.
    * Create the tables as defined in the database schema.
    * Import the provided SQL dump file (if available) to create the database and tables.
2.  **Backend Setup:**
    * Install PHP.
    * Configure PHP to connect to the MySQL database by updating the database connection details in the PHP configuration file.
    * Place the PHP files in the server's document root or a designated directory.
3.  **Frontend Setup:**
    * Ensure a web server (e.g., Apache, Nginx) is running.
    * Place the HTML, CSS, and JavaScript files in the server's document root or a designated directory.
4.  **Run the Application:**
    * Access the website through a web browser.

## 🔗 Resources

* **HTML:**
    * [Mozilla Developer Network (MDN) - HTML](https://developer.mozilla.org/en-US/docs/Web/HTML)
* **CSS:**
    * [Mozilla Developer Network (MDN) - CSS](https://developer.mozilla.org/en-US/docs/Web/CSS)
    * [CSS Grid Guide](https://css-tricks.com/snippets/css/complete-guide-grid/)
    * [CSS Flexbox Guide](https://css-tricks.com/snippets/css/a-guide-to-flexbox/)
* **JavaScript:**
    * [Mozilla Developer Network (MDN) - JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
    * [Eloquent JavaScript](https://eloquentjavascript.net/)
* **PHP:**
    * [PHP Manual](https://www.php.net/manual/en/)
* **MySQL:**
    * [MySQL Documentation](https://dev.mysql.com/doc/)

## ➕ Workflow Diagrams and Screen Designs

### Workflow Diagrams

* **Main Website Workflow:**
    ![Main Website Workflow Diagram](https://github.com/user-attachments/assets/93297b72-72fb-477d-871b-6cae03b4721a)

* **Admin Panel Workflow:**
    ![Admin Panel Workflow Diagram](https://github.com/user-attachments/assets/560a5221-a274-4c1d-98f6-1edf18c6ca13)

### Screen Designs

* **Home Page:**
    ![Home Page](https://github.com/user-attachments/assets/77e39dd9-ee63-4752-b2ca-b327f35ec34f)

* **Product Listing Page:**
    ![Listing](https://github.com/user-attachments/assets/24d49f90-f628-4908-b8f3-e2a2297ea523)

* **Cart Page:**
    ![Cart](https://github.com/user-attachments/assets/729c0cb4-9414-4a10-a7c2-118cc12d41d6)

* **Checkout Page:**
    ![Checkout](https://github.com/user-attachments/assets/e9ee7fd8-bd9a-46b0-b039-7f121da1c280)

* **Admin Product Management Page:**
   ![Admin Screen](https://github.com/user-attachments/assets/eb3f73c3-a197-41e3-86bf-de3be9206e5c)


## 🏁 Conclusion

HomieBake provides a platform for home-based bakers to expand their customer base and manage their business efficiently. It addresses the challenges they face by offering an intuitive interface for customers and a simple admin panel for bakers. The system streamlines order handling, enables custom requests, and enhances the overall experience for both bakers and customers.

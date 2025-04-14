# 🎬 RentMe - Car Rental Service

## 📝 Project Overview

RentMe is a desktop application designed to streamline car rental operations for both rental companies and customers. It addresses the challenges of traditional car rental processes by providing a user-friendly interface for managing bookings, reservations, and rental agreements. The system also includes features for payment processing, vehicle inventory management, and report generation.

## 📽 Demo
[Demo Video (Google Drive)](https://drive.google.com/file/d/1cqsa9U27_-f26O3A_1sfJSMLy_xP9j49/view?usp=drive_link)

## 🌟 Key Features

* **Car Rental Management:**
    * Users can select a car and specify pickup and drop-off dates.
    * The system calculates the total rental duration.
    * Option for users to hire a driver for an additional fee.
* **Billing:**
    * Initial bill calculation based on rental duration and car price, including driver charges.
    * Penalty calculation for late returns.
    * Final bill generation.
* **User Management:**
    * Customer login and signup.
    * Employee login and registration.
* **Vehicle Management:**
    * Real-time tracking of vehicle availability and maintenance schedules.
* **Database Integration:**
    * MySQL database to handle data storage and retrieval.

## 🛠️ Tech Stack

| Layer | Technologies Used |
| :------- | :-------------------------------------------------------------------------------------------------------------------------- |
| Frontend | JavaFX |
| Backend | Java [![Java](https://img.shields.io/badge/Java-ED8B00?style=for-the-badge&logo=java&logoColor=white)](https://www.java.com/) |
| Database | MySQL [![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/) |
| Database Connectivity | JDBC |

## 🗂️ Database Schema



### ER Diagram
![ER Diagram for Car Rental Management System](https://github.com/user-attachments/assets/4277614e-9236-4cf7-b900-a2ba4c2ccebc)

### ER Mapping

The ER diagram is mapped to the following relational database schema:
![ER Mapping Diagram](https://github.com/user-attachments/assets/7312b3b1-2323-4638-b1dc-2b8d5ae39435)

* **Employee Table:**

    * EmpID (INT, Primary Key, Not Null, Unique, Auto Increment)
    * EmpName (VARCHAR (20), Not Null)
    * CNIC (VARCHAR (15), Not Null, Unique)
    * Username (VARCHAR (20), Unique)
    * Password (VARCHAR(15))
    * PhoneNo (VARCHAR (12))
    * Job (ENUM (“HR”, “Manager”, “Driver”))
    * Availability (ENUM (“Yes”, “No”))
    * Manager (INT, Recursive Foreign Key referencing Employee table)
* **Vehicle Table:**

    * VehicleID (INT, Primary Key, Not Null, Unique, Auto Increment)
    * Name (VARCHAR (20))
    * Year (INT)
    * Type (ENUM(“Sedan”, “Compact”, “Minivan”))
    * PlateNo (VARCHAR (7), Not Null, Unique)
    * DailyPrice (INT)
    * Available (ENUM(“Yes”, “No”))
    * Manager (INT, Foreign Key referencing Employee table, Not Null)
* **Rentals Table:**

    * RentalID (INT, Primary Key, Not Null, Unique, Auto Increment)
    * Pickup Date (TIMESTAMP, Not Null)
    * Dropoff Date (TIMESTAMP, Not Null)
    * Initial Price (INT, Not Null)
    * Penalty (INT)
    * Final Price (INT)
    * CstID (INT, Foreign Key referencing Customer table, Not Null)
    * VehicleID (INT, Foreign Key referencing Vehicle table, Not Null)
    * DriverID (INT, Foreign Key referencing Employee table)
    * Status (ENUM(“Rented”, “Completed”))
* **Customer Table:**

    * CstID (INT, Primary Key, Not Null, Unique, Auto Increment)
    * CstName (VARCHAR (20), Not Null)
    * CNIC (VARCHAR (15), Not Null, Unique)
    * Username (VARCHAR (20), Not Null, Unique)
    * Password (VARCHAR (15))
    * PhoneNo (VARCHAR (12))

## 🚀 Setup Instructions

1.  **Database Setup:**
    * Set up a MySQL database.
    * Create the tables as defined in the database schema.
2.  **Backend Setup:**
    * Install Java.
    * Configure JDBC to connect to the MySQL database.
    * Implement the backend logic using Java.
3.  **Frontend Setup:**
    * Install NetBeans.
    * Build the frontend using JavaFX.
4.  **Run the Application:**
    * Compile and run the Java application.

## 💻 Implementation Details

* **Frontend Development:** JavaFX was used to build a user-friendly interface with screens for booking and managing vehicles.
* **Backend Development:** Java was used to implement the business logic and system functionalities. JDBC was used to connect to the MySQL database and execute SQL queries.
* **Database Integration:** MySQL database was used for data storage and retrieval.

## ➕ Drawbacks and Future Improvements

* **Limited User Feedback Mechanism:** Implement a feedback system for users to share their experiences and suggestions.
* **Inadequate Vehicle Tracking:** Introduce a vehicle tracking system for real-time location tracking.
* **Multilingual Support:** Provide multilingual support to cater to a diverse customer base.
* **Mobile App Development:** Develop a mobile application for increased user convenience.

## 🏁 Conclusion

The Car Rental Management System is a comprehensive solution for streamlining car rental operations. It addresses key challenges faced by both rental companies and customers. Future improvements will focus on enhancing user experience, expanding functionality, and ensuring the system's continued effectiveness in the car rental industry.

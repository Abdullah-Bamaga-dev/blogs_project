# ✍️ Laravel Blog System

A fully functional, dynamic, and secure Blog Management System built with **Laravel**. This project was developed as part of the "Laravel For Absolute Beginners" course, focusing on building a robust backend architecture, clean code principles, and optimized database queries.

## 🚀 Key Features

* **User Authentication & Authorization:** Secure registration and login system. Authors can only edit and delete their own blogs (IDOR protection).
* **Complete CRUD Operations:** Create, Read, Update, and Delete blog posts seamlessly.
* **Advanced File Management:** Secure image uploading, storing physical files using Laravel's local disk, and automatically deleting old images from the server when a post is updated or deleted to save space.
* **Dynamic Categories:** Filter and display blogs based on their assigned categories.
* **Interactive Commenting System:** Users can leave comments on single blog pages with full form validation.
* **Author Dashboard (My Blogs):** A dedicated protected page for authors to manage their published posts.
* **Performance Optimization (Eager Loading):** Fixed the famous (N+1) query problem using `with()` and `load()` methods to optimize database performance significantly.
* **Route Model Binding:** Clean and efficient routing logic for fetching records.
* **UI/UX Enhancements:** * Integrated **SweetAlert2** for elegant and safe delete confirmation dialogs.
    * Dynamic Blog Slider and "Recent Posts" widget on the sidebar.
    * Pagination for handling large amounts of data smoothly.
 
## 🛠️ Tech Stack & Development Environment

* **Backend:** PHP, Laravel Framework
* **Database:** MySQL
* **Database Management:** **HeidiSQL**
* **Local Server Environment:** **Laragon**
* **Frontend:** HTML, CSS, Bootstrap, JavaScript
* **Libraries:** SweetAlert2

## 🗄️ Database Relationships

The system relies on a well-structured relational database:
* `User` has many `Blogs` (1:M)
* `Category` has many `Blogs` (1:M)
* `Blog` belongs to a `User` and a `Category`
* `Blog` has many `Comments` (1:M)

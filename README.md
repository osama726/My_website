<p align="center">
  <img src="public/uploads/logo-dark.png" alt="Portfolio Logo" width="150"/>
</p>

<h1 align="center">PHP MVC Portfolio CMS</h1>

<p align="center">
  <img src="https://img.shields.io/badge/Backend-PHP%20Vanilla-69BAC1" alt="PHP Badge"/>
  <img src="https://img.shields.io/badge/Architecture-MVC-D9534F" alt="MVC Badge"/>
  <img src="https://img.shields.io/badge/Database-MySQL-5cb85c" alt="MySQL Badge"/>
  <img src="https://img.shields.io/badge/Status-Completed-success" alt="Project Status"/>
</p>

<p align="center">
  Developed by <b>Osama Gamal</b><br>
  <a href="https://osamaa.page.gd/">🔗 Live Demo</a>
</p>

---

## 🚀 About the Project

This is a personal, self-managed **Portfolio and Content Management System (CMS)** built entirely from scratch using **Vanilla PHP** and the **Model-View-Controller (MVC)** architectural pattern.

The primary goal was to create a secure, highly maintainable, and robust back-end application that demonstrates full control over server-side logic, database interactions, and clean code separation.

---

## 🧠 Key Features & Technical Depth

### 1. Core Architecture
Focuses on strict **Separation of Concerns (SoC)**, utilizing a custom-built routing system and a dedicated `BaseModel` for all database interactions (PDO).

### 2. Comprehensive Content Management (CRUD)
The secure dashboard allows the administrator (via admin role authorization) to perform full CRUD operations on:
- **Projects:** Including file uploads, path management, and old image deletion.
- **Skills:** Management of technical stack icons and names.
- **General Settings:** Dynamic update of profile information, years of experience, and availability status.

### 3. Security & Messaging
- **Input Security:** Full sanitization (`filter_var`, `htmlspecialchars`) and server-side validation on all form submissions (including contact and authentication).
- **Secure File Handling:** Implemented safe `move_uploaded_file` logic, correct path management (System Path vs. Web Path), and file type validation (PDF, JPG).
- **Messaging System:** Contact form submissions are saved to the database (for backup) and forwarded via **PHPMailer** (SMTP) for reliable notifications.

### 4. User Experience (UX)
- **Theme Switching:** Persistent Dark/Light Mode toggle using CSS Variables and Local Storage.
- **Dynamic Content:** Skills section featuring smooth **Horizontal Auto-Scrolling** with manual controls.
icons for "Add to Home Screen" functionality.

---

## 🧩 Tech Stack

| Layer | Technology | Depth |
| :--- | :--- | :--- |
| **Backend** | PHP (Vanilla), MVC Architecture, Composer | Object-Oriented Development, Clean Architecture |
| **Database** | MySQL / MariaDB | PDO (Prepared Statements), Data Schemas |
| **Validation** | Server-Side Validation, PHPMailer | Secure Form Handling (Anti-XSS) |
| **Front-End** | HTML5, CSS3, Bootstrap 5.3, jQuery | Responsive Design, CSS Variables |

---

## ⚙️ Getting Started (Local Setup)

1.  **Prerequisites:** PHP 8.x, MySQL, Composer.
2.  **Installation:** `composer install` (to fetch PHPMailer and other dependencies).
3.  **Configuration:** Set up database credentials and constants (`BASE_URL`, `MAIL_HOST`) in your configuration files.
4.  **Database:** Create and populate the necessary tables (`users`, `settings`, `projects`, `messages`).
5.  **Permissions:** Ensure `public/uploads/` directory has write permissions (775/777).

---

## 👤 Author & Contact

- **Role:** Backend Developer
- **Author:** Osama Gamal
- **Codebase:** Full Source Available

---

## 📷 Screenshots
> *(Remember to upload your project screenshots to your repository and link them here.)*

![Dashboard Overview](public/uploads/home_page.png)
![Settings Management](public/uploads/dashboard.png)
![Contact Form Validation](public/uploads/about.png)

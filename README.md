# 🛒 E-Commerce Web Application

> A web-based e-commerce application built with Laravel 10 for online shopping and business management.

## 📌 About The Project

This E-Commerce Web Application is a Laravel-based system designed to support both **online shopping** and **internal business management**.

The customer-facing side provides features for browsing products, viewing product details, managing shopping carts, completing checkout, and reviewing orders.

The administrative side supports business operations such as inventory management, supplier management, purchasing, and sales management.

This project was developed as part of my web development portfolio to implement practical concepts in backend development, authentication, CRUD operations, shopping cart management, checkout workflows, order processing, and business data management.

## ✨ Key Features

### 🛍️ Customer Features

* Browse products
* View product details
* Add products to shopping cart
* Update product quantities
* Remove products from cart
* Checkout products
* View order history
* View order details
* View order status
* Browse blog content
* View available services
* Contact the business

### 📦 Order & Transaction Management

* Shopping cart management
* Checkout process
* Order processing
* Order detail management
* Order status updates
* Order rejection
* Post-checkout confirmation

### 🧑‍💼 Business Management

* Inventory / stock management
* Supplier management
* Purchase management
* Sales management
* Purchase transaction management
* Sales detail management
* Stock updates

### 🔐 Authentication & Account

* User registration
* User login
* User logout
* Password reset
* Password confirmation
* User profile management
* Two-factor authentication
* Two-factor recovery codes

## 🛠️ Tech Stack

| Technology            | Usage                                 |
| --------------------- | ------------------------------------- |
| **PHP 8.1+**          | Backend programming language          |
| **Laravel 10**        | Web application framework             |
| **Laravel Jetstream** | User account and application features |
| **Laravel Fortify**   | Authentication functionality          |
| **Livewire 3**        | Dynamic frontend interactions         |
| **Laravel Sanctum**   | Authentication / API support          |
| **Tailwind CSS**      | User interface styling                |
| **JavaScript**        | Client-side functionality             |
| **Vite**              | Frontend asset bundling               |
| **SweetAlert**        | User notifications                    |

## 🏗️ Application Modules

### 🛒 Online Store

The online store provides the main shopping experience:

```text
Homepage
   ↓
Shop
   ↓
Product Detail
   ↓
Add to Cart
   ↓
Shopping Cart
   ↓
Checkout
   ↓
Order
   ↓
Order Detail
```

### 📦 Business Management

The management section supports internal business operations, including:

* Stock management
* Supplier management
* Purchase management
* Sales management
* Order status management

## 🔄 E-Commerce Flow

```text
Customer
    │
    ▼
Browse Products
    │
    ▼
View Product
    │
    ▼
Add to Cart
    │
    ▼
Manage Cart
    │
    ▼
Checkout
    │
    ▼
Order Created
    │
    ▼
Order Processing
    │
    ▼
Order Status
```

## 💡 Development Highlights

Through this project, I implemented:

* Laravel MVC architecture
* CRUD functionality
* User authentication and account management
* Two-factor authentication
* Product browsing and detail pages
* Shopping cart functionality
* Quantity management
* Checkout workflow
* Order processing and status management
* Inventory management
* Supplier management
* Purchase management
* Sales management
* Dynamic interface interactions using Livewire
* Frontend asset management using Vite
* Responsive web interface development

## 📂 Main Modules

| Module             | Function                                                  |
| ------------------ | --------------------------------------------------------- |
| **Shop**           | Browse products                                           |
| **Detail**         | View product information                                  |
| **Cart**           | Manage shopping cart                                      |
| **Checkout**       | Process customer checkout                                 |
| **Orders**         | View order history and details                            |
| **Stok**           | Manage inventory                                          |
| **Pemasok**        | Manage suppliers                                          |
| **Pembelian**      | Manage purchases                                          |
| **Penjualan**      | Manage sales                                              |
| **Blog**           | Display blog content                                      |
| **Services**       | Display available services                                |
| **Contact**        | Business contact information                              |
| **Authentication** | Login, registration, password reset, and account security |

## ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/xQwerty7/E-commerce.git
cd E-commerce
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install frontend dependencies

```bash
npm install
```

### 4. Configure environment

Copy `.env.example` to `.env`:

```bash
cp .env.example .env
```

Then configure the application and database settings inside `.env`.

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Build frontend assets

```bash
npm run build
```

### 7. Run the application

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

## 🎯 Project Purpose

This project demonstrates my ability to develop a full-featured web application using Laravel, covering both the **customer shopping experience** and **internal business management processes**.

It combines e-commerce functionality with inventory, purchasing, and sales management within a single web application.

## 👨‍💻 Developer

**Muhammad Luthfillah Andria**

Information Systems | Web Development

[![GitHub](https://img.shields.io/badge/GitHub-xQwerty7-181717?style=for-the-badge\&logo=github)](https://github.com/xQwerty7)

---

<p align="center">
  Developed as part of my web development portfolio.
</p>

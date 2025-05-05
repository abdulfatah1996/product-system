<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
# 🛒 Laravel Product Management System

A complete Laravel 12 application for managing products, categories, and tags with full admin control panel and modern interface.

## ✅ Features

- 🔐 User authentication with role-based admin access
- 📦 Product management (CRUD)
- 🏷️ Category and tag management
- 🖼️ Image upload support
- 📤 Export products to Excel & PDF
- 📥 Import products from Excel with category/tag auto-linking
- 📊 Charts to visualize product distribution by tags
- ⚠️ Flash messages for success, error, and warnings
- 🧼 Clean codebase with Laravel best practices

## 📁 Stack Used

- Laravel 12
- Bootstrap 5 (for UI)
- Laravel Breeze (Auth)
- Laravel Excel
- DomPDF
- Chart.js
- MySQL / SQLite

## 🚀 Getting Started

1. Clone the repo
2. Run `composer install`
3. Copy `.env.example` to `.env` and configure
4. Run `php artisan migrate --seed`
5. Start dev server: `php artisan serve`

## 🔒 Admin Access

Use Tinker to promote a user to admin:

```php
php artisan tinker
User::first()->update(['is_admin' => true]);

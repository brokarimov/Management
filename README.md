<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h1 align="center">📂 Task Management System</h1>

<p align="center">
  Laravel 11 • AdminLTE 3 • MySQL • GitHub Actions
</p>

---

## 📝 About the Project

An internal task tracking and reporting system. Admins assign tasks to users, and users complete the tasks by uploading PDF responses. The system includes analytics, status filtering, email notifications, and more.

---

## 🔑 Authentication

- Login (only registered employees)
- Edit user profile
- Email notifications on profile updates

---

## 🧾 Tasks Module

- Admins can create and assign tasks (PDF attachments supported)
- Each task includes `description`, `deadline`, and `status`
- Task statuses:
  1. Sent
  2. Viewed
  3. Responded
  4. Successfully Completed
  5. Returned (with comment)

---

## 📊 Admin Panel Sections

- All Tasks
- Today's Tasks
- Tomorrow's Tasks
- Due in 2 Days
- Overdue Tasks
- Successfully Completed Tasks

---

## 📈 Reports

### Report 1:
Color-coded table by region and status

### Report 2:
Statistics by date, with filtering options

<p float="left">
  <img src="./screenshots/Screenshot 2025-04-13 045735.png" width="48%" />
  <img src="./screenshots/Screenshot 2025-04-13 045744.png" width="48%" />
</p>

---

## ⚙️ Technologies Used

- Laravel 11
- AdminLTE 3
- MySQL
- Bootstrap
- Git / GitHub Actions

---

## 🚀 Getting Started

```bash
git clone https://github.com/your-username/task-management.git
cd task-management
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate

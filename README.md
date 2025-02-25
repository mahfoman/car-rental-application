# 🚗 Car Rental Applicatio

A modern car rental service built with Laravel, Inertia.js, and Vue 3. Exploring car, making bookings, and managing rentals seamlessly.

## ✨ Features

### 🚘 Browse Cars
- Explore our cars with filtering options:
    - **Car Type** (SUV, Sedan, etc.)
    - **Brand** (Toyota, BMW, etc.)
    - **Price** (Filter based on budget)
- Each car listing includes:
    - Car name, brand, and model
    - Price per day
    - Availability status

### 📅 Make a Booking
- Select a car from the available list
- Choose rental start and end dates
- Availability validation ensures a hassle-free booking experience
- Complete your booking with a simple confirmation

### 📩 Email Confirmation
- Get an ** email confirmation** after booking
- Admins are notified for processing

### 🛠️ Manage Your Bookings
- **View** current and past bookings
- **Cancel** a booking (only if the rental period hasn’t started)

### 👤 User Authentication
- **Sign Up** to create an account
- **Log In** to access your bookings
- **Secure Authentication** to protect user data

---

## 🏗️ Tech Stack
- **Backend**: Laravel 11
- **Frontend**: Vue 3 + Inertia.js
- **Database**: MySQL
- **Email Notifications**: Laravel Mail
- **Styling**: Tailwind CSS

---
## 🏗️ Live Demo

You can check out a live demo of the Car Rental App here: [https://car-rental.laravelcs.com/](https://car-rental.laravelcs.com/)

---

## 🚀 Installation & Setup

### 1️⃣ Clone the Repository
```sh
git clone https://github.com/your-username/car-rental-application.git
cd car-rental-application
```

### 2️⃣ Install Dependencies
```sh
composer install
npm install
```

### 3️⃣ Set Up Environment
```sh
cp .env.example .env
php artisan key:generate
```
- Configure database credentials in `.env` file

### 4️⃣ Run Migrations & Seed Data
```sh
php artisan migrate
```

### 5️⃣ Start the Development Server
```sh
php artisan serve
npm run dev
```
- Visit `http://localhost:8000` in your browser

---

## 🎯 Future Enhancements
- 🚀 Payment Integration
- 📊 Advanced Reporting

---

## 📜 License
This project is licensed under the **MIT License**.

Feel free to contribute or raise issues! 🚀


-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2025 at 04:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car-rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `car_type` varchar(255) NOT NULL,
  `daily_rent_price` decimal(8,2) NOT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `brand`, `model`, `year`, `car_type`, `daily_rent_price`, `availability`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Civic', 'Honda', 'EX', 2022, 'Sedan', 50.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(2, 'Corolla', 'Toyota', 'LE', 2021, 'Sedan', 45.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(3, 'Model S', 'Tesla', 'Long Range', 2023, 'Electric', 120.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(4, 'Mustang', 'Ford', 'GT', 2022, 'Sports', 90.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(5, 'X5', 'BMW', 'xDrive40i', 2022, 'SUV', 110.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(6, 'A4', 'Audi', 'Premium', 2021, 'Sedan', 80.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(7, 'Camaro', 'Chevrolet', 'SS', 2023, 'Sports', 95.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(8, 'Wrangler', 'Jeep', 'Sport', 2022, 'SUV', 85.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(9, 'Altima', 'Nissan', 'SV', 2021, 'Sedan', 50.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(10, 'E-Class', 'Mercedes-Benz', 'E350', 2023, 'Luxury', 130.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(11, 'CX-5', 'Mazda', 'Touring', 2022, 'SUV', 70.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(12, 'Challenger', 'Dodge', 'R/T', 2023, 'Muscle', 100.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(13, 'Accord', 'Honda', 'Touring', 2022, 'Sedan', 60.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(14, '3 Series', 'BMW', '330i', 2022, 'Luxury', 105.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(15, 'Tucson', 'Hyundai', 'Limited', 2023, 'SUV', 75.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(16, 'Explorer', 'Ford', 'XLT', 2022, 'SUV', 95.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(17, 'Sentra', 'Nissan', 'SR', 2021, 'Sedan', 48.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(18, 'Outback', 'Subaru', 'Premium', 2022, 'SUV', 85.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(19, 'Yaris', 'Toyota', 'XLE', 2021, 'Hatchback', 42.00, 1, '', '2025-02-15 19:46:57', '2025-02-15 19:46:57'),
(20, 'Chiron', 'Bugatti', 'Super Sport', 2020, 'Hypercar', 5000.00, 1, 'car_images/AV7Dz9ZIqZiVKWClzomziHejTbdG0iIabMW8BaUD.jpg', '2025-02-15 19:46:57', '2025-02-17 00:23:12'),
(26, 'new car', 'brand', 'model', 2024, 'saloon', 100.00, 1, 'car_images/M9vN8fVQGNI5TjaIq8mFLjvW6l3p2R4zMlgeOnw1.jpg', '2025-02-16 14:40:38', '2025-02-17 00:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_15_192406_create_cars_table', 1),
(5, '2025_02_15_192407_create_rentals_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `user_id`, `car_id`, `start_date`, `end_date`, `total_cost`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2025-02-01', '2025-02-05', 250.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(2, 3, 5, '2025-02-10', '2025-02-15', 550.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(3, 4, 4, '2025-03-05', '2025-03-10', 450.00, '2025-02-15 19:47:07', '2025-02-16 23:34:43'),
(4, 5, 3, '2025-03-15', '2025-03-20', 600.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(5, 6, 12, '2025-04-01', '2025-04-07', 700.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(6, 7, 7, '2025-04-12', '2025-04-15', 285.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(7, 8, 14, '2025-05-01', '2025-05-05', 525.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(8, 9, 10, '2025-05-10', '2025-05-12', 260.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(9, 10, 15, '2025-06-01', '2025-06-05', 375.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(10, 11, 19, '2025-06-15', '2025-06-18', 255.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(11, 12, 16, '2025-07-01', '2025-07-06', 450.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(12, 13, 11, '2025-07-10', '2025-07-12', 170.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(13, 14, 4, '2025-08-01', '2025-08-03', 180.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(14, 15, 13, '2025-08-10', '2025-08-14', 400.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(15, 16, 6, '2025-09-01', '2025-09-07', 560.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(16, 17, 2, '2025-09-15', '2025-09-20', 225.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(17, 18, 17, '2025-10-01', '2025-10-06', 300.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(18, 19, 9, '2025-10-10', '2025-10-15', 250.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(19, 20, 18, '2025-11-01', '2025-11-05', 425.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(20, 2, 20, '2025-11-10', '2025-11-12', 10000.00, '2025-02-15 19:47:07', '2025-02-15 19:47:07'),
(21, 2, 1, '2025-02-17', '2025-02-20', 150.00, '2025-02-16 23:26:24', '2025-02-16 23:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jolMXSNuDf9WooEDbt6qnjosPqmiDKk031hB3Lvt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:135.0) Gecko/20100101 Firefox/135.0', 'YTo3OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiTHpzNXdzQjBpQWFQOFo1c0hXc1hMMHZTTTYwQ3I0TnJMZ1I4Z3lTayI7czo1OiJmbGFzaCI7YTowOnt9czo1OiJlbWFpbCI7czoxNjoiamFuZUBleGFtcGxlLmNvbSI7czo3OiJ1c2VyX2lkIjtpOjI7czo0OiJyb2xlIjtzOjg6ImN1c3RvbWVyIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyOToiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3JlbnRhbHMiO319', 1739979381);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john@example.com', 'hashed_password', 'admin', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(2, 'Jane Smith', 'jane@example.com', '$2y$12$3JuQ5/zjI9spHG8JVRlDDuKbx6ryLoaMK3vNDi3hxwixApuSH7g0S', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(3, 'Alice Brown', 'alice@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(4, 'Bob White', 'bob@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(5, 'Charlie Black', 'charlie@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(6, 'David Green', 'david@example.com', 'hashed_password', 'admin', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(7, 'Emma Wilson', 'emma@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(8, 'Frank Hall', 'frank@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(9, 'Grace Adams', 'grace@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(10, 'Henry Clark', 'henry@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(11, 'Isabella Lewis', 'isabella@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(12, 'Jack Scott', 'jack@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(13, 'Katie Evans', 'katie@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(14, 'Liam Turner', 'liam@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(15, 'Mia Parker', 'mia@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(16, 'Noah Harris', 'noah@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(17, 'Olivia Baker', 'olivia@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(18, 'Paul Wright', 'paul@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(19, 'Quinn Hill', 'quinn@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(20, 'Rachel Young', 'rachel@example.com', 'hashed_password', 'customer', '2025-02-15 19:46:46', '2025-02-15 19:46:46'),
(21, 'md Mahfoozur Rahman agn', 'mahfoozur.rahman.bd@gmail.com', '$2y$12$GIRzeD65HqSxCkxInx4WV.9FBt8oHEEyedYW1ZjiLV13zngw5LgUy', 'customer', '2025-02-16 07:36:27', '2025-02-16 09:33:33'),
(25, 'random ami', 'randami@rand.com', '$2y$12$eUd/sSuaxMzbHreQNnB2y.r/hT.3IWgtnI9l7cG0h.ipiX7Ye1.DC', 'customer', '2025-02-19 07:24:52', '2025-02-19 07:24:52'),
(26, 'abar rand', 'abar@rand.com', '$2y$12$kD.NwCaP4nRDG4FDT6e4.OvF1FCmzsWCQ5eHAdZ9VT.57ccG6oyIS', 'customer', '2025-02-19 07:26:11', '2025-02-19 07:26:11'),
(27, 'Shuriya Parvin', 'shuriya.parvin@gmail.com', '$2y$12$TY8haZ5FVFN20seDDLZfW.NWwr42P2UfqwGhf4.m4rXfjg5C6vUTu', 'customer', '2025-02-19 09:00:10', '2025-02-19 09:00:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rentals_user_id_foreign` (`user_id`),
  ADD KEY `rentals_car_id_foreign` (`car_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rentals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

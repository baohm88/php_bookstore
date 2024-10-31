-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 31, 2024 at 01:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `price_in` int(11) NOT NULL,
  `price_out` int(11) NOT NULL,
  `stock_qty` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `description`, `category_id`, `price_in`, `price_out`, `stock_qty`, `image_url`, `status`, `created_at`) VALUES
(1, 'PHP for Absolute Beginners', 'Thomas Blom', 'This book starts at the very beginning stages of web programming, showing even the most inexperienced web developer, through examples, how to build a basic content management system.', 1, 100, 200, 100, 'https://media.springernature.com/full/springer-static/cover-hires/book/978-1-4302-6814-7', 'active', '2024-10-31'),
(2, 'PHP and MySQL 24-Hour Trainer', 'Andrea Tarr', 'Assuming no previous experience with PHP or MySQL, this book-and-video package is ideal reading for anyone who wants to go beyond HTML/CSS in order to provide clients with the most dynamic web sites possible.', 1, 100, 230, 200, 'https://media.wiley.com/product_data/coverImage300/8X/11180668/111806688X.jpg', 'active', '2024-10-31'),
(3, 'MySQL Crash Course', 'Rick Silva', 'This complete guide to all things MySQL will take readers from the absolute basics of creating a table to the complexities of managing an entire database.', 3, 100, 201, 200, 'https://www.mysql.com/why-mysql/books/img/mysql_crash_course.jpg', 'active', '2024-10-31'),
(4, 'MySQL Concurrency', 'Jesper Wisborg Krogh', 'Know how locks work in MySQL and how they relate to transactions. This book explains the major role that locks play in database systems, showing how locks are essential in allowing high-concurrency workloads.', 3, 100, 200, 200, 'https://www.mysql.com/why-mysql/books/img/mysql_concurrency.jpg', 'active', '2024-10-31'),
(5, 'Learning Python: Powerful Object-Oriented Programming', 'Mark Lutz', 'Get a comprehensive, in-depth introduction to the core Python language with this hands-on book. Based on author Mark Lutz’s popular training course, this updated fifth edition will help you quickly write efficient, high-quality code with Python. It’s an ideal way to begin, whether you’re new to programming or a professional developer versed in other languages.', 2, 99, 156, 200, 'https://m.media-amazon.com/images/I/91RcdlPx1CL._SL1500_.jpg', 'active', '2024-10-31'),
(6, 'Python Tricks: A Buffet of Awesome Python Features', 'Dan Bader', 'With Python Tricks: The Book you’ll discover Python’s best practices and the power of beautiful & Pythonic code with simple examples and a step-by-step narrative.', 2, 89, 169, 200, 'https://m.media-amazon.com/images/I/61k7Z74UuZL._SL1500_.jpg', 'active', '2024-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'PHP'),
(2, 'Python'),
(3, 'MySQL');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','completed','canceled') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `order_date`, `status`) VALUES
(4, 2, 230, '2024-10-31', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `book_id`, `quantity`, `price`) VALUES
(5, 4, 2, 1, 230);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `image_url` varchar(255) DEFAULT NULL,
  `fullName` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `gender` enum('male','female','not specified') DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `create_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `image_url`, `fullName`, `bio`, `gender`, `birthday`, `email`, `shipping_address`, `create_at`) VALUES
(1, 'admin', '1', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-31'),
(2, 'bao', '1', 'user', 'https://cdn-images.vtv.vn/thumb_w/640/66349b6076cb4dee98746cf1/2024/10/25/elon-musk-1511593528042-1516761463193-93117992649966002193358.jpg', 'Ha Manh Bao', 'A full stack developer', 'female', '1989-01-20', 'baohm88@hotmail.com', '34/141 Giap Nhi, Thinh Liet, Hoang Mai', '2024-10-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

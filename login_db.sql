-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 07:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `revotedata`
--

CREATE TABLE `revotedata` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `candidate` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `revotedata`
--

INSERT INTO `revotedata` (`id`, `name`, `branch`, `candidate`, `email`) VALUES
(1, 'Yash', 'comp', 1, 'yash@pccoer.in');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `password`, `date`) VALUES
(1, 75678663176927782, 'yash1@pccoer.in', '1234', '2024-05-02 13:57:18'),
(2, 6602560, 'sivam@pccoer.in', '1234', '2024-05-02 13:58:48'),
(3, 61573888, 'nagesh@pccoer.in', '1234', '2024-05-02 14:00:20'),
(4, 63241878765806056, 'yash12@pcet.in', '1234', '2024-05-02 14:00:29'),
(5, 4267104223338, 'yash1@pccoer.in', '1234', '2024-05-02 14:00:35'),
(6, 277367245086163, 'yash12@pccoer.in', '1234', '2024-05-02 14:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `votedata`
--

CREATE TABLE `votedata` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `candidate` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votedata`
--

INSERT INTO `votedata` (`id`, `name`, `branch`, `candidate`, `email`) VALUES
(1, 'yash', 'comp', 2, 'yash@pccoer.in'),
(2, 'shivam', 'comp', 2, 'shivam@pccoer.in'),
(3, 'Yash S', 'it', 1, 'yash_11@pccoer.in'),
(4, 'NAgesh', 'mech', 1, 'nagesh@pccoer.in'),
(5, 'yashshastri', 'entc', 4, 'yashshastri01@pccoer.in'),
(6, 'Yash', 'comp', 2, 'yashshastri01@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `revotedata`
--
ALTER TABLE `revotedata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votedata`
--
ALTER TABLE `votedata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `revotedata`
--
ALTER TABLE `revotedata`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `votedata`
--
ALTER TABLE `votedata`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

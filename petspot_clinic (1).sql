-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2025 at 05:48 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petspot_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoption_requests`
--

CREATE TABLE `adoption_requests` (
  `id` int(11) NOT NULL,
  `found_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `requested_at` datetime DEFAULT current_timestamp(),
  `status` varchar(30) DEFAULT 'Pending',
  `manager_reply` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoption_requests`
--

INSERT INTO `adoption_requests` (`id`, `found_ID`, `user_ID`, `message`, `requested_at`, `status`, `manager_reply`) VALUES
(7, 54, 6, '', '2025-06-13 11:59:17', 'Accepted', NULL),
(8, 57, 6, 'How can i get the pet', '2025-07-21 10:45:47', 'Accepted', NULL),
(9, 29, 6, 'Is this pet not healthy', '2025-07-21 11:21:09', 'Accepted', 'Pet is totally healthy.You can adopt pet without worrying'),
(10, 42, 6, '', '2025-07-30 22:27:16', 'Accepted', 'you can adopt pet.visit clinic tommorow');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_ID` int(11) NOT NULL,
  `pet_ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `slot_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `cancellation_request` enum('none','requested','approved','rejected') DEFAULT 'none',
  `amount` decimal(10,2) DEFAULT 20.00,
  `payment_status` varchar(20) DEFAULT 'pay at clinic',
  `type` enum('physical','online') NOT NULL DEFAULT 'physical',
  `meeting_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_ID`, `pet_ID`, `user_id`, `date`, `time`, `reason`, `slot_id`, `status`, `cancellation_request`, `amount`, `payment_status`, `type`, `meeting_link`) VALUES
(48, 29, 6, '2025-06-10', '10:10:00', 'fear', 7, 'accepted', 'none', 5569.00, 'unpaid', 'physical', NULL),
(51, 33, 6, '2025-06-09', '02:10:00', '', 6, 'accepted', 'none', 1152.00, 'paid', 'online', 'https://myaccount.google.com/security'),
(53, 32, 7, '2025-06-10', '12:30:00', 'ooo', 7, 'accepted', 'none', 20.00, 'unpaid', 'online', 'https://myaccount.google.com/security'),
(55, 33, 6, '2025-06-10', '09:30:00', '', 7, 'accepted', 'requested', 20.00, 'unpaid', 'physical', NULL),
(56, 35, 6, '2025-06-10', '10:30:00', '', 7, 'rejected', 'none', 1500.00, 'unpaid', 'physical', NULL),
(58, 29, 6, '2025-06-10', '11:50:00', '', 7, 'accepted', 'none', 20.00, 'paid', 'online', 'https://myaccount.google.com/security'),
(71, 41, 13, '2025-06-12', '11:28:00', 'vaccintion', 10, 'accepted', 'none', 20.00, 'unpaid', 'physical', NULL),
(72, 29, 6, '2025-06-12', '15:08:00', 'vacination rabies', 10, 'rejected', 'none', 20.00, 'unpaid', 'physical', NULL),
(75, 33, 6, '2025-06-12', '18:08:00', 'fever', 10, 'cancelled', 'approved', 20.00, 'paid', 'online', 'https://www.pinterest.com/pin/29977153763827285/'),
(76, 29, 6, '2025-06-12', '17:48:00', '3rd vaccination', 10, 'rejected', 'none', 1700.00, 'unpaid', 'physical', NULL),
(77, 33, 6, '2025-06-12', '16:48:00', 'high fever', 10, 'cancelled', 'approved', 20.00, 'unpaid', 'online', 'https://www.pinterest.com/pin/29977153763827285/'),
(79, 46, 6, '2025-06-13', '07:33:00', '', 13, 'rejected', 'none', 20.00, 'unpaid', 'physical', NULL),
(80, 46, 6, '2025-06-13', '07:53:00', '', 13, 'accepted', 'none', 1500.00, 'paid', 'online', 'https://www.pinterest.com/pin/29977153763827285/'),
(81, 29, 6, '2025-06-13', '08:13:00', '4th vaccination for rabies', 13, 'rejected', 'none', 20.00, 'unpaid', 'physical', NULL),
(82, 29, 6, '2025-06-13', '08:33:00', 'fevr', 13, 'accepted', 'none', 2100.00, 'paid', 'online', 'https://www.pinterest.com/pin/29977153763827285/'),
(83, 40, 12, '2025-07-21', '11:33:00', '', 16, 'accepted', 'none', 2000.00, 'paid', 'online', 'https://www.pinterest.com/pin/29977153763827285/'),
(84, 40, 12, '2025-07-21', '11:53:00', '', 16, 'accepted', 'none', 1400.00, 'unpaid', 'physical', NULL),
(85, 29, 6, '2025-07-28', '00:07:00', 'not eat properly', 18, 'cancelled', 'approved', 20.00, 'unpaid', 'physical', NULL),
(86, 40, 12, '2025-07-28', '00:27:00', '', 18, 'cancelled', 'approved', 20.00, 'unpaid', 'physical', NULL),
(87, 40, 12, '2025-07-28', '01:07:00', '', 18, 'cancelled', 'approved', 20.00, 'unpaid', 'online', 'https://www.pinterest.com/pin/29977153763827285/'),
(88, 40, 12, '2025-07-28', '00:47:00', '', 18, 'cancelled', 'approved', 20.00, 'unpaid', 'physical', NULL),
(89, 33, 6, '2025-07-28', '05:07:00', '', 18, 'accepted', 'none', 20.00, 'unpaid', 'physical', NULL),
(90, 40, 12, '2025-07-31', '04:50:00', '', 19, 'cancelled', 'approved', 1400.00, 'unpaid', 'online', NULL),
(91, 40, 12, '2025-08-01', '05:03:00', 'urgent', 20, 'accepted', 'none', 1920.00, 'unpaid', 'physical', NULL),
(92, 40, 12, '2025-08-10', '07:00:00', '', 21, 'accepted', 'none', 4900.00, 'pay at clinic', 'physical', NULL),
(93, 40, 12, '2025-08-10', '07:20:00', '', 21, 'accepted', 'none', 2100.00, 'paid', 'online', 'https://www.pinterest.com/pin/29977153763827285/');

-- --------------------------------------------------------

--
-- Table structure for table `available_slots`
--

CREATE TABLE `available_slots` (
  `slot_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `time` time NOT NULL,
  `vet_staff_id` int(11) NOT NULL,
  `is_booked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `available_slots`
--

INSERT INTO `available_slots` (`slot_id`, `date`, `start_time`, `end_time`, `time`, `vet_staff_id`, `is_booked`) VALUES
(1, '2025-06-01', '00:19:00', '12:19:00', '00:00:00', 6, 0),
(2, '2025-06-02', '08:00:00', '10:00:00', '00:00:00', 5, 0),
(3, '2025-06-04', '08:00:00', '20:30:00', '00:00:00', 6, 0),
(4, '2025-06-05', '04:48:00', '23:52:00', '00:00:00', 6, 0),
(5, '2025-06-07', '01:18:00', '23:59:00', '00:00:00', 6, 0),
(6, '2025-06-09', '01:10:00', '17:13:00', '00:00:00', 6, 0),
(7, '2025-06-10', '08:30:00', '20:46:00', '00:00:00', 6, 0),
(8, '2025-06-08', '08:10:00', '20:20:00', '00:00:00', 6, 0),
(9, '2025-06-10', '08:00:00', '20:00:00', '00:00:00', 6, 0),
(10, '2025-06-12', '08:08:00', '20:00:00', '00:00:00', 6, 0),
(11, '2025-06-19', '10:30:00', '22:31:00', '00:00:00', 6, 0),
(12, '2025-06-18', '11:17:00', '15:21:00', '00:00:00', 6, 0),
(13, '2025-06-13', '07:33:00', '12:38:00', '00:00:00', 6, 0),
(14, '2025-06-22', '08:35:00', '20:35:00', '00:00:00', 6, 0),
(15, '2025-07-20', '11:32:00', '00:00:00', '00:00:00', 6, 0),
(16, '2025-07-21', '11:33:00', '14:30:00', '00:00:00', 6, 0),
(17, '2025-07-28', '13:07:00', '13:07:00', '00:00:00', 10, 0),
(18, '2025-07-28', '00:07:00', '12:07:00', '00:00:00', 10, 0),
(19, '2025-07-31', '04:50:00', '16:50:00', '00:00:00', 10, 0),
(20, '2025-08-01', '05:03:00', '17:03:00', '00:00:00', 10, 0),
(21, '2025-08-10', '07:00:00', '19:00:00', '00:00:00', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_ID` int(11) NOT NULL,
  `prescription_ID` int(11) NOT NULL,
  `cost_of_medicine` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_ID`, `prescription_ID`, `cost_of_medicine`, `total_price`, `user_ID`, `payment_method`, `note`) VALUES
(1, 5, 100.00, 100.00, 6, 'cash', 'hgr5j'),
(2, 3, 0.00, 200.00, 6, 'Cash', 'gjbjng'),
(3, 4, 0.00, 50.00, 3, 'Online', ''),
(4, 2, 0.00, 50.00, 6, 'Online', ''),
(5, 6, 0.00, 2000.00, 6, 'Cash', ''),
(9, 10, 0.00, 1152.00, 6, 'Cash', ''),
(10, 11, 0.00, 1452.00, 6, 'Cash', ''),
(11, 13, 0.00, 2600.00, 6, 'Cash', ''),
(15, 17, 0.00, 3000.00, 6, 'Cash', ''),
(16, 18, 0.00, 1456.00, 6, 'Card', ''),
(17, 16, 0.00, 5569.00, 6, 'Card', ''),
(18, 20, 0.00, 1500.00, 6, 'Cash', ''),
(19, 23, 0.00, 1500.00, 6, 'Cash', ''),
(22, 26, 0.00, 1700.00, 6, 'Online', ''),
(23, 27, 0.00, 2000.00, 6, 'Online', ''),
(24, 29, 0.00, 1500.00, 6, 'Online', ''),
(25, 30, 0.00, 2100.00, 6, 'Online', ''),
(26, 32, 0.00, 2000.00, 12, 'Online', ''),
(27, 33, 0.00, 1400.00, 12, 'Online', ''),
(28, 34, 0.00, 1400.00, 12, 'Cash', ''),
(29, 35, 0.00, 1920.00, 12, 'Cash', ''),
(30, 28, 0.00, 3200.00, 6, 'Cash', ''),
(31, 36, 0.00, 4900.00, 12, 'Cash', ''),
(32, 37, 0.00, 2100.00, 12, 'Online', '');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `confirmed` tinyint(1) DEFAULT 0,
  `is_staff` tinyint(1) DEFAULT 0,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `user_ID`, `title`, `content`, `created_at`, `image`, `confirmed`, `is_staff`, `updated_at`) VALUES
(12, 6, ' The Joy of Having Pets', 'Pets bring endless joy, love, and companionship into our lives. Whether it\'s a loyal dog, a playful cat, or even a gentle rabbit, pets quickly become part of the family. They help reduce stress, encourage daily activity, and teach responsibility. Caring for a pet is not just a duty—it’s a rewarding experience filled with unconditional love and happy moments.\r\n\r\n\r\n', '2025-07-16 16:11:36', '/PetSpot_clinic/public/uploads/687781e01079e_h6.jpg', 1, 0, NULL),
(17, NULL, 'How to Take Care of a New Pet', 'Bringing home a new pet is a joyful experience, but pets need proper care and love. Here are some easy tips to help you look after your new furry friend:\r\n1.Let your pet settle in\r\nNew pets may feel scared or shy at first. Give them time to get used to their new home.\r\n2.Provide the right food\r\nFeed your pet healthy food and clean water. Ask a vet which food is best for your pet’s age and breed.\r\n3.Take them to the vet\r\nA health checkup is important. Your pet needs vaccinations to stay safe from diseases.\r\n4.Keep them clean\r\nBrush their fur regularly, give baths when needed, and clean their sleeping area.\r\n5.Give love and attention\r\nPlay with your pet every day. This helps you become close and keeps your pet happy.\r\n6.Taking care of a pet means being kind, responsible, and loving every day.\r\n\r\n', '2025-07-21 17:12:27', '/PetSpot_clinic/public/uploads/1753098512_Sign Petition_ Justice for 11 Puppies Discarded Like Trash in a Dumpster.jpg', 1, 1, '2025-07-21 17:27:22'),
(18, NULL, 'Why Pet Vaccinations Are Important', 'Vaccinating your pet is one of the most important things you can do to keep it healthy. Here’s why:\r\n\r\nProtects from diseases\r\nVaccines prevent serious illnesses like rabies, parvovirus, and distemper.\r\n\r\nKeeps other pets safe\r\nWhen your pet is healthy, it won’t spread diseases to other animals.\r\n\r\nSaves money in the long run\r\nTreating a sick pet can be very expensive. Vaccination costs much less.\r\n\r\nRequired for travel and grooming\r\nSome services will only accept vaccinated pets.\r\n\r\nGives peace of mind\r\nKnowing your pet is protected helps you worry less.', '2025-07-21 17:29:59', '/PetSpot_clinic/public/uploads/1753099199_download (9).jpg', 1, 1, NULL),
(19, 6, 'Common Signs That Your Pet Is Sick', 'Pets can’t talk, but their behavior can tell you a lot. If your pet stops eating, seems tired all the time, throws up, or has diarrhea, it could be a sign of illness. Other warning signs include sneezing, coughing, limping, or any unusual behavior. If you notice anything different, it’s best to visit the vet early to avoid serious problems.', '2025-07-27 09:20:48', '/PetSpot_clinic/public/uploads/1753588248_j.jpg', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_type` enum('user','staff') NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `receiver_type` enum('user','staff') NOT NULL,
  `message` text NOT NULL,
  `sent_at` datetime DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `sender_id`, `sender_type`, `receiver_id`, `receiver_type`, `message`, `sent_at`, `is_read`) VALUES
(1, 6, 'user', 10, 'staff', 'hy', '2025-06-11 22:45:45', 0),
(2, 6, 'user', 1, 'staff', 'hy', '2025-06-11 23:11:35', 0),
(3, 6, 'user', 10, 'staff', 'v', '2025-06-11 23:21:49', 0),
(4, 6, 'user', 10, 'staff', 'hi', '2025-06-11 23:32:07', 0),
(5, 6, 'user', 8, 'user', 'hi', '2025-06-11 23:34:52', 0),
(7, 3, 'user', 6, 'staff', 'hyyyyy', '2025-06-11 23:58:49', 0),
(8, 6, 'staff', 10, 'staff', 'ayyyeeeee', '2025-06-12 00:00:08', 0),
(9, 6, 'user', 10, 'staff', 'now', '2025-06-12 00:01:44', 0),
(10, 6, 'user', 10, 'staff', 'nowwwwww', '2025-06-12 00:03:05', 0),
(11, 6, 'user', 5, 'staff', 'hy', '2025-06-12 00:08:58', 0),
(12, 6, 'user', 9, 'staff', 'hyyy', '2025-06-12 00:09:38', 0),
(14, 6, 'user', 12, 'user', 'can you tell more details about your found pet', '2025-06-12 22:39:55', 1),
(15, 6, 'user', 16, 'user', 'can i know about your found pet', '2025-06-12 23:21:02', 0),
(16, 6, 'user', 5, 'staff', 'can i know yersetady reported found pet', '2025-06-13 07:53:31', 0),
(17, 6, 'user', 17, 'user', 'can i know about found pet', '2025-06-13 08:40:57', 0),
(18, 17, 'user', 5, 'staff', 'can i know about found pet', '2025-06-13 08:42:25', 0),
(19, 16, 'user', 12, 'user', 'hiii', '2025-07-05 07:56:47', 0),
(20, 16, 'user', 12, 'user', 'hii', '2025-07-05 07:56:53', 0),
(21, 16, 'user', 12, 'user', 'hii', '2025-07-05 07:58:37', 0),
(22, 16, 'user', 12, 'user', 'hiii', '2025-07-05 08:02:27', 0),
(23, 12, 'user', 16, 'user', 'hi', '2025-07-05 08:03:44', 0),
(24, 16, 'user', 16, 'user', 'can', '2025-07-05 08:05:04', 0),
(25, 12, 'user', 16, 'user', 'cannn', '2025-07-05 08:05:22', 0),
(26, 16, 'user', 12, 'user', 'hi', '2025-07-05 08:23:34', 0),
(27, 16, 'user', 5, 'staff', 'hi sir', '2025-07-05 08:23:47', 0),
(28, 12, 'user', 5, 'staff', 'how to contact clinic', '2025-07-05 08:30:19', 0),
(29, 12, 'user', 5, 'staff', 'hi', '2025-07-05 08:45:56', 0),
(30, 12, 'user', 16, 'user', 'can i know about your lost pet', '2025-07-06 08:47:45', 0),
(31, 12, 'user', 16, 'user', 'hi', '2025-07-06 08:48:06', 0),
(32, 16, 'user', 5, 'staff', 'hi', '2025-07-06 08:49:46', 0),
(33, 16, 'user', 12, 'user', 'yes', '2025-07-06 08:50:41', 0),
(34, 16, 'user', 16, 'user', 'hi', '2025-07-06 08:56:41', 0),
(35, 12, 'user', 16, 'user', 'hii', '2025-07-06 08:57:05', 0),
(36, 12, 'user', 11, 'staff', 'hi', '2025-07-06 09:00:24', 0),
(37, 12, 'user', 1, 'staff', 'hii', '2025-07-06 09:02:33', 0),
(38, 12, 'user', 5, 'staff', 'hello sir', '2025-07-06 09:06:09', 0),
(39, 5, 'staff', 16, 'user', 'yes', '2025-07-06 09:13:35', 0),
(40, 5, 'staff', 16, 'user', 'yes', '2025-07-06 12:47:36', 0),
(41, 16, 'user', 5, 'staff', 'can i know process of adopting a pet', '2025-07-06 12:48:16', 0),
(42, 12, 'user', 16, 'user', 'helow', '2025-07-08 09:52:00', 0),
(43, 16, 'user', 12, 'user', 'yes', '2025-07-08 09:52:37', 0),
(44, 12, 'user', 16, 'user', 'hii', '2025-07-08 09:58:52', 0),
(45, 16, 'user', 7, 'staff', 'hi', '2025-07-08 09:59:44', 0),
(46, 16, 'user', 12, 'user', 'n', '2025-07-08 10:16:30', 0),
(47, 12, 'user', 16, 'user', 'n', '2025-07-08 10:46:31', 0),
(48, 12, 'user', 16, 'user', 'kk', '2025-07-08 10:58:54', 0),
(49, 16, 'user', 12, 'user', 'yus', '2025-07-08 11:00:29', 0),
(50, 6, 'user', 13, 'user', 'hi', '2025-07-10 11:38:23', 0),
(51, 6, 'user', 16, 'user', 'hi', '2025-07-14 13:33:10', 0),
(52, 6, 'user', 16, 'user', 'hi', '2025-07-14 13:35:33', 0),
(53, 6, 'user', 16, 'user', 'hi', '2025-07-14 13:35:45', 0),
(54, 16, 'user', 10, 'staff', 'hi', '2025-07-14 13:37:04', 0),
(55, 16, 'user', 10, 'staff', 'hi', '2025-07-14 13:37:19', 0),
(56, 6, 'user', 12, 'user', 'hi', '2025-07-14 14:16:22', 1),
(57, 12, 'user', 16, 'user', 'hiiii', '2025-07-14 14:16:46', 0),
(58, 12, 'user', 16, 'user', 'may be', '2025-07-14 14:22:02', 0),
(59, 12, 'user', 16, 'user', 'hey', '2025-07-14 14:28:29', 0),
(60, 16, 'user', 12, 'user', 'yus', '2025-07-14 14:31:03', 0),
(61, 16, 'user', 12, 'user', 'hi', '2025-07-14 14:33:19', 0),
(62, 16, 'user', 12, 'user', 'ji', '2025-07-14 14:39:04', 0),
(63, 16, 'user', 10, 'staff', 'hi', '2025-07-14 14:39:11', 0),
(64, 16, 'user', 10, 'staff', 'hi', '2025-07-14 14:42:30', 0),
(65, 16, 'user', 7, 'staff', 'hi', '2025-07-14 14:44:46', 0),
(66, 16, 'user', 8, 'staff', 'hiii', '2025-07-14 14:45:28', 0),
(67, 16, 'user', 8, 'staff', 'hii', '2025-07-14 14:48:44', 0),
(68, 16, 'user', 8, 'staff', 'hi', '2025-07-14 14:50:23', 0),
(69, 16, 'user', 11, 'staff', 'hii', '2025-07-14 15:01:11', 0),
(70, 16, 'user', 11, 'staff', 'hii', '2025-07-14 15:02:08', 0),
(71, 16, 'user', 11, 'staff', 'hii', '2025-07-14 15:06:26', 0),
(72, 16, 'user', 11, 'staff', 'hi', '2025-07-14 15:07:06', 0),
(73, 16, 'user', 11, 'staff', 'hi', '2025-07-14 15:09:01', 0),
(74, 16, 'user', 11, 'staff', 'hiiiii', '2025-07-14 15:10:12', 0),
(75, 16, 'user', 8, 'staff', 'hi', '2025-07-14 15:10:30', 0),
(76, 12, 'user', 14, 'user', 'hi', '2025-07-14 15:15:14', 0),
(77, 12, 'user', 14, 'user', 'ji', '2025-07-14 15:17:45', 0),
(78, 12, 'user', 8, 'staff', 'hi', '2025-07-14 15:17:59', 0),
(79, 12, 'user', 12, 'user', 'ji', '2025-07-14 15:19:53', 0),
(80, 12, 'user', 10, 'staff', 'k', '2025-07-14 15:20:38', 0),
(81, 12, 'user', 16, 'user', 'hii', '2025-07-14 15:22:33', 0),
(82, 12, 'user', 16, 'user', 'kk', '2025-07-14 15:23:14', 0),
(83, 16, 'user', 13, 'user', 'hii', '2025-07-14 15:26:44', 0),
(84, 16, 'user', 13, 'user', 'hii', '2025-07-14 15:28:37', 0),
(85, 16, 'user', 9, 'staff', 'k', '2025-07-14 15:29:00', 0),
(86, 16, 'user', 12, 'user', 'l', '2025-07-14 15:32:14', 0),
(87, 16, 'user', 12, 'user', 'j', '2025-07-14 15:37:15', 0),
(88, 16, 'user', 12, 'user', 'k', '2025-07-14 15:37:30', 0),
(89, 16, 'user', 9, 'staff', 'hii', '2025-07-14 15:39:25', 0),
(90, 16, 'user', 13, 'user', 'hiiiiii', '2025-07-14 15:41:00', 0),
(91, 16, 'user', 13, 'user', 'kkk', '2025-07-14 15:42:34', 0),
(92, 12, 'user', 16, 'user', 'h', '2025-07-14 15:43:44', 0),
(93, 16, 'user', 15, 'user', 'hi', '2025-07-14 15:47:23', 0),
(94, 16, 'user', 15, 'user', 'j', '2025-07-14 15:49:08', 0),
(95, 16, 'user', 13, 'user', 'l', '2025-07-14 15:49:18', 0),
(96, 16, 'user', 13, 'user', 'h', '2025-07-14 15:51:26', 0),
(97, 16, 'user', 13, 'user', 'ji', '2025-07-14 15:56:04', 0),
(98, 16, 'user', 12, 'user', 'k', '2025-07-14 15:56:26', 0),
(99, 12, 'user', 16, 'user', 'kk', '2025-07-14 15:59:52', 0),
(100, 12, 'user', 11, 'user', 'k', '2025-07-14 16:00:03', 0),
(101, 12, 'user', 11, 'staff', 'ji', '2025-07-14 16:00:25', 0),
(102, 6, 'user', 1, 'staff', 'hey', '2025-07-14 16:07:24', 0),
(103, 6, 'user', 12, 'user', 'hiiiiii', '2025-07-14 17:26:49', 1),
(104, 6, 'user', 11, 'user', 'h', '2025-07-14 17:29:55', 0),
(105, 12, 'user', 16, 'user', 'can i know about your found pet', '2025-07-14 17:30:26', 0),
(106, 16, 'user', 6, 'user', 'hiii', '2025-07-14 17:38:37', 1),
(107, 12, 'user', 6, 'user', 'hii', '2025-07-14 17:38:58', 1),
(108, 12, 'user', 6, 'user', 'i have found a lost pet similar to yours', '2025-07-14 17:47:13', 1),
(109, 12, 'user', 6, 'user', 'hey', '2025-07-14 17:52:39', 1),
(110, 12, 'user', 6, 'user', 'hey there', '2025-07-14 17:58:10', 1),
(111, 12, 'user', 12, 'user', 'hey', '2025-07-14 18:39:46', 0),
(112, 12, 'user', 6, 'user', 'hii', '2025-07-14 18:41:15', 1),
(113, 12, 'user', 6, 'user', 'hiii', '2025-07-14 19:00:39', 1),
(114, 12, 'user', 6, 'user', 'mj', '2025-07-14 19:09:33', 1),
(115, 6, 'user', 12, 'user', 'can i know about lost pet', '2025-07-20 20:59:25', 1),
(116, 6, 'user', 12, 'user', 'hii', '2025-07-20 21:18:31', 1),
(117, 12, 'user', 6, 'user', 'yus', '2025-07-20 21:19:29', 1),
(118, 6, 'user', 12, 'user', 'hi', '2025-07-20 21:24:59', 1),
(119, 6, 'user', 12, 'user', 'hi', '2025-07-20 21:37:03', 1),
(120, 6, 'user', 12, 'user', 'hey', '2025-07-20 22:05:08', 1),
(121, 12, 'user', 6, 'user', 'can i', '2025-07-20 22:08:41', 1),
(122, 12, 'user', 6, 'user', 'h', '2025-07-20 22:12:38', 1),
(123, 12, 'user', 6, 'user', 'n', '2025-07-20 22:16:56', 1),
(124, 12, 'user', 6, 'user', 'hii', '2025-07-22 12:17:53', 1),
(125, 12, 'user', 6, 'user', 'hey', '2025-07-22 12:31:07', 1),
(126, 12, 'user', 6, 'user', 'can i know about the found pet you reported.', '2025-07-22 12:38:09', 1),
(127, 12, 'user', 6, 'user', 'hey', '2025-07-28 23:39:46', 1),
(128, 12, 'user', 6, 'user', 'can i know your reported found pet?', '2025-08-05 12:44:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `subject` varchar(255) DEFAULT NULL,
  `replied` tinyint(1) DEFAULT 0,
  `reply_message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`, `subject`, `replied`, `reply_message`) VALUES
(1, 'chama PC', 'chamathkasathruwani@gmail.com', 'nnnn', '2025-06-11 06:24:57', NULL, 0, NULL),
(2, 'chamathka', 'chamathkasathruwani@gmail.com', 'do you open today', '2025-06-12 08:24:32', NULL, 0, NULL),
(3, 'chamathka', 'chamathkasathruwani@gmail.com', 'how can i book appoinmnt', '2025-06-12 15:26:32', NULL, 1, 'try book appointmnt through website.if not call us'),
(4, 'chamathka', 'chamathkasathruwani@gmail.com', 'how to get vaccinations', '2025-06-12 16:56:23', NULL, 1, 'visit clinic.Contact for more information');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `rate` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `confirmed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_ID`, `rate`, `comment`, `created_at`, `confirmed`) VALUES
(5, 3, 4, 'Amazing service! The staff was so kind and caring with my pet. The vet explained everything clearly, and my dog felt comfortable. Thank you for the great care! 🐾💖', '2025-05-29 12:08:31', 1),
(9, 6, 5, 'better service', '2025-06-12 13:53:24', 1),
(10, 12, 5, 'very good', '2025-06-12 20:44:18', 0),
(11, 12, 5, 'service is good', '2025-06-12 20:51:24', 0),
(12, 13, 4, 'Service is good', '2025-06-12 20:55:30', 0),
(13, 14, 5, 'Very good service', '2025-06-12 22:24:52', 0),
(15, 16, 4, 'happy expirence', '2025-06-12 23:22:24', 0),
(17, 6, 2, '', '2025-07-26 13:09:42', 0),
(18, 6, 1, '', '2025-07-26 13:16:07', 0),
(19, 6, 2, '', '2025-07-26 13:35:02', 0),
(20, 6, 1, '', '2025-07-29 18:03:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `found_pets`
--

CREATE TABLE `found_pets` (
  `found_ID` int(11) NOT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `special_markings` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `found_date` date DEFAULT NULL,
  `reporter_email` varchar(100) DEFAULT NULL,
  `found_location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(50) DEFAULT NULL,
  `breed` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Unclaimed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `found_pets`
--

INSERT INTO `found_pets` (`found_ID`, `user_ID`, `color`, `special_markings`, `image_url`, `found_date`, `reporter_email`, `found_location`, `created_at`, `type`, `breed`, `gender`, `status`) VALUES
(3, 3, 'white', 'one eye is blue other is yellow', '/PetSpot_clinic/app/uploads/pure-white-cat-with-odd-eyes-royalty-free-image-1730126125.avif', '2025-05-26', 'Manager@gmail.com', NULL, '2025-05-27 18:05:18', 'cat', 'persian', 'male', 'Unclaimed'),
(22, 7, 'white', 'none', '/PetSpot_clinic/app/uploads/OIP (4).jpg', '2025-06-02', 'sasankavirajith@gmail.com', 'palagama', '2025-06-03 16:14:00', 'dog', 'lily', 'Male', 'Unclaimed'),
(29, 7, 'black,white,brown', 'black white and brown patches', '/PetSpot_clinic/app/uploads/OIP (5).jpg', '2025-06-07', 'chamathkasathruwani@gmail.com', 'piliyandala', '2025-06-06 19:03:32', 'cat', 'x', 'Male', 'Adopted'),
(42, 3, 'White,grey,black', 'black line in body ', '/PetSpot_clinic/app/uploads/OIP (6).jpg', '2025-06-13', 'sasankavirajith@gmail.com', 'piliyandala', '2025-06-12 04:18:38', 'cat', 'persian', 'Male', 'Adopted'),
(43, 6, 'black', '', '/PetSpot_clinic/app/uploads/LABRADO NEGRO.jpg', '2025-06-12', 'chamathkasathruwani@gmail.com', 'near children park', '2025-06-12 04:37:40', 'dog', 'labrado', 'Male', 'Unclaimed'),
(44, 6, 'black and white', 'small scar on left ear', '/PetSpot_clinic/app/uploads/download (11).jpg', '2025-05-28', NULL, 'example_location', '2025-05-28 04:30:00', 'dog', 'bulldog', 'female', 'Unclaimed'),
(51, 12, 'white', 'dd', '/PetSpot_clinic/app/uploads/b6.jpg', '2025-06-12', 'Addy@gmail.com', 'near bus stand piliyandala', '2025-06-12 17:04:36', 'dog', 'lily', 'Male', 'Unclaimed'),
(53, 16, 'black and white', 'black spots in body', '/PetSpot_clinic/app/uploads/French Bulldog _ Dog Breed Facts and Information - Wag! (1).jpg', '2025-06-12', 'chanali@gmail.com', 'near bellnwila park', '2025-06-12 17:41:51', 'dog', 'bull', 'Female', 'Unclaimed'),
(54, 7, 'black and white', 'small scar on left ear', '/PetSpot_clinic/app/uploads/OIP (4).jpg', '2025-05-27', 'sasankavirajith@gmail.com', 'example_location', '2025-05-28 04:30:00', 'dog', 'bulldog', 'Male', 'Adopted'),
(55, 12, 'white', 'yellow eyes', '/PetSpot_clinic/app/uploads/cat2.jpg', '2025-06-14', 'Addy@gmail.com', 'park', '2025-06-13 02:20:37', 'cat', 'persian', 'Male', 'Unclaimed'),
(56, 17, 'black', 'blue eyes', '/PetSpot_clinic/app/uploads/cat4.jpg', '2025-06-14', 'shehara@gmail.com', 'temple', '2025-06-13 03:03:16', 'cat', 'persian', 'Female', 'Unclaimed'),
(57, 18, 'black', 'yellow eyes', '/PetSpot_clinic/app/uploads/cat8.jpg', '2025-06-14', 'Amali@gmail.com', 'temple', '2025-06-13 06:27:43', 'cat', 'persian', 'Female', 'Adopted'),
(60, 6, 'white', '', '/PetSpot_clinic/app/uploads/hh.webp', '2025-07-26', NULL, 'near bus stop in araliya junction', '2025-07-26 07:03:05', 'Dog', 'labrado', 'Male', 'Unclaimed'),
(62, 12, 'black', 'wound near ear', '/PetSpot_clinic/app/uploads/cat8.jpg', '2025-07-30', 'Addy@gmail.com', 'near temple pliyandala', '2025-07-31 06:22:46', 'cat', 'persian', 'Female', 'Unclaimed');

-- --------------------------------------------------------

--
-- Table structure for table `health_records`
--

CREATE TABLE `health_records` (
  `health_record_ID` int(11) NOT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `height` varchar(50) DEFAULT NULL,
  `current_health_status` varchar(255) DEFAULT NULL,
  `reactions_to_vaccines_before` varchar(255) DEFAULT NULL,
  `Allergies` varchar(255) DEFAULT NULL,
  `Health_check_date` date DEFAULT NULL,
  `Note` text DEFAULT NULL,
  `Previous_illness` varchar(255) DEFAULT NULL,
  `vaccination_ID` int(11) DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `pet_ID` int(11) DEFAULT NULL,
  `Veterinarian_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `health_records`
--

INSERT INTO `health_records` (`health_record_ID`, `weight`, `height`, `current_health_status`, `reactions_to_vaccines_before`, `Allergies`, `Health_check_date`, `Note`, `Previous_illness`, `vaccination_ID`, `user_ID`, `pet_ID`, `Veterinarian_ID`) VALUES
(3, '5kg', '15', 'Medium', 'no reaction .good health', 'no allergies', '2025-06-09', 'should check again in one week', 'high fever', NULL, 6, 29, 6),
(6, '2kg', '12', 'bad', 'nothing', '', '2025-06-10', 'Need to check again in 3 months', 'ffff', NULL, 6, 35, 10),
(7, '', '12', 'good', 'nothing', 'none', '2025-06-12', 'good  health', 'cancer cells in tummy', NULL, 6, 35, 6),
(8, '5kg', '2', 'good', 'show some allergies', 'red eyes', '2025-06-12', '', '', NULL, 6, 29, 10),
(9, '2kg', '4', 'pet is better condition', 'no reactions', 'show some allergies when eat sugary things', '2025-07-27', 'Dont give sugary things to this pet', 'did a operation ', NULL, 6, 29, 6),
(10, '2kg', '4', 'pet is better condition', 'no reactions', 'show some allergies when eat sugary things', '2025-07-27', '', 'did a operation ', NULL, 6, 46, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `pet_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `breed` varchar(50) DEFAULT NULL,
  `date_registered` datetime DEFAULT current_timestamp(),
  `special_markings` varchar(255) DEFAULT NULL,
  `status` enum('active','lost') DEFAULT 'active',
  `last_seen_location` varchar(100) DEFAULT NULL,
  `last_seen_date` date DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `special_note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`pet_ID`, `user_ID`, `name`, `type`, `color`, `gender`, `breed`, `date_registered`, `special_markings`, `status`, `last_seen_location`, `last_seen_date`, `image_url`, `special_note`) VALUES
(18, 3, 'kittyh', 'cat', 'black', 'female', 'vg', '2025-05-26 15:57:07', 'black pot in nose', 'active', '', NULL, NULL, NULL),
(23, 3, 'bellaaaaaaa', 'cat', 'black', 'female', 'vg', '2025-05-26 17:21:24', 'black pot in nose,grey color', 'active', 'near dehiwala', '2025-05-15', '/PetSpot_clinic/app/uploads/OIP (1).jpg', ''),
(26, 3, 'bbbbb', 'hh', 'bb', 'nn', 'nn', '2025-05-27 22:47:48', 'bb', 'active', '', NULL, '/PetSpot_clinic/app/uploads/beautiful-pet-portrait-small-dog-cat.jpg', NULL),
(28, 3, 'pretty', 'cat', 'black and white', 'female', 'persian', '2025-05-28 16:41:43', 'dd', 'lost', 'dd', '2025-05-01', '/PetSpot_clinic/app/uploads/OIP.jpg', ''),
(29, 6, 'leo', 'dog', 'black', 'female', '', '2025-05-28 19:48:29', 'has a white line in center of face', 'active', 'colombo', '2025-05-28', '/PetSpot_clinic/app/uploads/OIF.jpg', ''),
(31, 5, 'shangy', 'dog', 'grey and white', 'male', 'cc', '2025-05-28 23:01:07', 'white mark above nose', 'lost', 'dehiwala', '2025-05-27', '/PetSpot_clinic/app/uploads/OIP (3).jpg', 'nothing'),
(32, 7, 'lily', 'dog', 'white', 'male', 'lily', '2025-06-03 21:42:09', '', 'lost', 'at home 59,palagama,polgasowita', '2025-06-02', '/PetSpot_clinic/app/uploads/OIP (4).jpg', ''),
(33, 6, 'sheyli', 'dog', 'white', 'male', 'lily', '2025-06-03 22:08:08', 'have a black mark on nose', 'active', 'near bus stand piliyandala', '2025-06-12', '/PetSpot_clinic/app/uploads/OIP (4).jpg', ''),
(34, 7, 'bell', 'cat', 'brown,black,white', 'male', '', '2025-06-07 00:31:56', 'black white and brown patches', 'lost', 'near home', '2025-06-07', '/PetSpot_clinic/app/uploads/OIP (5).jpg', 'ffff'),
(35, 6, 'ally', 'cat', 'White,grey,black', 'male', 'persian', '2025-06-09 00:06:42', 'has black lines in body,brown circle patch in around nose', 'lost', 'near house', '2025-06-12', '/PetSpot_clinic/app/uploads/OIP (6).jpg', ''),
(40, 12, 'Tommy', 'Dog', 'black and white', 'female', 'husky', '2025-06-12 20:42:29', 'one eye is blue and other is yellow', 'active', NULL, NULL, '/PetSpot_clinic/app/uploads/download (13).jpg', NULL),
(41, 13, 'Tommy', 'Dog', 'white and brown', 'female', 'husky', '2025-06-12 20:54:57', 'one eye is blue other is yellow', 'active', NULL, NULL, '/PetSpot_clinic/app/uploads/download (13).jpg', NULL),
(42, 14, 'Tom', 'dog', 'white', 'male', 'pomenarian', '2025-06-12 22:23:51', 'none', 'active', NULL, NULL, '/PetSpot_clinic/app/uploads/b6.jpg', NULL),
(44, 6, 'blacky', 'dog', 'black and white', 'female', 'bull ', '2025-06-12 23:09:37', 'have black spots in body', 'lost', 'near bellanwila park', '2025-06-12', '/PetSpot_clinic/app/uploads/French Bulldog _ Dog Breed Facts and Information - Wag! (1).jpg', ''),
(45, 6, 'Lucy', 'cat', 'white', 'male', 'persian', '2025-06-13 07:48:25', 'yellow eyes', 'lost', 'near park', '2025-06-13', '/PetSpot_clinic/app/uploads/cat2.jpg', ''),
(46, 6, 'lily', 'cat', 'black', 'female', 'persian', '2025-06-13 08:31:21', 'blue eyes', 'active', 'near temple', '2025-06-13', '/PetSpot_clinic/app/uploads/cat4.jpg', ''),
(47, 6, 'Lucy', 'cat', 'black', 'female', 'persian', '2025-06-13 11:55:07', 'yellow eyes', 'lost', 'near pliyandala temple', '2025-07-30', '/PetSpot_clinic/app/uploads/cat8.jpg', 'Had a wound near ear');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `prescription_ID` int(11) NOT NULL,
  `pet_ID` int(11) NOT NULL,
  `medicines` varchar(255) NOT NULL,
  `drink_times` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `user_ID` int(11) NOT NULL,
  `staff_ID` int(11) DEFAULT NULL,
  `appointment_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`prescription_ID`, `pet_ID`, `medicines`, `drink_times`, `note`, `user_ID`, `staff_ID`, `appointment_ID`) VALUES
(1, 33, 'dd', ' two time a day', 'hhhhh', 6, 6, NULL),
(2, 33, '[{\"medicine\":\"dd\",\"drink_time\":\" two time a day\"}]', '', 'hhhhh', 6, 6, NULL),
(3, 33, '[{\"medicine\":\"dd\",\"drink_time\":\"dd\"},{\"medicine\":\"ff\",\"drink_time\":\"ff\"}]', '', 'dd', 6, 6, NULL),
(4, 28, '[{\"medicine\":\"s\",\"drink_time\":\"1\"}]', '', '', 3, 6, NULL),
(5, 29, '[{\"medicine\":\"dd\",\"drink_time\":\"5\"}]', '', '', 6, 6, NULL),
(6, 29, '[{\"medicine\":\"xxx\",\"drink_time\":\"two times a day\"}]', '', '', 6, 6, NULL),
(10, 33, '[{\"medicine\":\"ggg\",\"drink_time\":\"5\"}]', '', '', 6, 6, 51),
(11, 35, '[{\"medicine\":\"dd\",\"drink_time\":\"4\"}]', '', '', 6, 6, NULL),
(13, 33, '[{\"medicine\":\"panadol\",\"drink_time\":\"2 times a day\"},{\"medicine\":\"dextamethason\",\"drink_time\":\"1 time a day\"}]', '', '', 6, 10, NULL),
(14, 33, '[{\"medicine\":\"panadol\",\"drink_time\":\"2 times a day\"},{\"medicine\":\"dextamethason\",\"drink_time\":\"1 time a day\"}]', '', '', 6, 10, NULL),
(16, 29, '[{\"medicine\":\"nnnnnn\",\"drink_time\":\"2\"}]', '', 'ddd', 6, 10, 48),
(17, 29, '[{\"medicine\":\"nnnnn\",\"drink_time\":\"4\"},{\"medicine\":\"fff\",\"drink_time\":\"5\"}]', '', '', 6, 10, NULL),
(18, 29, '[{\"medicine\":\"nnnnn\",\"drink_time\":\"44\"}]', '', '', 6, 10, NULL),
(20, 35, '[{\"medicine\":\"nnnnnn\",\"drink_time\":\"1\"}]', '', 'new', 6, 10, 56),
(23, 35, '[{\"medicine\":\"v\",\"drink_time\":\"4\"}]', '', '', 6, 10, 56),
(26, 29, '[{\"medicine\":\"panadol\",\"dosage\":\"5mg\",\"drink_time\":\"2 times a day\"}]', '', '', 6, 10, 76),
(27, 44, '[{\"medicine\":\"piriton\",\"dosage\":\"5mg\",\"drink_time\":\"1 time a day\"}]', '', '', 6, 10, NULL),
(28, 44, '[{\"medicine\":\"dd\",\"dosage\":\"10\",\"drink_time\":\"2\"}]', '', '', 6, 10, NULL),
(29, 46, '[{\"medicine\":\"panadol\",\"dosage\":\"5mg\",\"drink_time\":\"2 times a day\"}]', '', '', 6, 10, 80),
(30, 29, '[{\"medicine\":\"panadol\",\"dosage\":\"5mg\",\"drink_time\":\"3 times a day\"}]', '', '', 6, 10, 82),
(32, 40, '[{\"medicine\":\"Dextamethason\",\"dosage\":\"5mg\",\"drink_time\":\"2 times a day after meal\"}]', '', '', 12, 10, 83),
(33, 40, '[{\"medicine\":\"Allemine\",\"dosage\":\"2mg\",\"drink_time\":\"one time a day\"}]', '', '', 12, 10, 84),
(34, 40, '[{\"medicine\":\"Dextamethason\",\"dosage\":\"10mg\",\"drink_time\":\"one time a day\"}]', '', 'give medicines on time', 12, 10, 90),
(35, 40, '[{\"medicine\":\"Dextamethason\",\"dosage\":\"10mg\",\"drink_time\":\"morning and night after meal\"}]', '', '', 12, 10, 91),
(36, 40, '[{\"medicine\":\"Allemine\",\"dosage\":\"10mg\",\"drink_time\":\"morning and night after meal\"}]', '', 'Dont give sugar things to pet.give medicines on time', 12, 10, 92),
(37, 40, '[{\"medicine\":\"Asprin\",\"dosage\":\"2mg\",\"drink_time\":\"one time a day\"}]', '', '', 12, 10, 93);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `username` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `NIC` varchar(20) DEFAULT NULL,
  `staff_id` int(11) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`username`, `role`, `email`, `contact`, `password`, `NIC`, `staff_id`, `reset_token`, `reset_token_expiry`) VALUES
('vgh', 'staff', 'v@gmail.com', '0124569874', '$2y$10$fayBAgFQm/GgD5PhahfpM.O7wd0ikVl38JP9I1fsGoihLR7o9gbua', '266788976766', 3, NULL, NULL),
('Shayamal', 'Manager', 'Manager@gmail.com', '0758966325', '$2y$10$HJuDTgclaeeuoyQNSciil.OPIjGkCYjA9wQOsTsDS5LVf6RC9My46', '200566857741', 5, NULL, NULL),
('Nalin', 'Vet Staff', 'v1@gmail.com', '0725559874', '$2y$10$jReK9PNaPbWBulYpj8Unv.jKrXIuCKUsXnV80nXKb1b8uYFH.rnbW', '200455698274', 6, NULL, NULL),
('DR.M.C.S.jayasinghe', 'vetenarian', 'Doctor1@gmail.com', '0745698247', '$2y$10$iDT.PL/zCD8a589rRAvha.iTHM5lfC6aDAT.LOojOdmMULmqw.asO', '200366985214', 7, NULL, NULL),
('Kamal', 'Pharmacist', 'pharmacist@gmail.com', '0123658999', '$2y$10$NrJqF0rO5YhJrpgSAXnoOO70O4jH60ymvbfus9OF5mzTsMDqkrb/m', '200155648877', 8, NULL, NULL),
('Yasasmi', 'Vet Staff', 'v2@gmail.com', '0745569874', '$2y$10$MuBc8eMhyFhvXmWaQPWTQeLU8Fqj1nYgADrK2R61kUdCv50unHwyi', '200455698566', 9, NULL, NULL),
('Veteranarian', 'Veterinarian', 'vet1@gmail.com', '0775678908', '$2y$10$96togT38WXwwXKmytbluvuKAFJGkFRt0jj4MUJeYnZab9k9n/TIuS', '200163400897', 10, 'ce3fdc9cb73adeabae7877f95c0d7a27b06926d7c24babe9fff715e0333dea36', '2025-06-10 16:03:24'),
('Dr.Srimal', 'Veterinarian', 'Doctor2@gmail.com', '0112569874', '$2y$10$zu6DWC5AA8u01cjeNrwCduwKTqNtEa1F6LEDClkRzsJfkXtRJ29Te', '200365871411', 11, NULL, NULL),
('W.M.Ravendra', 'Veterinarian', 'vet4@gmail.com', '0147856987', '$2y$10$/ZIqHlgL2LpPBQ8iU5Fk6.2El8trbZSQtvUhwbXdxXZt356hy5M3C', '200988765433', 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `fullname`, `username`, `address`, `email`, `contact`, `password`, `created_at`, `reset_token`, `reset_token_expiry`) VALUES
(2, 'cham', 'cham', 'N0,30,piliyandala', 'cham@gmail.com', '04555555555', '$2y$10$krflcxs4jJsnSYgf8SQB1.FdW/ufXiNizZHHKA3ccUi3n6C5mbpJu', '2025-05-21 06:24:01', NULL, NULL),
(3, 'sasanka Virajith jayasuriya', 'sasanka', '59,palagama.polgasowita', 'sasankavirajith@gmail.com', '0714445469', '$2y$10$7glBB2ane9qBnUhxCZe0Mu7Y7r0jTVLsKsWaBl0KR9XWenHd3U3wC', '2025-05-21 06:43:23', NULL, NULL),
(5, 'Geeradha', 'gee', 'Negombo', 'Geeradha@gmail.com', '0124569888', '$2y$10$RI6cVKgKGaF8bOAfi3An/.yiDAG62qlT6fX6oPsmIR8LAmXH92bGK', '2025-05-26 10:12:51', NULL, NULL),
(6, 'chamathka sathruwani jayasuriya', 'chamathka', '23', 'chamathkasathruwani@gmail.com', '0702175976', '$2y$10$B83S/KFpZsLupL3.Gw5Pq.4mMMMrNL52XCjnQ0PtAaQZ.Z7sSDZhm', '2025-05-28 11:18:59', '9b7377734d19ba2b5faa60a2ad031072718448e394892af6730101b386feb26e', '2025-08-05 10:53:47'),
(7, 'me', 'mes', '59,palagama.polgasowita', 'sasankavirajith3@gmail.com', '0124569874', '$2y$10$Nl8.Y/3iHDYCFSZUnEKckeTtpJjS4Ikm23U6obUwgQGNh2SLXvsya', '2025-06-03 16:08:43', NULL, NULL),
(8, 'ishara poojani', 'poojani', '79,palagama.polgasowita', 'isharapoojani@gmail.com', '0745896652', '$2y$10$QfjiiHLNHbKxARqmdzfYRefsIbSTVF6XDgATZ6YaMDSTHKpcTY4ke', '2025-06-06 11:40:07', NULL, NULL),
(10, 'piyumi sewwandi', 'piyumi', '50,palagama', 'Piyumi@gmai.com', '07458986574', '$2y$10$GmdHT25b5xf8ESFc2y606urjLZ4d.FiYxkYJyhsq/A180peAyWk9q', '2025-06-12 14:54:55', NULL, NULL),
(11, 'sadini sathsaranai', 'sadini', 'No,45,piliyandala', 'sadini@gmail.com', '07458965412', '$2y$10$9oWrE3DqALVV81zZ45.1ze06tEPT3X7gubm5bzPPYfPr0EAup9GDy', '2025-06-12 14:57:43', NULL, NULL),
(12, 'Addy shenon', 'Addy', '45,piliyndala', 'Addy@gmail.com', '0745896325', '$2y$10$tJAIhUQyZ5FfqW/ZpmF43uryk/8cBFtxphJ28IDT9Y9qN9HHepePu', '2025-06-12 15:04:05', 'cb88cada163ecd57830b7c05987f3c9a29831b37b22872bfde68e2663f4cdfa3', '2025-06-12 17:34:26'),
(13, 'Vihansa sandepani', 'vihansa', 'No,60,piliyndala', 'Vihansa@gmail.com', '07458963258', '$2y$10$E3KwS9oGjKdTMvUggthcxOFudbjZdPUMMVDrEUj7IY6Pf3MHi017y', '2025-06-12 15:23:44', NULL, NULL),
(14, 'Hashini erandika', 'hasini', 'No,89,piliyandala', 'Hashini@gmail.com', '0745896325', '$2y$10$NEh6J.Kf452t9hMemcVh1O3ZXGqoUc/xLJ0rU6EfRJ8Kk/1czaBAm', '2025-06-12 16:52:23', NULL, NULL),
(15, 'hiruni nethmini', 'hiru', '12,palagama', 'hiru@gmail.com', '0745896325', '$2y$10$DHwdjFf7Ke9krYbq9RX37u/zKIrJdatNfHUH4zLDcSzOZLZiYxqdC', '2025-06-12 17:31:38', NULL, NULL),
(16, 'chanali dahamya', 'chanali', '56,palagama', 'chanali@gmail.com', '0745896532', '$2y$10$UxUd2XnTQquk9S63kQBbnuo5OUysmVbjylPgsf.NDkPj.6/05/HL6', '2025-06-12 17:38:27', NULL, NULL),
(17, 'shehara nimeshi', 'shehara', 'No,30,palagama', 'shehara@gmail.com', '0745896541', '$2y$10$TDLPweKsDPcCMDmmKmJMP.rJYWY2DvuMomjssGrTq7k0CI3KcSt.G', '2025-06-13 02:59:47', NULL, NULL),
(18, 'Amali jayasinghe', 'Amali', 'No,30,palagama,polgasowita', 'Amali@gmail.com', '0745698745', '$2y$10$OHR/udcVVF/s6N04l6RBEe0ZGaGpJbYVJA4D0MAylUrCUtjdOUnaK', '2025-06-13 06:24:09', NULL, NULL),
(19, 'ashen kumara', 'Ashen', 'No4,0,palagama,polgasowita', 'Asheni@gmail.com', '0745698740', '$2y$10$cTnUTIXDfE8v/eediSu3KuHQe.YoDgicUKVAfjeGiKZf82cKT79S.', '2025-07-10 05:08:31', NULL, NULL),
(20, 'rehan samarasinghe', 'rehan', '23', 'rehan@gmail.com', '0745698745', '$2y$10$ajYNeJ2Quk87mxFmFIYozebU7yJRtQsebZ3gzrnCJ9Oz54VqfcGOa', '2025-07-22 07:53:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vaccinations`
--

CREATE TABLE `vaccinations` (
  `vaccination_ID` int(11) NOT NULL,
  `pet_ID` int(11) NOT NULL,
  `vaccination_name` varchar(100) NOT NULL,
  `vaccination_type` varchar(100) DEFAULT NULL,
  `date_of_last_vaccine` date DEFAULT NULL,
  `next_due_date` date DEFAULT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccinations`
--

INSERT INTO `vaccinations` (`vaccination_ID`, `pet_ID`, `vaccination_name`, `vaccination_type`, `date_of_last_vaccine`, `next_due_date`, `user_ID`) VALUES
(25, 29, 'rabies', 'Inactivated virus vaccine', '2025-06-12', '2025-06-30', 6),
(26, 29, 'inactivates virus', 'to kill ', '2025-06-12', '2025-06-30', 6),
(30, 35, 'Distemper', 'For viral disease', '2025-06-29', '2025-07-07', 6),
(32, 47, 'Hepatititis', 'Adnovirous type', '2025-06-29', '2025-07-14', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `adoption_requests_ibfk_1` (`found_ID`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_ID`),
  ADD KEY `pet_ID` (`pet_ID`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_slot_id` (`slot_id`);

--
-- Indexes for table `available_slots`
--
ALTER TABLE `available_slots`
  ADD PRIMARY KEY (`slot_id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_ID`),
  ADD KEY `prescription_ID` (`prescription_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `found_pets`
--
ALTER TABLE `found_pets`
  ADD PRIMARY KEY (`found_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `health_records`
--
ALTER TABLE `health_records`
  ADD PRIMARY KEY (`health_record_ID`),
  ADD KEY `vaccination_ID` (`vaccination_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `pet_ID` (`pet_ID`),
  ADD KEY `Veterinarian_ID` (`Veterinarian_ID`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`pet_ID`),
  ADD KEY `id` (`user_ID`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`prescription_ID`),
  ADD KEY `pet_ID` (`pet_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `staff_ID` (`staff_ID`),
  ADD KEY `appointment_ID` (`appointment_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD PRIMARY KEY (`vaccination_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `fk_vaccinations_pet` (`pet_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `available_slots`
--
ALTER TABLE `available_slots`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `found_pets`
--
ALTER TABLE `found_pets`
  MODIFY `found_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `health_records`
--
ALTER TABLE `health_records`
  MODIFY `health_record_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `pet_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `prescription_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `vaccinations`
--
ALTER TABLE `vaccinations`
  MODIFY `vaccination_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD CONSTRAINT `adoption_requests_ibfk_1` FOREIGN KEY (`found_ID`) REFERENCES `found_pets` (`found_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `adoption_requests_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`pet_ID`) REFERENCES `pets` (`pet_ID`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_ID`),
  ADD CONSTRAINT `fk_slot_id` FOREIGN KEY (`slot_id`) REFERENCES `available_slots` (`slot_id`);

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`prescription_ID`) REFERENCES `prescriptions` (`prescription_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE;

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`);

--
-- Constraints for table `found_pets`
--
ALTER TABLE `found_pets`
  ADD CONSTRAINT `found_pets_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`);

--
-- Constraints for table `health_records`
--
ALTER TABLE `health_records`
  ADD CONSTRAINT `health_records_ibfk_1` FOREIGN KEY (`vaccination_ID`) REFERENCES `vaccinations` (`vaccination_ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `health_records_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `health_records_ibfk_3` FOREIGN KEY (`pet_ID`) REFERENCES `pets` (`pet_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `health_records_ibfk_4` FOREIGN KEY (`Veterinarian_ID`) REFERENCES `staff` (`staff_id`) ON DELETE SET NULL;

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`);

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`pet_ID`) REFERENCES `pets` (`pet_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescriptions_ibfk_3` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `prescriptions_ibfk_4` FOREIGN KEY (`appointment_ID`) REFERENCES `appointments` (`appointment_ID`) ON DELETE SET NULL;

--
-- Constraints for table `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD CONSTRAINT `fk_vaccinations_pet` FOREIGN KEY (`pet_ID`) REFERENCES `pets` (`pet_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vaccinations_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

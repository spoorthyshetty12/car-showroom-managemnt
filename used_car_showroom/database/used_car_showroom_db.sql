-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2021 at 10:23 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `used_car_showroom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand_list`
--

CREATE TABLE `brand_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `image_path` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand_list`
--

INSERT INTO `brand_list` (`id`, `name`, `image_path`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Toyota', 'uploads/brands/brand-1.png?v=1638242665', 1, '2021-11-30 11:20:30', '2021-11-30 11:24:25'),
(2, 'Mitsubishi', 'uploads/brands/brand-2.png?v=1638242650', 1, '2021-11-30 11:21:34', '2021-11-30 11:24:10'),
(3, 'Audi', 'uploads/brands/brand-3.png?v=1638242698', 1, '2021-11-30 11:24:58', '2021-11-30 11:24:58'),
(6, 'Ford', 'uploads/brands/brand-6.png?v=1638243511', 1, '2021-11-30 11:38:31', '2021-11-30 11:38:31'),
(7, 'Suzuki', 'uploads/brands/brand-7.png?v=1638243765', 1, '2021-11-30 11:42:45', '2021-11-30 11:42:45'),
(8, 'Honda', 'uploads/brands/brand-8.png?v=1638243787', 1, '2021-11-30 11:43:07', '2021-11-30 11:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `car_list`
--

CREATE TABLE `car_list` (
  `id` int(30) NOT NULL,
  `brand_id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `product_title` text NOT NULL,
  `description` text NOT NULL,
  `model` varchar(250) NOT NULL,
  `mileage` float NOT NULL DEFAULT 0,
  `year` year(4) NOT NULL,
  `fuel` varchar(250) NOT NULL,
  `engine` varchar(250) NOT NULL,
  `color` varchar(250) NOT NULL,
  `condition` text NOT NULL,
  `features` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_list`
--

INSERT INTO `car_list` (`id`, `brand_id`, `category_id`, `price`, `product_title`, `description`, `model`, `mileage`, `year`, `fuel`, `engine`, `color`, `condition`, `features`, `status`, `date_created`, `date_updated`) VALUES
(2, 6, 5, 1400000, '2020 F-150 Raptor', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Phasellus odio nunc, imperdiet ut blandit id, sodales at magna. Sed efficitur nisl vel arcu vestibulum, quis vulputate quam maximus. Sed egestas in turpis in sollicitudin. Donec eget neque augue. Sed in eros porta, facilisis massa et, sollicitudin mi. Quisque eget auctor ligula. Aliquam vestibulum maximus dapibus.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 'F-150 Raptor', 15000, 2020, 'Gasoline', 'twin-turbocharged high-output 3.5L EcoBoost V6 engine', 'Black', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam molestie euismod ultricies. Curabitur placerat aliquam diam, quis volutpat tellus dapibus vel. Suspendisse ac dignissim nisi. Donec ut eros pulvinar, placerat magna et, vulputate ipsum. Sed cursus euismod eros, sed finibus felis molestie vitae. Phasellus fringilla vitae enim in tincidunt. Sed convallis ullamcorper fermentum. Ut accumsan, lectus lacinia blandit dapibus, erat lectus convallis arcu, ut sollicitudin elit sapien non dui. Cras ligula quam, blandit at enim et, consequat molestie enim.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Fusce pellentesque felis vitae erat luctus auctor. Aenean mauris nunc, molestie et mattis nec, luctus vitae quam. Pellentesque elementum ex diam, a molestie quam semper commodo. Quisque lobortis tempor tortor, eget bibendum odio placerat ut. Vestibulum non pellentesque urna. Cras a scelerisque turpis, sit amet pharetra nulla. Sed odio urna, pellentesque vitae luctus consequat, lobortis quis tortor. Praesent lectus arcu, ullamcorper at justo a, tristique vulputate massa. Mauris condimentum sit amet orci id hendrerit.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 0, '2021-11-30 14:10:42', '2021-11-30 17:09:45'),
(3, 8, 1, 1480000, 'RS Turbo CVT Honda SENSING', '&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec imperdiet, velit a euismod faucibus, dui massa faucibus eros, eu vehicula neque libero et enim. In blandit laoreet ultrices. Suspendisse gravida ligula ut risus mattis elementum. Pellentesque sit amet lacinia sapien. Nullam ultrices molestie odio vitae hendrerit. Curabitur facilisis euismod est quis consectetur. Mauris volutpat, ex non iaculis lacinia, erat sem commodo ligula, quis rhoncus quam velit porta velit. Maecenas ultricies lectus sit amet rhoncus fringilla. Vestibulum quis ligula ac erat ultricies pulvinar. Praesent pretium nibh quis lectus ullamcorper, at lobortis sem tincidunt. Suspendisse egestas risus eu massa consectetur, sed consectetur nulla vulputate. Sed rhoncus laoreet tincidunt. Fusce nunc risus, dictum in dignissim ac, scelerisque sed turpis.&lt;/span&gt;', 'RS Turbo CVT', 13000, 2020, 'Gasoline', 'DOHC VTEC Turbo 4-cylinder, 16-valve', 'Red', '&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer magna neque, ultricies elementum convallis eu, maximus vel massa. Aliquam ac leo vitae urna porta blandit in ut metus. Pellentesque nec tincidunt nulla, at pharetra enim. Duis varius ipsum ac massa tempor pulvinar. Morbi quis justo nec augue semper viverra in eget erat. Curabitur gravida sollicitudin diam, quis finibus nibh euismod sagittis. Sed interdum tempor turpis, in auctor massa molestie vel. Maecenas quis cursus libero.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px;&quot;&gt;Nulla sollicitudin sagittis sem in suscipit. Pellentesque vel dui velit. In tincidunt cursus lorem sed dictum. Duis interdum, mi ac molestie facilisis, nisl nunc vulputate tortor, et rhoncus est arcu eu erat. Sed purus leo, hendrerit eu dui eget, rutrum cursus lectus. Quisque vel tortor rhoncus, finibus nisl non, euismod magna. Duis feugiat, quam eget tempor elementum, libero eros laoreet dolor, at rutrum turpis enim varius est. Vivamus finibus est id lacus euismod, vel tincidunt sapien euismod. Nam dignissim nec enim nec elementum. Suspendisse sit amet purus augue. Praesent rutrum nisl est, vel aliquam ligula mollis in. In a diam mi. Mauris egestas libero ut sem accumsan, et lobortis risus pharetra. Fusce in tellus sit amet leo commodo dignissim vitae ac felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Ut non bibendum sem.&lt;/p&gt;', '&lt;ul style=&quot;padding-left: 17px;&quot;&gt;&lt;li style=&quot;&quot;&gt;RS Design (Black Door Mirrors, Antenna and Spoiler)&lt;/li&gt;&lt;li style=&quot;&quot;&gt;9&quot; Audio with Navigation and Wireless Apple Carplay&lt;/li&gt;&lt;li style=&quot;&quot;&gt;10.2&quot; TFT Meter&lt;/li&gt;&lt;li style=&quot;&quot;&gt;12-Speaker Bose Sound System&lt;/li&gt;&lt;li style=&quot;&quot;&gt;Wireless Charger&lt;/li&gt;&lt;li style=&quot;&quot;&gt;Black Leather and Suede Seats&lt;/li&gt;&lt;li style=&quot;&quot;&gt;Lanewatch Camera&lt;/li&gt;&lt;li style=&quot;&quot;&gt;18&quot; Alloy Wheels&lt;/li&gt;&lt;li style=&quot;&quot;&gt;8-Way Power Seat&lt;/li&gt;&lt;li style=&quot;&quot;&gt;Dual-Zone Auto AC&lt;/li&gt;&lt;/ul&gt;', 0, '2021-11-30 17:07:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `description`, `status`, `date_created`, `date_updated`) VALUES
(1, 'SEDAN', 'A sedan has four doors and a traditional trunk. Like vehicles in many categories, they\'re available in a range of sizes from small', 1, '2021-11-30 10:36:50', NULL),
(2, 'COUPE', 'A coupe has historically been considered a two-door car with a trunk and a solid roof.', 1, '2021-11-30 10:37:24', NULL),
(3, 'SPORTS CAR', 'These are the sportiest, hottest, coolest-looking coupes and convertibles—low to the ground, sleek, and often expensive. They generally are two-seaters, but sometimes have small rear seats as well.', 1, '2021-11-30 10:37:46', NULL),
(4, 'STATION WAGON', 'Wagons are similar to sedans but have an extended roofline and a hatch door at the rear instead of a trunk.', 1, '2021-11-30 10:38:07', NULL),
(5, 'PICKUP TRUCK', 'A pickup truck has a passenger cab and an open cargo bed in the rear. Virtually all pickups offer some form of all-wheel drive or part-time four-wheel drive—the latter for off-road use only.', 1, '2021-11-30 10:38:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_list`
--

CREATE TABLE `inquiry_list` (
  `id` int(30) NOT NULL,
  `car_id` int(30) NOT NULL,
  `fullname` text NOT NULL,
  `email` varchar(250) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiry_list`
--

INSERT INTO `inquiry_list` (`id`, `car_id`, `fullname`, `email`, `contact`, `message`, `status`, `remarks`, `date_created`, `date_updated`) VALUES
(1, 2, 'John Smith', 'jsmith@sample.com', '09123456789', 'Fusce pellentesque felis vitae erat luctus auctor. Aenean mauris nunc, molestie et mattis nec, luctus vitae quam. Pellentesque elementum ex diam, a molestie quam semper commodo. Quisque lobortis tempor tortor, eget bibendum odio placerat ut. Vestibulum non pellentesque urna. Cras a scelerisque turpis, sit amet pharetra nulla. Sed odio urna, pellentesque vitae luctus consequat, lobortis quis tortor. Praesent lectus arcu, ullamcorper at justo a, tristique vulputate massa. Mauris condimentum sit amet orci id hendrerit.', 0, NULL, '2021-11-30 16:11:54', '2021-11-30 16:29:27');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Online Pre-owned/Used Car Showroom Management System - PHP'),
(6, 'short_name', 'Used Car Showroom - PHP'),
(11, 'logo', 'uploads/logo-1638256377.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1638256498.png'),
(15, 'content', 'Array');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0=not verified, 1 = verified',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `status`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1635556826', NULL, 1, 1, '2021-01-20 14:02:37', '2021-11-27 13:39:11'),
(2, 'Claire', NULL, 'Blake', 'cblake', '4744ddea876b11dcb1d169fadf494418', 'uploads/avatar-2.png?v=1638264018', NULL, 2, 1, '2021-11-30 17:20:18', '2021-11-30 17:20:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand_list`
--
ALTER TABLE `brand_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_list`
--
ALTER TABLE `car_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry_list`
--
ALTER TABLE `inquiry_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand_list`
--
ALTER TABLE `brand_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `car_list`
--
ALTER TABLE `car_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inquiry_list`
--
ALTER TABLE `inquiry_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

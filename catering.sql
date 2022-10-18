-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2022 at 09:36 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catering`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(400) NOT NULL,
  `price` float(8,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `price`, `image`, `category`) VALUES
(1, 'White Rice', 'Plain white rice', 2.50, 'White Rice_1.jpg', 1),
(2, 'Ghee Rice', 'Basmathi rice ooke wiith ghee', 7.50, 'Ghee Rice_1.jpg', 1),
(3, 'Briyani Rice', 'Rice has flavors of cumin along with other spices', 2.50, 'Biryani Rice_1.jpg', 1),
(4, 'Tamarind Rice', 'Rice cooke with tamarin an lemon', 5.50, 'Tamarind Rice_1.jpg', 1),
(5, 'Mutton curry', 'Mutton cooked in curry and mix of sautéed onions, tomatoes, garlic, and onion is puréed to make a flavorful sauce with a perfect balance of savory, aromatic spices. ', 7.50, 'Mutton Curry_2.jpg', 2),
(6, 'Chicken 65', 'Spicy, deep-fried chicken dish with boneless or bone-in chicken and is usually served with an onion and lemon garnish', 1.15, '3_Chicken 65.jpg', 3),
(7, 'Cabbage stir fry', 'cabbage sliced small size and stir fried with herb and spicess', 6.50, '4_Cabbage Stir Fry.jpg', 4),
(8, 'Mix vegetable', 'Mixture of 3 different vegetable which is stired fry with anchovvies', 7.50, '4_mix vegetables.jpeg', 4),
(9, 'Fried bitter gourd', 'Bitter gourd cut into small piecces and fried with tumeric powder', 5.50, '4_Fried Bitter Gourd.jpg', 4),
(10, 'Chilli chicken', 'a popular Indo-Chinese dish of chicken of Hakka Chinese heritage', 2.50, '3_Chilli Chicken.jpg', 3),
(11, 'Appallam', 'Indian deep fried dough of black gram bean flour, either fried or cooked with dry heat until crunchy', 12.00, '5_Appalam.jpg', 5),
(12, 'Panipuri', 'Consists of a round hollow puri, filled with a mixture of flavored water, tamarind chutney, chili powder, chaat masala, potato mash, onion or chickpeas', 15.50, '5_Pani Puri.jpg', 5),
(13, 'Samossa', 'Fried or baked pastry with a savory filling, including ingredients such as spiced potatoes, onions, peas.', 2.50, '5_Samosa.jpg', 5),
(14, 'Lemonade', 'Sweetened lemon-flavored beverage', 4.50, '6_Lemonade.jpg', 6),
(15, 'Mix Squash', 'beverage with concentrated syrup used in beverage making. It is usually fruit-flavoured, made from fruit juice, water, and sugar or a sugar substitute', 3.50, '6_Squash.jpg', 6),
(18, 'Chicken curry', 'A typical curry from the Indian subcontinent consists of chicken stewed in an onion- and tomato-based sauce, flavoured with ginger, garlic, tomato puree, chilli peppers and a variety of spices, often including turmeric, cumin, coriander, cinnamon, and cardamom.', 8.50, 'Chicken Curry_2.jpg', 2),
(19, 'Fried fish', 'Fish prepared by frying. Often, the fish is covered in batter, egg and breadcrumbs, flour, or herbs and spices before being fried and served, often with a slice of lemon.', 1.10, '3_Fried Fish.jpg', 3),
(20, 'Fish curry', 'Fish curry made with fresh fish, onions, tomatoes, coconut, spices and herbs.', 6.50, 'Fish Curry_2.jpg', 2),
(21, 'Lassi', 'Blend of yogurt, water, spices and sometimes fruit', 4.50, 'Lassi_.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(9) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL,
  `menuID` varchar(99) NOT NULL,
  `category` varchar(255) NOT NULL,
  `quantity` varchar(99) NOT NULL,
  `total` float(9,2) NOT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `status` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `datetime`, `username`, `menuID`, `category`, `quantity`, `total`, `receipt`, `status`) VALUES
(34, '2022-04-19 15:32:23', 'Yuga', '3|12|15', '1|4|5', '2|2|2', 21.50, '34_Yuga.png', 1),
(35, '2022-04-19 18:39:21', 'Kirthiaini', '3|5', '1|2', '2|2', 10.00, NULL, 0),
(37, '2022-04-24 21:23:10', 'Yuga', '1|18|10|8|11|21', '1|2|3|4|5|6', '5|4|3|6|4|2', 37.50, NULL, 0),
(38, '2022-04-25 10:30:20', 'Mugi', '1|6|7', '1|3|4', '10|10|10', 10.15, NULL, 0),
(39, '2022-04-26 19:19:12', 'Mugi', '2', '1', '0', 7.50, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `name`, `category`, `picture`) VALUES
(1, 'Melayu & Thailand', 'Melayu', 'test'),
(2, 'Indian Cuisine', 'Indian', 'Test'),
(3, 'Hong Cheng Food', 'Chinese', 'Test'),
(4, 'Albert Western Cafe', 'Western', 'Test'),
(5, 'Ali Drinks', 'Drinks', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Hp` varchar(99) NOT NULL,
  `type_user` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `email`, `Hp`, `type_user`) VALUES
('Admin', '1234', 'Admin2', 'admin2@gmail.com', '60149165192', 'Admin'),
('Yuga', '1234', 'Yugathes Subramaniam', 'yugathesyuga@gmail.com', '60149165192', 'Customer'),
('Piravin', '123', 'Piravin', 'piravin@gmail.com', '018823929', 'Staff'),
('Goauthaam', '1234', 'Goauthaam', 'goauthaamarul@gmail.com', '01112170069', 'Customer'),
('Mugi', '1234', 'Mugilan', 'mugilan@gmail.com', '013563565', 'Customer'),
('Kirthiaini', '12345678', 'Kirthiaini', 'kirthiaini@gmail.com', '0149165192', 'Customer'),
('Customer', '12345678', 'Muhammad Amirul Bin Barkath Khan', 'business.gsb@gmail.com', '0149165192', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

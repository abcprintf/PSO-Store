-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2016 at 06:22 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pso`
--

-- --------------------------------------------------------

--
-- Table structure for table `adidas_cart`
--

CREATE TABLE IF NOT EXISTS `adidas_cart` (
  `adidas_cart_id` int(10) unsigned NOT NULL,
  `adidas_cart_lot_id` int(10) unsigned NOT NULL,
  `adidas_product_id` int(10) unsigned NOT NULL,
  `qty` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adidas_category`
--

CREATE TABLE IF NOT EXISTS `adidas_category` (
  `category_id` int(10) unsigned NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adidas_category`
--

INSERT INTO `adidas_category` (`category_id`, `category_name`) VALUES
(1, 'Training'),
(2, 'Football'),
(3, 'Originals'),
(4, 'Running'),
(5, 'NEO');

-- --------------------------------------------------------

--
-- Table structure for table `adidas_member`
--

CREATE TABLE IF NOT EXISTS `adidas_member` (
  `adidas_member_id` int(10) unsigned NOT NULL,
  `adidas_member_user` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `adidas_member_pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adidas_member_email` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `adidas_member_datetime` datetime NOT NULL,
  `adidas_member_status` enum('admin','user') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `check_active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `adidas_member`
--

INSERT INTO `adidas_member` (`adidas_member_id`, `adidas_member_user`, `adidas_member_pass`, `adidas_member_email`, `adidas_member_datetime`, `adidas_member_status`, `check_active`, `name`, `lastname`, `address`, `tel`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'abcprintf@gmail.com', '2016-02-18 14:01:13', 'admin', '1', 'mix', 'abcprintf', NULL, '0922848099'),
(2, 'user2', '81dc9bdb52d04dc20036dbd8313ed055', 'user2@gmail.com', '2016-02-18 14:23:59', 'user', '1', 'chatchawan', 'abcprintf', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `adidas_orders`
--

CREATE TABLE IF NOT EXISTS `adidas_orders` (
  `adidas_orders_id` int(10) unsigned NOT NULL,
  `adidas_reference_id` int(10) unsigned NOT NULL,
  `order_date` datetime NOT NULL,
  `orders_status` enum('Not payments','Payments successful') NOT NULL DEFAULT 'Not payments',
  `payment` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `adidas_payment`
--

CREATE TABLE IF NOT EXISTS `adidas_payment` (
  `adidas_payment_id` int(10) unsigned NOT NULL,
  `date_time` datetime NOT NULL,
  `adidas_reference_id` int(10) unsigned NOT NULL,
  `adidas_member_id` int(10) unsigned NOT NULL,
  `time_income` time NOT NULL,
  `price_income` decimal(10,2) NOT NULL,
  `comment` varchar(1000) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adidas_product`
--

CREATE TABLE IF NOT EXISTS `adidas_product` (
  `adidas_product_id` int(10) unsigned NOT NULL,
  `adidas_member_id` int(10) unsigned NOT NULL,
  `adidas_category_id` int(10) unsigned NOT NULL,
  `adidas_type_id` int(10) unsigned NOT NULL,
  `adidas_product_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `adidas_product_price` decimal(10,2) NOT NULL,
  `adidas_product_img` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `adidas_product_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `adidas_product_details` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `adidas_product_datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `adidas_product`
--

INSERT INTO `adidas_product` (`adidas_product_id`, `adidas_member_id`, `adidas_category_id`, `adidas_type_id`, `adidas_product_name`, `adidas_product_price`, `adidas_product_img`, `adidas_product_title`, `adidas_product_details`, `adidas_product_datetime`) VALUES
(4, 1, 1, 1, 'Climacool Aeroknit Tee', '1090.00', 'ClimacoolAeroknitTee-mgreyh.jpg', 'Climacool Aeroknit Tee - mgreyh', '<div>\r\n<div class="sshort" style="margin: 0px; padding: 0px; color: rgb(136, 136, 136); font-family: adihausregular, Arial, Helvetica, Verdana, sans-serif; line-height: 20.15px;">Prepare for intense workouts with this training t-shirt for men. It combines ultra-breathable burnout fabric with a quick-drying layer to pull sweat away from your body and let in air. As your workout challenges you, this tee works to keep you comfortable.</div>\r\n\r\n<ul>\r\n	<li>Ventilated climacool&reg; keeps you cool and dry</li>\r\n	<li>Breakthrough breathability: Ultra-breathable burnout fabric helps keep you cool so you can train harder; Accelerated drying: Quick-dry layer draws sweat away from your skin</li>\r\n	<li>Supreme comfort: Rich, premium-blend fabric provides ideal comfort for longer training sessions</li>\r\n	<li>Crewneck</li>\r\n	<li>Slim fit</li>\r\n	<li>60% cotton / 40% polyester single jersey; 55% cotton / 45% polyester single jersey</li>\r\n</ul>\r\n</div>\r\n', '2016-02-18 23:42:35'),
(5, 1, 2, 1, 'Firm Ground Boots', '7990.00', 'FirmGroundBoots.jpg', 'ACE 16.1 Firm Ground Boots', '<div class="sshort" style="margin: 0px; padding: 0px; color: rgb(136, 136, 136); font-family: adihausregular, Arial, Helvetica, Verdana, sans-serif; line-height: 20.15px;">The game is changing, and it takes the player with complete control to create the plays, build up chances and finish them with clinical precision. The one who is unbeatable in the attacks and unbreakable on defence, with a skill set that can&#39;t be touched. The ACE 16.1 is the football boot for that player. A one-piece, 3D upper with NON STOP GRIP makes sure every touch, trap and pass is on point. The outsole is designed to give you total control on firm ground and artificial grass.</div>\r\n\r\n<ul>\r\n	<li>Super-light, super-soft engineered 3D Control Skin upper</li>\r\n	<li>Control the ball in all conditions with NON STOP GRIP (NSG), a thin layer of raised dots applied to the upper that keeps the ball glued to your feet</li>\r\n	<li>Provides rock-solid stability at high speeds with its extremely lightweight SPRINTFRAME ou', '2016-02-18 23:44:09'),
(6, 1, 1, 1, 'Spain Home Pre-Match', '1890.00', 'BasketballSuperstarTrackSuit.jpg', 'UEFA EURO 2016 Spain Home Pre-Match Shit', '<div class="sshort" style="margin: 0px; padding: 0px; color: rgb(136, 136, 136); font-family: adihausregular, Arial, Helvetica, Verdana, sans-serif; line-height: 20.15px;">As Spain aims to claim Europe&#39;s top football prize at UEFA EURO 2016&trade;, you can show your support for la Roja with this men&#39;s football shirt. It is the shirt players wear for pre-match warm-ups on their home pitch. Made from lightweight fabric with features mesh vents that maintain airflow. Finished with the Spanish Football Federation badge on the chest.</div>\r\n\r\n<ul>\r\n	<li>As Spain aims to claim Europe&#39;s top football prize at UEFA EURO 2016&trade;, you can show your support for la Roja with this men&#39;s football shirt. It is the shirt players wear for pre-match warm-ups on their home pitch. Made from lightweight fabric with features mesh vents that maintain airflow. Finished with the Spanish Football Federation badge on the chest.</li>\r\n	<li>Ribbed crewneck</li>\r\n	<li>Mesh ventilation inserts</li', '2016-02-22 01:14:49'),
(7, 1, 2, 1, 'Germany Home Authentic', '3990.00', 'Germany Home Authentic Jersey.jpg', 'UEFA EURO 2016 Germany Home Authentic Jersey', '<div class="sshort" style="margin: 0px; padding: 0px; color: rgb(136, 136, 136); font-family: adihausregular, Arial, Helvetica, Verdana, sans-serif; line-height: 20.15px;">Other countries feature world-renowned players. Germany features a world-renowned team. As current world champion, Die Mannschaft is set to dominate the world stage again during UEFA EURO 2016&trade;. A favourite to hoist the Cup, Germany&#39;s home jersey goes back to where it all began, honouring the country&#39;s great heritage of the white and black national kits. Featuring a modern design that pays homage to great victories of the past, this men&#39;s football jersey is made with ventilated climacool&reg; that keeps you cool in the stands or on the pitch.</div>\r\n\r\n<ul>\r\n	<li>Other countries feature world-renowned players. Germany features a world-renowned team. As current world champion, Die Mannschaft is set to dominate the world stage again during UEFA EURO 2016&trade;. A favourite to hoist the Cup, Germany&#3', '2016-02-18 23:46:22'),
(8, 1, 2, 1, 'Spain Home Replica', '490.00', 'SpainHomeReplicaSocks1Pair.jpg', 'UEFA EURO 2016 Spain Home Replica Socks 1 Pair', '<div class="sshort" style="margin: 0px; padding: 0px; color: rgb(136, 136, 136); font-family: adihausregular, Arial, Helvetica, Verdana, sans-serif; line-height: 20.15px;">Complete your la Roja fan kit with these men&#39;s football socks. Players wear a version of these supportive socks on their home pitch for UEFA EURO 2016&trade;. Mesh ventilation helps keep feet dry, and anatomical cushioning adds comfort where you need it.</div>\r\n\r\n<ul>\r\n	<li>Complete your la Roja fan kit with these men&#39;s football socks. Players wear a version of these supportive socks on their home pitch for UEFA EURO 2016&trade;. Mesh ventilation helps keep feet dry, and anatomical cushioning adds comfort where you need it.</li>\r\n	<li>One pair per pack</li>\r\n	<li>Ribbed cuffs and inserts</li>\r\n	<li>Anatomically placed cushioning to support and protect high-stress areas</li>\r\n	<li>Mesh ventilation inserts</li>\r\n	<li>Engineered club artwork; Left and right sock</li>\r\n	<li>67% polyester &frasl; 29% nylon &frasl;', '2016-02-18 23:47:37'),
(9, 1, 3, 1, 'Superstar Nigo Bearfoot', '3490.00', 'SuperstarNigoBearfootShoes.jpg', 'Superstar Nigo Bearfoot Shoes', '<div class="sshort" style="margin: 0px; padding: 0px; color: rgb(136, 136, 136); font-family: adihausregular, Arial, Helvetica, Verdana, sans-serif; line-height: 20.15px;">Created in collaboration with Nigo, the Superstar Nigo Bearfoot shoes bring the Japanese designer&#39;s signature take on playful street style to one of adidas&#39; most iconic shoes. All the familiar features of the adidas Superstar shoes are here, from the shell toe to the herringbone-pattern cupsole. The upper of these shoes is covered in a print of palm trees and skyscrapers inspired by L.A.&#39;s skyline, while the shell toe gets a fresh look with Nigo&#39;s trademark bear character.</div>\r\n\r\n<ul>\r\n	<li>Leather upper with printed graphic</li>\r\n	<li>Rubber shell toe with moulded Nigo graphic; Nigo royal bear lace jewel</li>\r\n	<li>Leather lining</li>\r\n	<li>Foil printed &quot;SUPERSTAR&quot; on quarter; Printed Trefoil logo on heel tab</li>\r\n	<li>Rubber cupsole</li>\r\n</ul>\r\n', '2016-02-18 23:49:02'),
(10, 1, 3, 1, 'Superstar ''80s Shoes', '3690.00', 'Superstar80sShoes.jpg', 'Superstar ''80s Shoes', '<div class="sshort" style="margin: 0px; padding: 0px; color: rgb(136, 136, 136); font-family: adihausregular, Arial, Helvetica, Verdana, sans-serif; line-height: 20.15px;">Since it first stepped onto the hardwood in 1970, taking the NBA by storm, the adidas Superstar shoe has become an enduring icon of sporty style. This remake refreshes the classic sneaker with a new tonal look. These shoes are built in leather and finished with the famous shell toe.</div>\r\n\r\n<ul>\r\n	<li>Leather upper</li>\r\n	<li>Classic rubber shell toe</li>\r\n	<li>Leather lining</li>\r\n	<li>Perforated quarter</li>\r\n	<li>Printed Trefoil logo on tongue and heel tab</li>\r\n	<li>Herringbone-pattern rubber cupsole</li>\r\n</ul>\r\n', '2016-02-18 23:50:02'),
(11, 1, 4, 1, 'Pure Boost 2.0 Shoes', '4690.00', 'PureBoost2_0Shoes.jpg', 'Pure Boost 2.0 Shoes', '<div class="sshort" style="margin: 0px; padding: 0px; color: rgb(136, 136, 136); font-family: adihausregular, Arial, Helvetica, Verdana, sans-serif; line-height: 20.15px;">boost&trade; has already changed the running world, and these men&rsquo;s shoes put adidas&rsquo; signature energy-returning midsole in a casual, stylish look. They have a synthetic upper with an engineered forefoot, soft suede and micro-perforated 3-Stripes. Featuring a rubber outsole for sure-footed grip.</div>\r\n\r\n<ul>\r\n	<li>boost&trade;&#39;s energy-returning properties keep every step charged with an endless supply of light, fast energy</li>\r\n	<li>Synthetic upper; Suede quarter</li>\r\n	<li>Engineered forefoot; Micro-perforated synthetic overlays</li>\r\n	<li>Breathable mesh lining</li>\r\n	<li>Grippy rubber outsole</li>\r\n</ul>\r\n', '2016-02-18 23:51:38'),
(12, 1, 4, 1, 'Ultra Boost Shoes', '6990.00', 'UltraBoostShoes.jpg', 'Ultra Boost Shoes', '<div class="sshort" style="margin: 0px; padding: 0px; color: rgb(136, 136, 136); font-family: adihausregular, Arial, Helvetica, Verdana, sans-serif; line-height: 20.15px;">&quot;Step into these neutral mens running shoes and you will rethink everything you know about what fast and comfortable feel like. Theyre built with boost</div>\r\n\r\n<ul>\r\n	<li>neutral transition.\r\n	<ul>\r\n		<li>A light// luxuriously cushioned running shoe for any pace and any distance.</li>\r\n		<li>Weight: 304 g (size UK 8.5)</li>\r\n		<li>adidas Primeknit is carefully engineered to naturally expand with your foot while you run to give you a more comfortable fit and help reduce irr// fast energy</li>\r\n		<li>STRETCHWEB rubber outsole is lightweight and elastic// adapting to the ground for stability and working strategically to optimise the unique properties of boost</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n', '2016-02-18 23:52:35'),
(13, 1, 5, 1, 'Cloudfoam Speed Shoes', '2090.00', 'CloudfoamSpeedShoes.jpg', 'Cloudfoam Speed Shoes', '<div class="sshort" style="margin: 0px; padding: 0px; color: rgb(136, 136, 136); font-family: adihausregular, Arial, Helvetica, Verdana, sans-serif; line-height: 20.15px;">Streamlined and super-cushioned. These shoes keep it simple with lightweight mesh. cloudfoam gives them a soft, springy feel.</div>\r\n\r\n<ul>\r\n	<li>Mesh upper</li>\r\n	<li>Synthetic suede overlays; Seamless 3-Stripes</li>\r\n	<li>Round laces</li>\r\n	<li>cloudfoam ultra sockliner for supreme comfort and lightweight cushioning</li>\r\n	<li>cloudfoam midsole and outsole for step-in comfort and superior cushioning</li>\r\n</ul>\r\n', '2016-02-18 23:53:33'),
(14, 1, 5, 1, 'Cloudfoam Speed Shoes', '2090.00', 'CloudfoamSpeedShoes_2.jpg', 'Cloudfoam Speed Shoes', '<div class="sshort" style="margin: 0px; padding: 0px; color: rgb(136, 136, 136); font-family: adihausregular, Arial, Helvetica, Verdana, sans-serif; line-height: 20.15px;">Streamlined and super-cushioned. These shoes keep it simple with lightweight mesh. cloudfoam gives them a soft, springy feel.</div>\r\n\r\n<ul>\r\n	<li>Mesh upper</li>\r\n	<li>Synthetic suede overlays; Seamless 3-Stripes</li>\r\n	<li>Round laces</li>\r\n	<li>cloudfoam ultra sockliner for supreme comfort and lightweight cushioning</li>\r\n	<li>cloudfoam midsole and outsole for step-in comfort and superior cushioning</li>\r\n</ul>\r\n', '2016-02-18 23:54:34'),
(15, 1, 1, 2, 'Cropped Tee', '1390.00', 'CroppedTee.jpg', 'Cropped Tee', '<div class="sshort" style="margin: 0px; padding: 0px; color: rgb(136, 136, 136); font-family: adihausregular, Arial, Helvetica, Verdana, sans-serif; line-height: 20.15px;">The cropped fit of this womens long sleeve t-shirt pairs well with high-waisted leggings. Ventilating mesh panels combines with moisture-wicking performance material to keep you feeling dry and comfortable while you focus on engaging your core.\r\n<ul>\r\n	<li>A cropped workout top with mesh panels to keep you cool.</li>\r\n	<li>climalite</li>\r\n</ul>\r\n</div>\r\n\r\n<ul>\r\n	<li>AJ4934_580</li>\r\n</ul>\r\n', '2016-02-18 23:59:39'),
(16, 1, 1, 2, 'Climachill Tank', '1290.00', 'ClimachillTank.jpg', 'Climachill Tank', '<div class="sshort" style="margin: 0px; padding: 0px; color: rgb(136, 136, 136); font-family: adihausregular, Arial, Helvetica, Verdana, sans-serif; line-height: 20.15px;">There are many secrets to a successful workout routine. To start with, you need reliable training clothes that feel good every time you put them on. This women&#39;s tank top is designed to help you feel cool and comfortable at the gym with climachill&trade;. The knit structure releases heat and allows air to flow. On the inner surface, a print of heat-conductive raised aluminium dots pulls heat away from your skin for a cool-on-contact feel.</div>\r\n\r\n<ul>\r\n	<li>climachill&trade; keeps you cool with a meshlike fabric and aluminium-silver dots that conduct heat away from the body</li>\r\n	<li>Rounded neck</li>\r\n	<li>Racer back</li>\r\n	<li>M&eacute;lange fabric</li>\r\n	<li>Slim fit</li>\r\n	<li>100% polyester doubleknit</li>\r\n</ul>\r\n', '2016-02-19 00:00:38'),
(17, 1, 1, 3, 'Basketball Superstar Track Jacket', '2290.00', 'BasketballSuperstarTrackJacket.jpg', 'Basketball Superstar Track Jacket', '<div class="sshort" style="margin: 0px; padding: 0px; color: rgb(136, 136, 136); font-family: adihausregular, Arial, Helvetica, Verdana, sans-serif; line-height: 20.15px;">A modern basketball graphic on the back adds a fresh twist to this track jacket. Built for junior boys with bold blocks of colour and iconic tricot, it features all the details of the original Superstar jacket.</div>\r\n\r\n<ul>\r\n	<li>Side pockets</li>\r\n	<li>Full zip with ribbed stand-up collar</li>\r\n	<li>Ribbed cuffs and hem</li>\r\n	<li>Printed Trefoil, &quot;ADIDAS ORIGINALS&quot; and basketball graphic on back; Printed Trefoil logo on left chest</li>\r\n	<li>Regular fit</li>\r\n	<li>100% polyester tricot</li>\r\n</ul>\r\n', '2016-02-19 00:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `adidas_reference`
--

CREATE TABLE IF NOT EXISTS `adidas_reference` (
  `adidas_reference_id` int(10) unsigned NOT NULL,
  `adidas_reference_datetime` datetime NOT NULL,
  `adidas_reference_member_id` int(10) unsigned DEFAULT NULL,
  `session_id` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adidas_type`
--

CREATE TABLE IF NOT EXISTS `adidas_type` (
  `adidas_type_id` int(10) unsigned NOT NULL,
  `adidas_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adidas_type`
--

INSERT INTO `adidas_type` (`adidas_type_id`, `adidas_type_name`) VALUES
(1, 'Men'),
(2, 'Women'),
(3, 'Kids');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adidas_cart`
--
ALTER TABLE `adidas_cart`
  ADD PRIMARY KEY (`adidas_cart_id`),
  ADD UNIQUE KEY `adidas_cart_lot_id` (`adidas_cart_lot_id`,`adidas_product_id`),
  ADD KEY `adidas_cart_lot_id_2` (`adidas_cart_lot_id`);

--
-- Indexes for table `adidas_category`
--
ALTER TABLE `adidas_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `adidas_member`
--
ALTER TABLE `adidas_member`
  ADD PRIMARY KEY (`adidas_member_id`);

--
-- Indexes for table `adidas_orders`
--
ALTER TABLE `adidas_orders`
  ADD PRIMARY KEY (`adidas_orders_id`),
  ADD KEY `adidas_reference_id` (`adidas_reference_id`);

--
-- Indexes for table `adidas_payment`
--
ALTER TABLE `adidas_payment`
  ADD PRIMARY KEY (`adidas_payment_id`),
  ADD KEY `adidas_reference_id` (`adidas_reference_id`),
  ADD KEY `adidas_member_id` (`adidas_member_id`);

--
-- Indexes for table `adidas_product`
--
ALTER TABLE `adidas_product`
  ADD PRIMARY KEY (`adidas_product_id`),
  ADD KEY `adidas_category_id` (`adidas_category_id`),
  ADD KEY `adidas_type_id` (`adidas_type_id`),
  ADD KEY `adidas_member_id` (`adidas_member_id`);

--
-- Indexes for table `adidas_reference`
--
ALTER TABLE `adidas_reference`
  ADD PRIMARY KEY (`adidas_reference_id`),
  ADD UNIQUE KEY `session_id` (`session_id`),
  ADD KEY `adidas_reference_member_id` (`adidas_reference_member_id`);

--
-- Indexes for table `adidas_type`
--
ALTER TABLE `adidas_type`
  ADD PRIMARY KEY (`adidas_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adidas_cart`
--
ALTER TABLE `adidas_cart`
  MODIFY `adidas_cart_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `adidas_category`
--
ALTER TABLE `adidas_category`
  MODIFY `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `adidas_member`
--
ALTER TABLE `adidas_member`
  MODIFY `adidas_member_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `adidas_orders`
--
ALTER TABLE `adidas_orders`
  MODIFY `adidas_orders_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `adidas_payment`
--
ALTER TABLE `adidas_payment`
  MODIFY `adidas_payment_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `adidas_product`
--
ALTER TABLE `adidas_product`
  MODIFY `adidas_product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `adidas_reference`
--
ALTER TABLE `adidas_reference`
  MODIFY `adidas_reference_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `adidas_type`
--
ALTER TABLE `adidas_type`
  MODIFY `adidas_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `adidas_cart`
--
ALTER TABLE `adidas_cart`
  ADD CONSTRAINT `adidas_cart_ibfk_1` FOREIGN KEY (`adidas_cart_lot_id`) REFERENCES `adidas_reference` (`adidas_reference_id`);

--
-- Constraints for table `adidas_orders`
--
ALTER TABLE `adidas_orders`
  ADD CONSTRAINT `adidas_orders_ibfk_1` FOREIGN KEY (`adidas_reference_id`) REFERENCES `adidas_reference` (`adidas_reference_id`);

--
-- Constraints for table `adidas_payment`
--
ALTER TABLE `adidas_payment`
  ADD CONSTRAINT `adidas_payment_ibfk_1` FOREIGN KEY (`adidas_reference_id`) REFERENCES `adidas_reference` (`adidas_reference_id`),
  ADD CONSTRAINT `adidas_payment_ibfk_2` FOREIGN KEY (`adidas_member_id`) REFERENCES `adidas_member` (`adidas_member_id`);

--
-- Constraints for table `adidas_product`
--
ALTER TABLE `adidas_product`
  ADD CONSTRAINT `adidas_product_ibfk_1` FOREIGN KEY (`adidas_category_id`) REFERENCES `adidas_category` (`category_id`),
  ADD CONSTRAINT `adidas_product_ibfk_2` FOREIGN KEY (`adidas_type_id`) REFERENCES `adidas_type` (`adidas_type_id`),
  ADD CONSTRAINT `adidas_product_ibfk_3` FOREIGN KEY (`adidas_member_id`) REFERENCES `adidas_member` (`adidas_member_id`);

--
-- Constraints for table `adidas_reference`
--
ALTER TABLE `adidas_reference`
  ADD CONSTRAINT `adidas_reference_ibfk_1` FOREIGN KEY (`adidas_reference_member_id`) REFERENCES `adidas_member` (`adidas_member_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

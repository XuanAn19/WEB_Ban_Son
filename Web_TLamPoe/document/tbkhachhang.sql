-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 18, 2023 at 08:14 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tbkhachhang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `Username` text NOT NULL,
  `Password` text NOT NULL,
  `HoTen` text NOT NULL,
  `Gioitinh` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Username`, `Password`, `HoTen`, `Gioitinh`) VALUES
('admin', 'admin', 'Nguyễn Xuân An', 'Nam');

-- --------------------------------------------------------

--
-- Table structure for table `image_library`
--

DROP TABLE IF EXISTS `image_library`;
CREATE TABLE IF NOT EXISTS `image_library` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `path` varchar(255) NOT NULL,
  `created-time` int NOT NULL,
  `last-updated` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `total` int NOT NULL,
  `created-time` int NOT NULL,
  `last-updated` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ten`, `phone`, `address`, `note`, `total`, `created-time`, `last-updated`) VALUES
(15, 'Nguyễn Văn Báo', '0123456789', 'P.Đập Đá', 'Mua nhanh ', 612000, 1684394142, 1684394142);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `orders_id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `created-time` int NOT NULL,
  `last-updated` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `orders_id` (`orders_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `orders_id`, `product_id`, `quantity`, `price`, `created-time`, `last-updated`) VALUES
(7, 15, 4, 1, 300000, 1684394142, 1684394142),
(8, 15, 77, 1, 312000, 1684394142, 1684394142);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `price` float NOT NULL,
  `content` text NOT NULL,
  `created-time` int NOT NULL,
  `last-updated` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `ten`, `images`, `price`, `content`, `created-time`, `last-updated`) VALUES
(4, 'Son Black Rouge Air Fit Velvet Tint Ver 2', 'images/18-05-2023/avatar1.jpg', 300000, 'Son Black Rouge Air Fit Velvet Tint Ver 2 Màu A12 Dashed Brown – Đỏ Nâu', 1552615987, 1552615987),
(77, 'Son Kem Black Rouge Cream Matt Rouge', 'images/06-05-2023/avatar2.jpg', 312000, 'Son Kem Black Rouge Cream Matt Rouge Màu CM05 Lion – Đỏ Nâu', 1683379116, 1683379116),
(78, 'Son Black Rouge Air Fit Velvet Tint Ver 8', 'images/18-05-2023/avatar3.jpg', 872000, 'Son Black Rouge Air Fit Velvet Tint Ver 8 Màu A45 Bring it Brick – Đỏ Trầm', 1683379187, 1683379187),
(79, 'Son Black Rouge Air Fit Velvet Tint Ver 8', 'images/18-05-2023/avatar4.jpg', 872000, 'Son Black Rouge Air Fit Velvet Tint Ver 8 Màu A44 Roasting Brown – Đỏ Đất', 1683379275, 1683379275),
(80, 'Son Black Rouge Air Fit Velvet Tint', 'images/18-05-2023/avatar5.jpg', 300000, 'Son Black Rouge Air Fit Velvet Tint Ver 8 Màu A41 Take me – Cam Đất', 1683379656, 1683379656),
(81, 'Son Black Rouge Air Fit Velvet Tint', 'images/18-05-2023/avatar6.jpg', 300000, 'Son Black Rouge Air Fit Velvet Tint Ver 8 Màu A39 Fuchsia Psyche – Hồng Ánh Tím', 1683379741, 1683379741),
(82, 'Son Black Rouge Half N Half', 'images/18-05-2023/avatar7.jpg', 300000, 'Son Black Rouge Half N Half Màu HV01 Bad Peanut – Cam Nude', 1683379782, 1683379782),
(83, 'Son Black Rouge Air Fit Velvet Tint', 'images/18-05-2023/avatar8.jpg', 300000, 'Son Black Rouge Air Fit Velvet Tint Ver 7 Màu A37 Unrivaled Chili King – Đỏ Nâu Đất', 1683379871, 1683379871),
(84, 'Son 3CE Mickey', 'images/18-05-2023/avatar9.jpg', 368000, 'Son 3CE Mickey Đỏ – Cam San Hô', 1683379909, 1683379909),
(85, 'Son 3CE Matte Lip Color', 'images/18-05-2023/avatar10.jpg', 368000, 'Son 3CE Matte Lip Color Màu 231 Baked Orange – Cam Nâu', 1683379953, 1683379953),
(86, 'Son 3CE Slim Velvet Lip Color', 'images/18-05-2023/avatar11.jpg', 368000, 'Son 3CE Slim Velvet Lip Color Màu Pale Red – Đỏ Tươi', 1683379998, 1683379998),
(87, 'Son Kem Lì 3CE Velvet Lip Tint', 'images/18-05-2023/avatar12.jpg', 316000, 'Son Kem Lì 3CE Velvet Lip Tint Màu Taupe – Đỏ Nâu', 1683380088, 1683380088),
(88, 'Son Kem 3CE Soft Lip Lacquer', 'images/18-05-2023/avatar13.jpg', 316000, 'Son Kem 3CE Soft Lip Lacquer Màu Tawny Red – Cam Cháy', 1683380128, 1683380128),
(89, 'Son 3CE Slim Velvet Lip Color', 'images/18-05-2023/avatar14.jpg', 368000, 'Son 3CE Slim Velvet Lip Color Màu True Red – Đỏ Thuần', 1683380167, 1683380167),
(90, 'Son Kem Lì 3CE Velvet Lip Tint', 'images/18-05-2023/avatar15.jpg', 316000, 'Son Kem Lì 3CE Velvet Lip Tint Màu Private – Đỏ Lạnh', 1683380244, 1683380244),
(91, 'Son Kem Lì 3CE Smoothing Lip Tint', 'images/18-05-2023/avatar16.jpg', 316000, 'Son Kem Lì 3CE Smoothing Lip Tint Màu Shameless – Đỏ Hồng Trầm', 1683380325, 1683380325),
(92, 'Son Lì Gucci Rouge À Lèvres Voile Mat ', 'images/18-05-2023/avatar17.jpg', 872000, 'Son Lì Gucci Rouge À Lèvres Voile Mat Màu 208 They Met in Argentina Màu Cam Đất', 1683380738, 1683380738),
(94, 'Son Gucci Rouge De Beauté Brillant', 'images/18-05-2023/avatar18.jpeg', 820000, 'Son Gucci Rouge De Beauté Brillant Màu 515 Devotion – Đỏ Gạch', 1683381068, 1683381068),
(95, 'Son Gucci Rouge à Lèvres Satin', 'images/18-05-2023/avatar19.jpg', 820000, 'Son Gucci Rouge à Lèvres Satin Màu 302 Agatha Orange – Đỏ Cam', 1683381168, 1683381168),
(96, 'Son Gucci Rouge à Lèvres Voile', 'images/18-05-2023/avatar20.jpg', 820000, 'Son Gucci Rouge à Lèvres Voile Màu 304 Queen Christina – Cam Sữa', 1683381253, 1683381253),
(100, 'Son Gucci Rouge À Lèvres Mat', 'images/18-05-2023/avatar21.jpg', 820000, 'Son Gucci Rouge À Lèvres Mat 208 They Met In Argentina Hồng Đất', 1683381887, 1683381887),
(101, 'Son Gucci Rouge à Lèvres Mat', 'images/18-05-2023/avatar22.jpg', 820000, 'Son Gucci Rouge à Lèvres Mat Màu 504 Myra Crimson – Đỏ Đậm', 1683381915, 1683381915),
(102, 'Son Gucci Rouge à Lèvres Mat', 'images/18-05-2023/avatar23.jpg', 820000, 'Son Gucci Rouge à Lèvres Mat Màu 500 Odalie Red – Đỏ Cam', 1683381941, 1683381941),
(103, 'Son Gucci Rouge à Lèvres Mat', 'images/18-05-2023/avatar24.jpg', 820000, 'Son Gucci Rouge à Lèvres Mat Màu 25 Goldie Red – Đỏ Tươi', 1683381965, 1683381965),
(104, 'Son Dior Rouge Ultra Care', 'images/18-05-2023/avatar25.jpg', 840000, 'Son Dior Rouge Ultra Care Màu 635 Ecstase – Đỏ Gạch', 1683382061, 1683382061),
(105, 'Son Kem Dior Rouge Ultra Care Liquid', 'images/18-05-2023/avatar26.jpg', 840000, 'Son Kem Dior Rouge Ultra Care Liquid Màu 707 Bliss – Cam Cháy', 1683382093, 1683382093),
(106, 'Son Dưỡng Dior Lip Glow Màu 007 Raspberry – Hồng Tím', 'images/18-05-2023/avatar27.jpg', 840000, 'Son Dưỡng Dior Lip Glow Màu 007 Raspberry – Hồng Tím', 1683382125, 1683382125),
(107, 'Son Dior Rouge Ultra Care', 'images/18-05-2023/avatar28.jpg', 840000, 'Son Dior Rouge Ultra Care Màu 707 Bliss – Cam Cháy', 1683382157, 1683382157),
(108, 'Son Kem Dior Lip Tattoo', 'images/18-05-2023/avatar29.jpg', 840000, 'Son Kem Dior Lip Tattoo Màu 421 Natural Beige – Cam Ðất', 1683382206, 1683382206),
(109, 'Son Dưỡng Dior Lip Glow', 'images/18-05-2023/avatar30.jpg', 840000, 'Son Dưỡng Dior Lip Glow 001 Pink – Màu Hồng', 1683382263, 1683382263),
(110, 'Son Kem Dior Rouge Ultra Care Liquid', 'images/18-05-2023/avatar31.jpg', 840000, 'Son Kem Dior Rouge Ultra Care Liquid Màu 999 Bloom – Ðỏ Tươi', 1683382339, 1683382339),
(111, 'Son Kem Dior Rouge Ultra Care Liquid', 'images/18-05-2023/avatar32.jpg', 840000, 'Son Kem Dior Rouge Ultra Care Liquid Màu 808 Caress – Đỏ Hồng Đất', 1683382360, 1683382360),
(112, 'Sữa Rửa Mặt Innisfree', 'images/18-05-2023/avatar33.jpg', 206000, 'Sữa Rửa Mặt Innisfree Green Tea Hydrating Amino Acid Cleansing Foam 150gr', 1683382489, 1683382489),
(113, 'Sữa Rửa Mặt SVR ', 'images/18-05-2023/avatar34.jpg', 264000, 'Sữa Rửa Mặt SVR Sebiaclear Purifying & Exfoliating Soap-Free Cleanser 200ml', 1683382528, 1683382528),
(114, 'Kem Dưỡng Tái Tạo Phục Hồi Da', 'images/18-05-2023/avatar35.jpg', 228000, 'Kem Dưỡng Tái Tạo Phục Hồi Da Avène Cicalfate+ Repairing Protective Cream 40ml', 1683382605, 1683382605),
(115, 'Kem Dưỡng Ẩm ', 'images/18-05-2023/avatar36.jpg', 322000, 'Kem Dưỡng Ẩm Điều Tiết Dầu Neogen Dermalogy Black Energy Cream 80ml', 1683382649, 1683382649),
(116, 'Nước Dưỡng Da Dr.Pepti ', 'images/18-05-2023/avatar37.jpg', 244000, 'Nước Dưỡng Da Dr.Pepti Centella Toner 180ml', 1683382707, 1683382707),
(117, 'Kem Dưỡng Bioderma', 'images/18-05-2023/avatar38.jpg', 244000, 'Kem Dưỡng Bioderma Cicabio Soothing Repairing Cream 40ml', 1683382747, 1683382747),
(118, 'Tẩy Da Chết Mặt Cà Phê Đắk Lắk Cocoon', 'images/18-05-2023/avatar39.jpg', 165000, 'Tẩy Da Chết Mặt Cà Phê Đắk Lắk Cocoon Coffee Face Polish 150ml', 1683382785, 1683382785),
(119, 'Tẩy Da Chết Body Dove', 'images/18-05-2023/avatar40.jpg', 240000, 'Tẩy Da Chết Toàn Thân Dove Exfoliating Body', 1683382826, 1683382826);

-- --------------------------------------------------------

--
-- Table structure for table `tbtaikhoan`
--

DROP TABLE IF EXISTS `tbtaikhoan`;
CREATE TABLE IF NOT EXISTS `tbtaikhoan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Username` text NOT NULL,
  `Password` text NOT NULL,
  `HoTen` text NOT NULL,
  `Mail` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbtaikhoan`
--

INSERT INTO `tbtaikhoan` (`id`, `Username`, `Password`, `HoTen`, `Mail`) VALUES
(8, 'aa', '1', 'Nguyen Van A', 'fdf');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image_library`
--
ALTER TABLE `image_library`
  ADD CONSTRAINT `image_library_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

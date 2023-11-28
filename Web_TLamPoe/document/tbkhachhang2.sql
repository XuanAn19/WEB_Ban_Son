-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 01, 2023 at 02:40 AM
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
  `id` int NOT NULL AUTO_INCREMENT,
  `Username` text NOT NULL,
  `Password` text NOT NULL,
  `HoTen` text NOT NULL,
  `Mail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Username`, `Password`, `HoTen`, `Mail`) VALUES
(1, 'admin', 'admin', 'Nguyễn Xuân An', 'Nam'),
(14, 'admin1', '1', 'Nguyen Xuan An', 'q@gmail.com');

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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `image_library`
--

INSERT INTO `image_library` (`id`, `product_id`, `path`, `created-time`, `last-updated`) VALUES
(78, 79, 'images/24-05-2023/facebook.png', 1684911618, 1684911618),
(79, 79, 'images/24-05-2023/home.png', 1684911618, 1684911618),
(80, 79, 'images/24-05-2023/instagram.png', 1684911618, 1684911618),
(81, 79, 'images/24-05-2023/logo1.png', 1684911618, 1684911618),
(82, 79, 'images/24-05-2023/logout.png', 1684911618, 1684911618);

-- --------------------------------------------------------

--
-- Table structure for table `nhom_phanquyen`
--

DROP TABLE IF EXISTS `nhom_phanquyen`;
CREATE TABLE IF NOT EXISTS `nhom_phanquyen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ten_nhom` varchar(100) NOT NULL,
  `position` int NOT NULL,
  `created-time` int NOT NULL,
  `last-updated` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nhom_phanquyen`
--

INSERT INTO `nhom_phanquyen` (`id`, `ten_nhom`, `position`, `created-time`, `last-updated`) VALUES
(1, 'Sản phẩm', 1, 1685552424, 1685552424),
(2, 'Hóa Đơn', 2, 1685552424, 1685552424),
(3, 'Tài Khoản Khách', 3, 1685552424, 1685552424);

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
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ten`, `phone`, `address`, `note`, `total`, `created-time`, `last-updated`) VALUES
(82, 'Nguyễn Xuân An', '0379644470', '02/Bùi Điền', '', 872000, 1684994165, 1684994165),
(83, 'Nguyễn Xuân An', '0379644470', '02/Bùi Điền', '', 300000, 1685359958, 1685359958),
(84, 'Nguyễn Xuân An', '0379644470', '02/Bùi Điền', '', 872000, 1685580559, 1685580559);

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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `orders_id`, `product_id`, `quantity`, `price`, `created-time`, `last-updated`) VALUES
(77, 82, 78, 1, 872000, 1684994165, 1684994165),
(78, 83, 81, 1, 300000, 1685359958, 1685359958),
(79, 84, 78, 1, 872000, 1685580559, 1685580559);

-- --------------------------------------------------------

--
-- Table structure for table `phanquyen_user`
--

DROP TABLE IF EXISTS `phanquyen_user`;
CREATE TABLE IF NOT EXISTS `phanquyen_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `phanquyen_id` int NOT NULL,
  `created-time` int NOT NULL,
  `last-updated` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `phanquyen_id` (`phanquyen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `phanquyen_user`
--

INSERT INTO `phanquyen_user` (`id`, `user_id`, `phanquyen_id`, `created-time`, `last-updated`) VALUES
(1, 1, 1, 1685552424, 1685552424),
(2, 1, 2, 1685552424, 1685552424),
(3, 1, 3, 1685552424, 1685552424),
(4, 1, 4, 1685552424, 1685552424),
(5, 1, 5, 1685552424, 1685552424),
(6, 1, 6, 1685552424, 1685552424),
(7, 1, 7, 1685552424, 1685552424),
(8, 1, 8, 1685552424, 1685552424),
(9, 1, 9, 1685552424, 1685552424),
(10, 1, 10, 1685552424, 1685552424),
(11, 1, 11, 1685552424, 1685552424),
(14, 1, 1, 1595430953, 1595430953),
(15, 1, 6, 1595430953, 1595430953),
(16, 19, 7, 1595430953, 1595430953),
(17, 20, 1, 1595430953, 1595430953),
(19, 1, 12, 1685552424, 1685552424),
(20, 1, 1, 1685552424, 1685552424),
(21, 1, 2, 1685552424, 1685552424),
(22, 1, 3, 1685552424, 1685552424),
(23, 1, 4, 1685552424, 1685552424),
(24, 1, 5, 1685552424, 1685552424),
(25, 1, 6, 1685552424, 1685552424),
(26, 1, 7, 1685552424, 1685552424),
(27, 1, 8, 1685552424, 1685552424),
(28, 1, 9, 1685552424, 1685552424),
(29, 13, 10, 1685552424, 1685552424),
(30, 13, 11, 1685552424, 1685552424),
(31, 19, 1, 1595430953, 1595430953),
(32, 19, 6, 1595430953, 1595430953),
(33, 19, 7, 1595430953, 1595430953),
(34, 20, 1, 1595430953, 1595430953),
(35, 13, 12, 1685552424, 1685552424),
(37, 14, 1, 1595430953, 1595430953),
(38, 14, 3, 1595430953, 1595430953);

-- --------------------------------------------------------

--
-- Table structure for table `phan_quyen`
--

DROP TABLE IF EXISTS `phan_quyen`;
CREATE TABLE IF NOT EXISTS `phan_quyen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ID_nhom` int NOT NULL,
  `ten` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `create-time` int NOT NULL,
  `last-updated` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ID_nhom` (`ID_nhom`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `phan_quyen`
--

INSERT INTO `phan_quyen` (`id`, `ID_nhom`, `ten`, `url`, `create-time`, `last-updated`) VALUES
(1, 1, 'Danh sách sản phẩm', 'product_listing\\.php$', 1685552424, 1685552424),
(2, 1, 'Xóa sản phẩm', 'product_delete\\.php\\?id=\\d+$', 1553185530, 1553185530),
(3, 1, 'Sửa sản phẩm', 'product_editing\\.php\\?id=\\d+$|product_editing\\.php\\?action=edit&id=\\d+$', 1553185530, 1553185530),
(4, 1, 'Thêm sản phẩm', 'product_editing\\.php$|product_editing\\.php\\?action=add$', 1553185530, 1553185530),
(5, 1, 'Copy sản phẩm', 'product_editing\\.php\\?id=\\d+&task=copy', 1553185530, 1553185530),
(6, 2, 'Danh sách giỏ hàng', 'order_listing\\.php$', 1553185530, 1553185530),
(7, 2, 'IN hóa đơn', 'order_printing\\.php$', 1553185530, 1553185530),
(8, 3, 'Danh sách thành viên', 'account_listing\\.php$', 1553185530, 1553185530),
(9, 3, 'Xóa thành viên', 'account_delete\\.php\\?id=\\d+$', 1553185530, 1553185530),
(10, 3, 'Sửa thành viên', 'account_editing\\.php\\?id=\\d+$|account_editing\\.php\\?action=edit&id=\\d+$', 1553185530, 1553185530),
(11, 3, 'Thêm thành viên', 'account_editing\\.php$|account_editing\\.php\\?action=add$', 1553185530, 1553185530),
(12, 3, 'Phân quyền', 'account_privilege\\.php\\?id=\\d+$|account_privilege\\.php\\?action=save$', 1553185530, 1553185530);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `price` float NOT NULL,
  `content` text NOT NULL,
  `created-time` int NOT NULL,
  `last-updated` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `ten`, `quantity`, `images`, `price`, `content`, `created-time`, `last-updated`) VALUES
(4, 'Son Black Rouge Air Fit Velvet Tint Ver 2', 0, 'images/18-05-2023/avatar1.jpg', 300000, 'Son Black Rouge Air Fit Velvet Tint Ver 2 Màu A12 Dashed Brown – Đỏ Nâu', 1552615987, 1552615987),
(77, 'Son Kem Black Rouge Cream Matt Rouge', 0, 'images/06-05-2023/avatar2.jpg', 312000, 'Son Kem Black Rouge Cream Matt Rouge Màu CM05 Lion – Đỏ Nâu', 1683379116, 1683379116),
(78, 'Son Black Rouge Air Fit Velvet Tint Ver 8', 3, 'images/18-05-2023/avatar3.jpg', 872000, 'Son Black Rouge Air Fit Velvet Tint Ver 8 Màu A45 Bring it Brick – Đỏ Trầm', 1683379187, 1683379187),
(79, 'Son Black Rouge Air Fit Velvet Tint Ver 8', 0, 'images/18-05-2023/avatar4.jpg', 872000, 'Son Black Rouge Air Fit Velvet Tint Ver 8 Màu A44 Roasting Brown – Đỏ Đất', 1683379275, 1684911966),
(80, 'Son Black Rouge Air Fit Velvet Tint', 63, 'images/18-05-2023/avatar5.jpg', 300000, 'Son Black Rouge Air Fit Velvet Tint Ver 8 Màu A41 Take me – Cam Đất', 1683379656, 1683379656),
(81, 'Son Black Rouge Air Fit Velvet Tint', 57, 'images/18-05-2023/avatar6.jpg', 300000, 'Son Black Rouge Air Fit Velvet Tint Ver 8 Màu A39 Fuchsia Psyche – Hồng Ánh Tím', 1683379741, 1683379741),
(82, 'Son Black Rouge Half N Half', 82, 'images/18-05-2023/avatar7.jpg', 300000, 'Son Black Rouge Half N Half Màu HV01 Bad Peanut – Cam Nude', 1683379782, 1683379782),
(83, 'Son Black Rouge Air Fit Velvet Tint', 7, 'images/18-05-2023/avatar8.jpg', 300000, 'Son Black Rouge Air Fit Velvet Tint Ver 7 Màu A37 Unrivaled Chili King – Đỏ Nâu Đất', 1683379871, 1683379871),
(84, 'Son 3CE Mickey', 782, 'images/18-05-2023/avatar9.jpg', 368000, 'Son 3CE Mickey Đỏ – Cam San Hô', 1683379909, 1683379909),
(85, 'Son 3CE Matte Lip Color', 78, 'images/18-05-2023/avatar10.jpg', 368000, 'Son 3CE Matte Lip Color Màu 231 Baked Orange – Cam Nâu', 1683379953, 1683379953),
(86, 'Son 3CE Slim Velvet Lip Color', 79, 'images/18-05-2023/avatar11.jpg', 368000, 'Son 3CE Slim Velvet Lip Color Màu Pale Red – Đỏ Tươi', 1683379998, 1683379998),
(87, 'Son Kem Lì 3CE Velvet Lip Tint', 0, 'images/18-05-2023/avatar12.jpg', 316000, 'Son Kem Lì 3CE Velvet Lip Tint Màu Taupe – Đỏ Nâu', 1683380088, 1683380088),
(88, 'Son Kem 3CE Soft Lip Lacquer', 0, 'images/18-05-2023/avatar13.jpg', 316000, 'Son Kem 3CE Soft Lip Lacquer Màu Tawny Red – Cam Cháy', 1683380128, 1683380128),
(89, 'Son 3CE Slim Velvet Lip Color', 0, 'images/18-05-2023/avatar14.jpg', 368000, 'Son 3CE Slim Velvet Lip Color Màu True Red – Đỏ Thuần', 1683380167, 1683380167),
(90, 'Son Kem Lì 3CE Velvet Lip Tint', 0, 'images/18-05-2023/avatar15.jpg', 316000, 'Son Kem Lì 3CE Velvet Lip Tint Màu Private – Đỏ Lạnh', 1683380244, 1683380244),
(91, 'Son Kem Lì 3CE Smoothing Lip Tint', 0, 'images/18-05-2023/avatar16.jpg', 316000, 'Son Kem Lì 3CE Smoothing Lip Tint Màu Shameless – Đỏ Hồng Trầm', 1683380325, 1683380325),
(92, 'Son Lì Gucci Rouge À Lèvres Voile Mat ', 0, 'images/18-05-2023/avatar17.jpg', 872000, 'Son Lì Gucci Rouge À Lèvres Voile Mat Màu 208 They Met in Argentina Màu Cam Đất', 1683380738, 1683380738),
(94, 'Son Gucci Rouge De Beauté Brillant', 0, 'images/18-05-2023/avatar18.jpeg', 820000, 'Son Gucci Rouge De Beauté Brillant Màu 515 Devotion – Đỏ Gạch', 1683381068, 1683381068),
(95, 'Son Gucci Rouge à Lèvres Satin', 0, 'images/18-05-2023/avatar19.jpg', 820000, 'Son Gucci Rouge à Lèvres Satin Màu 302 Agatha Orange – Đỏ Cam', 1683381168, 1683381168),
(96, 'Son Gucci Rouge à Lèvres Voile', 0, 'images/18-05-2023/avatar20.jpg', 820000, 'Son Gucci Rouge à Lèvres Voile Màu 304 Queen Christina – Cam Sữa', 1683381253, 1683381253),
(100, 'Son Gucci Rouge À Lèvres Mat', 0, 'images/18-05-2023/avatar21.jpg', 820000, 'Son Gucci Rouge À Lèvres Mat 208 They Met In Argentina Hồng Đất', 1683381887, 1683381887),
(101, 'Son Gucci Rouge à Lèvres Mat', 0, 'images/18-05-2023/avatar22.jpg', 820000, 'Son Gucci Rouge à Lèvres Mat Màu 504 Myra Crimson – Đỏ Đậm', 1683381915, 1683381915),
(102, 'Son Gucci Rouge à Lèvres Mat', 0, 'images/18-05-2023/avatar23.jpg', 820000, 'Son Gucci Rouge à Lèvres Mat Màu 500 Odalie Red – Đỏ Cam', 1683381941, 1683381941),
(103, 'Son Gucci Rouge à Lèvres Mat', 0, 'images/18-05-2023/avatar24.jpg', 820000, 'Son Gucci Rouge à Lèvres Mat Màu 25 Goldie Red – Đỏ Tươi', 1683381965, 1683381965),
(104, 'Son Dior Rouge Ultra Care', 0, 'images/18-05-2023/avatar25.jpg', 840000, 'Son Dior Rouge Ultra Care Màu 635 Ecstase – Đỏ Gạch', 1683382061, 1683382061),
(105, 'Son Kem Dior Rouge Ultra Care Liquid', 0, 'images/18-05-2023/avatar26.jpg', 840000, 'Son Kem Dior Rouge Ultra Care Liquid Màu 707 Bliss – Cam Cháy', 1683382093, 1683382093),
(106, 'Son Dưỡng Dior Lip Glow Màu 007 Raspberry – Hồng Tím', 0, 'images/18-05-2023/avatar27.jpg', 840000, 'Son Dưỡng Dior Lip Glow Màu 007 Raspberry – Hồng Tím', 1683382125, 1683382125),
(107, 'Son Dior Rouge Ultra Care', 0, 'images/18-05-2023/avatar28.jpg', 840000, 'Son Dior Rouge Ultra Care Màu 707 Bliss – Cam Cháy', 1683382157, 1683382157),
(108, 'Son Kem Dior Lip Tattoo', 0, 'images/18-05-2023/avatar29.jpg', 840000, 'Son Kem Dior Lip Tattoo Màu 421 Natural Beige – Cam Ðất', 1683382206, 1683382206),
(109, 'Son Dưỡng Dior Lip Glow', 0, 'images/18-05-2023/avatar30.jpg', 840000, 'Son Dưỡng Dior Lip Glow 001 Pink – Màu Hồng', 1683382263, 1685374878),
(110, 'Son Kem Dior Rouge Ultra Care Liquid', 0, 'images/18-05-2023/avatar31.jpg', 840000, 'Son Kem Dior Rouge Ultra Care Liquid Màu 999 Bloom – Ðỏ Tươi', 1683382339, 1683382339),
(111, 'Son Kem Dior Rouge Ultra Care Liquid', 0, 'images/18-05-2023/avatar32.jpg', 840000, 'Son Kem Dior Rouge Ultra Care Liquid Màu 808 Caress – Đỏ Hồng Đất', 1683382360, 1683382360),
(112, 'Sữa Rửa Mặt Innisfree', 0, 'images/18-05-2023/avatar33.jpg', 206000, 'Sữa Rửa Mặt Innisfree Green Tea Hydrating Amino Acid Cleansing Foam 150gr', 1683382489, 1683382489),
(113, 'Sữa Rửa Mặt SVR ', 0, 'images/18-05-2023/avatar34.jpg', 264000, 'Sữa Rửa Mặt SVR Sebiaclear Purifying & Exfoliating Soap-Free Cleanser 200ml', 1683382528, 1683382528),
(114, 'Kem Dưỡng Tái Tạo Phục Hồi Da', 0, 'images/18-05-2023/avatar35.jpg', 228000, 'Kem Dưỡng Tái Tạo Phục Hồi Da Avène Cicalfate+ Repairing Protective Cream 40ml', 1683382605, 1683382605),
(115, 'Kem Dưỡng Ẩm ', 0, 'images/18-05-2023/avatar36.jpg', 322000, 'Kem Dưỡng Ẩm Điều Tiết Dầu Neogen Dermalogy Black Energy Cream 80ml', 1683382649, 1683382649),
(116, 'Nước Dưỡng Da Dr.Pepti ', 12, 'images/18-05-2023/avatar37.jpg', 244000, 'Nước Dưỡng Da Dr.Pepti Centella Toner 180ml', 1683382707, 1684911531),
(117, 'Kem Dưỡng Bioderma', 5, 'images/18-05-2023/avatar38.jpg', 244000, 'Kem Dưỡng Bioderma Cicabio Soothing Repairing Cream 40ml', 1683382747, 1684834197),
(118, 'Tẩy Da Chết Mặt Đắk Lắk Cocoon', 2, 'images/18-05-2023/avatar39.jpg', 165000, 'Tẩy Da Chết Mặt Cà Phê Đắk Lắk Cocoon Coffee Face Polish 150ml', 1683382785, 1684834187),
(119, 'Tẩy Da Chết Body Dove', 10, 'images/18-05-2023/avatar40.jpg', 240000, 'Tẩy Da Chết Toàn Thân Dove Exfoliating Body', 1683382826, 1684911331);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbtaikhoan`
--

INSERT INTO `tbtaikhoan` (`id`, `Username`, `Password`, `HoTen`, `Mail`) VALUES
(13, 'admin', 'admin', 'Nguyen Xuan An', 'nguyenxuanan'),
(19, 'aa', '1', 'Nguyễn Xuân An', 'q@gmail.com'),
(20, '4451051170', '11', '1', '1'),
(21, '1111', '1', 'Nguyễn Xuân An', 'altth@gmail.com');

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

--
-- Constraints for table `phanquyen_user`
--
ALTER TABLE `phanquyen_user`
  ADD CONSTRAINT `phanquyen_user_ibfk_1` FOREIGN KEY (`phanquyen_id`) REFERENCES `phan_quyen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phan_quyen`
--
ALTER TABLE `phan_quyen`
  ADD CONSTRAINT `phan_quyen_ibfk_1` FOREIGN KEY (`ID_nhom`) REFERENCES `nhom_phanquyen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

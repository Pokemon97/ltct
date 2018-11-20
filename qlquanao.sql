-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 18, 2018 lúc 02:53 PM
-- Phiên bản máy phục vụ: 10.1.29-MariaDB
-- Phiên bản PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlquanao`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `date_order` date DEFAULT NULL,
  `total` int(11) DEFAULT NULL COMMENT 'tổng tiền',
  `payment` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'hình thức thanh toán',
  `note` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bill` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL COMMENT 'số lượng',
  `unit_price` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_type` int(10) UNSIGNED DEFAULT NULL,
  `maker` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `unit_price` float DEFAULT NULL,
  `promotion_price` float DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `id_type`, `maker`, `description`, `unit_price`, `promotion_price`, `image`, `unit`, `new`, `created_at`, `updated_at`, `quantity`) VALUES
(33, 'CHÂN VÁY XÒE CÁCH ĐIỆU - NÂU TÂY', 17, 'abc', NULL, 300000, 250000, 'tkZc_41548bc71940c55477cfb9099aeea058.png', NULL, 1, '2018-11-07 13:50:42', '2018-11-07 13:50:42', 100),
(34, 'Váy đầm thời trang công sở', 17, 'abc', '<p>abc</p>', 300000, NULL, 'GGQC_vay-dam-maxxshop-1.png', NULL, 1, '2018-11-07 13:53:35', '2018-11-07 13:53:35', 10),
(35, 'Áo kiểu Loza tay loe đính nút thời trang', 18, 'def', NULL, 500000, NULL, 'C7je_ao-kieu-Loza-tay-loe-dinh-nut-2.jpg', NULL, 1, '2018-11-07 13:55:28', '2018-11-07 13:55:28', 95),
(36, 'Áo Kiểu Thời Trang Cindy', 18, 'def', '<p>abcdef</p>', 600000, 450000, 'R8eT_341873-ao-kieu-thoi-trang-cindy.jpg', NULL, 0, '2018-11-07 13:57:13', '2018-11-07 13:57:13', 100),
(37, 'Quần nữ ống rộng', 19, 'abc', NULL, 100000, NULL, 'gwGJ_c0a31ca0b304b4f79a47868ddab20034.jpg_670x670q75.jpg', NULL, 0, '2018-11-07 13:59:09', '2018-11-07 13:59:09', 45),
(38, 'Set Áo Dài Cách Tân Hoa 3D', 20, 'abc123', NULL, 1000000, 800000, 'hMBq_344067-_344057-vn-2-3-4.jpg', NULL, 1, '2018-11-07 14:00:48', '2018-11-07 14:00:48', 45),
(39, 'Áo khoác nữ kaki phối nón màu rêu', 21, 'def', NULL, 2000000, 1500000, 'V3W6_127_Ao_khoac_nu_kaki_phoi_non_mau_reu_b0157.jpg', NULL, 1, '2018-11-07 14:02:12', '2018-11-07 14:02:12', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `link` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type_products`
--

CREATE TABLE `type_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `type_products`
--

INSERT INTO `type_products` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(17, 'Váy đầm', '<p>váy</p>', '9ycg_62-bai-viet-ban-hang-vay-dam.jpg', '2018-11-07 13:43:57', '2018-11-07 13:54:04'),
(18, 'Áo thời trang', '<p>áo</p>', 'iwpx_341866-ao-kieu-sellyna-thoi-trang.jpg', '2018-11-07 13:44:55', '2018-11-07 13:44:55'),
(19, 'Quần thời trang', '<p>quần</p>', 'c8tF_quan-nu-skinny-quan-jeans-nu-lung-cao-dang-om-glq054-1m4G3-J0h8ml_simg_ab1f47_350x350_maxb.jpg', '2018-11-07 13:46:07', '2018-11-07 13:46:07'),
(20, 'Áo dài', '<p>ao dài</p>', 'C6OF_Vải-áo-dài-hoa-cúc-AD-HG-HT1718-2.jpg', '2018-11-07 13:47:43', '2018-11-07 13:47:43'),
(21, 'Áo khoác', '<p>áo khoác</p>', 'mZYV_tải xuống.jpg', '2018-11-07 13:48:56', '2018-11-07 13:48:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quyen` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`, `quyen`) VALUES
(1, 'Vũ Tuấn Anh', 'tuananh77717@gmail.com', '$2y$10$Lf2cmk8/WOSO10e1Pwab2.E2zhBSVF2djNAxK04lMz4BPHulLZMzq', '0961582848', 'số 2 - ngách 20 - ngõ Trại Cá - Trương Định - Hai Bà Trưng', 'OGuDTMuz7FMoLja5o8Dp3uXNkKDDZ4C4LBuJrZ4umu5E6ybU9wb5X9e6lS7R', '2018-11-18 07:26:52', '2018-11-18 12:12:54', 1),
(2, 'Phạm Đình Tuấn Anh', '123@gmail.com', '$2y$10$IQ8GFlam73LopakTxPm2lODpptOmCPwsc/EPELuuQK3nM7VklIBjG', NULL, NULL, NULL, '2018-11-18 07:27:34', '2018-11-18 07:28:12', 1),
(3, 'Nguyễn Xuân Thiện', 'abc@gmail.com', '$2y$10$UboHef.YP2sIxRV9F6rizOufJu2yyMzHxiGX7yjFmVLSBWH/lAVoO', '?????', '?????', 'Ipzce98AuUyIE5Fc4TlHJvAgKG3dnfLrbXAG1YzQRI05hVsZPY8wzHWGMKsX', '2018-11-18 07:29:33', '2018-11-18 13:04:48', 1),
(4, 'Nguyễn Văn Đoàn', 'xyz@gmail.com', '$2y$10$zfH7SVsHxheLVNWPdAxOqOiDYB4zckTwqV90b6lcEMrC/A34.epNS', NULL, NULL, NULL, '2018-11-18 07:30:19', '2018-11-18 07:30:19', 1),
(6, 'Vũ Tuấn Anh', 'vutuananhsama@gmail.com', '$2y$10$RO1C1kE27exdDEp3aiHmCewuQoOQwr0VsP/7BKIOhP0bPzPD9Mzq2', NULL, 'số 2 - ngách 20 - ngõ Trại Cá - Trương Định - Hai Bà Trưng', NULL, '2018-11-18 08:22:56', '2018-11-18 08:22:56', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_ibfk_1` (`id_customer`);

--
-- Chỉ mục cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_detail_ibfk_2` (`id_product`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id_type_foreign` (`id_type`);

--
-- Chỉ mục cho bảng `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `type_products`
--
ALTER TABLE `type_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `type_products`
--
ALTER TABLE `type_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_id_type_foreign` FOREIGN KEY (`id_type`) REFERENCES `type_products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

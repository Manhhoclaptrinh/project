-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th1 15, 2026 lúc 11:03 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ql_thu_vien`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `published_year` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `books`
--

INSERT INTO `books` (`book_id`, `title`, `category_id`, `publisher_id`, `price`, `published_year`, `stock`) VALUES
(1, 'Lập trình C', 1, 2, 75000.00, 2020, 10),
(2, 'Python cơ bản', 1, 1, 120000.00, 2021, 8),
(3, 'Java nâng cao', 1, 2, 150000.00, 2019, 6),
(4, 'Kinh tế vi mô', 2, 2, 98000.00, 2018, 5),
(5, 'Marketing căn bản', 2, 1, 110000.00, 2020, 7),
(6, 'Dế mèn phiêu lưu ký', 5, 3, 45000.00, 2015, 20),
(7, 'Toán cao cấp', 4, 2, 130000.00, 2017, 4),
(8, 'Vật lý đại cương', 4, 2, 125000.00, 2016, 6),
(9, 'Hóa học phổ thông', 4, 2, 90000.00, 2018, 5),
(10, 'Truyện cổ Grimm', 3, 3, 60000.00, 2014, 12),
(11, 'Sherlock Holmes', 3, 1, 80000.00, 2016, 9),
(12, 'Clean Code', 1, 1, 180000.00, 2022, 3),
(13, 'Data Structures', 1, 2, 160000.00, 2021, 4),
(14, 'Kỹ năng sống', 5, 3, 50000.00, 2019, 10),
(15, 'Thiếu nhi thông minh', 5, 3, 55000.00, 2020, 8),
(16, 'Sách lỗi', 1, 1, 50000.00, 2023, -5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'CNTT'),
(4, 'Khoa học'),
(2, 'Kinh tế'),
(5, 'Thiếu nhi'),
(3, 'Văn học');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loans`
--

CREATE TABLE `loans` (
  `loan_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `loan_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loans`
--

INSERT INTO `loans` (`loan_id`, `member_id`, `loan_date`, `due_date`, `status`) VALUES
(1, 1, '2024-01-01', '2024-01-10', 'BORROWED'),
(2, 2, '2024-01-02', '2024-01-11', 'RETURNED'),
(3, 3, '2024-01-03', '2024-01-12', 'BORROWED'),
(4, 4, '2024-01-04', '2024-01-13', 'RETURNED'),
(5, 5, '2024-01-05', '2024-01-14', 'BORROWED'),
(6, 6, '2024-01-06', '2024-01-15', 'BORROWED'),
(7, 7, '2024-01-07', '2024-01-16', 'RETURNED'),
(8, 8, '2024-01-08', '2024-01-17', 'BORROWED'),
(9, 1, '2024-01-09', '2024-01-18', 'RETURNED'),
(10, 2, '2024-01-10', '2024-01-19', 'BORROWED'),
(11, 3, '2024-01-11', '2024-01-20', 'BORROWED'),
(12, 4, '2024-01-12', '2024-01-21', 'RETURNED');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loan_items`
--

CREATE TABLE `loan_items` (
  `loan_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loan_items`
--

INSERT INTO `loan_items` (`loan_id`, `book_id`, `qty`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 0),
(2, 3, 1),
(2, 4, 1),
(3, 5, 2),
(3, 6, 1),
(4, 7, 1),
(4, 8, 1),
(5, 9, 1),
(5, 10, 1),
(6, 11, 1),
(6, 12, 1),
(7, 13, 1),
(7, 14, 1),
(8, 1, 1),
(8, 15, 1),
(9, 2, 1),
(9, 3, 1),
(10, 4, 1),
(10, 5, 1),
(11, 6, 1),
(11, 7, 1),
(12, 8, 1),
(12, 9, 1),
(12, 10, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`member_id`, `full_name`, `phone`, `created_at`) VALUES
(1, 'Nguyễn Văn A', '090000001', '2026-01-15 16:12:00'),
(2, 'Trần Thị B', '090000002', '2026-01-15 16:12:00'),
(3, 'Lê Văn C', '090000003', '2026-01-15 16:12:00'),
(4, 'Phạm Thị D', '090000004', '2026-01-15 16:12:00'),
(5, 'Hoàng Văn E', '090000005', '2026-01-15 16:12:00'),
(6, 'Đỗ Thị F', '090000006', '2026-01-15 16:12:00'),
(7, 'Bùi Văn G', '090000007', '2026-01-15 16:12:00'),
(8, 'Võ Thị H', '090000008', '2026-01-15 16:12:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `publishers`
--

CREATE TABLE `publishers` (
  `publisher_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `publishers`
--

INSERT INTO `publishers` (`publisher_id`, `name`) VALUES
(2, 'NXB Giáo Dục'),
(3, 'NXB Kim Đồng'),
(1, 'NXB Trẻ');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `fk_books_publisher` (`publisher_id`),
  ADD KEY `idx_books_category` (`category_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`loan_id`),
  ADD KEY `idx_loans_status_due` (`status`,`due_date`),
  ADD KEY `idx_loans_member_date` (`member_id`,`loan_date`);

--
-- Chỉ mục cho bảng `loan_items`
--
ALTER TABLE `loan_items`
  ADD PRIMARY KEY (`loan_id`,`book_id`),
  ADD KEY `idx_loan_items_book` (`book_id`);

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Chỉ mục cho bảng `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`publisher_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `loans`
--
ALTER TABLE `loans`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `publishers`
--
ALTER TABLE `publishers`
  MODIFY `publisher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_books_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `fk_books_publisher` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`publisher_id`);

--
-- Các ràng buộc cho bảng `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `fk_loans_member` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);

--
-- Các ràng buộc cho bảng `loan_items`
--
ALTER TABLE `loan_items`
  ADD CONSTRAINT `fk_loan_items_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `fk_loan_items_loan` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`loan_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

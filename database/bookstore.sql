-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 05:02 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `special` tinyint(1) DEFAULT 0,
  `sale_off` int(3) DEFAULT 0,
  `picture` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ordering` int(11) DEFAULT 10,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `description`, `price`, `special`, `sale_off`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `category_id`) VALUES
(25, 'Cẩm Nang Cấu Trúc Tiếng Anh', '<p>Để con được ốm&nbsp;c&oacute; thể coi l&agrave; một cuốn nhật k&yacute; học l&agrave;m mẹ th&ocirc;ng qua những c&acirc;u chuyện từ trải nghiệm thực tế m&agrave; chị&nbsp;Uy&ecirc;n B&ugrave;i&nbsp;đ&atilde; trải qua từ khi mang thai đến khi em b&eacute; ch&agrave;o đời v&agrave; trở th&agrave;nh một c&ocirc; b&eacute; khỏe mạnh, vui vẻ. C&ugrave;ng với những c&acirc;u chuyện nhỏ th&uacute; vị của người mẹ l&agrave; lời khuy&ecirc;n mang t&iacute;nh chuy&ecirc;n m&ocirc;n, giải đ&aacute;p cụ thể từ b&aacute;c sỹ&nbsp;Nguyễn Tr&iacute; Đo&agrave;n, gi&uacute;p h&oacute;a giải những hiểu lầm từ kinh nghiệm d&acirc;n gian được truyền lại, cũng như l&yacute; giải một c&aacute;ch khoa học những th&ocirc;ng tin chưa đ&uacute;ng đắn đang được lưu truyền hiện nay, mang đến g&oacute;c nh&igrave;n đ&uacute;ng đắn nhất cho mỗi hiện tượng, sự việc với những kiến thức y khoa hiện đại được cập nhật li&ecirc;n tục. Cuốn s&aacute;ch sẽ gi&uacute;p c&aacute;c bậc phụ huynh trang bị một số kiến thức cơ bản trong việc chăm s&oacute;c trẻ một c&aacute;ch khoa học v&agrave; g&oacute;p phần gi&uacute;p c&aacute;c mẹ v&agrave; những-người-sẽ-l&agrave;-mẹ trở n&ecirc;n tự tin hơn trong việc chăm con, xua tan đi những lo lắng, để mỗi em b&eacute; ra đời đều được hưởng sự chăm s&oacute;c tốt nhất.</p>', '25000', 1, 10, '73591AtX.jpg', '2022-01-04 11:52:45', 'admin', '2022-03-15 22:46:59', 'admin', 'active', 8, 8),
(26, 'Giáo Trình Coreldraw X7 & X8 & X91', '<p>Gi&aacute;o Tr&igrave;nh Coreldraw X7 &amp; X8 &amp; X9</p>', '245000', 1, 50, 'yTp71XU6.jpg', '2022-01-04 11:52:45', 'admin', '2022-03-19 23:29:52', 'admin', 'active', 12, 31),
(29, 'Điệp Viên Hoàn Hảo X6 (Tái Bản)', 'Điệp Viên Hoàn Hảo X6 (Tái Bản)', '128000', 1, 50, 'rCg1zBSa.jpg', '2022-01-12 15:25:21', 'admin', '2022-01-15 23:08:06', 'admin', 'active', 10, 6),
(33, 'Kiến Trúc Hướng Dòng Thông Gió Tự Nhiên', 'Price: giá trị này không được rỗng!\r\nSale Off: giá trị này không được rỗng!\r\nPicture: giá trị này không được rỗng!', '10000', 1, 10, 'hiTgJ8l6.jpg', '2022-01-12 16:39:00', 'admin', '2022-03-15 22:47:15', 'admin', 'active', 7, 8),
(34, 'Giáo Trình Kỹ Thuật Lập Trình C Căn Bản Và Nâng Cao', 'abc', '2500', 1, 10, 'AFEWVXxp.jpg', '2022-01-15 22:24:24', 'admin', '2022-03-15 22:47:12', 'admin', 'active', 7, 8),
(35, 'Nuôi Con Không Phải Là Cuộc Chiến (Tái bản 2020)', 'Nuôi Con Không Phải Là Cuộc Chiến (Tái bản 2020)', '99000', 1, 20, 'gl3NAXKB.jpg', '2022-01-15 23:01:14', 'admin', NULL, NULL, 'active', 10, 30),
(37, 'Chờ Đến Mẫu Giáo Thì Đã Muộn', 'Trong xã hội hiện nay, khi người mẹ luôn dễ dàng tiếp cận với vô vàn các\r\n                                            nguồn thông tin thì việc chăm sóc trẻ đã trở nên dễ dàng nhưng đồng thời lại\r\n                                            khó hơn gấp bội. Để con được ốm, do đó, còn hơn cả một cuốn sách thường thức\r\n                                            về y khoa xung quanh việc chăm sóc cơ bản cho trẻ giai đoạn 0-2 tuổi. Nó bao\r\n                                            hàm một thái độ của bậc làm cha mẹ, rằng để con có thể trưởng thành, con có\r\n                                            quyền bị ốm đau, bị mắc bệnh; và vì vậy, có quyền không bị mang ra so\r\n                                            sánh... [với con nhà hàng xóm].', '90000', 1, 20, 'oEh45yTv.jpg', '2022-01-16 10:49:12', 'admin', '2022-01-19 13:43:26', 'admin', 'active', 10, 30),
(38, 'Ăn Dặm Kiểu Nhật (Tái Bản 2018)', 'Ăn Dặm Kiểu Nhật (Tái Bản 2018)', '99000', 1, 20, 'V6SBYfkA.jpg', '2022-01-18 12:24:13', 'admin', NULL, NULL, 'active', 10, 30),
(39, 'Cách Khen, Cách Mắng, Cách Phạt Con', 'Cách Khen, Cách Mắng, Cách Phạt Con', '129000', 1, 71, 'cgi9bQ5a.jpg', '2022-01-19 16:21:38', 'admin', '2022-02-15 21:57:25', 'admin', 'active', 10, 30),
(40, 'Thử Thách Trí Tuệ', 'Thử Thách Trí Tuệ', '135000', 1, 20, 'S8DsuRhn.jpg', '2022-01-19 16:22:10', 'admin', '2022-02-15 21:56:05', 'admin', 'active', 10, 30),
(41, 'Ăn Dặm Không Phải Là Cuộc Chiến (Tái bản)', 'Ăn Dặm Không Phải Là Cuộc Chiến (Tái bản)', '250000', 1, 50, 'TzQeBYi8.jpg', '2022-01-19 16:22:35', 'admin', '2022-02-15 22:10:27', 'admin', 'active', 10, 30),
(42, 'Bác Sĩ Riêng Của Bé Yêu - Chào Con! Ba Mẹ Đã Sẵn Sàng (Tái Bản)', 'Bác Sĩ Riêng Của Bé Yêu - Chào Con! Ba Mẹ Đã Sẵn Sàng (Tái Bản)', '70000', 1, 10, '8aUzl2Rv.jpg', '2022-01-19 16:22:56', 'admin', '2022-02-15 22:03:16', 'admin', 'active', 10, 30),
(43, '90% Trẻ Thông Minh Nhờ Cách Trò Chuyện Đúng Đắn Của Cha Mẹ', '90% Trẻ Thông Minh Nhờ Cách Trò Chuyện Đúng Đắn Của Cha Mẹ', '39000', 1, 31, 'MjFrs5IT.jpg', '2022-02-15 22:06:46', 'admin', NULL, NULL, 'active', 10, 30),
(44, 'Tự Học 2000 Từ Vựng Tiếng Anh Theo Chủ Đề', 'Tự Học 2000 Từ Vựng Tiếng Anh Theo Chủ Đề', '92000', 1, 25, 'YNWubEx7.jpg', '2022-02-15 22:19:17', 'admin', NULL, NULL, 'active', 10, 33),
(45, 'Hackers Ielts: Writing', 'Hackers Ielts: Writing', '239000', 1, 32, '0uQvkeoh.jpg', '2022-02-15 22:20:52', 'admin', NULL, NULL, 'active', 10, 33),
(46, 'Hack Não Từ Vựng Tiếng Nhật - Hướng Dẫn Ghi Nhớ Nhanh Từ Vựng Qua 3 Phương Pháp', 'Hack Não Từ Vựng Tiếng Nhật - Hướng Dẫn Ghi Nhớ Nhanh Từ Vựng Qua 3 Phương Pháp', '185000', 1, 35, 'SRta9AUb.jpg', '2022-02-15 22:22:04', 'admin', NULL, NULL, 'active', 10, 33),
(47, 'Giải Thích Ngữ Pháp Tiếng Anh (Bài Tập Và Đáp Án)', 'Giải Thích Ngữ Pháp Tiếng Anh (Bài Tập Và Đáp Án)', '145000', 1, 10, 'fJ0Y6Azc.png', '2022-02-15 22:23:12', 'admin', NULL, NULL, 'active', 10, 33),
(48, '25 Chuyên Đề Ngữ Pháp Tiếng Anh Trọng Tâm Tập 2', '25 Chuyên Đề Ngữ Pháp Tiếng Anh Trọng Tâm Tập 2', '240000', 1, 30, 'LPise6RT.jpg', '2022-02-15 22:24:29', 'admin', NULL, NULL, 'active', 10, 33),
(49, 'Giáo Trình Hán Ngữ 1 - Tập 1 - Quyển Thượng (Phiên Bản Mới)', 'Giáo Trình Hán Ngữ 1 - Tập 1 - Quyển Thượng (Phiên Bản Mới)', '240000', 1, 30, 'K62Jet3O.jpg', '2022-02-15 22:24:29', 'admin', '2022-02-15 22:26:47', 'admin', 'active', 10, 33),
(50, '25 Chuyên Đề Ngữ Pháp Tiếng Anh Trọng Tâm – (Tập 1)', '25 Chuyên Đề Ngữ Pháp Tiếng Anh Trọng Tâm – (Tập 1)', '200000', 1, 50, 'R2vkQgWi.jpg', '2022-02-15 22:29:31', 'admin', NULL, NULL, 'active', 10, 33),
(51, 'Tự Học Tiếng Anh Giao Tiếp Chỉ Trong 3 Tháng - Eng Breaking (Kèm Files Mềm Học Offline Và Tài Khoản Học Online)', 'Tự Học Tiếng Anh Giao Tiếp Chỉ Trong 3 Tháng - Eng Breaking (Kèm Files Mềm Học Offline Và Tài Khoản Học Online)', '240000', 1, 10, 'vf6ruZiX.jpg', '2022-02-15 22:31:09', 'admin', NULL, NULL, 'active', 10, 33),
(52, 'Sách luyện thi hội thi Tin học trẻ với Scratch 3.0 bảng B1_Thi kỹ năng lập trình cấp Trung học cơ sở', 'Sách luyện thi hội thi Tin học trẻ với Scratch 3.0 bảng B1_Thi kỹ năng lập trình cấp Trung học cơ sở', '399000', 1, 80, 'ikRmLYgH.jpg', '2022-02-18 21:58:35', 'admin', NULL, NULL, 'active', 10, 31),
(54, 'Tự Học Nhanh Đồ Họa Trên Illustrator 8.0 Và 9.0', 'Tự Học Nhanh Đồ Họa Trên Illustrator 8.0 Và 9.0', '99000', 1, 30, 't6ZmBFeD.jpg', '2022-02-18 22:00:03', 'admin', NULL, NULL, 'active', 10, 31),
(55, 'Vi Điều Khiển Và Ứng Dụng - Arduino Dành Cho Người Tự Học (Tái Bản 2019)', 'Vi Điều Khiển Và Ứng Dụng - Arduino Dành Cho Người Tự Học (Tái Bản 2019)', '137000', 1, 20, 'YpNqZmzw.jpg', '2022-02-18 22:04:36', 'admin', '2022-02-25 23:52:16', 'admin', 'active', 10, 31),
(56, 'Thực Hành Microsoft Word - Excel - PowerPoint 2016 Bằng Các Tuyệt Chiêu (Sách kèm theo CD Bài tập) (Tái bản năm 2020)', 'Thực Hành Microsoft Word - Excel - PowerPoint 2016 Bằng Các Tuyệt Chiêu (Sách kèm theo CD Bài tập) (Tái bản năm 2020)', '230000', 1, 30, '1BqWgFRw.jpg', '2022-02-18 22:05:37', 'admin', NULL, NULL, 'active', 10, 31),
(57, 'Sách Lập trình với Scratch 3.0 (Dành cho học sinh 8-14 tuổi)', 'Sách Lập trình với Scratch 3.0 (Dành cho học sinh 8-14 tuổi)', '99000', 1, 10, 'zLPXadfv.png', '2022-02-18 22:06:26', 'admin', NULL, NULL, 'active', 10, 31),
(58, 'Tin Học Văn Phòng Microsoft Office Dành Cho Người Bắt Đầu Dùng Cho Các Phiên Bản 2019 -2016-2013', 'Tin Học Văn Phòng Microsoft Office Dành Cho Người Bắt Đầu Dùng Cho Các Phiên Bản 2019 -2016-2013', '79000', 1, 10, 'M4FtuUig.jpg', '2022-02-18 22:07:29', 'admin', NULL, NULL, 'active', 10, 31),
(59, 'Tự Học Photoshop CC Toàn Tập', 'Tự Học Photoshop CC Toàn Tập', '25000', 1, 5, 'JpZ6h0IW.jpg', '2022-02-18 22:08:01', 'admin', NULL, NULL, 'active', 10, 31),
(61, 'Admin 1111111', '', '99000', 1, 10, '', '2022-03-20 00:26:18', 'admin', '2022-03-20 00:26:53', 'admin', 'active', 10, 32);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `books` text NOT NULL,
  `prices` text NOT NULL,
  `quantities` text NOT NULL,
  `names` text NOT NULL,
  `pictures` text NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `username`, `books`, `prices`, `quantities`, `names`, `pictures`, `status`, `date`) VALUES
('M3cNmBS', 'admin', '[\"29\",\"47\",\"48\"]', '[\"64000\",\"130500\",\"168000\"]', '[\"1\",\"1\",\"1\"]', '[\"Điệp Viên Hoàn Hảo X6 (Tái Bản)\",\"Giải Thích Ngữ Pháp Tiếng Anh (Bài Tập Và Đáp Án)\",\"25 Chuyên Đề Ngữ Pháp Tiếng Anh Trọng Tâm Tập 2\"]', '[\"rCg1zBSa.jpg\",\"fJ0Y6Azc.png\",\"LPise6RT.jpg\"]', 'inactive', '2022-02-24 23:36:26'),
('yejXZKN', 'admin', '[\"44\",\"45\",\"46\",\"51\"]', '[\"69000\",\"162520\",\"120250\",\"216000\"]', '[\"1\",\"1\",\"1\",\"1\"]', '[\"Tự Học 2000 Từ Vựng Tiếng Anh Theo Chủ Đề\",\"Hackers Ielts: Writing\",\"Hack Não Từ Vựng Tiếng Nhật - Hướng Dẫn Ghi Nhớ Nhanh Từ Vựng Qua 3 Phương Pháp\",\"Tự Học Tiếng Anh Giao Tiếp Chỉ Trong 3 Tháng - Eng Breaking (Kèm Files Mềm Học Offline Và Tài Khoản Học Online)\"]', '[\"YNWubEx7.jpg\",\"0uQvkeoh.jpg\",\"SRta9AUb.jpg\",\"vf6ruZiX.jpg\"]', 'inactive', '2022-02-26 00:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `show_at_home` tinyint(1) DEFAULT 0,
  `ordering` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `show_at_home`, `ordering`) VALUES
(6, ' Thường Thức - Gia Đình', 'mWFcLSl4.jpg', '2013-12-09 00:00:00', '0', '2022-03-25 20:03:06', 'admin', 'active', 0, 13),
(7, 'Y học', 'mP2NJ8wO.jpg', '2013-12-09 00:00:00', '0', '2022-01-18 12:31:12', 'admin', 'active', 0, 13),
(8, 'Truyện Tranh', '6kOhCQ0x.jpg', '2013-12-09 00:00:00', '0', '2022-02-18 21:55:47', 'admin', 'active', 0, 10),
(9, ' Văn Hoá - Nghệ Thuật - Du Lịch', 'PlQi8I2A.jpg', '2013-12-06 00:00:00', '0', '2022-01-16 15:56:14', 'admin', 'active', 0, 9),
(28, 'Trinh Thám', 'Sv6THy3F.jpg', '2022-01-14 10:54:09', 'admin', '2022-02-15 22:12:35', 'admin', 'active', 0, 10),
(30, 'Bà mẹ - Em bé', 'KvGsXwNt.jpg', '2022-01-15 23:00:31', 'admin', '2022-02-28 18:47:05', 'admin', 'active', 1, 10),
(31, 'Công Nghệ Thông Tin', 'iWLBySTm.jpg', '2022-01-16 00:10:13', 'admin', '2022-02-18 21:55:24', 'admin', 'active', 1, 10),
(32, 'Kinh Tế', 'WqF8daJo.png', '2022-01-18 11:01:36', 'admin', '2022-02-28 18:36:13', 'admin', 'active', 0, 10),
(33, 'Ngoại Ngữ', 'NOTq3GWL.jpg', '2022-02-15 22:14:07', 'admin', '2022-02-28 18:36:13', 'admin', 'active', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_acp` tinyint(1) DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ordering` int(11) DEFAULT 10,
  `privilege_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `privilege_id`) VALUES
(1, 'Admin', 1, '2013-11-11 00:00:00', 'admin', '2022-03-25 20:07:08', 'admin', 'active', 5, '1,2,3,4,5,6,7,8,9,10,11,12'),
(2, 'Manager', 1, '2013-11-07 00:00:00', 'admin', '2022-01-10 16:40:35', 'admin', 'active', 4, '1,2,3,4,6,7,8,9,10'),
(3, 'Member', 0, '2013-11-12 00:00:00', 'admin', '2022-01-10 16:40:35', 'admin', 'active', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `module` varchar(45) NOT NULL,
  `controller` varchar(45) NOT NULL,
  `action` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `name`, `module`, `controller`, `action`) VALUES
(1, 'Hiển thị danh sách người dùng', 'backend', 'user', 'index'),
(2, 'Thay đổi status của người dùng', 'backend', 'user', 'status'),
(3, 'Cập nhật thông tin của người dùng', 'backend', 'user', 'form'),
(4, 'Thay đổi status của người dùng sử dụng Ajax', 'backend', 'user', 'ajaxChangeStatus'),
(5, 'Xóa một hoặc nhiều người dùng', 'backend', 'user', 'delete'),
(6, 'Thay đổi vị trí hiển thị của các người dùng', 'backend', 'user', 'ordering'),
(7, 'Truy cập menu Admin Control Panel', 'backend', 'index', 'index'),
(8, 'Đăng nhập Admin Control Panel', 'backend', 'index', 'login'),
(9, 'Đăng xuất Admin Control Panel', 'backend', 'index', 'logout'),
(10, 'Cập nhật thông tin tài khoản quản trị', 'backend', 'index', 'profile'),
(11, 'Hiển thị danh sách các group', 'backend', 'group', 'index'),
(12, 'Hiển thị dashboard', 'backend', 'index', 'index');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT 10,
  `link` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `name`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `link`, `description`) VALUES
(1, 'Khởi động hội sách mùa hè', 'LVrgBi9H.jpg', '2022-01-18 06:49:30', NULL, '2022-02-26 00:11:36', 'admin', 'active', 10, '', 'Khởi động hội sách mùa hè'),
(2, 'Mua sách tại gia, khỏi lo về giá', 'DkbQ1RiI.jpg', '2022-01-18 06:52:25', NULL, '2022-02-26 00:11:44', 'admin', 'active', 10, '', ''),
(3, 'Hội sách thiếu nhi', '3owk0C6c.jpg', '2022-01-18 06:52:45', NULL, '2022-02-26 00:11:25', 'admin', 'inactive', 10, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `register_ip` varchar(25) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ordering` int(11) DEFAULT 10,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `fullname`, `phone`, `address`, `password`, `created`, `created_by`, `modified`, `modified_by`, `register_date`, `register_ip`, `status`, `ordering`, `group_id`) VALUES
(20, 'admin', 'admin@gmail.com', 'Admin', 378444108, 'ly chinh thang', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, '2022-01-25 20:58:42', 'admin', '2022-01-25 20:58:42', '::1', 'active', 10, 1),
(37, 'trunghq1109', 'trunghq1109@gmail.com', 'Quốc Trung111', 385111413, NULL, '7a0a19566e5098930764ce068b95dfff', '2022-01-10 14:04:00', 'admin', '2022-01-12 16:41:45', 'admin', NULL, NULL, 'active', 10, 2),
(38, 'Test01', 'test01@gmail.com', 'Test01', 369220003, NULL, 'fb2beeeb1df0490a01e0de5846cdadf2', '2022-01-12 06:58:07', 'admin', '2022-01-12 07:00:01', 'admin', NULL, NULL, 'active', 10, 3),
(39, 'Test02', 'test02@gmail.com', 'Test02', NULL, NULL, 'f1e38922f3c2845b9680c8d00594568d', '2022-01-12 06:58:39', 'admin', '2022-02-28 13:34:24', 'admin', NULL, NULL, 'active', 10, 3),
(41, 'Test04', 'test04@gmail.com', 'Test04', NULL, NULL, '2b634c0c3844996599b00fc7dd37f276', '2022-01-12 06:59:39', 'admin', '2022-02-28 13:33:56', 'admin', NULL, NULL, 'active', 10, 3),
(42, 'Test05', 'Test05@gmail.com', '', NULL, NULL, '2b634c0c3844996599b00fc7dd37f276', '2022-02-28 13:35:24', 'admin', '2022-02-28 13:39:58', 'admin', NULL, NULL, 'inactive', 10, 3),
(43, 'tester01', 'tester01@gmail.com', 'Test error123', NULL, NULL, '3b269d99b6c31f1467421bbcfdec7908', '2022-03-25 10:18:11', 'admin', '2022-03-25 10:19:08', 'admin', NULL, NULL, 'active', 10, 2),
(44, 'ABC1997', 'ABC1997@gmail.com', 'Admin 5021', NULL, NULL, '3b269d99b6c31f1467421bbcfdec7908', NULL, NULL, NULL, NULL, '2022-04-16 23:44:28', '::1', 'inactive', 10, NULL),
(45, 'test147', 'test147@gmail.com', 'abxccc', NULL, NULL, '3b269d99b6c31f1467421bbcfdec7908', NULL, NULL, NULL, NULL, '2022-04-17 21:54:15', '::1', 'inactive', 10, NULL),
(46, 'abcyyy', 'abcyyy@gmail.com', 'aaaaaaaaaaaaaaa111', NULL, NULL, '3b269d99b6c31f1467421bbcfdec7908', NULL, NULL, NULL, NULL, '2022-04-18 10:46:32', '::1', 'inactive', 10, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

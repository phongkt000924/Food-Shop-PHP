-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 28, 2021 lúc 10:17 AM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlydathang`
--
CREATE DATABASE IF NOT EXISTS `quanlydathang` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `quanlydathang`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `sodondh` int(11) NOT NULL,
  `mshh` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `giadathang` int(11) NOT NULL,
  `giamgia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `sodondh` int(11) NOT NULL,
  `mskh` int(11) NOT NULL,
  `msnv` int(11) DEFAULT NULL,
  `ngaydh` date NOT NULL,
  `ngaygh` date DEFAULT NULL,
  `trangthaidh` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachikh`
--

CREATE TABLE `diachikh` (
  `madc` int(11) NOT NULL,
  `diachi` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mskh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `diachikh`
--

INSERT INTO `diachikh` (`madc`, `diachi`, `mskh`) VALUES
(1, 'cờ đỏ', 1),
(7, 'Số 4 the god', 1),
(8, 'Cần Thơ', 1),
(11, 'So 4', 2),
(12, '', 1),
(13, 'Trà ếch', 1),
(14, 'Ninh Kiều', 1),
(15, 'Hà Nội', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa`
--

CREATE TABLE `hanghoa` (
  `mshh` int(11) NOT NULL,
  `tenhh` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quycach` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `mota` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `gia` int(11) NOT NULL,
  `soluonghang` int(11) NOT NULL,
  `maloaihang` int(11) NOT NULL,
  `hot` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hanghoa`
--

INSERT INTO `hanghoa` (`mshh`, `tenhh`, `quycach`, `mota`, `gia`, `soluonghang`, `maloaihang`, `hot`) VALUES
(5, 'Dưa leo', 'kg', 'Dưa leo ăn rất ngon, ăn sống cũng ngon, đem sào cũng ngon, để đắp mặt nạ cũng binh, nói chung dưa leo tuyệt vời lắm hãy mua dưa leo đi không ăn thì bỏ cũng được...', 25000, 49, 2, b'1'),
(6, 'Thịt bò', 'kg', 'Thịt bò', 120000, 37, 3, b'1'),
(7, 'Cá Diêu Hồng', 'kg', 'Cá Diêu Hồng ăn rất ngon', 80000, 50, 4, b'1'),
(8, 'Chôm Chôm', 'kg', 'Chôm Chôm ăn rất ngon', 120000, 20, 5, b'1'),
(9, 'Nhãn', 'kg', 'Nhãn ăn rất ngon', 120000, 50, 5, b'1'),
(10, 'Sầu riêng', 'kg', 'Sầu riêng mùi rất khó ngửi nhưng ăn rất ngon', 120000, 50, 5, b'1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhhanghoa`
--

CREATE TABLE `hinhhanghoa` (
  `mahinh` int(11) NOT NULL,
  `tenhinh` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `mshh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hinhhanghoa`
--

INSERT INTO `hinhhanghoa` (`mahinh`, `tenhinh`, `mshh`) VALUES
(9, 'dualeo1.jpg', 5),
(15, 'dualeo2.jpg', 5),
(16, 'dualeo3.jpg', 5),
(17, 'dualeo4.gif', 5),
(18, 'thitbo1.jpg', 6),
(19, 'thitbo2.jpg', 6),
(20, 'thitbo3.jpg', 6),
(21, 'thitbo4.jpg', 6),
(22, 'cadieuhong1.jpg', 7),
(23, 'cadieuhong2.jpg', 7),
(24, 'cadieuhong3.jpg', 7),
(25, 'cadieuhong4.jpg', 7),
(26, 'chomchom1.png', 8),
(27, 'chomchom2.jpg', 8),
(28, 'chomchom3.jpg', 8),
(29, 'chomchom4.png', 8),
(30, 'nhan1.jpg', 9),
(31, 'nhan2.jfif', 9),
(32, 'nhan3.jpg', 9),
(33, 'nhan4.jpg', 9),
(34, 'sr1.png', 10),
(35, 'sr2.jfif', 10),
(36, 'sr3.jpg', 10),
(37, 'sr4.jfif', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `mskh` int(11) NOT NULL,
  `hotenkh` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tencongty` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sodienthoai` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `sofax` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `matkhau` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`mskh`, `hotenkh`, `tencongty`, `sodienthoai`, `sofax`, `email`, `matkhau`) VALUES
(1, 'Danh Chí Bảo', 'CtyTNHH BaoPoo12', '0385832071', '123', 'bao12@gmail.com', '123'),
(2, 'Bao Chí Dảnh', '', '0385832071', '', 'bao@gmail.com', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaihanghoa`
--

CREATE TABLE `loaihanghoa` (
  `maloaihang` int(11) NOT NULL,
  `tenloaihang` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaihanghoa`
--

INSERT INTO `loaihanghoa` (`maloaihang`, `tenloaihang`) VALUES
(2, 'Rau củ'),
(3, 'Thịt'),
(4, 'Cá'),
(5, 'Trái Cây');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `msnv` int(11) NOT NULL,
  `hotennv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `chucvu` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `diachi` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sodienthoai` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `matkhau` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`msnv`, `hotennv`, `chucvu`, `diachi`, `sodienthoai`, `email`, `matkhau`) VALUES
(1, 'Danh Chí Bảo', 'Admin', 'Số 4 the god', '0385832071', 'admin@gmail.com', '123456'),
(2, 'Bảo the god số 4', 'Nhân viên', 'Số Tư Trà ếch', '0385832071', 'bao@gmail.com', '123');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`sodondh`,`mshh`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`sodondh`),
  ADD KEY `mskh` (`mskh`),
  ADD KEY `msnv` (`msnv`);

--
-- Chỉ mục cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD PRIMARY KEY (`madc`),
  ADD KEY `mskh` (`mskh`);

--
-- Chỉ mục cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`mshh`),
  ADD KEY `maloaihang` (`maloaihang`);

--
-- Chỉ mục cho bảng `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD PRIMARY KEY (`mahinh`),
  ADD KEY `mshh` (`mshh`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`mskh`);

--
-- Chỉ mục cho bảng `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  ADD PRIMARY KEY (`maloaihang`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`msnv`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  MODIFY `madc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `mshh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `mskh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `msnv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `dathang_ibfk_1` FOREIGN KEY (`mskh`) REFERENCES `khachhang` (`mskh`),
  ADD CONSTRAINT `dathang_ibfk_2` FOREIGN KEY (`msnv`) REFERENCES `nhanvien` (`msnv`);

--
-- Các ràng buộc cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD CONSTRAINT `diachikh_ibfk_1` FOREIGN KEY (`mskh`) REFERENCES `khachhang` (`mskh`);

--
-- Các ràng buộc cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `hanghoa_ibfk_1` FOREIGN KEY (`maloaihang`) REFERENCES `loaihanghoa` (`maloaihang`);

--
-- Các ràng buộc cho bảng `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD CONSTRAINT `hinhhanghoa_ibfk_1` FOREIGN KEY (`mshh`) REFERENCES `hanghoa` (`mshh`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 10, 2017 at 04:46 PM
-- Server version: 5.6.30-1+deb.sury.org~wily+2
-- PHP Version: 5.6.11-1ubuntu3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phim1p_com_ee64`
--

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `route_name` varchar(100) NOT NULL,
  `display_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `name`, `parent_id`, `route_name`, `display_order`) VALUES
(1, 'Phim', 0, 'film.index', 1),
(2, 'Tập phim', 0, 'film-episode.index', 2),
(3, 'Quốc gia', 0, 'country.index', 3),
(4, 'Danh mục', 0, 'categpry.index', 4),
(5, 'Danh mục bài viết', 0, 'articles-cate.index', 5),
(6, 'Bài viết', 0, 'articles.index', 6),
(7, 'Tag', 0, 'tag.index', 7),
(8, 'Crew', 0, 'crew.index', 8),
(9, 'Thông tin SEO', 0, 'info-seo.index', 9),
(10, 'Cài đặt', 0, 'settings.index', 10),
(11, 'Thêm mới', 1, 'film.create', 1),
(12, 'Chỉnh sửa', 1, 'film.edit', 2),
(13, 'Xóa', 1, 'film.destroy', 3),
(14, 'Thêm mới', 2, 'film-episode.create', 1),
(15, 'Chỉnh sửa', 2, 'film-episode.edit', 2),
(16, 'Xóa', 2, 'film-episode.destroy', 3),
(17, 'Thêm mới', 3, 'country.create', 1),
(18, 'Chỉnh sửa', 3, 'country.edit', 2),
(19, 'Xóa', 3, 'country.destroy', 3),
(20, 'Thêm mới', 4, 'category.create', 1),
(21, 'Chỉnh sửa', 4, 'category.edit', 2),
(22, 'Xóa', 4, 'category.destroy', 3),
(23, 'Thêm mới', 5, 'articles-cate.create', 1),
(24, 'Chỉnh sửa', 5, 'articles-cate.edit', 1),
(25, 'Xóa', 5, 'articles-cate.destroy', 3),
(26, 'Thêm mới', 6, 'articles.create', 1),
(27, 'Chỉnh sửa', 6, 'articles.edit', 2),
(28, 'Xóa', 6, 'articles.destroy', 3),
(29, 'Thêm mới', 7, 'tag.create', 1),
(30, 'Chỉnh sửa', 7, 'tag.edit', 2),
(31, 'Xóa', 7, 'tag.destroy', 3),
(32, 'Thêm mới', 8, 'crew.create', 1),
(33, 'Chỉnh sửa', 8, 'crew.edit', 2),
(34, 'Xóa', 8, 'crew.destroy', 3),
(35, 'Thêm mới', 9, 'info-seo.create', 1),
(36, 'Cập nhật', 9, 'info-seo.edit', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

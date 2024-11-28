-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-11-28 20:09:17
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `my_project_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `activity`
--

CREATE TABLE `activity` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `activityCategorySmall_id` int(10) UNSIGNED DEFAULT NULL,
  `signUpDate` date DEFAULT NULL,
  `signUpEndDate` date DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `price` int(10) UNSIGNED DEFAULT NULL,
  `activity_teacher_id` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `article_id` int(10) UNSIGNED DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 未刪除, 1: 已刪除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `activity`
--

INSERT INTO `activity` (`id`, `name`, `activityCategorySmall_id`, `signUpDate`, `signUpEndDate`, `startDate`, `endDate`, `price`, `activity_teacher_id`, `location`, `description`, `article_id`, `isDeleted`) VALUES
(1, '小琉球體驗潛水', 5, '2024-10-01', '2024-12-31', '2025-01-01 10:00:00', '2024-12-31 00:00:00', 2500, 0, '', '你是否怕水，卻又想一窺蔚藍的海底世界呢？ 你是否猶豫，到底要不要考一張潛水證照呢？ 體驗潛水，是你最好的選擇！ 專業教練耐心為你講解小學生都可以聽懂的課程， 用簡單又幽默的方式一對一帶你認識裝備、適應呼吸、水下手勢溝通，  即使不會游泳，也能嘗試潛入深海與海龜共游 10歲到70歲都可以嘗試的小琉球必玩水上活動。', NULL, 0),
(2, '小琉球岸潛活動', 5, '2024-10-01', '2024-10-31', '2024-11-01 00:00:00', '2024-11-02 00:00:00', 1000, 0, '', '', NULL, 0),
(3, '水肺潛水體驗課程(泳池)', 1, '2024-12-01', '2024-12-31', '2025-01-01 00:00:00', '2025-01-01 00:00:00', 1500, 0, '', '', NULL, 0),
(4, '美人魚 體驗潛水', 3, '2024-11-01', '2024-11-24', '2024-12-01 00:00:00', '2024-12-02 00:00:00', 1500, 0, '', '', NULL, 0),
(5, 'Level 1自由潛水認證課程', 2, '2024-10-01', '2024-11-30', '2024-12-10 13:30:00', '2024-11-30 00:00:00', 12800, 0, '', '多種潛水系統DIWA, PADI, SSI, AIDA…任您挑選\r\n扎實訓練課程讓您安心考取國際證照\r\n專業教練小班制教學且彈性上課時間\r\n趕緊報名一起解鎖水下新技能吧！', NULL, 0),
(6, '修改課程名稱修改課程名稱修改課程名稱修改課程名稱修改課程名稱修改課程名稱', 5, '2024-11-14', '2024-11-20', '2024-11-20 19:19:00', '2024-11-20 00:00:00', 9999, 0, '', '修改123', NULL, 0),
(8, '水', 2, '0000-00-00', '0000-00-00', '2024-11-28 10:14:00', '0000-00-00 00:00:00', 500, 0, '', '', NULL, 0),
(9, '水水', 5, '2024-11-06', '2024-11-28', '2024-12-19 04:19:00', '2024-11-28 00:00:00', 999, 0, '', '', NULL, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `activity_category_big`
--

CREATE TABLE `activity_category_big` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `activity_category_big`
--

INSERT INTO `activity_category_big` (`id`, `name`, `description`) VALUES
(1, '課程', '我們提供各式各樣的課程讓您精進您的潛水技術！'),
(2, '活動', '我們提供各式活動，讓您能夠盡情享受潛水樂趣！');

-- --------------------------------------------------------

--
-- 資料表結構 `activity_category_small`
--

CREATE TABLE `activity_category_small` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `activityCategoryBig_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `activity_category_small`
--

INSERT INTO `activity_category_small` (`id`, `name`, `description`, `activityCategoryBig_id`) VALUES
(1, '水肺潛水', NULL, 1),
(2, '自由潛水', NULL, 1),
(3, '人魚潛水課程', NULL, 1),
(4, '救生課程', NULL, 1),
(5, '無證照', NULL, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `activity_image`
--

CREATE TABLE `activity_image` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `imgUrl` varchar(255) DEFAULT NULL,
  `isMain` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 非主圖, 1: 是主圖'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `activity_image`
--

INSERT INTO `activity_image` (`id`, `activity_id`, `name`, `imgUrl`, `isMain`) VALUES
(1, 1, '小琉球潛水體驗活動主圖', 'P3140183-1-1024x768.jpg', 1),
(2, 2, '小琉球岸潛活動主圖', 'SNOW0161-1-1024x768.jpg', 1),
(3, 2, '小琉球岸潛附圖', 'S__150020104-1024x768.jpg', 0),
(4, 3, '水肺潛水體驗課程（泳池）主圖', 'discovery01.jpg', 1),
(5, 4, '美人魚體驗潛水課程主圖', 'MnXqmRCE9bWO9rTMTkL5rgIJfTtvfhsSQF1fcJGu.jpg', 1),
(6, 5, 'Level 1自由潛水認證課程（主圖）', '1732686903.jpg', 1),
(7, 6, '課程名稱（主圖）', '1732707861.png', 1),
(9, 8, '2346（主圖）', '1732688980.png', 1),
(10, 9, '5487974（主圖）', '1732688818.jpeg', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `activity_order`
--

CREATE TABLE `activity_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED DEFAULT NULL,
  `totalAmount` int(10) UNSIGNED DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `orderDate` datetime DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `activity_order_detail`
--

CREATE TABLE `activity_order_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `activityOrder_id` int(10) UNSIGNED DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updateAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `activity_teacher`
--

CREATE TABLE `activity_teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sex` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `years` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `activity_teacher`
--

INSERT INTO `activity_teacher` (`id`, `name`, `email`, `sex`, `level`, `years`) VALUES
(1, '張一', 'hua@test.com', 1, 5, 10),
(2, '陳二', 'cheng@test.com', 1, 3, 3);

-- --------------------------------------------------------

--
-- 資料表結構 `activity_teacher_image`
--

CREATE TABLE `activity_teacher_image` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `imageUrl` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `activity_teacher_image`
--

INSERT INTO `activity_teacher_image` (`id`, `name`, `teacher_id`, `imageUrl`) VALUES
(1, '張一教練', 1, 'bin-1.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `activity_teacher_specialty`
--

CREATE TABLE `activity_teacher_specialty` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `activity_category_big`
--
ALTER TABLE `activity_category_big`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `activity_category_small`
--
ALTER TABLE `activity_category_small`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `activity_image`
--
ALTER TABLE `activity_image`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `activity_order`
--
ALTER TABLE `activity_order`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `activity_order_detail`
--
ALTER TABLE `activity_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `activity_teacher`
--
ALTER TABLE `activity_teacher`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `activity_teacher_image`
--
ALTER TABLE `activity_teacher_image`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `activity_teacher_specialty`
--
ALTER TABLE `activity_teacher_specialty`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_category_big`
--
ALTER TABLE `activity_category_big`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_category_small`
--
ALTER TABLE `activity_category_small`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_image`
--
ALTER TABLE `activity_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_order`
--
ALTER TABLE `activity_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_order_detail`
--
ALTER TABLE `activity_order_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_teacher`
--
ALTER TABLE `activity_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_teacher_image`
--
ALTER TABLE `activity_teacher_image`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_teacher_specialty`
--
ALTER TABLE `activity_teacher_specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-12-02 16:52:29
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
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
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

INSERT INTO `activity` (`id`, `name`, `activityCategorySmall_id`, `signUpDate`, `signUpEndDate`, `startDate`, `endDate`, `startTime`, `endTime`, `price`, `activity_teacher_id`, `location`, `description`, `article_id`, `isDeleted`) VALUES
(1, '小琉球體驗潛水', 5, '2024-09-01', '2024-09-25', '2024-11-01', '2024-11-01', '13:30:00', '15:00:00', 2500, 6, '', '你是否怕水，卻又想一窺蔚藍的海底世界呢？ 你是否猶豫，到底要不要考一張潛水證照呢？ 體驗潛水，是你最好的選擇！ 專業教練耐心為你講解小學生都可以聽懂的課程， 用簡單又幽默的方式一對一帶你認識裝備、適應呼吸、水下手勢溝通，  即使不會游泳，也能嘗試潛入深海與海龜共游 10歲到70歲都可以嘗試的小琉球必玩水上活動。', NULL, 0),
(2, '小琉球岸潛活動', 5, '2024-10-01', '2024-10-31', '2024-11-06', '2024-11-06', '00:00:00', '15:00:00', 1000, 3, '', '', NULL, 0),
(3, '水肺潛水體驗課程(泳池)', 1, '2024-12-01', '2024-12-31', '2025-01-01', '2025-01-01', '12:00:00', '17:30:00', 1500, 1, '', '', NULL, 0),
(4, '美人魚 體驗潛水', 3, '2024-11-01', '2024-11-24', '2024-12-01', '2024-12-02', '15:00:00', '17:00:00', 1500, 3, '', '', NULL, 0),
(5, 'Level 1自由潛水認證課程', 2, '2024-10-01', '2024-11-30', '2024-12-10', '2024-12-15', '13:00:00', '15:00:00', 12800, 2, '', '多種潛水系統DIWA, PADI, SSI, AIDA…任您挑選\r\n扎實訓練課程讓您安心考取國際證照\r\n專業教練小班制教學且彈性上課時間\r\n趕緊報名一起解鎖水下新技能吧！', NULL, 0);

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
(6, 5, 'Level 1自由潛水認證課程（主圖）', '1732686903.jpg', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `activity_orders`
--

CREATE TABLE `activity_orders` (
  `id` int(11) NOT NULL,
  `activity_status` enum('pending','processing','completed','cancelled') NOT NULL,
  `participant_count` int(11) NOT NULL,
  `special_requirements` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `activity_orders`
--

INSERT INTO `activity_orders` (`id`, `activity_status`, `participant_count`, `special_requirements`) VALUES
(1, 'processing', 5, '無特殊需求'),
(4, 'processing', 3, '無特殊需求'),
(5, 'processing', 2, NULL),
(6, 'processing', 4, NULL);

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
  `years` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0未刪除 1已刪除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `activity_teacher`
--

INSERT INTO `activity_teacher` (`id`, `name`, `email`, `sex`, `level`, `years`, `is_deleted`) VALUES
(1, '張一', 'hua@test.com', 1, 5, 10, 1),
(3, '黃三', '3@test.com', 2, 4, 7, 1),
(6, '瘦子教練', 'suo@test.com', 1, 3, 9, 0),
(7, '阿國教練', 'guo@test.com', 1, 2, 6, 0),
(8, 'BOBO教練', 'bobo@test.com', 2, 1, 3, 0),
(9, '宇廷教練', 'ting@test.com', 1, 1, 3, 0),
(10, '阿沁教練', 'tsing@test.com', 1, 1, 1, 0),
(11, 'Rick教練', 'rick@test.com', 1, 2, 5, 0),
(12, '何月教練', 'yue@test.com', 2, 1, 6, 0);

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
(1, '張一教練', 1, 'bin-1.jpg'),
(2, '瘦子教練教練照片', 6, '1733120008'),
(3, '阿國教練教練照片', 7, '1733121685'),
(4, 'BOBO教練教練照片', 8, '1733121722'),
(5, '宇廷教練教練照片', 9, '1733121778'),
(6, '阿沁教練教練照片', 10, '1733121818'),
(7, 'Rick教練教練照片', 11, '1733122110'),
(8, '何月教練教練照片', 12, '1733122460');

-- --------------------------------------------------------

--
-- 資料表結構 `activity_teacher_specialty`
--

CREATE TABLE `activity_teacher_specialty` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `article`
--

CREATE TABLE `article` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `upgradeDate` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '0: 未發布, 1: 已發布',
  `type` tinyint(2) DEFAULT NULL COMMENT '0: 官方文章, 1: 商品描述, 2: 活動描述',
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 未刪除, 1: 已刪除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `createdAt`, `upgradeDate`, `status`, `type`, `isDeleted`) VALUES
(1, '台灣潛水季節', '台灣潛水季節大約是4月到9月間，不同縣市的各個潛點潛季略有不同，另外像是小琉球一年四季都是適合進行潛水運動的。', '2024-12-02 04:56:57', NULL, 1, NULL, 0),
(2, '潛水要穿著的裝備', '若是自由潛水，基本裝備有面鏡、長蛙鞋、呼吸管、配重等；若是水肺潛水則裝備較多，基本需要面鏡、呼吸管、蛙鞋、配重、潛水衣外，還需要呼席調節器和氣瓶等。若是體驗浮潛則只需要面鏡、呼吸管、救生衣等。基本上若是參加潛店體驗行程，店家都會協助準備裝備喔！', '2024-12-02 04:56:58', NULL, 1, NULL, 0),
(3, '藍色任務-淨灘淨海', '大大小小的淨灘淨海活動。\r\n\r\n帶著海洋守護者們以淨灘淨海的方式走入海洋。 更與多方夥伴合作，深耕在地，接軌國際。', '2024-12-02 04:56:59', NULL, 0, NULL, 1),
(4, '藍色任務-台潛海清日', '從2006年開始，每年九月在後壁湖舉辦大型淨灘淨海。是每個台潛人回娘家的大型聚會。', '2024-12-02 04:56:59', NULL, 1, NULL, 0),
(5, '藍色任務-海漂電台環半島淨灘', '聯合在地業者，以每週六淨一個海灘之形式走過恆春半島。累計撿起上千公斤的垃圾，並了解各海灘的健康狀況。', '2024-12-02 04:56:59', NULL, 1, NULL, 0),
(6, '藍色任務-海洋守護者', '將海洋環境教育納入潛水課堂，學生在上課期間體驗不塑生活與潛水淨海，成為更有深度的海人。', '2024-12-02 04:56:59', NULL, 0, NULL, 0),
(7, '藍色任務-海洋畢業典禮', '與海相處學習，不只是成年的潛水員，更是每一個人、每個孩子都可以擁有的。\r\n\r\n​恭喜你們畢業囉 !', '2024-12-02 04:56:59', NULL, 1, NULL, 0),
(8, '藍色任務-海洋巴士', '與全台各學校與企業合作，舉辦海洋巴士演講，將海洋議題帶到城市，宣揚環境理念，讓非潛水員也看見海洋問題。', '2024-12-02 04:56:59', NULL, 1, NULL, 0),
(9, '藍色任務-海人視界', '\"透過海洋職人們的分享，我們學習用更寬廣的眼界，更專業的視角觀察海洋。\r\n\r\n願我們都能與海溫柔地互相守護，共生共享自然珍貴的饋贈。\"\r\n', '2024-12-02 04:56:59', NULL, 0, NULL, 0),
(10, '藍色任務-海洋週', '炎熱的夏天，沁涼的海洋正召喚著你 !\r\n\r\n有學有玩有淨海的 #海洋週\r\n\r\n活動為兩天一夜，有海洋大使生態課程、岸潛淨灘淨海、船潛旅遊一趟', '2024-12-02 04:56:59', NULL, 1, NULL, 0),
(11, '藍色任務-讓海洋走進都市', '和關懷環境與在地的夥伴合作，讓海洋元素在都市出現。不在海邊的人們看見湛光藍，就記憶起海的陪伴。', '2024-12-02 04:56:59', NULL, 1, NULL, 0),
(12, '藍色任務-光影珊瑚', '透過珊瑚紀錄，用行動關心海洋生態健康。\r\n\r\n綠色和平 x 光影珊瑚 x 台灣潛水\r\n\r\n邀請你，一起加入 #珊瑚觀測 的行列。', '2024-12-02 04:56:59', NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `article_image`
--

CREATE TABLE `article_image` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `imgUrl` varchar(255) DEFAULT NULL,
  `isMain` tinyint(1) DEFAULT NULL COMMENT '0: 非主圖, 1: 主圖',
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 未刪除, 1: 已刪除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `article_image`
--

INSERT INTO `article_image` (`id`, `article_id`, `name`, `imgUrl`, `isMain`, `isDeleted`) VALUES
(1, 11, '001', 'img/article/001.png', 1, 0),
(2, 2, '002', 'img/article/002.jpg', 1, 0),
(3, 4, '003', 'img/article/003.jpg', 0, 0),
(4, 4, '004', 'img/article/004.jpg', 0, 0),
(5, 4, '005', 'img/article/005.jpg', 1, 0),
(6, 5, '007', 'img/article/007.jpg', 1, 0),
(7, 12, '008', 'img/article/008.jpg', 1, 0),
(8, 8, '009', 'img/article/009.jpg', 1, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `brand`
--

CREATE TABLE `brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `brand`
--

INSERT INTO `brand` (`id`, `name`, `description`) VALUES
(1, 'AGAWA', ''),
(2, 'ALCHEMY', NULL),
(3, 'AMONG', ''),
(4, 'AP DIVING', ''),
(5, 'APNEA STORE', ''),
(6, 'APNEAUTIC', '描述1'),
(7, 'APOLLO', '描述1'),
(8, 'AQUA LUNG', '描述1'),
(9, 'AROPEC', NULL),
(10, 'ATMOS', NULL),
(11, 'ATOMIC', NULL),
(12, 'BARREL', '描述1'),
(13, 'BEUCHAT', '描述1'),
(14, 'CARBONIO GFT', '描述1'),
(15, 'CTEMA', '描述1'),
(16, 'COCOLOA', '描述1'),
(17, 'C4', '描述1'),
(18, 'DAKINE', '描述1'),
(19, 'DEEPBLU', '描述1'),
(20, 'DiveR', '描述1'),
(21, 'DIVE SYSTEM', '描述1'),
(22, 'DR.FILM', '描述1'),
(23, 'EZDIVE', '描述1'),
(24, 'FREEN', '描述1'),
(25, 'FREEDIVING PLANET', '描述1'),
(26, 'GARMIN', '描述1'),
(27, 'GOPRO', '描述1'),
(28, 'GULL', '描述1'),
(29, 'HOBBY LABELS', '描述1'),
(30, 'IST', '描述1'),
(31, 'LAZYFISH', '描述1'),
(32, 'LEADERFINS', '描述1'),
(33, 'LOONG DIVE', '描述1'),
(34, 'LOBSTER', '描述1'),
(35, 'MARES', '描述1'),
(36, 'MOBBY\'S', '描述1'),
(37, 'MOLCHANOVS', '描述1'),
(38, 'NU JUNE', '描述1'),
(39, 'OK CHALLENGE', '描述1'),
(40, 'OCEANIC', '描述1'),
(41, 'OMER', '描述1'),
(42, 'O\'NEILL', '描述1'),
(43, 'PATHOS', '描述1'),
(44, 'PENETRATOR', '描述1'),
(45, 'PROBLUE', '描述1'),
(46, 'REMAKE', '描述1'),
(47, 'REYSON', '描述1'),
(48, 'SAEKODIVE', '描述1'),
(49, 'SAS', '描述1'),
(50, 'SCUBAPRO', '描述1'),
(51, 'SEA HAWK', '描述1'),
(52, 'STREAM TRAIL', '描述1'),
(53, 'SUBLUE', '描述1'),
(54, 'SEAC', '描述1'),
(55, 'SPECIALFINS', '描述1'),
(56, 'SPORASUB', '描述1'),
(57, 'SUUNTO', '描述1'),
(58, 'SUIILA', '描述1'),
(59, 'TRUDIVE', '描述1'),
(60, 'TRYGONS', '描述1'),
(61, 'TUSA', '描述1'),
(62, 'WATERMAN', '描述1'),
(63, '123 UnderwaterLab', '描述1'),
(64, '2 B FREE', '描述1'),
(65, '其他', '描述1');

-- --------------------------------------------------------

--
-- 資料表結構 `color`
--

CREATE TABLE `color` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `color`
--

INSERT INTO `color` (`id`, `name`) VALUES
(1, '黑金'),
(2, '冰川白'),
(3, '蜜桃紅'),
(4, '香檳金'),
(5, '草綠');

-- --------------------------------------------------------

--
-- 資料表結構 `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `discountType` enum('percentage','fixed') NOT NULL,
  `discountValue` decimal(10,2) NOT NULL,
  `minPurchase` decimal(10,2) DEFAULT 0.00,
  `maxDiscountValue` decimal(10,2) DEFAULT 0.00,
  `targetMembers` text DEFAULT NULL,
  `product_id` text DEFAULT NULL,
  `product_type` text DEFAULT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `usageLimit` int(11) DEFAULT 0,
  `userLimit` int(11) DEFAULT 0,
  `usedCount` int(11) DEFAULT 0,
  `status` enum('active','expired','inactive') NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `name`, `discountType`, `discountValue`, `minPurchase`, `maxDiscountValue`, `targetMembers`, `product_id`, `product_type`, `startDate`, `endDate`, `usageLimit`, `userLimit`, `usedCount`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 'DIVENEW1', '首次購買折扣', 'percentage', 10.00, 500.00, 100.00, '新會員', '商品', 'equipment', '2024-01-01 00:00:00', '2024-12-31 23:59:59', 100, 1, 0, 'active', '首次購買潛水裝備享受10%折扣，最高折抵100元', '2024-11-28 19:30:54', '2024-11-28 20:41:34'),
(2, 'RENT10', '裝備租賃滿減', 'fixed', 50.00, 300.00, 0.00, '全部會員', '租賃', 'rental', '2024-02-01 00:00:00', '2024-03-31 23:59:59', 50, 1, 0, 'expired', '裝備租賃消費滿300元立減50元', '2024-11-28 19:30:54', '2024-11-28 20:41:59'),
(3, 'COURSE300', '課程報名折扣', 'fixed', 300.00, 1000.00, 0.00, '全部會員', '課程', 'course', '2024-03-15 00:00:00', '2024-04-15 23:59:59', 50, 1, 0, 'expired', '潛水課程報名消費滿1000元立減300元', '2024-11-28 19:30:54', '2024-11-28 20:42:47'),
(4, 'SUMMERFUN', '夏日裝備促銷', 'percentage', 20.00, 500.00, 0.00, '全部會員', '商品', 'equipment', '2024-06-01 00:00:00', '2024-06-30 23:59:59', 200, NULL, 0, 'expired', '夏日限定裝備促銷，全場8折優惠', '2024-11-28 19:30:54', '2024-11-28 20:42:55'),
(5, 'FRIENDREF', '推薦好友折扣', 'fixed', 100.00, 0.00, 0.00, '全部會員', '課程', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59', 20, NULL, 0, 'active', '推薦好友首次消費後獲得100元折扣券', '2024-11-28 19:30:54', '2024-11-28 20:43:08'),
(6, 'EQUIPUPGRADE', '裝備升級優惠', 'fixed', 200.00, 1500.00, 0.00, '全部會員', '商品', 'equipment', '2024-05-01 00:00:00', '2024-05-31 23:59:59', NULL, NULL, 0, 'expired', '購買高階潛水裝備可享200元優惠', '2024-11-28 19:30:54', '2024-11-28 20:43:12'),
(7, 'BUNDLE500', '指定課程折扣', 'fixed', 500.00, 3000.00, 0.00, '全部會員', '課程', 'equipment', '2024-04-01 00:00:00', '2024-04-30 23:59:59', NULL, NULL, 0, 'expired', '購買指定課程裝備立減500元', '2024-11-28 19:30:54', '2024-11-28 20:43:17'),
(8, 'FALLSALE', '秋季促銷優惠', 'percentage', 25.00, 0.00, 200.00, '全部會員', '商品', 'equipment', '2024-09-01 00:00:00', '2024-09-30 23:59:59', NULL, NULL, 0, 'expired', '秋季促銷期間裝備最高享受25%折扣', '2024-11-28 19:30:54', '2024-11-28 21:26:06'),
(9, 'VIPDISCOUNT', 'VIP專屬優惠', 'percentage', 15.00, 0.00, 0.00, 'VIP會員', '商品', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59', NULL, NULL, 0, 'active', 'VIP會員全場商品享15%折扣', '2024-11-28 19:30:54', '2024-11-28 20:43:32'),
(10, 'NEWYEAR50', '新年專屬折扣', 'fixed', 50.00, 200.00, 0.00, '全部會員', '商品', 'equipment,course', '2024-12-25 00:00:00', '2025-01-05 23:59:59', 100, 2, 0, 'inactive', '新年期間消費滿200元立減50元', '2024-11-28 19:30:54', '2024-11-28 20:43:47'),
(11, 'TRYDIVE10', '試潛活動優惠', 'percentage', 10.00, 500.00, 0.00, '全部會員', '活動', 'activity', '2024-07-01 00:00:00', '2024-07-31 23:59:59', NULL, 1, 0, 'expired', '參加試潛活動享受10%折扣', '2024-11-28 19:30:54', '2024-11-28 20:44:14'),
(12, 'ACTIVITY20', '活動限定折扣', 'fixed', 200.00, 800.00, 0.00, '全部會員', '活動', 'activity', '2024-08-15 00:00:00', '2024-08-31 23:59:59', 50, 1, 0, 'expired', '參加指定活動消費滿800元減200元', '2024-11-28 19:30:54', '2024-11-28 20:44:30'),
(13, 'CLEARANCE30', '清倉大促銷', 'percentage', 30.00, 0.00, 0.00, '全部會員', '商品', 'equipment', '2024-11-01 00:00:00', '2024-11-10 23:59:59', NULL, NULL, 0, 'expired', '季末清倉，商品享7折優惠', '2024-11-28 19:30:54', '2024-11-28 20:44:42'),
(14, 'GROUPBUY', '團購優惠', 'fixed', 300.00, 2000.00, 0.00, '全部會員', '團購', 'equipment', '2024-06-01 00:00:00', '2024-06-15 23:59:59', NULL, NULL, 0, 'expired', '參與團購活動可享300元折扣', '2024-11-28 19:30:54', '2024-11-28 20:45:02'),
(15, 'BIRTHDAY200', '生日專屬優惠', 'fixed', 200.00, 0.00, 0.00, '全部會員', '全部', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59', 1, 1, 0, 'active', '用戶生日當月享200元專屬優惠券', '2024-11-28 19:30:54', '2024-11-28 21:25:29'),
(16, 'HOLIDAY15', '假日促銷折扣', 'percentage', 15.00, 300.00, 0.00, '全部會員', '全部', 'equipment', '2024-05-01 00:00:00', '2024-05-31 23:59:59', NULL, NULL, 0, 'expired', '假日期間消費滿300元享85折', '2024-11-28 19:30:54', '2024-11-28 20:46:33'),
(17, 'EQUIPTRY', '裝備試用折扣', 'fixed', 150.00, 500.00, 0.00, '全部會員', '租賃', 'rental', '2024-03-01 00:00:00', '2024-03-15 23:59:59', NULL, NULL, 0, 'expired', '首次租賃試用裝備享150元折扣', '2024-11-28 19:30:54', '2024-11-28 20:47:05'),
(18, 'FAMILYDIVE', '家庭套票優惠', 'fixed', 500.00, 2000.00, 0.00, '全部會員', '活動', 'course', '2024-07-01 00:00:00', '2024-07-31 23:59:59', 10, NULL, 0, 'expired', '購買家庭潛水套票減免500元', '2024-11-28 19:30:54', '2024-11-28 20:48:30'),
(19, 'WINTER10', '冬季促銷活動', 'percentage', 10.00, 0.00, 100.00, '全部會員', '商品', 'equipment', '2024-12-01 00:00:00', '2024-12-31 23:59:59', NULL, NULL, 0, 'inactive', '冬季限定促銷，全場9折優惠', '2024-11-28 19:30:54', '2024-11-28 20:47:51'),
(20, 'LOYALTY300', '忠實客戶回饋', 'fixed', 300.00, 1500.00, 0.00, 'VIP會員', '全部', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59', NULL, NULL, 0, 'active', '忠實客戶年度回饋，每筆滿1500元訂單立減300元', '2024-11-28 19:30:54', '2024-11-28 20:48:22'),
(21, 'EARLYBIRD', '活動早鳥優惠', 'fixed', 200.00, 500.00, 0.00, '全部會員', '課程', 'activity', '2024-05-01 00:00:00', '2024-05-15 23:59:59', NULL, 1, 0, 'expired', '活動早鳥報名立減200元', '2024-11-28 19:30:54', '2024-11-28 20:48:45'),
(22, 'ECOFRIEND', '環保商品優惠', 'percentage', 15.00, 0.00, 0.00, '全部會員', '商品', 'equipment', '2024-02-01 00:00:00', '2024-02-29 23:59:59', NULL, NULL, 0, 'expired', '選擇環保裝備商品享15%折扣', '2024-11-28 19:30:54', '2024-11-28 20:49:03'),
(23, 'WEDDINGGIFT', '婚禮禮品優惠', 'fixed', 500.00, 3000.00, 0.00, '全部會員', '商品', 'equipment', '2024-08-01 00:00:00', '2024-08-15 23:59:59', NULL, NULL, 0, 'expired', '裝備滿3000元立減500元', '2024-11-28 19:30:54', '2024-11-28 20:49:46'),
(24, 'FREECOURSE', '免費課程優惠', 'fixed', 500.00, 0.00, 0.00, '全部會員', '商品', 'course', '2024-10-01 00:00:00', '2024-10-31 23:59:59', NULL, NULL, 0, 'expired', '選購裝備可獲得免費基礎潛水課程資格', '2024-11-28 19:30:54', '2024-11-28 20:50:30'),
(25, 'FLASHSALE', '限時閃購優惠', 'percentage', 50.00, 1000.00, 500.00, '全部會員', '商品', 'equipment', '2024-11-01 00:00:00', '2024-11-03 23:59:59', NULL, NULL, 0, 'expired', '限時閃購活動，部分商品最高可享5折', '2024-11-28 19:30:54', '2024-11-28 20:50:46'),
(26, 'WINTERSALE', '冬季商品折扣', 'percentage', 20.00, 500.00, 0.00, '全部會員', '商品', 'equipment', '2024-12-01 00:00:00', '2024-12-31 23:59:59', 100, NULL, 0, 'inactive', '冬季裝備全場8折優惠', '2024-11-28 19:33:18', '2024-11-28 21:27:03'),
(27, 'CROSSSELL50', '搭配購物優惠', 'fixed', 50.00, 300.00, 0.00, '全部會員', '商品', 'equipment', '2024-03-01 00:00:00', '2024-03-15 23:59:59', 50, NULL, 0, 'expired', '搭配購物滿300元立減50元', '2024-11-28 19:33:18', '2024-11-28 21:27:21'),
(28, 'HAPPYHOUR30', '快閃優惠', 'percentage', 30.00, 1000.00, 0.00, '全部會員', '全部', 'equipment', '2024-11-01 00:00:00', '2024-11-05 23:59:59', NULL, NULL, 0, 'expired', '快閃優惠，限時5天內享受30%折扣', '2024-11-28 19:33:18', '2024-11-28 21:27:37'),
(29, 'HOLIDAYBONUS', '假日贈送優惠券', 'fixed', 200.00, 0.00, 0.00, '全部會員', '商品', NULL, '2024-05-01 00:00:00', '2024-05-31 23:59:59', 50, NULL, 0, 'expired', '假日消費滿額送200元優惠券', '2024-11-28 19:33:18', '2024-11-28 21:27:55'),
(30, 'STUDENTDISCOUNT', '學生專屬優惠', 'percentage', 15.00, 0.00, 0.00, '學生會員', '課程', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59', 50, 1, 0, 'active', '學生族群享有15%折扣', '2024-11-28 19:33:18', '2024-11-28 21:28:19'),
(31, 'FESTIVAL100', '節日專屬折扣', 'fixed', 100.00, 500.00, 0.00, '全部會員', '商品', 'equipment', '2024-02-01 00:00:00', '2024-02-29 23:59:59', NULL, NULL, 0, 'expired', '節日專屬，滿500元減100元', '2024-11-28 19:33:18', '2024-11-28 21:28:30'),
(32, 'REPEATCUSTOMER', '回購客戶優惠', 'fixed', 150.00, 800.00, 0.00, '全部會員', '商品', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59', NULL, 1, 0, 'active', '回購客戶專屬150元優惠券', '2024-11-28 19:33:18', '2024-11-28 21:28:44'),
(33, 'SUMMERDISCOUNT', '夏季促銷優惠', 'percentage', 25.00, 0.00, 0.00, '全部會員', '商品', 'equipment', '2024-06-01 00:00:00', '2024-06-30 23:59:59', NULL, NULL, 0, 'expired', '夏季裝備全場折扣25%', '2024-11-28 19:33:18', '2024-11-28 21:28:57'),
(34, 'NEWARRIVAL20', '新品上市折扣', 'percentage', 20.00, 0.00, 0.00, '全部會員', '商品', 'equipment', '2024-04-01 00:00:00', '2024-04-30 23:59:59', NULL, NULL, 0, 'expired', '新品上市，享受20%折扣', '2024-11-28 19:33:18', '2024-11-28 21:29:08'),
(35, 'VIPSALE', 'VIP專屬季節性折扣', 'percentage', 30.00, 0.00, 0.00, 'VIP會員', '活動', NULL, '2024-11-01 00:00:00', '2024-11-30 23:59:59', 30, NULL, 0, 'active', 'VIP會員享30%季節折扣', '2024-11-28 19:33:18', '2024-11-28 21:29:27'),
(36, 'SNORKEL10', '浮潛裝備折扣', 'fixed', 100.00, 300.00, 0.00, '全部會員', '商品', 'equipment', '2024-07-01 00:00:00', '2024-07-31 23:59:59', NULL, NULL, 0, 'expired', '浮潛裝備滿300元減100元', '2024-11-28 19:33:18', '2024-11-28 21:29:51'),
(37, 'SEASONALSALE', '季節特賣優惠', 'percentage', 15.00, 0.00, 0.00, '全部會員', '商品', 'equipment', '2024-09-01 00:00:00', '2024-09-30 23:59:59', NULL, NULL, 0, 'expired', '季節特賣，全場裝備15%折扣', '2024-11-28 19:33:18', '2024-11-28 21:30:05'),
(38, 'CLEANINGOUT', '清倉優惠', 'percentage', 50.00, 0.00, 200.00, '全部會員', '商品', 'equipment', '2024-11-10 00:00:00', '2024-11-15 23:59:59', NULL, NULL, 0, 'expired', '清倉大促銷，部分商品50%折扣', '2024-11-28 19:33:18', '2024-11-28 21:30:28'),
(39, 'PREMIUMACCESS', '高端客戶優惠', 'percentage', 40.00, 0.00, 0.00, 'VIP會員', '全部', NULL, '2024-06-01 00:00:00', '2024-06-15 23:59:59', 20, NULL, 0, 'expired', '高端客戶享40%專屬折扣', '2024-11-28 19:33:18', '2024-11-28 21:30:52'),
(40, 'FLASH60', '限時搶購優惠', 'fixed', 60.00, 100.00, 0.00, '全部會員', '全部', 'equipment', '2024-08-01 00:00:00', '2024-08-01 23:59:59', 10, NULL, 0, 'expired', '限時搶購商品，立減60元', '2024-11-28 19:33:18', '2024-11-28 21:32:29'),
(41, 'TRYANDEARN', '裝備試用優惠', 'fixed', 150.00, 500.00, 0.00, '全部會員', '租賃', 'rental', '2024-02-01 00:00:00', '2024-02-15 23:59:59', NULL, NULL, 0, 'expired', '試用潛水裝備並賺取150元優惠券', '2024-11-28 19:33:18', '2024-11-28 21:37:18'),
(42, 'GIFTWITHPURCHASE', '指定商品即送禮品卡', 'fixed', 200.00, 1000.00, 0.00, '全部會員', '全部', 'equipment', '2024-03-01 00:00:00', '2024-03-31 23:59:59', NULL, NULL, 0, 'expired', '買指定潛水裝備即送200元禮品卡', '2024-11-28 19:33:18', '2024-11-28 21:36:43'),
(43, 'TEAMBUILDING', '團隊報名折扣', 'fixed', 300.00, 1000.00, 0.00, '全部會員', '課程', 'course', '2024-09-01 00:00:00', '2024-09-30 23:59:59', NULL, NULL, 0, 'expired', '團隊報名潛水課程滿1000元減300元', '2024-11-28 19:33:18', '2024-11-28 21:35:26'),
(44, 'BOGO', '買一送一促銷', 'fixed', 0.00, 500.00, 0.00, '全部會員', '商品', 'equipment', '2024-12-01 00:00:00', '2024-12-31 23:59:59', NULL, NULL, 0, 'inactive', '買一送一活動，限時享受此優惠', '2024-11-28 19:33:18', '2024-11-28 21:33:30'),
(45, 'PARTNERSHIP10', '學生優惠', 'fixed', 100.00, 0.00, 0.00, '學生會員', '活動', NULL, '2024-04-01 00:00:00', '2024-04-30 23:59:59', 50, NULL, 0, 'expired', '學生專屬100元優惠券', '2024-11-28 19:33:18', '2024-11-28 21:37:40'),
(46, 'AUTUMNSALE', '秋季優惠折扣', 'percentage', 20.00, 0.00, 0.00, '全部會員', '商品', 'equipment', '2024-10-01 00:00:00', '2024-10-31 23:59:59', NULL, NULL, 0, 'expired', '秋季促銷活動，裝備商品享20%折扣', '2024-11-28 19:33:18', '2024-11-28 21:34:17'),
(47, 'FREESHIP', '免費運送優惠', 'fixed', 0.00, 500.00, 0.00, '全部會員', '商品', NULL, '2024-03-01 00:00:00', '2024-03-15 23:59:59', NULL, NULL, 0, 'expired', '滿500元免費運送', '2024-11-28 19:33:18', '2024-11-28 21:34:12'),
(48, 'XMASGIFT', '聖誕節專屬優惠', 'percentage', 15.00, 0.00, 0.00, '全部會員', '全部', 'equipment', '2024-12-01 00:00:00', '2024-12-25 23:59:59', NULL, NULL, 0, 'inactive', '聖誕節專屬15%折扣優惠', '2024-11-28 19:33:18', '2024-11-28 21:38:02'),
(49, 'NEWYEARBONUS', '新年優惠', 'percentage', 25.00, 0.00, 0.00, '全部會員', '全部', 'equipment', '2024-01-01 00:00:00', '2024-01-31 23:59:59', NULL, NULL, 0, 'expired', '新年促銷，滿額享25%折扣', '2024-11-28 19:33:18', '2024-11-28 21:38:17'),
(50, 'BIRTHDAYGIFT', '生日禮品優惠', 'fixed', 500.00, 0.00, 0.00, '全部會員', '商品', 'equipment', '2024-06-01 00:00:00', '2024-06-30 23:59:59', NULL, NULL, 0, 'expired', '生日月內消費滿500元送500元禮品卡', '2024-11-28 19:33:18', '2024-11-28 21:38:32');

-- --------------------------------------------------------

--
-- 資料表結構 `material`
--

CREATE TABLE `material` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `material`
--

INSERT INTO `material` (`id`, `name`) VALUES
(1, ''),
(2, '');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `product_order_id` int(11) DEFAULT NULL,
  `rental_order_id` int(11) DEFAULT NULL,
  `activity_order_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','processing','completed','cancelled') NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`id`, `member_id`, `product_order_id`, `rental_order_id`, `activity_order_id`, `total_amount`, `payment_status`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 1, 3000.00, 'processing', 'credit_card', '2024-11-29 16:18:06', '2024-11-29 16:18:06'),
(2, 2, 2, 1, 1, 4500.00, 'completed', 'paypal', '2024-11-29 16:18:06', '2024-11-29 16:18:06'),
(3, 1, 1, NULL, NULL, 3000.00, 'processing', 'credit_card', '2024-11-29 23:25:27', '2024-11-29 23:25:27'),
(4, 2, NULL, 3, NULL, 2000.00, 'processing', 'transfer', '2024-11-29 23:25:27', '2024-11-29 23:25:27'),
(5, 3, NULL, NULL, 4, 1500.00, 'processing', 'paypal', '2024-11-29 23:25:27', '2024-11-29 23:25:27'),
(6, 4, 3, 3, NULL, 4500.00, 'processing', 'credit_card', '2024-11-29 23:25:27', '2024-11-29 23:25:27'),
(7, 5, 1, NULL, 5, 5000.00, 'processing', 'transfer', '2024-11-29 23:25:27', '2024-11-29 23:25:27'),
(8, 6, NULL, 6, 6, 6000.00, 'processing', 'paypal', '2024-11-29 23:25:27', '2024-11-29 23:25:27'),
(9, 7, 1, 8, 8, 8000.00, 'processing', 'credit_card', '2024-11-29 23:25:27', '2024-11-29 23:25:27');

-- --------------------------------------------------------

--
-- 資料表結構 `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` enum('product','rental','activity') NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `item_type`, `quantity`, `price`, `status`) VALUES
(1, 1, 1, 'activity', 5, 200.00, 'processing'),
(2, 3, 1, 'activity', 3, 2500.00, 'processing'),
(3, 5, 2, 'activity', 2, 1000.00, 'processing'),
(4, 6, 3, 'activity', 4, 1500.00, 'processing'),
(5, 7, 4, 'activity', 2, 1500.00, 'processing');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_category_small_id` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `article_id` int(10) DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 未刪除, 1: 已刪除',
  `status` varchar(50) DEFAULT NULL,
  `stock` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`id`, `product_category_small_id`, `name`, `price`, `article_id`, `isDeleted`, `status`, `stock`, `created_at`, `updated_at`, `deleted_at`) VALUES
(23, 42, 'VETERAN 加大款長蛙鞋袋 (BG-CL37)', 1350, NULL, 0, '上架中', 99, '2024-12-02 07:02:55', '2024-12-02 07:41:55', NULL),
(24, 1, '妙蛙種子', 88, NULL, 1, '上架中', 23, '2024-12-02 07:28:38', '2024-12-02 07:37:23', '2024-12-02 07:37:23'),
(25, 1, 'Rose', 55, NULL, 1, '上架中', 22, '2024-12-02 07:30:20', '2024-12-02 07:37:27', '2024-12-02 07:37:27'),
(26, 42, 'WAHOO LONG防水長蛙袋 II 代', 3080, NULL, 0, '上架中', 30, '2024-12-02 07:42:56', '2024-12-02 07:42:56', NULL),
(27, 42, '手提後背長蛙鞋袋(LOGO經典款)', 2400, NULL, 0, '上架中', 16, '2024-12-02 07:43:43', '2024-12-02 07:43:43', NULL),
(28, 42, '手提後背長蛙鞋袋(章魚款)', 2580, NULL, 0, '上架中', 34, '2024-12-02 07:44:22', '2024-12-02 07:44:22', NULL),
(29, 42, '手提後背長蛙鞋袋(錘頭鯊款)', 2580, NULL, 0, '上架中', 17, '2024-12-02 07:45:05', '2024-12-02 07:45:05', NULL),
(30, 42, '手提後背長蛙鞋袋(魔鬼魚款)', 2580, NULL, 0, '上架中', 17, '2024-12-02 07:45:59', '2024-12-02 07:45:59', NULL),
(31, 42, '基本款長蛙鞋袋 (白)', 1300, NULL, 0, '上架中', 14, '2024-12-02 07:47:39', '2024-12-02 07:47:39', NULL),
(32, 42, '基本款長蛙鞋袋 (紅)', 1300, NULL, 0, '上架中', 12, '2024-12-02 07:48:34', '2024-12-02 07:48:34', NULL),
(33, 42, '基本款長蛙鞋袋 (黑)', 1300, NULL, 0, '上架中', 13, '2024-12-02 07:50:30', '2024-12-02 07:50:30', NULL),
(34, 42, '基本款長蛙鞋袋 (藍)', 1300, NULL, 0, '上架中', 16, '2024-12-02 07:51:08', '2024-12-02 07:51:08', NULL),
(35, 45, 'APNEA BACKPACK 後背包 自潛_漁獵裝備袋', 2900, NULL, 0, '上架中', 16, '2024-12-02 07:52:07', '2024-12-02 07:52:07', NULL),
(36, 45, 'MUNDIAL BACKPACK 2 後背包 自潛_漁獵裝備袋', 3400, NULL, 0, '上架中', 12, '2024-12-02 07:55:22', '2024-12-02 07:55:22', NULL),
(37, 45, 'STANDARD FINS BAG 標準版後背包', 1700, NULL, 0, '上架中', 13, '2024-12-02 07:58:18', '2024-12-02 07:58:18', NULL),
(38, 45, 'VETERAN 加大款長蛙鞋袋 (BG-CL37)', 1350, NULL, 0, '上架中', 11, '2024-12-02 07:59:32', '2024-12-02 07:59:32', NULL),
(39, 45, 'VOLARE FINS BAG 後背包 / 自潛裝備袋', 2350, NULL, 0, '上架中', 11, '2024-12-02 08:00:18', '2024-12-02 08:00:18', NULL),
(40, 45, 'VOLARE SPEARFISHING FINS BAG 後背包 / 自潛、漁獵裝備袋', 2600, NULL, 0, '上架中', 11, '2024-12-02 08:01:27', '2024-12-02 08:01:27', NULL),
(41, 45, '手提後背長蛙鞋袋(LOGO經典款)', 2400, NULL, 0, '上架中', 18, '2024-12-02 08:02:17', '2024-12-02 08:02:17', NULL),
(42, 45, '手提後背長蛙鞋袋(章魚款)', 2580, NULL, 0, '上架中', 9, '2024-12-02 08:02:54', '2024-12-02 08:02:54', NULL),
(43, 45, '手提後背長蛙鞋袋(錘頭鯊款)', 2580, NULL, 0, '上架中', 7, '2024-12-02 08:04:41', '2024-12-02 08:04:41', NULL),
(44, 45, '手提後背長蛙鞋袋(魔鬼魚款)', 2580, NULL, 0, '上架中', 6, '2024-12-02 08:05:14', '2024-12-02 08:05:14', NULL),
(45, 49, 'Bifin Blade Protection 雙蹼蛙鞋板保護套', 1600, NULL, 0, '上架中', 19, '2024-12-02 08:06:03', '2024-12-02 08:06:03', NULL),
(46, 49, 'Inner Pad 長蛙袋減震軟墊', 250, NULL, 0, '上架中', 13, '2024-12-02 08:06:33', '2024-12-02 08:06:33', NULL),
(47, 49, 'Monofin Blade Protection 單蹼蛙鞋板保護套', 1800, NULL, 0, '上架中', 21, '2024-12-02 08:07:25', '2024-12-02 08:07:25', NULL),
(48, 49, 'Re Make小琉球海龜包', 380, NULL, 0, '上架中', 7, '2024-12-02 08:10:50', '2024-12-02 08:10:50', NULL),
(49, 49, 'Re Make海蛞蝓包', 800, NULL, 0, '上架中', 9, '2024-12-02 08:11:27', '2024-12-02 08:11:27', NULL),
(50, 49, '斜背小物袋SACOCHE BAG (土耳其藍_翡翠綠)', 2500, NULL, 0, '上架中', 9, '2024-12-02 08:12:59', '2024-12-02 08:12:59', NULL),
(51, 49, '斜背小物袋SACOCHE BAG (黑色皮面)', 2500, NULL, 0, '上架中', 13, '2024-12-02 08:13:46', '2024-12-02 08:13:46', NULL),
(52, 49, '斜背小物袋SACOCHE BAG (煙灰藍/碳灰)', 2500, NULL, 0, '上架中', 9, '2024-12-02 08:14:30', '2024-12-02 08:14:30', NULL),
(53, 49, '斜背小物袋SACOCHE BAG (橄欖綠_墨綠)', 2500, NULL, 0, '上架中', 9, '2024-12-02 08:15:02', '2024-12-02 08:15:02', NULL),
(54, 49, '斜背小物袋SACOCHE BAG (薰衣草紫_薄荷綠)', 2500, NULL, 0, '上架中', 9, '2024-12-02 08:16:43', '2024-12-02 08:16:43', NULL),
(55, 46, 'BLOW MINI托特包', 720, NULL, 0, '上架中', 9, '2024-12-02 08:17:27', '2024-12-02 08:17:27', NULL),
(56, 46, 'Blow托特包 _32L', 1480, NULL, 0, '上架中', 11, '2024-12-02 08:18:07', '2024-12-02 08:18:07', NULL),
(57, 46, 'HANDY BAG手拿包 _ 設計聯名款', 1850, NULL, 0, '上架中', 5, '2024-12-02 08:19:03', '2024-12-02 08:19:03', NULL),
(58, 46, 'Mactra 防水旅行包', 2480, NULL, 0, '上架中', 5, '2024-12-02 08:19:34', '2024-12-02 08:19:34', NULL),
(59, 46, '漁獵包包', 1100, NULL, 0, '上架中', 5, '2024-12-02 08:20:30', '2024-12-02 08:20:30', NULL),
(60, 44, 'Monofin Blade Protection 單蹼蛙鞋板保護套', 1800, NULL, 0, '上架中', 11, '2024-12-02 08:21:07', '2024-12-02 08:21:07', NULL),
(61, 44, '半硬質單蹼蛙鞋袋2代(紅色)', 6500, NULL, 0, '上架中', 24, '2024-12-02 08:22:00', '2024-12-02 08:22:00', NULL),
(62, 44, '半硬質單蹼蛙鞋袋2代(黑色)', 6500, NULL, 0, '上架中', 26, '2024-12-02 08:22:34', '2024-12-02 08:22:34', NULL),
(63, 44, '半硬質單蹼蛙鞋袋2代(藍色)', 6500, NULL, 0, '上架中', 17, '2024-12-02 08:23:05', '2024-12-02 08:23:05', NULL),
(64, 44, '單蹼蛙鞋袋 _雙肩背', 3600, NULL, 0, '上架中', 7, '2024-12-02 08:23:37', '2024-12-02 08:23:37', NULL),
(65, 43, 'Short Bifins Backpack 後揹式短蛙袋', 1900, NULL, 0, '上架中', 6, '2024-12-02 08:24:13', '2024-12-02 08:24:13', NULL),
(66, 47, 'NUDE TUBE MINI防水收納袋', 550, NULL, 0, '上架中', 13, '2024-12-02 08:25:00', '2024-12-02 08:25:00', NULL),
(67, 47, 'NUDE TUBE S防水收納袋', 650, NULL, 0, '上架中', 9, '2024-12-02 08:25:27', '2024-12-02 08:25:27', NULL),
(68, 47, 'SD防水腰包II代', 3180, NULL, 0, '上架中', 24, '2024-12-02 08:26:24', '2024-12-02 08:26:24', NULL),
(69, 47, '機能袋(大)', 1500, NULL, 0, '上架中', 7, '2024-12-02 08:26:52', '2024-12-02 08:26:52', NULL),
(70, 47, '機能袋(小)', 950, NULL, 0, '上架中', 17, '2024-12-02 08:27:27', '2024-12-02 08:27:27', NULL),
(71, 47, '機能袋(中)', 1500, NULL, 0, '上架中', 9, '2024-12-02 08:27:55', '2024-12-02 08:27:55', NULL),
(72, 48, 'BIG TOTE 防水裝備袋_大托特包 (中大型尺寸)', 2500, NULL, 0, '上架中', 17, '2024-12-02 08:28:46', '2024-12-02 08:28:46', NULL),
(73, 48, 'GUN BAG PVC長型裝備袋', 1750, NULL, 0, '上架中', 8, '2024-12-02 08:31:34', '2024-12-02 08:31:34', NULL),
(74, 48, 'Hard Case 潛水旅行箱', 14950, NULL, 0, '上架中', 9, '2024-12-02 08:32:04', '2024-12-02 08:32:04', NULL),
(75, 48, 'Mactra 防水旅行包', 2480, NULL, 0, '上架中', 8, '2024-12-02 08:32:32', '2024-12-02 08:32:32', NULL),
(76, 48, 'SHINANO 拉桿拖輪防水行李箱', 7580, NULL, 0, '上架中', 13, '2024-12-02 08:33:05', '2024-12-02 08:33:05', NULL),
(77, 48, 'TEKNO BAG 大型裝備袋', 2580, NULL, 0, '上架中', 17, '2024-12-02 08:33:40', '2024-12-02 08:33:40', NULL),
(78, 48, 'TREKKER CARRY BAG 拖輪式裝備箱', 8500, NULL, 0, '上架中', 17, '2024-12-02 08:44:00', '2024-12-02 08:44:00', NULL),
(79, 48, 'U BOOT BAG大型裝備袋 素黑款', 2500, NULL, 0, '上架中', 17, '2024-12-02 08:44:31', '2024-12-02 08:44:31', NULL),
(80, 48, 'UP-B1 中型裝備袋', 2300, NULL, 0, '上架中', 3, '2024-12-02 08:45:10', '2024-12-02 08:45:10', NULL),
(81, 48, '裝備袋 _ 展示品', 1500, NULL, 0, '上架中', 3, '2024-12-02 08:45:33', '2024-12-02 08:45:33', NULL),
(82, 57, '大齒型鋸片 _ 21吋', 540, NULL, 0, '上架中', 11, '2024-12-02 08:47:39', '2024-12-02 08:47:39', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `product_category_big`
--

CREATE TABLE `product_category_big` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product_category_big`
--

INSERT INTO `product_category_big` (`id`, `name`, `description`) VALUES
(1, '面鏡/呼吸管', ''),
(2, '蛙鞋', NULL),
(3, '潛水配件', ''),
(4, '電子裝備/專業配備', ''),
(5, '防寒衣物', ''),
(6, '包包攜行', ''),
(7, '魚槍/配件', ''),
(8, '生活小物', '就是賣一些雜七雜八的東西');

-- --------------------------------------------------------

--
-- 資料表結構 `product_category_small`
--

CREATE TABLE `product_category_small` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `product_category_big_id` int(10) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product_category_small`
--

INSERT INTO `product_category_small` (`id`, `name`, `description`, `product_category_big_id`, `sort_order`) VALUES
(1, '自由潛水面鏡', '', 1, 1),
(2, '休閒潛水面鏡', NULL, 1, 2),
(3, '度數鏡片面鏡', NULL, 1, 3),
(4, '呼吸管', NULL, 1, 0),
(5, '防霧劑/清潔劑', NULL, 1, 0),
(6, '面鏡帶/面鏡盒/扣具', NULL, 1, 0),
(7, '碳纖維長板', NULL, 2, 0),
(8, '碳纖維短板', NULL, 2, 0),
(9, '玻璃纖維長版', NULL, 2, 0),
(10, '玻璃纖維短版', NULL, 2, 0),
(11, '腳套', NULL, 2, 0),
(12, '橡膠蛙鞋', NULL, 2, 0),
(13, '塑膠蛙鞋', NULL, 2, 0),
(14, '單蹼', '我是鴨子', 2, 0),
(15, '導水條/螺絲零件', NULL, 2, 0),
(16, '挖鞋組裝服務', NULL, 2, 0),
(17, '浮具', '描述1', 3, 0),
(18, '配重', '描述2', 3, 0),
(19, '鼻夾', '描述1', 3, 0),
(20, '照明', '描述2', 3, 0),
(21, '潛水刀', '描述1', 3, 0),
(22, '安全繩', '描述2', 3, 0),
(23, '其他/訓練小物', '描述1', 3, 0),
(24, '潛水電腦錶', '描述1', 4, 0),
(25, 'GOPRO', '描述1', 4, 0),
(26, '水中推進器', '描述1', 4, 0),
(27, '配件/其他', '描述3', 4, 0),
(28, '泳衣款防寒衣', '描述1', 5, 0),
(29, '自潛一件式防寒衣', '描述2', 5, 0),
(30, '自潛兩件式防寒衣', '描述2', 5, 0),
(31, '迷彩系列防寒衣', '描述1', 5, 0),
(32, '水肺濕式防寒衣', '描述2', 5, 0),
(33, '水肺乾式防寒衣', '描述2', 5, 0),
(34, '帽套/頭套', '描述1', 5, 0),
(35, '外套/毛巾衣', '描述2', 5, 0),
(36, '上衣', '描述2', 5, 0),
(37, '手套', '描述2', 5, 0),
(38, '下著', '描述2', 5, 0),
(39, '襪套', '描述2', 5, 0),
(40, '套鞋', '描述2', 5, 0),
(41, '零件/其他', '描述2', 5, 0),
(42, '長鞋蛙袋', '描述3', 6, 0),
(43, '短鞋蛙袋', '描述1', 6, 0),
(44, '單蹼蛙鞋袋', '描述2', 6, 0),
(45, '後背包', '描述1', 6, 0),
(46, '單肩包', '描述1', 6, 0),
(47, '腰包/防水機能袋', '描述1', 6, 0),
(48, '裝背袋/箱', '描述2', 6, 0),
(49, '配件/其他', '描述1', 6, 0),
(50, '魚槍', '描述1', 7, 0),
(51, '魚鰾', '描述2', 7, 0),
(52, '橡皮', '描述1', 7, 0),
(53, '線繩', '描述2', 7, 0),
(54, '捲線器', '描述2', 7, 0),
(55, '其他', '描述3', 7, 0),
(56, '生活相關', '描述1', 8, 0),
(57, '戶外生活', '描述2', 8, 0),
(58, '休閒服飾', '描述1', 8, 0),
(59, '優惠票券', '描述2', 8, 0),
(60, '相關書籍', '描述1', 8, 0),
(61, '防水盒/口罩', '描述2', 8, 0),
(62, '飾品', '描述2', 8, 0),
(63, '貼紙', '描述3', 8, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `product_image`
--

CREATE TABLE `product_image` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `imgUrl` varchar(50) DEFAULT NULL,
  `isMain` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 非主圖, 1: 是主圖',
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 未刪除, 1: 已刪除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `name`, `imgUrl`, `isMain`, `isDeleted`) VALUES
(1, 2, '外套', 'product_2_1732773332_0.png', 0, 1),
(2, 10, '12:59測試', 'product_10_1732773337_0.png', 1, 1),
(3, 2, '外套', 'product_2_1732773405_0.png', 1, 1),
(4, 2, '外套', 'product_2_1732773405_1.png', 0, 1),
(5, 2, '外套', 'product_2_1732773405_2.png', 0, 1),
(6, 2, '外套', 'product_2_1732773405_3.png', 0, 1),
(7, 11, '2dwde', '1732783295.png', 1, 1),
(8, 12, '水晶寶寶', 'product_12_1732811683_0.png', 1, 1),
(9, 12, '水晶寶寶', 'product_12_1732811683_1.png', 0, 1),
(10, 12, '水晶寶寶', 'product_12_1732811683_2.png', 0, 1),
(11, 14, '水晶大寶貝', 'product_14_1732812636_0.png', 0, 0),
(12, 16, '幹我好想睡', 'product_16_1732812763_0.png', 1, 1),
(13, 17, '最後測試', 'product_17_1732812792_0.png', 1, 1),
(14, 19, 'hk4g4iddelete', 'product_19_1732812889_0.png', 1, 0),
(15, 21, '真的該睡了吧', '1732813212_0.png', 1, 0),
(16, 21, '真的該睡了吧', '1732813212_1.png', 0, 0),
(17, 22, '真的該睡了吧', '1732813243_0.png', 1, 0),
(18, 22, '真的該睡了吧', '1732813243_1.png', 0, 0),
(19, 14, '水晶大寶貝', 'product_14_1732814022_0.png', 0, 0),
(20, 14, '水晶大寶貝', 'product_14_1732814022_1.png', 0, 0),
(21, 14, '水晶大寶貝', 'product_14_1732814033_0.png', 1, 0),
(22, 14, '水晶大寶貝', 'product_14_1732814033_1.png', 0, 0),
(23, 14, '水晶大寶貝', 'product_14_1732814033_2.png', 0, 0),
(24, 13, '水晶小寶貝', 'product_13_1732844555_0.png', 0, 0),
(25, 13, '水晶小寶貝', 'product_13_1732844555_1.png', 0, 0),
(26, 13, '水晶小寶貝', 'product_13_1732849163_0.png', 1, 0),
(27, 23, 'VETERAN 加大款長蛙鞋袋 (BG-CL37)', 'product_23_1733122975_0.jpg', 1, 0),
(28, 23, 'VETERAN 加大款長蛙鞋袋 (BG-CL37)', 'product_23_1733122975_1.jpg', 0, 0),
(29, 24, '妙蛙種子', 'product_24_1733124518_0.jpg', 1, 1),
(30, 25, 'Rose', 'product_25_1733124620_0.jpg', 1, 1),
(31, 26, 'WAHOO LONG防水長蛙袋 II 代', 'product_26_1733125376_0.jpg', 1, 0),
(32, 26, 'WAHOO LONG防水長蛙袋 II 代', 'product_26_1733125376_1.jpg', 0, 0),
(33, 26, 'WAHOO LONG防水長蛙袋 II 代', 'product_26_1733125376_2.jpg', 0, 0),
(34, 26, 'WAHOO LONG防水長蛙袋 II 代', 'product_26_1733125376_3.jpg', 0, 0),
(35, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_0.jpg', 1, 0),
(36, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_1.jpg', 0, 0),
(37, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_2.jpg', 0, 0),
(38, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_3.jpg', 0, 0),
(39, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_4.jpg', 0, 0),
(40, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_5.jpg', 0, 0),
(41, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_6.jpg', 0, 0),
(42, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_7.jpg', 0, 0),
(43, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_8.jpg', 0, 0),
(44, 28, '手提後背長蛙鞋袋(章魚款)', 'product_28_1733125462_0.jpg', 1, 0),
(45, 29, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_29_1733125505_0.jpg', 1, 0),
(46, 29, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_29_1733125505_1.jpg', 0, 0),
(47, 29, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_29_1733125505_2.jpg', 0, 0),
(48, 29, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_29_1733125505_3.jpg', 0, 0),
(49, 29, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_29_1733125505_4.jpg', 0, 0),
(50, 29, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_29_1733125505_5.jpg', 0, 0),
(51, 29, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_29_1733125505_6.jpg', 0, 0),
(52, 29, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_29_1733125505_7.jpg', 0, 0),
(53, 29, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_29_1733125505_8.jpg', 0, 0),
(54, 29, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_29_1733125505_9.jpg', 0, 0),
(55, 30, '手提後背長蛙鞋袋(魔鬼魚款)', 'product_30_1733125559_0.jpg', 1, 0),
(56, 30, '手提後背長蛙鞋袋(魔鬼魚款)', 'product_30_1733125559_1.jpg', 0, 0),
(57, 30, '手提後背長蛙鞋袋(魔鬼魚款)', 'product_30_1733125559_2.jpg', 0, 0),
(58, 30, '手提後背長蛙鞋袋(魔鬼魚款)', 'product_30_1733125559_3.jpg', 0, 0),
(59, 30, '手提後背長蛙鞋袋(魔鬼魚款)', 'product_30_1733125559_4.jpg', 0, 0),
(60, 30, '手提後背長蛙鞋袋(魔鬼魚款)', 'product_30_1733125559_5.jpg', 0, 0),
(61, 31, '基本款長蛙鞋袋 (白)', 'product_31_1733125659_0.jpg', 1, 0),
(62, 31, '基本款長蛙鞋袋 (白)', 'product_31_1733125659_1.jpg', 0, 0),
(63, 31, '基本款長蛙鞋袋 (白)', 'product_31_1733125659_2.jpg', 0, 0),
(64, 32, '基本款長蛙鞋袋 (紅)', 'product_32_1733125714_0.jpg', 1, 0),
(65, 32, '基本款長蛙鞋袋 (紅)', 'product_32_1733125714_1.jpg', 0, 0),
(66, 32, '基本款長蛙鞋袋 (紅)', 'product_32_1733125714_2.jpg', 0, 0),
(67, 33, '基本款長蛙鞋袋 (黑)', 'product_33_1733125830_0.jpg', 1, 0),
(68, 33, '基本款長蛙鞋袋 (黑)', 'product_33_1733125830_1.jpg', 0, 0),
(69, 33, '基本款長蛙鞋袋 (黑)', 'product_33_1733125830_2.jpg', 0, 0),
(70, 34, '基本款長蛙鞋袋 (藍)', 'product_34_1733125868_0.jpg', 1, 0),
(71, 34, '基本款長蛙鞋袋 (藍)', 'product_34_1733125868_1.jpg', 0, 0),
(72, 34, '基本款長蛙鞋袋 (藍)', 'product_34_1733125868_2.jpg', 0, 0),
(73, 35, 'APNEA BACKPACK 後背包 自潛_漁獵裝備袋', 'product_35_1733125927_0.jpg', 1, 0),
(74, 35, 'APNEA BACKPACK 後背包 自潛_漁獵裝備袋', 'product_35_1733125927_1.jpg', 0, 0),
(75, 35, 'APNEA BACKPACK 後背包 自潛_漁獵裝備袋', 'product_35_1733125927_2.jpg', 0, 0),
(76, 35, 'APNEA BACKPACK 後背包 自潛_漁獵裝備袋', 'product_35_1733125927_3.jpg', 0, 0),
(77, 35, 'APNEA BACKPACK 後背包 自潛_漁獵裝備袋', 'product_35_1733125927_4.jpg', 0, 0),
(78, 35, 'APNEA BACKPACK 後背包 自潛_漁獵裝備袋', 'product_35_1733125927_5.jpg', 0, 0),
(79, 35, 'APNEA BACKPACK 後背包 自潛_漁獵裝備袋', 'product_35_1733125927_6.jpg', 0, 0),
(80, 35, 'APNEA BACKPACK 後背包 自潛_漁獵裝備袋', 'product_35_1733125927_7.jpg', 0, 0),
(81, 35, 'APNEA BACKPACK 後背包 自潛_漁獵裝備袋', 'product_35_1733125927_8.jpg', 0, 0),
(82, 36, 'MUNDIAL BACKPACK 2 後背包 自潛_漁獵裝備袋', 'product_36_1733126122_0.jpg', 1, 0),
(83, 36, 'MUNDIAL BACKPACK 2 後背包 自潛_漁獵裝備袋', 'product_36_1733126122_1.jpg', 0, 0),
(84, 36, 'MUNDIAL BACKPACK 2 後背包 自潛_漁獵裝備袋', 'product_36_1733126122_2.jpg', 0, 0),
(85, 36, 'MUNDIAL BACKPACK 2 後背包 自潛_漁獵裝備袋', 'product_36_1733126123_3.jpg', 0, 0),
(86, 36, 'MUNDIAL BACKPACK 2 後背包 自潛_漁獵裝備袋', 'product_36_1733126123_4.jpg', 0, 0),
(87, 36, 'MUNDIAL BACKPACK 2 後背包 自潛_漁獵裝備袋', 'product_36_1733126123_5.jpg', 0, 0),
(88, 36, 'MUNDIAL BACKPACK 2 後背包 自潛_漁獵裝備袋', 'product_36_1733126123_6.jpg', 0, 0),
(89, 36, 'MUNDIAL BACKPACK 2 後背包 自潛_漁獵裝備袋', 'product_36_1733126123_7.jpg', 0, 0),
(90, 36, 'MUNDIAL BACKPACK 2 後背包 自潛_漁獵裝備袋', 'product_36_1733126123_8.jpg', 0, 0),
(91, 37, 'STANDARD FINS BAG 標準版後背包', 'product_37_1733126298_0.jpg', 1, 0),
(92, 37, 'STANDARD FINS BAG 標準版後背包', 'product_37_1733126298_1.jpg', 0, 0),
(93, 37, 'STANDARD FINS BAG 標準版後背包', 'product_37_1733126298_2.jpg', 0, 0),
(94, 38, 'VETERAN 加大款長蛙鞋袋 (BG-CL37)', 'product_38_1733126372_0.jpg', 1, 0),
(95, 38, 'VETERAN 加大款長蛙鞋袋 (BG-CL37)', 'product_38_1733126372_1.jpg', 0, 0),
(96, 39, 'VOLARE FINS BAG 後背包 / 自潛裝備袋', 'product_39_1733126418_0.jpg', 1, 0),
(97, 39, 'VOLARE FINS BAG 後背包 / 自潛裝備袋', 'product_39_1733126418_1.jpg', 0, 0),
(98, 39, 'VOLARE FINS BAG 後背包 / 自潛裝備袋', 'product_39_1733126418_2.jpg', 0, 0),
(99, 39, 'VOLARE FINS BAG 後背包 / 自潛裝備袋', 'product_39_1733126418_3.jpg', 0, 0),
(100, 39, 'VOLARE FINS BAG 後背包 / 自潛裝備袋', 'product_39_1733126418_4.jpg', 0, 0),
(101, 40, 'VOLARE SPEARFISHING FINS BAG 後背包 / 自潛、漁獵裝備袋', 'product_40_1733126487_0.jpg', 1, 0),
(102, 40, 'VOLARE SPEARFISHING FINS BAG 後背包 / 自潛、漁獵裝備袋', 'product_40_1733126487_1.jpg', 0, 0),
(103, 40, 'VOLARE SPEARFISHING FINS BAG 後背包 / 自潛、漁獵裝備袋', 'product_40_1733126487_2.jpg', 0, 0),
(104, 41, '手提後背長蛙鞋袋(LOGO經典款)', 'product_41_1733126537_0.jpg', 1, 0),
(105, 41, '手提後背長蛙鞋袋(LOGO經典款)', 'product_41_1733126537_1.jpg', 0, 0),
(106, 41, '手提後背長蛙鞋袋(LOGO經典款)', 'product_41_1733126537_2.jpg', 0, 0),
(107, 41, '手提後背長蛙鞋袋(LOGO經典款)', 'product_41_1733126537_3.jpg', 0, 0),
(108, 41, '手提後背長蛙鞋袋(LOGO經典款)', 'product_41_1733126537_4.jpg', 0, 0),
(109, 41, '手提後背長蛙鞋袋(LOGO經典款)', 'product_41_1733126537_5.jpg', 0, 0),
(110, 41, '手提後背長蛙鞋袋(LOGO經典款)', 'product_41_1733126537_6.jpg', 0, 0),
(111, 41, '手提後背長蛙鞋袋(LOGO經典款)', 'product_41_1733126537_7.jpg', 0, 0),
(112, 41, '手提後背長蛙鞋袋(LOGO經典款)', 'product_41_1733126537_8.jpg', 0, 0),
(113, 42, '手提後背長蛙鞋袋(章魚款)', 'product_42_1733126574_0.jpg', 1, 0),
(114, 43, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_43_1733126681_0.jpg', 1, 0),
(115, 43, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_43_1733126681_1.jpg', 0, 0),
(116, 43, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_43_1733126681_2.jpg', 0, 0),
(117, 43, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_43_1733126681_3.jpg', 0, 0),
(118, 43, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_43_1733126681_4.jpg', 0, 0),
(119, 43, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_43_1733126681_5.jpg', 0, 0),
(120, 43, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_43_1733126681_6.jpg', 0, 0),
(121, 43, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_43_1733126681_7.jpg', 0, 0),
(122, 43, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_43_1733126681_8.jpg', 0, 0),
(123, 43, '手提後背長蛙鞋袋(錘頭鯊款)', 'product_43_1733126681_9.jpg', 0, 0),
(124, 44, '手提後背長蛙鞋袋(魔鬼魚款)', 'product_44_1733126714_0.jpg', 1, 0),
(125, 44, '手提後背長蛙鞋袋(魔鬼魚款)', 'product_44_1733126714_1.jpg', 0, 0),
(126, 44, '手提後背長蛙鞋袋(魔鬼魚款)', 'product_44_1733126714_2.jpg', 0, 0),
(127, 44, '手提後背長蛙鞋袋(魔鬼魚款)', 'product_44_1733126714_3.jpg', 0, 0),
(128, 44, '手提後背長蛙鞋袋(魔鬼魚款)', 'product_44_1733126714_4.jpg', 0, 0),
(129, 44, '手提後背長蛙鞋袋(魔鬼魚款)', 'product_44_1733126714_5.jpg', 0, 0),
(130, 45, 'Bifin Blade Protection 雙蹼蛙鞋板保護套', 'product_45_1733126763_0.jpg', 1, 0),
(131, 45, 'Bifin Blade Protection 雙蹼蛙鞋板保護套', 'product_45_1733126763_1.jpg', 0, 0),
(132, 45, 'Bifin Blade Protection 雙蹼蛙鞋板保護套', 'product_45_1733126763_2.jpg', 0, 0),
(133, 45, 'Bifin Blade Protection 雙蹼蛙鞋板保護套', 'product_45_1733126763_3.jpg', 0, 0),
(134, 45, 'Bifin Blade Protection 雙蹼蛙鞋板保護套', 'product_45_1733126763_4.jpg', 0, 0),
(135, 45, 'Bifin Blade Protection 雙蹼蛙鞋板保護套', 'product_45_1733126763_5.jpg', 0, 0),
(136, 45, 'Bifin Blade Protection 雙蹼蛙鞋板保護套', 'product_45_1733126763_6.jpg', 0, 0),
(137, 45, 'Bifin Blade Protection 雙蹼蛙鞋板保護套', 'product_45_1733126763_7.jpg', 0, 0),
(138, 46, 'Inner Pad 長蛙袋減震軟墊', 'product_46_1733126793_0.jpg', 1, 0),
(139, 46, 'Inner Pad 長蛙袋減震軟墊', 'product_46_1733126793_1.jpg', 0, 0),
(140, 46, 'Inner Pad 長蛙袋減震軟墊', 'product_46_1733126793_2.jpg', 0, 0),
(141, 47, 'Monofin Blade Protection 單蹼蛙鞋板保護套', 'product_47_1733126845_0.jpg', 1, 0),
(142, 47, 'Monofin Blade Protection 單蹼蛙鞋板保護套', 'product_47_1733126845_1.jpg', 0, 0),
(143, 47, 'Monofin Blade Protection 單蹼蛙鞋板保護套', 'product_47_1733126845_2.jpg', 0, 0),
(144, 47, 'Monofin Blade Protection 單蹼蛙鞋板保護套', 'product_47_1733126845_3.jpg', 0, 0),
(145, 48, 'Re Make小琉球海龜包', 'product_48_1733127050_0.jpg', 1, 0),
(146, 48, 'Re Make小琉球海龜包', 'product_48_1733127050_1.jpg', 0, 0),
(147, 49, 'Re Make海蛞蝓包', 'product_49_1733127087_0.jpg', 1, 0),
(148, 49, 'Re Make海蛞蝓包', 'product_49_1733127087_1.jpg', 0, 0),
(149, 50, '斜背小物袋SACOCHE BAG (土耳其藍_翡翠綠)', 'product_50_1733127179_0.jpg', 1, 0),
(150, 50, '斜背小物袋SACOCHE BAG (土耳其藍_翡翠綠)', 'product_50_1733127179_1.jpg', 0, 0),
(151, 51, '斜背小物袋SACOCHE BAG (黑色皮面)', 'product_51_1733127226_0.jpg', 1, 0),
(152, 51, '斜背小物袋SACOCHE BAG (黑色皮面)', 'product_51_1733127226_1.jpg', 0, 0),
(153, 52, '斜背小物袋SACOCHE BAG (煙灰藍/碳灰)', 'product_52_1733127270_0.jpg', 1, 0),
(154, 52, '斜背小物袋SACOCHE BAG (煙灰藍/碳灰)', 'product_52_1733127270_1.jpg', 0, 0),
(155, 52, '斜背小物袋SACOCHE BAG (煙灰藍/碳灰)', 'product_52_1733127270_2.jpg', 0, 0),
(156, 53, '斜背小物袋SACOCHE BAG (橄欖綠_墨綠)', 'product_53_1733127302_0.jpg', 1, 0),
(157, 53, '斜背小物袋SACOCHE BAG (橄欖綠_墨綠)', 'product_53_1733127302_1.jpg', 0, 0),
(158, 53, '斜背小物袋SACOCHE BAG (橄欖綠_墨綠)', 'product_53_1733127302_2.jpg', 0, 0),
(159, 54, '斜背小物袋SACOCHE BAG (薰衣草紫_薄荷綠)', 'product_54_1733127403_0.jpg', 1, 0),
(160, 54, '斜背小物袋SACOCHE BAG (薰衣草紫_薄荷綠)', 'product_54_1733127403_1.jpg', 0, 0),
(161, 54, '斜背小物袋SACOCHE BAG (薰衣草紫_薄荷綠)', 'product_54_1733127403_2.jpg', 0, 0),
(162, 55, 'BLOW MINI托特包', 'product_55_1733127447_0.jpg', 1, 0),
(163, 55, 'BLOW MINI托特包', 'product_55_1733127447_1.jpg', 0, 0),
(164, 55, 'BLOW MINI托特包', 'product_55_1733127447_2.jpg', 0, 0),
(165, 55, 'BLOW MINI托特包', 'product_55_1733127447_3.jpg', 0, 0),
(166, 55, 'BLOW MINI托特包', 'product_55_1733127447_4.jpg', 0, 0),
(167, 55, 'BLOW MINI托特包', 'product_55_1733127447_5.jpg', 0, 0),
(168, 55, 'BLOW MINI托特包', 'product_55_1733127447_6.jpg', 0, 0),
(169, 55, 'BLOW MINI托特包', 'product_55_1733127447_7.jpg', 0, 0),
(170, 55, 'BLOW MINI托特包', 'product_55_1733127447_8.jpg', 0, 0),
(171, 55, 'BLOW MINI托特包', 'product_55_1733127447_9.jpg', 0, 0),
(172, 55, 'BLOW MINI托特包', 'product_55_1733127447_10.jpg', 0, 0),
(173, 55, 'BLOW MINI托特包', 'product_55_1733127447_11.jpg', 0, 0),
(174, 55, 'BLOW MINI托特包', 'product_55_1733127447_12.jpg', 0, 0),
(175, 56, 'Blow托特包 _32L', 'product_56_1733127487_0.jpg', 1, 0),
(176, 56, 'Blow托特包 _32L', 'product_56_1733127487_1.jpg', 0, 0),
(177, 56, 'Blow托特包 _32L', 'product_56_1733127487_2.jpg', 0, 0),
(178, 56, 'Blow托特包 _32L', 'product_56_1733127487_3.jpg', 0, 0),
(179, 56, 'Blow托特包 _32L', 'product_56_1733127487_4.jpg', 0, 0),
(180, 56, 'Blow托特包 _32L', 'product_56_1733127487_5.jpg', 0, 0),
(181, 56, 'Blow托特包 _32L', 'product_56_1733127487_6.jpg', 0, 0),
(182, 56, 'Blow托特包 _32L', 'product_56_1733127487_7.jpg', 0, 0),
(183, 56, 'Blow托特包 _32L', 'product_56_1733127487_8.jpg', 0, 0),
(184, 56, 'Blow托特包 _32L', 'product_56_1733127487_9.jpg', 0, 0),
(185, 56, 'Blow托特包 _32L', 'product_56_1733127487_10.jpg', 0, 0),
(186, 56, 'Blow托特包 _32L', 'product_56_1733127487_11.jpg', 0, 0),
(187, 56, 'Blow托特包 _32L', 'product_56_1733127487_12.jpg', 0, 0),
(188, 56, 'Blow托特包 _32L', 'product_56_1733127487_13.jpg', 0, 0),
(189, 57, 'HANDY BAG手拿包 _ 設計聯名款', 'product_57_1733127543_0.jpg', 1, 0),
(190, 58, 'Mactra 防水旅行包', 'product_58_1733127574_0.jpg', 1, 0),
(191, 58, 'Mactra 防水旅行包', 'product_58_1733127574_1.jpg', 0, 0),
(192, 58, 'Mactra 防水旅行包', 'product_58_1733127574_2.jpg', 0, 0),
(193, 58, 'Mactra 防水旅行包', 'product_58_1733127574_3.jpg', 0, 0),
(194, 58, 'Mactra 防水旅行包', 'product_58_1733127574_4.jpg', 0, 0),
(195, 58, 'Mactra 防水旅行包', 'product_58_1733127574_5.jpg', 0, 0),
(196, 58, 'Mactra 防水旅行包', 'product_58_1733127574_6.jpg', 0, 0),
(197, 59, '漁獵包包', 'product_59_1733127630_0.jpg', 1, 0),
(198, 59, '漁獵包包', 'product_59_1733127630_1.jpg', 0, 0),
(199, 59, '漁獵包包', 'product_59_1733127630_2.jpg', 0, 0),
(200, 60, 'Monofin Blade Protection 單蹼蛙鞋板保護套', 'product_60_1733127667_0.jpg', 1, 0),
(201, 60, 'Monofin Blade Protection 單蹼蛙鞋板保護套', 'product_60_1733127667_1.jpg', 0, 0),
(202, 60, 'Monofin Blade Protection 單蹼蛙鞋板保護套', 'product_60_1733127667_2.jpg', 0, 0),
(203, 60, 'Monofin Blade Protection 單蹼蛙鞋板保護套', 'product_60_1733127667_3.jpg', 0, 0),
(204, 61, '半硬質單蹼蛙鞋袋2代(紅色)', 'product_61_1733127720_0.jpg', 1, 0),
(205, 61, '半硬質單蹼蛙鞋袋2代(紅色)', 'product_61_1733127720_1.jpg', 0, 0),
(206, 61, '半硬質單蹼蛙鞋袋2代(紅色)', 'product_61_1733127720_2.jpg', 0, 0),
(207, 61, '半硬質單蹼蛙鞋袋2代(紅色)', 'product_61_1733127720_3.jpg', 0, 0),
(208, 62, '半硬質單蹼蛙鞋袋2代(黑色)', 'product_62_1733127754_0.jpg', 1, 0),
(209, 62, '半硬質單蹼蛙鞋袋2代(黑色)', 'product_62_1733127754_1.jpg', 0, 0),
(210, 62, '半硬質單蹼蛙鞋袋2代(黑色)', 'product_62_1733127754_2.jpg', 0, 0),
(211, 63, '半硬質單蹼蛙鞋袋2代(藍色)', 'product_63_1733127785_0.jpg', 1, 0),
(212, 63, '半硬質單蹼蛙鞋袋2代(藍色)', 'product_63_1733127785_1.jpg', 0, 0),
(213, 63, '半硬質單蹼蛙鞋袋2代(藍色)', 'product_63_1733127785_2.jpg', 0, 0),
(214, 63, '半硬質單蹼蛙鞋袋2代(藍色)', 'product_63_1733127785_3.jpg', 0, 0),
(215, 63, '半硬質單蹼蛙鞋袋2代(藍色)', 'product_63_1733127785_4.jpg', 0, 0),
(216, 64, '單蹼蛙鞋袋 _雙肩背', 'product_64_1733127817_0.jpg', 1, 0),
(217, 64, '單蹼蛙鞋袋 _雙肩背', 'product_64_1733127817_1.jpg', 0, 0),
(218, 64, '單蹼蛙鞋袋 _雙肩背', 'product_64_1733127817_2.jpg', 0, 0),
(219, 65, 'Short Bifins Backpack 後揹式短蛙袋', 'product_65_1733127853_0.jpg', 1, 0),
(220, 65, 'Short Bifins Backpack 後揹式短蛙袋', 'product_65_1733127853_1.jpg', 0, 0),
(221, 65, 'Short Bifins Backpack 後揹式短蛙袋', 'product_65_1733127853_2.jpg', 0, 0),
(222, 65, 'Short Bifins Backpack 後揹式短蛙袋', 'product_65_1733127853_3.jpg', 0, 0),
(223, 65, 'Short Bifins Backpack 後揹式短蛙袋', 'product_65_1733127853_4.jpg', 0, 0),
(224, 65, 'Short Bifins Backpack 後揹式短蛙袋', 'product_65_1733127853_5.jpg', 0, 0),
(225, 66, 'NUDE TUBE MINI防水收納袋', 'product_66_1733127900_0.jpg', 1, 0),
(226, 67, 'NUDE TUBE S防水收納袋', 'product_67_1733127927_0.jpg', 1, 0),
(227, 68, 'SD防水腰包II代', 'product_68_1733127984_0.jpg', 1, 0),
(228, 68, 'SD防水腰包II代', 'product_68_1733127984_1.jpg', 0, 0),
(229, 68, 'SD防水腰包II代', 'product_68_1733127984_2.jpg', 0, 0),
(230, 68, 'SD防水腰包II代', 'product_68_1733127984_3.jpg', 0, 0),
(231, 68, 'SD防水腰包II代', 'product_68_1733127984_4.jpg', 0, 0),
(232, 68, 'SD防水腰包II代', 'product_68_1733127984_5.jpg', 0, 0),
(233, 69, '機能袋(大)', 'product_69_1733128012_0.jpg', 1, 0),
(234, 69, '機能袋(大)', 'product_69_1733128012_1.jpg', 0, 0),
(235, 69, '機能袋(大)', 'product_69_1733128012_2.jpg', 0, 0),
(236, 69, '機能袋(大)', 'product_69_1733128012_3.jpg', 0, 0),
(237, 69, '機能袋(大)', 'product_69_1733128012_4.jpg', 0, 0),
(238, 70, '機能袋(小)', 'product_70_1733128047_0.jpg', 1, 0),
(239, 70, '機能袋(小)', 'product_70_1733128047_1.jpg', 0, 0),
(240, 70, '機能袋(小)', 'product_70_1733128047_2.jpg', 0, 0),
(241, 70, '機能袋(小)', 'product_70_1733128047_3.jpg', 0, 0),
(242, 70, '機能袋(小)', 'product_70_1733128047_4.jpg', 0, 0),
(243, 71, '機能袋(中)', 'product_71_1733128075_0.jpg', 1, 0),
(244, 71, '機能袋(中)', 'product_71_1733128075_1.jpg', 0, 0),
(245, 71, '機能袋(中)', 'product_71_1733128075_2.jpg', 0, 0),
(246, 71, '機能袋(中)', 'product_71_1733128075_3.jpg', 0, 0),
(247, 71, '機能袋(中)', 'product_71_1733128075_4.jpg', 0, 0),
(248, 71, '機能袋(中)', 'product_71_1733128075_5.jpg', 0, 0),
(249, 72, 'BIG TOTE 防水裝備袋_大托特包 (中大型尺寸)', 'product_72_1733128126_0.jpg', 1, 0),
(250, 72, 'BIG TOTE 防水裝備袋_大托特包 (中大型尺寸)', 'product_72_1733128126_1.jpg', 0, 0),
(251, 72, 'BIG TOTE 防水裝備袋_大托特包 (中大型尺寸)', 'product_72_1733128126_2.jpg', 0, 0),
(252, 73, 'GUN BAG PVC長型裝備袋', 'product_73_1733128294_0.jpg', 1, 0),
(253, 73, 'GUN BAG PVC長型裝備袋', 'product_73_1733128294_1.jpg', 0, 0),
(254, 73, 'GUN BAG PVC長型裝備袋', 'product_73_1733128294_2.jpg', 0, 0),
(255, 74, 'Hard Case 潛水旅行箱', 'product_74_1733128324_0.jpg', 1, 0),
(256, 74, 'Hard Case 潛水旅行箱', 'product_74_1733128324_1.jpg', 0, 0),
(257, 74, 'Hard Case 潛水旅行箱', 'product_74_1733128324_2.jpg', 0, 0),
(258, 74, 'Hard Case 潛水旅行箱', 'product_74_1733128324_3.jpg', 0, 0),
(259, 74, 'Hard Case 潛水旅行箱', 'product_74_1733128324_4.jpg', 0, 0),
(260, 74, 'Hard Case 潛水旅行箱', 'product_74_1733128324_5.jpg', 0, 0),
(261, 74, 'Hard Case 潛水旅行箱', 'product_74_1733128324_6.jpg', 0, 0),
(262, 74, 'Hard Case 潛水旅行箱', 'product_74_1733128324_7.jpg', 0, 0),
(263, 74, 'Hard Case 潛水旅行箱', 'product_74_1733128324_8.jpg', 0, 0),
(264, 74, 'Hard Case 潛水旅行箱', 'product_74_1733128324_9.jpg', 0, 0),
(265, 75, 'Mactra 防水旅行包', 'product_75_1733128352_0.jpg', 1, 0),
(266, 75, 'Mactra 防水旅行包', 'product_75_1733128352_1.jpg', 0, 0),
(267, 75, 'Mactra 防水旅行包', 'product_75_1733128352_2.jpg', 0, 0),
(268, 75, 'Mactra 防水旅行包', 'product_75_1733128352_3.jpg', 0, 0),
(269, 75, 'Mactra 防水旅行包', 'product_75_1733128352_4.jpg', 0, 0),
(270, 75, 'Mactra 防水旅行包', 'product_75_1733128352_5.jpg', 0, 0),
(271, 75, 'Mactra 防水旅行包', 'product_75_1733128352_6.jpg', 0, 0),
(272, 76, 'SHINANO 拉桿拖輪防水行李箱', 'product_76_1733128385_0.jpg', 1, 0),
(273, 76, 'SHINANO 拉桿拖輪防水行李箱', 'product_76_1733128385_1.jpg', 0, 0),
(274, 76, 'SHINANO 拉桿拖輪防水行李箱', 'product_76_1733128385_2.jpg', 0, 0),
(275, 76, 'SHINANO 拉桿拖輪防水行李箱', 'product_76_1733128385_3.jpg', 0, 0),
(276, 76, 'SHINANO 拉桿拖輪防水行李箱', 'product_76_1733128385_4.jpg', 0, 0),
(277, 76, 'SHINANO 拉桿拖輪防水行李箱', 'product_76_1733128385_5.jpg', 0, 0),
(278, 76, 'SHINANO 拉桿拖輪防水行李箱', 'product_76_1733128385_6.jpg', 0, 0),
(279, 76, 'SHINANO 拉桿拖輪防水行李箱', 'product_76_1733128385_7.jpg', 0, 0),
(280, 76, 'SHINANO 拉桿拖輪防水行李箱', 'product_76_1733128385_8.jpg', 0, 0),
(281, 76, 'SHINANO 拉桿拖輪防水行李箱', 'product_76_1733128385_9.jpg', 0, 0),
(282, 76, 'SHINANO 拉桿拖輪防水行李箱', 'product_76_1733128385_10.jpg', 0, 0),
(283, 76, 'SHINANO 拉桿拖輪防水行李箱', 'product_76_1733128385_11.jpg', 0, 0),
(284, 76, 'SHINANO 拉桿拖輪防水行李箱', 'product_76_1733128385_12.jpg', 0, 0),
(285, 76, 'SHINANO 拉桿拖輪防水行李箱', 'product_76_1733128385_13.jpg', 0, 0),
(286, 77, 'TEKNO BAG 大型裝備袋', 'product_77_1733128420_0.jpg', 1, 0),
(287, 77, 'TEKNO BAG 大型裝備袋', 'product_77_1733128420_1.jpg', 0, 0),
(288, 77, 'TEKNO BAG 大型裝備袋', 'product_77_1733128420_2.jpg', 0, 0),
(289, 77, 'TEKNO BAG 大型裝備袋', 'product_77_1733128420_3.jpg', 0, 0),
(290, 77, 'TEKNO BAG 大型裝備袋', 'product_77_1733128420_4.jpg', 0, 0),
(291, 77, 'TEKNO BAG 大型裝備袋', 'product_77_1733128420_5.jpg', 0, 0),
(292, 77, 'TEKNO BAG 大型裝備袋', 'product_77_1733128420_6.jpg', 0, 0),
(293, 77, 'TEKNO BAG 大型裝備袋', 'product_77_1733128420_7.jpg', 0, 0),
(294, 78, 'TREKKER CARRY BAG 拖輪式裝備箱', 'product_78_1733129040_0.jpg', 1, 0),
(295, 78, 'TREKKER CARRY BAG 拖輪式裝備箱', 'product_78_1733129040_1.jpg', 0, 0),
(296, 78, 'TREKKER CARRY BAG 拖輪式裝備箱', 'product_78_1733129040_2.jpg', 0, 0),
(297, 78, 'TREKKER CARRY BAG 拖輪式裝備箱', 'product_78_1733129040_3.jpg', 0, 0),
(298, 78, 'TREKKER CARRY BAG 拖輪式裝備箱', 'product_78_1733129040_4.jpg', 0, 0),
(299, 78, 'TREKKER CARRY BAG 拖輪式裝備箱', 'product_78_1733129040_5.jpg', 0, 0),
(300, 78, 'TREKKER CARRY BAG 拖輪式裝備箱', 'product_78_1733129040_6.jpg', 0, 0),
(301, 78, 'TREKKER CARRY BAG 拖輪式裝備箱', 'product_78_1733129040_7.jpg', 0, 0),
(302, 78, 'TREKKER CARRY BAG 拖輪式裝備箱', 'product_78_1733129040_8.jpg', 0, 0),
(303, 78, 'TREKKER CARRY BAG 拖輪式裝備箱', 'product_78_1733129040_9.jpg', 0, 0),
(304, 78, 'TREKKER CARRY BAG 拖輪式裝備箱', 'product_78_1733129040_10.jpg', 0, 0),
(305, 78, 'TREKKER CARRY BAG 拖輪式裝備箱', 'product_78_1733129040_11.jpg', 0, 0),
(306, 79, 'U BOOT BAG大型裝備袋 素黑款', 'product_79_1733129071_0.jpg', 1, 0),
(307, 79, 'U BOOT BAG大型裝備袋 素黑款', 'product_79_1733129071_1.jpg', 0, 0),
(308, 79, 'U BOOT BAG大型裝備袋 素黑款', 'product_79_1733129071_2.jpg', 0, 0),
(309, 79, 'U BOOT BAG大型裝備袋 素黑款', 'product_79_1733129071_3.jpg', 0, 0),
(310, 79, 'U BOOT BAG大型裝備袋 素黑款', 'product_79_1733129071_4.jpg', 0, 0),
(311, 79, 'U BOOT BAG大型裝備袋 素黑款', 'product_79_1733129071_5.jpg', 0, 0),
(312, 79, 'U BOOT BAG大型裝備袋 素黑款', 'product_79_1733129071_6.jpg', 0, 0),
(313, 79, 'U BOOT BAG大型裝備袋 素黑款', 'product_79_1733129071_7.jpg', 0, 0),
(314, 79, 'U BOOT BAG大型裝備袋 素黑款', 'product_79_1733129071_8.jpg', 0, 0),
(315, 79, 'U BOOT BAG大型裝備袋 素黑款', 'product_79_1733129071_9.jpg', 0, 0),
(316, 80, 'UP-B1 中型裝備袋', 'product_80_1733129110_0.jpg', 1, 0),
(317, 80, 'UP-B1 中型裝備袋', 'product_80_1733129110_1.jpg', 0, 0),
(318, 80, 'UP-B1 中型裝備袋', 'product_80_1733129110_2.jpg', 0, 0),
(319, 80, 'UP-B1 中型裝備袋', 'product_80_1733129110_3.jpg', 0, 0),
(320, 81, '裝備袋 _ 展示品', 'product_81_1733129133_0.jpg', 1, 0),
(321, 81, '裝備袋 _ 展示品', 'product_81_1733129133_1.jpg', 0, 0),
(322, 81, '裝備袋 _ 展示品', 'product_81_1733129133_2.jpg', 0, 0),
(323, 82, '大齒型鋸片 _ 21吋', 'product_82_1733129259_0.jpg', 1, 0),
(324, 82, '大齒型鋸片 _ 21吋', 'product_82_1733129259_1.jpg', 0, 0),
(325, 82, '大齒型鋸片 _ 21吋', 'product_82_1733129259_2.jpg', 0, 0),
(326, 82, '大齒型鋸片 _ 21吋', 'product_82_1733129259_3.jpg', 0, 0),
(327, 82, '大齒型鋸片 _ 21吋', 'product_82_1733129259_4.jpg', 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `product_orders`
--

CREATE TABLE `product_orders` (
  `id` int(11) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `shipping_method` varchar(50) NOT NULL,
  `product_status` enum('pending','processing','completed','cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product_orders`
--

INSERT INTO `product_orders` (`id`, `shipping_address`, `shipping_method`, `product_status`) VALUES
(1, '123 Main St, Taipei', '宅配', 'processing'),
(2, '456 Market St, Taichung', '宅配', 'completed'),
(3, '台北市信義區101號', '宅配', 'processing');

-- --------------------------------------------------------

--
-- 資料表結構 `product_order_items`
--

CREATE TABLE `product_order_items` (
  `id` int(11) NOT NULL,
  `product_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product_order_items`
--

INSERT INTO `product_order_items` (`id`, `product_order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 2, 500.00),
(2, 1, 2, 1, 1000.00),
(3, 2, 3, 1, 1500.00),
(4, 1, 13, 2, 132.00),
(5, 1, 14, 1, 2020.00);

-- --------------------------------------------------------

--
-- 資料表結構 `product_specification`
--

CREATE TABLE `product_specification` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) DEFAULT NULL,
  `size_id` int(10) DEFAULT NULL,
  `material_id` int(10) DEFAULT NULL,
  `color_id` int(10) DEFAULT NULL,
  `brand_id` int(10) DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 未刪除, 1: 已刪除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product_specification`
--

INSERT INTO `product_specification` (`id`, `product_id`, `size_id`, `material_id`, `color_id`, `brand_id`, `isDeleted`) VALUES
(2, 2, 1, 2, 3, 2, 1),
(16, 2, 1, NULL, 3, 2, 1),
(20, 10, 1, NULL, 1, 1, 1),
(21, 11, 1, NULL, 2, 1, 1),
(22, 12, 1, NULL, 1, 1, 1),
(23, 13, 1, NULL, 1, 2, 0),
(24, 14, 1, NULL, 2, 2, 0),
(26, 16, 1, NULL, 5, 2, 1),
(27, 17, 1, NULL, 3, 1, 1),
(29, 19, 1, NULL, 1, 2, 0),
(31, 21, 1, NULL, 1, 1, 0),
(32, 22, 1, NULL, 2, 1, 0),
(33, 24, 1, NULL, 1, 1, 1),
(34, 25, 1, NULL, 2, 1, 1),
(35, 26, 2, NULL, 2, 1, 0),
(36, 27, 1, NULL, 1, 1, 0),
(37, 28, 1, NULL, 1, 1, 0),
(38, 29, 1, NULL, 1, 1, 0),
(39, 30, 1, NULL, 1, 1, 0),
(40, 31, 1, NULL, 1, 1, 0),
(41, 32, 1, NULL, 1, 1, 0),
(42, 33, 1, NULL, 1, 1, 0),
(43, 34, 1, NULL, 1, 1, 0),
(44, 35, 1, NULL, 1, 1, 0),
(45, 36, 1, NULL, 1, 1, 0),
(46, 37, 1, NULL, 1, 1, 0),
(47, 38, 1, NULL, 1, 1, 0),
(48, 39, 1, NULL, 1, 1, 0),
(49, 40, 1, NULL, 1, 1, 0),
(50, 41, 1, NULL, 1, 1, 0),
(51, 42, 1, NULL, 1, 1, 0),
(52, 43, 1, NULL, 1, 1, 0),
(53, 44, 1, NULL, 1, 1, 0),
(54, 45, 1, NULL, 1, 1, 0),
(55, 46, 1, NULL, 1, 1, 0),
(56, 47, 1, NULL, 1, 1, 0),
(57, 48, 1, NULL, 1, 1, 0),
(58, 49, 1, NULL, 1, 1, 0),
(59, 50, 1, NULL, 1, 1, 0),
(60, 51, 1, NULL, 1, 1, 0),
(61, 52, 1, NULL, 1, 1, 0),
(62, 53, 1, NULL, 1, 1, 0),
(63, 54, 1, NULL, 1, 1, 0),
(64, 55, 1, NULL, 1, 1, 0),
(65, 56, 1, NULL, 1, 1, 0),
(66, 57, 1, NULL, 1, 1, 0),
(67, 58, 1, NULL, 1, 1, 0),
(68, 59, 1, NULL, 1, 1, 0),
(69, 60, 1, NULL, 1, 1, 0),
(70, 61, 1, NULL, 1, 1, 0),
(71, 62, 1, NULL, 1, 1, 0),
(72, 63, 1, NULL, 1, 1, 0),
(73, 64, 1, NULL, 1, 1, 0),
(74, 65, 1, NULL, 1, 1, 0),
(75, 66, 1, NULL, 1, 1, 0),
(76, 67, 1, NULL, 1, 1, 0),
(77, 68, 1, NULL, 1, 1, 0),
(78, 69, 1, NULL, 1, 1, 0),
(79, 70, 1, NULL, 1, 1, 0),
(80, 71, 1, NULL, 1, 1, 0),
(81, 72, 1, NULL, 1, 1, 0),
(82, 73, 1, NULL, 1, 1, 0),
(83, 74, 1, NULL, 1, 1, 0),
(84, 75, 1, NULL, 1, 1, 0),
(85, 76, 1, NULL, 1, 1, 0),
(86, 77, 1, NULL, 1, 1, 0),
(87, 78, 1, NULL, 1, 1, 0),
(88, 79, 1, NULL, 1, 1, 0),
(89, 80, 1, NULL, 1, 1, 0),
(90, 81, 1, NULL, 1, 1, 0),
(91, 82, 1, NULL, 1, 1, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `rental_orders`
--

CREATE TABLE `rental_orders` (
  `id` int(11) NOT NULL,
  `rental_status` enum('pending','processing','completed','cancelled') NOT NULL,
  `deposit_total` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `rental_orders`
--

INSERT INTO `rental_orders` (`id`, `rental_status`, `deposit_total`, `start_date`, `end_date`) VALUES
(1, 'completed', 1000.00, '2024-11-01', '2024-11-10'),
(2, 'processing', 2000.00, '2024-12-01', '2024-12-10'),
(3, 'processing', 1500.00, '2024-12-15', '2024-12-20'),
(4, 'processing', 2500.00, '2024-12-20', '2024-12-25');

-- --------------------------------------------------------

--
-- 資料表結構 `rental_order_items`
--

CREATE TABLE `rental_order_items` (
  `id` int(11) NOT NULL,
  `rental_order_id` int(11) NOT NULL,
  `rent_item_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `deposit` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `rental_order_items`
--

INSERT INTO `rental_order_items` (`id`, `rental_order_id`, `rent_item_id`, `start_date`, `end_date`, `deposit`) VALUES
(1, 1, 1, '2024-11-01', '2024-11-05', 500.00),
(2, 1, 2, '2024-11-06', '2024-11-10', 500.00),
(3, 2, 1, '2024-12-01', '2024-12-05', 1000.00),
(4, 2, 2, '2024-12-06', '2024-12-10', 1000.00),
(5, 1, 1, '2024-12-01', '2024-12-05', 1000.00),
(6, 1, 2, '2024-12-06', '2024-12-10', 1500.00),
(7, 2, 3, '2024-12-15', '2024-12-20', 2000.00),
(8, 3, 4, '2024-12-20', '2024-12-25', 1800.00);

-- --------------------------------------------------------

--
-- 資料表結構 `rent_category_big`
--

CREATE TABLE `rent_category_big` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `rent_category_big`
--

INSERT INTO `rent_category_big` (`id`, `name`, `description`) VALUES
(1, '面鏡/呼吸管', ''),
(2, '蛙鞋', ''),
(3, '潛水配件', ''),
(4, '電子裝備/專業配件', '');

-- --------------------------------------------------------

--
-- 資料表結構 `rent_category_small`
--

CREATE TABLE `rent_category_small` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `rent_category_big_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `rent_category_small`
--

INSERT INTO `rent_category_small` (`id`, `name`, `description`, `rent_category_big_id`) VALUES
(1, '自由潛水面鏡', '', 1),
(2, '休閒潛水面鏡', '', 1),
(3, '度數鏡片面鏡', '', 1),
(4, '呼吸管', '', 1),
(5, '防霧劑/清潔劑', '', 1),
(6, '面鏡帶/面鏡盒/扣具', '', 1),
(7, '碳纖維長板', '', 2),
(8, '碳纖維短板', '', 2),
(9, '玻璃纖維長板', NULL, 2),
(10, '玻璃纖維短板', NULL, 2),
(11, '腳套', NULL, 2),
(12, '橡膠蛙鞋', NULL, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `rent_image`
--

CREATE TABLE `rent_image` (
  `id` int(10) UNSIGNED NOT NULL,
  `rent_item_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `is_main` tinyint(1) NOT NULL COMMENT '是否為主要展示圖片',
  `is_deleted` tinyint(1) NOT NULL COMMENT '0: 未刪除, 1: 已刪除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `rent_image`
--

INSERT INTO `rent_image` (`id`, `rent_item_id`, `name`, `img_url`, `is_main`, `is_deleted`) VALUES
(1, 1, '', 'uploads/1733124472_9221.jpg', 1, 0),
(2, 1, '', 'uploads/1733124472_6078.jpg', 0, 0),
(3, 1, '', 'uploads/1733124472_4846.jpg', 0, 0),
(4, 2, '', 'uploads/1733124512_2622.jpg', 1, 0),
(5, 2, '', 'uploads/1733124512_6969.jpg', 0, 0),
(6, 2, '', 'uploads/1733124512_9083.jpg', 0, 0),
(7, 2, '', 'uploads/1733124512_7877.jpg', 0, 0),
(8, 2, '', 'uploads/1733124512_9709.jpg', 0, 0),
(9, 2, '', 'uploads/1733124512_1864.jpg', 0, 0),
(10, 3, '', 'uploads/1733124566_2964.jpg', 1, 0),
(11, 3, '', 'uploads/1733124566_5817.jpg', 0, 0),
(12, 3, '', 'uploads/1733124566_1346.jpg', 0, 0),
(13, 3, '', 'uploads/1733124566_4117.jpg', 0, 0),
(14, 3, '', 'uploads/1733124566_1443.jpg', 0, 0),
(15, 3, '', 'uploads/1733124566_1656.jpg', 0, 0),
(16, 3, '', 'uploads/1733124566_7249.jpg', 0, 0),
(17, 3, '', 'uploads/1733124567_3651.jpg', 0, 0),
(18, 4, '', 'uploads/1733124613_3921.jpg', 1, 0),
(19, 4, '', 'uploads/1733124613_3382.jpg', 0, 0),
(20, 4, '', 'uploads/1733124613_5976.jpg', 0, 0),
(21, 4, '', 'uploads/1733124613_1623.jpg', 0, 0),
(22, 4, '', 'uploads/1733124613_8056.jpg', 0, 0),
(23, 4, '', 'uploads/1733124613_2806.jpg', 0, 0),
(24, 4, '', 'uploads/1733124613_2712.jpg', 0, 0),
(25, 4, '', 'uploads/1733124613_1584.jpg', 0, 0),
(26, 4, '', 'uploads/1733124613_5669.jpg', 0, 0),
(27, 5, '', 'uploads/1733124660_5203.jpg', 1, 0),
(28, 5, '', 'uploads/1733124660_1050.jpg', 0, 0),
(29, 6, '', 'uploads/1733124676_1957.jpg', 1, 0),
(30, 6, '', 'uploads/1733124676_8204.jpg', 0, 0),
(31, 6, '', 'uploads/1733124676_4383.jpg', 0, 0),
(32, 6, '', 'uploads/1733124676_7558.jpg', 0, 0),
(33, 7, '', 'uploads/1733124689_1746.jpg', 1, 0),
(34, 7, '', 'uploads/1733124689_3585.jpg', 0, 0),
(35, 7, '', 'uploads/1733124689_8081.jpg', 0, 0),
(36, 7, '', 'uploads/1733124689_2281.jpg', 0, 0),
(37, 7, '', 'uploads/1733124689_2789.jpg', 0, 0),
(38, 8, '', 'uploads/1733124703_9435.jpg', 1, 0),
(39, 8, '', 'uploads/1733124703_2778.jpg', 0, 0),
(40, 8, '', 'uploads/1733124703_9516.jpg', 0, 0),
(41, 9, '', 'uploads/1733124713_8019.jpg', 1, 0),
(42, 10, '', 'uploads/1733124896_9742.jpg', 1, 0),
(43, 10, '', 'uploads/1733125691_2113.jpg', 1, 0),
(44, 11, '', 'uploads/1733125941_8570.jpg', 1, 0),
(45, 11, '', 'uploads/1733125941_6036.jpg', 0, 0),
(46, 11, '', 'uploads/1733125941_6735.jpg', 0, 0),
(47, 11, '', 'uploads/1733125941_8462.jpg', 0, 0),
(48, 11, '', 'uploads/1733125941_9727.jpg', 0, 0),
(49, 12, '', 'uploads/1733126133_5470.jpg', 1, 0),
(50, 12, '', 'uploads/1733126133_5981.jpg', 0, 0),
(51, 12, '', 'uploads/1733126133_8713.jpg', 0, 0),
(52, 12, '', 'uploads/1733126133_1358.jpg', 0, 0),
(53, 12, '', 'uploads/1733126133_5349.jpg', 0, 0),
(54, 12, '', 'uploads/1733126133_3076.jpg', 0, 0),
(55, 12, '', 'uploads/1733126133_1137.jpg', 0, 0),
(56, 12, '', 'uploads/1733126133_1258.jpg', 0, 0),
(57, 12, '', 'uploads/1733126133_7126.jpg', 0, 0),
(58, 12, '', 'uploads/1733126133_4477.jpg', 0, 0),
(59, 13, '', 'uploads/1733126190_6416.jpg', 1, 0),
(60, 14, '', 'uploads/1733126246_4932.jpg', 1, 0),
(61, 15, '', 'uploads/1733126296_7818.jpg', 1, 0),
(62, 16, '', 'uploads/1733126364_7625.jpg', 1, 0),
(63, 17, '', 'uploads/1733126375_7193.jpg', 1, 0),
(64, 18, '', 'uploads/1733126474_4788.jpg', 1, 0),
(65, 18, '', 'uploads/1733126474_7144.jpg', 0, 0),
(66, 19, '', 'uploads/1733126913_4598.jpg', 1, 0),
(67, 19, '', 'uploads/1733126913_9434.jpg', 0, 0),
(68, 19, '', 'uploads/1733126913_5541.jpg', 0, 0),
(69, 19, '', 'uploads/1733126913_3328.jpg', 0, 0),
(70, 19, '', 'uploads/1733126913_2794.jpg', 0, 0),
(71, 19, '', 'uploads/1733126913_3637.jpg', 0, 0),
(72, 19, '', 'uploads/1733126913_7387.jpg', 0, 0),
(73, 19, '', 'uploads/1733126913_4813.jpg', 0, 0),
(74, 19, '', 'uploads/1733126913_3724.jpg', 0, 0),
(75, 20, '', 'uploads/1733127293_9533.jpg', 1, 0),
(76, 21, '', 'uploads/1733127315_8518.jpg', 1, 0),
(77, 21, '', 'uploads/1733127315_4505.jpg', 0, 0),
(78, 21, '', 'uploads/1733127337_8069.jpg', 1, 0),
(79, 21, '', 'uploads/1733127337_3716.jpg', 0, 0),
(80, 22, '', 'uploads/1733127422_3958.jpg', 1, 0),
(81, 23, '', 'uploads/1733127470_3453.jpg', 1, 0),
(82, 24, '', 'uploads/1733127558_3769.jpg', 1, 0),
(83, 24, '', 'uploads/1733127558_2031.jpg', 0, 0),
(84, 24, '', 'uploads/1733127558_9877.jpg', 0, 0),
(85, 24, '', 'uploads/1733127558_5618.jpg', 0, 0),
(86, 25, '', 'uploads/1733127703_7694.jpg', 1, 0),
(87, 25, '', 'uploads/1733127703_4710.jpg', 0, 0),
(88, 25, '', 'uploads/1733127703_2162.jpg', 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `rent_item`
--

CREATE TABLE `rent_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `rent_category_small_id` int(10) DEFAULT NULL COMMENT '關聯小分類表',
  `rent_cate﻿gory_big_id` int(10) DEFAULT NULL COMMENT '關聯大分類表',
  `name` varchar(255) NOT NULL,
  `price` int(10) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `stock` int(10) UNSIGNED DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `deposit` int(10) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 未刪除, 1: 已刪除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `rent_item`
--

INSERT INTO `rent_item` (`id`, `rent_category_small_id`, `rent_cate﻿gory_big_id`, `name`, `price`, `type`, `description`, `stock`, `start_date`, `end_date`, `deposit`, `is_deleted`) VALUES
(1, 1, 1, 'TRYGONS - 液態面鏡', 3500, NULL, '能保有正常水下視野，並省去面鏡平壓的空氣消耗\r\n外圍膠框以亞洲人臉型掃描製作，合臉度更佳；亦可自行打磨增加貼合\r\n搭配鼻夾使用，平衡耳壓更輕鬆\r\n\r\n・內含二顆凸透鏡，依潛水員瞳孔位置膠黏於膠框即完成安裝。\r\n・原廠安裝影片 https://www.youtube.com/watch?v=b3vZCzKmWOs', 5, '2024-12-02 00:00:00', NULL, 2100, 0),
(2, 1, 1, 'AQUA LUNG - SPHERA X 低容積面鏡', 2650, NULL, 'SPHERA X 新改版\r\n寬視野x低容積\r\n​運動性能優異的自由潛水面鏡 \r\n裙邊採舒適矽膠，柔軟更合臉、捏鼻更順手\r\n透明白款採鍍膜鏡片，防霧 x 耐刮 x 紫外線防護，接近180度的寬廣視野\r\n\r\n・標配環保EVA抗腐蝕拉鍊盒', 3, '2024-12-02 00:00:00', NULL, 1590, 0),
(3, 1, 1, 'APOLLO - BIO METAL PRO 手工拋光鏡框(經典海龍王)', 14500, 'Nippon Sensuiki Co., Ltd.', '為享譽盛名的高階面鏡-自潛、水肺皆可用，更是專業首選\r\n高強度、高耐用度，銀色邊框帥氣有型\r\n專利寬視野-高強度鏡框讓左右鏡片間距拉近至7mm，視野無阻礙 \r\nTYPE A低容積-為系列款式內容積最低(60cc) \r\n可依需求選配多款器材(如手電筒、運動攝影機等)', 1, '2024-12-02 02:49:00', NULL, 8700, 0),
(4, 1, 1, 'APOLLO - BIO METAL 多彩鋁合金鏡框(平民海龍王)', 7800, 'Nippon Sensuiki Co., Ltd.', 'BIO-METAL PRO為APOLLO享譽盛名的高階面鏡-本款BIO METAL為輕量化鋁合金鏡框版本，繽紛色彩；自潛、水肺皆可用\r\n鋁合金鏡框輕量、多彩、高強度；柔軟群邊，平壓順手\r\n專利寬視野-高強度鏡框讓左右鏡片間距拉近至7mm，視野無阻礙 \r\nTYPE A低容積-為系列款式內容積最低(60cc)', 0, '2024-12-02 02:49:00', NULL, 4680, 0),
(5, 1, 1, 'BEUCHAT - MAXLUX S 單片式面鏡', 2380, 'BEUCHAT', '無邊框設計，減少重量與體積，攜帶輕鬆。\r\n全景視野無阻隔，水中世界一覽無遺\r\n浮潛/水肺/自由潛水皆適用\r\n可搭配同色SPY軟式呼吸管\r\n\r\n・商品介紹\r\n-面鏡內容積：約127cm3', 0, '2024-12-02 02:51:00', NULL, 1428, 0),
(6, 1, 1, 'C4 -Condor Mask 低容積面鏡', 2550, NULL, '專為在任何類型的潛水活動中實現最佳性能而開發，適用自由潛水、魚獵、浮潛或水肺潛水。\r\n低容積搭配廣闊視野，使潛水員有更好的體驗，柔軟的矽膠裙邊，提供更好的服貼性及舒適度。\r\n\r\n・商品介紹\r\n-寬度：148 mm\r\n-高度：102 mm\r\n-內部容積：90 cm³\r\n\r\n・表面採水轉印技術印刷，圖案會隨著特定部位的磨耗造成色落情形，皆屬正常現象、無法認定為瑕疵，還請知悉。', 0, '2024-12-02 00:00:00', NULL, 1530, 0),
(7, 1, 1, 'C4 - PLASMA 低容積面鏡', 1450, 'C4', '超耐磨鋼化玻璃，良好的視野和低內部容積\r\n裙邊採柔軟矽膠製成，密合度佳\r\n搭配同色系呼吸管，帥度再上一層', 5, '2024-12-02 02:52:00', NULL, 870, 0),
(8, 1, 1, 'C4 - FALCON 低容積面鏡(黑)', 1750, 'C4', '由著名的潛水裝備設計師Enrico Sala構思設計，專用於自由潛水，搭配同色系呼吸管，帥度再上一層。\r\n \r\n・商品介紹\r\n-低容積提升潛水表現。\r\n-扣環連接裙邊，配戴更服貼。\r\n-墊圈和天鵝絨，提升密封性及舒適度。\r\n-流線造型降低深潛和快速上升中的拉力影響。\r\n-視野寬廣 - 對於漁獵幫助甚大。\r\n-寬度：137 mm\r\n-高度：100 mm\r\n-內部容積：95 cm³', 0, '2024-12-02 02:52:00', NULL, 1050, 0),
(9, 1, 1, 'IST - HUNTER低容積面鏡', 1200, 'IST', '超低內容積設計，頂級柔軟的矽膠面罩，配帶舒適又貼臉，視野更寬廣、更清晰\r\n漁獵、攝影或自由潛水者的最佳選擇\r\n體積小可摺疊置于救生衣口袋內作為備用\r\n邊扣調整容易\r\n\r\n・可替換以下光學鏡片\r\n- OL203(近視強化鏡片)：100 ~ 600度 (每50度一單位)', 0, '2024-12-02 02:53:00', NULL, 720, 0),
(10, 1, 1, 'IST - HUNTER低容積面鏡/ 防霧鏡片', 1700, 'IST', '超低內容積設計，頂級柔軟的矽膠面罩，配帶舒適又貼臉，視野更寬廣、更清晰\r\n漁獵、攝影或自由潛水者的最佳選擇\r\n體積小可摺疊置于救生衣口袋內作為備用\r\n邊扣調整容易\r\n\r\n・使用前請先將薄膜撕下，以清水沖洗過後即可使用。\r\n・請勿再以牙膏/火烤等方式處理鏡面。', 6, '2024-12-02 02:53:00', NULL, 1020, 0),
(11, 1, 1, 'IST - CORONA潛水面鏡', 950, 'IST', '電鍍外框，時尚美觀、提升耐用度\r\n旋轉式邊扣易操作，柔軟的矽膠裙邊，舒適貼合臉型。\r\n\r\n可替換以下光學鏡片\r\n- OL-55(近視強化鏡片)：100 ~ 800度\r\n- OL-55M(電鍍近視強化鏡片)：100 ~ 800度 \r\n- OL-55+(老花鏡片)：100 ~ 400度 \r\n※以上鏡片每50度一單位', 0, '2024-12-02 02:53:00', NULL, 570, 0),
(12, 1, 1, 'IST - PANORAMA 鋁合金潛水面鏡', 1800, 'IST', '6000系列鋁合金陽極電鍍處理鏡框，質輕視野廣，堅固耐用\r\n\r\n可替換以下光學鏡片\r\n- OL-55(近視強化鏡片)：100 ~ 800度\r\n- OL-55M(電鍍近視強化鏡片)：100 ~ 800度 \r\n- OL-55+(老花鏡片)：100 ~ 400度 \r\n※以上鏡片每50度一單位', 0, '2024-12-02 02:53:00', NULL, 1080, 0),
(13, 1, 1, 'IST M100 PANORAMA 鋁合金雙面鏡 炫彩 堅韌 質感 (BK)', 1800, 'IST', '缺貨中', 0, '2024-12-02 02:54:00', NULL, 1080, 0),
(14, 1, 1, 'LEADERFINS - L1單鏡片面鏡', 800, 'LEADERFINS', '無框面膜由柔軟的 100% 矽膠製成。\r\n鋼化玻璃鏡片\r\n極佳的舒適度和寬廣的視角\r\n快速調節帶扣。\r\n輕便、可折疊、易於存放。\r\n無邊框面鏡能夠在不影響寬視角的情況下減小內部體積，非常適合自由潛水和魚叉捕魚。', 0, '2024-12-02 02:54:00', NULL, 480, 0),
(15, 1, 1, 'LEADERFINS - L2低容積面鏡', 800, 'LEADERFINS', '無框面膜由柔軟的 100% 矽膠製成。\r\n鋼化玻璃鏡片\r\n極佳的舒適度和寬廣的視角\r\n輕便、可折疊、易於存放。', 0, '2024-12-02 02:55:00', NULL, 480, 0),
(16, 1, 1, 'LEADERFINS - 自由潛水面鏡呼吸管組 (黑)', 1250, 'LEADERFINS', '極低內容積，非常適合自由潛水使用，\r\n鏡片採廣角弧度設計，兼具視野及低容積的需求。\r\n較大面積的矽膠面鏡帶 , 為頭部帶來了穩定的感受並能夠分散後腦杓壓力。 \r\n隨附的呼吸管附有高低可調固定扣 , 可輕鬆將呼吸管及咬嘴調整至適合的位置。\r\n管身及咬嘴使用高度柔軟材質 , 能為潛水員帶來舒適感受並增加貼合性。\r\n鏡框及呼吸管身採霧面處理 , 不易殘留水痕並具有低調光澤感。', 8, '2024-12-02 02:55:00', NULL, 750, 0),
(17, 1, 1, 'LEADERFINS - 自由潛水面鏡呼吸管組 (白)', 1250, 'LEADERFINS', '極低內容積，非常適合自由潛水使用，\r\n鏡片採廣角弧度設計，兼具視野及低容積的需求。\r\n較大面積的矽膠面鏡帶 , 為頭部帶來了穩定的感受並能夠分散後腦杓壓力。 \r\n隨附的呼吸管附有高低可調固定扣 , 可輕鬆將呼吸管及咬嘴調整至適合的位置。\r\n管身及咬嘴使用高度柔軟材質 , 能為潛水員帶來舒適感受並增加貼合性。\r\n鏡框及呼吸管身採霧面處理 , 不易殘留水痕並具有低調光澤感。', 9, '2024-12-02 02:56:00', NULL, 750, 0),
(18, 1, 1, 'MARES - STAR LIQUIDSKIN 低容積面鏡', 2480, 'MARES', '寬視野x低容積，運動性能優異的自由潛水面鏡 \r\n複合矽膠裙邊，柔軟舒適/密合度佳/捏鼻平壓更順手', 0, '2024-12-02 02:56:00', NULL, 1488, 0),
(19, 1, 1, 'MOLCHANOVS - CORE Freediving Mask 抹茶自由潛水面鏡', 1500, 'MOLCHANOVS', 'CORE Freediving Mask由柔軟的矽膠製成，具絕佳的舒適性。塑膠框架包裹著曲面透明樹脂鏡片，提供廣闊視野。\r\n此款面鏡之間的距離為14公分。\r\n\r\n・商品介紹\r\n-材質：軟矽膠裙邊；耐用塑膠框架；透明樹脂鏡片\r\n-重量：270公克', 0, '2024-12-02 02:57:00', NULL, 900, 0),
(20, 7, 2, 'TRYGONS RX全碳纖維長蛙鞋', 9500, 'TRYGONS', '全碳纖維設計，重量較複合材料減輕14% \r\n獨家流體力學優勢，傳動效率再提升 \r\n調整帶式腳套，力量傳遞更直接\r\n・商品介紹\r\n-含腳套尺寸84 x 19.5cm', 1, '2024-12-02 02:59:00', NULL, 5700, 0),
(21, 7, 2, 'LEADERFINS 全碳纖維長蛙板：迷幻未來 FUTURIC', 10600, 'LEADERFINS', '極高CP值，加購腳套優雅升級碳纖維 \r\n平民版碳纖維，低總價高性能 \r\n尺寸完整，小腳女孩輕鬆著用\r\n・商品介紹\r\n-裸板尺寸80 x 20cm\r\n-腳套搭配建議: LEADERFINS - FORZA (螺絲組裝)\r\n-不同批生產之LEADERFINS蛙鞋板軟硬度可能略有差異，還請知悉', 1, '2024-12-02 02:59:00', NULL, 6360, 0),
(22, 7, 2, 'LEADERFINS 全碳纖維長蛙板：碳纖碧波', 6800, 'LEADERFINS', '極高CP值，加購腳套優雅升級碳纖維 \r\n平民版碳纖維，低總價高性能 \r\n尺寸完整，小腳女孩輕鬆著用\r\n・商品介紹\r\n-裸板尺寸80 x 20cm\r\n-腳套搭配建議: LEADERFINS - FORZA (螺絲組裝)\r\n-不同批生產之LEADERFINS蛙鞋板軟硬度可能略有差異，還請知悉', 0, '2024-12-02 03:00:00', NULL, 4080, 0),
(23, 7, 2, 'LEADERFINS 全碳纖維長蛙板：碳纖藍波', 6800, 'LEADERFINS', '極高CP值，加購腳套優雅升級碳纖維 \r\n平民版碳纖維，低總價高性能 \r\n尺寸完整，小腳女孩輕鬆著用\r\n・商品介紹\r\n-裸板尺寸80 x 20cm\r\n-腳套搭配建議: LEADERFINS - FORZA (螺絲組裝)\r\n-不同批生產之LEADERFINS蛙鞋板軟硬度可能略有差異，還請知悉', 0, '2024-12-02 03:00:00', NULL, 4080, 0),
(24, 7, 2, 'C4 ALLBLACK HT碳纖維長蛙鞋板', 14200, 'C4', '板面採TR50碳纖維結構，大方格彈性再升級 \r\nDPC雙拋物線技術，擺動幅度再延伸 \r\n加長板身，大深度移動自如 \r\n・商品介紹\r\n-裸版尺寸:87 x 19.5cm\r\n-腳套搭配建議:C4 - 300/C4 - 400(螺絲組裝)', 1, '2024-12-02 03:01:00', NULL, 8520, 0),
(25, 7, 2, 'C4 DEEP SPEARO HT 碳纖維長蛙板', 6800, 'C4', '板面採大型網格(Big Square)結構，降低水阻 \r\nDPC雙拋物線技術，擺動幅度再延伸 \r\n加大鞋板折角(達29度)，雙腳擺動更輕鬆\r\n・商品介紹\r\n-裸版尺寸90 x 20cm\r\n-商品未含腳套，腳套搭配建議:C4 - SCARPE(螺絲組裝)', 0, '2024-12-02 03:01:00', NULL, 4080, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `rent_order`
--

CREATE TABLE `rent_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `careatedAt` datetime DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 未刪除, 1: 已刪除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `rent_order`
--

INSERT INTO `rent_order` (`id`, `member_id`, `payment`, `careatedAt`, `isDeleted`) VALUES
(1, 1, 'credit', '2024-01-15 14:30:00', 0),
(2, 2, 'credit', '2024-01-16 15:00:00', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `rent_order_detail`
--

CREATE TABLE `rent_order_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `rent_order_id` int(10) DEFAULT NULL,
  `rentitem_id` int(10) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `actualReturnDate` datetime DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `careatedAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `rent_order_detail`
--

INSERT INTO `rent_order_detail` (`id`, `rent_order_id`, `rentitem_id`, `status`, `actualReturnDate`, `startDate`, `endDate`, `careatedAt`, `updatedAt`) VALUES
(1, 1, 1, '租借中', NULL, '2024-01-20 00:00:00', '2024-01-25 00:00:00', '2024-11-28 23:30:48', '2024-11-28 23:30:48'),
(2, 2, 2, '已歸還', '2024-01-18 00:00:00', '2024-01-16 00:00:00', '2024-01-18 00:00:00', '2024-11-28 23:30:48', '2024-11-28 23:30:48');

-- --------------------------------------------------------

--
-- 資料表結構 `size`
--

CREATE TABLE `size` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `size`
--

INSERT INTO `size` (`id`, `name`) VALUES
(1, 'xs'),
(2, 's');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `account` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `level_id` int(11) NOT NULL,
  `emergency_contact` int(11) DEFAULT NULL,
  `emergency_phone` int(11) DEFAULT NULL,
  `is_certify` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `manager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `account`, `password`, `birthday`, `address`, `created_at`, `updated_at`, `level_id`, `emergency_contact`, `emergency_phone`, `is_certify`, `is_deleted`, `manager`) VALUES
(1, '王小明', '0912322658', 'ming0908@test.com', 'ming0908', 'Ming0908', '2000-09-08', '桃園市中壢區新生路一段421號', '2024-11-22 11:24:32', '', 2, NULL, NULL, 0, 0, 0),
(2, '李佳穎', '0928374629', 'jiaying0905@test.com', 'jia0905', 'Jia0905', '1995-05-20', '台北市大安區和平東路二段35號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(3, '張志豪', '0987123456', 'zhihao0803@test.com', 'zhi0803', 'Zhi0803', '1987-03-12', '高雄市左營區自由二路102號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(4, '陳美玲', '0958674213', 'meiling0615@test.com', 'mei0615', 'Mei0615', '1979-06-15', '台中市西屯區福星路350巷45號', '2024-11-22 11:24:32', '', 1, NULL, NULL, 1, 0, 0),
(5, '劉建國', '0937215498', 'jianguo1122@test.com', 'guo1122', 'Guo1122', '1965-11-22', '新北市三重區重新路五段80號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(6, '黃婷婷', '0968357426', 'tingting0328@test.com', 'ting0328', 'Ting0328', '1999-03-28', '桃園市平鎮區民族路二段19巷12號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(7, '林俊傑', '0912546378', 'jj0505@test.com', 'jj0505', 'Jj0505', '1988-05-05', '台南市安平區健康路三段9號', '2024-11-22 11:24:32', '2024-11-29 09:22:12', 1, NULL, NULL, 1, 0, 0),
(8, '許文華', '0937654821', 'wenhua1010@test.com', 'wen1010', 'Wen1010', '1975-10-10', '新竹市東區光復路二段188號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(9, '郭曉峰', '0972345687', 'xiaofeng0920@test.com', 'feng0920', 'Feng0920', '1990-09-20', '嘉義市東區民生南路67巷10號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(10, '吳佳欣', '0953764820', 'jiaxin0722@test.com', 'xin0722', 'Xin0722', '1982-07-22', '花蓮縣花蓮市中山路5號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(11, '李志明', '0912789456', 'zhiming0408@test.com', 'ming0408', 'Ming0408', '1970-04-08', '台北市信義區松仁路90號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(12, '陳安妮', '0964387912', 'annie0223@test.com', 'annie0223', 'Annie0223', '2002-02-23', '台中市北屯區文心路五段320號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(13, '張冠宇', '0987546312', 'guanyu0808@test.com', 'guan0808', 'Guan0808', '1993-08-08', '台南市東區崇德路99號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(14, '黃嘉偉', '0976234859', 'jiawei1215@test.com', 'wei1215', 'Wei1215', '1985-12-15', '桃園市龜山區文化一路128號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(15, '林書豪', '0951234786', 'jeremy0507@test.com', 'lin0507', 'Lin0507', '1996-05-07', '高雄市三民區建國路7號', '2024-11-22 11:24:32', '2024-11-29 09:22:30', 2, NULL, NULL, 1, 0, 0),
(16, '王雅琪', '0912765439', 'yaqi0310@test.com', 'yaqi0310', 'Yaqi0310', '1998-03-10', '台北市內湖區康寧路三段45巷10號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(17, '陳浩宇', '0987213546', 'haoyu0728@test.com', 'hao0728', 'Hao0728', '1980-07-28', '新北市板橋區文化路二段68號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(18, '李美華', '0938465129', 'meihua1201@test.com', 'mei1201', 'Mei1201', '1975-12-01', '台中市南屯區黎明路一段333號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(19, '張信哲', '0976354820', 'xinzhe0415@test.com', 'xin0415', 'Xin0415', '1990-04-15', '台南市永康區中正北路25號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(20, '劉心怡', '0965743821', 'xinyi0303@test.com', 'xin0303', 'Xin0303', '2001-03-03', '桃園市大溪區慈湖路200號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(21, '許志文', '0954876239', 'zhiwen1020@test.com', 'wen1020', 'Wen1020', '1969-10-20', '新竹縣竹北市縣政二路50巷20號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(22, '郭文婷', '0987415263', 'wenting0709@test.com', 'wen0709', 'Wen0709', '1988-07-09', '嘉義縣民雄鄉文化路8號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(23, '吳佩君', '0928451736', 'peijun0520@test.com', 'pei0520', 'Pei0520', '1995-05-20', '宜蘭縣羅東鎮中山路100號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(24, '黃建華', '0913487562', 'jianhua1015@test.com', 'hua1015', 'Hua1015', '1972-10-15', '高雄市鳳山區三民路8號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(25, '林雨柔', '0937825461', 'yurou0801@test.com', 'yu0801', 'Yu0801', '2000-08-01', '台北市士林區天母東路60巷15號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(26, '王浩翔', '0951324786', 'haoxiang0612@test.com', 'xiang0612', 'Xiang0612', '1985-06-12', '新北市汐止區大同路一段200號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(27, '陳嘉豪', '0978435621', 'jiahao0208@test.com', 'hao0208', 'Hao0208', '1992-02-08', '台中市西區台灣大道二段70巷30號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(28, '張子涵', '0912463578', 'zihang0915@test.com', 'han0915', 'Han0915', '1997-09-15', '高雄市鼓山區博愛一路18號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(29, '李沛瑜', '0938745629', 'peiyu0525@test.com', 'yu0525', 'Yu0525', '1980-05-25', '桃園市八德區福國路66號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(30, '劉冠廷', '0987214653', 'guanting0812@test.com', 'guan0812', 'Guan0812', '1991-08-12', '新竹市香山區南大路128巷6號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(31, '許佳玲', '0973645821', 'jialing0105@test.com', 'ling0105', 'Ling0105', '1983-01-05', '台南市安南區海佃路三段9號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(32, '劉雲', '0954762381', 'shuwei0620@test.com', 'wei0620', 'Wei0620', '1978-06-20', '花蓮縣吉安鄉建國路7巷2號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(33, '黃志偉', '0917835462', 'zhiwei0910@test.com', 'wei0910', 'Wei0910', '1976-09-10', '嘉義市西區文化路88號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(34, '林怡君', '0934825761', 'yijun0325@test.com', 'yi0325', 'Yi0325', '2003-03-25', '台北市松山區南京東路五段77號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(35, '吳柏宇', '0975623148', 'baiyu0417@test.com', 'bai0417', 'Bai0417', '1994-04-17', '台南市中西區海安路一段50號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(36, '陳俊安', '0964823756', 'junan1212@test.com', 'an1212', 'An1212', '1989-12-12', '台中市東區建國路一段30號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(37, '李若涵', '0912786543', 'ruohan0515@test.com', 'ruo0515', 'Ruo0515', '2002-05-15', '桃園市蘆竹區南崁路10號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(38, '張柏翰', '0984327561', 'bohan0909@test.com', 'han0909', 'Han0909', '1971-09-09', '新北市土城區中央路四段90巷5號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 0, 0, 0),
(39, '劉慧敏', '0918456372', 'huimin0925@test.com', 'hui0925', 'Hui0925', '1992-09-25', '新北市樹林區樹德路77巷8號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(40, '王小明', '0912322658', 'ming0908@test.com', 'ming0908', 'Ming0908', '2000-09-08', '桃園市中壢區新生路一段421號', '2024-11-22 11:33:17', '', 0, NULL, NULL, 0, 0, 0),
(41, '黃子萱', '0928471635', 'zixuan0315@test.com', 'xuan0315', 'Xuan0315', '1987-03-15', '嘉義縣朴子市中正北路68號', '2024-11-22 11:33:17', '', 0, NULL, NULL, 1, 0, 0),
(42, '林建宏', '0912563749', 'jianhong1018@test.com', 'hong1018', 'Hong1018', '1980-10-18', '台中市北區健行路2巷22號', '2024-11-22 11:33:17', '', 0, NULL, NULL, 0, 0, 0),
(43, '陳昱安', '0972345867', 'yuan0512@test.com', 'yu0512', 'Yu0512', '1995-05-12', '台北市大同區民生西路40號', '2024-11-22 11:33:17', '', 0, NULL, NULL, 0, 0, 0),
(44, '吳雅雯', '0957834621', 'yawen0820@test.com', 'ya0820', 'Ya0820', '1982-08-20', '花蓮市國聯五路9號', '2024-11-22 11:33:17', '', 0, NULL, NULL, 1, 0, 0),
(45, '郭嘉文', '0987215643', 'jiawen0610@test.com', 'wen0610', 'Wen0610', '1973-06-10', '新竹縣湖口鄉中山路123號', '2024-11-22 11:33:17', '', 0, NULL, NULL, 0, 0, 0),
(46, '黃家豪', '0912836457', 'jiahao1212@test.com', 'jia1212', 'Jia1212', '2000-12-12', '新北市新莊區思源路88巷20號', '2024-11-22 11:33:17', '', 0, NULL, NULL, 0, 0, 0),
(47, '張佩珊', '0964827351', 'peishan0723@test.com', 'pei0723', 'Pei0723', '1986-07-23', '台南市中區忠義路一段15號', '2024-11-22 11:33:17', '', 0, NULL, NULL, 0, 0, 0),
(48, '王宇軒', '0951726483', 'yuxuan0415@test.com', 'yu0415', 'Yu0415', '1998-04-15', '桃園市觀音區仁愛路12號', '2024-11-22 11:33:17', '', 0, NULL, NULL, 0, 0, 0),
(49, '李志華', '0976345821', 'zhihua1010@test.com', 'hua1010', 'Hua1010', '1977-10-10', '高雄市橋頭區成功路25巷3號', '2024-11-22 11:33:17', '', 0, NULL, NULL, 1, 1, 0),
(50, '陳曉君', '0934827954', 'xiaojun0718@test.com', 'xiao0718', 'Xiao0718', '1984-07-18', '新竹縣竹東鎮竹榮路33號', '2024-11-22 11:34:46', '', 0, NULL, NULL, 0, 1, 0),
(51, 'Chu', '', 'chu@example.com', 'chuchu', '0278a02a9e6ac9adaa3ddbd426208958', '2001-02-06', NULL, '2024-11-29 13:29:29', '', 0, NULL, NULL, 0, 0, 1),
(52, '姚馨雯', '', 'news@test.com', 'news', '81dc9bdb52d04dc20036dbd8313ed055', '2000-11-01', NULL, '2024-11-29 15:05:02', '', 0, NULL, NULL, 0, 0, 0);

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
-- 資料表索引 `activity_orders`
--
ALTER TABLE `activity_orders`
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
-- 資料表索引 `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `article_image`
--
ALTER TABLE `article_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_image_ibfk_1` (`article_id`);

--
-- 資料表索引 `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- 資料表索引 `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `product_category_big`
--
ALTER TABLE `product_category_big`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `product_category_small`
--
ALTER TABLE `product_category_small`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `product_orders`
--
ALTER TABLE `product_orders`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `product_order_items`
--
ALTER TABLE `product_order_items`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `product_specification`
--
ALTER TABLE `product_specification`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `rental_orders`
--
ALTER TABLE `rental_orders`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `rental_order_items`
--
ALTER TABLE `rental_order_items`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `rent_image`
--
ALTER TABLE `rent_image`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `rent_item`
--
ALTER TABLE `rent_item`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_category_big`
--
ALTER TABLE `activity_category_big`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_category_small`
--
ALTER TABLE `activity_category_small`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_image`
--
ALTER TABLE `activity_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_orders`
--
ALTER TABLE `activity_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_teacher`
--
ALTER TABLE `activity_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_teacher_image`
--
ALTER TABLE `activity_teacher_image`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_teacher_specialty`
--
ALTER TABLE `activity_teacher_specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `article`
--
ALTER TABLE `article`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `article_image`
--
ALTER TABLE `article_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `color`
--
ALTER TABLE `color`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `material`
--
ALTER TABLE `material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_category_big`
--
ALTER TABLE `product_category_big`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_category_small`
--
ALTER TABLE `product_category_small`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=328;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_orders`
--
ALTER TABLE `product_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_order_items`
--
ALTER TABLE `product_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_specification`
--
ALTER TABLE `product_specification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `rental_orders`
--
ALTER TABLE `rental_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `rental_order_items`
--
ALTER TABLE `rental_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `rent_image`
--
ALTER TABLE `rent_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `rent_item`
--
ALTER TABLE `rent_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `size`
--
ALTER TABLE `size`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `article_image`
--
ALTER TABLE `article_image`
  ADD CONSTRAINT `article_image_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-12-03 17:00:44
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
(1, '小琉球體驗潛水', 5, '2024-09-01', '2024-09-30', '2024-10-01', '2024-10-10', '13:30:00', '15:00:00', 2500, 6, '', '你是否怕水，卻又想一窺蔚藍的海底世界呢？ 你是否猶豫，到底要不要考一張潛水證照呢？ 體驗潛水，是你最好的選擇！ 專業教練耐心為你講解小學生都可以聽懂的課程， 用簡單又幽默的方式一對一帶你認識裝備、適應呼吸、水下手勢溝通，  即使不會游泳，也能嘗試潛入深海與海龜共游 10歲到70歲都可以嘗試的小琉球必玩水上活動。', NULL, 0),
(2, '小琉球岸潛活動', 1, '2024-10-01', '2024-10-31', '2024-11-02', '2024-11-02', '12:00:00', '15:00:00', 1000, 7, '', '', NULL, 0),
(3, '水肺潛水體驗課程(泳池)', 1, '2024-12-01', '2024-12-31', '2025-01-01', '2025-01-01', '12:00:00', '17:30:00', 1500, 12, '', '', NULL, 0),
(4, '美人魚 體驗潛水', 3, '2024-11-01', '2024-11-24', '2024-12-01', '2024-12-02', '15:00:00', '17:00:00', 1500, 8, '', '', NULL, 0),
(5, 'Level 1自由潛水認證課程', 2, '2024-10-01', '2024-11-30', '2024-12-10', '2024-12-15', '13:00:00', '15:00:00', 12800, 7, '', '多種潛水系統DIWA, PADI, SSI, AIDA…任您挑選\r\n扎實訓練課程讓您安心考取國際證照\r\n專業教練小班制教學且彈性上課時間\r\n趕緊報名一起解鎖水下新技能吧！', NULL, 0),
(13, '小琉球船潛方案', 5, '2024-12-01', '2024-12-31', '2025-01-09', '2025-01-09', '13:00:00', '17:00:00', 2800, 7, '', '\r\n【一趟兩潛】：＄2800/人\r\n費用包含： 一位船上前導、一位潛雪後導、兩支氣瓶、水面休息餐、保險、水下攝影/錄影\r\n＊單人報名船潛需補500元\r\n＊船潛前需要安排一支岸潛測潛\r\n＊小琉球船潛第一潛都會去大深度，第二潛才去較淺的地方，所以沒辦法在船潛時測潛', NULL, 0),
(14, ' PADI 進階開放水域潛水員課程', 8, '2024-11-01', '2024-12-20', '2024-12-21', '2024-12-27', '10:00:00', '12:00:00', 11500, 8, '', 'PADI 進階開放水域潛水員課程\r\nAdvanced Open water Course\r\n想出國/離島旅遊，卻擔心無法參加深潛夜潛，錯過美麗的潛點？那麼應該在台灣完成進階潛水的訓練，而不是到國外才摸索適應喔。\r\n\r\n進階潛水課程會更加扎實的訓練水底導航能力、如何用電腦錶瞭解潛水計劃，以及深潛、夜潛、船潛等多項潛水專長。用最有效率的方式訓練潛水技巧，省去自己摸索的時間，加深對潛水活動的認知。\r\n\r\n課程特色\r\n進階船潛班，出國船潛更熟練 !（3支岸潛+2支船潛）\r\n\r\n可再加購船潛一次 1000元 (原價', NULL, 0),
(15, '海洋陪玩', 5, '2024-12-01', '2024-12-31', '2025-01-03', '2025-01-03', '10:00:00', '12:00:00', 1600, 10, '', '「海洋陪玩」 設計給給3歲到6歲的小孩。\r\n讓小孩子在最安全的環境下接觸大海，家長也可以無後顧之憂在旁陪伴。\r\n費用含小朋友浮潛裝備、活動保險、教練陪玩\r\n活動時間\r\n總時間約2小時 （水下時間約40-50分鐘）\r\n\r\n活動特色\r\n注意事項\r\n教練與小朋友比例最多 1:2\r\n\r\n含FISH ID講解，更加認識水中生物!\r\n\r\n淺水慢慢玩， 依據小朋友狀況調整水域\r\n\r\n提供小孩專用救生衣，套鞋，蛙鏡，防曬衣\r\n\r\n可加購水下拍攝服務，留下美美的紀念照 ​', NULL, 0),
(16, 'PADI 浮潛', 5, '2024-10-01', '2024-10-31', '2024-11-13', '2024-11-13', '12:00:00', '14:00:00', 700, 11, '', '害怕深水挑戰嗎?\r\n\r\n​你可以先嘗試水面浮潛的活動，看看美麗的海底世界!\r\n\r\n活動特色\r\n教練與學生比例最多 1:6，安全有保障\r\n含FISH ID講解，更加認識水中生物!\r\n淺水慢慢玩， 依據狀況調整水域\r\n可加購水下拍攝服務，留下美美的紀念照 ​\r\n\r\n費用含浮潛裝備、活動保險、教練導潛\r\n\r\n活動時間\r\n總時間約2小時 （水下時間約40-50分鐘）\r\n\r\n注意事項\r\n​浮潛年齡需滿6歲以上， 3-6歲請參考 海洋陪玩\r\n\r\n記得帶泳衣或泳褲、毛巾\r\n\r\n我們期許時時都有好天氣，但若海況或氣候不適', NULL, 0),
(17, '泡泡小勇士', 5, '2024-12-01', '2024-12-31', '2025-01-17', '2025-01-17', '14:00:00', '16:00:00', 3500, 12, '', '在水中向兒童介紹潛水，幫孩子舉辦一場難忘又精彩的泡泡小勇士派對，邀請親朋好友來慶祝，好玩、簡單又安全。\r\n\r\n課程特色\r\n​適合8-10歲的小朋友體驗親海的樂趣\r\n\r\n孩子可以和家人一同享受水肺潛水的樂趣。\r\n\r\n兒童潛水的最大深度僅限於 2 公尺 / 6 英呎。\r\n\r\n課程為時大約2.5小時（包括報到，著裝，玩耍）\r\n\r\n也可以是開放水域的體驗課程（最大深度 2公尺 / 6 英呎）\r\n\r\n你會學到什麼？ 孩子有機會：\r\n在 PADI 教練的照顧和督導下，體驗水肺潛水。\r\n\r\n經歷生平第一次的水底呼吸。\r', NULL, 0),
(18, '海洋大使', 5, '2024-10-01', '2024-10-31', '2024-12-07', '2024-12-07', '10:00:00', '12:00:00', 3500, 7, '', '海洋大使設計給沒有證照，又想深度認識海洋生態知識的朋友，年滿6歲都能參加唷 !\r\n與大海近距離接觸，是否對海中的生物充滿好奇，很想知道牠們叫什麼名字、有什麼樣的習性、該如何與這片豐富多彩的海洋當朋友呢 ?\r\n這堂「海洋大使」課程，會有詳細的生態解說。\r\n包括墾丁海域常見的珊瑚與魚類介紹，讓你一下水就認出 : 「這是鸚哥魚、那是雀鯛魚，這是雀屏珊瑚、那是玫瑰珊瑚...」\r\n並探討珊瑚白化、過度捕撈、海洋垃圾等海洋困境，思考如何用行動守護海洋。\r\nBring Ocean Into Your Life.\r\n我們', NULL, 0),
(19, 'PADI 開放水域潛水員課程 岸潛班', 2, '2024-12-01', '2024-12-31', '2025-01-17', '2025-01-19', '08:00:00', '17:00:00', 13500, 9, '', '潛水入門中最受歡迎的證照，全球已有數百萬人取得PADI開放水域潛水員證照。\r\n完成開放水域潛水員訓練，代表俱備基本的潛水知識與技巧，可憑證照至世界各地租借裝備、氣瓶或聘請潛導，進行潛水觀光。\r\n訓練期間，最大潛水深度為18公尺，取得證照之後建議不要超過休閒潛水的極限40公尺，也建議經常練習累積潛水經驗，或參與進階課程增加技巧熟練度。\r\n\r\n課程特色\r\n小班制教學，慢慢學沒壓力。 教練:學生 1:3\r\n課程期間全程提供電腦錶使用！(Suunto ZOOP 電腦錶)\r\n使用浮力袋，潛水旅遊更上手(開放水域2)', NULL, 0),
(20, 'PADI 開放水域潛水員課程 船潛班', 1, '2024-10-01', '2024-10-31', '2024-11-01', '2024-11-04', '08:00:00', '18:00:00', 15500, 6, '', '潛水入門中最受歡迎的證照，全球已有數百萬人取得PADI開放水域潛水員證照。\r\n完成開放水域潛水員訓練，代表俱備基本的潛水知識與技巧，可憑證照至世界各地租借裝備、氣瓶或聘請潛導，進行潛水觀光。\r\n訓練期間，最大潛水深度為18公尺，取得證照之後建議不要超過休閒潛水的極限40公尺，也建議經常練習累積潛水經驗，或參與進階課程增加技巧熟練度。', NULL, 0),
(21, 'PADI 水肺潛水員課程', 1, '2024-11-20', '2024-12-20', '2025-01-18', '2025-01-18', '08:00:00', '17:00:00', 9900, 10, '', '這是一張有限制的潛水證照，適合不足時間完成開放水域潛水員課程的人。\r\n完成訓練後，可用證照至世界各地進行潛水旅遊。但必須在合格的潛水長或教練的督導下潛水。深度限制在12公尺內。可經由轉學程序，取得開放水域潛水員證照。\r\n報名須知\r\n年齡需滿10歲以上，健康狀況良好 ＊健康聲明書在此請點擊\r\n若你有任何身體狀況，請先通過醫師的批准後，再進行潛水課程。\r\n需自備泳衣、毛巾、個人照片（電子檔亦可）、個人需要物品。\r\n報名費用\r\n9,900元 （岸潛）\r\n費用含全套潛水裝備、證照申請費、氣瓶費、活動保險及訓練費。', NULL, 0),
(22, 'PADI 救援潛水員課程', 4, '2024-12-20', '2025-01-31', '2025-02-14', '2025-02-16', '08:00:00', '18:00:00', 15000, 6, '', '急救與水域救援的觀念，人人都應該俱備。除了能協助潛伴解除問題，自救更是救援潛水員十分重要的觀念。\r\n完整的救援潛水訓練及透過模擬情節練習，讓你在遇到危急狀況時，能冷靜應對並作出正確判斷。\r\n這門課程是建立在你已經學過的潛水技巧之上，以學會如何避免問題發生與問題發生後如何處理為基礎，做進一步的延伸。\r\n課程特色\r\n課程增加技術潛水中性浮力概念。\r\n加贈20項水肺技巧研討會，為潛水長課程做好準備。\r\n含中餐2餐，吃飽再潛，活力滿點。', NULL, 0),
(23, 'PADI 水肺複習課程', 1, '2024-12-01', '2024-12-31', '2025-01-04', '2025-01-04', '08:00:00', '16:00:00', 5000, 9, '', '上完初階課程對於潛水還是不太熟悉嗎？拿到證照後卻不敢潛入水中？ 或是已經超過六個月以上沒有潛水，對於潛水感到生疏甚至忘光了？ 沒關係！水肺複習課程重新喚醒你體內的潛水魂與潛水技巧， 你可以選擇用半天或一天的時間來加強技巧以及旅遊潛水，找回悠游在大海裡的感覺，或者做一次完整複習課程，把潛水記憶全部都找回來。', NULL, 0),
(24, 'PADI 自由潛水員課程', 2, '2024-12-19', '2025-01-15', '2025-01-24', '2025-01-26', '08:30:00', '17:30:00', 15500, 10, '', 'PADI自由潛水課程，是針對休閒自由潛水設計的。培養基本的靜態閉氣、動態平潛、攀繩下潛以及恆重下潛知識與技巧，包含基本入水姿勢、基本技巧、潛水安全和潛伴制度。\r\n自由潛水會涉及較深的閉氣潛水，讓初學者能運用裝備和生理、心理技巧，在安全範圍內潛水。', NULL, 0),
(25, '旅遊潛水（岸潛）', 7, '2024-12-01', '2025-01-31', '2025-02-01', '2025-02-01', '08:00:00', '20:00:00', 1600, 9, '', '', NULL, 0),
(26, '旅遊潛水（船潛）', 7, '2024-12-01', '2024-12-31', '2025-01-01', '2025-01-01', '08:00:00', '20:00:00', 2600, 6, '', '', NULL, 0),
(27, '旅遊潛水（夜潛）', 7, '2024-11-01', '2024-11-30', '2024-12-05', '2024-12-05', '17:00:00', '23:59:00', 1050, 12, '', '', NULL, 0),
(32, '修改課程名稱修改課程名稱修改課程名稱修改課程名稱修改課程名稱修改課程名稱', 1, '2024-11-01', '2025-01-31', '2025-02-01', '2025-02-01', '04:13:00', '15:13:00', 15000, 12, '', '123', NULL, 0);

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
(5, '無證照', NULL, 2),
(7, '需OW證照', NULL, 2),
(8, '進階課程', NULL, 1),
(16, '測試小分類10', NULL, 1);

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
(14, 13, '小琉球船潛方案（主圖）', '1733139860.jpg', 1),
(15, 14, ' PADI 進階開放水域潛水員課程（主圖）', '1733141918.avif', 1),
(16, 15, '海洋陪玩（主圖）', '1733142480.webp', 1),
(17, 16, 'PADI 浮潛（主圖）', '1733151358.webp', 1),
(18, 17, '泡泡小勇士（主圖）', '1733155171.avif', 1),
(19, 18, '海洋大使（主圖）', '1733155343.avif', 1),
(20, 19, 'PADI 開放水域潛水員課程 岸潛班（主圖）', '1733155699.avif', 1),
(21, 20, 'PADI 開放水域潛水員課程 船潛班（主圖）', '1733156287.avif', 1),
(22, 21, 'PADI 水肺潛水員課程（主圖）', '1733157883.jpg', 1),
(23, 22, 'PADI 救援潛水員課程（主圖）', '1733158177.avif', 1),
(24, 23, 'PADI 水肺複習課程（主圖）', '1733158298.jpg', 1),
(25, 24, 'PADI 自由潛水員課程（主圖）', '1733158416.avif', 1),
(26, 25, '旅遊潛水（岸潛）（主圖）', '1733158588.avif', 1),
(27, 26, '旅遊潛水（船潛）（主圖）', '1733158672.avif', 1),
(28, 27, '旅遊潛水（夜潛）（主圖）', '1733158747.avif', 1),
(33, 32, '課程名稱（主圖）', '1733210034.png', 1);

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
(1, 'processing', 2, '無特殊需求'),
(2, 'completed', 3, '需要素食餐點'),
(3, 'processing', 4, '有老年人參加');

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
(6, '瘦子教練', 'suo@test.com', 1, 3, 9, 0),
(7, '阿國教練', 'guo@test.com', 1, 2, 6, 0),
(8, 'BOBO教練', 'bobo@test.com', 2, 1, 3, 0),
(9, '宇廷教練', 'ting@test.com', 1, 1, 3, 0),
(10, '阿沁教練', 'tsing@test.com', 1, 1, 1, 0),
(11, 'Rick教練', 'rick@test.com', 1, 2, 5, 0),
(12, '何月教練', 'yue@test.com', 2, 1, 6, 0),
(20, '水箭龜', '4@test.com', 1, 5, 9, 0);

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
(2, '瘦子教練教練照片', 6, '1733120008'),
(3, '阿國教練教練照片', 7, '1733121685'),
(4, 'BOBO教練教練照片', 8, '1733121722'),
(5, '宇廷教練教練照片', 9, '1733121778'),
(6, '阿沁教練教練照片', 10, '1733121818'),
(7, 'Rick教練教練照片', 11, '1733122110'),
(8, '何月教練教練照片', 12, '1733122460'),
(16, '水箭龜教練照片', 20, '1733209818');

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
(12, '藍色任務-光影珊瑚', '透過珊瑚紀錄，用行動關心海洋生態健康。\r\n\r\n綠色和平 x 光影珊瑚 x 台灣潛水\r\n\r\n邀請你，一起加入 #珊瑚觀測 的行列。', '2024-12-02 04:56:59', NULL, 0, NULL, 0),
(13, '111', '111', '2024-12-03 11:13:03', '2024-12-03 11:13:23', 0, NULL, 1),
(14, 'QAQ', '123132', '2024-12-03 15:19:08', '2024-12-03 15:19:28', 0, NULL, 0);

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
(8, 8, '009', 'img/article/009.jpg', 1, 0),
(9, 13, '20241203111303_111.jpeg', 'img/article/20241203111303_111.jpeg', 1, 0),
(10, 14, '20241203151908_1.png', 'img/article/20241203151908_1.png', 1, 0),
(11, 14, '20241203151908_7.png', 'img/article/20241203151908_7.png', 0, 1),
(12, 14, NULL, 'img/article/20241203151928_25.png', 1, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `brand`
--

CREATE TABLE `brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `imgUrl` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `brand`
--

INSERT INTO `brand` (`id`, `name`, `description`, `imgUrl`) VALUES
(1, 'AGAWA', '', 'AGAWA.webp'),
(2, 'ALCHEMY', NULL, 'ALCHEMY.webp'),
(3, 'AMONG', '', 'AMONG.webp'),
(4, 'AP DIVING', '', 'AP DIVING.webp'),
(5, 'APNEA STORE', '', NULL),
(6, 'APNEAUTIC', '描述1', NULL),
(7, 'APOLLO', '描述1', 'APOLLO.webp'),
(8, 'AQUA LUNG', '描述1', 'AQUA LUNG.webp'),
(9, 'AROPEC', NULL, 'AROPEC.webp'),
(10, 'ATMOS', NULL, 'ATMOS.webp'),
(11, 'ATOMIC', NULL, 'ATOMIC.webp'),
(12, 'BARREL', '描述1', 'BARREL.webp'),
(13, 'BEUCHAT', '描述1', 'BEUCHAT.webp'),
(14, 'CARBONIO GFT', '描述1', 'CARBONIO GFT.webp'),
(15, 'CETMA', '描述1', 'CETMA.webp'),
(16, 'COCOLOA', '描述1', NULL),
(17, 'C4', '描述1', NULL),
(18, 'DAKINE', '描述1', NULL),
(19, 'DEEPBLU', '描述1', 'DEEPBLU.webp'),
(20, 'DiveR', '描述1', NULL),
(21, 'DIVE SYSTEM', '描述1', 'DIVE SYSTEM.webp'),
(22, 'DR.FILM', '描述1', NULL),
(23, 'EZDIVE', '描述1', 'EZDIVE.webp'),
(24, 'FREEN', '描述1', NULL),
(25, 'FREEDIVING PLANET', '描述1', 'FREEDIVING PLANET.webp'),
(26, 'GARMIN', '描述1', 'GARMIN.webp'),
(27, 'GOPRO', '描述1', 'GOPRO.webp'),
(28, 'GULL', '描述1', NULL),
(29, 'HOBBY LABELS', '描述1', 'HOBBY LABELS.webp'),
(30, 'IST', '描述1', NULL),
(31, 'LAZYFISH', '描述1', 'LAZYFISH.webp'),
(32, 'LEADERFINS', '描述1', 'LEADERFINS.webp'),
(33, 'LOONG DIVE', '描述1', NULL),
(34, 'LOBSTER', '描述1', 'LOBSTER.webp'),
(35, 'MARES', '描述1', 'MARES.webp'),
(36, 'MOBBY\'S', '描述1', NULL),
(37, 'MOLCHANOVS', '描述1', 'MOLCHANOVS.webp'),
(38, 'NU JUNE', '描述1', NULL),
(39, 'OK CHALLENGE', '描述1', NULL),
(40, 'OCEANIC', '描述1', NULL),
(41, 'OMER', '描述1', NULL),
(42, 'O\'NEILL', '描述1', 'O\'NEILL.webp'),
(43, 'PATHOS', '描述1', 'PATHOS.webp'),
(44, 'PENETRATOR', '描述1', 'PENETRATOR.webp'),
(45, 'PROBLUE', '描述1', NULL),
(46, 'REMAKE', '描述1', NULL),
(47, 'REYSON', '描述1', 'REYSON.webp'),
(48, 'SAEKODIVE', '描述1', NULL),
(49, 'SAS', '描述1', 'SAS.webp'),
(50, 'SCUBAPRO', '描述1', 'SCUBAPRO.webp'),
(51, 'SEA HAWK', '描述1', 'SEA HAWK.webp'),
(52, 'STREAM TRAIL', '描述1', 'STREAM TRAIL.webp'),
(53, 'SUBLUE', '描述1', 'SUBLUE.webp'),
(54, 'SEAC', '描述1', 'SEAC.webp'),
(55, 'SPECIALFINS', '描述1', NULL),
(56, 'SPORASUB', '描述1', 'SPORASUB.webp'),
(57, 'SUUNTO', '描述1', 'SUUNTO.webp'),
(58, 'SUIILA', '描述1', NULL),
(59, 'TRUDIVE', '描述1', NULL),
(60, 'TRYGONS', '描述1', 'TRYGONS.webp'),
(61, 'TUSA', '描述1', 'TUSA.webp'),
(62, 'WATERMAN', '描述1', 'WATERMAN.webp'),
(63, '123 UnderwaterLab', '描述1', NULL),
(64, '2 B FREE', '描述1', '2 B FREE.webp'),
(65, '其他', '描述1', NULL);

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
(5, '草綠'),
(6, '藍色'),
(7, '灰色'),
(8, '海軍藍'),
(9, '紫色'),
(10, '螢光黃'),
(11, '粉紅色'),
(12, '橙色'),
(13, '迷彩'),
(14, '透明'),
(15, '黑藍'),
(16, '黑紅'),
(17, '白金'),
(18, '玫瑰金'),
(19, '古銅'),
(20, '湖水綠'),
(21, '鐵灰'),
(22, '石墨黑'),
(23, '象牙白'),
(24, '奶油白'),
(25, '米白'),
(26, '珍珠白'),
(27, '銀灰'),
(28, '月光銀'),
(29, '香檳銀'),
(30, '玫瑰粉'),
(31, '蜜桃粉'),
(32, '櫻花粉'),
(33, '桃紅'),
(34, '酒紅'),
(35, '暗紅'),
(36, '橘紅'),
(37, '珊瑚橘'),
(38, '亮橙'),
(39, '檸檬黃'),
(40, '鵝黃'),
(41, '奶茶色'),
(42, '咖啡色'),
(43, '摩卡棕'),
(44, '巧克力色'),
(45, '卡其色'),
(46, '淺褐'),
(47, '深褐'),
(48, '橄欖綠'),
(49, '森林綠'),
(50, '薄荷綠'),
(51, '蒂芬妮藍'),
(52, '水藍'),
(53, '孔雀藍'),
(54, '靛藍'),
(55, '丹寧藍'),
(56, '藏青'),
(57, '午夜藍'),
(58, '薰衣草藍'),
(59, '葡萄紫'),
(60, '深紫'),
(61, '淺紫'),
(62, '玫瑰紫'),
(63, '金屬銀'),
(64, '香檳金'),
(65, '玫瑰金'),
(66, '古銅金'),
(67, '煙燻灰'),
(68, '岩石灰'),
(69, '礦石灰'),
(70, '冰川藍'),
(71, '極光藍'),
(72, '極光綠'),
(73, '極光紫'),
(74, '霓虹粉'),
(75, '霓虹橙'),
(76, '霓虹黃'),
(77, '迷彩綠'),
(78, '迷彩藍'),
(79, '迷彩灰'),
(80, '迷彩棕'),
(81, '迷彩黑'),
(82, '炫彩'),
(83, '雙色黑金'),
(84, '雙色黑銀'),
(85, '雙色藍白'),
(86, '雙色紅黑'),
(87, '雙色綠黑'),
(88, '漸層藍'),
(89, '漸層紫'),
(90, '漸層粉');

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
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `name`, `discountType`, `discountValue`, `minPurchase`, `maxDiscountValue`, `targetMembers`, `product_id`, `product_type`, `startDate`, `endDate`, `usageLimit`, `userLimit`, `usedCount`, `status`, `description`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'DIVENEW1', '首次購買折扣', 'percentage', 10.00, 500.00, 100.00, '新會員', '商品', 'equipment', '2024-01-01 00:00:00', '2024-12-31 23:59:59', 100, 1, 52, 'active', '首次購買潛水裝備享受10%折扣，最高折抵100元', '2024-11-28 19:30:54', '2024-12-02 17:46:18', NULL),
(2, 'RENT10', '裝備租賃滿減', 'fixed', 50.00, 300.00, 50.00, '全部會員', '租賃', 'rental', '2024-02-01 00:00:00', '2024-03-31 00:00:00', 50, 1, 50, 'expired', '裝備租賃消費滿300元立減50元', '2024-11-28 19:30:54', '2024-12-02 17:45:53', NULL),
(3, 'COURSE300', '課程報名折扣', 'fixed', 300.00, 1000.00, 100.00, '全部會員', '課程', 'course', '2024-03-15 00:00:00', '2024-04-15 23:59:59', 50, 1, 48, 'expired', '潛水課程報名消費滿1000元立減300元', '2024-11-28 19:30:54', '2024-12-02 18:15:11', NULL),
(4, 'SUMMERFUN', '夏日裝備促銷', 'percentage', 20.00, 500.00, 100.00, '全部會員', '商品', 'equipment', '2024-06-01 00:00:00', '2024-06-30 23:59:59', 200, 1, 200, 'expired', '夏日限定裝備促銷，全場8折優惠', '2024-11-28 19:30:54', '2024-12-02 18:15:17', NULL),
(5, 'FRIENDREF', '推薦好友折扣', 'percentage', 100.00, 1000.00, 100.00, '全部會員', '全部', '', '2024-12-13 00:00:00', '2025-01-01 00:00:00', 20, 1, 0, 'inactive', '推薦好友首次消費後獲得100元折扣券', '2024-11-28 19:30:54', '2024-12-02 14:24:41', NULL),
(6, 'EQUIPUPGRADE', '裝備升級優惠', 'fixed', 200.00, 1500.00, 150.00, '全部會員', '商品', 'equipment', '2024-05-01 00:00:00', '2024-05-31 23:59:59', 1000, 1, 1000, 'expired', '購買高階潛水裝備可享200元優惠', '2024-11-28 19:30:54', '2024-12-02 18:15:27', NULL),
(7, 'BUNDLE500', '指定課程折扣', 'fixed', 500.00, 3000.00, 300.00, '全部會員', '課程', 'equipment', '2024-04-01 00:00:00', '2024-04-30 23:59:59', 50, 1, 32, 'expired', '購買指定課程裝備立減500元', '2024-11-28 19:30:54', '2024-12-02 18:15:34', NULL),
(8, 'FALLSALE', '秋季促銷優惠', 'percentage', 25.00, 600.00, 200.00, '全部會員', '商品', 'equipment', '2024-09-01 00:00:00', '2024-09-30 23:59:59', 800, 1, 800, 'expired', '秋季促銷期間裝備最高享受25%折扣', '2024-11-28 19:30:54', '2024-12-02 18:11:52', NULL),
(9, 'VIPDISCOUNT', 'VIP專屬優惠', 'percentage', 15.00, 2000.00, 200.00, 'VIP會員', '商品', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59', 50, 1, 50, 'active', 'VIP會員全場商品享15%折扣', '2024-11-28 19:30:54', '2024-12-02 18:15:40', NULL),
(10, 'NEWYEAR50', '新年專屬折扣', 'fixed', 50.00, 200.00, 100.00, '全部會員', '商品', 'equipment,course', '2024-12-25 00:00:00', '2025-01-05 23:59:59', 100, 2, 0, 'inactive', '新年期間消費滿200元立減50元', '2024-11-28 19:30:54', '2024-12-02 18:15:44', NULL),
(11, 'TRYDIVE10', '試潛活動優惠', 'percentage', 10.00, 500.00, 100.00, '全部會員', '活動', 'activity', '2024-07-01 00:00:00', '2024-07-31 23:59:59', 3000, 1, 1392, 'expired', '參加試潛活動享受10%折扣', '2024-11-28 19:30:54', '2024-12-02 18:15:49', NULL),
(12, 'ACTIVITY20', '活動限定折扣', 'fixed', 200.00, 800.00, 100.00, '全部會員', '活動', 'activity', '2024-08-15 00:00:00', '2024-08-31 23:59:59', 50, 1, 50, 'expired', '參加指定活動消費滿800元減200元', '2024-11-28 19:30:54', '2024-12-02 18:15:54', NULL),
(13, 'CLEARANCE30', '清倉大促銷', 'percentage', 30.00, 1000.00, 100.00, '全部會員', '商品', 'equipment', '2024-11-01 00:00:00', '2024-11-10 23:59:59', 50, 2, 50, 'expired', '季末清倉，商品享7折優惠', '2024-11-28 19:30:54', '2024-12-02 18:15:59', NULL),
(14, 'GROUPBUY', '團購優惠', 'fixed', 300.00, 2000.00, 200.00, '全部會員', '揪團', 'equipment', '2024-06-01 00:00:00', '2024-06-15 23:59:59', 1000, 1, 799, 'expired', '參與團購活動可享300元折扣', '2024-11-28 19:30:54', '2024-12-02 18:16:05', NULL),
(15, 'BIRTHDAY200', '生日專屬優惠', 'fixed', 200.00, 1000.00, 100.00, '全部會員', '全部', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59', 40, 1, 23, 'active', '用戶生日當月享200元專屬優惠券', '2024-11-28 19:30:54', '2024-12-02 18:16:10', NULL),
(16, 'HOLIDAY15', '假日促銷折扣', 'percentage', 15.00, 300.00, 100.00, '全部會員', '全部', 'equipment', '2024-05-01 00:00:00', '2024-05-31 23:59:59', 600, 2, 451, 'expired', '假日期間消費滿300元享85折', '2024-11-28 19:30:54', '2024-12-02 18:16:21', NULL),
(17, 'EQUIPTRY', '裝備試用折扣', 'fixed', 150.00, 500.00, 100.00, '全部會員', '租賃', 'rental', '2024-03-01 00:00:00', '2024-03-15 23:59:59', 100, 1, 44, 'expired', '首次租賃試用裝備享150元折扣', '2024-11-28 19:30:54', '2024-12-02 18:16:27', NULL),
(18, 'FAMILYDIVE', '家庭套票優惠', 'fixed', 500.00, 2000.00, 200.00, '全部會員', '活動', 'course', '2024-07-01 00:00:00', '2024-07-31 23:59:59', 50, 1, 29, 'expired', '購買家庭潛水套票減免500元', '2024-11-28 19:30:54', '2024-12-02 18:16:32', NULL),
(19, 'WINTER10', '冬季促銷活動', 'percentage', 10.00, 3000.00, 100.00, '全部會員', '商品', 'equipment', '2024-12-01 00:00:00', '2024-12-31 00:00:00', 4000, 3, 3875, 'active', '冬季限定促銷，全場9折優惠', '2024-11-28 19:30:54', '2024-12-02 18:12:30', NULL),
(20, 'LOYALTY300', '忠實客戶回饋', 'fixed', 300.00, 1500.00, 150.00, 'VIP會員', '全部', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59', 400, 1, 207, 'active', '忠實客戶年度回饋，每筆滿1500元訂單立減300元', '2024-11-28 19:30:54', '2024-12-02 18:16:39', NULL),
(21, 'EARLYBIRD', '活動早鳥優惠', 'fixed', 200.00, 500.00, 100.00, '全部會員', '課程', 'activity', '2024-05-01 00:00:00', '2024-05-15 23:59:59', 50, 1, 50, 'expired', '活動早鳥報名立減200元', '2024-11-28 19:30:54', '2024-12-02 18:16:46', NULL),
(22, 'ECOFRIEND', '環保商品優惠', 'percentage', 15.00, 3000.00, 300.00, '全部會員', '商品', 'equipment', '2024-02-01 00:00:00', '2024-02-29 23:59:59', 100, 2, 100, 'expired', '選擇環保裝備商品享15%折扣', '2024-11-28 19:30:54', '2024-12-02 18:16:51', NULL),
(23, 'WEDDINGGIFT', '婚禮禮品優惠', 'fixed', 500.00, 3000.00, 300.00, '全部會員', '商品', 'equipment', '2024-08-01 00:00:00', '2024-08-15 23:59:59', 1000, 1, 495, 'expired', '裝備滿3000元立減500元', '2024-11-28 19:30:54', '2024-12-02 18:16:55', NULL),
(24, 'FREECOURSE', '免費課程優惠', 'fixed', 500.00, 500.00, 100.00, '全部會員', '商品', 'course', '2024-10-01 00:00:00', '2024-10-31 23:59:59', 50, 1, 50, 'expired', '選購裝備可獲得免費基礎潛水課程資格', '2024-11-28 19:30:54', '2024-12-02 18:17:01', NULL),
(25, 'FLASHSALE', '限時閃購優惠', 'percentage', 50.00, 1000.00, 500.00, '全部會員', '商品', 'equipment', '2024-11-01 00:00:00', '2024-11-03 23:59:59', 30, 1, 30, 'expired', '限時閃購活動，部分商品最高可享5折', '2024-11-28 19:30:54', '2024-12-02 17:54:26', NULL),
(26, 'WINTERSALE', '冬季商品折扣', 'percentage', 20.00, 500.00, 0.00, '全部會員', '商品', 'equipment', '2024-12-06 00:00:00', '2024-12-31 00:00:00', 100, 2, 0, 'inactive', '冬季裝備全場8折優惠', '2024-11-28 19:33:18', '2024-12-02 18:10:20', NULL),
(27, 'CROSSSELL50', '搭配購物優惠', 'fixed', 50.00, 300.00, 0.00, '全部會員', '商品', 'equipment', '2024-03-01 00:00:00', '2024-03-15 23:59:59', 50, 4, 50, 'expired', '搭配購物滿300元立減50元', '2024-11-28 19:33:18', '2024-12-02 17:54:40', NULL),
(28, 'HAPPYHOUR30', '快閃優惠', 'percentage', 30.00, 1000.00, 0.00, '全部會員', '全部', 'equipment', '2024-11-01 00:00:00', '2024-11-05 23:59:59', 60, 2, 60, 'expired', '快閃優惠，限時5天內享受30%折扣', '2024-11-28 19:33:18', '2024-12-02 17:55:03', NULL),
(29, 'HOLIDAYBONUS', '假日贈送優惠券', 'fixed', 200.00, 700.00, 0.00, '全部會員', '商品', NULL, '2024-05-01 00:00:00', '2024-05-31 23:59:59', 50, 1, 50, 'expired', '假日消費滿額送200元優惠券', '2024-11-28 19:33:18', '2024-12-02 18:12:53', NULL),
(30, 'STUDENTDISCOUNT', '學生專屬優惠', 'percentage', 15.00, 3000.00, 0.00, '學生會員', '課程', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59', 50, 1, 12, 'active', '學生族群享有15%折扣', '2024-11-28 19:33:18', '2024-12-02 18:12:59', NULL),
(31, 'FESTIVAL100', '節日專屬折扣', 'fixed', 100.00, 500.00, 0.00, '全部會員', '商品', 'equipment', '2024-02-01 00:00:00', '2024-02-29 23:59:59', 50, 1, 50, 'expired', '節日專屬，滿500元減100元', '2024-11-28 19:33:18', '2024-12-02 17:55:34', NULL),
(32, 'REPEATCUSTOMER', '回購客戶優惠', 'fixed', 150.00, 800.00, 0.00, '全部會員', '商品', NULL, '2024-01-01 00:00:00', '2024-12-31 23:59:59', 150, 1, 150, 'active', '回購客戶專屬150元優惠券', '2024-11-28 19:33:18', '2024-12-02 17:59:11', NULL),
(33, 'SUMMERDISCOUNT', '夏季促銷優惠', 'percentage', 25.00, 3000.00, 0.00, '全部會員', '商品', 'equipment', '2024-06-01 00:00:00', '2024-06-30 23:59:59', 200, 2, 200, 'expired', '夏季裝備全場折扣25%', '2024-11-28 19:33:18', '2024-12-02 18:13:06', NULL),
(34, 'NEWARRIVAL20', '新品上市折扣', 'percentage', 20.00, 3000.00, 0.00, '全部會員', '商品', 'equipment', '2024-04-01 00:00:00', '2024-04-30 23:59:59', 450, 3, 217, 'expired', '新品上市，享受20%折扣', '2024-11-28 19:33:18', '2024-12-02 18:13:12', NULL),
(35, 'VIPSALE', 'VIP專屬季節性折扣', 'percentage', 30.00, 2000.00, 0.00, 'VIP會員', '活動', NULL, '2024-11-01 00:00:00', '2024-11-30 23:59:59', 30, 2, 30, 'active', 'VIP會員享30%季節折扣', '2024-11-28 19:33:18', '2024-12-02 18:13:24', NULL),
(36, 'SNORKEL10', '浮潛裝備折扣', 'fixed', 100.00, 300.00, 0.00, '全部會員', '商品', 'equipment', '2024-07-01 00:00:00', '2024-07-31 23:59:59', 200, 1, 198, 'expired', '浮潛裝備滿300元減100元', '2024-11-28 19:33:18', '2024-12-02 17:58:57', NULL),
(37, 'SEASONALSALE', '季節特賣優惠', 'percentage', 15.00, 3000.00, 0.00, '全部會員', '商品', 'equipment', '2024-09-01 00:00:00', '2024-09-30 23:59:59', 50, 1, 50, 'expired', '季節特賣，全場裝備15%折扣', '2024-11-28 19:33:18', '2024-12-02 18:13:31', NULL),
(38, 'CLEANINGOUT', '清倉優惠', 'percentage', 50.00, 3000.00, 200.00, '全部會員', '商品', 'equipment', '2024-11-10 00:00:00', '2024-11-15 23:59:59', 500, 1, 500, 'expired', '清倉大促銷，部分商品50%折扣', '2024-11-28 19:33:18', '2024-12-02 18:13:40', NULL),
(39, 'PREMIUMACCESS', '高端客戶優惠', 'percentage', 40.00, 3000.00, 0.00, 'VIP會員', '全部', NULL, '2024-06-01 00:00:00', '2024-06-15 23:59:59', 20, 1, 20, 'expired', '高端客戶享40%專屬折扣', '2024-11-28 19:33:18', '2024-12-02 18:13:46', NULL),
(40, 'FLASH60', '限時搶購優惠', 'fixed', 60.00, 100.00, 0.00, '全部會員', '全部', 'equipment', '2024-08-01 00:00:00', '2024-08-01 23:59:59', 10, 2, 10, 'expired', '限時搶購商品，立減60元', '2024-11-28 19:33:18', '2024-12-02 17:58:24', NULL),
(41, 'TRYANDEARN', '裝備試用優惠', 'fixed', 150.00, 500.00, 0.00, '全部會員', '租賃', 'rental', '2024-02-01 00:00:00', '2024-02-15 23:59:59', 50, 1, 22, 'expired', '試用潛水裝備並賺取150元優惠券', '2024-11-28 19:33:18', '2024-12-02 17:57:53', NULL),
(42, 'GIFTWITHPURCHASE', '指定商品即送禮品卡', 'fixed', 200.00, 1000.00, 0.00, '全部會員', '全部', 'equipment', '2024-03-01 00:00:00', '2024-03-31 23:59:59', 50, 1, 50, 'expired', '買指定潛水裝備即送200元禮品卡', '2024-11-28 19:33:18', '2024-12-02 17:57:59', NULL),
(43, 'TEAMBUILDING', '團隊報名折扣', 'fixed', 300.00, 1000.00, 0.00, '全部會員', '課程', 'course', '2024-09-01 00:00:00', '2024-09-30 23:59:59', 50, 1, 50, 'expired', '團隊報名潛水課程滿1000元減300元', '2024-11-28 19:33:18', '2024-12-02 17:58:05', NULL),
(44, 'BOGO', '指定配件買一送一促銷', 'fixed', 500.00, 500.00, 0.00, '全部會員', '商品', 'equipment', '2024-12-01 00:00:00', '2024-12-31 00:00:00', 200, 1, 200, 'active', '買一送一活動，限時享受此優惠', '2024-11-28 19:33:18', '2024-12-02 18:06:17', NULL),
(45, 'PARTNERSHIP10', '學生優惠', 'fixed', 100.00, 2000.00, 0.00, '學生會員', '活動', NULL, '2024-04-01 00:00:00', '2024-04-30 23:59:59', 50, 1, 33, 'expired', '學生專屬100元優惠券', '2024-11-28 19:33:18', '2024-12-02 18:13:56', NULL),
(46, 'AUTUMNSALE', '秋季優惠折扣', 'percentage', 20.00, 1000.00, 0.00, '全部會員', '商品', 'equipment', '2024-10-01 00:00:00', '2024-10-31 23:59:59', 200, 1, 200, 'expired', '秋季促銷活動，裝備商品享20%折扣', '2024-11-28 19:33:18', '2024-12-02 18:14:07', NULL),
(47, 'FREESHIP', '免費運送優惠', 'fixed', 0.00, 500.00, 0.00, '全部會員', '商品', NULL, '2024-03-01 00:00:00', '2024-03-15 23:59:59', 500, 2, 500, 'expired', '滿500元免費運送', '2024-11-28 19:33:18', '2024-12-02 17:57:08', NULL),
(48, 'XMASGIFT', '聖誕節專屬優惠', 'percentage', 15.00, 0.00, 0.00, '全部會員', '全部', 'equipment', '2024-12-19 00:00:00', '2024-12-25 00:00:00', 200, 1, 0, 'inactive', '聖誕節專屬15%折扣優惠', '2024-11-28 19:33:18', '2024-12-02 18:10:54', NULL),
(49, 'NEWYEARBONUS', '新年優惠', 'percentage', 25.00, 0.00, 0.00, '全部會員', '全部', 'equipment', '2024-01-01 00:00:00', '2024-01-31 23:59:59', 600, 1, 459, 'expired', '新年促銷，滿額享25%折扣', '2024-11-28 19:33:18', '2024-12-02 17:56:23', NULL),
(50, 'BIRTHDAYGIFT', '生日禮品優惠', 'fixed', 500.00, 0.00, 0.00, '全部會員', '商品', 'equipment', '2024-06-01 00:00:00', '2024-06-30 23:59:59', 20, 1, 20, 'expired', '生日月內消費滿500元送500元禮品卡', '2024-11-28 19:33:18', '2024-12-02 17:56:06', NULL),
(51, 'JOMCUBAD', '全場9折', 'percentage', 10.00, 1000.00, 100.00, '全部會員', '全部', NULL, '2024-12-02 00:00:00', '2024-12-13 00:00:00', 1000, 1, 42, 'active', '消費滿1000享9折優惠', '2024-12-02 05:59:34', '2024-12-02 18:02:49', NULL),
(52, 'GWSG18HN', '全場9折', 'percentage', 10.00, 500.00, 100.00, 'VIP會員', '活動', NULL, '2024-12-02 00:00:00', '2024-12-14 00:00:00', 45, 1, 13, 'active', '消費滿500打9折', '2024-12-02 06:25:46', '2024-12-02 18:14:40', NULL),
(53, 'W9MVOIDG', '全場8折', 'percentage', 20.00, 500.00, 100.00, '全部會員', '全部', NULL, '2024-12-02 00:00:00', '2024-12-17 00:00:00', 50, 1, 22, 'active', '消費滿500打8折', '2024-12-02 06:28:45', '2024-12-02 18:01:07', NULL),
(55, 'RL07OAM0', '45435436', 'percentage', 54353.00, 0.00, 0.00, '全部會員', '全部', NULL, '2024-12-20 00:00:00', '2024-12-31 00:00:00', 414141, 0, 0, 'active', NULL, '2024-12-03 11:27:36', '2024-12-03 11:27:54', '2024-12-03 11:27:54'),
(56, 'S7ID5OHB', '妙蛙種子', 'percentage', 85.00, 1.00, 99.00, '全部會員', '全部', NULL, '2024-12-01 00:00:00', '2024-12-31 00:00:00', 1, 1, 0, 'active', '123', '2024-12-03 12:47:49', '2024-12-03 12:48:04', '2024-12-03 12:48:04'),
(57, '3YXNA8OT', '1', 'fixed', 4545.00, 1000.00, 100.00, '新會員', '租賃', NULL, '2024-12-06 00:00:00', '2024-12-28 00:00:00', 1000, 1, 0, 'inactive', '1230', '2024-12-03 15:17:19', '2024-12-03 15:17:56', '2024-12-03 15:17:56');

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
(1, 1, 1, NULL, NULL, 4430.00, 'processing', 'credit_card', '2024-12-03 06:29:29', '2024-12-03 06:29:29'),
(2, 2, NULL, 1, NULL, 2100.00, 'processing', 'transfer', '2024-12-03 06:29:29', '2024-12-03 06:29:29'),
(3, 3, NULL, NULL, 1, 5000.00, 'processing', 'credit_card', '2024-12-03 06:29:29', '2024-12-03 06:29:29'),
(4, 4, 2, 2, NULL, 6390.00, 'completed', 'credit_card', '2024-12-03 06:29:29', '2024-12-03 06:29:29'),
(5, 5, 3, NULL, 2, 5580.00, 'processing', 'paypal', '2024-12-03 06:29:29', '2024-12-03 06:29:29'),
(6, 6, NULL, 3, 3, 14700.00, 'processing', 'transfer', '2024-12-03 06:29:29', '2024-12-03 06:29:29'),
(7, 7, 1, 1, 1, 11530.00, 'processing', 'credit_card', '2024-12-03 06:29:29', '2024-12-03 06:29:29');

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
(1, 1, 1, 'activity', 2, 2500.00, 'processing'),
(2, 2, 2, 'activity', 3, 1000.00, 'completed'),
(3, 3, 3, 'activity', 4, 1500.00, 'processing'),
(4, 1, 1, 'product', 2, 1000.00, 'pending'),
(5, 2, 1, 'rental', 1, 500.00, 'pending');

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
(25, 1, 'Rose', 55, NULL, 1, '上架中', 22, '2024-12-02 07:30:20', '2024-12-03 07:02:38', '2024-12-03 07:02:38'),
(26, 42, 'WAHOO LONG防水長蛙袋 II 代', 3080, NULL, 1, '下架中', 30, '2024-12-02 07:42:56', '2024-12-03 07:02:38', '2024-12-03 07:02:38'),
(27, 42, '手提後背長蛙鞋袋(LOGO經典款)', 2400, NULL, 1, '待上架', 16, '2024-12-02 07:43:43', '2024-12-03 07:02:38', '2024-12-03 07:02:38'),
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
(82, 57, '大齒型鋸片 _ 21吋', 540, NULL, 0, '上架中', 11, '2024-12-02 08:47:39', '2024-12-02 08:47:39', NULL),
(83, 57, '牛皮保護套 _ 21吋', 2280, NULL, 0, '上架中', 17, '2024-12-02 08:54:53', '2024-12-02 08:54:53', NULL),
(84, 57, '打獵鋸骨專用鋸片 _ 21吋', 540, NULL, 0, '上架中', 17, '2024-12-02 08:55:52', '2024-12-02 08:55:52', NULL),
(85, 57, '全功能鋸片 _ 21吋', 380, NULL, 0, '上架中', 16, '2024-12-02 08:56:39', '2024-12-02 08:56:39', NULL),
(86, 57, '物理防曬臉基尼', 230, NULL, 0, '上架中', 11, '2024-12-02 08:58:43', '2024-12-02 08:58:43', NULL),
(87, 57, '乾木專用鋸片_ 21吋', 380, NULL, 0, '上架中', 13, '2024-12-02 09:00:20', '2024-12-02 09:00:20', NULL),
(88, 57, '黃柄折疊鋸 _ 21吋', 2500, NULL, 0, '上架中', 14, '2024-12-02 09:04:23', '2024-12-02 09:04:23', NULL),
(89, 57, '瘋馬皮保護套 _ 21吋', 2280, NULL, 0, '上架中', 17, '2024-12-02 09:05:03', '2024-12-02 09:05:03', NULL),
(90, 57, '綠色帆布保護套 _ 21吋', 1480, NULL, 0, '上架中', 11, '2024-12-02 09:06:44', '2024-12-02 09:06:44', NULL),
(91, 57, '綠柄折疊鋸 _ 21吋', 2500, NULL, 0, '上架中', 11, '2024-12-02 09:07:22', '2024-12-02 09:07:22', NULL),
(92, 56, 'Cliff Hanger 桌邊掛勾', 400, NULL, 0, '上架中', 17, '2024-12-02 09:08:16', '2024-12-02 09:08:16', NULL),
(93, 56, 'Cliff Hanger 桌邊掛勾 L', 420, NULL, 0, '上架中', 17, '2024-12-02 09:09:42', '2024-12-02 09:09:42', NULL),
(94, 56, 'Re Make小琉球海龜包', 380, NULL, 0, '上架中', 11, '2024-12-02 09:12:49', '2024-12-02 09:12:49', NULL),
(95, 56, 'SD 雙色零錢包III', 390, NULL, 0, '上架中', 11, '2024-12-02 09:13:30', '2024-12-02 09:13:30', NULL),
(96, 56, '全碳纖維摺疊刀_拆信刀', 1300, NULL, 0, '上架中', 11, '2024-12-02 09:14:11', '2024-12-02 09:14:11', NULL),
(97, 56, '紀念短POLO衫(零碼大尺寸)', 790, NULL, 0, '上架中', 3, '2024-12-02 09:15:33', '2024-12-02 09:15:33', NULL),
(98, 56, '紀念短T恤 (黑色_前胸小LOGO款)', 490, NULL, 0, '上架中', 11, '2024-12-02 09:16:09', '2024-12-02 09:16:09', NULL),
(99, 56, '紀念短T恤 白款', 480, NULL, 0, '上架中', 11, '2024-12-02 09:16:51', '2024-12-02 09:16:51', NULL),
(100, 56, '紀念短T恤 黑款', 480, NULL, 0, '上架中', 14, '2024-12-02 09:17:25', '2024-12-02 09:17:25', NULL),
(101, 58, 'LAZYFISH x moun moun – Lignes de Soi swimsuit高磅羅紋連身泳衣', 3680, NULL, 0, '上架中', 11, '2024-12-02 09:18:47', '2024-12-02 09:18:47', NULL),
(102, 58, '比基尼背心BRA TOP (GW-6367A)', 1400, NULL, 0, '上架中', 11, '2024-12-02 09:19:16', '2024-12-02 09:19:16', NULL),
(103, 58, '防曬背心BRA TANK_GW-6366A', 1700, NULL, 0, '上架中', 11, '2024-12-02 09:19:58', '2024-12-02 09:19:58', NULL),
(104, 58, '緊身熱褲 (GW-6368A)', 749, NULL, 0, '上架中', 11, '2024-12-02 09:20:44', '2024-12-02 09:20:44', NULL),
(105, 61, 'SWIMMASKER透明口罩 _防飛沫_全防護', 350, NULL, 0, '上架中', 11, '2024-12-02 09:21:41', '2024-12-02 09:21:41', NULL),
(106, 61, '速乾透氣口罩', 490, NULL, 0, '上架中', 7, '2024-12-02 09:22:21', '2024-12-02 09:22:21', NULL),
(107, 61, '標準防水盒 _ 600cc內容積', 690, NULL, 0, '上架中', 11, '2024-12-02 09:23:06', '2024-12-02 09:23:06', NULL),
(108, 60, 'Water Being _自由潛水攝影集', 1800, NULL, 0, '上架中', 11, '2024-12-02 09:23:49', '2024-12-02 09:23:49', NULL),
(109, 60, '自由潛水訓練秘笈(深潛、靜態與動態閉氣)', 1100, NULL, 0, '上架中', 9, '2024-12-02 09:24:28', '2024-12-02 09:24:28', NULL),
(110, 60, '自由潛水聖經(自潛完全指南)', 1100, NULL, 0, '上架中', 7, '2024-12-02 09:24:59', '2024-12-02 09:24:59', NULL),
(111, 63, 'W01.017.B 跨步入水(黑色款) 防水_戶外_車貼', 480, NULL, 0, '上架中', 20, '2024-12-02 09:25:56', '2024-12-02 09:25:56', NULL),
(112, 63, 'W13.001 撐板少年(銀色款) 防水_戶外_車貼', 480, NULL, 0, '上架中', 11, '2024-12-02 09:29:36', '2024-12-02 09:29:36', NULL),
(113, 63, 'W13.002 短腿少年(銀色款) 防水_戶外_車貼', 480, NULL, 0, '上架中', 11, '2024-12-02 09:31:20', '2024-12-02 09:31:20', NULL),
(114, 63, 'W13.003 立槳大叔(銀色款) 防水_戶外_車貼', 480, NULL, 0, '上架中', 11, '2024-12-02 09:32:13', '2024-12-02 09:32:13', NULL),
(115, 63, 'W13.004 立槳小丑女(銀色款) 防水_戶外_車貼', 480, NULL, 0, '上架中', 11, '2024-12-02 09:32:48', '2024-12-02 09:32:48', NULL),
(116, 63, 'W13.005 立槳大肚男(銀色款) 防水_戶外_車貼', 480, NULL, 0, '上架中', 17, '2024-12-02 09:33:25', '2024-12-02 09:33:25', NULL),
(117, 63, 'W13.006 立槳墨鏡哥(銀色款) 防水_戶外_車貼', 480, NULL, 0, '上架中', 17, '2024-12-02 09:33:56', '2024-12-02 09:33:56', NULL),
(118, 63, 'W19.001 獨木舟小鮮肉(銀色款) 防水_戶外_車貼', 480, NULL, 0, '上架中', 11, '2024-12-02 09:34:33', '2024-12-02 09:34:33', NULL),
(119, 63, 'W19.002 獨木舟大叔(銀色款) 防水_戶外_車貼', 480, NULL, 0, '上架中', 11, '2024-12-02 09:35:17', '2024-12-02 09:35:17', NULL),
(120, 63, 'W19.003 獨木舟選手(銀色款) 防水_戶外_車貼', 480, NULL, 0, '上架中', 11, '2024-12-02 09:35:43', '2024-12-02 09:35:43', NULL),
(121, 62, '魚尾造型項鍊  Yellow Grey Agate (石斑杏)', 480, NULL, 0, '上架中', 11, '2024-12-02 09:36:35', '2024-12-02 09:36:35', NULL),
(122, 62, '魚尾造型項鍊 Black Lip Shell (銀輝貝)', 480, NULL, 0, '上架中', 11, '2024-12-02 09:38:18', '2024-12-02 09:38:18', NULL),
(123, 62, '魚尾造型項鍊 Starry Night (石斑黑)', 480, NULL, 0, '上架中', 1, '2024-12-02 09:38:45', '2024-12-02 09:38:45', NULL),
(124, 62, '魚尾造型項鍊 Turbulent Wave (石斑灰)', 480, NULL, 0, '上架中', 3, '2024-12-02 09:39:10', '2024-12-02 09:39:10', NULL),
(125, 62, '魚尾造型項鍊 White Black Horn (髦牛角)', 480, NULL, 0, '上架中', 7, '2024-12-02 09:42:50', '2024-12-02 09:42:50', NULL),
(126, 62, '魚尾造型項鍊 White Bone (象牙白)', 480, NULL, 0, '上架中', 7, '2024-12-02 09:44:10', '2024-12-02 09:44:10', NULL),
(127, 62, '魚尾造型項鍊 White Horn (蜂蜜棕)', 480, NULL, 0, '上架中', 11, '2024-12-02 09:44:39', '2024-12-02 09:44:39', NULL),
(128, 62, '魚尾造型項鍊 White MOP (珍珠白)', 480, NULL, 0, '上架中', 1, '2024-12-02 09:45:13', '2024-12-02 09:45:13', NULL),
(129, 62, '魚尾造型項鍊 White Yello MOP (白金珍珠)', 480, NULL, 0, '上架中', 13, '2024-12-02 09:45:40', '2024-12-02 09:45:40', NULL),
(130, 62, '魚尾造型項鍊 Yellow MOP (黃金珍珠)', 480, NULL, 0, '上架中', 9, '2024-12-02 09:46:07', '2024-12-02 09:46:07', NULL),
(131, 36, 'HOOD VEST NZ 頭套背心 3.5mm/ OA-4300 (一代)', 3000, NULL, 0, '上架中', 25, '2024-12-02 09:49:28', '2024-12-02 09:49:28', NULL),
(132, 36, 'HOOD VEST NZ 頭套背心 3.5mm_ OA-4300 (二代)_ 女款', 3800, NULL, 0, '上架中', 11, '2024-12-02 09:50:03', '2024-12-02 09:50:03', NULL),
(133, 36, 'HOOD VEST NZ 頭套背心 3.5mm_ OA-4300 (二代)_ 男款', 3800, NULL, 0, '上架中', 4, '2024-12-02 09:50:37', '2024-12-02 09:50:37', NULL),
(134, 36, 'MIMETIC 3D長袖水母衣-岩石迷彩', 1800, NULL, 0, '上架中', 11, '2024-12-02 09:51:15', '2024-12-02 09:51:15', NULL),
(135, 36, 'UV GUARD防曬長袖水母衣 _(OA-3590)', 900, NULL, 0, '上架中', 30, '2024-12-02 09:51:48', '2024-12-02 09:51:48', NULL),
(136, 36, 'UV GUARD防曬長袖水母衣(OA-6310)', 880, NULL, 0, '上架中', 19, '2024-12-02 09:52:33', '2024-12-02 09:52:33', NULL),
(137, 36, 'UV RAGLAN連帽防曬外套 _OA-6150', 1300, NULL, 0, '上架中', 11, '2024-12-02 09:53:05', '2024-12-02 09:53:05', NULL),
(138, 36, '女用長袖半身防寒衣', 4680, NULL, 0, '上架中', 23, '2024-12-02 09:53:41', '2024-12-02 09:53:41', NULL),
(139, 36, '男用背心防寒衣', 4580, NULL, 0, '上架中', 35, '2024-12-02 09:55:17', '2024-12-02 09:55:17', NULL),
(140, 36, '兒童款防曬水母衣 SS-5K34C', 470, NULL, 0, '上架中', 21, '2024-12-02 09:55:53', '2024-12-02 09:55:53', NULL),
(141, 38, 'ATI FLEX防曬長褲-女款(AG-7440)', 2300, NULL, 0, '上架中', 11, '2024-12-02 09:56:31', '2024-12-02 09:56:31', NULL),
(142, 38, 'UP-S5 輕量快乾百慕達短褲/曬色漸層/NG品', 1200, NULL, 0, '上架中', 7, '2024-12-02 09:57:18', '2024-12-02 09:57:18', NULL),
(143, 37, 'UV GUARD LEGGING 緊身褲(OA-6340)', 750, NULL, 0, '上架中', 11, '2024-12-02 09:57:49', '2024-12-02 09:57:49', NULL),
(144, 38, 'UV GUARD緊身水母褲(OA-6140)', 990, NULL, 0, '上架中', 11, '2024-12-02 09:58:22', '2024-12-02 09:58:22', NULL),
(145, 38, '緊身熱褲 (GW-6368A)', 749, NULL, 0, '上架中', 13, '2024-12-02 09:58:53', '2024-12-02 09:58:53', NULL),
(146, 38, '緊身踩腳長褲 (GW-6369A)', 1100, NULL, 0, '上架中', 11, '2024-12-02 09:59:25', '2024-12-02 09:59:25', NULL),
(147, 37, 'ACT GLOVE手套 _雙指開口 (DA-1320)', 1900, NULL, 0, '上架中', 11, '2024-12-02 09:59:58', '2024-12-02 09:59:58', NULL),
(148, 37, 'AGGRO 水域活動手套-二色可選 (JA-1600)', 950, NULL, 0, '上架中', 6, '2024-12-02 10:00:37', '2024-12-02 10:00:37', NULL),
(149, 37, 'CAMU 3D 防寒耐磨手套 2mm', 1500, NULL, 0, '上架中', 11, '2024-12-02 10:01:25', '2024-12-02 10:01:25', NULL),
(150, 37, 'MAXIFLEX Endurance 2mm 止滑耐磨手套', 390, NULL, 0, '上架中', 3, '2024-12-02 10:02:03', '2024-12-02 10:02:03', NULL),
(151, 37, 'NEXKIN GLOVE 手套 2mm (DA-1050)', 880, NULL, 0, '上架中', 18, '2024-12-02 10:02:36', '2024-12-02 10:02:36', NULL),
(152, 37, 'SPIDER 3mm 防寒耐磨手套', 1630, NULL, 0, '上架中', 36, '2024-12-02 10:03:08', '2024-12-02 10:03:08', NULL),
(153, 37, 'ULTRAFLEX潛水手套 2mm 素黑款 _膠面防護', 1150, NULL, 0, '上架中', 11, '2024-12-02 10:03:43', '2024-12-02 10:03:43', NULL),
(154, 37, 'ZOOM UP GLOVE 手套 2.5mm_ DA-1160 (二代)', 1600, NULL, 0, '上架中', 16, '2024-12-02 10:04:23', '2024-12-02 10:04:23', NULL),
(155, 37, 'ZOOMUP GLOVE 手套 2.5mm (DA-1140)', 950, NULL, 0, '上架中', 15, '2024-12-02 10:04:53', '2024-12-02 10:04:53', NULL),
(156, 37, '超彈性防寒手套(1.5mm)', 990, NULL, 0, '上架中', 19, '2024-12-02 10:05:33', '2024-12-02 10:05:33', NULL),
(157, 33, '訂製款乾式防寒衣 CHEST ZIP DRY MAX', 87000, NULL, 0, '上架中', 1, '2024-12-02 10:06:21', '2024-12-02 10:06:21', NULL),
(158, 33, '訂製款乾式防寒衣 CHEST ZIP DRY MAX HYBRID', 99500, NULL, 0, '上架中', 1, '2024-12-02 10:07:36', '2024-12-02 10:07:36', NULL),
(159, 33, '訂製款乾式防寒衣 CROCO DRY FZ', 127000, NULL, 0, '上架中', 1, '2024-12-02 10:08:10', '2024-12-02 10:08:10', NULL),
(160, 33, '訂製款乾式防寒衣 N.S.T. CHEST ZIP DRY', 72000, NULL, 0, '上架中', 1, '2024-12-02 10:08:45', '2024-12-02 10:08:45', NULL),
(161, 33, '訂製款乾式防寒衣 SHIELDMAX DRY', 99500, NULL, 0, '上架中', 1, '2024-12-02 10:09:17', '2024-12-02 10:09:17', NULL),
(162, 33, '訂製款乾式防寒衣 SHIELDMAX HYBRID', 99500, NULL, 0, '上架中', 1, '2024-12-02 10:09:55', '2024-12-02 10:09:55', NULL),
(163, 33, '訂製款乾式防寒衣 SLASH DRY HYBRID', 99500, NULL, 0, '上架中', 1, '2024-12-02 10:10:28', '2024-12-02 10:10:28', NULL),
(164, 33, '乾式防寒衣 ARMOR SHELL PRIME', 106000, NULL, 0, '上架中', 1, '2024-12-02 10:11:02', '2024-12-02 10:11:02', NULL),
(165, 33, '乾式防寒衣 TECH SHELL AQUA', 80500, NULL, 0, '上架中', 1, '2024-12-02 10:11:32', '2024-12-02 10:11:32', NULL),
(166, 33, '乾式防寒衣 TECH SHELL PRIME', 96500, NULL, 0, '上架中', 1, '2024-12-02 10:12:04', '2024-12-02 10:12:04', NULL),
(167, 32, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 2900, NULL, 0, '上架中', 1, '2024-12-02 10:12:41', '2024-12-02 10:12:41', NULL),
(168, 32, '女款一件式長袖長褲防寒衣 DS-5B07W 3mm', 2270, NULL, 0, '上架中', 16, '2024-12-02 10:13:21', '2024-12-02 10:13:21', NULL),
(169, 32, '女款一件式短袖短褲防寒衣 DS-3B07W', 1550, NULL, 0, '上架中', 23, '2024-12-02 10:14:27', '2024-12-02 10:14:27', NULL),
(170, 32, '女款一件式短袖短褲防寒衣 DS-3B91W 3mm', 2085, NULL, 0, '上架中', 30, '2024-12-02 10:17:26', '2024-12-02 10:17:26', NULL),
(171, 32, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 3990, NULL, 0, '上架中', 23, '2024-12-02 10:18:38', '2024-12-02 10:18:38', NULL),
(172, 32, '男款一件式無袖短褲防寒衣 DS-1B107M 1.5mm', 1035, NULL, 0, '上架中', 12, '2024-12-02 10:21:38', '2024-12-02 10:21:38', NULL),
(173, 32, '兒童款一件式短袖短褲防寒衣 DS-3B44C', 900, NULL, 0, '上架中', 32, '2024-12-02 10:27:23', '2024-12-02 10:27:23', NULL),
(174, 32, '兒童款一件式短袖短褲防寒衣 DS-3B117C', 925, NULL, 0, '上架中', 23, '2024-12-02 10:28:03', '2024-12-02 10:28:03', NULL),
(175, 32, '訂製款防寒衣 DISCOVERY LIGHT', 24100, NULL, 0, '上架中', 23, '2024-12-02 10:28:41', '2024-12-02 10:28:41', NULL),
(176, 32, '訂製款防寒衣 SKIN FIT 65', 40500, NULL, 0, '上架中', 23, '2024-12-02 10:29:40', '2024-12-02 10:29:40', NULL),
(177, 35, 'AIR SHELTER船潛外套 黃x橘 (絕版配色)', 7000, NULL, 0, '上架中', 23, '2024-12-02 10:31:03', '2024-12-02 10:31:03', NULL),
(178, 35, 'AIR SHELTER船潛防寒外套 _粉紅x水藍(絕版品)', 7000, NULL, 0, '上架中', 23, '2024-12-02 10:31:52', '2024-12-02 10:31:52', NULL),
(179, 35, 'AIR SHELTER船潛防寒外套 _粉藍(絕版品)', 7000, NULL, 0, '上架中', 12, '2024-12-02 10:32:24', '2024-12-02 10:32:24', NULL),
(180, 35, 'AIR SHELTER船潛防寒外套 玫瑰粉 (絕版配色)', 7000, NULL, 0, '上架中', 13, '2024-12-02 10:33:02', '2024-12-02 10:33:02', NULL),
(181, 35, 'AIR SHELTER船潛防寒外套 紅灰', 8000, NULL, 0, '上架中', 12, '2024-12-02 10:33:47', '2024-12-02 10:33:47', NULL),
(182, 35, 'AIR SHELTER船潛防寒外套 海軍藍', 8000, NULL, 0, '上架中', 13, '2024-12-02 10:34:26', '2024-12-02 10:34:26', NULL),
(183, 35, 'AIR SHELTER船潛防寒外套 黑', 8000, NULL, 0, '上架中', 23, '2024-12-02 10:35:02', '2024-12-02 10:35:02', NULL),
(184, 35, 'AIR SHELTER船潛防寒外套 寶藍 (絕版配色)', 7000, NULL, 0, '上架中', 12, '2024-12-02 10:35:29', '2024-12-02 10:35:29', NULL),
(185, 35, 'Classic Logo Reflective Poncho #24 多用途毛巾衣', 2280, NULL, 0, '上架中', 12, '2024-12-02 10:36:10', '2024-12-02 10:36:10', NULL),
(186, 35, 'LAZYFISH® Classic Logo Poncho _ kid #24 兒童款毛巾衣', 1680, NULL, 0, '上架中', 3, '2024-12-02 10:36:39', '2024-12-02 10:36:39', NULL),
(187, 29, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 18100, NULL, 0, '上架中', 12, '2024-12-02 10:37:19', '2024-12-02 10:37:19', NULL),
(188, 29, 'Aurea 自潛防寒衣 (女款)', 10550, NULL, 0, '上架中', 13, '2024-12-02 10:37:50', '2024-12-02 10:37:50', NULL),
(189, 29, 'Aurea 自潛防寒衣2mm ( 男款)', 10550, NULL, 0, '上架中', 12, '2024-12-02 10:38:22', '2024-12-02 10:38:22', NULL),
(190, 29, 'DYNAMIC LONG JOHN_ 自潛防寒衣背心長褲 1.5mm 男女通用款', 6800, NULL, 0, '上架中', 12, '2024-12-02 10:38:55', '2024-12-02 10:38:55', NULL),
(191, 29, 'DYNAMI-TECH 皮面防寒衣2mm-男女通用款', 13800, NULL, 0, '上架中', 12, '2024-12-02 10:39:28', '2024-12-02 10:39:28', NULL),
(192, 29, 'SIDERAL 自潛防寒衣2mm ( 男款)', 10550, NULL, 0, '上架中', 13, '2024-12-02 10:40:01', '2024-12-02 10:40:01', NULL),
(193, 29, 'SIDERAL 自潛防寒衣2mm (女款)', 10550, NULL, 0, '上架中', 9, '2024-12-02 10:40:30', '2024-12-02 10:40:30', NULL),
(194, 29, 'TRIATHLON訂製款三鐵防寒衣', 19000, NULL, 0, '上架中', 12, '2024-12-02 10:41:02', '2024-12-02 10:41:02', NULL),
(195, 29, '女款防寒背心1.5mm _ opencell+鈦塗層', 2200, NULL, 0, '上架中', 12, '2024-12-02 10:41:40', '2024-12-02 10:41:40', NULL),
(196, 29, '防寒背心1.5mm _ opencell+鈦塗層', 2200, NULL, 0, '上架中', 23, '2024-12-02 10:42:24', '2024-12-02 10:42:24', NULL),
(197, 30, '【海之韻系列】鈦睿迷彩兩件式防寒衣3mm', 8700, NULL, 0, '上架中', 12, '2024-12-02 10:43:49', '2024-12-02 10:43:49', NULL),
(198, 30, 'ACT APNEA ADVANCED 訂製款 _3mm', 27500, NULL, 0, '上架中', 12, '2024-12-02 10:44:20', '2024-12-02 10:44:20', NULL),
(199, 30, 'ACT APNEA COMPETITION 訂製款防寒衣2mm', 29800, NULL, 0, '上架中', 23, '2024-12-02 10:44:49', '2024-12-02 10:44:49', NULL),
(200, 30, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 18100, NULL, 0, '上架中', 12, '2024-12-02 10:45:19', '2024-12-02 10:45:19', NULL),
(201, 30, 'ACTION 訂製款防寒衣1.5mm', 14700, NULL, 0, '上架中', 16, '2024-12-02 10:46:29', '2024-12-02 10:46:29', NULL),
(202, 30, 'ACTION 訂製款防寒衣3mm', 19000, NULL, 0, '上架中', 23, '2024-12-02 10:47:02', '2024-12-02 10:47:02', NULL),
(203, 30, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 2900, NULL, 0, '上架中', 14, '2024-12-02 10:47:34', '2024-12-02 10:47:34', NULL),
(204, 30, 'CARBON SKIN PRO 皮面防寒衣3mm-男女款', 18500, NULL, 0, '上架中', 23, '2024-12-02 10:48:27', '2024-12-02 10:48:27', NULL),
(205, 30, 'SIDERAL 自潛防寒衣3mm (女款)', 12350, NULL, 0, '上架中', 23, '2024-12-02 10:48:57', '2024-12-02 10:48:57', NULL),
(206, 30, 'SIDERAL 自潛防寒衣3mm (男款)', 12350, NULL, 0, '上架中', 12, '2024-12-02 10:49:33', '2024-12-02 10:49:33', NULL),
(207, 28, '【TRU-REAL系列】大翅鯨半身無袖露背款防寒衣', 4700, NULL, 0, '上架中', 23, '2024-12-02 10:53:30', '2024-12-02 10:53:30', NULL),
(208, 28, '【TRU-REAL系列】前拉鍊無袖款防寒衣', 4700, NULL, 0, '上架中', 42, '2024-12-02 10:54:13', '2024-12-02 10:54:13', NULL),
(209, 28, '【TRU-REAL系列】前拉鍊無袖露腰款防寒衣', 4700, NULL, 0, '上架中', 45, '2024-12-02 10:55:07', '2024-12-02 10:55:07', NULL),
(210, 28, 'ACTION 訂製款防寒衣-高衩款 1.5&3mm', 10300, NULL, 0, '上架中', 23, '2024-12-02 10:55:44', '2024-12-02 10:55:44', NULL),
(211, 28, 'Aurea 長袖半身防寒衣2mm', 5500, NULL, 0, '上架中', 12, '2024-12-02 10:56:16', '2024-12-02 10:56:16', NULL),
(212, 28, 'Aurea 無袖半身防寒衣2mm', 4350, NULL, 0, '上架中', 12, '2024-12-02 10:56:52', '2024-12-02 10:56:52', NULL),
(213, 28, '一件式長袖短褲防寒衣(高衩款) _ 2mm', 2480, NULL, 0, '上架中', 23, '2024-12-02 10:57:23', '2024-12-02 10:57:23', NULL),
(214, 28, '女用長袖半身防寒衣', 4680, NULL, 0, '上架中', 11, '2024-12-02 10:57:55', '2024-12-02 10:57:55', NULL),
(215, 28, '男用背心防寒衣', 4580, NULL, 0, '上架中', 12, '2024-12-02 10:58:47', '2024-12-02 10:58:47', NULL),
(216, 28, '兒童款防曬水母衣 SS-5K34C', 470, NULL, 0, '上架中', 11, '2024-12-02 10:59:21', '2024-12-02 10:59:21', NULL),
(217, 31, '【漁獵系列】帶帽兩件式防寒衣', 8500, NULL, 0, '上架中', 25, '2024-12-02 11:00:38', '2024-12-02 11:00:38', NULL),
(218, 31, 'BLUE DEEP自潛防寒衣(海之隱者)_2mm', 4990, NULL, 0, '上架中', 11, '2024-12-02 11:01:19', '2024-12-02 11:01:19', NULL),
(219, 31, 'BODY-FIT CAMO SUIT自潛防寒衣 1.5mm-深水迷彩', 3500, NULL, 0, '上架中', 11, '2024-12-02 11:02:11', '2024-12-02 11:02:11', NULL),
(220, 31, 'Carbon Rock 漁獵防寒衣3mm', 5800, NULL, 0, '上架中', 22, '2024-12-02 11:02:42', '2024-12-02 11:02:42', NULL),
(221, 31, 'MIMETIC 3D長袖水母衣-岩石迷彩', 1800, NULL, 0, '上架中', 23, '2024-12-02 11:03:15', '2024-12-02 11:03:15', NULL),
(222, 31, 'MIX 3D自潛防寒衣  海底偽裝迷彩 _3mm', 5000, NULL, 0, '上架中', 12, '2024-12-02 11:03:43', '2024-12-02 11:03:43', NULL),
(223, 31, 'MIX 3D自潛防寒衣  海底偽裝迷彩 _5mm', 5550, NULL, 0, '上架中', 17, '2024-12-02 11:04:19', '2024-12-02 11:04:19', NULL),
(224, 31, 'PYTHON 自潛防寒衣 3.5mm 岩石迷彩款', 4999, NULL, 0, '上架中', 11, '2024-12-02 11:04:53', '2024-12-02 11:04:53', NULL),
(225, 31, 'REEF CAMU自潛防寒衣(3D珊瑚迷彩)_3mm', 4990, NULL, 0, '上架中', 11, '2024-12-02 11:05:25', '2024-12-02 11:05:25', NULL),
(226, 31, 'YEMAYA BLUE DEEP LADY 二件式防寒衣_ 5mm (女款)', 6990, NULL, 0, '上架中', 20, '2024-12-02 11:05:56', '2024-12-02 11:05:56', NULL);

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
(8, '生活小物', '就是賣一些雜七雜八的東西'),
(17, '大分類', '測試');

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
(6, '面鏡帶/面鏡盒/扣具', NULL, 3, 0),
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
(24, '潛水電腦錶', '描述1', 4, 2),
(25, 'GOPRO', '描述1', 4, 3),
(26, '水中推進器', '描述1', 4, 4),
(27, '配件/其他', '描述3', 4, 5),
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
(31, 26, 'WAHOO LONG防水長蛙袋 II 代', 'product_26_1733125376_0.jpg', 1, 1),
(32, 26, 'WAHOO LONG防水長蛙袋 II 代', 'product_26_1733125376_1.jpg', 0, 1),
(33, 26, 'WAHOO LONG防水長蛙袋 II 代', 'product_26_1733125376_2.jpg', 0, 1),
(34, 26, 'WAHOO LONG防水長蛙袋 II 代', 'product_26_1733125376_3.jpg', 0, 1),
(35, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_0.jpg', 1, 1),
(36, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_1.jpg', 0, 1),
(37, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_2.jpg', 0, 1),
(38, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_3.jpg', 0, 1),
(39, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_4.jpg', 0, 1),
(40, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_5.jpg', 0, 1),
(41, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_6.jpg', 0, 1),
(42, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_7.jpg', 0, 1),
(43, 27, '手提後背長蛙鞋袋(LOGO經典款)', 'product_27_1733125423_8.jpg', 0, 1),
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
(327, 82, '大齒型鋸片 _ 21吋', 'product_82_1733129259_4.jpg', 0, 0),
(328, 83, '牛皮保護套 _ 21吋', 'product_83_1733129693_0.jpg', 1, 0),
(329, 83, '牛皮保護套 _ 21吋', 'product_83_1733129693_1.jpg', 0, 0),
(330, 84, '打獵鋸骨專用鋸片 _ 21吋', 'product_84_1733129752_0.jpg', 1, 0),
(331, 84, '打獵鋸骨專用鋸片 _ 21吋', 'product_84_1733129752_1.jpg', 0, 0),
(332, 84, '打獵鋸骨專用鋸片 _ 21吋', 'product_84_1733129752_2.jpg', 0, 0),
(333, 84, '打獵鋸骨專用鋸片 _ 21吋', 'product_84_1733129752_3.jpg', 0, 0),
(334, 84, '打獵鋸骨專用鋸片 _ 21吋', 'product_84_1733129752_4.jpg', 0, 0),
(335, 85, '全功能鋸片 _ 21吋', 'product_85_1733129799_0.jpg', 1, 0),
(336, 85, '全功能鋸片 _ 21吋', 'product_85_1733129799_1.jpg', 0, 0),
(337, 85, '全功能鋸片 _ 21吋', 'product_85_1733129799_2.jpg', 0, 0),
(338, 85, '全功能鋸片 _ 21吋', 'product_85_1733129799_3.jpg', 0, 0),
(339, 85, '全功能鋸片 _ 21吋', 'product_85_1733129799_4.jpg', 0, 0),
(340, 86, '物理防曬臉基尼', 'product_86_1733129923_0.jpg', 1, 0),
(341, 86, '物理防曬臉基尼', 'product_86_1733129923_1.jpg', 0, 0),
(342, 86, '物理防曬臉基尼', 'product_86_1733129923_2.jpg', 0, 0),
(343, 86, '物理防曬臉基尼', 'product_86_1733129923_3.jpg', 0, 0),
(344, 86, '物理防曬臉基尼', 'product_86_1733129923_4.jpg', 0, 0),
(345, 86, '物理防曬臉基尼', 'product_86_1733129923_5.jpg', 0, 0),
(346, 86, '物理防曬臉基尼', 'product_86_1733129923_6.jpg', 0, 0),
(347, 86, '物理防曬臉基尼', 'product_86_1733129923_7.jpg', 0, 0),
(348, 86, '物理防曬臉基尼', 'product_86_1733129923_8.jpg', 0, 0),
(349, 87, '乾木專用鋸片_ 21吋', 'product_87_1733130020_0.jpg', 1, 0),
(350, 87, '乾木專用鋸片_ 21吋', 'product_87_1733130020_1.jpg', 0, 0),
(351, 87, '乾木專用鋸片_ 21吋', 'product_87_1733130020_2.jpg', 0, 0),
(352, 88, '黃柄折疊鋸 _ 21吋', 'product_88_1733130263_0.jpg', 1, 0),
(353, 88, '黃柄折疊鋸 _ 21吋', 'product_88_1733130263_1.jpg', 0, 0),
(354, 88, '黃柄折疊鋸 _ 21吋', 'product_88_1733130263_2.jpg', 0, 0),
(355, 88, '黃柄折疊鋸 _ 21吋', 'product_88_1733130263_3.jpg', 0, 0),
(356, 88, '黃柄折疊鋸 _ 21吋', 'product_88_1733130263_4.jpg', 0, 0),
(357, 88, '黃柄折疊鋸 _ 21吋', 'product_88_1733130263_5.jpg', 0, 0),
(358, 88, '黃柄折疊鋸 _ 21吋', 'product_88_1733130263_6.jpg', 0, 0),
(359, 88, '黃柄折疊鋸 _ 21吋', 'product_88_1733130263_7.jpg', 0, 0),
(360, 88, '黃柄折疊鋸 _ 21吋', 'product_88_1733130263_8.jpg', 0, 0),
(361, 88, '黃柄折疊鋸 _ 21吋', 'product_88_1733130263_9.jpg', 0, 0),
(362, 88, '黃柄折疊鋸 _ 21吋', 'product_88_1733130263_10.jpg', 0, 0),
(363, 88, '黃柄折疊鋸 _ 21吋', 'product_88_1733130263_11.jpg', 0, 0),
(364, 88, '黃柄折疊鋸 _ 21吋', 'product_88_1733130263_12.jpg', 0, 0),
(365, 88, '黃柄折疊鋸 _ 21吋', 'product_88_1733130263_13.jpg', 0, 0),
(366, 89, '瘋馬皮保護套 _ 21吋', 'product_89_1733130303_0.jpg', 1, 0),
(367, 89, '瘋馬皮保護套 _ 21吋', 'product_89_1733130303_1.jpg', 0, 0),
(368, 89, '瘋馬皮保護套 _ 21吋', 'product_89_1733130303_2.jpg', 0, 0),
(369, 89, '瘋馬皮保護套 _ 21吋', 'product_89_1733130303_3.jpg', 0, 0),
(370, 89, '瘋馬皮保護套 _ 21吋', 'product_89_1733130303_4.jpg', 0, 0),
(371, 90, '綠色帆布保護套 _ 21吋', 'product_90_1733130404_0.jpg', 1, 0),
(372, 90, '綠色帆布保護套 _ 21吋', 'product_90_1733130404_1.jpg', 0, 0),
(373, 90, '綠色帆布保護套 _ 21吋', 'product_90_1733130404_2.jpg', 0, 0),
(374, 90, '綠色帆布保護套 _ 21吋', 'product_90_1733130404_3.jpg', 0, 0),
(375, 90, '綠色帆布保護套 _ 21吋', 'product_90_1733130404_4.jpg', 0, 0),
(376, 91, '綠柄折疊鋸 _ 21吋', 'product_91_1733130442_0.jpg', 1, 0),
(377, 91, '綠柄折疊鋸 _ 21吋', 'product_91_1733130442_1.jpg', 0, 0),
(378, 91, '綠柄折疊鋸 _ 21吋', 'product_91_1733130442_2.jpg', 0, 0),
(379, 91, '綠柄折疊鋸 _ 21吋', 'product_91_1733130442_3.jpg', 0, 0),
(380, 91, '綠柄折疊鋸 _ 21吋', 'product_91_1733130442_4.jpg', 0, 0),
(381, 91, '綠柄折疊鋸 _ 21吋', 'product_91_1733130442_5.jpg', 0, 0),
(382, 91, '綠柄折疊鋸 _ 21吋', 'product_91_1733130442_6.jpg', 0, 0),
(383, 91, '綠柄折疊鋸 _ 21吋', 'product_91_1733130442_7.jpg', 0, 0),
(384, 91, '綠柄折疊鋸 _ 21吋', 'product_91_1733130442_8.jpg', 0, 0),
(385, 91, '綠柄折疊鋸 _ 21吋', 'product_91_1733130442_9.jpg', 0, 0),
(386, 91, '綠柄折疊鋸 _ 21吋', 'product_91_1733130442_10.jpg', 0, 0),
(387, 91, '綠柄折疊鋸 _ 21吋', 'product_91_1733130442_11.jpg', 0, 0),
(388, 91, '綠柄折疊鋸 _ 21吋', 'product_91_1733130442_12.jpg', 0, 0),
(389, 91, '綠柄折疊鋸 _ 21吋', 'product_91_1733130442_13.jpg', 0, 0),
(390, 92, 'Cliff Hanger 桌邊掛勾', 'product_92_1733130496_0.jpg', 1, 0),
(391, 92, 'Cliff Hanger 桌邊掛勾', 'product_92_1733130496_1.jpg', 0, 0),
(392, 92, 'Cliff Hanger 桌邊掛勾', 'product_92_1733130496_2.jpg', 0, 0),
(393, 92, 'Cliff Hanger 桌邊掛勾', 'product_92_1733130496_3.jpg', 0, 0),
(394, 92, 'Cliff Hanger 桌邊掛勾', 'product_92_1733130496_4.jpg', 0, 0),
(395, 92, 'Cliff Hanger 桌邊掛勾', 'product_92_1733130496_5.jpg', 0, 0),
(396, 92, 'Cliff Hanger 桌邊掛勾', 'product_92_1733130496_6.jpg', 0, 0),
(397, 93, 'Cliff Hanger 桌邊掛勾 L', 'product_93_1733130582_0.jpg', 1, 0),
(398, 93, 'Cliff Hanger 桌邊掛勾 L', 'product_93_1733130582_1.jpg', 0, 0),
(399, 93, 'Cliff Hanger 桌邊掛勾 L', 'product_93_1733130582_2.jpg', 0, 0),
(400, 93, 'Cliff Hanger 桌邊掛勾 L', 'product_93_1733130582_3.jpg', 0, 0),
(401, 93, 'Cliff Hanger 桌邊掛勾 L', 'product_93_1733130582_4.jpg', 0, 0),
(402, 93, 'Cliff Hanger 桌邊掛勾 L', 'product_93_1733130582_5.jpg', 0, 0),
(403, 94, 'Re Make小琉球海龜包', 'product_94_1733130769_0.jpg', 1, 0),
(404, 94, 'Re Make小琉球海龜包', 'product_94_1733130769_1.jpg', 0, 0),
(405, 95, 'SD 雙色零錢包III', 'product_95_1733130810_0.jpg', 1, 0),
(406, 95, 'SD 雙色零錢包III', 'product_95_1733130810_1.jpg', 0, 0),
(407, 95, 'SD 雙色零錢包III', 'product_95_1733130810_2.jpg', 0, 0),
(408, 95, 'SD 雙色零錢包III', 'product_95_1733130810_3.jpg', 0, 0),
(409, 95, 'SD 雙色零錢包III', 'product_95_1733130810_4.jpg', 0, 0),
(410, 95, 'SD 雙色零錢包III', 'product_95_1733130810_5.jpg', 0, 0),
(411, 95, 'SD 雙色零錢包III', 'product_95_1733130810_6.jpg', 0, 0),
(412, 95, 'SD 雙色零錢包III', 'product_95_1733130810_7.jpg', 0, 0),
(413, 95, 'SD 雙色零錢包III', 'product_95_1733130810_8.jpg', 0, 0),
(414, 95, 'SD 雙色零錢包III', 'product_95_1733130810_9.jpg', 0, 0),
(415, 95, 'SD 雙色零錢包III', 'product_95_1733130810_10.jpg', 0, 0),
(416, 96, '全碳纖維摺疊刀_拆信刀', 'product_96_1733130851_0.jpg', 1, 0),
(417, 96, '全碳纖維摺疊刀_拆信刀', 'product_96_1733130851_1.jpg', 0, 0),
(418, 96, '全碳纖維摺疊刀_拆信刀', 'product_96_1733130851_2.jpg', 0, 0),
(419, 96, '全碳纖維摺疊刀_拆信刀', 'product_96_1733130851_3.jpg', 0, 0),
(420, 96, '全碳纖維摺疊刀_拆信刀', 'product_96_1733130851_4.jpg', 0, 0),
(421, 96, '全碳纖維摺疊刀_拆信刀', 'product_96_1733130851_5.jpg', 0, 0),
(422, 96, '全碳纖維摺疊刀_拆信刀', 'product_96_1733130851_6.jpg', 0, 0),
(423, 97, '紀念短POLO衫(零碼大尺寸)', 'product_97_1733130933_0.jpg', 1, 0),
(424, 97, '紀念短POLO衫(零碼大尺寸)', 'product_97_1733130933_1.jpg', 0, 0),
(425, 97, '紀念短POLO衫(零碼大尺寸)', 'product_97_1733130933_2.jpg', 0, 0),
(426, 97, '紀念短POLO衫(零碼大尺寸)', 'product_97_1733130933_3.jpg', 0, 0),
(427, 97, '紀念短POLO衫(零碼大尺寸)', 'product_97_1733130933_4.jpg', 0, 0),
(428, 97, '紀念短POLO衫(零碼大尺寸)', 'product_97_1733130933_5.jpg', 0, 0),
(429, 98, '紀念短T恤 (黑色_前胸小LOGO款)', 'product_98_1733130969_0.jpg', 1, 0),
(430, 98, '紀念短T恤 (黑色_前胸小LOGO款)', 'product_98_1733130969_1.jpg', 0, 0),
(431, 98, '紀念短T恤 (黑色_前胸小LOGO款)', 'product_98_1733130969_2.jpg', 0, 0),
(432, 99, '紀念短T恤 白款', 'product_99_1733131011_0.jpg', 1, 0),
(433, 99, '紀念短T恤 白款', 'product_99_1733131011_1.jpg', 0, 0),
(434, 99, '紀念短T恤 白款', 'product_99_1733131011_2.jpg', 0, 0),
(435, 99, '紀念短T恤 白款', 'product_99_1733131011_3.jpg', 0, 0),
(436, 100, '紀念短T恤 黑款', 'product_100_1733131045_0.jpg', 1, 0),
(437, 100, '紀念短T恤 黑款', 'product_100_1733131045_1.jpg', 0, 0),
(438, 100, '紀念短T恤 黑款', 'product_100_1733131045_2.jpg', 0, 0),
(439, 100, '紀念短T恤 黑款', 'product_100_1733131045_3.jpg', 0, 0),
(440, 100, '紀念短T恤 黑款', 'product_100_1733131045_4.jpg', 0, 0),
(441, 101, 'LAZYFISH x moun moun – Lignes de Soi swimsuit高磅羅紋連身泳衣', 'product_101_1733131127_0.jpg', 1, 0),
(442, 101, 'LAZYFISH x moun moun – Lignes de Soi swimsuit高磅羅紋連身泳衣', 'product_101_1733131127_1.jpg', 0, 0),
(443, 101, 'LAZYFISH x moun moun – Lignes de Soi swimsuit高磅羅紋連身泳衣', 'product_101_1733131127_2.jpg', 0, 0),
(444, 101, 'LAZYFISH x moun moun – Lignes de Soi swimsuit高磅羅紋連身泳衣', 'product_101_1733131127_3.jpg', 0, 0),
(445, 101, 'LAZYFISH x moun moun – Lignes de Soi swimsuit高磅羅紋連身泳衣', 'product_101_1733131127_4.jpg', 0, 0),
(446, 101, 'LAZYFISH x moun moun – Lignes de Soi swimsuit高磅羅紋連身泳衣', 'product_101_1733131127_5.jpg', 0, 0),
(447, 101, 'LAZYFISH x moun moun – Lignes de Soi swimsuit高磅羅紋連身泳衣', 'product_101_1733131127_6.jpg', 0, 0),
(448, 101, 'LAZYFISH x moun moun – Lignes de Soi swimsuit高磅羅紋連身泳衣', 'product_101_1733131127_7.jpg', 0, 0),
(449, 102, '比基尼背心BRA TOP (GW-6367A)', 'product_102_1733131156_0.jpg', 1, 0),
(450, 102, '比基尼背心BRA TOP (GW-6367A)', 'product_102_1733131156_1.jpg', 0, 0),
(451, 102, '比基尼背心BRA TOP (GW-6367A)', 'product_102_1733131156_2.jpg', 0, 0),
(452, 102, '比基尼背心BRA TOP (GW-6367A)', 'product_102_1733131156_3.jpg', 0, 0),
(453, 102, '比基尼背心BRA TOP (GW-6367A)', 'product_102_1733131156_4.jpg', 0, 0),
(454, 103, '防曬背心BRA TANK_GW-6366A', 'product_103_1733131198_0.jpg', 1, 0),
(455, 103, '防曬背心BRA TANK_GW-6366A', 'product_103_1733131198_1.jpg', 0, 0),
(456, 103, '防曬背心BRA TANK_GW-6366A', 'product_103_1733131198_2.jpg', 0, 0),
(457, 103, '防曬背心BRA TANK_GW-6366A', 'product_103_1733131198_3.jpg', 0, 0),
(458, 104, '緊身熱褲 (GW-6368A)', 'product_104_1733131244_0.jpg', 1, 0),
(459, 104, '緊身熱褲 (GW-6368A)', 'product_104_1733131244_1.jpg', 0, 0),
(460, 104, '緊身熱褲 (GW-6368A)', 'product_104_1733131244_2.jpg', 0, 0),
(461, 104, '緊身熱褲 (GW-6368A)', 'product_104_1733131244_3.jpg', 0, 0),
(462, 104, '緊身熱褲 (GW-6368A)', 'product_104_1733131244_4.jpg', 0, 0),
(463, 104, '緊身熱褲 (GW-6368A)', 'product_104_1733131244_5.jpg', 0, 0),
(464, 104, '緊身熱褲 (GW-6368A)', 'product_104_1733131244_6.jpg', 0, 0),
(465, 105, 'SWIMMASKER透明口罩 _防飛沫_全防護', 'product_105_1733131301_0.jpg', 1, 0),
(466, 105, 'SWIMMASKER透明口罩 _防飛沫_全防護', 'product_105_1733131301_1.jpg', 0, 0),
(467, 105, 'SWIMMASKER透明口罩 _防飛沫_全防護', 'product_105_1733131301_2.jpg', 0, 0),
(468, 105, 'SWIMMASKER透明口罩 _防飛沫_全防護', 'product_105_1733131301_3.jpg', 0, 0),
(469, 105, 'SWIMMASKER透明口罩 _防飛沫_全防護', 'product_105_1733131301_4.jpg', 0, 0),
(470, 105, 'SWIMMASKER透明口罩 _防飛沫_全防護', 'product_105_1733131301_5.jpg', 0, 0),
(471, 105, 'SWIMMASKER透明口罩 _防飛沫_全防護', 'product_105_1733131301_6.jpg', 0, 0),
(472, 105, 'SWIMMASKER透明口罩 _防飛沫_全防護', 'product_105_1733131301_7.jpg', 0, 0),
(473, 106, '速乾透氣口罩', 'product_106_1733131341_0.jpg', 1, 0),
(474, 106, '速乾透氣口罩', 'product_106_1733131341_1.jpg', 0, 0),
(475, 106, '速乾透氣口罩', 'product_106_1733131341_2.jpg', 0, 0),
(476, 106, '速乾透氣口罩', 'product_106_1733131341_3.jpg', 0, 0),
(477, 106, '速乾透氣口罩', 'product_106_1733131341_4.jpg', 0, 0),
(478, 106, '速乾透氣口罩', 'product_106_1733131341_5.jpg', 0, 0),
(479, 106, '速乾透氣口罩', 'product_106_1733131341_6.jpg', 0, 0),
(480, 106, '速乾透氣口罩', 'product_106_1733131341_7.jpg', 0, 0),
(481, 107, '標準防水盒 _ 600cc內容積', 'product_107_1733131386_0.jpg', 1, 0),
(482, 107, '標準防水盒 _ 600cc內容積', 'product_107_1733131386_1.jpg', 0, 0),
(483, 108, 'Water Being _自由潛水攝影集', 'product_108_1733131429_0.jpg', 1, 0),
(484, 108, 'Water Being _自由潛水攝影集', 'product_108_1733131429_1.jpg', 0, 0),
(485, 109, '自由潛水訓練秘笈(深潛、靜態與動態閉氣)', 'product_109_1733131468_0.jpg', 1, 0),
(486, 109, '自由潛水訓練秘笈(深潛、靜態與動態閉氣)', 'product_109_1733131468_1.jpg', 0, 0),
(487, 110, '自由潛水聖經(自潛完全指南)', 'product_110_1733131499_0.jpg', 1, 0),
(488, 110, '自由潛水聖經(自潛完全指南)', 'product_110_1733131499_1.jpg', 0, 0),
(489, 110, '自由潛水聖經(自潛完全指南)', 'product_110_1733131499_2.jpg', 0, 0),
(490, 110, '自由潛水聖經(自潛完全指南)', 'product_110_1733131499_3.jpg', 0, 0),
(491, 111, 'W01.017.B 跨步入水(黑色款) 防水_戶外_車貼', 'product_111_1733131556_0.jpg', 1, 0),
(492, 112, 'W13.001 撐板少年(銀色款) 防水_戶外_車貼', 'product_112_1733131776_0.jpg', 1, 0),
(493, 112, 'W13.001 撐板少年(銀色款) 防水_戶外_車貼', 'product_112_1733131776_1.jpg', 0, 0),
(494, 112, 'W13.001 撐板少年(銀色款) 防水_戶外_車貼', 'product_112_1733131776_2.jpg', 0, 0),
(495, 113, 'W13.002 短腿少年(銀色款) 防水_戶外_車貼', 'product_113_1733131880_0.jpg', 1, 0),
(496, 113, 'W13.002 短腿少年(銀色款) 防水_戶外_車貼', 'product_113_1733131880_1.jpg', 0, 0),
(497, 113, 'W13.002 短腿少年(銀色款) 防水_戶外_車貼', 'product_113_1733131880_2.jpg', 0, 0),
(498, 114, 'W13.003 立槳大叔(銀色款) 防水_戶外_車貼', 'product_114_1733131933_0.jpg', 1, 0),
(499, 114, 'W13.003 立槳大叔(銀色款) 防水_戶外_車貼', 'product_114_1733131933_1.jpg', 0, 0),
(500, 114, 'W13.003 立槳大叔(銀色款) 防水_戶外_車貼', 'product_114_1733131933_2.jpg', 0, 0),
(501, 115, 'W13.004 立槳小丑女(銀色款) 防水_戶外_車貼', 'product_115_1733131968_0.jpg', 1, 0),
(502, 115, 'W13.004 立槳小丑女(銀色款) 防水_戶外_車貼', 'product_115_1733131968_1.jpg', 0, 0),
(503, 115, 'W13.004 立槳小丑女(銀色款) 防水_戶外_車貼', 'product_115_1733131968_2.jpg', 0, 0),
(504, 116, 'W13.005 立槳大肚男(銀色款) 防水_戶外_車貼', 'product_116_1733132005_0.jpg', 1, 0),
(505, 116, 'W13.005 立槳大肚男(銀色款) 防水_戶外_車貼', 'product_116_1733132005_1.jpg', 0, 0),
(506, 116, 'W13.005 立槳大肚男(銀色款) 防水_戶外_車貼', 'product_116_1733132005_2.jpg', 0, 0),
(507, 117, 'W13.006 立槳墨鏡哥(銀色款) 防水_戶外_車貼', 'product_117_1733132036_0.jpg', 1, 0),
(508, 117, 'W13.006 立槳墨鏡哥(銀色款) 防水_戶外_車貼', 'product_117_1733132036_1.jpg', 0, 0),
(509, 117, 'W13.006 立槳墨鏡哥(銀色款) 防水_戶外_車貼', 'product_117_1733132036_2.jpg', 0, 0),
(510, 118, 'W19.001 獨木舟小鮮肉(銀色款) 防水_戶外_車貼', 'product_118_1733132073_0.jpg', 1, 0),
(511, 118, 'W19.001 獨木舟小鮮肉(銀色款) 防水_戶外_車貼', 'product_118_1733132073_1.jpg', 0, 0),
(512, 118, 'W19.001 獨木舟小鮮肉(銀色款) 防水_戶外_車貼', 'product_118_1733132073_2.jpg', 0, 0),
(513, 119, 'W19.002 獨木舟大叔(銀色款) 防水_戶外_車貼', 'product_119_1733132117_0.jpg', 1, 0),
(514, 119, 'W19.002 獨木舟大叔(銀色款) 防水_戶外_車貼', 'product_119_1733132117_1.jpg', 0, 0),
(515, 119, 'W19.002 獨木舟大叔(銀色款) 防水_戶外_車貼', 'product_119_1733132117_2.jpg', 0, 0),
(516, 120, 'W19.003 獨木舟選手(銀色款) 防水_戶外_車貼', 'product_120_1733132143_0.jpg', 1, 0),
(517, 120, 'W19.003 獨木舟選手(銀色款) 防水_戶外_車貼', 'product_120_1733132143_1.jpg', 0, 0),
(518, 120, 'W19.003 獨木舟選手(銀色款) 防水_戶外_車貼', 'product_120_1733132143_2.jpg', 0, 0),
(519, 121, '魚尾造型項鍊  Yellow Grey Agate (石斑杏)', 'product_121_1733132195_0.jpg', 1, 0),
(520, 121, '魚尾造型項鍊  Yellow Grey Agate (石斑杏)', 'product_121_1733132195_1.jpg', 0, 0),
(521, 121, '魚尾造型項鍊  Yellow Grey Agate (石斑杏)', 'product_121_1733132195_2.jpg', 0, 0),
(522, 121, '魚尾造型項鍊  Yellow Grey Agate (石斑杏)', 'product_121_1733132195_3.jpg', 0, 0),
(523, 121, '魚尾造型項鍊  Yellow Grey Agate (石斑杏)', 'product_121_1733132195_4.jpg', 0, 0),
(524, 122, '魚尾造型項鍊 Black Lip Shell (銀輝貝)', 'product_122_1733132298_0.jpg', 1, 0),
(525, 122, '魚尾造型項鍊 Black Lip Shell (銀輝貝)', 'product_122_1733132298_1.jpg', 0, 0),
(526, 122, '魚尾造型項鍊 Black Lip Shell (銀輝貝)', 'product_122_1733132298_2.jpg', 0, 0),
(527, 122, '魚尾造型項鍊 Black Lip Shell (銀輝貝)', 'product_122_1733132298_3.jpg', 0, 0),
(528, 122, '魚尾造型項鍊 Black Lip Shell (銀輝貝)', 'product_122_1733132298_4.jpg', 0, 0),
(529, 123, '魚尾造型項鍊 Starry Night (石斑黑)', 'product_123_1733132325_0.jpg', 1, 0),
(530, 123, '魚尾造型項鍊 Starry Night (石斑黑)', 'product_123_1733132325_1.jpg', 0, 0),
(531, 123, '魚尾造型項鍊 Starry Night (石斑黑)', 'product_123_1733132325_2.jpg', 0, 0),
(532, 123, '魚尾造型項鍊 Starry Night (石斑黑)', 'product_123_1733132325_3.jpg', 0, 0),
(533, 123, '魚尾造型項鍊 Starry Night (石斑黑)', 'product_123_1733132325_4.jpg', 0, 0),
(534, 124, '魚尾造型項鍊 Turbulent Wave (石斑灰)', 'product_124_1733132350_0.jpg', 1, 0),
(535, 124, '魚尾造型項鍊 Turbulent Wave (石斑灰)', 'product_124_1733132350_1.jpg', 0, 0),
(536, 124, '魚尾造型項鍊 Turbulent Wave (石斑灰)', 'product_124_1733132350_2.jpg', 0, 0),
(537, 124, '魚尾造型項鍊 Turbulent Wave (石斑灰)', 'product_124_1733132350_3.jpg', 0, 0),
(538, 124, '魚尾造型項鍊 Turbulent Wave (石斑灰)', 'product_124_1733132350_4.jpg', 0, 0),
(539, 125, '魚尾造型項鍊 White Black Horn (髦牛角)', 'product_125_1733132570_0.jpg', 1, 0),
(540, 125, '魚尾造型項鍊 White Black Horn (髦牛角)', 'product_125_1733132570_1.jpg', 0, 0),
(541, 125, '魚尾造型項鍊 White Black Horn (髦牛角)', 'product_125_1733132570_2.jpg', 0, 0),
(542, 125, '魚尾造型項鍊 White Black Horn (髦牛角)', 'product_125_1733132570_3.jpg', 0, 0),
(543, 125, '魚尾造型項鍊 White Black Horn (髦牛角)', 'product_125_1733132570_4.jpg', 0, 0),
(544, 126, '魚尾造型項鍊 White Bone (象牙白)', 'product_126_1733132650_0.jpg', 1, 0),
(545, 126, '魚尾造型項鍊 White Bone (象牙白)', 'product_126_1733132650_1.jpg', 0, 0),
(546, 126, '魚尾造型項鍊 White Bone (象牙白)', 'product_126_1733132650_2.jpg', 0, 0),
(547, 126, '魚尾造型項鍊 White Bone (象牙白)', 'product_126_1733132650_3.jpg', 0, 0),
(548, 126, '魚尾造型項鍊 White Bone (象牙白)', 'product_126_1733132650_4.jpg', 0, 0),
(549, 127, '魚尾造型項鍊 White Horn (蜂蜜棕)', 'product_127_1733132679_0.jpg', 1, 0),
(550, 127, '魚尾造型項鍊 White Horn (蜂蜜棕)', 'product_127_1733132679_1.jpg', 0, 0),
(551, 127, '魚尾造型項鍊 White Horn (蜂蜜棕)', 'product_127_1733132679_2.jpg', 0, 0),
(552, 127, '魚尾造型項鍊 White Horn (蜂蜜棕)', 'product_127_1733132679_3.jpg', 0, 0),
(553, 127, '魚尾造型項鍊 White Horn (蜂蜜棕)', 'product_127_1733132679_4.jpg', 0, 0),
(554, 128, '魚尾造型項鍊 White MOP (珍珠白)', 'product_128_1733132713_0.jpg', 1, 0),
(555, 128, '魚尾造型項鍊 White MOP (珍珠白)', 'product_128_1733132713_1.jpg', 0, 0),
(556, 128, '魚尾造型項鍊 White MOP (珍珠白)', 'product_128_1733132713_2.jpg', 0, 0),
(557, 128, '魚尾造型項鍊 White MOP (珍珠白)', 'product_128_1733132713_3.jpg', 0, 0),
(558, 128, '魚尾造型項鍊 White MOP (珍珠白)', 'product_128_1733132713_4.jpg', 0, 0),
(559, 129, '魚尾造型項鍊 White Yello MOP (白金珍珠)', 'product_129_1733132740_0.jpg', 1, 0),
(560, 129, '魚尾造型項鍊 White Yello MOP (白金珍珠)', 'product_129_1733132740_1.jpg', 0, 0),
(561, 129, '魚尾造型項鍊 White Yello MOP (白金珍珠)', 'product_129_1733132740_2.jpg', 0, 0),
(562, 129, '魚尾造型項鍊 White Yello MOP (白金珍珠)', 'product_129_1733132740_3.jpg', 0, 0),
(563, 129, '魚尾造型項鍊 White Yello MOP (白金珍珠)', 'product_129_1733132740_4.jpg', 0, 0),
(564, 130, '魚尾造型項鍊 Yellow MOP (黃金珍珠)', 'product_130_1733132767_0.jpg', 1, 0),
(565, 130, '魚尾造型項鍊 Yellow MOP (黃金珍珠)', 'product_130_1733132767_1.jpg', 0, 0),
(566, 130, '魚尾造型項鍊 Yellow MOP (黃金珍珠)', 'product_130_1733132767_2.jpg', 0, 0),
(567, 130, '魚尾造型項鍊 Yellow MOP (黃金珍珠)', 'product_130_1733132767_3.jpg', 0, 0),
(568, 130, '魚尾造型項鍊 Yellow MOP (黃金珍珠)', 'product_130_1733132767_4.jpg', 0, 0),
(569, 131, 'HOOD VEST NZ 頭套背心 3.5mm/ OA-4300 (一代)', 'product_131_1733132968_0.jpg', 1, 0),
(570, 131, 'HOOD VEST NZ 頭套背心 3.5mm/ OA-4300 (一代)', 'product_131_1733132968_1.jpg', 0, 0),
(571, 131, 'HOOD VEST NZ 頭套背心 3.5mm/ OA-4300 (一代)', 'product_131_1733132968_2.jpg', 0, 0),
(572, 131, 'HOOD VEST NZ 頭套背心 3.5mm/ OA-4300 (一代)', 'product_131_1733132968_3.jpg', 0, 0),
(573, 132, 'HOOD VEST NZ 頭套背心 3.5mm_ OA-4300 (二代)_ 女款', 'product_132_1733133003_0.jpg', 1, 0),
(574, 133, 'HOOD VEST NZ 頭套背心 3.5mm_ OA-4300 (二代)_ 男款', 'product_133_1733133037_0.jpg', 1, 0),
(575, 134, 'MIMETIC 3D長袖水母衣-岩石迷彩', 'product_134_1733133075_0.jpg', 1, 0),
(576, 134, 'MIMETIC 3D長袖水母衣-岩石迷彩', 'product_134_1733133075_1.jpg', 0, 0),
(577, 134, 'MIMETIC 3D長袖水母衣-岩石迷彩', 'product_134_1733133075_2.jpg', 0, 0),
(578, 134, 'MIMETIC 3D長袖水母衣-岩石迷彩', 'product_134_1733133075_3.jpg', 0, 0),
(579, 134, 'MIMETIC 3D長袖水母衣-岩石迷彩', 'product_134_1733133075_4.jpg', 0, 0),
(580, 135, 'UV GUARD防曬長袖水母衣 _(OA-3590)', 'product_135_1733133108_0.jpg', 1, 0),
(581, 135, 'UV GUARD防曬長袖水母衣 _(OA-3590)', 'product_135_1733133108_1.jpg', 0, 0),
(582, 135, 'UV GUARD防曬長袖水母衣 _(OA-3590)', 'product_135_1733133108_2.jpg', 0, 0),
(583, 136, 'UV GUARD防曬長袖水母衣(OA-6310)', 'product_136_1733133153_0.jpg', 1, 0),
(584, 136, 'UV GUARD防曬長袖水母衣(OA-6310)', 'product_136_1733133153_1.jpg', 0, 0),
(585, 136, 'UV GUARD防曬長袖水母衣(OA-6310)', 'product_136_1733133153_2.jpg', 0, 0),
(586, 136, 'UV GUARD防曬長袖水母衣(OA-6310)', 'product_136_1733133153_3.jpg', 0, 0),
(587, 136, 'UV GUARD防曬長袖水母衣(OA-6310)', 'product_136_1733133153_4.jpg', 0, 0),
(588, 136, 'UV GUARD防曬長袖水母衣(OA-6310)', 'product_136_1733133153_5.jpg', 0, 0),
(589, 136, 'UV GUARD防曬長袖水母衣(OA-6310)', 'product_136_1733133153_6.jpg', 0, 0),
(590, 136, 'UV GUARD防曬長袖水母衣(OA-6310)', 'product_136_1733133153_7.jpg', 0, 0),
(591, 136, 'UV GUARD防曬長袖水母衣(OA-6310)', 'product_136_1733133153_8.jpg', 0, 0),
(592, 136, 'UV GUARD防曬長袖水母衣(OA-6310)', 'product_136_1733133153_9.jpg', 0, 0),
(593, 136, 'UV GUARD防曬長袖水母衣(OA-6310)', 'product_136_1733133153_10.jpg', 0, 0),
(594, 136, 'UV GUARD防曬長袖水母衣(OA-6310)', 'product_136_1733133153_11.jpg', 0, 0),
(595, 137, 'UV RAGLAN連帽防曬外套 _OA-6150', 'product_137_1733133185_0.jpg', 1, 0),
(596, 137, 'UV RAGLAN連帽防曬外套 _OA-6150', 'product_137_1733133185_1.jpg', 0, 0),
(597, 137, 'UV RAGLAN連帽防曬外套 _OA-6150', 'product_137_1733133185_2.jpg', 0, 0),
(598, 137, 'UV RAGLAN連帽防曬外套 _OA-6150', 'product_137_1733133185_3.jpg', 0, 0),
(599, 137, 'UV RAGLAN連帽防曬外套 _OA-6150', 'product_137_1733133185_4.jpg', 0, 0),
(600, 137, 'UV RAGLAN連帽防曬外套 _OA-6150', 'product_137_1733133185_5.jpg', 0, 0),
(601, 137, 'UV RAGLAN連帽防曬外套 _OA-6150', 'product_137_1733133185_6.jpg', 0, 0),
(602, 137, 'UV RAGLAN連帽防曬外套 _OA-6150', 'product_137_1733133185_7.jpg', 0, 0),
(603, 137, 'UV RAGLAN連帽防曬外套 _OA-6150', 'product_137_1733133185_8.jpg', 0, 0),
(604, 138, '女用長袖半身防寒衣', 'product_138_1733133221_0.jpg', 1, 0),
(605, 138, '女用長袖半身防寒衣', 'product_138_1733133221_1.jpg', 0, 0),
(606, 138, '女用長袖半身防寒衣', 'product_138_1733133221_2.jpg', 0, 0),
(607, 138, '女用長袖半身防寒衣', 'product_138_1733133221_3.jpg', 0, 0),
(608, 138, '女用長袖半身防寒衣', 'product_138_1733133221_4.jpg', 0, 0),
(609, 138, '女用長袖半身防寒衣', 'product_138_1733133221_5.jpg', 0, 0),
(610, 138, '女用長袖半身防寒衣', 'product_138_1733133221_6.jpg', 0, 0),
(611, 138, '女用長袖半身防寒衣', 'product_138_1733133221_7.jpg', 0, 0),
(612, 138, '女用長袖半身防寒衣', 'product_138_1733133221_8.jpg', 0, 0),
(613, 138, '女用長袖半身防寒衣', 'product_138_1733133221_9.jpg', 0, 0),
(614, 138, '女用長袖半身防寒衣', 'product_138_1733133221_10.jpg', 0, 0),
(615, 139, '男用背心防寒衣', 'product_139_1733133317_0.jpg', 1, 0),
(616, 139, '男用背心防寒衣', 'product_139_1733133317_1.jpg', 0, 0),
(617, 139, '男用背心防寒衣', 'product_139_1733133317_2.jpg', 0, 0),
(618, 139, '男用背心防寒衣', 'product_139_1733133317_3.jpg', 0, 0),
(619, 139, '男用背心防寒衣', 'product_139_1733133317_4.jpg', 0, 0),
(620, 139, '男用背心防寒衣', 'product_139_1733133317_5.jpg', 0, 0),
(621, 139, '男用背心防寒衣', 'product_139_1733133317_6.jpg', 0, 0),
(622, 139, '男用背心防寒衣', 'product_139_1733133317_7.jpg', 0, 0),
(623, 139, '男用背心防寒衣', 'product_139_1733133317_8.jpg', 0, 0),
(624, 139, '男用背心防寒衣', 'product_139_1733133317_9.jpg', 0, 0),
(625, 139, '男用背心防寒衣', 'product_139_1733133317_10.jpg', 0, 0),
(626, 140, '兒童款防曬水母衣 SS-5K34C', 'product_140_1733133353_0.jpg', 1, 0),
(627, 140, '兒童款防曬水母衣 SS-5K34C', 'product_140_1733133353_1.jpg', 0, 0),
(628, 140, '兒童款防曬水母衣 SS-5K34C', 'product_140_1733133353_2.jpg', 0, 0),
(629, 140, '兒童款防曬水母衣 SS-5K34C', 'product_140_1733133353_3.jpg', 0, 0),
(630, 141, 'ATI FLEX防曬長褲-女款(AG-7440)', 'product_141_1733133391_0.jpg', 1, 0),
(631, 142, 'UP-S5 輕量快乾百慕達短褲/曬色漸層/NG品', 'product_142_1733133438_0.jpg', 1, 0),
(632, 142, 'UP-S5 輕量快乾百慕達短褲/曬色漸層/NG品', 'product_142_1733133438_1.jpg', 0, 0),
(633, 142, 'UP-S5 輕量快乾百慕達短褲/曬色漸層/NG品', 'product_142_1733133438_2.jpg', 0, 0),
(634, 142, 'UP-S5 輕量快乾百慕達短褲/曬色漸層/NG品', 'product_142_1733133438_3.jpg', 0, 0),
(635, 142, 'UP-S5 輕量快乾百慕達短褲/曬色漸層/NG品', 'product_142_1733133438_4.jpg', 0, 0),
(636, 142, 'UP-S5 輕量快乾百慕達短褲/曬色漸層/NG品', 'product_142_1733133438_5.jpg', 0, 0),
(637, 142, 'UP-S5 輕量快乾百慕達短褲/曬色漸層/NG品', 'product_142_1733133438_6.jpg', 0, 0),
(638, 142, 'UP-S5 輕量快乾百慕達短褲/曬色漸層/NG品', 'product_142_1733133438_7.jpg', 0, 0),
(639, 142, 'UP-S5 輕量快乾百慕達短褲/曬色漸層/NG品', 'product_142_1733133438_8.jpg', 0, 0),
(640, 142, 'UP-S5 輕量快乾百慕達短褲/曬色漸層/NG品', 'product_142_1733133438_9.jpg', 0, 0),
(641, 143, 'UV GUARD LEGGING 緊身褲(OA-6340)', 'product_143_1733133469_0.jpg', 1, 0),
(642, 143, 'UV GUARD LEGGING 緊身褲(OA-6340)', 'product_143_1733133469_1.jpg', 0, 0),
(643, 143, 'UV GUARD LEGGING 緊身褲(OA-6340)', 'product_143_1733133469_2.jpg', 0, 0),
(644, 144, 'UV GUARD緊身水母褲(OA-6140)', 'product_144_1733133502_0.jpg', 1, 0),
(645, 144, 'UV GUARD緊身水母褲(OA-6140)', 'product_144_1733133502_1.jpg', 0, 0),
(646, 144, 'UV GUARD緊身水母褲(OA-6140)', 'product_144_1733133502_2.jpg', 0, 0),
(647, 144, 'UV GUARD緊身水母褲(OA-6140)', 'product_144_1733133502_3.jpg', 0, 0),
(648, 144, 'UV GUARD緊身水母褲(OA-6140)', 'product_144_1733133502_4.jpg', 0, 0),
(649, 145, '緊身熱褲 (GW-6368A)', 'product_145_1733133533_0.jpg', 1, 0),
(650, 145, '緊身熱褲 (GW-6368A)', 'product_145_1733133533_1.jpg', 0, 0),
(651, 145, '緊身熱褲 (GW-6368A)', 'product_145_1733133533_2.jpg', 0, 0),
(652, 145, '緊身熱褲 (GW-6368A)', 'product_145_1733133533_3.jpg', 0, 0),
(653, 145, '緊身熱褲 (GW-6368A)', 'product_145_1733133533_4.jpg', 0, 0),
(654, 145, '緊身熱褲 (GW-6368A)', 'product_145_1733133533_5.jpg', 0, 0),
(655, 145, '緊身熱褲 (GW-6368A)', 'product_145_1733133533_6.jpg', 0, 0),
(656, 146, '緊身踩腳長褲 (GW-6369A)', 'product_146_1733133565_0.jpg', 1, 0),
(657, 146, '緊身踩腳長褲 (GW-6369A)', 'product_146_1733133565_1.jpg', 0, 0),
(658, 146, '緊身踩腳長褲 (GW-6369A)', 'product_146_1733133565_2.jpg', 0, 0),
(659, 146, '緊身踩腳長褲 (GW-6369A)', 'product_146_1733133565_3.jpg', 0, 0),
(660, 147, 'ACT GLOVE手套 _雙指開口 (DA-1320)', 'product_147_1733133598_0.jpg', 1, 0),
(661, 147, 'ACT GLOVE手套 _雙指開口 (DA-1320)', 'product_147_1733133598_1.jpg', 0, 0),
(662, 147, 'ACT GLOVE手套 _雙指開口 (DA-1320)', 'product_147_1733133598_2.jpg', 0, 0),
(663, 147, 'ACT GLOVE手套 _雙指開口 (DA-1320)', 'product_147_1733133598_3.jpg', 0, 0),
(664, 147, 'ACT GLOVE手套 _雙指開口 (DA-1320)', 'product_147_1733133598_4.jpg', 0, 0),
(665, 147, 'ACT GLOVE手套 _雙指開口 (DA-1320)', 'product_147_1733133598_5.jpg', 0, 0),
(666, 147, 'ACT GLOVE手套 _雙指開口 (DA-1320)', 'product_147_1733133598_6.jpg', 0, 0),
(667, 148, 'AGGRO 水域活動手套-二色可選 (JA-1600)', 'product_148_1733133637_0.jpg', 1, 0),
(668, 148, 'AGGRO 水域活動手套-二色可選 (JA-1600)', 'product_148_1733133637_1.jpg', 0, 0),
(669, 148, 'AGGRO 水域活動手套-二色可選 (JA-1600)', 'product_148_1733133637_2.jpg', 0, 0),
(670, 149, 'CAMU 3D 防寒耐磨手套 2mm', 'product_149_1733133685_0.jpg', 1, 0),
(671, 149, 'CAMU 3D 防寒耐磨手套 2mm', 'product_149_1733133685_1.jpg', 0, 0),
(672, 150, 'MAXIFLEX Endurance 2mm 止滑耐磨手套', 'product_150_1733133723_0.jpg', 1, 0),
(673, 150, 'MAXIFLEX Endurance 2mm 止滑耐磨手套', 'product_150_1733133723_1.jpg', 0, 0),
(674, 150, 'MAXIFLEX Endurance 2mm 止滑耐磨手套', 'product_150_1733133723_2.jpg', 0, 0),
(675, 150, 'MAXIFLEX Endurance 2mm 止滑耐磨手套', 'product_150_1733133723_3.jpg', 0, 0),
(676, 150, 'MAXIFLEX Endurance 2mm 止滑耐磨手套', 'product_150_1733133723_4.jpg', 0, 0),
(677, 150, 'MAXIFLEX Endurance 2mm 止滑耐磨手套', 'product_150_1733133723_5.jpg', 0, 0),
(678, 150, 'MAXIFLEX Endurance 2mm 止滑耐磨手套', 'product_150_1733133723_6.jpg', 0, 0),
(679, 150, 'MAXIFLEX Endurance 2mm 止滑耐磨手套', 'product_150_1733133723_7.jpg', 0, 0),
(680, 150, 'MAXIFLEX Endurance 2mm 止滑耐磨手套', 'product_150_1733133723_8.jpg', 0, 0),
(681, 150, 'MAXIFLEX Endurance 2mm 止滑耐磨手套', 'product_150_1733133723_9.jpg', 0, 0),
(682, 150, 'MAXIFLEX Endurance 2mm 止滑耐磨手套', 'product_150_1733133723_10.jpg', 0, 0),
(683, 151, 'NEXKIN GLOVE 手套 2mm (DA-1050)', 'product_151_1733133756_0.jpg', 1, 0),
(684, 151, 'NEXKIN GLOVE 手套 2mm (DA-1050)', 'product_151_1733133756_1.jpg', 0, 0),
(685, 152, 'SPIDER 3mm 防寒耐磨手套', 'product_152_1733133788_0.jpg', 1, 0),
(686, 152, 'SPIDER 3mm 防寒耐磨手套', 'product_152_1733133788_1.jpg', 0, 0),
(687, 152, 'SPIDER 3mm 防寒耐磨手套', 'product_152_1733133788_2.jpg', 0, 0),
(688, 152, 'SPIDER 3mm 防寒耐磨手套', 'product_152_1733133788_3.jpg', 0, 0),
(689, 152, 'SPIDER 3mm 防寒耐磨手套', 'product_152_1733133788_4.jpg', 0, 0),
(690, 152, 'SPIDER 3mm 防寒耐磨手套', 'product_152_1733133788_5.jpg', 0, 0),
(691, 152, 'SPIDER 3mm 防寒耐磨手套', 'product_152_1733133788_6.jpg', 0, 0),
(692, 152, 'SPIDER 3mm 防寒耐磨手套', 'product_152_1733133788_7.jpg', 0, 0),
(693, 152, 'SPIDER 3mm 防寒耐磨手套', 'product_152_1733133788_8.jpg', 0, 0),
(694, 152, 'SPIDER 3mm 防寒耐磨手套', 'product_152_1733133788_9.jpg', 0, 0),
(695, 153, 'ULTRAFLEX潛水手套 2mm 素黑款 _膠面防護', 'product_153_1733133823_0.jpg', 1, 0),
(696, 153, 'ULTRAFLEX潛水手套 2mm 素黑款 _膠面防護', 'product_153_1733133823_1.jpg', 0, 0),
(697, 153, 'ULTRAFLEX潛水手套 2mm 素黑款 _膠面防護', 'product_153_1733133823_2.jpg', 0, 0),
(698, 154, 'ZOOM UP GLOVE 手套 2.5mm_ DA-1160 (二代)', 'product_154_1733133863_0.jpg', 1, 0),
(699, 154, 'ZOOM UP GLOVE 手套 2.5mm_ DA-1160 (二代)', 'product_154_1733133863_1.jpg', 0, 0),
(700, 155, 'ZOOMUP GLOVE 手套 2.5mm (DA-1140)', 'product_155_1733133893_0.jpg', 1, 0),
(701, 155, 'ZOOMUP GLOVE 手套 2.5mm (DA-1140)', 'product_155_1733133893_1.jpg', 0, 0),
(702, 156, '超彈性防寒手套(1.5mm)', 'product_156_1733133933_0.jpg', 1, 0),
(703, 157, '訂製款乾式防寒衣 CHEST ZIP DRY MAX', 'product_157_1733133981_0.jpg', 1, 0),
(704, 157, '訂製款乾式防寒衣 CHEST ZIP DRY MAX', 'product_157_1733133981_1.jpg', 0, 0),
(705, 157, '訂製款乾式防寒衣 CHEST ZIP DRY MAX', 'product_157_1733133981_2.jpg', 0, 0),
(706, 158, '訂製款乾式防寒衣 CHEST ZIP DRY MAX HYBRID', 'product_158_1733134056_0.jpg', 1, 0),
(707, 158, '訂製款乾式防寒衣 CHEST ZIP DRY MAX HYBRID', 'product_158_1733134056_1.jpg', 0, 0),
(708, 159, '訂製款乾式防寒衣 CROCO DRY FZ', 'product_159_1733134090_0.jpg', 1, 0),
(709, 159, '訂製款乾式防寒衣 CROCO DRY FZ', 'product_159_1733134090_1.jpg', 0, 0),
(710, 159, '訂製款乾式防寒衣 CROCO DRY FZ', 'product_159_1733134090_2.jpg', 0, 0),
(711, 160, '訂製款乾式防寒衣 N.S.T. CHEST ZIP DRY', 'product_160_1733134125_0.jpg', 1, 0),
(712, 160, '訂製款乾式防寒衣 N.S.T. CHEST ZIP DRY', 'product_160_1733134125_1.jpg', 0, 0),
(713, 161, '訂製款乾式防寒衣 SHIELDMAX DRY', 'product_161_1733134157_0.jpg', 1, 0),
(714, 161, '訂製款乾式防寒衣 SHIELDMAX DRY', 'product_161_1733134157_1.jpg', 0, 0),
(715, 161, '訂製款乾式防寒衣 SHIELDMAX DRY', 'product_161_1733134157_2.jpg', 0, 0),
(716, 161, '訂製款乾式防寒衣 SHIELDMAX DRY', 'product_161_1733134157_3.jpg', 0, 0),
(717, 161, '訂製款乾式防寒衣 SHIELDMAX DRY', 'product_161_1733134157_4.jpg', 0, 0),
(718, 161, '訂製款乾式防寒衣 SHIELDMAX DRY', 'product_161_1733134157_5.jpg', 0, 0),
(719, 161, '訂製款乾式防寒衣 SHIELDMAX DRY', 'product_161_1733134157_6.jpg', 0, 0),
(720, 162, '訂製款乾式防寒衣 SHIELDMAX HYBRID', 'product_162_1733134195_0.jpg', 1, 0),
(721, 162, '訂製款乾式防寒衣 SHIELDMAX HYBRID', 'product_162_1733134195_1.jpg', 0, 0),
(722, 162, '訂製款乾式防寒衣 SHIELDMAX HYBRID', 'product_162_1733134195_2.jpg', 0, 0),
(723, 162, '訂製款乾式防寒衣 SHIELDMAX HYBRID', 'product_162_1733134195_3.jpg', 0, 0);
INSERT INTO `product_image` (`id`, `product_id`, `name`, `imgUrl`, `isMain`, `isDeleted`) VALUES
(724, 162, '訂製款乾式防寒衣 SHIELDMAX HYBRID', 'product_162_1733134195_4.jpg', 0, 0),
(725, 162, '訂製款乾式防寒衣 SHIELDMAX HYBRID', 'product_162_1733134195_5.jpg', 0, 0),
(726, 163, '訂製款乾式防寒衣 SLASH DRY HYBRID', 'product_163_1733134228_0.jpg', 1, 0),
(727, 163, '訂製款乾式防寒衣 SLASH DRY HYBRID', 'product_163_1733134228_1.jpg', 0, 0),
(728, 163, '訂製款乾式防寒衣 SLASH DRY HYBRID', 'product_163_1733134228_2.jpg', 0, 0),
(729, 163, '訂製款乾式防寒衣 SLASH DRY HYBRID', 'product_163_1733134228_3.jpg', 0, 0),
(730, 163, '訂製款乾式防寒衣 SLASH DRY HYBRID', 'product_163_1733134228_4.jpg', 0, 0),
(731, 163, '訂製款乾式防寒衣 SLASH DRY HYBRID', 'product_163_1733134228_5.jpg', 0, 0),
(732, 164, '乾式防寒衣 ARMOR SHELL PRIME', 'product_164_1733134262_0.jpg', 1, 0),
(733, 164, '乾式防寒衣 ARMOR SHELL PRIME', 'product_164_1733134262_1.jpg', 0, 0),
(734, 164, '乾式防寒衣 ARMOR SHELL PRIME', 'product_164_1733134262_2.jpg', 0, 0),
(735, 164, '乾式防寒衣 ARMOR SHELL PRIME', 'product_164_1733134262_3.jpg', 0, 0),
(736, 164, '乾式防寒衣 ARMOR SHELL PRIME', 'product_164_1733134262_4.jpg', 0, 0),
(737, 164, '乾式防寒衣 ARMOR SHELL PRIME', 'product_164_1733134262_5.jpg', 0, 0),
(738, 164, '乾式防寒衣 ARMOR SHELL PRIME', 'product_164_1733134262_6.jpg', 0, 0),
(739, 165, '乾式防寒衣 TECH SHELL AQUA', 'product_165_1733134292_0.jpg', 1, 0),
(740, 165, '乾式防寒衣 TECH SHELL AQUA', 'product_165_1733134292_1.jpg', 0, 0),
(741, 165, '乾式防寒衣 TECH SHELL AQUA', 'product_165_1733134292_2.jpg', 0, 0),
(742, 165, '乾式防寒衣 TECH SHELL AQUA', 'product_165_1733134292_3.jpg', 0, 0),
(743, 165, '乾式防寒衣 TECH SHELL AQUA', 'product_165_1733134292_4.jpg', 0, 0),
(744, 166, '乾式防寒衣 TECH SHELL PRIME', 'product_166_1733134324_0.jpg', 1, 0),
(745, 166, '乾式防寒衣 TECH SHELL PRIME', 'product_166_1733134324_1.jpg', 0, 0),
(746, 166, '乾式防寒衣 TECH SHELL PRIME', 'product_166_1733134324_2.jpg', 0, 0),
(747, 167, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_167_1733134361_0.jpg', 1, 0),
(748, 167, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_167_1733134361_1.jpg', 0, 0),
(749, 167, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_167_1733134361_2.jpg', 0, 0),
(750, 167, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_167_1733134361_3.jpg', 0, 0),
(751, 167, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_167_1733134361_4.jpg', 0, 0),
(752, 167, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_167_1733134361_5.jpg', 0, 0),
(753, 167, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_167_1733134361_6.jpg', 0, 0),
(754, 167, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_167_1733134361_7.jpg', 0, 0),
(755, 168, '女款一件式長袖長褲防寒衣 DS-5B07W 3mm', 'product_168_1733134401_0.jpg', 1, 0),
(756, 168, '女款一件式長袖長褲防寒衣 DS-5B07W 3mm', 'product_168_1733134401_1.jpg', 0, 0),
(757, 168, '女款一件式長袖長褲防寒衣 DS-5B07W 3mm', 'product_168_1733134401_2.jpg', 0, 0),
(758, 168, '女款一件式長袖長褲防寒衣 DS-5B07W 3mm', 'product_168_1733134401_3.jpg', 0, 0),
(759, 168, '女款一件式長袖長褲防寒衣 DS-5B07W 3mm', 'product_168_1733134401_4.jpg', 0, 0),
(760, 169, '女款一件式短袖短褲防寒衣 DS-3B07W', 'product_169_1733134467_0.jpg', 1, 0),
(761, 169, '女款一件式短袖短褲防寒衣 DS-3B07W', 'product_169_1733134467_1.jpg', 0, 0),
(762, 170, '女款一件式短袖短褲防寒衣 DS-3B91W 3mm', 'product_170_1733134646_0.jpg', 1, 0),
(763, 170, '女款一件式短袖短褲防寒衣 DS-3B91W 3mm', 'product_170_1733134646_1.jpg', 0, 0),
(764, 170, '女款一件式短袖短褲防寒衣 DS-3B91W 3mm', 'product_170_1733134646_2.jpg', 0, 0),
(765, 170, '女款一件式短袖短褲防寒衣 DS-3B91W 3mm', 'product_170_1733134646_3.jpg', 0, 0),
(766, 170, '女款一件式短袖短褲防寒衣 DS-3B91W 3mm', 'product_170_1733134646_4.jpg', 0, 0),
(767, 170, '女款一件式短袖短褲防寒衣 DS-3B91W 3mm', 'product_170_1733134646_5.jpg', 0, 0),
(768, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_0.jpg', 1, 0),
(769, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_1.jpg', 0, 0),
(770, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_2.jpg', 0, 0),
(771, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_3.jpg', 0, 0),
(772, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_4.jpg', 0, 0),
(773, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_5.jpg', 0, 0),
(774, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_6.jpg', 0, 0),
(775, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_7.jpg', 0, 0),
(776, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_8.jpg', 0, 0),
(777, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_9.jpg', 0, 0),
(778, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_10.jpg', 0, 0),
(779, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_11.jpg', 0, 0),
(780, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_12.jpg', 0, 0),
(781, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_13.jpg', 0, 0),
(782, 171, '成衣款防寒衣 SHE\'S PIXY 3.5mm', 'product_171_1733134718_14.jpg', 0, 0),
(783, 172, '男款一件式無袖短褲防寒衣 DS-1B107M 1.5mm', 'product_172_1733134898_0.jpg', 1, 0),
(784, 172, '男款一件式無袖短褲防寒衣 DS-1B107M 1.5mm', 'product_172_1733134898_1.jpg', 0, 0),
(785, 172, '男款一件式無袖短褲防寒衣 DS-1B107M 1.5mm', 'product_172_1733134898_2.jpg', 0, 0),
(786, 172, '男款一件式無袖短褲防寒衣 DS-1B107M 1.5mm', 'product_172_1733134898_3.jpg', 0, 0),
(787, 173, '兒童款一件式短袖短褲防寒衣 DS-3B44C', 'product_173_1733135243_0.jpg', 1, 0),
(788, 173, '兒童款一件式短袖短褲防寒衣 DS-3B44C', 'product_173_1733135243_1.jpg', 0, 0),
(789, 173, '兒童款一件式短袖短褲防寒衣 DS-3B44C', 'product_173_1733135243_2.jpg', 0, 0),
(790, 173, '兒童款一件式短袖短褲防寒衣 DS-3B44C', 'product_173_1733135243_3.jpg', 0, 0),
(791, 174, '兒童款一件式短袖短褲防寒衣 DS-3B117C', 'product_174_1733135283_0.jpg', 1, 0),
(792, 174, '兒童款一件式短袖短褲防寒衣 DS-3B117C', 'product_174_1733135283_1.jpg', 0, 0),
(793, 174, '兒童款一件式短袖短褲防寒衣 DS-3B117C', 'product_174_1733135283_2.jpg', 0, 0),
(794, 174, '兒童款一件式短袖短褲防寒衣 DS-3B117C', 'product_174_1733135283_3.jpg', 0, 0),
(795, 175, '訂製款防寒衣 DISCOVERY LIGHT', 'product_175_1733135321_0.jpg', 1, 0),
(796, 175, '訂製款防寒衣 DISCOVERY LIGHT', 'product_175_1733135321_1.jpg', 0, 0),
(797, 175, '訂製款防寒衣 DISCOVERY LIGHT', 'product_175_1733135321_2.jpg', 0, 0),
(798, 176, '訂製款防寒衣 SKIN FIT 65', 'product_176_1733135380_0.jpg', 1, 0),
(799, 176, '訂製款防寒衣 SKIN FIT 65', 'product_176_1733135380_1.jpg', 0, 0),
(800, 176, '訂製款防寒衣 SKIN FIT 65', 'product_176_1733135380_2.jpg', 0, 0),
(801, 177, 'AIR SHELTER船潛外套 黃x橘 (絕版配色)', 'product_177_1733135463_0.jpg', 1, 0),
(802, 177, 'AIR SHELTER船潛外套 黃x橘 (絕版配色)', 'product_177_1733135463_1.jpg', 0, 0),
(803, 178, 'AIR SHELTER船潛防寒外套 _粉紅x水藍(絕版品)', 'product_178_1733135512_0.jpg', 1, 0),
(804, 178, 'AIR SHELTER船潛防寒外套 _粉紅x水藍(絕版品)', 'product_178_1733135512_1.jpg', 0, 0),
(805, 178, 'AIR SHELTER船潛防寒外套 _粉紅x水藍(絕版品)', 'product_178_1733135512_2.jpg', 0, 0),
(806, 178, 'AIR SHELTER船潛防寒外套 _粉紅x水藍(絕版品)', 'product_178_1733135512_3.jpg', 0, 0),
(807, 179, 'AIR SHELTER船潛防寒外套 _粉藍(絕版品)', 'product_179_1733135544_0.jpg', 1, 0),
(808, 179, 'AIR SHELTER船潛防寒外套 _粉藍(絕版品)', 'product_179_1733135544_1.jpg', 0, 0),
(809, 179, 'AIR SHELTER船潛防寒外套 _粉藍(絕版品)', 'product_179_1733135544_2.jpg', 0, 0),
(810, 180, 'AIR SHELTER船潛防寒外套 玫瑰粉 (絕版配色)', 'product_180_1733135582_0.jpg', 1, 0),
(811, 180, 'AIR SHELTER船潛防寒外套 玫瑰粉 (絕版配色)', 'product_180_1733135582_1.jpg', 0, 0),
(812, 181, 'AIR SHELTER船潛防寒外套 紅灰', 'product_181_1733135627_0.jpg', 1, 0),
(813, 181, 'AIR SHELTER船潛防寒外套 紅灰', 'product_181_1733135627_1.jpg', 0, 0),
(814, 182, 'AIR SHELTER船潛防寒外套 海軍藍', 'product_182_1733135666_0.jpg', 1, 0),
(815, 183, 'AIR SHELTER船潛防寒外套 黑', 'product_183_1733135702_0.jpg', 1, 0),
(816, 184, 'AIR SHELTER船潛防寒外套 寶藍 (絕版配色)', 'product_184_1733135729_0.jpg', 1, 0),
(817, 184, 'AIR SHELTER船潛防寒外套 寶藍 (絕版配色)', 'product_184_1733135729_1.jpg', 0, 0),
(818, 184, 'AIR SHELTER船潛防寒外套 寶藍 (絕版配色)', 'product_184_1733135729_2.jpg', 0, 0),
(819, 185, 'Classic Logo Reflective Poncho #24 多用途毛巾衣', 'product_185_1733135770_0.jpg', 1, 0),
(820, 185, 'Classic Logo Reflective Poncho #24 多用途毛巾衣', 'product_185_1733135770_1.jpg', 0, 0),
(821, 186, 'LAZYFISH® Classic Logo Poncho _ kid #24 兒童款毛巾衣', 'product_186_1733135799_0.jpg', 1, 0),
(822, 186, 'LAZYFISH® Classic Logo Poncho _ kid #24 兒童款毛巾衣', 'product_186_1733135799_1.jpg', 0, 0),
(823, 186, 'LAZYFISH® Classic Logo Poncho _ kid #24 兒童款毛巾衣', 'product_186_1733135799_2.jpg', 0, 0),
(824, 187, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 'product_187_1733135839_0.jpg', 1, 0),
(825, 187, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 'product_187_1733135839_1.jpg', 0, 0),
(826, 187, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 'product_187_1733135839_2.jpg', 0, 0),
(827, 187, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 'product_187_1733135839_3.jpg', 0, 0),
(828, 187, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 'product_187_1733135839_4.jpg', 0, 0),
(829, 187, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 'product_187_1733135839_5.jpg', 0, 0),
(830, 187, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 'product_187_1733135839_6.jpg', 0, 0),
(831, 188, 'Aurea 自潛防寒衣 (女款)', 'product_188_1733135870_0.jpg', 1, 0),
(832, 188, 'Aurea 自潛防寒衣 (女款)', 'product_188_1733135870_1.jpg', 0, 0),
(833, 188, 'Aurea 自潛防寒衣 (女款)', 'product_188_1733135870_2.jpg', 0, 0),
(834, 188, 'Aurea 自潛防寒衣 (女款)', 'product_188_1733135870_3.jpg', 0, 0),
(835, 188, 'Aurea 自潛防寒衣 (女款)', 'product_188_1733135870_4.jpg', 0, 0),
(836, 188, 'Aurea 自潛防寒衣 (女款)', 'product_188_1733135870_5.jpg', 0, 0),
(837, 189, 'Aurea 自潛防寒衣2mm ( 男款)', 'product_189_1733135902_0.jpg', 1, 0),
(838, 189, 'Aurea 自潛防寒衣2mm ( 男款)', 'product_189_1733135902_1.jpg', 0, 0),
(839, 189, 'Aurea 自潛防寒衣2mm ( 男款)', 'product_189_1733135902_2.jpg', 0, 0),
(840, 189, 'Aurea 自潛防寒衣2mm ( 男款)', 'product_189_1733135902_3.jpg', 0, 0),
(841, 189, 'Aurea 自潛防寒衣2mm ( 男款)', 'product_189_1733135902_4.jpg', 0, 0),
(842, 189, 'Aurea 自潛防寒衣2mm ( 男款)', 'product_189_1733135902_5.jpg', 0, 0),
(843, 190, 'DYNAMIC LONG JOHN_ 自潛防寒衣背心長褲 1.5mm 男女通用款', 'product_190_1733135935_0.jpg', 1, 0),
(844, 190, 'DYNAMIC LONG JOHN_ 自潛防寒衣背心長褲 1.5mm 男女通用款', 'product_190_1733135935_1.jpg', 0, 0),
(845, 190, 'DYNAMIC LONG JOHN_ 自潛防寒衣背心長褲 1.5mm 男女通用款', 'product_190_1733135935_2.jpg', 0, 0),
(846, 190, 'DYNAMIC LONG JOHN_ 自潛防寒衣背心長褲 1.5mm 男女通用款', 'product_190_1733135935_3.jpg', 0, 0),
(847, 190, 'DYNAMIC LONG JOHN_ 自潛防寒衣背心長褲 1.5mm 男女通用款', 'product_190_1733135935_4.jpg', 0, 0),
(848, 190, 'DYNAMIC LONG JOHN_ 自潛防寒衣背心長褲 1.5mm 男女通用款', 'product_190_1733135935_5.jpg', 0, 0),
(849, 191, 'DYNAMI-TECH 皮面防寒衣2mm-男女通用款', 'product_191_1733135968_0.jpg', 1, 0),
(850, 191, 'DYNAMI-TECH 皮面防寒衣2mm-男女通用款', 'product_191_1733135968_1.jpg', 0, 0),
(851, 191, 'DYNAMI-TECH 皮面防寒衣2mm-男女通用款', 'product_191_1733135968_2.jpg', 0, 0),
(852, 192, 'SIDERAL 自潛防寒衣2mm ( 男款)', 'product_192_1733136001_0.jpg', 1, 0),
(853, 192, 'SIDERAL 自潛防寒衣2mm ( 男款)', 'product_192_1733136001_1.jpg', 0, 0),
(854, 192, 'SIDERAL 自潛防寒衣2mm ( 男款)', 'product_192_1733136001_2.jpg', 0, 0),
(855, 192, 'SIDERAL 自潛防寒衣2mm ( 男款)', 'product_192_1733136001_3.jpg', 0, 0),
(856, 192, 'SIDERAL 自潛防寒衣2mm ( 男款)', 'product_192_1733136001_4.jpg', 0, 0),
(857, 192, 'SIDERAL 自潛防寒衣2mm ( 男款)', 'product_192_1733136001_5.jpg', 0, 0),
(858, 193, 'SIDERAL 自潛防寒衣2mm (女款)', 'product_193_1733136030_0.jpg', 1, 0),
(859, 193, 'SIDERAL 自潛防寒衣2mm (女款)', 'product_193_1733136030_1.jpg', 0, 0),
(860, 193, 'SIDERAL 自潛防寒衣2mm (女款)', 'product_193_1733136030_2.jpg', 0, 0),
(861, 193, 'SIDERAL 自潛防寒衣2mm (女款)', 'product_193_1733136030_3.jpg', 0, 0),
(862, 193, 'SIDERAL 自潛防寒衣2mm (女款)', 'product_193_1733136030_4.jpg', 0, 0),
(863, 193, 'SIDERAL 自潛防寒衣2mm (女款)', 'product_193_1733136030_5.jpg', 0, 0),
(864, 194, 'TRIATHLON訂製款三鐵防寒衣', 'product_194_1733136062_0.jpg', 1, 0),
(865, 194, 'TRIATHLON訂製款三鐵防寒衣', 'product_194_1733136062_1.jpg', 0, 0),
(866, 194, 'TRIATHLON訂製款三鐵防寒衣', 'product_194_1733136062_2.jpg', 0, 0),
(867, 194, 'TRIATHLON訂製款三鐵防寒衣', 'product_194_1733136062_3.jpg', 0, 0),
(868, 194, 'TRIATHLON訂製款三鐵防寒衣', 'product_194_1733136062_4.jpg', 0, 0),
(869, 194, 'TRIATHLON訂製款三鐵防寒衣', 'product_194_1733136062_5.jpg', 0, 0),
(870, 194, 'TRIATHLON訂製款三鐵防寒衣', 'product_194_1733136062_6.jpg', 0, 0),
(871, 194, 'TRIATHLON訂製款三鐵防寒衣', 'product_194_1733136062_7.jpg', 0, 0),
(872, 194, 'TRIATHLON訂製款三鐵防寒衣', 'product_194_1733136062_8.jpg', 0, 0),
(873, 194, 'TRIATHLON訂製款三鐵防寒衣', 'product_194_1733136062_9.jpg', 0, 0),
(874, 194, 'TRIATHLON訂製款三鐵防寒衣', 'product_194_1733136062_10.jpg', 0, 0),
(875, 195, '女款防寒背心1.5mm _ opencell+鈦塗層', 'product_195_1733136100_0.jpg', 1, 0),
(876, 195, '女款防寒背心1.5mm _ opencell+鈦塗層', 'product_195_1733136100_1.jpg', 0, 0),
(877, 195, '女款防寒背心1.5mm _ opencell+鈦塗層', 'product_195_1733136100_2.jpg', 0, 0),
(878, 195, '女款防寒背心1.5mm _ opencell+鈦塗層', 'product_195_1733136100_3.jpg', 0, 0),
(879, 195, '女款防寒背心1.5mm _ opencell+鈦塗層', 'product_195_1733136100_4.jpg', 0, 0),
(880, 195, '女款防寒背心1.5mm _ opencell+鈦塗層', 'product_195_1733136100_5.jpg', 0, 0),
(881, 196, '防寒背心1.5mm _ opencell+鈦塗層', 'product_196_1733136144_0.jpg', 1, 0),
(882, 196, '防寒背心1.5mm _ opencell+鈦塗層', 'product_196_1733136144_1.jpg', 0, 0),
(883, 196, '防寒背心1.5mm _ opencell+鈦塗層', 'product_196_1733136144_2.jpg', 0, 0),
(884, 196, '防寒背心1.5mm _ opencell+鈦塗層', 'product_196_1733136144_3.jpg', 0, 0),
(885, 197, '【海之韻系列】鈦睿迷彩兩件式防寒衣3mm', 'product_197_1733136229_0.jpg', 1, 0),
(886, 197, '【海之韻系列】鈦睿迷彩兩件式防寒衣3mm', 'product_197_1733136229_1.jpg', 0, 0),
(887, 197, '【海之韻系列】鈦睿迷彩兩件式防寒衣3mm', 'product_197_1733136229_2.jpg', 0, 0),
(888, 197, '【海之韻系列】鈦睿迷彩兩件式防寒衣3mm', 'product_197_1733136229_3.jpg', 0, 0),
(889, 197, '【海之韻系列】鈦睿迷彩兩件式防寒衣3mm', 'product_197_1733136229_4.jpg', 0, 0),
(890, 197, '【海之韻系列】鈦睿迷彩兩件式防寒衣3mm', 'product_197_1733136229_5.jpg', 0, 0),
(891, 197, '【海之韻系列】鈦睿迷彩兩件式防寒衣3mm', 'product_197_1733136229_6.jpg', 0, 0),
(892, 197, '【海之韻系列】鈦睿迷彩兩件式防寒衣3mm', 'product_197_1733136229_7.jpg', 0, 0),
(893, 197, '【海之韻系列】鈦睿迷彩兩件式防寒衣3mm', 'product_197_1733136229_8.jpg', 0, 0),
(894, 197, '【海之韻系列】鈦睿迷彩兩件式防寒衣3mm', 'product_197_1733136229_9.jpg', 0, 0),
(895, 198, 'ACT APNEA ADVANCED 訂製款 _3mm', 'product_198_1733136260_0.jpg', 1, 0),
(896, 198, 'ACT APNEA ADVANCED 訂製款 _3mm', 'product_198_1733136260_1.jpg', 0, 0),
(897, 198, 'ACT APNEA ADVANCED 訂製款 _3mm', 'product_198_1733136260_2.jpg', 0, 0),
(898, 198, 'ACT APNEA ADVANCED 訂製款 _3mm', 'product_198_1733136260_3.jpg', 0, 0),
(899, 199, 'ACT APNEA COMPETITION 訂製款防寒衣2mm', 'product_199_1733136289_0.jpg', 1, 0),
(900, 199, 'ACT APNEA COMPETITION 訂製款防寒衣2mm', 'product_199_1733136289_1.jpg', 0, 0),
(901, 199, 'ACT APNEA COMPETITION 訂製款防寒衣2mm', 'product_199_1733136289_2.jpg', 0, 0),
(902, 199, 'ACT APNEA COMPETITION 訂製款防寒衣2mm', 'product_199_1733136289_3.jpg', 0, 0),
(903, 200, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 'product_200_1733136319_0.jpg', 1, 0),
(904, 200, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 'product_200_1733136319_1.jpg', 0, 0),
(905, 200, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 'product_200_1733136319_2.jpg', 0, 0),
(906, 200, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 'product_200_1733136319_3.jpg', 0, 0),
(907, 200, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 'product_200_1733136319_4.jpg', 0, 0),
(908, 200, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 'product_200_1733136319_5.jpg', 0, 0),
(909, 200, 'ACT APNEA STANDARD 訂製款防寒衣3mm', 'product_200_1733136319_6.jpg', 0, 0),
(910, 201, 'ACTION 訂製款防寒衣1.5mm', 'product_201_1733136389_0.jpg', 1, 0),
(911, 201, 'ACTION 訂製款防寒衣1.5mm', 'product_201_1733136389_1.jpg', 0, 0),
(912, 201, 'ACTION 訂製款防寒衣1.5mm', 'product_201_1733136389_2.jpg', 0, 0),
(913, 201, 'ACTION 訂製款防寒衣1.5mm', 'product_201_1733136389_3.jpg', 0, 0),
(914, 201, 'ACTION 訂製款防寒衣1.5mm', 'product_201_1733136389_4.jpg', 0, 0),
(915, 202, 'ACTION 訂製款防寒衣3mm', 'product_202_1733136422_0.jpg', 1, 0),
(916, 202, 'ACTION 訂製款防寒衣3mm', 'product_202_1733136422_1.jpg', 0, 0),
(917, 202, 'ACTION 訂製款防寒衣3mm', 'product_202_1733136422_2.jpg', 0, 0),
(918, 202, 'ACTION 訂製款防寒衣3mm', 'product_202_1733136422_3.jpg', 0, 0),
(919, 203, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_203_1733136454_0.jpg', 1, 0),
(920, 203, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_203_1733136454_1.jpg', 0, 0),
(921, 203, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_203_1733136454_2.jpg', 0, 0),
(922, 203, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_203_1733136454_3.jpg', 0, 0),
(923, 203, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_203_1733136454_4.jpg', 0, 0),
(924, 203, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_203_1733136454_5.jpg', 0, 0),
(925, 203, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_203_1733136454_6.jpg', 0, 0),
(926, 203, 'BLACK PEARL皮面夾克防寒衣 1.5mm', 'product_203_1733136454_7.jpg', 0, 0),
(927, 204, 'CARBON SKIN PRO 皮面防寒衣3mm-男女款', 'product_204_1733136507_0.jpg', 1, 0),
(928, 204, 'CARBON SKIN PRO 皮面防寒衣3mm-男女款', 'product_204_1733136507_1.jpg', 0, 0),
(929, 204, 'CARBON SKIN PRO 皮面防寒衣3mm-男女款', 'product_204_1733136507_2.jpg', 0, 0),
(930, 204, 'CARBON SKIN PRO 皮面防寒衣3mm-男女款', 'product_204_1733136507_3.jpg', 0, 0),
(931, 205, 'SIDERAL 自潛防寒衣3mm (女款)', 'product_205_1733136537_0.jpg', 1, 0),
(932, 205, 'SIDERAL 自潛防寒衣3mm (女款)', 'product_205_1733136537_1.jpg', 0, 0),
(933, 205, 'SIDERAL 自潛防寒衣3mm (女款)', 'product_205_1733136537_2.jpg', 0, 0),
(934, 205, 'SIDERAL 自潛防寒衣3mm (女款)', 'product_205_1733136537_3.jpg', 0, 0),
(935, 205, 'SIDERAL 自潛防寒衣3mm (女款)', 'product_205_1733136537_4.jpg', 0, 0),
(936, 206, 'SIDERAL 自潛防寒衣3mm (男款)', 'product_206_1733136573_0.jpg', 1, 0),
(937, 206, 'SIDERAL 自潛防寒衣3mm (男款)', 'product_206_1733136573_1.jpg', 0, 0),
(938, 206, 'SIDERAL 自潛防寒衣3mm (男款)', 'product_206_1733136573_2.jpg', 0, 0),
(939, 206, 'SIDERAL 自潛防寒衣3mm (男款)', 'product_206_1733136573_3.jpg', 0, 0),
(940, 206, 'SIDERAL 自潛防寒衣3mm (男款)', 'product_206_1733136573_4.jpg', 0, 0),
(941, 207, '【TRU-REAL系列】大翅鯨半身無袖露背款防寒衣', 'product_207_1733136810_0.jpg', 1, 0),
(942, 207, '【TRU-REAL系列】大翅鯨半身無袖露背款防寒衣', 'product_207_1733136810_1.jpg', 0, 0),
(943, 207, '【TRU-REAL系列】大翅鯨半身無袖露背款防寒衣', 'product_207_1733136810_2.jpg', 0, 0),
(944, 207, '【TRU-REAL系列】大翅鯨半身無袖露背款防寒衣', 'product_207_1733136810_3.jpg', 0, 0),
(945, 207, '【TRU-REAL系列】大翅鯨半身無袖露背款防寒衣', 'product_207_1733136810_4.jpg', 0, 0),
(946, 207, '【TRU-REAL系列】大翅鯨半身無袖露背款防寒衣', 'product_207_1733136810_5.jpg', 0, 0),
(947, 208, '【TRU-REAL系列】前拉鍊無袖款防寒衣', 'product_208_1733136853_0.jpg', 1, 0),
(948, 208, '【TRU-REAL系列】前拉鍊無袖款防寒衣', 'product_208_1733136853_1.jpg', 0, 0),
(949, 208, '【TRU-REAL系列】前拉鍊無袖款防寒衣', 'product_208_1733136853_2.jpg', 0, 0),
(950, 208, '【TRU-REAL系列】前拉鍊無袖款防寒衣', 'product_208_1733136853_3.jpg', 0, 0),
(951, 208, '【TRU-REAL系列】前拉鍊無袖款防寒衣', 'product_208_1733136853_4.jpg', 0, 0),
(952, 208, '【TRU-REAL系列】前拉鍊無袖款防寒衣', 'product_208_1733136853_5.jpg', 0, 0),
(953, 208, '【TRU-REAL系列】前拉鍊無袖款防寒衣', 'product_208_1733136853_6.jpg', 0, 0),
(954, 208, '【TRU-REAL系列】前拉鍊無袖款防寒衣', 'product_208_1733136853_7.jpg', 0, 0),
(955, 208, '【TRU-REAL系列】前拉鍊無袖款防寒衣', 'product_208_1733136853_8.jpg', 0, 0),
(956, 208, '【TRU-REAL系列】前拉鍊無袖款防寒衣', 'product_208_1733136853_9.jpg', 0, 0),
(957, 208, '【TRU-REAL系列】前拉鍊無袖款防寒衣', 'product_208_1733136853_10.jpg', 0, 0),
(958, 208, '【TRU-REAL系列】前拉鍊無袖款防寒衣', 'product_208_1733136853_11.jpg', 0, 0),
(959, 209, '【TRU-REAL系列】前拉鍊無袖露腰款防寒衣', 'product_209_1733136907_0.jpg', 1, 0),
(960, 209, '【TRU-REAL系列】前拉鍊無袖露腰款防寒衣', 'product_209_1733136907_1.jpg', 0, 0),
(961, 209, '【TRU-REAL系列】前拉鍊無袖露腰款防寒衣', 'product_209_1733136907_2.jpg', 0, 0),
(962, 209, '【TRU-REAL系列】前拉鍊無袖露腰款防寒衣', 'product_209_1733136907_3.jpg', 0, 0),
(963, 210, 'ACTION 訂製款防寒衣-高衩款 1.5&3mm', 'product_210_1733136944_0.jpg', 1, 0),
(964, 210, 'ACTION 訂製款防寒衣-高衩款 1.5&3mm', 'product_210_1733136944_1.jpg', 0, 0),
(965, 210, 'ACTION 訂製款防寒衣-高衩款 1.5&3mm', 'product_210_1733136944_2.jpg', 0, 0),
(966, 210, 'ACTION 訂製款防寒衣-高衩款 1.5&3mm', 'product_210_1733136944_3.jpg', 0, 0),
(967, 210, 'ACTION 訂製款防寒衣-高衩款 1.5&3mm', 'product_210_1733136944_4.jpg', 0, 0),
(968, 210, 'ACTION 訂製款防寒衣-高衩款 1.5&3mm', 'product_210_1733136944_5.jpg', 0, 0),
(969, 210, 'ACTION 訂製款防寒衣-高衩款 1.5&3mm', 'product_210_1733136944_6.jpg', 0, 0),
(970, 210, 'ACTION 訂製款防寒衣-高衩款 1.5&3mm', 'product_210_1733136944_7.jpg', 0, 0),
(971, 210, 'ACTION 訂製款防寒衣-高衩款 1.5&3mm', 'product_210_1733136944_8.jpg', 0, 0),
(972, 211, 'Aurea 長袖半身防寒衣2mm', 'product_211_1733136976_0.jpg', 1, 0),
(973, 211, 'Aurea 長袖半身防寒衣2mm', 'product_211_1733136976_1.jpg', 0, 0),
(974, 211, 'Aurea 長袖半身防寒衣2mm', 'product_211_1733136976_2.jpg', 0, 0),
(975, 211, 'Aurea 長袖半身防寒衣2mm', 'product_211_1733136976_3.jpg', 0, 0),
(976, 212, 'Aurea 無袖半身防寒衣2mm', 'product_212_1733137012_0.jpg', 1, 0),
(977, 212, 'Aurea 無袖半身防寒衣2mm', 'product_212_1733137012_1.jpg', 0, 0),
(978, 212, 'Aurea 無袖半身防寒衣2mm', 'product_212_1733137012_2.jpg', 0, 0),
(979, 212, 'Aurea 無袖半身防寒衣2mm', 'product_212_1733137012_3.jpg', 0, 0),
(980, 212, 'Aurea 無袖半身防寒衣2mm', 'product_212_1733137012_4.jpg', 0, 0),
(981, 213, '一件式長袖短褲防寒衣(高衩款) _ 2mm', 'product_213_1733137043_0.jpg', 1, 0),
(982, 213, '一件式長袖短褲防寒衣(高衩款) _ 2mm', 'product_213_1733137043_1.jpg', 0, 0),
(983, 213, '一件式長袖短褲防寒衣(高衩款) _ 2mm', 'product_213_1733137043_2.jpg', 0, 0),
(984, 213, '一件式長袖短褲防寒衣(高衩款) _ 2mm', 'product_213_1733137043_3.jpg', 0, 0),
(985, 213, '一件式長袖短褲防寒衣(高衩款) _ 2mm', 'product_213_1733137043_4.jpg', 0, 0),
(986, 213, '一件式長袖短褲防寒衣(高衩款) _ 2mm', 'product_213_1733137043_5.jpg', 0, 0),
(987, 213, '一件式長袖短褲防寒衣(高衩款) _ 2mm', 'product_213_1733137043_6.jpg', 0, 0),
(988, 213, '一件式長袖短褲防寒衣(高衩款) _ 2mm', 'product_213_1733137043_7.jpg', 0, 0),
(989, 213, '一件式長袖短褲防寒衣(高衩款) _ 2mm', 'product_213_1733137043_8.jpg', 0, 0),
(990, 214, '女用長袖半身防寒衣', 'product_214_1733137075_0.jpg', 1, 0),
(991, 214, '女用長袖半身防寒衣', 'product_214_1733137075_1.jpg', 0, 0),
(992, 214, '女用長袖半身防寒衣', 'product_214_1733137075_2.jpg', 0, 0),
(993, 214, '女用長袖半身防寒衣', 'product_214_1733137075_3.jpg', 0, 0),
(994, 214, '女用長袖半身防寒衣', 'product_214_1733137075_4.jpg', 0, 0),
(995, 214, '女用長袖半身防寒衣', 'product_214_1733137075_5.jpg', 0, 0),
(996, 214, '女用長袖半身防寒衣', 'product_214_1733137075_6.jpg', 0, 0),
(997, 214, '女用長袖半身防寒衣', 'product_214_1733137075_7.jpg', 0, 0),
(998, 214, '女用長袖半身防寒衣', 'product_214_1733137075_8.jpg', 0, 0),
(999, 214, '女用長袖半身防寒衣', 'product_214_1733137075_9.jpg', 0, 0),
(1000, 214, '女用長袖半身防寒衣', 'product_214_1733137075_10.jpg', 0, 0),
(1001, 215, '男用背心防寒衣', 'product_215_1733137127_0.jpg', 1, 0),
(1002, 215, '男用背心防寒衣', 'product_215_1733137127_1.jpg', 0, 0),
(1003, 215, '男用背心防寒衣', 'product_215_1733137127_2.jpg', 0, 0),
(1004, 215, '男用背心防寒衣', 'product_215_1733137127_3.jpg', 0, 0),
(1005, 215, '男用背心防寒衣', 'product_215_1733137127_4.jpg', 0, 0),
(1006, 215, '男用背心防寒衣', 'product_215_1733137127_5.jpg', 0, 0),
(1007, 215, '男用背心防寒衣', 'product_215_1733137127_6.jpg', 0, 0),
(1008, 215, '男用背心防寒衣', 'product_215_1733137127_7.jpg', 0, 0),
(1009, 215, '男用背心防寒衣', 'product_215_1733137127_8.jpg', 0, 0),
(1010, 215, '男用背心防寒衣', 'product_215_1733137127_9.jpg', 0, 0),
(1011, 215, '男用背心防寒衣', 'product_215_1733137127_10.jpg', 0, 0),
(1012, 216, '兒童款防曬水母衣 SS-5K34C', 'product_216_1733137161_0.jpg', 1, 0),
(1013, 216, '兒童款防曬水母衣 SS-5K34C', 'product_216_1733137161_1.jpg', 0, 0),
(1014, 216, '兒童款防曬水母衣 SS-5K34C', 'product_216_1733137161_2.jpg', 0, 0),
(1015, 216, '兒童款防曬水母衣 SS-5K34C', 'product_216_1733137161_3.jpg', 0, 0),
(1016, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_0.jpg', 1, 0),
(1017, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_1.jpg', 0, 0),
(1018, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_2.jpg', 0, 0),
(1019, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_3.jpg', 0, 0),
(1020, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_4.jpg', 0, 0),
(1021, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_5.jpg', 0, 0),
(1022, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_6.jpg', 0, 0),
(1023, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_7.jpg', 0, 0),
(1024, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_8.jpg', 0, 0),
(1025, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_9.jpg', 0, 0),
(1026, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_10.jpg', 0, 0),
(1027, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_11.jpg', 0, 0),
(1028, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_12.jpg', 0, 0),
(1029, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_13.jpg', 0, 0),
(1030, 217, '【漁獵系列】帶帽兩件式防寒衣', 'product_217_1733137238_14.jpg', 0, 0),
(1031, 218, 'BLUE DEEP自潛防寒衣(海之隱者)_2mm', 'product_218_1733137279_0.jpg', 1, 0),
(1032, 218, 'BLUE DEEP自潛防寒衣(海之隱者)_2mm', 'product_218_1733137279_1.jpg', 0, 0),
(1033, 219, 'BODY-FIT CAMO SUIT自潛防寒衣 1.5mm-深水迷彩', 'product_219_1733137331_0.jpg', 1, 0),
(1034, 219, 'BODY-FIT CAMO SUIT自潛防寒衣 1.5mm-深水迷彩', 'product_219_1733137331_1.jpg', 0, 0),
(1035, 219, 'BODY-FIT CAMO SUIT自潛防寒衣 1.5mm-深水迷彩', 'product_219_1733137331_2.jpg', 0, 0),
(1036, 219, 'BODY-FIT CAMO SUIT自潛防寒衣 1.5mm-深水迷彩', 'product_219_1733137331_3.jpg', 0, 0),
(1037, 219, 'BODY-FIT CAMO SUIT自潛防寒衣 1.5mm-深水迷彩', 'product_219_1733137331_4.jpg', 0, 0),
(1038, 219, 'BODY-FIT CAMO SUIT自潛防寒衣 1.5mm-深水迷彩', 'product_219_1733137331_5.jpg', 0, 0),
(1039, 219, 'BODY-FIT CAMO SUIT自潛防寒衣 1.5mm-深水迷彩', 'product_219_1733137331_6.jpg', 0, 0),
(1040, 219, 'BODY-FIT CAMO SUIT自潛防寒衣 1.5mm-深水迷彩', 'product_219_1733137331_7.jpg', 0, 0),
(1041, 219, 'BODY-FIT CAMO SUIT自潛防寒衣 1.5mm-深水迷彩', 'product_219_1733137331_8.jpg', 0, 0),
(1042, 219, 'BODY-FIT CAMO SUIT自潛防寒衣 1.5mm-深水迷彩', 'product_219_1733137331_9.jpg', 0, 0),
(1043, 220, 'Carbon Rock 漁獵防寒衣3mm', 'product_220_1733137362_0.jpg', 1, 0),
(1044, 220, 'Carbon Rock 漁獵防寒衣3mm', 'product_220_1733137362_1.jpg', 0, 0),
(1045, 220, 'Carbon Rock 漁獵防寒衣3mm', 'product_220_1733137362_2.jpg', 0, 0),
(1046, 220, 'Carbon Rock 漁獵防寒衣3mm', 'product_220_1733137362_3.jpg', 0, 0),
(1047, 220, 'Carbon Rock 漁獵防寒衣3mm', 'product_220_1733137362_4.jpg', 0, 0),
(1048, 220, 'Carbon Rock 漁獵防寒衣3mm', 'product_220_1733137362_5.jpg', 0, 0),
(1049, 220, 'Carbon Rock 漁獵防寒衣3mm', 'product_220_1733137362_6.jpg', 0, 0),
(1050, 220, 'Carbon Rock 漁獵防寒衣3mm', 'product_220_1733137362_7.jpg', 0, 0),
(1051, 220, 'Carbon Rock 漁獵防寒衣3mm', 'product_220_1733137362_8.jpg', 0, 0),
(1052, 221, 'MIMETIC 3D長袖水母衣-岩石迷彩', 'product_221_1733137395_0.jpg', 1, 0),
(1053, 221, 'MIMETIC 3D長袖水母衣-岩石迷彩', 'product_221_1733137395_1.jpg', 0, 0),
(1054, 221, 'MIMETIC 3D長袖水母衣-岩石迷彩', 'product_221_1733137395_2.jpg', 0, 0),
(1055, 221, 'MIMETIC 3D長袖水母衣-岩石迷彩', 'product_221_1733137395_3.jpg', 0, 0),
(1056, 221, 'MIMETIC 3D長袖水母衣-岩石迷彩', 'product_221_1733137395_4.jpg', 0, 0),
(1057, 222, 'MIX 3D自潛防寒衣  海底偽裝迷彩 _3mm', 'product_222_1733137423_0.jpg', 1, 0),
(1058, 222, 'MIX 3D自潛防寒衣  海底偽裝迷彩 _3mm', 'product_222_1733137423_1.jpg', 0, 0),
(1059, 222, 'MIX 3D自潛防寒衣  海底偽裝迷彩 _3mm', 'product_222_1733137423_2.jpg', 0, 0),
(1060, 222, 'MIX 3D自潛防寒衣  海底偽裝迷彩 _3mm', 'product_222_1733137423_3.jpg', 0, 0),
(1061, 222, 'MIX 3D自潛防寒衣  海底偽裝迷彩 _3mm', 'product_222_1733137423_4.jpg', 0, 0),
(1062, 222, 'MIX 3D自潛防寒衣  海底偽裝迷彩 _3mm', 'product_222_1733137423_5.jpg', 0, 0),
(1063, 223, 'MIX 3D自潛防寒衣  海底偽裝迷彩 _5mm', 'product_223_1733137459_0.jpg', 1, 0),
(1064, 223, 'MIX 3D自潛防寒衣  海底偽裝迷彩 _5mm', 'product_223_1733137459_1.jpg', 0, 0),
(1065, 223, 'MIX 3D自潛防寒衣  海底偽裝迷彩 _5mm', 'product_223_1733137459_2.jpg', 0, 0),
(1066, 223, 'MIX 3D自潛防寒衣  海底偽裝迷彩 _5mm', 'product_223_1733137459_3.jpg', 0, 0),
(1067, 223, 'MIX 3D自潛防寒衣  海底偽裝迷彩 _5mm', 'product_223_1733137459_4.jpg', 0, 0),
(1068, 223, 'MIX 3D自潛防寒衣  海底偽裝迷彩 _5mm', 'product_223_1733137459_5.jpg', 0, 0),
(1069, 224, 'PYTHON 自潛防寒衣 3.5mm 岩石迷彩款', 'product_224_1733137493_0.jpg', 1, 0),
(1070, 224, 'PYTHON 自潛防寒衣 3.5mm 岩石迷彩款', 'product_224_1733137493_1.jpg', 0, 0),
(1071, 224, 'PYTHON 自潛防寒衣 3.5mm 岩石迷彩款', 'product_224_1733137493_2.jpg', 0, 0),
(1072, 224, 'PYTHON 自潛防寒衣 3.5mm 岩石迷彩款', 'product_224_1733137493_3.jpg', 0, 0),
(1073, 224, 'PYTHON 自潛防寒衣 3.5mm 岩石迷彩款', 'product_224_1733137493_4.jpg', 0, 0),
(1074, 225, 'REEF CAMU自潛防寒衣(3D珊瑚迷彩)_3mm', 'product_225_1733137525_0.jpg', 1, 0),
(1075, 225, 'REEF CAMU自潛防寒衣(3D珊瑚迷彩)_3mm', 'product_225_1733137525_1.jpg', 0, 0),
(1076, 226, 'YEMAYA BLUE DEEP LADY 二件式防寒衣_ 5mm (女款)', 'product_226_1733137556_0.jpg', 1, 0),
(1077, 226, 'YEMAYA BLUE DEEP LADY 二件式防寒衣_ 5mm (女款)', 'product_226_1733137556_1.jpg', 0, 0);

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
(1, '台北市信義區信義路五段7號', '宅配', 'processing'),
(2, '新北市板橋區文化路一段25號', '宅配', 'completed'),
(3, '台中市西區民生路一段99號', '宅配', 'processing');

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
(1, 1, 23, 1, 1350.00),
(2, 1, 26, 1, 3080.00),
(3, 2, 27, 2, 2400.00),
(4, 3, 28, 1, 2580.00);

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
(35, 26, 2, NULL, 2, 1, 1),
(36, 27, 1, NULL, 1, 1, 1),
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
(91, 82, 1, NULL, 1, 1, 0),
(92, 83, 0, NULL, 0, 1, 0),
(93, 84, 0, NULL, 0, 1, 0),
(94, 85, 0, NULL, 0, 1, 0),
(95, 86, 0, NULL, 0, 59, 0),
(96, 87, 0, NULL, 0, 1, 0),
(97, 88, 0, NULL, 0, 1, 0),
(98, 89, 0, NULL, 0, 1, 0),
(99, 90, 0, NULL, 0, 1, 0),
(100, 91, 0, NULL, 0, 1, 0),
(101, 92, 0, NULL, 0, 52, 0),
(102, 93, 0, NULL, 0, 52, 0),
(103, 94, 0, NULL, 0, 36, 0),
(104, 95, 0, NULL, 0, 52, 0),
(105, 96, 0, NULL, 0, 14, 0),
(106, 97, 0, NULL, 0, 14, 0),
(107, 98, 0, NULL, 0, 14, 0),
(108, 99, 0, NULL, 0, 39, 0),
(109, 100, 0, NULL, 0, 39, 0),
(110, 101, 0, NULL, 0, 31, 0),
(111, 102, 0, NULL, 0, 16, 0),
(112, 103, 0, NULL, 0, 16, 0),
(113, 104, 0, NULL, 0, 16, 0),
(114, 105, 0, NULL, 0, 65, 0),
(115, 106, 0, NULL, 0, 36, 0),
(116, 107, 0, NULL, 0, 41, 0),
(117, 108, 0, NULL, 0, 65, 0),
(118, 109, 0, NULL, 0, 23, 0),
(119, 110, 0, NULL, 0, 23, 0),
(120, 111, 0, NULL, 0, 29, 0),
(121, 112, 0, NULL, 0, 29, 0),
(122, 113, 0, NULL, 0, 29, 0),
(123, 114, 0, NULL, 0, 29, 0),
(124, 115, 0, NULL, 0, 29, 0),
(125, 116, 0, NULL, 0, 29, 0),
(126, 117, 0, NULL, 0, 29, 0),
(127, 118, 0, NULL, 0, 29, 0),
(128, 119, 0, NULL, 0, 29, 0),
(129, 120, 0, NULL, 0, 29, 0),
(130, 121, 0, NULL, 0, 25, 0),
(131, 122, 0, NULL, 0, 25, 0),
(132, 123, 0, NULL, 0, 25, 0),
(133, 124, 0, NULL, 0, 25, 0),
(134, 125, 0, NULL, 0, 25, 0),
(135, 126, 0, NULL, 0, 25, 0),
(136, 127, 0, NULL, 0, 25, 0),
(137, 128, 0, NULL, 0, 25, 0),
(138, 129, 0, NULL, 0, 25, 0),
(139, 130, 0, NULL, 0, 25, 0),
(140, 131, 0, NULL, 0, 36, 0),
(141, 132, 0, NULL, 0, 36, 0),
(142, 133, 0, NULL, 0, 36, 0),
(143, 134, 0, NULL, 0, 41, 0),
(144, 135, 0, NULL, 0, 36, 0),
(145, 136, 0, NULL, 0, 36, 0),
(146, 137, 0, NULL, 0, 36, 0),
(147, 138, 0, NULL, 0, 63, 0),
(148, 139, 0, NULL, 0, 63, 0),
(149, 140, 0, NULL, 0, 9, 0),
(150, 141, 0, NULL, 0, 36, 0),
(151, 142, 0, NULL, 0, 41, 0),
(152, 143, 0, NULL, 0, 36, 0),
(153, 144, 0, NULL, 0, 36, 0),
(154, 145, 0, NULL, 0, 16, 0),
(155, 146, 0, NULL, 0, 16, 0),
(156, 147, 0, NULL, 0, 36, 0),
(157, 148, 0, NULL, 0, 36, 0),
(158, 149, 0, NULL, 0, 41, 0),
(159, 150, 0, NULL, 0, 41, 0),
(160, 151, 0, NULL, 0, 36, 0),
(161, 152, 0, NULL, 0, 41, 0),
(162, 153, 0, NULL, 0, 54, 0),
(163, 154, 0, NULL, 0, 36, 0),
(164, 155, 0, NULL, 0, 36, 0),
(165, 156, 0, NULL, 0, 9, 0),
(166, 157, 0, NULL, 0, 36, 0),
(167, 158, 0, NULL, 0, 36, 0),
(168, 159, 0, NULL, 0, 36, 0),
(169, 160, 0, NULL, 0, 36, 0),
(170, 161, 0, NULL, 0, 36, 0),
(171, 162, 0, NULL, 0, 36, 0),
(172, 163, 0, NULL, 0, 36, 0),
(173, 164, 0, NULL, 0, 36, 0),
(174, 165, 0, NULL, 0, 36, 0),
(175, 166, 0, NULL, 0, 36, 0),
(176, 167, 0, NULL, 0, 36, 0),
(177, 168, 0, NULL, 0, 9, 0),
(178, 169, 0, NULL, 0, 9, 0),
(179, 170, 0, NULL, 0, 9, 0),
(180, 171, 0, NULL, 0, 36, 0),
(181, 172, 0, NULL, 0, 9, 0),
(182, 173, 0, NULL, 0, 9, 0),
(183, 174, 0, NULL, 0, 9, 0),
(184, 175, 0, NULL, 0, 36, 0),
(185, 176, 0, NULL, 0, 36, 0),
(186, 177, 0, NULL, 0, 36, 0),
(187, 178, 0, NULL, 0, 36, 0),
(188, 179, 0, NULL, 0, 36, 0),
(189, 180, 0, NULL, 0, 36, 0),
(190, 181, 0, NULL, 0, 36, 0),
(191, 182, 0, NULL, 0, 36, 0),
(192, 183, 0, NULL, 0, 36, 0),
(193, 184, 0, NULL, 0, 36, 0),
(194, 185, 0, NULL, 0, 31, 0),
(195, 186, 0, NULL, 0, 31, 0),
(196, 187, 0, NULL, 0, 36, 0),
(197, 188, 0, NULL, 0, 17, 0),
(198, 189, 0, NULL, 0, 17, 0),
(199, 190, 0, NULL, 0, 36, 0),
(200, 191, 0, NULL, 0, 15, 0),
(201, 192, 0, NULL, 0, 17, 0),
(202, 193, 0, NULL, 0, 17, 0),
(203, 194, 0, NULL, 0, 36, 0),
(204, 195, 0, NULL, 0, 59, 0),
(205, 196, 0, NULL, 0, 59, 0),
(206, 197, 0, NULL, 0, 59, 0),
(207, 198, 0, NULL, 0, 36, 0),
(208, 199, 0, NULL, 0, 36, 0),
(209, 200, 0, NULL, 0, 36, 0),
(210, 201, 0, NULL, 0, 36, 0),
(211, 202, 0, NULL, 0, 36, 0),
(212, 203, 0, NULL, 0, 36, 0),
(213, 204, 0, NULL, 0, 15, 0),
(214, 205, 0, NULL, 0, 17, 0),
(215, 206, 0, NULL, 0, 17, 0),
(216, 207, 0, NULL, 0, 59, 0),
(217, 208, 0, NULL, 0, 59, 0),
(218, 209, 0, NULL, 0, 59, 0),
(219, 210, 0, NULL, 0, 36, 0),
(220, 211, 0, NULL, 0, 17, 0),
(221, 212, 0, NULL, 0, 17, 0),
(222, 213, 0, NULL, 0, 9, 0),
(223, 214, 0, NULL, 0, 63, 0),
(224, 215, 0, NULL, 0, 63, 0),
(225, 216, 0, NULL, 0, 9, 0),
(226, 217, 0, NULL, 0, 59, 0),
(227, 218, 0, NULL, 0, 56, 0),
(228, 219, 0, NULL, 0, 54, 0),
(229, 220, 0, NULL, 0, 17, 0),
(230, 221, 0, NULL, 0, 41, 0),
(231, 222, 0, NULL, 0, 41, 0),
(232, 223, 0, NULL, 0, 41, 0),
(233, 224, 0, NULL, 0, 54, 0),
(234, 225, 0, NULL, 0, 56, 0),
(235, 226, 0, NULL, 0, 56, 0);

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
(1, 'processing', 2100.00, '2024-01-01', '2024-01-05'),
(2, 'completed', 1590.00, '2024-01-06', '2024-01-10'),
(3, 'processing', 8700.00, '2024-01-11', '2024-01-15');

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
(1, 1, 1, '2024-01-01', '2024-01-05', 2100.00),
(2, 2, 2, '2024-01-06', '2024-01-10', 1590.00),
(3, 3, 3, '2024-01-11', '2024-01-15', 8700.00);

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
(4, '電子裝備/專業配件', ''),
(5, '防寒衣物', ''),
(6, '包包攜行', ''),
(7, '魚槍/配件', ''),
(8, '生活小物', '');

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
(12, '橡膠蛙鞋', NULL, 2),
(13, '塑膠蛙鞋', NULL, 2),
(14, '單蹼', NULL, 2),
(15, '導水條/螺絲零件', NULL, 2),
(16, '挖鞋組裝服務', NULL, 2),
(17, '浮具', NULL, 3),
(18, '配重', NULL, 3),
(19, '鼻夾', NULL, 3),
(20, '照明', NULL, 3),
(21, '潛水刀', NULL, 3),
(22, '安全繩', NULL, 3),
(23, '其他/訓練小物', NULL, 3),
(24, '潛水電腦錶', NULL, 4),
(25, 'GOPRO', NULL, 4),
(26, '水中推進器', NULL, 4),
(27, '配件/其他', NULL, 4),
(28, '泳衣款防寒衣', NULL, 5),
(29, '自潛一件式防寒衣', NULL, 5),
(30, '自潛兩件式防寒衣', NULL, 5),
(31, '迷彩系列防寒衣', NULL, 5),
(32, '水肺溼式防寒衣', NULL, 5),
(33, '水肺乾式防寒衣', NULL, 5),
(34, '帽類/頭套', NULL, 5),
(35, '外套/毛巾衣', NULL, 5),
(36, '上衣', NULL, 5),
(37, '手套', NULL, 5),
(38, '下著', NULL, 5),
(39, '襪套', NULL, 5),
(40, '套鞋', NULL, 5),
(41, '零件/其他', NULL, 5),
(42, '長蛙鞋袋', NULL, 6),
(43, '短蛙鞋袋', NULL, 6),
(44, '單蹼蛙鞋袋', NULL, 6),
(45, '後背包', NULL, 6),
(46, '單肩包', NULL, 6),
(47, '腰包/防水機能袋', NULL, 6),
(48, '裝備袋/箱', NULL, 6),
(49, '配件/其他6', NULL, 6),
(50, '魚槍', NULL, 7),
(51, '魚鏢', NULL, 7),
(52, '橡皮', NULL, 7),
(53, '線繩', NULL, 7),
(54, '捲線器', NULL, 7),
(55, '其他', NULL, 7),
(56, '生活相關', NULL, 8),
(57, '戶外生活', NULL, 8),
(58, '休閒服飾', NULL, 8),
(59, '優惠票券', NULL, 8),
(60, '相關書籍', NULL, 8),
(61, '防水盒/口罩', NULL, 8),
(62, '飾品', NULL, 8),
(63, '貼紙', NULL, 8);

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
(1, 1, '', 'uploads/1733124472_9221.jpg', 1, 1),
(2, 1, '', 'uploads/1733124472_6078.jpg', 0, 1),
(3, 1, '', 'uploads/1733124472_4846.jpg', 0, 1),
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
(88, 25, '', 'uploads/1733127703_2162.jpg', 0, 0),
(89, 26, '', 'uploads/1733189627_8946.jpg', 1, 0),
(90, 26, '', 'uploads/1733189627_9261.jpg', 0, 0),
(91, 27, '', 'uploads/1733191576_6648.jpg', 1, 0),
(92, 27, '', 'uploads/1733191576_5240.jpg', 0, 0),
(93, 27, '', 'uploads/1733191576_9811.jpg', 0, 0),
(94, 27, '', 'uploads/1733191576_3835.jpg', 0, 0),
(95, 27, '', 'uploads/1733193741_7347.jpg', 1, 0),
(96, 28, '', 'uploads/1733193807_5779.jpg', 1, 0),
(97, 28, '', 'uploads/1733193807_5925.jpg', 0, 0),
(98, 28, '', 'uploads/1733193807_4409.jpg', 0, 0),
(99, 28, '', 'uploads/1733193807_4637.jpg', 0, 0),
(100, 30, '', 'uploads/1733209626_2001.jpg', 1, 1),
(101, 30, '', 'uploads/1733209626_8745.jpg', 0, 1),
(102, 30, '', 'uploads/1733209626_7877.jpg', 0, 1),
(103, 30, '', 'uploads/1733209626_3654.jpg', 0, 1),
(104, 30, '', 'uploads/1733209626_2298.jpg', 0, 1),
(105, 30, '', 'uploads/1733209626_3903.jpg', 0, 1),
(106, 30, '', 'uploads/1733209626_8932.jpg', 0, 1),
(107, 30, '', 'uploads/1733209626_9767.jpg', 0, 1),
(108, 30, '', 'uploads/1733209626_6940.jpg', 0, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `rent_item`
--

CREATE TABLE `rent_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `rent_category_small_id` int(10) DEFAULT NULL COMMENT '關聯小分類表',
  `rent_category_big_id` int(10) DEFAULT NULL COMMENT '關聯大分類表',
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

INSERT INTO `rent_item` (`id`, `rent_category_small_id`, `rent_category_big_id`, `name`, `price`, `type`, `description`, `stock`, `start_date`, `end_date`, `deposit`, `is_deleted`) VALUES
(1, 1, 1, 'TRYGONS - 液態面鏡', 3500, NULL, '能保有正常水下視野，並省去面鏡平壓的空氣消耗\r\n外圍膠框以亞洲人臉型掃描製作，合臉度更佳；亦可自行打磨增加貼合\r\n搭配鼻夾使用，平衡耳壓更輕鬆\r\n\r\n・內含二顆凸透鏡，依潛水員瞳孔位置膠黏於膠框即完成安裝。\r\n・原廠安裝影片 https://www.youtube.com/watch?v=b3vZCzKmWOs', 5, '2024-12-02 00:00:00', NULL, 2100, 0),
(2, 1, 1, 'AQUA LUNG - SPHERA X 低容積面鏡', 2650, NULL, 'SPHERA X 新改版\r\n寬視野x低容積\r\n​運動性能優異的自由潛水面鏡 \r\n裙邊採舒適矽膠，柔軟更合臉、捏鼻更順手\r\n透明白款採鍍膜鏡片，防霧 x 耐刮 x 紫外線防護，接近180度的寬廣視野\r\n\r\n・標配環保EVA抗腐蝕拉鍊盒', 3, '2024-12-02 00:00:00', NULL, 1590, 0),
(3, 1, 1, 'APOLLO - BIO METAL PRO 手工拋光鏡框(經典海龍王)', 14500, 'Nippon Sensuiki Co., Ltd.', '為享譽盛名的高階面鏡-自潛、水肺皆可用，更是專業首選\r\n高強度、高耐用度，銀色邊框帥氣有型\r\n專利寬視野-高強度鏡框讓左右鏡片間距拉近至7mm，視野無阻礙 \r\nTYPE A低容積-為系列款式內容積最低(60cc) \r\n可依需求選配多款器材(如手電筒、運動攝影機等)', 1, '2024-12-02 02:49:00', NULL, 8700, 0),
(4, 1, 1, 'APOLLO - BIO METAL 多彩鋁合金鏡框(平民海龍王)', 7800, 'Nippon Sensuiki Co., Ltd.', 'BIO-METAL PRO為APOLLO享譽盛名的高階面鏡-本款BIO METAL為輕量化鋁合金鏡框版本，繽紛色彩；自潛、水肺皆可用\r\n鋁合金鏡框輕量、多彩、高強度；柔軟群邊，平壓順手\r\n專利寬視野-高強度鏡框讓左右鏡片間距拉近至7mm，視野無阻礙 \r\nTYPE A低容積-為系列款式內容積最低(60cc)', 0, '2024-12-02 02:49:00', NULL, 4680, 0),
(5, 1, 1, 'BEUCHAT - MAXLUX S 單片式面鏡', 2380, 'BEUCHAT', '無邊框設計，減少重量與體積，攜帶輕鬆。\r\n全景視野無阻隔，水中世界一覽無遺\r\n浮潛/水肺/自由潛水皆適用\r\n可搭配同色SPY軟式呼吸管\r\n\r\n・商品介紹\r\n-面鏡內容積：約127cm3', 0, '2024-12-02 02:51:00', NULL, 1428, 0),
(6, 1, 1, 'C4 -Condor Mask 低容積面鏡', 2550, NULL, '專為在任何類型的潛水活動中實現最佳性能而開發，適用自由潛水、魚獵、浮潛或水肺潛水。\r\n低容積搭配廣闊視野，使潛水員有更好的體驗，柔軟的矽膠裙邊，提供更好的服貼性及舒適度。\r\n\r\n・商品介紹\r\n-寬度：148 mm\r\n-高度：102 mm\r\n-內部容積：90 cm³\r\n\r\n・表面採水轉印技術印刷，圖案會隨著特定部位的磨耗造成色落情形，皆屬正常現象、無法認定為瑕疵，還請知悉。', 0, '2024-12-02 00:00:00', '2024-12-03 00:56:00', 1530, 0),
(7, 1, 1, 'C4 - PLASMA 低容積面鏡', 1450, 'C4', '超耐磨鋼化玻璃，良好的視野和低內部容積\r\n裙邊採柔軟矽膠製成，密合度佳\r\n搭配同色系呼吸管，帥度再上一層', 5, '2024-12-02 02:52:00', NULL, 870, 0),
(8, 1, 1, 'C4 - FALCON 低容積面鏡(黑)', 1750, 'C4', '由著名的潛水裝備設計師Enrico Sala構思設計，專用於自由潛水，搭配同色系呼吸管，帥度再上一層。\r\n \r\n・商品介紹\r\n-低容積提升潛水表現。\r\n-扣環連接裙邊，配戴更服貼。\r\n-墊圈和天鵝絨，提升密封性及舒適度。\r\n-流線造型降低深潛和快速上升中的拉力影響。\r\n-視野寬廣 - 對於漁獵幫助甚大。\r\n-寬度：137 mm\r\n-高度：100 mm\r\n-內部容積：95 cm³', 0, '2024-12-02 02:52:00', NULL, 1050, 0),
(9, 1, 1, 'IST - HUNTER低容積面鏡', 1200, 'IST', '超低內容積設計，頂級柔軟的矽膠面罩，配帶舒適又貼臉，視野更寬廣、更清晰\r\n漁獵、攝影或自由潛水者的最佳選擇\r\n體積小可摺疊置于救生衣口袋內作為備用\r\n邊扣調整容易\r\n\r\n・可替換以下光學鏡片\r\n- OL203(近視強化鏡片)：100 ~ 600度 (每50度一單位)', 0, '2024-12-02 02:53:00', NULL, 720, 0),
(10, 1, 1, 'IST - HUNTER低容積面鏡/ 防霧鏡片', 1700, 'IST', '超低內容積設計，頂級柔軟的矽膠面罩，配帶舒適又貼臉，視野更寬廣、更清晰\r\n漁獵、攝影或自由潛水者的最佳選擇\r\n體積小可摺疊置于救生衣口袋內作為備用\r\n邊扣調整容易\r\n\r\n・使用前請先將薄膜撕下，以清水沖洗過後即可使用。\r\n・請勿再以牙膏/火烤等方式處理鏡面。', 6, '2024-12-02 02:53:00', NULL, 1020, 0),
(11, 1, 1, 'IST - CORONA潛水面鏡', 950, 'IST', '電鍍外框，時尚美觀、提升耐用度\r\n旋轉式邊扣易操作，柔軟的矽膠裙邊，舒適貼合臉型。\r\n\r\n可替換以下光學鏡片\r\n- OL-55(近視強化鏡片)：100 ~ 800度\r\n- OL-55M(電鍍近視強化鏡片)：100 ~ 800度 \r\n- OL-55+(老花鏡片)：100 ~ 400度 \r\n※以上鏡片每50度一單位', 0, '2024-12-02 02:53:00', NULL, 570, 0),
(12, 1, 1, 'IST - PANORAMA 鋁合金潛水面鏡', 1800, 'IST', '6000系列鋁合金陽極電鍍處理鏡框，質輕視野廣，堅固耐用\r\n\r\n可替換以下光學鏡片\r\n- OL-55(近視強化鏡片)：100 ~ 800度\r\n- OL-55M(電鍍近視強化鏡片)：100 ~ 800度 \r\n- OL-55+(老花鏡片)：100 ~ 400度 \r\n※以上鏡片每50度一單位', 0, '2024-12-02 02:53:00', NULL, 1080, 0),
(13, 1, 1, 'IST M100 PANORAMA 鋁合金雙面鏡 炫彩 堅韌 質感 (BK)', 1800, 'IST', '缺貨中', 0, '2024-12-02 02:54:00', NULL, 1080, 0),
(14, 1, 1, 'LEADERFINS - L1單鏡片面鏡', 800, 'LEADERFINS', '無框面膜由柔軟的 100% 矽膠製成。\r\n鋼化玻璃鏡片\r\n極佳的舒適度和寬廣的視角\r\n快速調節帶扣。\r\n輕便、可折疊、易於存放。\r\n無邊框面鏡能夠在不影響寬視角的情況下減小內部體積，非常適合自由潛水和魚叉捕魚。', 0, '2024-12-02 02:54:00', '2024-12-03 00:59:00', 480, 0),
(15, 1, 1, 'LEADERFINS - L2低容積面鏡', 800, 'LEADERFINS', '無框面膜由柔軟的 100% 矽膠製成。\r\n鋼化玻璃鏡片\r\n極佳的舒適度和寬廣的視角\r\n輕便、可折疊、易於存放。', 0, '2024-12-02 02:55:00', NULL, 480, 0),
(16, 1, 1, 'LEADERFINS - 自由潛水面鏡呼吸管組 (黑)', 1250, 'LEADERFINS', '極低內容積，非常適合自由潛水使用，\r\n鏡片採廣角弧度設計，兼具視野及低容積的需求。\r\n較大面積的矽膠面鏡帶 , 為頭部帶來了穩定的感受並能夠分散後腦杓壓力。 \r\n隨附的呼吸管附有高低可調固定扣 , 可輕鬆將呼吸管及咬嘴調整至適合的位置。\r\n管身及咬嘴使用高度柔軟材質 , 能為潛水員帶來舒適感受並增加貼合性。\r\n鏡框及呼吸管身採霧面處理 , 不易殘留水痕並具有低調光澤感。', 8, '2024-12-02 02:55:00', NULL, 750, 0),
(17, 1, 1, 'LEADERFINS - 自由潛水面鏡呼吸管組 (白)', 1250, 'LEADERFINS', '極低內容積，非常適合自由潛水使用，\r\n鏡片採廣角弧度設計，兼具視野及低容積的需求。\r\n較大面積的矽膠面鏡帶 , 為頭部帶來了穩定的感受並能夠分散後腦杓壓力。 \r\n隨附的呼吸管附有高低可調固定扣 , 可輕鬆將呼吸管及咬嘴調整至適合的位置。\r\n管身及咬嘴使用高度柔軟材質 , 能為潛水員帶來舒適感受並增加貼合性。\r\n鏡框及呼吸管身採霧面處理 , 不易殘留水痕並具有低調光澤感。', 9, '2024-12-02 02:56:00', NULL, 750, 0),
(18, 1, 1, 'MARES - STAR LIQUIDSKIN 低容積面鏡', 2480, 'MARES', '寬視野x低容積，運動性能優異的自由潛水面鏡 \r\n複合矽膠裙邊，柔軟舒適/密合度佳/捏鼻平壓更順手', 0, '2024-12-02 02:56:00', NULL, 1488, 0),
(19, 1, 1, 'MOLCHANOVS - CORE Freediving Mask 抹茶自由潛水面鏡', 1500, 'MOLCHANOVS', 'CORE Freediving Mask由柔軟的矽膠製成，具絕佳的舒適性。塑膠框架包裹著曲面透明樹脂鏡片，提供廣闊視野。\r\n此款面鏡之間的距離為14公分。\r\n\r\n・商品介紹\r\n-材質：軟矽膠裙邊；耐用塑膠框架；透明樹脂鏡片\r\n-重量：270公克', 0, '2024-12-02 02:57:00', NULL, 900, 0),
(20, 7, 2, 'TRYGONS RX全碳纖維長蛙鞋', 9500, 'TRYGONS', '全碳纖維設計，重量較複合材料減輕14% \r\n獨家流體力學優勢，傳動效率再提升 \r\n調整帶式腳套，力量傳遞更直接\r\n・商品介紹\r\n-含腳套尺寸84 x 19.5cm', 1, '2024-12-02 02:59:00', NULL, 5700, 0),
(21, 7, 2, 'LEADERFINS 全碳纖維長蛙板：迷幻未來 FUTURIC', 10600, 'LEADERFINS', '極高CP值，加購腳套優雅升級碳纖維 \r\n平民版碳纖維，低總價高性能 \r\n尺寸完整，小腳女孩輕鬆著用\r\n・商品介紹\r\n-裸板尺寸80 x 20cm\r\n-腳套搭配建議: LEADERFINS - FORZA (螺絲組裝)\r\n-不同批生產之LEADERFINS蛙鞋板軟硬度可能略有差異，還請知悉', 1, '2024-12-02 02:59:00', '2024-12-03 10:13:00', 6360, 0),
(22, 7, 2, 'LEADERFINS 全碳纖維長蛙板：碳纖碧波', 6800, 'LEADERFINS', '極高CP值，加購腳套優雅升級碳纖維 \r\n平民版碳纖維，低總價高性能 \r\n尺寸完整，小腳女孩輕鬆著用\r\n・商品介紹\r\n-裸板尺寸80 x 20cm\r\n-腳套搭配建議: LEADERFINS - FORZA (螺絲組裝)\r\n-不同批生產之LEADERFINS蛙鞋板軟硬度可能略有差異，還請知悉', 0, '2024-12-02 03:00:00', NULL, 4080, 0),
(23, 7, 2, 'LEADERFINS 全碳纖維長蛙板：碳纖藍波', 6800, 'LEADERFINS', '極高CP值，加購腳套優雅升級碳纖維 \r\n平民版碳纖維，低總價高性能 \r\n尺寸完整，小腳女孩輕鬆著用\r\n・商品介紹\r\n-裸板尺寸80 x 20cm\r\n-腳套搭配建議: LEADERFINS - FORZA (螺絲組裝)\r\n-不同批生產之LEADERFINS蛙鞋板軟硬度可能略有差異，還請知悉', 0, '2024-12-02 03:00:00', NULL, 4080, 0),
(24, 7, 2, 'C4 ALLBLACK HT碳纖維長蛙鞋板', 14200, 'C4', '板面採TR50碳纖維結構，大方格彈性再升級 \r\nDPC雙拋物線技術，擺動幅度再延伸 \r\n加長板身，大深度移動自如 \r\n・商品介紹\r\n-裸版尺寸:87 x 19.5cm\r\n-腳套搭配建議:C4 - 300/C4 - 400(螺絲組裝)', 1, '2024-12-02 03:01:00', NULL, 8520, 0),
(25, 7, 2, 'C4 DEEP SPEARO HT 碳纖維長蛙板', 6800, 'C4', '板面採大型網格(Big Square)結構，降低水阻 \r\nDPC雙拋物線技術，擺動幅度再延伸 \r\n加大鞋板折角(達29度)，雙腳擺動更輕鬆\r\n・商品介紹\r\n-裸版尺寸90 x 20cm\r\n-商品未含腳套，腳套搭配建議:C4 - SCARPE(螺絲組裝)', 0, '2024-12-02 03:01:00', NULL, 4080, 0),
(26, 7, 2, 'C4 FAST 400 碳纖維長蛙鞋板', 10400, NULL, NULL, NULL, '2024-12-03 09:33:00', NULL, 6240, 0),
(27, 2, 1, 'GULL - MANTIS LV 潛水面鏡', 5500, NULL, '東方版型-GULL經典高階款式，特別適合亞洲人種 \r\n增豔抗UV-鏡片塗層阻擋UVA達80％，減少光線散射，視覺效果更好 \r\n舒適配戴-100%軟矽膠裙邊，配戴舒適無壓迫 \r\n日規高品質', 2, '2024-12-03 10:33:00', NULL, 3300, 0),
(28, 2, 1, 'BEUCHAT - SUPER COMPENSATOR SILICON 單片式面鏡 無框設計/全景視野', 2550, NULL, '寬闊視野-單片圓鏡款式，提供更廣闊之視野 \r\n平壓容易-鼻下方内凹設計，平壓更輕鬆 \r\n舒適配戴-100%軟矽膠裙邊，配戴舒適無壓\r\n浮潛/水肺/自由潛水皆適用', 1, '2024-12-03 10:16:00', NULL, 1530, 0),
(29, 56, 8, '123', 456, NULL, '999', 0, '2024-12-03 11:56:00', NULL, 274, 0),
(30, 2, 1, 'APOLLO - BIO METAL 多彩鋁合金鏡框(平民海龍王)', 7800, NULL, 'BIO-METAL PRO為APOLLO享譽盛名的高階面鏡-本款BIO METAL為輕量化鋁合金鏡框版本，繽紛色彩；自潛、水肺皆可用\r\n鋁合金鏡框輕量、多彩、高強度；柔軟群邊，平壓順手\r\n專利寬視野-高強度鏡框讓左右鏡片間距拉近至7mm，視野無阻礙 \r\nTYPE A低容積-為系列款式內容積最低(60cc)', 1, '2024-12-03 15:05:00', NULL, 4680, 0);

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
(2, 's'),
(3, 'L'),
(4, 'XL'),
(5, '2XL'),
(6, '3XL'),
(7, '2XSTT'),
(8, 'XSTT'),
(9, 'STT'),
(10, 'MTT'),
(11, 'LTT'),
(12, 'XLTT'),
(13, '31-32'),
(14, '33-34'),
(15, '35-36'),
(16, '37-38'),
(17, '39-40'),
(18, '41-42'),
(19, '43-44'),
(20, '45-46'),
(21, '47-48'),
(22, '49-50');

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
(1, '王小明', '0912322658', 'ming0908@test.com', 'ming0908', 'Ming0908', '2000-09-08', '桃園市中壢區新生路一段421號', '2024-11-22 11:24:32', '2024-12-03 14:59:35', 2, NULL, NULL, 0, 1, 0),
(2, '李佳穎', '0928374629', 'jiaying0905@test.com', 'jia0905', 'Jia0905', '1995-05-20', '台北市大安區和平東路二段35號', '2024-11-22 11:24:32', '', 0, NULL, NULL, 1, 0, 0),
(3, '張志豪', '0987123456', 'zhihao0803@test.com', 'zhi0803', 'Zhi0803', '1987-03-12', '高雄市左營區自由二路102號', '2024-11-22 11:24:32', '2024-12-03 11:19:36', 1, NULL, NULL, 0, 0, 0),
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
(52, '姚馨雯', '', 'news@test.com', 'news', '81dc9bdb52d04dc20036dbd8313ed055', '2000-11-01', NULL, '2024-11-29 15:05:02', '', 0, NULL, NULL, 0, 0, 0),
(53, '妙蛙種子', '', 'frog@test.com', 'frog', '938c2cc0dcc05f2b68c4287040cfcf71', '2024-12-11', NULL, '2024-12-03 11:22:43', '', 0, NULL, NULL, 0, 0, 0);

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
-- 資料表索引 `rent_category_big`
--
ALTER TABLE `rent_category_big`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `rent_category_small`
--
ALTER TABLE `rent_category_small`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_category_big`
--
ALTER TABLE `activity_category_big`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_category_small`
--
ALTER TABLE `activity_category_small`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_image`
--
ALTER TABLE `activity_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_orders`
--
ALTER TABLE `activity_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_teacher`
--
ALTER TABLE `activity_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_teacher_image`
--
ALTER TABLE `activity_teacher_image`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activity_teacher_specialty`
--
ALTER TABLE `activity_teacher_specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `article`
--
ALTER TABLE `article`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `article_image`
--
ALTER TABLE `article_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `color`
--
ALTER TABLE `color`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `material`
--
ALTER TABLE `material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_category_big`
--
ALTER TABLE `product_category_big`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_category_small`
--
ALTER TABLE `product_category_small`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1083;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_orders`
--
ALTER TABLE `product_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_order_items`
--
ALTER TABLE `product_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_specification`
--
ALTER TABLE `product_specification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `rental_orders`
--
ALTER TABLE `rental_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `rental_order_items`
--
ALTER TABLE `rental_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `rent_category_big`
--
ALTER TABLE `rent_category_big`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `rent_category_small`
--
ALTER TABLE `rent_category_small`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `rent_image`
--
ALTER TABLE `rent_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `rent_item`
--
ALTER TABLE `rent_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `size`
--
ALTER TABLE `size`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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

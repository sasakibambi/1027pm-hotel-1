-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-10-27 05:58:31
-- サーバのバージョン： 10.4.18-MariaDB
-- PHP のバージョン: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `bord_de_mer`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `kind` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `inquiry`
--

INSERT INTO `inquiry` (`id`, `name`, `mail`, `kind`, `comment`) VALUES
(1, 'やまだ　はなこ', 'mail2@mail.co.jp', 1, '更新できるかのテストです。'),
(2, 'やまだ　たろう', 'taro@mail.co.jp', 2, 'テストです。\r\nテストです。'),
(13, 'とりさん', 'torisan@mail.com', 2, 'ああああ');

-- --------------------------------------------------------

--
-- テーブルの構造 `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp(),
  `open_date` date NOT NULL DEFAULT current_timestamp(),
  `title` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT 1 COMMENT '１が公開、0は下書き'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `news`
--

INSERT INTO `news` (`id`, `reg_date`, `open_date`, `title`, `comment`, `is_open`) VALUES
(9, '2023-10-23', '2023-09-18', '朝食営業時間の変更についてのご案内', 'お客様のご要望にお応えして、当ホテルの朝食バイキングの営業時間を30分早く開始することにいたしました。\r\n\r\n新しい営業時間\r\n\r\n6:30〜10:30\r\n\r\n今後もこれまで以上のサービス向上に向けて努力を重ねて参りますので、何卒よろしくお願い申し上げます。\r\nご質問やリクエストがございましたら、フロントデスクまでお気軽にお知らせください。\r\n', 0),
(10, '2023-10-23', '2023-09-01', '公式サイトリニューアルのお知らせ', '平素よりBord de Merをご利用いただきまして、誠にありがとうございます。\r\n公式サイトをリニューアルいたしました。\r\n\r\n今後も宿泊に関する情報や最新情報を発信して参ります。\r\n皆さまのお越しを心よりお待ち申し上げております。', 1),
(13, '0000-00-00', '2023-10-27', '12月24日、25日のスペシャルディナーのご案内', '12月24日～12月25日、クリスマスの特別メニュー提供いたします。\r\n\r\nメニューは、フランスの家庭で、クリスマスに好まれているパンタード（ホロホロ鳥）のローストをはじめ、南仏の家庭料理をを予定しております。\r\nフランスのレストランで修業を積んだ当館のシェフが、腕を振るってお料理をご提供いたします。\r\n皆様のご予約をお待ちいたしております。\r\n', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `r_date` datetime NOT NULL DEFAULT current_timestamp(),
  `in_date` date NOT NULL DEFAULT current_timestamp(),
  `out_date` date NOT NULL,
  `number` int(1) NOT NULL,
  `room_id` int(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `cxl` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `reservation`
--

INSERT INTO `reservation` (`id`, `r_date`, `in_date`, `out_date`, `number`, `room_id`, `name`, `mail`, `tel`, `cxl`) VALUES
(3, '2023-10-23 00:00:00', '2023-10-24', '2023-10-26', 2, 1, '田中　次郎', 'jiro@mail.com', '0820-333-3333', 0),
(7, '2023-10-25 14:12:18', '2023-10-27', '2023-10-28', 4, 2, 'すずき　はなこ', 'hanako@mail.com', '00000000000', 0),
(10, '2023-10-26 12:06:12', '2023-10-31', '2023-11-01', 2, 1, 'とりさん', 'oji@mail.com', '09999999999', 0),
(11, '2023-10-26 12:14:00', '2023-10-26', '2023-10-27', 1, 2, 'いぬさん', 'ddd@dog.mail', '09211111111', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `rooms`
--

CREATE TABLE `rooms` (
  `id` int(1) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `rate_person` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `rate_person`) VALUES
(1, 'Coucher de Soleil', 15000),
(2, 'L\'Aurore Suite', 20000);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- テーブルの AUTO_INCREMENT `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルの AUTO_INCREMENT `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- テーブルの AUTO_INCREMENT `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

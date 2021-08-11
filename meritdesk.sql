-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Nis 2021, 14:28:53
-- Sunucu sürümü: 10.4.14-MariaDB
-- PHP Sürümü: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `meritdesk`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `announcement_head` text NOT NULL,
  `announcement_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `announcements`
--

INSERT INTO `announcements` (`id`, `announcement_head`, `announcement_text`) VALUES
(4, 'MeritDesk İzin Yönetim Sistemi Açılıyor', 'MeritDesk İzin Yönetim Sistemi çok yakında hizmetinizde. Merit Grup bünyesinde kullanılacak izin yönetim sistemi kolay kullanılabilir arayüzüyle izin yönetimini çok daha kolay hale getirecek.'),
(5, 'MeritDesk Kullanım Kılavuzu Yakında Sizlerle', 'İzin Yönetim Sistemi için hazırlanan kullanım kılavuzu yakında e-posta adreslerinize gönderilecek. Her türlü sorunuz için bizimle meritdesk@meritgrup.net adresinden iletişime geçebilirsiniz.'),
(6, '2021 Yılı İçin İzin Tanımlamaları Yapılmıştır', 'MeritDesk İzin Yönetim Sistemi üzerinde 2021 yılı için izin tanımlamaları yapılmıştır. Sistemin hesapladığı değerlerde yanlışlık olduğunu düşünüyorsanız lütfen bizimle iletişime geçin.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `arefe`
--

CREATE TABLE `arefe` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `arefe`
--

INSERT INTO `arefe` (`id`, `date`, `description`) VALUES
(1, '2020-05-23', 'Ramazan'),
(2, '2020-07-30', 'Kurban'),
(3, '2020-10-28', '28 Ekim'),
(4, '2021-05-12', 'Ramazan'),
(5, '2021-07-19', 'Kurban'),
(6, '2021-10-28', '28 Ekim');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `companies`
--

INSERT INTO `companies` (`id`, `company`) VALUES
(1, '3D Bilişim'),
(2, 'Agrimilk'),
(3, 'Avasis'),
(4, 'DVA'),
(5, 'Merit Telekom'),
(6, 'Merlin Yazılım'),
(7, 'MOST'),
(8, 'Telconet'),
(9, 'Merit Grup');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `departments`
--

INSERT INTO `departments` (`id`, `department`) VALUES
(1, 'Teknik'),
(2, 'Proje'),
(3, 'Satış'),
(4, 'Danışmanlık'),
(5, 'Yazılım'),
(6, 'Genel');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `holidays`
--

INSERT INTO `holidays` (`id`, `date`, `description`) VALUES
(1, '2020-01-01', 'Yılbaşı'),
(2, '2020-04-23', '23 Nisan'),
(3, '2020-05-01', '1 Mayıs'),
(4, '2020-05-19', '19 Mayıs'),
(5, '2020-07-15', '15 Temmuz'),
(6, '2020-08-30', '30 Ağustos'),
(7, '2020-10-29', '29 Ekim'),
(8, '2020-05-24', 'Ramazan 1'),
(9, '2020-05-25', 'Ramazan 2'),
(10, '2020-05-26', 'Ramazan 3'),
(11, '2020-07-31', 'Kurban 1'),
(12, '2020-07-31', 'Kurban 2'),
(13, '2020-08-01', 'Kurban 3'),
(14, '2020-08-03', 'Kurban 4'),
(15, '2021-01-01', 'Yılbaşı'),
(16, '2021-04-23', '23 Nisan'),
(17, '2021-05-01', '1 Mayıs'),
(18, '2021-05-19', '19 Mayıs'),
(19, '2021-07-15', '15 Temmuz'),
(20, '2021-08-30', '30 Ağustos'),
(21, '2021-10-29', '29 Ekim'),
(22, '2021-05-13', 'Ramazan 1'),
(23, '2021-05-14', 'Ramazan 2'),
(24, '2021-05-15', 'Ramazan 3'),
(25, '2021-07-20', 'Kurban 1'),
(26, '2021-07-21', 'Kurban 2'),
(27, '2021-07-22', 'Kurban 3'),
(28, '2021-07-23', 'Kurban 4'),
(29, '2022-01-01', 'Yılbaşı'),
(30, '2022-04-23', '23 Nisan'),
(31, '2022-05-01', '1 Mayıs'),
(32, '2022-05-19', '19 Mayıs'),
(33, '2022-07-15', '15 Temmuz'),
(34, '2022-08-30', '30 Ağustos'),
(35, '2022-10-29', '29 Ekim'),
(36, '2022-05-03', 'Ramazan 1'),
(37, '2022-05-04', 'Ramazan 2'),
(38, '2022-05-05', 'Ramazan 3'),
(39, '2022-07-10', 'Kurban 1'),
(40, '2022-07-11', 'Kurban 2'),
(41, '2022-07-12', 'Kurban 3'),
(42, '2022-07-13', 'Kurban 4'),
(43, '2023-01-01', 'Yılbaşı'),
(44, '2023-04-23', '23 Nisan'),
(45, '2023-05-01', '1 Mayıs'),
(46, '2023-05-19', '19 Mayıs'),
(47, '2023-07-15', '15 Temmuz'),
(48, '2023-08-30', '30 Ağustos'),
(49, '2023-10-29', '29 Ekim'),
(50, '2023-04-21', 'Ramazan 1'),
(51, '2023-04-22', 'Ramazan 2'),
(52, '2023-04-23', 'Ramazan 3'),
(53, '2023-06-28', 'Kurban 1'),
(54, '2023-06-29', 'Kurban 2'),
(55, '2023-06-30', 'Kurban 3'),
(56, '2023-07-01', 'Kurban 4');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `leave_start` date NOT NULL,
  `start_half_day` int(11) NOT NULL,
  `leave_end` date NOT NULL,
  `end_half_day` int(11) NOT NULL,
  `total_day` float NOT NULL,
  `description` text NOT NULL,
  `m1` varchar(255) NOT NULL,
  `m2` varchar(255) DEFAULT NULL,
  `m3` varchar(255) DEFAULT NULL,
  `m4` varchar(255) DEFAULT NULL,
  `statue` int(11) NOT NULL,
  `statue_id` int(11) DEFAULT NULL,
  `request_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `leaves`
--

INSERT INTO `leaves` (`id`, `email`, `company_id`, `department_id`, `leave_start`, `start_half_day`, `leave_end`, `end_half_day`, `total_day`, `description`, `m1`, `m2`, `m3`, `m4`, `statue`, `statue_id`, `request_date`) VALUES
(53, 'bekircan.akpinar@telconet.com.tr', 8, 1, '2021-04-13', 0, '2021-04-15', 0, 3, 'Test', 'tahir.erez@telconet.com.tr', 'okan.sengul@telconet.com.tr', '', '', 3, -2, '2021-04-12'),
(54, 'bekircan.akpinar@telconet.com.tr', 8, 1, '2021-04-14', 0, '2021-04-17', 0, 4, 'Test', 'tahir.erez@telconet.com.tr', 'okan.sengul@telconet.com.tr', '', '', 1, NULL, '2021-04-13'),
(55, 'okan.pasaoglu@telconet.com.tr', 8, 1, '2021-04-15', 0, '2021-04-16', 0, 2, 'Test', 'tahir.erez@telconet.com.tr', 'okan.sengul@telconet.com.tr', '', '', 3, -2, '2021-04-13'),
(56, 'haci.nayir@telconet.com.tr', 3, 1, '2021-04-14', 0, '2021-04-16', 0, 3, 'Test', 'tahir.erez@telconet.com.tr', 'okan.sengul@telconet.com.tr', '', '', 3, -2, '2021-04-13'),
(57, 'haci.nayir@telconet.com.tr', 3, 1, '2021-04-14', 0, '2021-04-17', 0, 4, 'Test', 'tahir.erez@telconet.com.tr', 'okan.sengul@telconet.com.tr', '', '', 3, -2, '2021-04-13'),
(58, 'haci.nayir@telconet.com.tr', 3, 1, '2021-04-13', 0, '2021-04-17', 1, 4.5, 'Test', 'tahir.erez@telconet.com.tr', 'okan.sengul@telconet.com.tr', '', '', 3, -2, '2021-04-13'),
(59, 'haci.nayir@telconet.com.tr', 3, 1, '2021-04-14', 0, '2021-04-17', 1, 3.5, 'Test', 'tahir.erez@telconet.com.tr', 'okan.sengul@telconet.com.tr', '', '', 1, NULL, '2021-04-13');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `user_role` int(11) NOT NULL,
  `manager1` int(11) NOT NULL,
  `manager2` int(11) DEFAULT NULL,
  `manager3` int(11) DEFAULT NULL,
  `manager4` int(11) DEFAULT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `company`, `department`, `user_role`, `manager1`, `manager2`, `manager3`, `manager4`, `start_date`) VALUES
(1, 'Merit', 'Grup', 'merithrms@gmail.com', '$2y$10$6u.gclRG1GXDZL3wHNBWHejg0txnBz8Vu4.YGDfG4smAZq21A1aoW', 9, 6, 1, 1, 0, 0, 0, '2000-01-01'),
(2, 'Tarık', 'Vatansever', 'tarik.vatansever@telconet.com.tr', '$2y$10$PTyUBXWEbd4EeuYX5Gt7ruqRKvb7Sfi8DsU9kkRI46RVOgNQmVnH.', 9, 6, 1, 1, 0, 0, 0, '2000-01-01'),
(3, 'Okan', 'Şengül', 'okan.sengul@telconet.com.tr', '$2y$10$d2GxcGagSiCySg9wGltWVuc3Bc0x.QSQ41pX871nEPb/3ZI5lceDS', 8, 1, 2, 2, 0, 0, 0, '2003-01-02'),
(4, 'Tahir', 'Erez', 'tahir.erez@telconet.com.tr', '$2y$10$hgjxGMl9JN7qzWwt/w2GSeTpPJmu4sjvpAdHvXBG4KrM/oRgDrPxS', 8, 1, 4, 3, 2, 0, 0, '2013-04-12'),
(5, 'Bekircan', 'Akpınar', 'bekircan.akpinar@telconet.com.tr', '$2y$10$p.IZbV1huAOrs9TyozXIx.4aJW7MV82qaI8UymaPprcmXqSu65dDG', 8, 1, 3, 4, 3, 0, 0, '2020-09-01'),
(6, 'Okan', 'Paşaoğlu', 'okan.pasaoglu@telconet.com.tr', '$2y$10$ow8AAbe1Mw7jKv/.mz1AwuxPRVfMlCJYeh5BKtGi85zxMZKt.UINy', 8, 1, 3, 4, 3, 0, 0, '2018-01-01'),
(7, 'Hacı', 'Nayir', 'haci.nayir@telconet.com.tr', '$2y$10$w7M2obIGq4oGQG7XFVXSTubxACLmWQ/p8n.0wlcCsp6CT09l3bODa', 3, 1, 3, 4, 3, 0, 0, '2018-01-01'),
(8, 'Öner', 'Can', 'oner.can@telconet.com.tr', '$2y$10$qw/QX5g9GtK3qApi5SpQf.MB0Pfz31LwRfvLaAFV2/PbelaUv/iEq', 3, 1, 3, 4, 3, 0, 0, '2018-01-01'),
(9, 'Harun', 'Teker', 'harun.teker@telconet.com.tr', '$2y$10$NUMlTLo1W4GcBsFEmhi8H.15DjPHRZWpcItSd7R4U6GP5s6h0t69a', 8, 1, 3, 4, 3, 0, 0, '2014-01-01'),
(10, 'Cihad', 'Tokdemir', 'cihad.tokdemir@telconet.com.tr', '$2y$10$L0ozT9fG7N59O5oHkTeEI./YIaS2hnZok7gceMPKA9DHgXeNq3K.q', 8, 1, 3, 4, 3, 0, 0, '2021-01-01'),
(11, 'Doğan', 'Coşkun', 'dogan.coskun@telconet.com.tr', '$2y$10$BCl0WydCkPUduKdp4ftw1uctebg8aQ1VeunGOdMVxw6lYqlqA.EV.', 8, 1, 3, 4, 3, 0, 0, '2019-01-01'),
(13, 'Yiğitcan', 'Karataş', 'yigitcan.karatas@telconet.com.tr', '$2y$10$jXt9GAnMjHGlvti67mqrt.fLUuyLTy2r7xg9MM2TZT8H3aBw9zeYi', 8, 1, 3, 4, 3, 0, 0, '2021-03-03');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `arefe`
--
ALTER TABLE `arefe`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `arefe`
--
ALTER TABLE `arefe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Tablo için AUTO_INCREMENT değeri `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

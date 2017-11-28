-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2016 年 08 月 25 日 05:10
-- 伺服器版本: 10.1.13-MariaDB
-- PHP 版本： 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `Trisoap`
--

-- --------------------------------------------------------

--
-- 資料表結構 `CUSMAS`
--

CREATE TABLE `CUSMAS` (
  `EMAIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `CUSPW` varchar(15) COLLATE utf8_bin NOT NULL,
  `CUSNM` varchar(30) COLLATE utf8_bin NOT NULL,
  `CUSIDT` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'B',
  `CUSADD` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `CUSBIRTH` date NOT NULL,
  `COUNTRY` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `ZCODE` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `TEL` varchar(15) COLLATE utf8_bin NOT NULL,
  `CUSTYPE` varchar(1) COLLATE utf8_bin NOT NULL,
  `KNOWTYPE` varchar(1) COLLATE utf8_bin NOT NULL,
  `TAXID` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `DISCOUNT` int(8) NOT NULL DEFAULT '0',
  `SALEAMTMTD` int(8) NOT NULL DEFAULT '0',
  `SALEAMTSTD` int(8) NOT NULL DEFAULT '0',
  `SALEAMTYTD` int(8) NOT NULL DEFAULT '0',
  `SALEAMT` int(8) NOT NULL DEFAULT '0',
  `SPEINS` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `TOKEN` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `VERIFY` varchar(15) COLLATE utf8_bin NOT NULL,
  `CREATEDATE` datetime DEFAULT NULL,
  `UPDATEDATE` datetime DEFAULT NULL,
  `ACTCODE` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 資料表的匯出資料 `CUSMAS`
--

INSERT INTO `CUSMAS` (`EMAIL`, `CUSPW`, `CUSNM`, `CUSIDT`, `CUSADD`, `CUSBIRTH`, `COUNTRY`, `ZCODE`, `TEL`, `CUSTYPE`, `KNOWTYPE`, `TAXID`, `DISCOUNT`, `SALEAMTMTD`, `SALEAMTSTD`, `SALEAMTYTD`, `SALEAMT`, `SPEINS`, `VERIFY`, `CREATEDATE`, `UPDATEDATE`, `ACTCODE`) VALUES
('trisoap2015@gmail.com', 'dd8770870425', '三三預設管理員', 'A', 'home', '1999-3-3', NULL, NULL, '0952527077', 'A', 'A', 'no', 0, 0, 0, 0, 0, '', '000000', '2016-08-25 11:07:11', '2016-08-25 11:07:11', 1),
('tim841206@yahoo.com.tw', '406759613ee9', '系統管理員', 'A', 'home', '1995-12-6', NULL, NULL, '0922825881', 'A', 'A', 'no', 0, 0, 0, 0, 0, '', '000000', '2016-08-25 11:07:11', '2016-08-25 11:07:11', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `DCTMAS`
--

CREATE TABLE `DCTMAS` (
  `DCTID` varchar(50) COLLATE utf8_bin NOT NULL,
  `DCTPRICE` smallint(4) NOT NULL,
  `DCTSTAT` tinyint(1) NOT NULL,
  `DCTNM` varchar(50) COLLATE utf8_bin NOT NULL,
  `CREATEPERSON` varchar(50) COLLATE utf8_bin NOT NULL,
  `CREATEDATE` datetime NOT NULL,
  `USEDATE` datetime DEFAULT NULL,
  `ACTCODE` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 資料表結構 `ITEMMAS`
--

CREATE TABLE `ITEMMAS` (
  `ITEMNO` int(15) NOT NULL,
  `ITEMNM` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `ITEMAMT` int(8) NOT NULL DEFAULT '0',
  `PRICE` int(8) DEFAULT NULL,
  `DESCRIPTION` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `CREATEDATE` datetime NOT NULL,
  `UPDATEDATE` datetime NOT NULL,
  `ACTCODE` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 資料表的匯出資料 `ITEMMAS`
--

INSERT INTO `ITEMMAS` (`ITEMNO`, `ITEMNM`, `ITEMAMT`, `PRICE`, `DESCRIPTION`, `CREATEDATE`, `UPDATEDATE`, `ACTCODE`) VALUES
(1, '田靜山巒禾風皂', 999999, 300, '', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 1),
(2, '金絲森林渲染皂', 999999, 300, '', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 1),
(3, '釋迦手感果力皂', 999999, 300, '', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 1),
(4, '三三臺東意象禮盒組', 999999, 900, '', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 1),
(5, '三三臺東意象皂絲旅行組', 999999, 240, '', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 1),
(6, '洛神紅麴旅用皂絲', 999999, 40, '', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 1),
(7, '暖暖薑黃旅用皂絲', 999999, 40, '', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 1),
(8, '萱草米黃旅用皂絲', 999999, 40, '', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 1),
(9, '中秋禮皂-月兔捉迷藏', 999999, 1200, '', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 1),
(10, '中秋禮皂-熱氣球登月', 999999, 1200, '', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 1),
(11, '中秋小禮盒', 999999, 450, '', '2017-06-01 00:00:00', '2017-06-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `MSGMAS`
--

CREATE TABLE `MSGMAS` (
  `MSGNO` int(15) NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `MSGTXT` text COLLATE utf8_bin NOT NULL,
  `MSGPHOTO` tinyint(1) NOT NULL,
  `MSGVIDEO` tinyint(1) NOT NULL,
  `MSGSTAT` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'A',
  `REWARDSTAT` tinyint(1) NOT NULL DEFAULT '0',
  `CREATEDATE` datetime NOT NULL,
  `PUBLICDATE` datetime DEFAULT NULL,
  `ACTCODE` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 資料表結構 `ORDITEMMAS`
--

CREATE TABLE `ORDITEMMAS` (
  `ORDNO` varchar(15) COLLATE utf8_bin NOT NULL,
  `ITEMNO` varchar(15) COLLATE utf8_bin NOT NULL,
  `ORDAMT` int(8) NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `CREATEDATE` datetime NOT NULL,
  `UPDATEDATE` datetime NOT NULL,
  `ACTCODE` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 資料表結構 `ORDMAS`
--

CREATE TABLE `ORDMAS` (
  `ORDNO` int(15) NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `INVOICENO` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `ORDADD` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `BACKSTAT` tinyint(1) DEFAULT '0',
  `ORDSTAT` varchar(1) COLLATE utf8_bin DEFAULT 'E',
  `PAYSTAT` tinyint(1) DEFAULT '0',
  `PAYTYPE` varchar(1) COLLATE utf8_bin DEFAULT NULL,
  `ORDINST` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `DCTID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `TOTALPRICE` int(8) DEFAULT '0',
  `SHIPFEE` int(8) NOT NULL,
  `REALPRICE` int(8) DEFAULT '0',
  `CREATEDATE` datetime NOT NULL,
  `UPDATEDATE` datetime NOT NULL,
  `ACTCODE` tinyint(1) NOT NULL DEFAULT '1',
  `MerchantTradeNo` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 資料表的匯出資料 `ORDMAS`
--

INSERT INTO `ORDMAS` (`ORDNO`, `EMAIL`, `SHIPFEE`, `CREATEDATE`, `UPDATEDATE`) VALUES
(0, 'tim841206@yahoo.com.tw', 0, '2017-06-01 00:00:00', '2017-06-01 00:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `OWNMAS`
--

CREATE TABLE `OWNMAS` (
  `COMNM` varchar(15) COLLATE utf8_bin NOT NULL,
  `COMADD` varchar(100) COLLATE utf8_bin NOT NULL,
  `COMTEL` varchar(15) COLLATE utf8_bin NOT NULL,
  `COMEMAIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `COMWEB` varchar(50) COLLATE utf8_bin NOT NULL,
  `COMTAXID` varchar(15) COLLATE utf8_bin NOT NULL,
  `NORDNO` int(15) NOT NULL,
  `NMSGNO` int(15) NOT NULL,
  `SALEAMTDATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 資料表的匯出資料 `OWNMAS`
--

INSERT INTO `OWNMAS` (`COMNM`, `COMADD`, `COMTEL`, `COMEMAIL`, `COMWEB`, `COMTAXID`, `NORDNO`, `NMSGNO`) VALUES
('Trisoap', '台東縣台東市鐵花路86巷2號', '0952527077', 'service@trisoap.com', 'https://www.trisoap.com', '43864595', 100000001, 100001);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `CUSMAS`
--
ALTER TABLE `CUSMAS`
  ADD PRIMARY KEY (`EMAIL`);

--
-- 資料表索引 `DCTMAS`
--
ALTER TABLE `DCTMAS`
  ADD PRIMARY KEY (`DCTID`);

--
-- 資料表索引 `ITEMMAS`
--
ALTER TABLE `ITEMMAS`
  ADD PRIMARY KEY (`ITEMNO`);

--
-- 資料表索引 `MSGMAS`
--
ALTER TABLE `MSGMAS`
  ADD PRIMARY KEY (`MSGNO`);

--
-- 資料表索引 `ORDITEMMAS`
--
ALTER TABLE `ORDITEMMAS`
  ADD PRIMARY KEY (`ORDNO`,`ITEMNO`,`EMAIL`);

--
-- 資料表索引 `ORDMAS`
--
ALTER TABLE `ORDMAS`
  ADD PRIMARY KEY (`ORDNO`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

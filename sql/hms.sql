-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2017 at 05:49 AM
-- Server version: 5.5.27-log
-- PHP Version: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendes`
--

CREATE TABLE IF NOT EXISTS `attendes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time_in` varchar(255) NOT NULL,
  `time_out` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `attendes`
--

INSERT INTO `attendes` (`id`, `emp_id`, `date`, `time_in`, `time_out`, `type`, `status`) VALUES
(2, 2, '2016/08/14', '', '', 2, '1'),
(3, 3, '2016/08/14', '10:00am', '9:00pm', 1, '1'),
(4, 1, '2016/08/14', '10:00am', '9:00pm', 1, '1'),
(5, 1, '2016/08/16', '', '', 3, '1'),
(6, 2, '2016/08/16', '', '', 3, '1'),
(7, 3, '2016/08/16', '10:40am', '6:00pm', 1, '1'),
(8, 1, '2016/08/28', '10:00am', '6:00pm', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `attendes_type`
--

CREATE TABLE IF NOT EXISTS `attendes_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `attendes_type`
--

INSERT INTO `attendes_type` (`id`, `name`, `status`) VALUES
(1, 'Present', '1'),
(2, 'Absent', '1'),
(3, 'Leave', '1');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `bill_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `type`, `amount`, `month`, `year`, `bill_date`) VALUES
(1, 1, '3000', 'jan', '2016', '2016-08-23'),
(2, 2, '25000', 'jan', '2016', '2016-08-23'),
(3, 3, '23600', 'jan', '2016', '2016-08-23'),
(4, 1, '2500', 'feb', '2016', '2016-08-23'),
(5, 2, '25000', 'feb', '2016', '2016-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `bill_type`
--

CREATE TABLE IF NOT EXISTS `bill_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bill_type`
--

INSERT INTO `bill_type` (`id`, `title`, `status`) VALUES
(1, 'Electricity', '1'),
(2, 'Gas', '1'),
(3, 'DSL', '1');

-- --------------------------------------------------------

--
-- Table structure for table `booking_detail`
--

CREATE TABLE IF NOT EXISTS `booking_detail` (
  `bd_id` int(11) NOT NULL AUTO_INCREMENT,
  `bh_id` int(11) NOT NULL,
  `hl_id` int(11) NOT NULL,
  `mn_id` int(11) NOT NULL,
  `total_person` int(11) NOT NULL,
  `head_rate` float NOT NULL,
  `other_desc` text NOT NULL,
  `other_rate` float NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `b_date` date NOT NULL,
  `bd_status` int(11) NOT NULL DEFAULT '0',
  `entry_date` datetime NOT NULL,
  `options` int(11) NOT NULL,
  `per_person` float NOT NULL,
  PRIMARY KEY (`bd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `booking_detail`
--

INSERT INTO `booking_detail` (`bd_id`, `bh_id`, `hl_id`, `mn_id`, `total_person`, `head_rate`, `other_desc`, `other_rate`, `time_in`, `time_out`, `b_date`, `bd_status`, `entry_date`, `options`, `per_person`) VALUES
(1, 3, 1, 0, 200, 0, '', 0, '10:57:00', '21:57:00', '2016-09-20', 0, '0000-00-00 00:00:00', 0, 100),
(2, 3, 1, 2, 20, 0, '', 0, '10:57:00', '21:57:00', '2016-09-20', 0, '0000-00-00 00:00:00', 1, 0),
(11, 3, 3, 0, 20, 0, '', 0, '00:00:00', '00:00:00', '2016-09-26', 1, '0000-00-00 00:00:00', 0, 10),
(12, 5, 3, 2, 100, 0, 'NIL', 5000, '23:01:00', '02:01:00', '2017-01-21', 0, '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking_hall`
--

CREATE TABLE IF NOT EXISTS `booking_hall` (
  `bh_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax` float NOT NULL,
  `discount` float NOT NULL,
  `entry_date` date NOT NULL,
  `bh_status` int(11) NOT NULL,
  `cus_name` text NOT NULL,
  `cus_cnic` text NOT NULL,
  `cus_phone` text NOT NULL,
  `total` float NOT NULL,
  `advance` float NOT NULL,
  PRIMARY KEY (`bh_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `booking_hall`
--

INSERT INTO `booking_hall` (`bh_id`, `tax`, `discount`, `entry_date`, `bh_status`, `cus_name`, `cus_cnic`, `cus_phone`, `total`, `advance`) VALUES
(1, 100, 10, '2016-12-05', 0, 'Ahmed', '463732623651', '12323', 11000, 0),
(2, 10, 100, '2016-09-03', 1, '', '', '', 10000, 0),
(3, 1000, 275, '2016-12-02', 0, 'waleed', '1223122545434', '03435551441', 30450, 800),
(4, 0, 0, '2017-01-21', 0, 'asdasdasdasd', '1233333333333', 'asdasdadasa', 0, 0),
(5, 2000, 1000, '2016-12-02', 0, 'asdadasd', '2133333333333', '32111111111', 53750, 0);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `countryid` smallint(6) NOT NULL AUTO_INCREMENT,
  `country` varchar(150) NOT NULL,
  `countrycode` char(10) NOT NULL,
  `subscriber` char(19) DEFAULT NULL,
  `nationality` varchar(150) DEFAULT NULL,
  `currency` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`countryid`),
  UNIQUE KEY `countrycode` (`countrycode`),
  KEY `country` (`country`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 121856 kB; InnoDB free: 121856 kB; InnoDB free:' AUTO_INCREMENT=245 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`countryid`, `country`, `countrycode`, `subscriber`, `nationality`, `currency`) VALUES
(1, 'ANDORRA, PRINCIPALITY OF                               ', 'AD', '', NULL, NULL),
(2, 'UNITED ARAB EMIRATES                                   ', 'AE', '971', NULL, NULL),
(3, 'AFGHANISTAN, ISLAMIC STATE OF                          ', 'AF', '', NULL, NULL),
(4, 'ANTIGUA AND BARBUDA                                    ', 'AG', '', NULL, NULL),
(5, 'ANGUILLA                                               ', 'AI', '+1-264*', NULL, NULL),
(6, 'ALBANIA                                                ', 'AL', '355', NULL, NULL),
(7, 'ARMENIA                                                ', 'AM', '374', NULL, NULL),
(8, 'NETHERLANDS ANTILLES                                   ', 'AN', '599', NULL, NULL),
(9, 'ANGOLA                                                 ', 'AO', '244', NULL, NULL),
(10, 'ANTARCTICA                                             ', 'AQ', '672', NULL, NULL),
(11, 'ARGENTINA                                              ', 'AR', '54', NULL, NULL),
(12, 'AMERICAN SAMOA                                         ', 'AS', '684', NULL, NULL),
(13, 'AUSTRIA                                                ', 'AT', '43', NULL, NULL),
(14, 'AUSTRALIA                                              ', 'AU', '61', NULL, NULL),
(15, 'ARUBA                                                  ', 'AW', '297', NULL, NULL),
(16, 'AZERBAIDJAN                                            ', 'AZ', '', NULL, NULL),
(17, 'BOSNIA-HERZEGOVINA                                     ', 'BA', '', NULL, NULL),
(18, 'BARBADOS                                               ', 'BB', '+1-246*', NULL, NULL),
(19, 'BANGLADESH                                             ', 'BD', '880', NULL, NULL),
(20, 'BELGIUM                                                ', 'BE', '32', NULL, NULL),
(21, 'BURKINA FASO                                           ', 'BF', '226', NULL, NULL),
(22, 'BULGARIA                                               ', 'BG', '359', NULL, NULL),
(23, 'BAHRAIN                                                ', 'BH', '973', NULL, NULL),
(24, 'BURUNDI                                                ', 'BI', '257', NULL, NULL),
(25, 'BENIN                                                  ', 'BJ', '229', NULL, NULL),
(26, 'BERMUDA                                                ', 'BM', '+1-441*', NULL, NULL),
(27, 'BRUNEI DARUSSALAM                                      ', 'BN', '673', NULL, NULL),
(28, 'BOLIVIA                                                ', 'BO', '591', NULL, NULL),
(29, 'BRAZIL                                                 ', 'BR', '55', NULL, NULL),
(30, 'BAHAMAS                                                ', 'BS', '+1-242*', NULL, NULL),
(31, 'BHUTAN                                                 ', 'BT', '975', NULL, NULL),
(32, 'BOUVET ISLAND                                          ', 'BV', '', NULL, NULL),
(33, 'BOTSWANA                                               ', 'BW', '267', NULL, NULL),
(34, 'BELARUS                                                ', 'BY', '375', NULL, NULL),
(35, 'BELIZE                                                 ', 'BZ', '501', NULL, NULL),
(36, 'CANADA                                                 ', 'CA', '1', NULL, NULL),
(37, 'COCOS (KEELING) ISLANDS                                ', 'CC', '', NULL, NULL),
(38, 'CENTRAL AFRICAN REPUBLIC                               ', 'CF', '236', NULL, NULL),
(39, 'CONGO, THE DEMOCRATIC REPUBLIC OF THE                  ', 'CD', '', NULL, NULL),
(40, 'CONGO                                                  ', 'CG', '242', NULL, NULL),
(41, 'SWITZERLAND                                            ', 'CH', '41', NULL, NULL),
(42, 'IVORY COAST (COTE D''IVOIRE)                            ', 'CI', '', NULL, NULL),
(43, 'COOK ISLANDS                                           ', 'CK', '682', NULL, NULL),
(44, 'CHILE                                                  ', 'CL', '56', NULL, NULL),
(45, 'CAMEROON                                               ', 'CM', '237', NULL, NULL),
(46, 'CHINA                                                  ', 'CN', '', NULL, NULL),
(47, 'COLOMBIA                                               ', 'CO', '57', NULL, NULL),
(48, 'COSTA RICA                                             ', 'CR', '506', NULL, NULL),
(49, 'FORMER CZECHOSLOVAKIA                                  ', 'CS', '', NULL, NULL),
(50, 'CUBA                                                   ', 'CU', '53', NULL, NULL),
(51, 'CAPE VERDE                                             ', 'CV', '', NULL, NULL),
(52, 'CHRISTMAS ISLAND                                       ', 'CX', '53', NULL, NULL),
(53, 'CYPRUS                                                 ', 'CY', '357', NULL, NULL),
(54, 'CZECH REPUBLIC                                         ', 'CZ', '420', NULL, NULL),
(55, 'GERMANY                                                ', 'DE', '49', NULL, NULL),
(56, 'DJIBOUTI                                               ', 'DJ', '253', NULL, NULL),
(57, 'DENMARK                                                ', 'DK', '45', NULL, NULL),
(58, 'DOMINICA                                               ', 'DM', '+1-767*', NULL, NULL),
(59, 'DOMINICAN REPUBLIC                                     ', 'DO', '+1-809*', NULL, NULL),
(60, 'ALGERIA                                                ', 'DZ', '213', NULL, NULL),
(61, 'ECUADOR                                                ', 'EC', '593', NULL, NULL),
(62, 'ESTONIA                                                ', 'EE', '372', NULL, NULL),
(63, 'EGYPT                                                  ', 'EG', '20', NULL, NULL),
(64, 'WESTERN SAHARA                                         ', 'EH', '', NULL, NULL),
(65, 'ERITREA                                                ', 'ER', '291', NULL, NULL),
(66, 'SPAIN                                                  ', 'ES', '34', NULL, NULL),
(67, 'ETHIOPIA                                               ', 'ET', '251', NULL, NULL),
(68, 'FINLAND                                                ', 'FI', '358', NULL, NULL),
(69, 'FIJI                                                   ', 'FJ', '', NULL, NULL),
(70, 'FALKLAND ISLANDS                                       ', 'FK', '', NULL, NULL),
(71, 'MICRONESIA                                             ', 'FM', '', NULL, NULL),
(72, 'FAROE ISLANDS                                          ', 'FO', '298', NULL, NULL),
(73, 'FRANCE                                                 ', 'FR', '33', NULL, NULL),
(74, 'FRANCE (EUROPEAN TERRITORY)                            ', 'FX', '', NULL, NULL),
(75, 'GABON                                                  ', 'GA', '', NULL, NULL),
(76, 'GREAT BRITAIN                                          ', 'GB', '', NULL, NULL),
(77, 'GRENADA                                                ', 'GD', '+1-473*', NULL, NULL),
(78, 'GEORGIA                                                ', 'GE', '995', NULL, NULL),
(79, 'FRENCH GUYANA                                          ', 'GF', '', NULL, NULL),
(80, 'GHANA                                                  ', 'GH', '233', NULL, NULL),
(81, 'GIBRALTAR                                              ', 'GI', '350', NULL, NULL),
(82, 'GREENLAND                                              ', 'GL', '299', NULL, NULL),
(83, 'GAMBIA                                                 ', 'GM', '220', NULL, NULL),
(84, 'GUINEA                                                 ', 'GN', '224', NULL, NULL),
(85, 'USA GOVERNMENT                                         ', 'GOV', '', NULL, NULL),
(86, 'GUADELOUPE (FRENCH)                                    ', 'GP', '', NULL, NULL),
(87, 'EQUATORIAL GUINEA                                      ', 'GQ', '240', NULL, NULL),
(88, 'GREECE                                                 ', 'GR', '30', NULL, NULL),
(89, 'S. GEORGIA & S. SANDWICH ISLS.                         ', 'GS', '', NULL, NULL),
(90, 'GUATEMALA                                              ', 'GT', '502', NULL, NULL),
(91, 'GUAM (USA)                                             ', 'GU', '', NULL, NULL),
(92, 'GUINEA BISSAU                                          ', 'GW', '', NULL, NULL),
(93, 'GUYANA                                                 ', 'GY', '592', NULL, NULL),
(94, 'HONG KONG                                              ', 'HK', '852', NULL, NULL),
(95, 'HEARD AND MCDONALD ISLANDS                             ', 'HM', '', NULL, NULL),
(96, 'HONDURAS                                               ', 'HN', '504', NULL, NULL),
(97, 'CROATIA                                                ', 'HR', '385', NULL, NULL),
(98, 'HAITI                                                  ', 'HT', '509', NULL, NULL),
(99, 'HUNGARY                                                ', 'HU', '36', NULL, NULL),
(100, 'INDONESIA                                              ', 'ID', '62', NULL, NULL),
(101, 'IRELAND                                                ', 'IE', '353', NULL, NULL),
(102, 'ISRAEL                                                 ', 'IL', '972', NULL, NULL),
(103, 'INDIA                                                  ', 'IN', '91', NULL, NULL),
(104, 'BRITISH INDIAN OCEAN TERRITORY                         ', 'IO', '', NULL, NULL),
(105, 'IRAQ                                                   ', 'IQ', '964', NULL, NULL),
(106, 'IRAN                                                   ', 'IR', '98', NULL, NULL),
(107, 'ICELAND                                                ', 'IS', '354', NULL, NULL),
(108, 'ITALY                                                  ', 'IT', '39', NULL, NULL),
(109, 'JAMAICA                                                ', 'JM', '+1-876*', NULL, NULL),
(110, 'JORDAN                                                 ', 'JO', '962', NULL, NULL),
(111, 'JAPAN                                                  ', 'JP', '81', NULL, NULL),
(112, 'KENYA                                                  ', 'KE', '254', NULL, NULL),
(113, 'KYRGYZ REPUBLIC (KYRGYZSTAN)                           ', 'KG', '', NULL, NULL),
(114, 'CAMBODIA, KINGDOM OF                                   ', 'KH', '', NULL, NULL),
(115, 'KIRIBATI                                               ', 'KI', '686', NULL, NULL),
(116, 'COMOROS                                                ', 'KM', '269', NULL, NULL),
(117, 'SAINT KITTS & NEVIS ANGUILLA                           ', 'KN', '', NULL, NULL),
(118, 'NORTH KOREA                                            ', 'KP', '', NULL, NULL),
(119, 'SOUTH KOREA                                            ', 'KR', '', NULL, NULL),
(120, 'KUWAIT                                                 ', 'KW', '965', NULL, NULL),
(121, 'CAYMAN ISLANDS                                         ', 'KY', '+1-345*', NULL, NULL),
(122, 'KAZAKHSTAN                                             ', 'KZ', '7', NULL, NULL),
(123, 'LAOS                                                   ', 'LA', '856', NULL, NULL),
(124, 'LEBANON                                                ', 'LB', '961', NULL, NULL),
(125, 'SAINT LUCIA                                            ', 'LC', '', NULL, NULL),
(126, 'LIECHTENSTEIN                                          ', 'LI', '423', NULL, NULL),
(127, 'SRI LANKA                                              ', 'LK', '94', NULL, NULL),
(128, 'LIBERIA                                                ', 'LR', '231', NULL, NULL),
(129, 'LESOTHO                                                ', 'LS', '266', NULL, NULL),
(130, 'LITHUANIA                                              ', 'LT', '370', NULL, NULL),
(131, 'LUXEMBOURG                                             ', 'LU', '352', NULL, NULL),
(132, 'LATVIA                                                 ', 'LV', '371', NULL, NULL),
(133, 'LIBYA                                                  ', 'LY', '218', NULL, NULL),
(134, 'MOROCCO                                                ', 'MA', '212', NULL, NULL),
(135, 'MONACO                                                 ', 'MC', '377', NULL, NULL),
(136, 'MOLDAVIA                                               ', 'MD', '', NULL, NULL),
(137, 'MADAGASCAR                                             ', 'MG', '261', NULL, NULL),
(138, 'MARSHALL ISLANDS                                       ', 'MH', '692', NULL, NULL),
(139, 'MACEDONIA                                              ', 'MK', '', NULL, NULL),
(140, 'MALI                                                   ', 'ML', '', NULL, NULL),
(141, 'MYANMAR                                                ', 'MM', '95', NULL, NULL),
(142, 'MONGOLIA                                               ', 'MN', '976', NULL, NULL),
(143, 'MACAU                                                  ', 'MO', '', NULL, NULL),
(144, 'NORTHERN MARIANA ISLANDS                               ', 'MP', '', NULL, NULL),
(145, 'MARTINIQUE (FRENCH)                                    ', 'MQ', '', NULL, NULL),
(146, 'MAURITANIA                                             ', 'MR', '222', NULL, NULL),
(147, 'MONTSERRAT                                             ', 'MS', '+1-664*', NULL, NULL),
(148, 'MALTA                                                  ', 'MT', '356', NULL, NULL),
(149, 'MAURITIUS                                              ', 'MU', '230', NULL, NULL),
(150, 'MALDIVES                                               ', 'MV', '960', NULL, NULL),
(151, 'MALAWI                                                 ', 'MW', '265', NULL, NULL),
(152, 'MEXICO                                                 ', 'MX', '52', NULL, NULL),
(153, 'MALAYSIA                                               ', 'MY', '60', NULL, NULL),
(154, 'MOZAMBIQUE                                             ', 'MZ', '258', NULL, NULL),
(155, 'NAMIBIA                                                ', 'NA', '264', NULL, NULL),
(156, 'NEW CALEDONIA (FRENCH)                                 ', 'NC', '', NULL, NULL),
(157, 'NIGER                                                  ', 'NE', '227', NULL, NULL),
(158, 'NORFOLK ISLAND                                         ', 'NF', '672', NULL, NULL),
(159, 'NIGERIA                                                ', 'NG', '234', NULL, NULL),
(160, 'NICARAGUA                                              ', 'NI', '505', NULL, NULL),
(161, 'NETHERLANDS                                            ', 'NL', '31', NULL, NULL),
(162, 'NORWAY                                                 ', 'NO', '47', NULL, NULL),
(163, 'NEPAL                                                  ', 'NP', '977', NULL, NULL),
(164, 'NAURU                                                  ', 'NR', '674', NULL, NULL),
(165, 'NIUE                                                   ', 'NU', '683', NULL, NULL),
(166, 'NEW ZEALAND                                            ', 'NZ', '64', NULL, NULL),
(167, 'OMAN                                                   ', 'OM', '968', NULL, NULL),
(168, 'PANAMA                                                 ', 'PA', '507', NULL, NULL),
(169, 'PERU                                                   ', 'PE', '51', NULL, NULL),
(170, 'POLYNESIA (FRENCH)                                     ', 'PF', '', NULL, NULL),
(171, 'PAPUA NEW GUINEA                                       ', 'PG', '675', NULL, NULL),
(172, 'PHILIPPINES                                            ', 'PH', '63', NULL, NULL),
(173, 'PAKISTAN                                               ', 'PK', '92', NULL, NULL),
(174, 'POLAND                                                 ', 'PL', '48', NULL, NULL),
(175, 'SAINT PIERRE AND MIQUELON                              ', 'PM', '', NULL, NULL),
(176, 'PITCAIRN ISLAND                                        ', 'PN', '', NULL, NULL),
(177, 'PUERTO RICO                                            ', 'PR', '+1-787* or +1-939*', NULL, NULL),
(178, 'PORTUGAL                                               ', 'PT', '351', NULL, NULL),
(179, 'PALAU                                                  ', 'PW', '680', NULL, NULL),
(180, 'PARAGUAY                                               ', 'PY', '595', NULL, NULL),
(181, 'QATAR                                                  ', 'QA', '974', NULL, NULL),
(182, 'REUNION (FRENCH)                                       ', 'RE', '', NULL, NULL),
(183, 'ROMANIA                                                ', 'RO', '40', NULL, NULL),
(184, 'RUSSIAN FEDERATION                                     ', 'RU', '', NULL, NULL),
(185, 'RWANDA                                                 ', 'RW', '', NULL, NULL),
(186, 'SAUDI ARABIA                                           ', 'SA', '966', NULL, NULL),
(187, 'SOLOMON ISLANDS                                        ', 'SB', '677', NULL, NULL),
(188, 'SEYCHELLES                                             ', 'SC', '', NULL, NULL),
(189, 'SUDAN                                                  ', 'SD', '249', NULL, NULL),
(190, 'SWEDEN                                                 ', 'SE', '46', NULL, NULL),
(191, 'SINGAPORE                                              ', 'SG', '65', NULL, NULL),
(192, 'SAINT HELENA                                           ', 'SH', '', NULL, NULL),
(193, 'SLOVENIA                                               ', 'SI', '386', NULL, NULL),
(194, 'SVALBARD AND JAN MAYEN ISLANDS                         ', 'SJ', '', NULL, NULL),
(195, 'SLOVAK REPUBLIC                                        ', 'SK', '421', NULL, NULL),
(196, 'SIERRA LEONE                                           ', 'SL', '232', NULL, NULL),
(197, 'SAN MARINO                                             ', 'SM', '378', NULL, NULL),
(198, 'SENEGAL                                                ', 'SN', '221', NULL, NULL),
(199, 'SOMALIA                                                ', 'SO', '', NULL, NULL),
(200, 'SURINAME                                               ', 'SR', '597', NULL, NULL),
(201, 'SAINT TOME (SAO TOME) AND PRINCIPE                     ', 'ST', '', NULL, NULL),
(202, 'FORMER USSR                                            ', 'SU', '', NULL, NULL),
(203, 'EL SALVADOR                                            ', 'SV', '503', NULL, NULL),
(204, 'SYRIA                                                  ', 'SY', '963', NULL, NULL),
(205, 'SWAZILAND                                              ', 'SZ', '268', NULL, NULL),
(206, 'TURKS AND CAICOS ISLANDS                               ', 'TC', '+1-649*', NULL, NULL),
(207, 'CHAD                                                   ', 'TD', '235', NULL, NULL),
(208, 'FRENCH SOUTHERN TERRITORIES                            ', 'TF', '', NULL, NULL),
(209, 'TOGO                                                   ', 'TG', '', NULL, NULL),
(210, 'THAILAND                                               ', 'TH', '66', NULL, NULL),
(211, 'TADJIKISTAN                                            ', 'TJ', '', NULL, NULL),
(212, 'TOKELAU                                                ', 'TK', '690', NULL, NULL),
(213, 'TURKMENISTAN                                           ', 'TM', '993', NULL, NULL),
(214, 'TUNISIA                                                ', 'TN', '216', NULL, NULL),
(215, 'TONGA                                                  ', 'TO', '', NULL, NULL),
(216, 'EAST TIMOR                                             ', 'TP', '670', NULL, NULL),
(217, 'TURKEY                                                 ', 'TR', '90', NULL, NULL),
(218, 'TRINIDAD AND TOBAGO                                    ', 'TT', '', NULL, NULL),
(219, 'TUVALU                                                 ', 'TV', '688', NULL, NULL),
(220, 'TAIWAN                                                 ', 'TW', '886', NULL, NULL),
(221, 'TANZANIA                                               ', 'TZ', '255', NULL, NULL),
(222, 'UKRAINE                                                ', 'UA', '380', NULL, NULL),
(223, 'UGANDA                                                 ', 'UG', '256', NULL, NULL),
(224, 'UNITED KINGDOM                                         ', 'UK', '44', NULL, NULL),
(225, 'USA MINOR OUTLYING ISLANDS                             ', 'UM', '', NULL, NULL),
(226, 'UNITED STATES                                          ', 'US', '', NULL, NULL),
(227, 'URUGUAY                                                ', 'UY', '598', NULL, NULL),
(228, 'UZBEKISTAN                                             ', 'UZ', '998', NULL, NULL),
(229, 'HOLY SEE (VATICAN CITY STATE)                          ', 'VA', '', NULL, NULL),
(230, 'SAINT VINCENT & GRENADINES                             ', 'VC', '', NULL, NULL),
(231, 'VENEZUELA                                              ', 'VE', '58', NULL, NULL),
(232, 'VIRGIN ISLANDS (BRITISH)                               ', 'VG', '', NULL, NULL),
(233, 'VIRGIN ISLANDS (USA)                                   ', 'VI', '', NULL, NULL),
(234, 'VIETNAM                                                ', 'VN', '84', NULL, NULL),
(235, 'VANUATU                                                ', 'VU', '678', NULL, NULL),
(236, 'WALLIS AND FUTUNA ISLANDS                              ', 'WF', '681', NULL, NULL),
(237, 'SAMOA                                                  ', 'WS', '', NULL, NULL),
(238, 'YEMEN                                                  ', 'YE', '967', NULL, NULL),
(239, 'MAYOTTE                                                ', 'YT', '', NULL, NULL),
(240, 'YUGOSLAVIA                                             ', 'YU', '', NULL, NULL),
(241, 'SOUTH AFRICA                                           ', 'ZA', '27', NULL, NULL),
(242, 'ZAMBIA                                                 ', 'ZM', '260', NULL, NULL),
(243, 'ZAIRE                                                  ', 'ZR', '', NULL, NULL),
(244, 'ZIMBABWE                                               ', 'ZW', '263', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cuisine`
--

CREATE TABLE IF NOT EXISTS `cuisine` (
  `cs_id` int(11) NOT NULL AUTO_INCREMENT,
  `cs_name` text NOT NULL,
  `cs_status` int(11) NOT NULL,
  PRIMARY KEY (`cs_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `cuisine`
--

INSERT INTO `cuisine` (`cs_id`, `cs_name`, `cs_status`) VALUES
(1, 'Starter', 0),
(2, 'Soup', 0),
(3, 'Desserts', 0),
(4, 'Thali', 0),
(5, 'test', 1),
(6, 'sadasd', 1),
(7, 'asad', 1),
(8, 'fdfgdfg', 1),
(9, 'saafadasdasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `c_id` int(11) NOT NULL,
  `c_name` text NOT NULL,
  `c_address` text NOT NULL,
  `c_contact` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(255) NOT NULL,
  `dept_code` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_name`, `dept_code`, `status`) VALUES
(1, 'Dept 1', 'D1', '1'),
(2, 'Dept 2', 'D2', '1'),
(3, 'Dept 3', 'D3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE IF NOT EXISTS `designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desig_name` varchar(255) NOT NULL,
  `desig_code` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `desig_name`, `desig_code`, `status`) VALUES
(1, 'Desig 1', 'Desg_1', '1'),
(2, 'Desig 2', 'Desg_2', '1'),
(3, 'Desig 3', 'Desg_3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(255) NOT NULL,
  `emp_image` varchar(255) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_phone_no` varchar(255) NOT NULL,
  `emp_country` varchar(255) NOT NULL,
  `emp_state` varchar(255) NOT NULL,
  `emp_city` varchar(255) NOT NULL,
  `emp_dob` varchar(255) NOT NULL,
  `emp_address` varchar(255) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `emp_name`, `emp_image`, `emp_email`, `emp_phone_no`, `emp_country`, `emp_state`, `emp_city`, `emp_dob`, `emp_address`, `dept_id`, `status`) VALUES
(1, 'Khawaja Ammad Badar', '14711176968392739.jpg', 'ammadkhawaja2@gmail.com', '+923320569001', 'Pakistan', 'Punjab', 'Rawalpindi', '08/21/2016', 'House # AA-123', 0, '1'),
(2, 'Zahir Abbas', '14711290009699499.jpg', 'sowasted26@gmail.com', '+923320569001', 'Pakistan', 'Punjab', 'Rawalpindi', '08/30/2016', 'asdad', 0, '1'),
(3, 'Ali Muhammad', '14711972299699494.jpg', 'ali_muhammad123@gmail.com', '+92454454551', 'Pakistan', 'Punjab', 'Rawalpindi', '07/31/2016', 'House # AA-3232', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `exp_id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_date` date NOT NULL,
  `exp_amount` float NOT NULL,
  `exp_status` int(11) NOT NULL DEFAULT '0',
  `ei_id` int(11) NOT NULL,
  PRIMARY KEY (`exp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`exp_id`, `exp_date`, `exp_amount`, `exp_status`, `ei_id`) VALUES
(1, '2016-12-02', 20, 0, 2),
(2, '2016-12-02', 200, 0, 2),
(3, '2016-12-03', 20, 0, 2),
(4, '2016-12-03', 200, 0, 4),
(5, '2016-12-03', 80, 0, 3),
(6, '2016-12-26', 100, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `exp_items`
--

CREATE TABLE IF NOT EXISTS `exp_items` (
  `ei_id` int(11) NOT NULL AUTO_INCREMENT,
  `ei_name` text NOT NULL,
  `ei_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ei_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `exp_items`
--

INSERT INTO `exp_items` (`ei_id`, `ei_name`, `ei_status`) VALUES
(1, 'testdfdfdf', 1),
(2, 'Ata', 0),
(3, 'Sugar', 0),
(4, 'Laundry', 0);

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE IF NOT EXISTS `halls` (
  `hl_id` int(11) NOT NULL AUTO_INCREMENT,
  `hl_name` text NOT NULL,
  `hl_status` int(11) NOT NULL,
  PRIMARY KEY (`hl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`hl_id`, `hl_name`, `hl_status`) VALUES
(1, 'hall2', 0),
(3, 'hall1', 0),
(4, 'asdasda', 1),
(5, 'asdasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hall_exp`
--

CREATE TABLE IF NOT EXISTS `hall_exp` (
  `he_id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_desc` text NOT NULL,
  `exp_price` float NOT NULL,
  `exp_status` int(11) NOT NULL DEFAULT '0',
  `bh_id` int(11) NOT NULL,
  PRIMARY KEY (`he_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `hall_exp`
--

INSERT INTO `hall_exp` (`he_id`, `exp_desc`, `exp_price`, `exp_status`, `bh_id`) VALUES
(1, 'test', 300, 0, 1),
(2, 'tsdts', 200, 0, 1),
(3, 'Test', 2000, 0, 3),
(4, '', 200, 0, 0),
(5, 'tEST', 10000, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `hall_service`
--

CREATE TABLE IF NOT EXISTS `hall_service` (
  `hs_id` int(11) NOT NULL AUTO_INCREMENT,
  `hs_name` text NOT NULL,
  `hs_amount` float NOT NULL,
  `hs_status` int(11) NOT NULL,
  PRIMARY KEY (`hs_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hall_service`
--

INSERT INTO `hall_service` (`hs_id`, `hs_name`, `hs_amount`, `hs_status`) VALUES
(1, 'Generator', 500, 0),
(2, 'Sound System', 1000, 0),
(3, 'tests', 10, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `hall_view`
--
CREATE TABLE IF NOT EXISTS `hall_view` (
`tax` float
,`entry_date` date
,`total` float
,`exp_price` float
);
-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `i_id` int(11) NOT NULL AUTO_INCREMENT,
  `mc_id` int(11) NOT NULL,
  `i_name` text NOT NULL,
  `i_price` float NOT NULL,
  `i_status` int(11) NOT NULL,
  `cs_id` int(11) NOT NULL,
  PRIMARY KEY (`i_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`i_id`, `mc_id`, `i_name`, `i_price`, `i_status`, `cs_id`) VALUES
(3, 3, 'Chicken', 450, 0, 3),
(2, 3, 'Fries', 50, 0, 2),
(4, 3, 'Meat', 100, 0, 3),
(5, 3, 'test', 10, 1, 1),
(6, 3, 'sadas', 111, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `desig_id` int(11) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `emp_id`, `dept_id`, `desig_id`, `salary`, `start_date`, `end_date`, `status`) VALUES
(1, 1, 1, 1, '35000', '2016/08/13', '2016/08/14', '1'),
(8, 1, 1, 2, '60000', '2016/08/13', '', '1'),
(9, 2, 1, 2, '45000', '2016/08/14', '', '1'),
(10, 3, 3, 2, '30000', '2016/08/14', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
  `mng_id` int(11) NOT NULL AUTO_INCREMENT,
  `mng_name` text NOT NULL,
  `mng_contact` text NOT NULL,
  PRIMARY KEY (`mng_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE IF NOT EXISTS `menu_category` (
  `mc_id` int(11) NOT NULL AUTO_INCREMENT,
  `mc_name` text NOT NULL,
  `mc_status` int(11) NOT NULL,
  PRIMARY KEY (`mc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`mc_id`, `mc_name`, `mc_status`) VALUES
(2, 'Sweet', 0),
(3, 'Spicy', 0),
(4, 'Mild', 0),
(6, 'test', 1),
(7, 'test', 1),
(8, 'abc', 1),
(9, 'tetssts', 1),
(10, 'sadas', 1),
(11, 'view', 1),
(12, 'sghsaghdasasdasd', 1),
(13, 'asdassa', 1),
(14, 'adsas', 1),
(15, 'asasd', 1),
(16, 'ssad', 1),
(17, 'asdassd', 1),
(18, 'asdsd', 1),
(19, 'sadsad', 1),
(20, 'sadas', 1),
(21, 'ads', 1),
(22, 'sdasd', 1),
(23, 'test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_hall`
--

CREATE TABLE IF NOT EXISTS `menu_hall` (
  `mn_id` int(11) NOT NULL AUTO_INCREMENT,
  `mn_desc` text NOT NULL,
  `mn_status` int(11) NOT NULL,
  `mn_rate` float NOT NULL,
  `mn_person` float NOT NULL,
  PRIMARY KEY (`mn_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `menu_hall`
--

INSERT INTO `menu_hall` (`mn_id`, `mn_desc`, `mn_status`, `mn_rate`, `mn_person`) VALUES
(2, '#2,#3', 0, 450, 5);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT,
  `tbl_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `u_id` int(11) NOT NULL,
  `waiter` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `bill` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `time` time NOT NULL,
  `extra` float NOT NULL,
  `res_id` int(11) NOT NULL,
  PRIMARY KEY (`o_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`o_id`, `tbl_id`, `date`, `u_id`, `waiter`, `status`, `bill`, `discount`, `time`, `extra`, `res_id`) VALUES
(2, 0, '2016-12-04', 0, 5, 0, 1, 50, '13:59:00', 100, 3),
(4, 2, '2016-12-02', 0, 8, 0, 1, 200, '10:57:00', 400, 0),
(5, 0, '2016-12-02', 0, 11, 0, 1, 100, '18:47:07', 100, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `or_id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `mc_id` int(11) NOT NULL,
  `i_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `or_status` int(11) NOT NULL,
  PRIMARY KEY (`or_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`or_id`, `quantity`, `price`, `mc_id`, `i_id`, `o_id`, `or_status`) VALUES
(1, 12, 600, 3, 2, 2, 0),
(8, 1, 450, 3, 3, 4, 0),
(3, 2, 100, 3, 2, 2, 0),
(4, 1, 450, 3, 3, 2, 0),
(5, 2, 900, 3, 3, 2, 0),
(6, 4, 1800, 3, 3, 2, 0),
(7, 2, 900, 2, 2, 5, 0),
(9, 1, 450, 3, 3, 4, 0),
(10, 3, 1350, 3, 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

CREATE TABLE IF NOT EXISTS `payment_mode` (
  `paymentid` int(11) NOT NULL AUTO_INCREMENT,
  `payment_option` varchar(30) NOT NULL,
  `pay_status` int(11) NOT NULL,
  PRIMARY KEY (`paymentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 120832 kB' AUTO_INCREMENT=10 ;

--
-- Dumping data for table `payment_mode`
--

INSERT INTO `payment_mode` (`paymentid`, `payment_option`, `pay_status`) VALUES
(1, 'Cash', 0),
(2, 'Credit Card', 0),
(3, 'Cheque', 0),
(4, 'Company', 0),
(5, 'Money Order', 0),
(6, 'Western Union', 0),
(7, 'testss', 1),
(8, 'asdas', 1),
(9, 'asdasdasdasdasdasdasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE IF NOT EXISTS `reserve` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_date` date NOT NULL,
  `arrival` date NOT NULL,
  `guest_name` text NOT NULL,
  `accompany` text NOT NULL,
  `nic` text NOT NULL,
  `address` text NOT NULL,
  `room_no` int(11) NOT NULL,
  `rent` float NOT NULL,
  `purpose` text NOT NULL,
  `reference` text NOT NULL,
  `total_days` int(11) NOT NULL,
  `mobile_no` text NOT NULL,
  `vehicle_no` text NOT NULL,
  `check_out` time NOT NULL,
  `check_out_date` date NOT NULL,
  `entry_date` date NOT NULL,
  `res_status` int(11) NOT NULL,
  PRIMARY KEY (`res_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`res_id`, `res_date`, `arrival`, `guest_name`, `accompany`, `nic`, `address`, `room_no`, `rent`, `purpose`, `reference`, `total_days`, `mobile_no`, `vehicle_no`, `check_out`, `check_out_date`, `entry_date`, `res_status`) VALUES
(1, '2016-12-01', '2016-08-30', 'waleed', 'test', '12312323', 'islamabad', 1001, 1000, 'vacation', 'null', 3, '03435514441', '3456', '23:58:00', '2016-08-28', '2016-08-28', 0),
(2, '2016-12-02', '2015-10-28', 'asad', 'sadad', '2312313323', 'dadsadsdasdaasd', 101, 12, '21', 'adasdas', 12, '12122', '1212121212', '10:57:00', '2014-09-29', '2016-09-03', 0),
(3, '2016-12-02', '2015-10-29', 'dasdas', 'asdasd', '2313333', 'zxcc', 101, 500, 'sadasd', 'sadasd', 2, '123123232', '122', '22:57:00', '2015-09-29', '2016-09-09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_name` text NOT NULL,
  `mobile` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`r_id`, `r_name`, `mobile`, `phone`, `email`, `address`) VALUES
(1, 'Hillock', '0313 7757999', '0997 300227-6', 'info@hillock.com', 'Pine Hill Top,New By Pass Road Mansehra');

-- --------------------------------------------------------

--
-- Stand-in structure for view `rest_view`
--
CREATE TABLE IF NOT EXISTS `rest_view` (
`date` date
,`extra` float
,`price` float
,`o_id` int(11)
,`discount` int(11)
);
-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` text NOT NULL,
  `role_status` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_status`, `cat`) VALUES
(1, 'Admin', 0, 2),
(2, 'Super admin', 0, 1),
(3, 'Manager', 0, 3),
(4, 'Cashier', 0, 4),
(5, 'Waiter', 0, 5),
(7, 'Hotel Manager', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `rm_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_no` int(11) NOT NULL,
  `rt_id` int(11) NOT NULL,
  `rm_status` int(11) NOT NULL,
  PRIMARY KEY (`rm_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`rm_id`, `room_no`, `rt_id`, `rm_status`) VALUES
(1, 1001, 1, 0),
(2, 101, 1, 0),
(3, 1234, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms_types`
--

CREATE TABLE IF NOT EXISTS `rooms_types` (
  `rt_id` int(11) NOT NULL AUTO_INCREMENT,
  `rt_name` text NOT NULL,
  `rt_status` int(11) NOT NULL,
  PRIMARY KEY (`rt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rooms_types`
--

INSERT INTO `rooms_types` (`rt_id`, `rt_name`, `rt_status`) VALUES
(1, 'Master Bed Rooms', 0),
(2, 'sadsdasdsdasd', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `room_view`
--
CREATE TABLE IF NOT EXISTS `room_view` (
`total_days` int(11)
,`rent` float
,`res_date` date
);
-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE IF NOT EXISTS `salaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `to_date` date NOT NULL,
  `from_date` date NOT NULL,
  `presents` varchar(50) NOT NULL,
  `absents` varchar(50) NOT NULL,
  `leaves` varchar(50) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `bonus` varchar(50) NOT NULL,
  `total_salary` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `emp_id`, `to_date`, `from_date`, `presents`, `absents`, `leaves`, `salary`, `bonus`, `total_salary`) VALUES
(1, 1, '2016-08-31', '2016-08-01', '2', '1', '0', '4000', '2000', '6000');

-- --------------------------------------------------------

--
-- Table structure for table `service_rec`
--

CREATE TABLE IF NOT EXISTS `service_rec` (
  `sr_id` int(11) NOT NULL AUTO_INCREMENT,
  `hs_id` int(11) NOT NULL,
  `bd_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  PRIMARY KEY (`sr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `service_rec`
--

INSERT INTO `service_rec` (`sr_id`, `hs_id`, `bd_id`, `res_id`) VALUES
(20, 2, 1, 0),
(23, 2, 0, 3),
(24, 2, 0, 2),
(25, 1, 0, 3),
(26, 1, 12, 0),
(27, 2, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_id` int(11) NOT NULL,
  `i_quantity` int(11) NOT NULL,
  `stock_dt` datetime NOT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`st_id`, `i_id`, `i_quantity`, `stock_dt`) VALUES
(5, 3, 10, '2016-12-19 12:31:41'),
(6, 4, 12, '2016-12-19 12:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE IF NOT EXISTS `tables` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `tbl_name` text NOT NULL,
  `tbl_status` int(11) NOT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`tbl_id`, `tbl_name`, `tbl_status`) VALUES
(1, 'Table11', 0),
(2, 'Table2', 0),
(3, 'tbl3asda', 1),
(4, 'rrrr', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hotel`
--

CREATE TABLE IF NOT EXISTS `tbl_hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nhotelname` varchar(300) NOT NULL,
  `nhotelcode` varchar(300) NOT NULL,
  `straddress` varchar(300) NOT NULL,
  `strcity` varchar(300) NOT NULL,
  `strregion` varchar(300) NOT NULL,
  `strcountry` varchar(300) NOT NULL,
  `strphone` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `strUName` varchar(400) DEFAULT NULL,
  `strUEmail` varchar(400) DEFAULT NULL,
  `strUPass` varchar(400) DEFAULT NULL,
  `strUCode` varchar(400) DEFAULT NULL,
  `nH_id` int(11) DEFAULT NULL,
  `level` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `strUName`, `strUEmail`, `strUPass`, `strUCode`, `nH_id`, `level`) VALUES
(1, 'Khawaja Ammad Badar', 'ammadkhawaja2@gmail.com', '14e1b600b1fd579f47433b88e8d85291', 'UC1', 1, '1'),
(2, 'Usman Khan', 'sowasted26@gmail.com', '14e1b600b1fd579f47433b88e8d85291', 'U2', 1, '1'),
(4, 'Admin', 'admin', '123456', 'U3', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(6) NOT NULL AUTO_INCREMENT,
  `fname` varchar(25) NOT NULL,
  `sname` varchar(25) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pass` text NOT NULL,
  `phone` int(25) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `fax` int(11) DEFAULT NULL,
  `email` varchar(65) DEFAULT NULL,
  `dateregistered` date DEFAULT NULL,
  `countrycode` smallint(6) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `u_status` int(11) NOT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `userid` (`u_id`),
  UNIQUE KEY `loginname` (`username`),
  KEY `names` (`fname`,`sname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 121856 kB; InnoDB free: 121856 kB; InnoDB free:' AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `fname`, `sname`, `username`, `pass`, `phone`, `mobile`, `fax`, `email`, `dateregistered`, `countrycode`, `role_id`, `u_status`) VALUES
(5, '', '', 'wal', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0),
(6, '', '', 'ahmed', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 3, 1),
(7, '', '', 'superadmin', 'admin@123', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0),
(8, '', '', 'cashier', '123', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0),
(9, '', '', 'test', '123', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1),
(10, '', '', 'hmtest', '123', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0),
(11, '', '', 'waleed', '123', NULL, NULL, NULL, NULL, NULL, NULL, 5, 0);

-- --------------------------------------------------------

--
-- Structure for view `hall_view`
--
DROP TABLE IF EXISTS `hall_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hall_view` AS select `booking_hall`.`tax` AS `tax`,`booking_hall`.`entry_date` AS `entry_date`,`booking_hall`.`total` AS `total`,`hall_exp`.`exp_price` AS `exp_price` from (`booking_hall` join `hall_exp`) where ((`booking_hall`.`bh_status` = 0) and (`hall_exp`.`exp_status` = 0) and (`booking_hall`.`bh_id` = `hall_exp`.`bh_id`));

-- --------------------------------------------------------

--
-- Structure for view `rest_view`
--
DROP TABLE IF EXISTS `rest_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rest_view` AS select `order`.`date` AS `date`,`order`.`extra` AS `extra`,`order_detail`.`price` AS `price`,`order_detail`.`o_id` AS `o_id`,`order`.`discount` AS `discount` from (`order` join `order_detail` on(((`order`.`o_id` = `order_detail`.`o_id`) and (`order`.`bill` = 1) and (`order_detail`.`or_status` = 0))));

-- --------------------------------------------------------

--
-- Structure for view `room_view`
--
DROP TABLE IF EXISTS `room_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `room_view` AS select `reserve`.`total_days` AS `total_days`,`reserve`.`rent` AS `rent`,`reserve`.`res_date` AS `res_date` from `reserve` where (`reserve`.`res_status` = 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

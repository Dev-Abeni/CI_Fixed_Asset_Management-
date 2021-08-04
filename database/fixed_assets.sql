-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2020 at 09:44 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fixed_assets`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `asset_id` int(11) NOT NULL,
  `unicode` varchar(255) NOT NULL,
  `name` varchar(45) NOT NULL,
  `category_id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `date_of_acquisition` date NOT NULL,
  `original_price` double NOT NULL,
  `image_url` text NOT NULL,
  `is_disposed` tinyint(1) NOT NULL DEFAULT '0',
  `disposed_price` double NOT NULL,
  `is_canceled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`asset_id`, `unicode`, `name`, `category_id`, `vendor_id`, `date_of_acquisition`, `original_price`, `image_url`, `is_disposed`, `disposed_price`, `is_canceled`) VALUES
(17, 'J2ERE32', 'Toyota Hilux 256', 8, 2, '2020-05-07', 2123400, 'http://localhost/fixedassets/assets/images/images_(46)1.jpeg', 0, 0, 0),
(18, 'ERWY44353', 'Toyota Hiace High Roof', 8, 2, '2020-05-08', 4532462, 'http://localhost/fixedassets/assets/images/images_(46).jpeg', 1, 5300000, 0),
(19, 'BB44527', 'Microsoft Software Products ', 9, 1, '2020-05-20', 12000, 'http://localhost/fixedassets/assets/images/Microsoft1.jpeg', 0, 0, 0),
(21, 'ERWY44353', 'EPSON Printer A20C', 9, 1, '2020-05-05', 20000, 'http://localhost/fixedassets/assets/images/images_(46)4.jpeg', 1, 7000, 0),
(22, 'K454HD', 'Kaspersky Antivirus Software 2019', 10, 1, '2015-06-12', 567, 'http://localhost/fixedassets/assets/images/kaspersky2.jpeg', 0, 0, 0),
(23, 'DE76284874', 'Dell Optiplex Desktop Computer', 9, 1, '2020-06-13', 18345.599609375, 'http://localhost/fixedassets/assets/images/Dell_optiplex1.jpeg', 0, 0, 0),
(24, 'JSGDTYDBD', 'Dell computer 423526', 9, 1, '2019-07-05', 25000, 'http://localhost/fixedassets/assets/images/web-designing-services-500x500.png', 1, 20000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `asset_category`
--

CREATE TABLE `asset_category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `depreciation_percent` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_category`
--

INSERT INTO `asset_category` (`category_id`, `name`, `description`, `depreciation_percent`) VALUES
(8, 'Vehicles', 'Vehicles', 20),
(9, 'Computer, software and accessories', 'Computer, software and accessories', 25),
(10, 'Construction machinery and equipment ', 'Construction machinery and equipment ', 20),
(11, 'Office furniture and appliance', 'Office furniture and appliance', 20),
(12, 'PRE organization cost', 'PRE organization cost', 20),
(13, 'Smaller electronic devices', 'Smaller electronic devices', 20),
(14, 'Office partitions', 'Office partitions', 20),
(15, 'Construction in progress', 'Construction in progress', 20),
(16, 'Lease hold land', 'Lease hold land', 20),
(17, 'Differed charges', 'Differed charges', 20),
(18, 'Building', 'Building ', 5);

-- --------------------------------------------------------

--
-- Table structure for table `asset_depreciation_schedule`
--

CREATE TABLE `asset_depreciation_schedule` (
  `depreciation_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `book_value` double NOT NULL,
  `depreciation_expense` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_depreciation_schedule`
--

INSERT INTO `asset_depreciation_schedule` (`depreciation_id`, `asset_id`, `date`, `book_value`, `depreciation_expense`) VALUES
(1, 21, '2020-06-13', 19465.753424658, 534.24657534247),
(3, 19, '2020-06-13', 11802.739726027, 197.2602739726),
(4, 17, '2020-06-13', 2080350.2465753, 43049.753424658),
(5, 23, '2020-06-13', 18345.6, 0),
(7, 18, '2020-06-13', 4443052.569863, 89407.430136986),
(8, 22, '2020-06-14', -1.2427397260275, 568.24273972603),
(9, 19, '2020-06-15', 11786.301369863, 213.69863013699),
(10, 17, '2020-06-15', 2078023.2328767, 45376.767123288),
(11, 18, '2020-06-15', 4438085.490411, 94374.509589041),
(12, 21, '2020-06-15', 19438.356164384, 561.64383561644),
(13, 23, '2020-06-15', 18320.469041096, 25.130958904108),
(14, 24, '2020-07-06', 18715.753424658, 6284.2465753425),
(15, 23, '2020-07-06', 18056.593588131, 289.00602124358);

-- --------------------------------------------------------

--
-- Table structure for table `asset_maintenance`
--

CREATE TABLE `asset_maintenance` (
  `maintenance_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `asset_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `cost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_maintenance`
--

INSERT INTO `asset_maintenance` (`maintenance_id`, `date`, `asset_id`, `name`, `description`, `cost`) VALUES
(2, '2020-06-15', 17, '2 escort tires', '2 escort tires for future uses.', 2300),
(7, '2020-06-17', 21, 'Microsoft', '', 2300),
(8, '2020-06-30', 17, 'Service', '', 12000),
(9, '2020-07-06', 24, 'Purchase of internal hard disk', '', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `asset_possession`
--

CREATE TABLE `asset_possession` (
  `possession_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_roles`
--

CREATE TABLE `auth_roles` (
  `role_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_roles`
--

INSERT INTO `auth_roles` (`role_id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Officer');

-- --------------------------------------------------------

--
-- Table structure for table `auth_users`
--

CREATE TABLE `auth_users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `account_status` tinyint(1) NOT NULL DEFAULT '0',
  `is_canceled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_users`
--

INSERT INTO `auth_users` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role_id`, `account_status`, `is_canceled`) VALUES
(1, 'Admin', '', 'Admin', '81e1942393980e254f040ecd3ca22f56', 1, 1, 0),
(2, 'Accountant', '', 'Accountant', '81e1942393980e254f040ecd3ca22f56', 2, 1, 0),
(3, 'Abenezer', 'Mulugeta', 'Abenezer', '202cb962ac59075b964b07152d234b70', 2, 1, 0),
(4, 'Teame', 'Gebru', 'Teame', '202cb962ac59075b964b07152d234b70', 1, 0, 0),
(5, 'Halima', 'Abdurahman', 'Halima', '202cb962ac59075b964b07152d234b70', 2, 0, 0),
(6, 'Hana', 'Tamirat', 'Hana', '202cb962ac59075b964b07152d234b70', 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `phonecode` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `iso`, `nicename`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua and Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei Darussalam', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Congo', 242),
(50, 'CD', 'Congo, the Democratic Republic of\r\nthe', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D''Ivoire', 225),
(54, 'HR', 'Croatia', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'EC', 'Ecuador', 593),
(63, 'EG', 'Egypt', 20),
(64, 'SV', 'El Salvador', 503),
(65, 'GQ', 'Equatorial Guinea', 240),
(66, 'ER', 'Eritrea', 291),
(67, 'EE', 'Estonia', 372),
(68, 'ET', 'Ethiopia', 251),
(69, 'FK', 'Falkland Islands (Malvinas)', 500),
(70, 'FO', 'Faroe Islands', 298),
(71, 'FJ', 'Fiji', 679),
(72, 'FI', 'Finland', 358),
(73, 'FR', 'France', 33),
(74, 'GF', 'French Guiana', 594),
(75, 'PF', 'French Polynesia', 689),
(76, 'TF', 'French Southern Territories', 0),
(77, 'GA', 'Gabon', 241),
(78, 'GM', 'Gambia', 220),
(79, 'GE', 'Georgia', 995),
(80, 'DE', 'Germany', 49),
(81, 'GH', 'Ghana', 233),
(82, 'GI', 'Gibraltar', 350),
(83, 'GR', 'Greece', 30),
(84, 'GL', 'Greenland', 299),
(85, 'GD', 'Grenada', 1473),
(86, 'GP', 'Guadeloupe', 590),
(87, 'GU', 'Guam', 1671),
(88, 'GT', 'Guatemala', 502),
(89, 'GN', 'Guinea', 224),
(90, 'GW', 'Guinea-Bissau', 245),
(91, 'GY', 'Guyana', 592),
(92, 'HT', 'Haiti', 509),
(93, 'HM', 'Heard Island and Mcdonald Islands', 0),
(94, 'VA', 'Holy See (Vatican City State)', 39),
(95, 'HN', 'Honduras', 504),
(96, 'HK', 'Hong Kong', 852),
(97, 'HU', 'Hungary', 36),
(98, 'IS', 'Iceland', 354),
(99, 'IN', 'India', 91),
(100, 'ID', 'Indonesia', 62),
(101, 'IR', 'Iran, Islamic Republic of', 98),
(102, 'IQ', 'Iraq', 964),
(103, 'IE', 'Ireland', 353),
(104, 'IL', 'Israel', 972),
(105, 'IT', 'Italy', 39),
(106, 'JM', 'Jamaica', 1876),
(107, 'JP', 'Japan', 81),
(108, 'JO', 'Jordan', 962),
(109, 'KZ', 'Kazakhstan', 7),
(110, 'KE', 'Kenya', 254),
(111, 'KI', 'Kiribati', 686),
(112, 'KP', 'Korea, Democratic People''s\r\nRepublic of', 850),
(113, 'KR', 'Korea, Republic of', 82),
(114, 'KW', 'Kuwait', 965),
(115, 'KG', 'Kyrgyzstan', 996),
(116, 'LA', 'Lao People''s Democratic Republic', 856),
(117, 'LV', 'Latvia', 371),
(118, 'LB', 'Lebanon', 961),
(119, 'LS', 'Lesotho', 266),
(120, 'LR', 'Liberia', 231),
(121, 'LY', 'Libyan Arab Jamahiriya', 218),
(122, 'LI', 'Liechtenstein', 423),
(123, 'LT', 'Lithuania', 370),
(124, 'LU', 'Luxembourg', 352),
(125, 'MO', 'Macao', 853),
(126, 'MK', 'Macedonia, the Former\r\nYugoslav Republic of', 389),
(127, 'MG', 'Madagascar', 261),
(128, 'MW', 'Malawi', 265),
(129, 'MY', 'Malaysia', 60),
(130, 'MV', 'Maldives', 960),
(131, 'ML', 'Mali', 223),
(132, 'MT', 'Malta', 356),
(133, 'MH', 'Marshall Islands', 692),
(134, 'MQ', 'Martinique', 596),
(135, 'MR', 'Mauritania', 222),
(136, 'MU', 'Mauritius', 230),
(137, 'YT', 'Mayotte', 269),
(138, 'MX', 'Mexico', 52),
(139, 'FM', 'Micronesia, Federated States of', 691),
(140, 'MD', 'Moldova, Republic of', 373),
(141, 'MC', 'Monaco', 377),
(142, 'MN', 'Mongolia', 976),
(143, 'MS', 'Montserrat', 1664),
(144, 'MA', 'Morocco', 212),
(145, 'MZ', 'Mozambique', 258),
(146, 'MM', 'Myanmar', 95),
(147, 'NA', 'Namibia', 264),
(148, 'NR', 'Nauru', 674),
(149, 'NP', 'Nepal', 977),
(150, 'NL', 'Netherlands', 31),
(151, 'AN', 'Netherlands Antilles', 599),
(152, 'NC', 'New Caledonia', 687),
(153, 'NZ', 'New Zealand', 64),
(154, 'NI', 'Nicaragua', 505),
(155, 'NE', 'Niger', 227),
(156, 'NG', 'Nigeria', 234),
(157, 'NU', 'Niue', 683),
(158, 'NF', 'Norfolk Island', 672),
(159, 'MP', 'Northern Mariana Islands', 1670),
(160, 'NO', 'Norway', 47),
(161, 'OM', 'Oman', 968),
(162, 'PK', 'Pakistan', 92),
(163, 'PW', 'Palau', 680),
(164, 'PS', 'Palestinian Territory, Occupied', 970),
(165, 'PA', 'Panama', 507),
(166, 'PG', 'Papua New Guinea', 675),
(167, 'PY', 'Paraguay', 595),
(168, 'PE', 'Peru', 51),
(169, 'PH', 'Philippines', 63),
(170, 'PN', 'Pitcairn', 0),
(171, 'PL', 'Poland', 48),
(172, 'PT', 'Portugal', 351),
(173, 'PR', 'Puerto Rico', 1787),
(174, 'QA', 'Qatar', 974),
(175, 'RE', 'Reunion', 262),
(176, 'RO', 'Romania', 40),
(177, 'RU', 'Russian Federation', 70),
(178, 'RW', 'Rwanda', 250),
(179, 'SH', 'Saint Helena', 290),
(180, 'KN', 'Saint Kitts and Nevis', 1869),
(181, 'LC', 'Saint Lucia', 1758),
(182, 'PM', 'Saint Pierre and Miquelon', 508),
(183, 'VC', 'Saint Vincent and the Grenadines', 1784),
(184, 'WS', 'Samoa', 684),
(185, 'SM', 'San Marino', 378),
(186, 'ST', 'Sao Tome and Principe', 239),
(187, 'SA', 'Saudi Arabia', 966),
(188, 'SN', 'Senegal', 221),
(189, 'CS', 'Serbia and Montenegro', 381),
(190, 'SC', 'Seychelles', 248),
(191, 'SL', 'Sierra Leone', 232),
(192, 'SG', 'Singapore', 65),
(193, 'SK', 'Slovakia', 421),
(194, 'SI', 'Slovenia', 386),
(195, 'SB', 'Solomon Islands', 677),
(196, 'SO', 'Somalia', 252),
(197, 'ZA', 'South Africa', 27),
(198, 'GS', 'South Georgia and the\r\nSouth Sandwich Islands', 0),
(199, 'ES', 'Spain', 34),
(200, 'LK', 'Sri Lanka', 94),
(201, 'SD', 'Sudan', 249),
(202, 'SR', 'Suriname', 597),
(203, 'SJ', 'Svalbard and Jan Mayen', 47),
(204, 'SZ', 'Swaziland', 268),
(205, 'SE', 'Sweden', 46),
(206, 'CH', 'Switzerland', 41),
(207, 'SY', 'Syrian Arab Republic', 963),
(208, 'TW', 'Taiwan, Province of China', 886),
(209, 'TJ', 'Tajikistan', 992),
(210, 'TZ', 'Tanzania, United Republic of', 255),
(211, 'TH', 'Thailand', 66),
(212, 'TL', 'Timor-Leste', 670),
(213, 'TG', 'Togo', 228),
(214, 'TK', 'Tokelau', 690),
(215, 'TO', 'Tonga', 676),
(216, 'TT', 'Trinidad and Tobago', 1868),
(217, 'TN', 'Tunisia', 216),
(218, 'TR', 'Turkey', 90),
(219, 'TM', 'Turkmenistan', 7370),
(220, 'TC', 'Turks and Caicos Islands', 1649),
(221, 'TV', 'Tuvalu', 688),
(222, 'UG', 'Uganda', 256),
(223, 'UA', 'Ukraine', 380),
(224, 'AE', 'United Arab Emirates', 971),
(225, 'GB', 'United Kingdom', 44),
(226, 'US', 'United States', 1),
(227, 'UM', 'United States Minor Outlying Islands', 1),
(228, 'UY', 'Uruguay', 598),
(229, 'UZ', 'Uzbekistan', 998),
(230, 'VU', 'Vanuatu', 678),
(231, 'VE', 'Venezuela', 58),
(232, 'VN', 'Viet Nam', 84),
(233, 'VG', 'Virgin Islands, British', 1284),
(234, 'VI', 'Virgin Islands, U.s.', 1340),
(235, 'WF', 'Wallis and Futuna', 681),
(236, 'EH', 'Western Sahara', 212),
(237, 'YE', 'Yemen', 967),
(238, 'ZM', 'Zambia', 260),
(239, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `name`, `description`) VALUES
(2, 'Finance', 'The finance department is responsible for managing the finance structure of the hospital.'),
(3, 'Management', 'The management department is responsible for managing the overall aspects of the hospital.'),
(5, 'Securtiy', 'The security department is responsible for the hospital''s security.');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `designation_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`designation_id`, `name`) VALUES
(3, 'Manager'),
(4, 'Accountant'),
(6, 'Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` int(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `image_url` text NOT NULL,
  `is_canceled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `name`, `phone`, `email`, `department_id`, `designation_id`, `image_url`, `is_canceled`) VALUES
(2, 'Abraham Haile', 2147483647, 'abrahama@yahoo.com', 2, 3, 'http://localhost/fixedassets/assets/images/luckie-2-e148608618091721.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `country_id` int(11) NOT NULL,
  `city` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` int(25) NOT NULL,
  `state` varchar(45) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `image_url` text NOT NULL,
  `is_canceled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `name`, `country_id`, `city`, `email`, `phone`, `state`, `address`, `description`, `image_url`, `is_canceled`) VALUES
(1, 'Microsoft', 226, 'New York', 'info@microsoft.com', 2147483647, 'New york', '', 'This vendor has a lot of useful software systems that could be used by our company. It also has a good reputation in delivering good hardware products', 'http://localhost/fixedassets/assets/images/Microsoft.jpeg', 0),
(2, 'MOENCO', 68, 'Addis Ababa', 'info@moenco.com', 2147483647, 'Addis Ababa', '', '', 'http://localhost/fixedassets/assets/images/MOENCO.jpeg', 0),
(4, 'Kaspersky', 226, 'New york', 'info@kaspersky.com', 328472335, 'New york', '', '', 'http://localhost/fixedassets/assets/images/kaspersky3.jpeg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`asset_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `asset_category`
--
ALTER TABLE `asset_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `asset_depreciation_schedule`
--
ALTER TABLE `asset_depreciation_schedule`
  ADD PRIMARY KEY (`depreciation_id`),
  ADD KEY `asset_id` (`asset_id`);

--
-- Indexes for table `asset_maintenance`
--
ALTER TABLE `asset_maintenance`
  ADD PRIMARY KEY (`maintenance_id`),
  ADD KEY `asset_id` (`asset_id`);

--
-- Indexes for table `asset_possession`
--
ALTER TABLE `asset_possession`
  ADD PRIMARY KEY (`possession_id`),
  ADD KEY `asset_id` (`asset_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `auth_roles`
--
ALTER TABLE `auth_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `auth_users`
--
ALTER TABLE `auth_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `designation_id` (`designation_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `country_id` (`country_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `asset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `asset_category`
--
ALTER TABLE `asset_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `asset_depreciation_schedule`
--
ALTER TABLE `asset_depreciation_schedule`
  MODIFY `depreciation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `asset_maintenance`
--
ALTER TABLE `asset_maintenance`
  MODIFY `maintenance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `asset_possession`
--
ALTER TABLE `asset_possession`
  MODIFY `possession_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `auth_roles`
--
ALTER TABLE `auth_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `auth_users`
--
ALTER TABLE `auth_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `asset`
--
ALTER TABLE `asset`
  ADD CONSTRAINT `asset_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asset_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `asset_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `asset_depreciation_schedule`
--
ALTER TABLE `asset_depreciation_schedule`
  ADD CONSTRAINT `asset_depreciation_schedule_ibfk_1` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`asset_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `asset_maintenance`
--
ALTER TABLE `asset_maintenance`
  ADD CONSTRAINT `asset_maintenance_ibfk_1` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`asset_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `asset_possession`
--
ALTER TABLE `asset_possession`
  ADD CONSTRAINT `asset_possession_ibfk_1` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`asset_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asset_possession_ibfk_4` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_users`
--
ALTER TABLE `auth_users`
  ADD CONSTRAINT `auth_users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `auth_roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`designation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

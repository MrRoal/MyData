-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 06, 2016 at 06:37 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `happyhour`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_mod_per_admin`
--

DROP TABLE IF EXISTS `acc_mod_per_admin`;
CREATE TABLE IF NOT EXISTS `acc_mod_per_admin` (
  `iAccessId` int(11) NOT NULL AUTO_INCREMENT,
  `iAdminId` int(11) NOT NULL,
  `tListing` text,
  `tAdd` text,
  `tUpdate` text,
  `tDelete` text,
  `tActive` text,
  `tInactive` text,
  `tExportMerchant` text,
  `tExportUsers` text,
  `tSendPushnotification` text,
  PRIMARY KEY (`iAccessId`),
  KEY `iAdminId` (`iAdminId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `acc_mod_per_admin`
--

INSERT INTO `acc_mod_per_admin` (`iAccessId`, `iAdminId`, `tListing`, `tAdd`, `tUpdate`, `tDelete`, `tActive`, `tInactive`, `tExportMerchant`, `tExportUsers`, `tSendPushnotification`) VALUES
(3, 17, '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', NULL, '6', ''),
(15, 18, '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', '', '6', ''),
(32, 1, '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', '4,5,6,8,9,10,11,12', '5', '6', '13'),
(46, 11, '1,4,5,6,8,9,10,11,12,13,14,15', '1,4,5,6,8,9,10,11,12,13,14,15', '1,4,5,6,8,9,10,11,12,13,14,15', '1,4,5,6,8,9,10,11,12,13,14,15', '1,4,5,6,8,9,10,11,12,13,14,15', '1,4,5,6,8,9,10,11,12,13,14,15', '5', '6', '13'),
(47, 2, '1,4,5,6,8,9,10,11,12,13,14,15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 13, '1,4,5,6,8,9,10,11,12,13,14,15', '1,4,5,6,8,9,10,11,12,13,14,15', '1,4,5,6,8,9,10,11,12,13,14,15', '1,4,5,6,8,9,10,11,12,13,14,15', '1,4,5,6,8,9,10,11,12,13,14,15', '1,4,5,6,8,9,10,11,12,13,14,15', '5', '6', '13');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `iAdminId` int(11) NOT NULL AUTO_INCREMENT,
  `vFirstName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vLastName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vEmail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vPassword` varchar(255) CHARACTER SET utf8 NOT NULL,
  `iMobileNo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dCreatedDate` date NOT NULL,
  `dModifiedDate` date NOT NULL,
  `eRole` enum('Admin','Subadmin') NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`iAdminId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`iAdminId`, `vFirstName`, `vLastName`, `vEmail`, `vPassword`, `iMobileNo`, `dCreatedDate`, `dModifiedDate`, `eRole`, `eStatus`) VALUES
(1, 'Robert', 'Brown', 'admin@gmail.com', 'DShjDShj', '8888888888', '2015-10-28', '0000-00-00', 'Admin', 'Active'),
(2, 'William', 'Porter', 'subadmin@gmail.com', 'DShjDShj', '7777777777', '2015-10-28', '0000-00-00', 'Subadmin', 'Active'),
(3, 'Jennifer', 'Lawrence', 'jennifer.lawrence@gmail.com', 'DShjDShj', '88665522334', '2015-10-29', '2015-11-17', 'Subadmin', 'Active'),
(11, 'Michle', 'Buttler', 'vipul@gmail.com', 'DShjDShj', '95656565656', '2015-11-03', '2015-11-17', 'Subadmin', 'Active'),
(12, 'Test', 'abc', 'testbrand@gmail.com', 'DShj', '21321312321', '2015-11-20', '0000-00-00', 'Subadmin', 'Active'),
(13, 'demo', 'testing', 'demo.tasting@gmail.com', 'DShjDShj', '+6567565765', '2015-12-28', '0000-00-00', 'Admin', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `admin_modules`
--

DROP TABLE IF EXISTS `admin_modules`;
CREATE TABLE IF NOT EXISTS `admin_modules` (
  `iModuleId` int(11) NOT NULL AUTO_INCREMENT,
  `iParentId` int(11) NOT NULL,
  `vPath` varchar(255) NOT NULL,
  `vModuleName` varchar(100) NOT NULL,
  `iDisporder` int(11) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`iModuleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `admin_modules`
--

INSERT INTO `admin_modules` (`iModuleId`, `iParentId`, `vPath`, `vModuleName`, `iDisporder`, `eStatus`) VALUES
(1, 0, 'home', 'Dashboard', 1, 'Active'),
(2, 0, '', 'Admin Management', 2, 'Active'),
(3, 0, '', 'Manage Bar / Pub', 3, 'Active'),
(4, 3, 'bar_pub_owner', 'Owners', 4, 'Active'),
(5, 3, 'bar', 'Bar / Pub', 5, 'Active'),
(6, 0, 'user', 'Manage Users', 6, 'Active'),
(7, 0, '', 'General Settings', 8, 'Active'),
(8, 7, 'faqcategory', 'FAQ Categories', 9, 'Active'),
(9, 7, 'faq', 'FAQ', 10, 'Active'),
(10, 7, 'emailtemplate', 'Email Templates', 11, 'Active'),
(11, 7, 'contact_us', 'Contact US / Feedback', 13, 'Active'),
(12, 7, 'configuration', 'Settings', 15, 'Active'),
(13, 0, 'pushnotification', 'Push Notification', 7, 'Active'),
(14, 7, 'mobile_screen', 'Mobile Screen', 12, 'Active'),
(15, 7, 'static_page', 'Static Page', 14, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `appdevices`
--

DROP TABLE IF EXISTS `appdevices`;
CREATE TABLE IF NOT EXISTS `appdevices` (
  `AppDeviceId` int(11) NOT NULL AUTO_INCREMENT,
  `AppId` int(32) NOT NULL,
  `DeviceId` int(32) NOT NULL,
  `DeviceActive` tinyint(1) NOT NULL DEFAULT '1',
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `LaunchCount` int(11) NOT NULL,
  PRIMARY KEY (`AppDeviceId`),
  KEY `AppId` (`AppId`),
  KEY `DeviceId` (`DeviceId`),
  KEY `DeviceEnabled` (`DeviceActive`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `appdevicesubscriptions`
--

DROP TABLE IF EXISTS `appdevicesubscriptions`;
CREATE TABLE IF NOT EXISTS `appdevicesubscriptions` (
  `AppDeviceSubscriptionId` int(11) NOT NULL AUTO_INCREMENT,
  `DeviceId` int(11) NOT NULL,
  `AppSubscriptionId` int(11) NOT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SubscriptionEnabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`AppDeviceSubscriptionId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

DROP TABLE IF EXISTS `apps`;
CREATE TABLE IF NOT EXISTS `apps` (
  `AppId` int(32) NOT NULL AUTO_INCREMENT,
  `AppName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vProjectName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tGoogleApi` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`AppId`),
  KEY `DateAdded` (`DateAdded`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`AppId`, `AppName`, `vProjectName`, `DateAdded`, `tGoogleApi`) VALUES
(1, 'HAPPYHOUR', 'HAPPYHOUR', '2015-12-02 07:45:35', 'AIzaSyANnQowkege7Ix1mK5Ty48odmlNgFhqUiY');

-- --------------------------------------------------------

--
-- Table structure for table `appsubscriptions`
--

DROP TABLE IF EXISTS `appsubscriptions`;
CREATE TABLE IF NOT EXISTS `appsubscriptions` (
  `AppSubscriptionId` int(11) NOT NULL AUTO_INCREMENT,
  `AppId` int(11) NOT NULL,
  `SubscriptionName` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`AppSubscriptionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bar`
--

DROP TABLE IF EXISTS `bar`;
CREATE TABLE IF NOT EXISTS `bar` (
  `iBarId` int(11) NOT NULL AUTO_INCREMENT,
  `iOwnerId` int(11) NOT NULL,
  `vBarName` varchar(255) NOT NULL,
  `vBarImage` varchar(255) NOT NULL,
  `tAboutBar` text NOT NULL,
  `vAtmosphere` varchar(255) NOT NULL,
  `vFacilities` varchar(255) NOT NULL,
  `vLanguage` varchar(255) NOT NULL,
  `tMoreInformation` text NOT NULL,
  `tHighlight` text NOT NULL,
  `tTearmsCondition` text NOT NULL,
  `opening_hours` varchar(20) NOT NULL,
  `closing_hours` varchar(20) NOT NULL,
  `opening_hours_mon` varchar(20) NOT NULL,
  `opening_hours_tues` varchar(20) NOT NULL,
  `opening_hours_wed` varchar(20) NOT NULL,
  `opening_hours_thur` varchar(20) NOT NULL,
  `opening_hours_fri` varchar(20) NOT NULL,
  `opening_hours_sat` varchar(20) NOT NULL,
  `opening_hours_sun` varchar(20) NOT NULL,
  `closing_hours_mon` varchar(20) NOT NULL,
  `closing_hours_tues` varchar(20) NOT NULL,
  `closing_hours_wed` varchar(20) NOT NULL,
  `closing_hours_thur` varchar(20) NOT NULL,
  `closing_hours_fri` varchar(20) NOT NULL,
  `closing_hours_sat` varchar(20) NOT NULL,
  `closing_hours_sun` varchar(20) NOT NULL,
  `tAddress` text NOT NULL,
  `vlatitude` varchar(50) NOT NULL,
  `vLongitude` varchar(50) NOT NULL,
  `eFeatured` enum('Yes','No') NOT NULL,
  `vRedeemCode` varchar(15) NOT NULL,
  `fDiscount` float(5,2) NOT NULL,
  `eDiscountType` enum('Percentage','Amount') NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`iBarId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `bar`
--

INSERT INTO `bar` (`iBarId`, `iOwnerId`, `vBarName`, `vBarImage`, `tAboutBar`, `vAtmosphere`, `vFacilities`, `vLanguage`, `tMoreInformation`, `tHighlight`, `tTearmsCondition`, `opening_hours`, `closing_hours`, `opening_hours_mon`, `opening_hours_tues`, `opening_hours_wed`, `opening_hours_thur`, `opening_hours_fri`, `opening_hours_sat`, `opening_hours_sun`, `closing_hours_mon`, `closing_hours_tues`, `closing_hours_wed`, `closing_hours_thur`, `closing_hours_fri`, `closing_hours_sat`, `closing_hours_sun`, `tAddress`, `vlatitude`, `vLongitude`, `eFeatured`, `vRedeemCode`, `fDiscount`, `eDiscountType`, `eStatus`) VALUES
(6, 8, 'Green Pub', '', 'Enjoy party with Bear', '', '', '', 'no more information', 'no more highlight', '', '09:00 AM', '12:00 PM', '01:30 PM', '02:30 PM', '02:30 PM', '02:30 PM', '02:30 PM', '02:30 PM', '02:30 PM', '03:30 PM', '05:30 PM', '04:30 PM', '04:30 PM', '04:30 PM', '04:30 PM', '05:30 PM', 'Fortune Landmark, Ahmedabad, Gujarat, India', '23.022505', '72.57136209999999', 'Yes', '5678', 20.00, 'Percentage', 'Active'),
(7, 8, 'Republic Bar', 'Todi-Mill-Social-Interiors-2.jpg', 'Bear Bar', '', '', '', 'No More information', 'No', '', '09:00 AM', '12:00 PM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', 'Holiday Inn Express Ahmedabad Ashram Road, Ahmedabad', '32.3307407', '76.5502682', 'Yes', '3467', 100.00, 'Amount', 'Active'),
(8, 8, 'Republic Bar', 'bridge-beer.jpg', 'Bear Bar', '', '', '', 'No More information', 'No', '', '09:00 AM', '12:00 PM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', 'Holiday Inn Express Ahmedabad Ashram Road, Ahmedabad', '32.3307407', '76.5502682', 'Yes', '7890', 50.00, 'Percentage', 'Active'),
(9, 9, 'Jennifer Bear Bar', 'bar.jpg', '<p>BEARS BAR is located in the heart of the gay district of Chueca, is a meeting point for Bears, Chubs, Daddies, and Admirers.<br />BEARS BAR is an international and friendly place where you can find friends in Madrid and around the world.<br />BEARS BAR is the seat of MADBEAR (Bears Club Madrid).</p>', 'Family, Business Meeting, Family Friendly', 'Child Friendly, Credit Card, Parkinh', 'English, Thai', '', '<p><strong style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;">Lorem Ipsum</strong><span style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '', '09:00 AM', '12:00 PM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '10:00 PM', 'Holiday Inn Express Ahmedabad Ashram Road, Ahmedabad, Gujarat, India', '29.4642026', '-94.60650249999998', 'Yes', '2345', 50.00, 'Amount', 'Active'),
(10, 9, 'Jennifer Cocktail Pubs', 'featuring-the-fireplace.jpg', '<p><span style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</span></p>', 'Family, Business Meeting, Family Friendly', 'Child Friendly, Credit Card, Parkinh', 'English, Thai', '', '<p><span style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</span></p>', '', '11:00 AM', '12:00 PM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', 'Holiday Inn Express Ashram Road, Ahmedabad, Gujarat, India', '23.0420', '72.5695', 'Yes', '1234', 10.00, 'Percentage', 'Active'),
(11, 5, 'Fat Angel', 'two.jpg', '', 'Family, Business Meeting, Family Friendly', 'Child Friendly, Credit Card, Parkinh', 'English', '', '<p><strong style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;">Lorem Ipsum</strong><span style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '', '11:00 AM', '12:00 PM', '10:00 AM', '10:00 AM', '10:00 AM', '10:00 AM', '10:00 AM', '10:00 AM', '10:00 AM', '12:00 PM', '12:00 PM', '12:00 PM', '12:00 PM', '12:00 PM', '12:00 PM', '12:00 PM', 'CG Road, Bapu Nagar, Usmanpura, Ahmedabad, Gujarat, India', '50.8850706', '12.080720299999939', 'Yes', '2343', 10.00, 'Percentage', 'Active'),
(12, 9, 'Jack''s Place Restaurant', '41c83002fb1b866a7d41278655_original.jpg', '<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;"><span style="box-sizing: border-box; color: #000000;">It all started when Mr. Say Lip Hai arrived in Singapore from Hainan island and started as a cookboy with the British troops in Sembawang learning how to prepare the perfect roast beef and Yorkshire pudding. After learning the skills, he started his first restaurant, which was called Cola Restaurant and Bar in 1967. The restaurant served the British and Commonwealth troops and their families residing in Sembawang neighborhood.</span></p>\n<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;"><span style="box-sizing: border-box; color: #000000;">Mr. Say Lip Hai&rsquo;s break came in 1968 when a British housewife tasted the steak prepared by him and suggested that he start a catering business in her husband&rsquo;s pub in Killiney Road. Her husband&rsquo;s name was Jack Hunt. Mr. Say agreed with the condition that he take over the whole kitchen operation leading to the birth of the famous Jack&rsquo;s Place Steak House. Jack Hunt sold the business to Mr. Say in 1974 and relocated back to England.</span></p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px; font-size: 1.1em; line-height: 1.6em; color: #000000; font-family: MyriadProRegular, verdana, sans-serif; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-align: center;"><span style="box-sizing: border-box; color: #000000;">Today, the company is led by an aggressive management team, comprising of 2nd and 3rd generation family members and professional managers.</span></p>', 'Family, Business Meeting, Family Friendly', 'Child Friendly, Credit Card, Parkinh', 'English', '', '<p><strong style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;">Lorem Ipsum</strong><span style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '<p><strong style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;">Lorem Ipsum</strong><span style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '09:00 AM', '11:00 PM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '10:00 PM', '10:00 PM', '10:00 PM', '10:00 PM', '10:00 PM', '10:00 PM', '10:00 PM', 'Holiday Inn Express Ahmedabad Ashram Road, Ahmedabad, Gujarat, India', '32.3307407', '76.5502682', 'Yes', '8462', 50.00, 'Percentage', 'Active'),
(13, 7, 'Prata Planet Pte Ltd', '2_770x575_fillbg_7b0fad6d66.JPG', '<p><span style="color: #212329; font-family: hgw-OpenSans, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 18px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: #ffffff;">Prata Planet is located under a HDB block in Clementi Avenue 4 (3 minutes on foot from Clementi MRT), operating since 2005. This family restaurant has a wide menu ranging from the sweet to savory - pratas, nasi briyani, tandoori, naans, murtabak, North and South Indian dishes - catering to the palate of all young and old, vegetarians and meat-lovers; and serving quality food at affordable prices in a comfortable, cosy setting</span></p>', 'Family, Business Meeting, Family Friendly', 'Child Friendly, Credit Card, Parkinh', 'English', '', '<p><strong style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;">Lorem Ipsum</strong><span style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '<p><strong style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;">Lorem Ipsum</strong><span style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '11:00 AM', '12:00 PM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '09:00 PM', '10:00 PM', '10:00 PM', '10:00 PM', '10:00 PM', '10:00 PM', '09:00 PM', 'KFC - CG Road, Ahmedabad, Gujarat, India', '32.8096045', '-98.09130429999999', 'No', '3614', 50.00, 'Percentage', 'Active'),
(14, 7, 'Daisy''s Dream Kitchen', 'bg-steak-mobile.jpg', '<p><span style="color: #212329; font-family: hgw-OpenSans, Arial, sans-serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 18px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: #ffffff;">Peranakan hawker stall Daisy''s Dream Kitchen at Tiong Bahru Market has expanded into a restaurant located at West Coast Road, offering favourites from its previous outlet and also introducing new dishes. Prices tend to be higher but diners can enjoy their meals at the comfort of air conditioning.</span></p>', 'Family, Business Meeting, Family Friendly', 'Child Friendly, Credit Card, Parkinh', 'English', '', '<p><strong style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;">Lorem Ipsum</strong><span style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '<p><strong style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;">Lorem Ipsum</strong><span style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '08:00 AM', '12:00 PM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '10:00 PM', '10:00 PM', '10:00 PM', '10:00 PM', '10:00 PM', '10:00 PM', '10:00 PM', 'Hotel Kanak, Purshottam Mavlankar Marg, Ellisbridge, Ahmedabad, Gujarat, India', '28.9093987', '75.86488310000004', 'Yes', '8649', 500.00, 'Amount', 'Active'),
(15, 5, 'Ha Li Fa Pte Ltd - BoBo Fishball', 'img_ourbrand.jpg', '<table style="font-family: Arial, Helvetica, sans-serif; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;" border="0" width="90%" cellspacing="0" cellpadding="0">\n<tbody>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;" colspan="3" valign="top">\n<p class="navi_main" style="font-size: 18px; color: #5a5858; font-weight: normal;"><span style="font-size: 18px;">The<span class="Apple-converted-space">&nbsp;</span><span style="color: #ee3126;">Company&nbsp;</span></span></p>\n</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;" colspan="3" valign="top" height="10">&nbsp;</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;" colspan="3" valign="top">\n<p class="contents" style="font-family: Helvetica, ''Helvetica LT Std Light'', ''Helvetica LT Std''; font-size: 11px; color: #5b5b5b; text-align: justify;">Ha Li Fa Pte Ltd, founded in 1987 and established in 1993, was brought to life by Mrs. Ang''s belief that a family''s prosperity is firmly rooted in the solidarity of its members. She clearly conveyed this message to her children resulting in their passionate involvement, ever since childhood, in the production of fishballs.</p>\n<p class="contents" style="font-family: Helvetica, ''Helvetica LT Std Light'', ''Helvetica LT Std''; font-size: 11px; color: #5b5b5b; text-align: justify;">Since its inception, Ha Li Fa Pte Ltd, through its "BoBo" brand, has gained a firm foothold in local and international markets. Its logistic network and production processes are well developed to deliver high-quality products that cater to changing consumer tastes and demands. After all, being customer driven has always been at the core of the BoBo brand.</p>\n</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;" colspan="3" valign="top">&nbsp;</td>\n</tr>\n</tbody>\n</table>\n<table style="font-family: Arial, Helvetica, sans-serif; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;" border="0" width="90%" cellspacing="0" cellpadding="0">\n<tbody>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;" colspan="3" valign="top">\n<p class="navi_main" style="font-size: 18px; color: #5a5858; font-weight: normal;"><span style="font-size: 18px;">Everyday''s a<span class="Apple-converted-space">&nbsp;</span><span style="color: #ee3126;">Celebration</span></span></p>\n</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;" valign="top" height="10">&nbsp;</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;" valign="top" height="20">\n<p class="contents" style="font-family: Helvetica, ''Helvetica LT Std Light'', ''Helvetica LT Std''; font-size: 11px; color: #5b5b5b; text-align: justify;">We celebrate not just important and significant events, but also the little things in life that bring joy and happiness. We believe in spreading the simple joys we find in life through our products in all occasions. To marvel and savour the wonder.</p>\n</td>\n</tr>\n</tbody>\n</table>', 'Family, Business Meeting, Family Friendly', 'Child Friendly, Credit Card, Parkinh', 'English', '', '<p><strong style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;">Lorem Ipsum</strong><span style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '<p><strong style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;">Lorem Ipsum</strong><span style="color: #000000; font-family: Arial, Helvetica, sans; font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 14px; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '09:00 AM', '12:00 PM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '08:00 AM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', '09:00 PM', 'Fortune Landmark, Ahmedabad, Gujarat, India', '23.022505', '72.57136209999999', 'No', '9348', 200.00, 'Amount', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `bar_gallery`
--

DROP TABLE IF EXISTS `bar_gallery`;
CREATE TABLE IF NOT EXISTS `bar_gallery` (
  `iBarGalleryId` int(11) NOT NULL AUTO_INCREMENT,
  `iBarId` int(11) NOT NULL,
  `vImage` varchar(255) NOT NULL,
  PRIMARY KEY (`iBarGalleryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `bar_gallery`
--

INSERT INTO `bar_gallery` (`iBarGalleryId`, `iBarId`, `vImage`) VALUES
(2, 6, 'wallpapers-hd-8000-8331-hd-wallpapers.jpg'),
(5, 6, 'afil.jpg'),
(6, 8, 'JN7A6773-V2.jpg'),
(7, 8, 'bridge-beer.jpg'),
(8, 8, 'fotofilip-hl-graceinteriorportraits-2851.jpg'),
(12, 10, 'bar.jpg'),
(13, 10, 'bikerbar2.jpg'),
(14, 10, 'tasklist.txt'),
(15, 15, 'bar1.jpg'),
(16, 15, 'pub-cheers.jpg'),
(17, 15, 'timthumb.jpg'),
(18, 15, 'IMG_5610.jpg'),
(19, 15, 'bull-in-a-china-shop-shoreditch.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bar_owner`
--

DROP TABLE IF EXISTS `bar_owner`;
CREATE TABLE IF NOT EXISTS `bar_owner` (
  `iOwnerId` int(11) NOT NULL AUTO_INCREMENT,
  `vFirstName` varchar(255) NOT NULL,
  `vLastName` varchar(255) NOT NULL,
  `vEmail` varchar(255) NOT NULL,
  `vPassword` varchar(255) NOT NULL,
  `iMobileNo` varchar(255) NOT NULL,
  `dCreatedDate` datetime NOT NULL,
  `dModifiedDate` datetime NOT NULL,
  `eDesignation` enum('Administrator','Owner') NOT NULL,
  `eNotification` enum('Email','Phone','Both') DEFAULT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`iOwnerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `bar_owner`
--

INSERT INTO `bar_owner` (`iOwnerId`, `vFirstName`, `vLastName`, `vEmail`, `vPassword`, `iMobileNo`, `dCreatedDate`, `dModifiedDate`, `eDesignation`, `eNotification`, `eStatus`) VALUES
(5, 'sagar', 'shah', 'superadmin@gmail.com', 'DShjDShj', '+6512345678', '2015-11-03 00:00:00', '2016-01-06 00:00:00', 'Owner', 'Email', 'Active'),
(7, 'Anee', 'Mathews', 'anee@gmail.com', 'DShjDShj', '+652423', '2015-11-03 00:00:00', '2016-01-06 00:00:00', 'Administrator', 'Both', 'Active'),
(8, 'Sandra', 'Bullock', 'khyati.patel@techiestown.com', 'DShjDShj', '+65456789', '2015-11-04 00:00:00', '2016-01-06 00:00:00', 'Owner', 'Email', 'Active'),
(9, 'Jennifer', 'Lawrence', 'modhrahul3@gmail.com', 'DShjDShj', '+650380357', '2015-11-17 00:00:00', '2016-01-06 00:00:00', 'Owner', 'Phone', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `bar_rating`
--

DROP TABLE IF EXISTS `bar_rating`;
CREATE TABLE IF NOT EXISTS `bar_rating` (
  `iRatingId` int(11) NOT NULL AUTO_INCREMENT,
  `iBarId` int(11) NOT NULL,
  `iUserId` int(11) NOT NULL,
  `eStar` enum('1','2','3','4','5') NOT NULL,
  PRIMARY KEY (`iRatingId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `bar_rating`
--

INSERT INTO `bar_rating` (`iRatingId`, `iBarId`, `iUserId`, `eStar`) VALUES
(1, 6, 2, '3'),
(2, 6, 3, '2'),
(3, 8, 5, '4'),
(4, 8, 8, '5'),
(5, 9, 4, '2'),
(6, 10, 9, '5'),
(7, 10, 17, '3'),
(8, 10, 25, '4'),
(9, 10, 35, '1'),
(10, 10, 31, '2'),
(11, 7, 20, '4');

-- --------------------------------------------------------

--
-- Table structure for table `bar_table`
--

DROP TABLE IF EXISTS `bar_table`;
CREATE TABLE IF NOT EXISTS `bar_table` (
  `iBarTableId` int(11) NOT NULL AUTO_INCREMENT,
  `iBarId` int(11) NOT NULL,
  `vTableName` varchar(255) NOT NULL,
  `iSizeOfTable` int(11) NOT NULL,
  PRIMARY KEY (`iBarTableId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `book_bar`
--

DROP TABLE IF EXISTS `book_bar`;
CREATE TABLE IF NOT EXISTS `book_bar` (
  `iBookBarId` int(11) NOT NULL AUTO_INCREMENT,
  `vBookCode` varchar(255) NOT NULL,
  `iBarId` int(11) NOT NULL,
  `iUserId` int(11) NOT NULL,
  `vName` varchar(255) NOT NULL,
  `vEmail` varchar(255) NOT NULL,
  `vMobileNo` varchar(100) NOT NULL,
  `dAddedDate` datetime NOT NULL,
  `dModifyDate` datetime NOT NULL,
  `eStatus` enum('Confirm','Complete','Cancel') NOT NULL,
  `dBookDate` datetime NOT NULL,
  `vNoOfPerson` varchar(100) NOT NULL,
  `vDiscount` varchar(20) NOT NULL,
  `vMerchantCode` varchar(20) NOT NULL,
  `eDiscountType` enum('Percentage','Amount') NOT NULL,
  `dRedeemDate` datetime NOT NULL,
  `eRole` enum('User','Guest') NOT NULL,
  PRIMARY KEY (`iBookBarId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `book_bar`
--

INSERT INTO `book_bar` (`iBookBarId`, `vBookCode`, `iBarId`, `iUserId`, `vName`, `vEmail`, `vMobileNo`, `dAddedDate`, `dModifyDate`, `eStatus`, `dBookDate`, `vNoOfPerson`, `vDiscount`, `vMerchantCode`, `eDiscountType`, `dRedeemDate`, `eRole`) VALUES
(1, 'BAR602', 6, 1, 'khyati patel', 'khyati.patel@techiestown.com', '9898441556', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cancel', '2015-12-09 00:00:00', '4', '20.00', '5678', 'Percentage', '2015-12-16 00:00:00', 'User'),
(2, 'BAR274', 7, 2, 'Bhavin Shah', 'bhavin.shah@techiestown.com', '9898441556', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cancel', '2015-12-09 00:00:00', '4', '', '', 'Percentage', '0000-00-00 00:00:00', 'User'),
(7, 'BAR608', 6, 9, 'Nidhi Dave', 'nidhi@gmail.com', '9988776688', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cancel', '2015-12-27 11:40:00', '', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(8, 'BAR323', 8, 10, 'Rahul gandhi', 'rahul.gandhi@techiestown.com', '9988776655', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cancel', '2015-12-09 00:00:00', '4', '50.00', '7890', 'Percentage', '2015-12-22 00:00:00', 'Guest'),
(9, 'BAR090', 8, 1, 'khyati patel', 'khyati.patel@techiestown.com', '9898441556', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cancel', '2015-12-09 00:00:00', '4', '50.00', '7890', 'Percentage', '2015-12-22 00:00:00', 'User'),
(10, 'BAR102', 7, 1, 'khyati patel', 'khyati.patel@techiestown.com', '9898441556', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-09 00:00:00', '4', '100.00', '3467', 'Amount', '2015-12-16 00:00:00', 'User'),
(11, 'BAR519', 6, 1, 'khyati patel', 'khyati.patel@techiestown.com', '9898441556', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-09 00:00:00', '4', '20.00', '5678', 'Percentage', '2015-12-16 00:00:00', 'User'),
(12, 'BAR249', 6, 3, 'keta meswania', 'keta.measwania@techiestown.com', '98987645343', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-09 00:00:00', '4', '', '', 'Percentage', '0000-00-00 00:00:00', 'User'),
(13, 'BAR006', 8, 3, 'keta meswania', 'keta.measwania@techiestown.com', '98987645343', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cancel', '2015-12-09 00:00:00', '4', '', '', 'Percentage', '0000-00-00 00:00:00', 'User'),
(15, 'BAR692', 8, 11, 'Khyati Patel', 'khyati.patel@techiestown.com', '9988776655', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-09 00:00:00', '4', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(16, 'BAR252', 8, 11, 'Khyati Patel', 'khyati.patel@techiestown.com', '9988776655', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-09 00:00:00', '4', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(17, 'BAR742', 8, 12, 'umesh baldaniya', 'umesh.baldaniya@techiestown.com', '9988776655', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cancel', '2015-12-09 00:00:00', '4', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(18, 'BAR874', 8, 11, 'khyati patel', 'khyati.patel@techiestown.com', '9988776655', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-10 00:00:00', '4', '', '', 'Percentage', '2015-12-10 00:00:00', 'Guest'),
(19, 'BAR698', 6, 1, 'khyati patel', 'khyati@techiestown.com', '9898441556', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-11 00:00:00', '10', '20.00', '5678', 'Percentage', '2015-12-16 00:00:00', 'User'),
(20, 'BAR059', 6, 1, 'khyati patel', 'khyati@techiestown.com', '9898441556', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-11 12:30:00', '10', '20.00', '5678', 'Percentage', '2015-12-16 00:00:00', 'User'),
(21, 'BAR344', 6, 1, 'khyati patel', 'khyati@techiestown.com', '9898441556', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-10 12:30:00', '10', '20.00', '5678', 'Percentage', '2015-12-16 00:00:00', 'User'),
(22, 'BAR976', 6, 14, 'demo ', 'demo@gmail.com', '98767895', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cancel', '2015-12-11 00:00:00', '3', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(23, 'BAR379', 6, 14, 'demo', 'demo@gmail.com', '98767895', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cancel', '2015-12-11 00:00:00', '3', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(24, 'BAR533', 6, 16, 'demo', 'demo1@gmail.com', '98767895', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cancel', '2015-12-11 00:00:00', '3', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(25, 'BAR026', 6, 16, 'demo', 'demo1@gmail.com', '98767895', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cancel', '2015-12-11 00:00:00', '3', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(26, 'BAR343', 13, 1, 'khyati patel', 'khyati@techiestown.com', '9898441556', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-17 21:15:00', '10', '50.00', '3614', 'Percentage', '2015-12-16 00:00:00', 'User'),
(27, 'BAR890', 14, 1, 'khyati patel', 'khyati@techiestown.com', '9898441556', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-16 21:15:00', '5', '500.00', '8649', 'Amount', '2015-12-16 00:00:00', 'User'),
(28, 'BAR944', 15, 1, 'khyati patel', 'khyati@techiestown.com', '9898441556', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-16 12:15:00', '4', '200.00', '9348', 'Amount', '2015-12-16 00:00:00', 'User'),
(29, 'BAR933', 12, 1, 'khyati patel', 'khyati@techiestown.com', '9898441556', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-18 22:15:00', '4', '20', '7420', 'Amount', '2015-12-16 00:00:00', 'User'),
(30, 'BAR293', 11, 1, 'khyati patel', 'khyati@techiestown.com', '9898441556', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-16 20:30:00', '4', '10.00', '2343', 'Percentage', '2015-12-18 00:00:00', 'User'),
(31, 'BAR609', 6, 17, 'Kena', 'kena@gmail.com', '9898989898', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cancel', '2015-12-16 00:00:00', '4', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(32, 'BAR782', 13, 1, 'khyati patel', 'khyati@techiestown.com', '9898441556', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Complete', '2015-12-16 00:00:00', '4', '50.00', '3614', 'Percentage', '2015-12-21 00:00:00', 'User'),
(33, 'BAR439', 8, 9, 'Nidhi Dave', 'nidhi@gmail.com', '9988776655', '2015-12-22 12:52:27', '0000-00-00 00:00:00', 'Cancel', '2015-12-23 00:00:00', '3', '', '', 'Percentage', '0000-00-00 00:00:00', 'User'),
(34, 'BAR919', 8, 1, 'khyati patel', 'khyati@techiestown.com', '9898441556', '2015-12-22 12:53:20', '0000-00-00 00:00:00', 'Complete', '2015-12-23 00:00:00', '3', '50.00', '7890', 'Percentage', '2015-12-22 00:00:00', 'User'),
(35, 'BAR857', 8, 1, 'khyati patel', 'khyati@techiestown.com', '9898441556', '2015-12-22 12:53:33', '0000-00-00 00:00:00', 'Cancel', '2015-12-22 00:00:00', '3', '', '', 'Percentage', '0000-00-00 00:00:00', 'User'),
(36, 'BAR712', 8, 1, 'khyati patel', 'khyati@techiestown.com', '9898441556', '2015-12-22 12:53:44', '0000-00-00 00:00:00', 'Cancel', '2015-12-22 00:00:00', '3', '', '', 'Percentage', '0000-00-00 00:00:00', 'User'),
(37, 'BAR057', 6, 18, '', '', '', '2016-01-02 18:13:20', '0000-00-00 00:00:00', 'Cancel', '2015-12-04 00:00:00', '2', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(38, 'BAR117', 6, 18, '', '', '', '2016-01-02 18:13:25', '0000-00-00 00:00:00', 'Cancel', '2015-12-04 00:00:00', '2', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(39, 'BAR673', 6, 11, 'Sneha', 'khyati.patel@techiestown.com', '7878789009', '2016-01-02 18:25:09', '0000-00-00 00:00:00', 'Cancel', '2015-12-04 00:00:00', '2', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(40, 'BAR721', 6, 11, 'Sneha', 'khyati.patel@techiestown.com', '7878789009', '2016-01-02 18:25:35', '0000-00-00 00:00:00', 'Cancel', '2015-12-04 00:00:00', '2', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(41, 'BAR415', 6, 11, 'Sneha', 'khyati.patel@techiestown.com', '7878789009', '2016-01-02 18:25:52', '0000-00-00 00:00:00', 'Cancel', '2015-12-04 00:00:00', '2', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(42, 'BAR858', 6, 11, 'Sneha', 'khyati.patel@techiestown.com', '7878789009', '2016-01-02 18:29:35', '0000-00-00 00:00:00', 'Cancel', '2015-12-04 00:00:00', '2', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(43, 'BAR281', 6, 19, 'Sneha', 'khyati.patel@techiestown.com', '7878789009', '2016-01-02 18:33:27', '0000-00-00 00:00:00', 'Cancel', '2015-12-04 00:00:00', '2', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(44, 'BAR016', 6, 19, 'Sneha', 'khyati.patel@techiestown.com', '7878789009', '2016-01-02 18:34:13', '0000-00-00 00:00:00', 'Cancel', '2015-12-04 00:00:00', '2', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(45, 'BAR924', 6, 1, 'khyati patel', 'khyati.patel@techiestown.com', '9898441556', '2016-01-02 18:36:30', '0000-00-00 00:00:00', 'Cancel', '2015-12-04 00:00:00', '2', '', '', 'Percentage', '0000-00-00 00:00:00', 'User'),
(46, 'BAR306', 6, 20, 'khyati Patel', 'khyati.patel@techiestown.com', '7878789009', '2016-01-02 18:37:48', '0000-00-00 00:00:00', 'Cancel', '2015-12-04 00:00:00', '2', '', '', 'Percentage', '0000-00-00 00:00:00', 'Guest'),
(47, 'BAR751', 7, 10, 'demo Tester', 'rahul.gandhi@techiestown.com', '8876788978', '2016-01-04 17:13:59', '0000-00-00 00:00:00', 'Confirm', '2015-01-04 11:30:15', '2', '', '', 'Percentage', '0000-00-00 00:00:00', 'User'),
(48, 'BAR541', 7, 10, 'demo Tester', 'rahul.gandhi@techiestown.com', '8876788978', '2016-01-04 17:17:00', '0000-00-00 00:00:00', 'Confirm', '2015-01-04 11:30:15', '2', '', '', 'Percentage', '0000-00-00 00:00:00', 'User'),
(49, 'BAR004', 7, 10, 'demo Tester', 'rahul.gandhi@techiestown.com', '8876788978', '2016-01-04 19:16:27', '0000-00-00 00:00:00', 'Confirm', '2015-01-04 11:30:15', '2', '', '', 'Percentage', '0000-00-00 00:00:00', 'User'),
(50, 'BAR311', 12, 10, 'demo Tester', 'rahul.gandhi@techiestown.com', '8876788978', '2016-01-04 19:17:20', '0000-00-00 00:00:00', 'Complete', '2015-01-04 11:30:15', '2', '50.00', '8462', 'Percentage', '2016-01-05 00:00:00', 'User'),
(51, 'BAR565', 12, 10, 'demo Tester', 'rahul.gandhi@techiestown.com', '8876788978', '2016-01-05 19:45:28', '0000-00-00 00:00:00', 'Confirm', '2016-01-05 11:30:00', '5', '', '', 'Percentage', '0000-00-00 00:00:00', 'User'),
(52, 'BAR755', 12, 10, 'demo Tester', 'rahul.gandhi@techiestown.com', '8876788978', '2016-01-05 19:47:08', '0000-00-00 00:00:00', 'Confirm', '2016-01-05 11:30:00', '5', '', '', 'Percentage', '0000-00-00 00:00:00', 'User'),
(53, 'BAR850', 12, 10, 'demo Tester', 'rahul.gandhi@techiestown.com', '8876788978', '2016-01-05 20:00:41', '0000-00-00 00:00:00', 'Confirm', '2016-01-05 11:30:00', '5', '', '', 'Percentage', '0000-00-00 00:00:00', 'User'),
(54, 'BAR336', 12, 10, 'demo Tester', 'rahul.gandhi@techiestown.com', '8876788978', '2016-01-05 20:06:57', '0000-00-00 00:00:00', 'Confirm', '2016-01-05 11:30:00', '5', '', '', 'Percentage', '0000-00-00 00:00:00', 'User'),
(55, 'BAR166', 12, 10, 'demo Tester', 'rahul.gandhi@techiestown.com', '8876788978', '2016-01-06 10:36:30', '0000-00-00 00:00:00', 'Confirm', '2016-01-06 11:30:00', '5', '', '', 'Percentage', '0000-00-00 00:00:00', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

DROP TABLE IF EXISTS `certificates`;
CREATE TABLE IF NOT EXISTS `certificates` (
  `CertificateId` int(11) NOT NULL AUTO_INCREMENT,
  `CertificateName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `AppId` int(11) NOT NULL,
  `KeyCertFile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Passphrase` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CertificateTypeId` int(11) NOT NULL,
  PRIMARY KEY (`CertificateId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`CertificateId`, `CertificateName`, `AppId`, `KeyCertFile`, `Passphrase`, `CertificateTypeId`) VALUES
(1, 'Development Certificate', 1, 'QubitMusiv_Development.pem', '123123', 1),
(2, 'Distribution Certificate', 1, 'Qubit_Distibution.pem', '123123', 2);

-- --------------------------------------------------------

--
-- Table structure for table `certificateserver`
--

DROP TABLE IF EXISTS `certificateserver`;
CREATE TABLE IF NOT EXISTS `certificateserver` (
  `CertificateServerId` int(11) NOT NULL AUTO_INCREMENT,
  `CertificateId` int(11) NOT NULL,
  `ServerId` int(11) NOT NULL,
  PRIMARY KEY (`CertificateServerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `certificatetypes`
--

DROP TABLE IF EXISTS `certificatetypes`;
CREATE TABLE IF NOT EXISTS `certificatetypes` (
  `CertificateTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `CertificateTypeName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CertificateTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

DROP TABLE IF EXISTS `configurations`;
CREATE TABLE IF NOT EXISTS `configurations` (
  `iSettingId` int(11) NOT NULL AUTO_INCREMENT,
  `tDescription` text NOT NULL,
  `vName` varchar(255) NOT NULL,
  `vValue` varchar(255) NOT NULL,
  `eType` varchar(255) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  `iOrderNo` int(11) NOT NULL,
  PRIMARY KEY (`iSettingId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`iSettingId`, `tDescription`, `vName`, `vValue`, `eType`, `eStatus`, `iOrderNo`) VALUES
(1, 'Site Name', 'SITE_NAME', 'Happy Hour', 'General', 'Active', 1),
(2, 'Site Url', 'SITE_URL', 'api/happyhour', 'General', 'Active', 2),
(3, 'Admin Email ID', 'EMAIL_ADMIN', 'admin@gmail.com', 'General', 'Active', 3),
(4, 'Half Rewards (Five Booking)', 'HALF_REWARDS', '20', 'General', 'Active', 4),
(5, 'Full Rewards (Ten Booking)', 'FULL_REWARDS', '50', 'General', 'Active', 5);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `iContectID` int(11) NOT NULL AUTO_INCREMENT,
  `vFirstName` varchar(255) NOT NULL,
  `vLastName` varchar(255) NOT NULL,
  `vEmail` varchar(255) NOT NULL,
  `iMobileNo` varchar(20) NOT NULL,
  `tMassage` text NOT NULL,
  `dAddedDate` datetime NOT NULL,
  PRIMARY KEY (`iContectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`iContectID`, `vFirstName`, `vLastName`, `vEmail`, `iMobileNo`, `tMassage`, `dAddedDate`) VALUES
(1, 'Rahul', 'Gandhi', 'rahul.gandhi@techiestown.com', '123456789', 'This is Testing Message', '2015-11-25 06:52:48'),
(2, 'Rahul', 'Gandhi', 'rahul.gandhi@techiestown.com', '8460380357', 'test', '2015-12-25 05:41:47'),
(3, 'Rahul', 'Gandhi', 'rahul.gandhi@techiestown.com', '8460380357', 'sadfsdf', '2015-12-25 06:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `DeviceId` int(32) NOT NULL AUTO_INCREMENT,
  `DeviceToken` varchar(71) COLLATE utf8_unicode_ci NOT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IsTestDevice` tinyint(1) NOT NULL,
  `DeviceNotes` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`DeviceId`),
  KEY `DeviceToken` (`DeviceToken`),
  KEY `DeviceToken_test` (`DeviceToken`,`IsTestDevice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `device_master`
--

DROP TABLE IF EXISTS `device_master`;
CREATE TABLE IF NOT EXISTS `device_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iUserId` int(11) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `device_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `device_type` varchar(255) NOT NULL,
  `device_token` varchar(71) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplate`
--

DROP TABLE IF EXISTS `emailtemplate`;
CREATE TABLE IF NOT EXISTS `emailtemplate` (
  `iEmailTemplateId` int(11) NOT NULL AUTO_INCREMENT,
  `vEmailCode` varchar(255) NOT NULL,
  `vEmailTitle` varchar(255) NOT NULL,
  `vFromName` varchar(255) NOT NULL,
  `vFromEmail` varchar(255) NOT NULL,
  `eEmailFormat` enum('HTML','Text') NOT NULL,
  `vEmailSubject` varchar(255) NOT NULL,
  `tEmailMessage` text NOT NULL,
  `vEmailFooter` varchar(255) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  `eSendType` enum('Administrator') NOT NULL,
  PRIMARY KEY (`iEmailTemplateId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `emailtemplate`
--

INSERT INTO `emailtemplate` (`iEmailTemplateId`, `vEmailCode`, `vEmailTitle`, `vFromName`, `vFromEmail`, `eEmailFormat`, `vEmailSubject`, `tEmailMessage`, `vEmailFooter`, `eStatus`, `eSendType`) VALUES
(1, 'NEWUSERREGISTER', 'Thanks for Registering at happy hour', 'Administrator', 'support@happyhour.com', 'HTML', 'Welcome to Happy Hour', '<!-- If you delete this tag, the sky will fall on your head -->\n<p>Email</p>\n<table style="border-right: 1px solid #d3d9dd; border-bottom: 20px solid #cc2131; padding: 1% 2% 3% 2%; margin: 0 0 0 2%; border-radius: 10px;" border="0" width="96%" cellspacing="0" cellpadding="0" bgcolor="#f2f5f7">\n<tbody>\n<tr>\n<td>\n<table border="0" width="100%" cellspacing="0" cellpadding="0">\n<tbody>\n<tr>\n<td><!-- HEADER -->\n<table style="border-radius: 5px; padding: 20px 0;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#cc2131">\n<tbody>\n<tr>\n<td align="center" valign="middle"><img src="#IMAGE_URL#/assets/image/ridein-logo-admin-inside.png" alt="" /></td>\n</tr>\n</tbody>\n</table>\n<!-- /HEADER END --></td>\n</tr>\n<tr>\n<td><!-- BODY -->\n<table style="padding: 10px 0 0 0;" border="0" width="100%" cellspacing="0" cellpadding="0">\n<tbody>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">Dear Customer,</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">\n<p>Customer Account Information:</p>\n</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">First Name : #FIRSTNAME#</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">Last Name : #LASTNAME#</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">Email ID: #EMAIL#</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">Password : #PASSWORD#</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">Kind Regards,<br /> happy hour</td>\n</tr>\n</tbody>\n</table>\n<!-- /BODY END --></td>\n</tr>\n</tbody>\n</table>\n</td>\n</tr>\n</tbody>\n</table>', 'Thank You!', 'Active', 'Administrator'),
(2, 'RESET_PASSWORD', 'Reset Password', 'Administrator', 'support@happyhour.com', 'HTML', 'Reset Your Password', '<!-- If you delete this tag, the sky will fall on your head -->\n<p>Email</p>\n<table style="border-right: 1px solid #d3d9dd; border-bottom: 20px solid #cc2131; padding: 1% 2% 2% 2%; margin: 0 0 0 2%; border-radius: 10px;" border="0" width="96%" cellspacing="0" cellpadding="0" bgcolor="#f2f5f7">\n<tbody>\n<tr>\n<td>\n<table border="0" width="100%" cellspacing="0" cellpadding="0">\n<tbody>\n<tr>\n<td><!-- HEADER -->\n<table style="border-radius: 5px; padding: 20px 0;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#cc2131">\n<tbody>\n<tr>\n<td align="center" valign="middle"><img style="color: white;" src="#IMAGE_URL#" alt="Happy Hour" /></td>\n</tr>\n</tbody>\n</table>\n<!-- /HEADER END --></td>\n</tr>\n<tr>\n<td><!-- BODY -->\n<table style="padding: 10px 0 0 0;" border="0" width="100%" cellspacing="0" cellpadding="0">\n<tbody>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">Hello #NAME#,</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 0 0 10px 10px;">\n<p>Please click for a Reset Password</p>\n</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 0 0 10px 10px;">&nbsp;</td>\n</tr>\n<tr>\n<td style="font-size: 20px; font-family: Clan,Helvetica,Arial,sans-serif; font-weight: normal; color: #ffffff!important; text-decoration: none; background-color: #cc2131; border-top: 12px solid #cc2131; border-bottom: 12px solid #CC2131; border-right: 5px solid #CC2131; border-left: 5px solid #CC2131; display: block; text-transform: uppercase; width: 40%; text-align: center!important; margin: 0 auto;"><a class="reset_password" style="font-size: 20px; font-family: Clan,Helvetica,Arial,sans-serif; font-weight: normal; text-decoration: none; background-color: #cc2131; border-top: 0px solid #cc2131; border-bottom: 0px solid #CC2131; border-right: 0px solid #CC2131; border-left: 5px solid #CC2131; display: block; text-transform: uppercase,width:10%; margin: 0 auto; color: #ffffff!important;" href="#LINK#" target="_blank"><span style="text-decoration: none !important; color: #ffffff !important;">Reset Password</span></a></td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 0 0 10px 10px;">&nbsp;</td>\n</tr>\n<tr>\n<td colspan="1">&nbsp;</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">Kind Regards,<br /> Happy Hour</td>\n</tr>\n</tbody>\n</table>\n</td>\n</tr>\n</tbody>\n</table>\n</td>\n</tr>\n</tbody>\n</table>', 'Thank You!', 'Active', 'Administrator'),
(3, 'CONTACTUS', 'Contact Us Information', 'Administrator', 'support@happyhour.com', 'HTML', 'Customer contact information.', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html xmlns="http://www.w3.org/1999/xhtml">\n<head>\n<!-- If you delete this tag, the sky will fall on your head -->\n<meta name="viewport" content="width=device-width" />\n\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\n<title>Email</title>\n\n</head>\n \n<body bgcolor="#FFFFFF">\n<table width="96%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f2f5f7" style="border-right: 1px solid #d3d9dd; border-bottom: 20px solid #0096FF; padding: 1% 2% 3% 2%; margin:0 0 0 2%; border-radius:10px;">\n  <tr>\n    <td>\n        <table width="100%" border="0" cellspacing="0" cellpadding="0">\n              <tr>\n                <td>\n                    <!-- HEADER -->\n                  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#0096FF" style="border-radius:5px; padding:10px 0 0 0;">\n                      <tr>\n                        <td align="center" valign="middle"><img src="#IMAGE_URL#" alt="" /> </td>\n                      </tr>\n                    </table>\n                    <!-- /HEADER END -->\n                </td>\n              </tr>\n              <tr>\n                <td>\n                    <!-- BODY -->\n                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:10px 0 0 0;">\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Dear Admin,</td>\n                          </tr>\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Following contact us/feedback posted via website , Kindly review those</td>\n                          </tr>\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">First Name : #FIRSTNAME#</td>\n                            \n                          </tr>\n\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Last Name : #LASTNAME#</td>\n                            \n                          </tr>\n                        \n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Email ID: #EMAIL#</td>\n                          </tr>\n\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Mobile No : #MOBILE#</td>\n                          </tr>\n\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Message : #MESSAGE#</td>\n                          </tr>\n                    </table>\n                    <!-- /BODY END -->\n                </td>\n              </tr>\n        </table>\n    </td>\n  </tr>\n</table>\n</body>\n</html>', 'http://www.happyhour.com<br>Thank You!', 'Active', 'Administrator'),
(4, 'RESERVATION', 'Thanks for Happy Hour Book Bar Reservation', 'Administrator', 'support@happyhour.com', 'HTML', 'Reservation', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html xmlns="http://www.w3.org/1999/xhtml">\n<head>\n<!-- If you delete this tag, the sky will fall on your head -->\n<meta name="viewport" content="width=device-width" />\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\n<title>Email</title>\n<style type="text/css">\n	element.style {\n	    border-top: 1px solid #ccc;\n	    padding: 1% 0;\n	}\n</style>\n</head>\n<body bgcolor="#FFFFFF">\n<table width="100%" cellspacing="0" cellpadding="0">\n	<tbody>\n		<tr>\n			<td align="center">\n				<table width="98%" cellspacing="0" cellpadding="0">\n					<tbody>\n						<tr>\n							<td style="background:#fff;color:white">\n								<img class="CToWUd" width="80" height="30" border="0" style="padding:2% 2%;max-width:100%;display:block" src="http://happyhour.coderspreview.com/assets/front/images/logo.png">\n							</td>\n						</tr>\n						<tr>\n							<td style="border-top:3px solid #0096ff"></td>\n						</tr>\n					</tbody>\n				</table>\n			</td>\n		</tr>\n		<tr>\n			<td align="center">\n				<table width="98%" cellspacing="0" cellpadding="0" style="padding-top:3%">\n					<tbody>\n						<tr>\n							<td width="95" align="center" style="border:1px solid #ccc;border-radius:5px;background-color:#fff">\n								<table width="100%" cellspacing="0" style="padding:2%;">\n									<tbody>\n										<tr>\n											<td align="left" style="font-size:15px">\n												<b>\n												Reservation detail\n												<span style="color:#bc202b"></span>\n												<b> </b>\n												</b>\n											</td>\n										</tr>\n										<tr>\n											<td width="100%">\n												<table width="100%" cellspacing="0" cellpadding="0" style="padding:1% 0 ;border-bottom:1px solid #ccc">\n													<tbody>\n														<tr>\n															<td width="40%" valign="top"> Reservation code : </td>\n															<td width="60%" valign="top">\n															<b>#BOOKCODE#</b>\n															</td>\n														</tr>\n													</tbody>\n												</table>\n											</td>\n										</tr>\n										<tr>\n											<td width="100%">\n												<table width="100%" cellspacing="0" cellpadding="0" style="padding:1% 0 ;border-bottom:1px solid #ccc">\n													<tbody>\n														<tr>\n															<td width="40%" valign="top"> Restaurant : </td>\n															<td width="60%" valign="top">\n															#BARNAME#\n															</td>\n														</tr>\n													</tbody>\n												</table>\n											</td>\n										</tr>\n										<tr>\n											<td width="100%">\n												<table width="100%" cellspacing="0" cellpadding="0" style="padding:1% 0;border-bottom:1px solid #ccc">\n													<tbody>\n														<tr>\n															<td width="40%" valign="top"> Date: </td>\n															<td width="60%" valign="top">\n															#BOOKDATE# \n															</td>\n														</tr>\n													</tbody>\n												</table>\n											</td>\n										</tr>\n										<tr>\n											<td width="100%">\n												<table width="100%" cellspacing="0" cellpadding="0" style="padding:1% 0;border-bottom:1px solid #ccc">\n													<tbody>\n														<tr>\n															<td width="40%" valign="top"> Discount :  </td>\n															<td width="60%" valign="top">\n															#DISCOUNT#\n															</td>\n														</tr>\n													</tbody>\n												</table>\n											</td>\n										</tr>\n										<tr>\n											<td width="100%">\n												<table width="100%" cellspacing="0" cellpadding="0" style="padding:1% 0;border-bottom:1px solid #ccc">\n													<tbody>\n														<tr>\n															<td width="40%" valign="top"> Covers :   </td>\n															<td width="60%" valign="top">\n															#vNoOfPerson# people\n															</td>\n														</tr>\n													</tbody>\n												</table>\n											</td>\n										</tr>\n										<tr>\n											<td width="100%">\n												<table width="100%" cellspacing="0" cellpadding="0" style="padding:1% 0;border-bottom:1px solid #ccc">\n													<tbody>\n														<tr>\n															<td width="40%" valign="top"> Name : </td>\n															<td width="60%" valign="top">\n															#NAME#\n															</td>\n														</tr>\n													</tbody>\n												</table>\n											</td>\n										</tr>\n										<tr>\n											<td width="100%">\n												<table width="100%" cellspacing="0" cellpadding="0" style="padding:1% 0">\n													<tbody>\n														<tr>\n															<td width="40%" valign="top"> Restaurant address :  </td>\n															<td width="60%" valign="top">\n															#ADDRESS#\n															</td>\n														</tr>\n													</tbody>\n												</table>\n											</td>\n										</tr>\n									</tbody>\n								</table>\n							</td>\n						</tr>\n					</tbody>\n				</table>\n			</td>\n		</tr>\n		<tr>\n        	<td align="center">\n            	<table width="98%" cellspacing="0" cellpadding="0" style="padding-bottom:3%;padding-top:3%">\n                    <tbody><tr>\n                        <td style="border:1px solid #ccc;border-radius:5px;background-color:#fff;padding-top:2%">\n                            #TERMS#\n                   		</td>\n                	</tr>\n            	</tbody></table>  \n            </td>\n        </tr>\n	</tbody>\n</table>\n</body>\n</html>\n<html xmlns="http://www.w3.org/1999/xhtml">\n<head>\n<!-- If you delete this tag, the sky will fall on your head -->\n<meta name="viewport" content="width=device-width" />\n\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\n<title>Email</title>\n<style type="text/css">\n	element.style {\n	    border-top: 1px solid #ccc;\n	    padding: 1% 0;\n	}\n</style>\n</head>\n \n<body bgcolor="#FFFFFF">\n\n<table width="100%" cellspacing="0" cellpadding="0">\n	<tbody>\n		<tr>\n			<td align="center">\n				<table width="98%" cellspacing="0" cellpadding="0">\n					<tbody>\n						<tr>\n							<td style="background:#fff;color:white">\n								<img class="CToWUd" width="80" height="30" border="0" style="padding:2% 2%;max-width:100%;display:block" src="http://happyhour.coderspreview.com/assets/front/images/logo.png">\n							</td>\n						</tr>\n						<tr>\n							<td style="border-top:3px solid #0096ff"></td>\n						</tr>\n					</tbody>\n				</table>\n			</td>\n		</tr>\n\n		<tr>\n			<td align="center">\n				<table width="98%" cellspacing="0" cellpadding="0" style="padding-top:3%">\n					<tbody>\n						<tr>\n							<td width="95" align="center" style="border:1px solid #ccc;border-radius:5px;background-color:#fff">\n								<table width="100%" cellspacing="0" style="padding:2%;">\n									<tbody>\n										<tr>\n											<td align="left" style="font-size:15px">\n												<b>\n												Reservation detail\n												<span style="color:#bc202b"></span>\n												<b> </b>\n												</b>\n											</td>\n										</tr>\n										<tr>\n											<td width="100%">\n												<table width="100%" cellspacing="0" cellpadding="0" style="padding:1% 0 ;border-bottom:1px solid #ccc">\n													<tbody>\n														<tr>\n															<td width="40%" valign="top"> Reservation code : </td>\n															<td width="60%" valign="top">\n															<b>#BOOKCODE#</b>\n															</td>\n														</tr>\n													</tbody>\n												</table>\n											</td>\n										</tr>\n										<tr>\n											<td width="100%">\n												<table width="100%" cellspacing="0" cellpadding="0" style="padding:1% 0 ;border-bottom:1px solid #ccc">\n													<tbody>\n														<tr>\n															<td width="40%" valign="top"> Restaurant : </td>\n															<td width="60%" valign="top">\n															#BARNAME#\n															</td>\n														</tr>\n													</tbody>\n												</table>\n											</td>\n										</tr>\n										<tr>\n											<td width="100%">\n												<table width="100%" cellspacing="0" cellpadding="0" style="padding:1% 0;border-bottom:1px solid #ccc">\n													<tbody>\n														<tr>\n															<td width="40%" valign="top"> Date: </td>\n															<td width="60%" valign="top">\n															#BOOKDATE# \n															</td>\n														</tr>\n													</tbody>\n												</table>\n											</td>\n										</tr>\n										<!-- <tr>\n											<td width="100%">\n												<table width="100%" cellspacing="0" cellpadding="0" style="padding:1% 0;border-bottom:1px solid #ccc">\n													<tbody>\n														<tr>\n															<td width="40%" valign="top"> Discount :  </td>\n															<td width="60%" valign="top">\n															#DISCOUNT#\n															</td>\n														</tr>\n													</tbody>\n												</table>\n											</td>\n										</tr> -->\n										<tr>\n											<td width="100%">\n												<table width="100%" cellspacing="0" cellpadding="0" style="padding:1% 0;border-bottom:1px solid #ccc">\n													<tbody>\n														<tr>\n															<td width="40%" valign="top"> Covers :   </td>\n															<td width="60%" valign="top">\n															#vNoOfPerson# people\n															</td>\n														</tr>\n													</tbody>\n												</table>\n											</td>\n										</tr>\n										<tr>\n											<td width="100%">\n												<table width="100%" cellspacing="0" cellpadding="0" style="padding:1% 0;border-bottom:1px solid #ccc">\n													<tbody>\n														<tr>\n															<td width="40%" valign="top"> Name : </td>\n															<td width="60%" valign="top">\n															#NAME#\n															</td>\n														</tr>\n													</tbody>\n												</table>\n											</td>\n										</tr>\n										<tr>\n											<td width="100%">\n												<table width="100%" cellspacing="0" cellpadding="0" style="padding:1% 0">\n													<tbody>\n														<tr>\n															<td width="40%" valign="top"> Restaurant address :  </td>\n															<td width="60%" valign="top">\n															#ADDRESS#\n															</td>\n														</tr>\n													</tbody>\n												</table>\n											</td>\n										</tr>\n\n									</tbody>\n								</table>\n							</td>\n						</tr>\n					</tbody>\n				</table>\n			</td>\n		</tr>\n		\n        <tr>\n        	<td align="center">\n            	<table width="98%" cellspacing="0" cellpadding="0" style="padding-bottom:3%">\n                    <tbody><tr>\n                        <td style="border:1px solid #ccc;border-radius:5px;background-color:#fff;padding-top:2%">\n                            #TERMS#\n                   		</td>\n                	</tr>\n            	</tbody></table>  \n            </td>\n        </tr>\n	</tbody>\n</table>\n</body>\n</html>', 'http://happyhour.coderspreview.com/<br>Thank You!', 'Active', 'Administrator'),
(5, 'ADMINRESERVATION', 'Customer reservation bar information', 'Administrator', 'support@happyhour.com', 'HTML', 'Customer reservation bar information', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html xmlns="http://www.w3.org/1999/xhtml">\n<head>\n<!-- If you delete this tag, the sky will fall on your head -->\n<meta name="viewport" content="width=device-width" />\n\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\n<title>Email</title>\n\n</head>\n \n<body bgcolor="#FFFFFF">\n<table width="96%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f2f5f7" style="border-right: 1px solid #d3d9dd; border-bottom: 20px solid #0096FF; padding: 1% 2% 3% 2%; margin:0 0 0 2%; border-radius:10px;">\n  <tr>\n    <td>\n        <table width="100%" border="0" cellspacing="0" cellpadding="0">\n              <tr>\n                <td>\n                    <!-- HEADER -->\n                  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#0096FF" style="border-radius:5px; padding:10px 0 0 0;">\n                      <tr>\n                        <td align="center" valign="middle"><img src="http://happyhour.coderspreview.com/assets/front/images/logo.png" alt="" /> </td>\n                      </tr>\n                    </table>\n                    <!-- /HEADER END -->\n                </td>\n              </tr>\n              <tr>\n                <td>\n                    <!-- BODY -->\n                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:10px 0 0 0;">\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Dear Admin,</td>\n                          </tr>\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Following booking bar - pubs reservation information :</td>\n                          </tr>\n\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Bar Name : #BARNAME#</td>\n                          </tr>\n\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Book date : #BOOKDATE#</td>\n                          </tr>\n\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">No of person : #vNoOfPerson#</td>\n                          </tr>\n\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Name : #NAME#</td>\n                            \n                          </tr>\n\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Email ID: #EMAIL#</td>\n                          </tr>   \n                    </table>\n                    <!-- /BODY END -->\n                </td>\n              </tr>\n        </table>\n    </td>\n  </tr>\n</table>\n</body>\n</html>', 'http://www.happyhour.com<br>Thank You!', 'Active', 'Administrator'),
(6, 'CANCLE', 'Cancle Reservation', 'Administrator', 'support@happyhour.com', 'HTML', 'Cancle Reservation', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html xmlns="http://www.w3.org/1999/xhtml">\n<head>\n<!-- If you delete this tag, the sky will fall on your head -->\n<meta name="viewport" content="width=device-width" />\n\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\n<title>Email</title>\n\n</head>\n \n<body bgcolor="#FFFFFF">\n<table width="96%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f2f5f7" style="border-right: 1px solid #d3d9dd; border-bottom: 20px solid #0096FF; padding: 1% 2% 3% 2%; margin:0 0 0 2%; border-radius:10px;">\n  <tr>\n    <td>\n        <table width="100%" border="0" cellspacing="0" cellpadding="0">\n              <tr>\n                <td>\n                    <!-- HEADER -->\n                  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#0096FF" style="border-radius:5px; padding:10px 0 10px 0;">\n                      <tr>\n                        <td align="center" valign="middle"><img src="http://happyhour.coderspreview.com/assets/front/images/logo.png" alt="" /> </td>\n                      </tr>\n                    </table>\n                    <!-- /HEADER END -->\n                </td>\n              </tr>\n              <tr>\n                <td>\n                    <!-- BODY -->\n                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:10px 0 0 0;">\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Dear #NAME#,</td>\n                          </tr>\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">User Cancle Your reservation on #BOOKDATE#</td>\n                          </tr>\n\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Bar Name : #BARNAME#</td>\n                          </tr>\n\n                          <tr>\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Book date : #BOOKDATE#</td>\n                          </tr>\n                    </table>\n                    <!-- /BODY END -->\n                </td>\n              </tr>\n        </table>\n    </td>\n  </tr>\n</table>\n</body>\n</html>', 'http://www.happyhour.com<br>Thank You!', 'Active', 'Administrator'),
(7, 'CONFIRM', 'Confirm Reservation', 'Administrator', 'support@happyhour.com', 'HTML', 'Confirm Reservation', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n<!-- If you delete this tag, the sky will fall on your head -->\r\n<meta name="viewport" content="width=device-width" />\r\n\r\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\r\n<title>Email</title>\r\n\r\n</head>\r\n \r\n<body bgcolor="#FFFFFF">\r\n<table width="96%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f2f5f7" style="border-right: 1px solid #d3d9dd; border-bottom: 20px solid #0096FF; padding: 1% 2% 3% 2%; margin:0 0 0 2%; border-radius:10px;">\r\n  <tr>\r\n    <td>\r\n        <table width="100%" border="0" cellspacing="0" cellpadding="0">\r\n              <tr>\r\n                <td>\r\n                    <!-- HEADER -->\r\n                  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#0096FF" style="border-radius:5px; padding:10px 0 10px 0;">\r\n                      <tr>\r\n                        <td align="center" valign="middle"><img src="http://happyhour.coderspreview.com/assets/front/images/logo.png" alt="" /> </td>\r\n                      </tr>\r\n                    </table>\r\n                    <!-- /HEADER END -->\r\n                </td>\r\n              </tr>\r\n              <tr>\r\n                <td>\r\n                    <!-- BODY -->\r\n                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:10px 0 0 0;">\r\n                          <tr>\r\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Dear #NAME#,</td>\r\n                          </tr>\r\n                          <tr>\r\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">User Cancle Your reservation on #BOOKDATE#</td>\r\n                          </tr>\r\n\r\n                          <tr>\r\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Bar Name : #BARNAME#</td>\r\n                          </tr>\r\n\r\n                          <tr>\r\n                            <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px 0 10px 10px;">Book date : #BOOKDATE#</td>\r\n                          </tr>\r\n                    </table>\r\n                    <!-- /BODY END -->\r\n                </td>\r\n              </tr>\r\n        </table>\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', 'http://www.happyhour.com<br>Thank You!', 'Active', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
  `iFaqId` int(11) NOT NULL AUTO_INCREMENT,
  `iFaqCategoryId` int(11) NOT NULL,
  `vQuestion` varchar(255) NOT NULL,
  `vAnswer` varchar(255) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`iFaqId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`iFaqId`, `iFaqCategoryId`, `vQuestion`, `vAnswer`, `eStatus`) VALUES
(1, 3, 'trrth', 'asdasda', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `faq_category`
--

DROP TABLE IF EXISTS `faq_category`;
CREATE TABLE IF NOT EXISTS `faq_category` (
  `iFaqCategoryId` int(11) NOT NULL AUTO_INCREMENT,
  `vFaqCategoryName` varchar(255) NOT NULL,
  `vImage` varchar(255) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`iFaqCategoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `faq_category`
--

INSERT INTO `faq_category` (`iFaqCategoryId`, `vFaqCategoryName`, `vImage`, `eStatus`) VALUES
(3, 'About us', 'index.png', 'Active'),
(5, 'Policy', '', 'Active'),
(6, 'Term and condition', '', 'Active'),
(7, 'Add New Faq Category', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `iFeedbackId` int(11) NOT NULL AUTO_INCREMENT,
  `tMessage` text NOT NULL,
  `iUserId` int(11) NOT NULL,
  `dCreatedDate` datetime NOT NULL,
  PRIMARY KEY (`iFeedbackId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feeddevices`
--

DROP TABLE IF EXISTS `feeddevices`;
CREATE TABLE IF NOT EXISTS `feeddevices` (
  `FeedDeviceId` int(11) NOT NULL AUTO_INCREMENT,
  `FeedId` int(11) NOT NULL,
  `AppDeviceId` int(11) NOT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`FeedDeviceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

DROP TABLE IF EXISTS `feeds`;
CREATE TABLE IF NOT EXISTS `feeds` (
  `FeedId` int(11) NOT NULL AUTO_INCREMENT,
  `FeedName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `FeedUrl` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `DateLastChecked` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateLastUpdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`FeedId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gcm_users`
--

DROP TABLE IF EXISTS `gcm_users`;
CREATE TABLE IF NOT EXISTS `gcm_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gcm_regid` text,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messagequeue`
--

DROP TABLE IF EXISTS `messagequeue`;
CREATE TABLE IF NOT EXISTS `messagequeue` (
  `MessageId` int(32) NOT NULL AUTO_INCREMENT,
  `CertificateId` int(32) NOT NULL,
  `DeviceId` int(32) NOT NULL,
  `Message` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Badge` int(11) NOT NULL DEFAULT '0',
  `Sound` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`MessageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mobile_screen`
--

DROP TABLE IF EXISTS `mobile_screen`;
CREATE TABLE IF NOT EXISTS `mobile_screen` (
  `iMobileScreenId` int(11) NOT NULL AUTO_INCREMENT,
  `vTitle` varchar(255) NOT NULL,
  `vImage` varchar(255) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`iMobileScreenId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mobile_screen`
--

INSERT INTO `mobile_screen` (`iMobileScreenId`, `vTitle`, `vImage`, `eStatus`) VALUES
(1, 'First Image', 'img1.png', 'Active'),
(2, 'Second Image', 'img2.png', 'Active'),
(3, 'Third Image', 'img3.png', 'Active'),
(4, 'Fourth Image', 'img4.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `notification_setting`
--

DROP TABLE IF EXISTS `notification_setting`;
CREATE TABLE IF NOT EXISTS `notification_setting` (
  `iNotificationId` int(11) NOT NULL AUTO_INCREMENT,
  `iUserId` int(11) NOT NULL,
  `eNotificationSetting` enum('Yes','No') NOT NULL DEFAULT 'No',
  `eNotificationSound` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`iNotificationId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `notification_setting`
--

INSERT INTO `notification_setting` (`iNotificationId`, `iUserId`, `eNotificationSetting`, `eNotificationSound`) VALUES
(1, 43, 'No', 'No'),
(2, 9, 'No', 'No'),
(3, 12, 'No', 'No'),
(4, 13, 'No', 'No'),
(5, 14, 'No', 'No'),
(6, 10, 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `push_notification_text`
--

DROP TABLE IF EXISTS `push_notification_text`;
CREATE TABLE IF NOT EXISTS `push_notification_text` (
  `iPushNotificationId` int(11) NOT NULL AUTO_INCREMENT,
  `tText` text NOT NULL,
  PRIMARY KEY (`iPushNotificationId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `push_notification_text`
--

INSERT INTO `push_notification_text` (`iPushNotificationId`, `tText`) VALUES
(1, 'New Bar / Pubs '),
(2, 'Testing'),
(3, 'Discount Offers!'),
(4, '50% Cashback Discount Offers!'),
(5, 'demo'),
(6, 'demo123'),
(7, 'demo123'),
(8, 'demo123'),
(9, 'v'),
(10, 'demo testing'),
(11, 'Happu Hour');

-- --------------------------------------------------------

--
-- Table structure for table `push_notification_users`
--

DROP TABLE IF EXISTS `push_notification_users`;
CREATE TABLE IF NOT EXISTS `push_notification_users` (
  `iPushNotificationId` int(11) NOT NULL,
  `iUserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `push_notification_users`
--

INSERT INTO `push_notification_users` (`iPushNotificationId`, `iUserId`) VALUES
(5, 1),
(5, 2),
(5, 3),
(6, 0),
(6, 1),
(6, 2),
(6, 3),
(7, 0),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 9),
(7, 10),
(7, 11),
(8, 1),
(8, 2),
(7, 12),
(7, 13),
(7, 14),
(7, 15),
(7, 16),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(10, 9),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(11, 9),
(11, 10),
(11, 11),
(11, 12),
(11, 13),
(11, 14),
(11, 15),
(11, 16);

-- --------------------------------------------------------

--
-- Table structure for table `redeem_code`
--

DROP TABLE IF EXISTS `redeem_code`;
CREATE TABLE IF NOT EXISTS `redeem_code` (
  `iRedeemCodeId` int(11) NOT NULL AUTO_INCREMENT,
  `iBarId` int(11) NOT NULL,
  `iUserId` int(11) NOT NULL,
  `vRedeemCode` varchar(15) NOT NULL,
  `fDiscount` float(5,2) NOT NULL,
  `eDiscountType` enum('Percentage','Amount') NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`iRedeemCodeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `redeem_code`
--

INSERT INTO `redeem_code` (`iRedeemCodeId`, `iBarId`, `iUserId`, `vRedeemCode`, `fDiscount`, `eDiscountType`, `eStatus`) VALUES
(1, 8, 3, '3257', 30.00, 'Percentage', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `sent_notification`
--

DROP TABLE IF EXISTS `sent_notification`;
CREATE TABLE IF NOT EXISTS `sent_notification` (
  `biSentNotificationId` bigint(15) NOT NULL AUTO_INCREMENT,
  `tTitle` text NOT NULL,
  `iUserId` int(11) NOT NULL,
  PRIMARY KEY (`biSentNotificationId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

DROP TABLE IF EXISTS `servers`;
CREATE TABLE IF NOT EXISTS `servers` (
  `ServerId` int(11) NOT NULL AUTO_INCREMENT,
  `Server Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ServerUrl` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `ServerTypeId` int(11) NOT NULL,
  PRIMARY KEY (`ServerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `servers`
--

INSERT INTO `servers` (`ServerId`, `Server Name`, `ServerUrl`, `ServerTypeId`) VALUES
(1, 'Development Push Notitification Server', 'ssl://gateway.sandbox.push.apple.com:2195', 1),
(2, 'Production - Push Notification Server', 'ssl://gateway.push.apple.com:2195', 1),
(3, 'Development - Feedback Server', 'ssl://feedback.sandbox.push.apple.com:2196', 2),
(4, 'Production - Feedback Server', 'ssl://feedback.push.apple.com:2196', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

DROP TABLE IF EXISTS `sms`;
CREATE TABLE IF NOT EXISTS `sms` (
  `iSmsId` int(11) NOT NULL AUTO_INCREMENT,
  `iFUserId` int(11) NOT NULL,
  `iTUserId` int(11) NOT NULL,
  `vText` varchar(255) NOT NULL,
  `dDate` datetime NOT NULL,
  PRIMARY KEY (`iSmsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `static_pages`
--

DROP TABLE IF EXISTS `static_pages`;
CREATE TABLE IF NOT EXISTS `static_pages` (
  `iSPageId` int(11) NOT NULL AUTO_INCREMENT,
  `vPageTitle` varchar(255) NOT NULL,
  `vPageName` varchar(50) NOT NULL,
  `tContent_en` longtext NOT NULL,
  `iOrderNo` int(11) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  `dAddedDate` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`iSPageId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `static_pages`
--

INSERT INTO `static_pages` (`iSPageId`, `vPageTitle`, `vPageName`, `tContent_en`, `iOrderNo`, `eStatus`, `dAddedDate`) VALUES
(5, 'TERMS', 'Terms & Conditions', '<p><span style="font-size: 15px; font-family: arial, sans-serif;">Happy Hour Terms and Conditions :</span></p>\r\n<ol style="font-size: 12.8px; font-family: arial, sans-serif;">\r\n<li>Please arrive on time as your reservation is only guaranteed for&nbsp;<span style="color: #bc202b;">30</span>&nbsp;minutes.</li>\r\n<li>Once you arrive, tell the hostess that you have a reservation with eatigo.</li>\r\n<li>Remember your discount is on all foods on the menu but does not include drinks. (unless restaurant has special policy. See above)</li>\r\n<li>The discount cannot be combined with any in-house promotions.</li>\r\n</ol>', 1, 'Active', '2016-01-04'),
(13, 'PRIVACY', 'Privacy & Policy', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 2, 'Active', '2015-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `iTokenId` int(11) NOT NULL AUTO_INCREMENT,
  `vDeviceid` varchar(100) NOT NULL,
  `vAccessToken` varchar(200) NOT NULL,
  `vUserName` varchar(100) NOT NULL,
  `vUserId` varchar(100) NOT NULL,
  PRIMARY KEY (`iTokenId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `iUserId` int(11) NOT NULL AUTO_INCREMENT,
  `iAppId` int(11) NOT NULL,
  `vDeviceid` varchar(255) CHARACTER SET latin1 NOT NULL,
  `vDevicename` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vVerifiedNumber` varchar(255) COLLATE utf8_bin NOT NULL,
  `vToken` text COLLATE utf8_bin NOT NULL,
  `vType` enum('IOS','Android') COLLATE utf8_bin NOT NULL DEFAULT 'IOS',
  `ePushNotification` enum('Yes','No') COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `vFirstname` varchar(32) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `vLastname` varchar(32) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `vEmail` varchar(96) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `vPhone` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `vTPhone` varchar(255) COLLATE utf8_bin NOT NULL,
  `vCountry` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `vState` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `vCity` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `eStatus` enum('Active','Inactive') COLLATE utf8_bin NOT NULL DEFAULT 'Inactive',
  PRIMARY KEY (`iUserId`),
  KEY `icountry` (`vCountry`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `iUserId` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` varchar(255) NOT NULL,
  `vFirstName` varchar(255) NOT NULL,
  `vLastName` varchar(255) NOT NULL,
  `vEmail` varchar(255) NOT NULL,
  `vPassword` varchar(255) NOT NULL,
  `iMobileNo` varchar(255) NOT NULL,
  `dBirthDate` date NOT NULL,
  `eGender` enum('Male','Female') NOT NULL,
  `vProfilePicture` varchar(255) NOT NULL,
  `imagetype` enum('','withurl','withouturl') NOT NULL,
  `dCreatedDate` date NOT NULL,
  `dModifiedDate` date NOT NULL,
  `eRole` enum('Guest','User') NOT NULL,
  `biFBId` bigint(15) NOT NULL,
  `dRestPassword` datetime NOT NULL,
  `vHashCode` varchar(255) NOT NULL,
  `vPromotionCode` varchar(255) NOT NULL,
  `vInvitePromotionCode` varchar(255) NOT NULL,
  `vTotalPoints` varchar(20) NOT NULL,
  `vHalfRewardCode` varchar(5) NOT NULL,
  `vFullRewardCode` varchar(5) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`iUserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`iUserId`, `device_id`, `vFirstName`, `vLastName`, `vEmail`, `vPassword`, `iMobileNo`, `dBirthDate`, `eGender`, `vProfilePicture`, `imagetype`, `dCreatedDate`, `dModifiedDate`, `eRole`, `biFBId`, `dRestPassword`, `vHashCode`, `vPromotionCode`, `vInvitePromotionCode`, `vTotalPoints`, `vHalfRewardCode`, `vFullRewardCode`, `eStatus`) VALUES
(1, '', 'khyati', 'patel', 'khyati@techiestown.com', 'DShjDShj', '9898441556', '0000-00-00', 'Female', 'download.jpg', 'withouturl', '2015-12-08', '2015-12-08', 'User', 0, '0000-00-00 00:00:00', 'IW8sYmRm', 'HAP001', '', '8', '', '', 'Active'),
(2, '', 'Bhavin', 'Shah', 'bhavin.shah@techiestown.com', 'DShjDShj', '9898441556', '0000-00-00', 'Female', 'three.jpg', 'withouturl', '2015-12-08', '0000-00-00', 'User', 0, '0000-00-00 00:00:00', 'RL2LV6Ei', 'HAP002', '', '', '', '', 'Active'),
(3, '', 'keta', 'meswania', 'keta.measwania@techiestown.com', 'DShjDShj', '98987645343', '0000-00-00', 'Female', 'download.jpg', 'withouturl', '2015-12-08', '0000-00-00', 'User', 0, '0000-00-00 00:00:00', 'rJADYm4a', 'HAP003', '', '', '', '', 'Active'),
(4, '', 'vipul', 'chauhan', 'vipul.chauhan@techiestown.com', 'DShjDShj', '9898441556', '0000-00-00', 'Male', 'one.jpg', 'withouturl', '2015-12-08', '0000-00-00', 'User', 0, '0000-00-00 00:00:00', 'U6q3fgyY', 'HAP004', '', '', '', '', 'Active'),
(9, '', 'Nidhi', 'Dave', 'nidhi@gmail.com', 'DShjDShj', '9988776655', '0000-00-00', '', 'download_(1).jpg', 'withurl', '2015-12-10', '0000-00-00', 'User', 0, '0000-00-00 00:00:00', 'kkJbHKTp', '', '', '', '', '', 'Active'),
(10, '', 'demo', 'Tester', 'rahul.gandhi@techiestown.com', 'DShjDShj', '8876788978', '0000-00-00', '', '', 'withouturl', '2015-12-10', '0000-00-00', 'User', 0, '0000-00-00 00:00:00', 'qDl1t7DB', '', '', '4', '', '', 'Active'),
(12, '', 'umesh ', 'baldaniya', 'umesh.baldaniya@techiestown.com', 'DShjDShj', '9988776655', '0000-00-00', '', 'three.jpg', 'withouturl', '2015-12-10', '0000-00-00', 'User', 0, '0000-00-00 00:00:00', 'CIPBxoq0', '', '', '', '', '', 'Active'),
(13, '', 'Mike', 'Tester', 'mike.tester@gmail.com', 'DShjDShj', '8876788978', '0000-00-00', '', 'three.jpg', '', '2015-12-10', '0000-00-00', '', 0, '0000-00-00 00:00:00', 'dINjtZd2', '', '', '', '', '', 'Active'),
(14, '', 'vraj', 'patel', 'vraj@gmail.com', 'DShjDShj', '7878778778', '0000-00-00', '', 'one.jpg', 'withouturl', '2015-12-10', '2016-01-02', '', 0, '0000-00-00 00:00:00', '9dfvuOQQ', '', '', '', '', '', 'Active'),
(15, '', 'parth', 'patel', 'parth.patel@techiestown.com', 'DShjDShj', '9988776655', '0000-00-00', '', '', '', '2015-12-10', '0000-00-00', 'User', 12345678923456, '0000-00-00 00:00:00', 'yqfZUPDT', '', '', '', '', '', 'Active'),
(16, '', 'demo', '', 'demo1@gmail.com', '', '98767895', '0000-00-00', 'Male', '', '', '0000-00-00', '0000-00-00', 'Guest', 0, '0000-00-00 00:00:00', '', '', '', '', '', '', 'Active'),
(17, '', 'demo', 'testing1', 'demo.testing1@gmail.com', 'DShjDShj', '+6587867877', '2015-12-29', 'Female', 'one.jpg', 'withouturl', '2015-12-28', '2015-12-28', 'Guest', 0, '0000-00-00 00:00:00', 'DIGG84Ol', 'HAP017', '', '', '', '', 'Active'),
(19, '', 'Sneha', '', 'khyati1.patel@techiestown.com', '', '7878789009', '0000-00-00', 'Male', '', '', '0000-00-00', '0000-00-00', 'Guest', 0, '0000-00-00 00:00:00', '', '', '', '', '', '', 'Active'),
(20, '', 'Kyati', 'Patel', 'khyati.patel@techiestown.com', 'DShj8tGU', '7878789009', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 'User', 123456789, '0000-00-00 00:00:00', 'lAorWYFI', '', '', '', '', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users_devices`
--

DROP TABLE IF EXISTS `users_devices`;
CREATE TABLE IF NOT EXISTS `users_devices` (
  `iUserDeviceId` bigint(11) NOT NULL AUTO_INCREMENT,
  `iUserId` bigint(11) NOT NULL,
  `vDeviceId` varchar(255) NOT NULL,
  `vDeviceName` varchar(255) NOT NULL,
  `eDeviceType` enum('IOS','Android') NOT NULL,
  PRIMARY KEY (`iUserDeviceId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

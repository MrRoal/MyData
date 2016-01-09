-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2015 at 06:56 PM
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
-- Table structure for table `admin`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`iAdminId`, `vFirstName`, `vLastName`, `vEmail`, `vPassword`, `iMobileNo`, `dCreatedDate`, `dModifiedDate`, `eRole`, `eStatus`) VALUES
(1, 'Robert', 'Brown', 'admin@gmail.com', 'DShjDShj', '8888888888', '2015-10-28', '0000-00-00', 'Admin', 'Active'),
(2, 'William', 'Porter', 'subadmin@gmail.com', 'DShjDShj', '7777777777', '2015-10-28', '0000-00-00', 'Subadmin', 'Active'),
(3, 'Jennifer', 'Lawrence', 'jennifer.lawrence@gmail.com', 'DShjDShj', '88665522334', '2015-10-29', '2015-10-29', 'Subadmin', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `bar`
--

CREATE TABLE IF NOT EXISTS `bar` (
  `iBarId` int(11) NOT NULL AUTO_INCREMENT,
  `iOwnerId` int(11) NOT NULL,
  `vBarName` varchar(255) NOT NULL,
  `tAboutBar` text NOT NULL,
  `tMoreInformation` text NOT NULL,
  `tHighlight` text NOT NULL,
  `iGalleryId` int(11) NOT NULL,
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
  `iBarGalleryId` int(11) NOT NULL,
  `tAddress` text NOT NULL,
  `vlatitude` varchar(50) NOT NULL,
  `vLongitude` varchar(50) NOT NULL,
  `eFeatured` enum('Yes','No') NOT NULL,
  `iRatingStarId` int(11) NOT NULL,
  `iRestaurantTableId` int(11) NOT NULL,
  PRIMARY KEY (`iBarId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bar`
--

INSERT INTO `bar` (`iBarId`, `iOwnerId`, `vBarName`, `tAboutBar`, `tMoreInformation`, `tHighlight`, `iGalleryId`, `opening_hours_mon`, `opening_hours_tues`, `opening_hours_wed`, `opening_hours_thur`, `opening_hours_fri`, `opening_hours_sat`, `opening_hours_sun`, `closing_hours_mon`, `closing_hours_tues`, `closing_hours_wed`, `closing_hours_thur`, `closing_hours_fri`, `closing_hours_sat`, `closing_hours_sun`, `iBarGalleryId`, `tAddress`, `vlatitude`, `vLongitude`, `eFeatured`, `iRatingStarId`, `iRestaurantTableId`) VALUES
(1, 3, 'gdfg', 'dfgdf', 'dfgfd', 'dfgfd', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 'dfgdf', 'dfgdf', 'dfgdf', 'Yes', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bar_gallery`
--

CREATE TABLE IF NOT EXISTS `bar_gallery` (
  `iBarGalleryId` int(11) NOT NULL AUTO_INCREMENT,
  `iBarId` int(11) NOT NULL,
  `vImage` varchar(255) NOT NULL,
  PRIMARY KEY (`iBarGalleryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bar_mobile_gallery`
--

CREATE TABLE IF NOT EXISTS `bar_mobile_gallery` (
  `iGalleryId` int(11) NOT NULL AUTO_INCREMENT,
  `iBarId` int(11) NOT NULL,
  `vImage` varchar(255) NOT NULL,
  PRIMARY KEY (`iGalleryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bar_owner`
--

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
  `eStatus` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`iOwnerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bar_owner`
--

INSERT INTO `bar_owner` (`iOwnerId`, `vFirstName`, `vLastName`, `vEmail`, `vPassword`, `iMobileNo`, `dCreatedDate`, `dModifiedDate`, `eDesignation`, `eStatus`) VALUES
(2, 'Scarlett', 'Johnson', 'scarlett.johnson@gmail.com', 'DShjDShj', '8987896789', '2015-10-30 00:00:00', '0000-00-00 00:00:00', 'Administrator', 'Active'),
(3, 'Melissa', 'McCarthy', 'melissa.mcCarthy@gmail.com', 'DShjDShj', '7898767898', '2015-10-30 00:00:00', '0000-00-00 00:00:00', 'Administrator', 'Active'),
(4, 'bingabinga', 'Fan', 'bingabinga.fan@gmail.com', 'DShjDShj', '8987897867', '2015-10-30 00:00:00', '2015-11-02 00:00:00', 'Administrator', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `bar_rating`
--

CREATE TABLE IF NOT EXISTS `bar_rating` (
  `iRatingId` int(11) NOT NULL AUTO_INCREMENT,
  `iBarId` int(11) NOT NULL,
  `iUserId` int(11) NOT NULL,
  `eStar` enum('1','2','3','4','5') NOT NULL,
  PRIMARY KEY (`iRatingId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bar_table`
--

CREATE TABLE IF NOT EXISTS `bar_table` (
  `iBarTableId` int(11) NOT NULL AUTO_INCREMENT,
  `iBarId` int(11) NOT NULL,
  `vTableName` varchar(255) NOT NULL,
  `iSizeOfTable` int(11) NOT NULL,
  PRIMARY KEY (`iBarTableId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE IF NOT EXISTS `configurations` (
  `iSettingId` int(11) NOT NULL AUTO_INCREMENT,
  `tDescription` text NOT NULL,
  `vName` varchar(255) NOT NULL,
  `vValue` varchar(255) NOT NULL,
  `eType` varchar(255) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  `iOrderNo` int(11) NOT NULL,
  PRIMARY KEY (`iSettingId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`iSettingId`, `tDescription`, `vName`, `vValue`, `eType`, `eStatus`, `iOrderNo`) VALUES
(1, 'Site Name', 'SITE_NAME', 'Happy Hour', 'General', 'Active', 1),
(2, 'Site Url', 'SITE_URL', '', 'General', 'Active', 2),
(3, 'Admin Email ID', 'EMAIL_ADMIN', 'admin@gmail.com', 'General', 'Active', 3);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
  `iContectID` int(11) NOT NULL AUTO_INCREMENT,
  `vFirstName` varchar(255) NOT NULL,
  `vLastName` varchar(255) NOT NULL,
  `vEmail` varchar(255) NOT NULL,
  `iMobileNo` varchar(20) NOT NULL,
  `tMassage` text NOT NULL,
  `dAddedDate` datetime NOT NULL,
  PRIMARY KEY (`iContectID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplate`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `emailtemplate`
--

INSERT INTO `emailtemplate` (`iEmailTemplateId`, `vEmailCode`, `vEmailTitle`, `vFromName`, `vFromEmail`, `eEmailFormat`, `vEmailSubject`, `tEmailMessage`, `vEmailFooter`, `eStatus`, `eSendType`) VALUES
(1, 'NEWUSERREGISTER', 'Thanks for Registering at happy hour', 'Administrator', 'support@happyhour', 'HTML', 'Welcome to Happy Hour', '<!-- If you delete this tag, the sky will fall on your head -->\n<p>Email</p>\n<table style="border-right: 1px solid #d3d9dd; border-bottom: 20px solid #cc2131; padding: 1% 2% 3% 2%; margin: 0 0 0 2%; border-radius: 10px;" width="96%" bgcolor="#f2f5f7" border="0" cellpadding="0" cellspacing="0">\n<tbody>\n<tr>\n<td>\n<table width="100%" border="0" cellpadding="0" cellspacing="0">\n<tbody>\n<tr>\n<td><!-- HEADER -->\n<table style="border-radius: 5px; padding: 20px 0;" width="100%" bgcolor="#cc2131" border="0" cellpadding="0" cellspacing="0">\n<tbody>\n<tr>\n<td valign="middle" align="center"><img src="#IMAGE_URL#/assets/image/ridein-logo-admin-inside.png" alt="" /></td>\n</tr>\n</tbody>\n</table>\n<!-- /HEADER END --></td>\n</tr>\n<tr>\n<td><!-- BODY -->\n<table style="padding: 10px 0 0 0;" width="100%" border="0" cellpadding="0" cellspacing="0">\n<tbody>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;"><span>Dear Customer,</span></td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">\n<p>Customer Account Information:</p>\n</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">First Name : #FIRSTNAME#</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">Last Name : #LASTNAME#</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">Email ID: #EMAIL#</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">Password : #PASSWORD#</td>\n</tr>\n<tr>\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; padding: 10px 0 10px 10px;">Kind Regards,<br /> happy hour</td>\n</tr>\n</tbody>\n</table>\n<!-- /BODY END --></td>\n</tr>\n</tbody>\n</table>\n</td>\n</tr>\n</tbody>\n</table>', 'Thank You!', 'Active', 'Administrator'),
(2, 'RESET_PASSWORD', 'Reset Password', 'Administrator', 'support@happyhour', 'HTML', 'Reset Your Password', '&lt;!-- If you delete this tag, the sky will fall on your head --&gt;\n<p>Email</p>\n<table border="0" width="96%" cellspacing="0" cellpadding="0" bgcolor="#f2f5f7">\n<tbody>\n<tr>\n<td>\n<table border="0" width="100%" cellspacing="0" cellpadding="0">\n<tbody>\n<tr>\n<td>&lt;!-- HEADER --&gt;\n<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#cc2131">\n<tbody>\n<tr>\n<td><img src="#IMAGE_URL#" alt="Happy Hour" /></td>\n</tr>\n</tbody>\n</table>\n&lt;!-- /HEADER END --&gt;</td>\n</tr>\n<tr>\n<td>&lt;!-- BODY --&gt;\n<table border="0" width="100%" cellspacing="0" cellpadding="0">\n<tbody>\n<tr>\n<td>Hello #NAME#,</td>\n</tr>\n<tr>\n<td>\n<p>Please click for a Reset Password</p>\n</td>\n</tr>\n<tr>\n<td><a class="reset_password" target="_blank">Reset Password</a></td>\n</tr>\n<tr>\n<td colspan="1">&nbsp;</td>\n</tr>\n<tr>\n<td>Kind Regards,<br /> Happy Hour</td>\n</tr>\n</tbody>\n</table>\n</td>\n</tr>\n</tbody>\n</table>\n</td>\n</tr>\n</tbody>\n</table>', 'Thank You!', 'Active', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `iFaqId` int(11) NOT NULL AUTO_INCREMENT,
  `iFaqCategoryId` int(11) NOT NULL,
  `vQuestion` varchar(255) NOT NULL,
  `vAnswer` varchar(255) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`iFaqId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`iFaqId`, `iFaqCategoryId`, `vQuestion`, `vAnswer`, `eStatus`) VALUES
(3, 3, 'trrth', 'asasd', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `faq_category`
--

CREATE TABLE IF NOT EXISTS `faq_category` (
  `iFaqCategoryId` int(11) NOT NULL AUTO_INCREMENT,
  `vFaqCategoryName` varchar(255) NOT NULL,
  `vImage` varchar(255) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`iFaqCategoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `faq_category`
--

INSERT INTO `faq_category` (`iFaqCategoryId`, `vFaqCategoryName`, `vImage`, `eStatus`) VALUES
(3, 'About us', 'index.png', 'Active'),
(5, 'Policy', '', 'Active'),
(6, 'Term and condition', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `iFeedbackId` int(11) NOT NULL AUTO_INCREMENT,
  `tMessage` text NOT NULL,
  `iUserId` int(11) NOT NULL,
  `dCreatedDate` datetime NOT NULL,
  PRIMARY KEY (`iFeedbackId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `iUserId` int(11) NOT NULL AUTO_INCREMENT,
  `vFirstName` varchar(255) NOT NULL,
  `vLastName` varchar(255) NOT NULL,
  `vEmail` varchar(255) NOT NULL,
  `vPassword` varchar(255) NOT NULL,
  `iMobileNo` varchar(255) NOT NULL,
  `dBirthDate` date NOT NULL,
  `eGender` enum('Male','Female') NOT NULL,
  `vProfilePicture` varchar(255) NOT NULL,
  `dCreatedDate` date NOT NULL,
  `dModifiedDate` date NOT NULL,
  `eRole` enum('Guest','User') NOT NULL,
  `biFBId` bigint(15) NOT NULL,
  `dRestPassword` datetime NOT NULL,
  `vHashCode` varchar(255) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`iUserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`iUserId`, `vFirstName`, `vLastName`, `vEmail`, `vPassword`, `iMobileNo`, `dBirthDate`, `eGender`, `vProfilePicture`, `dCreatedDate`, `dModifiedDate`, `eRole`, `biFBId`, `dRestPassword`, `vHashCode`, `eStatus`) VALUES
(1, 'Riddhi', 'joshi', 'riddhi.joshi@techiestown.com', '4297f44b13955235245b2497399d7a93', '9956123456', '0000-00-00', 'Female', '', '2015-10-29', '0000-00-00', 'User', 0, '0000-00-00 00:00:00', 'VBcHzRH7', 'Active'),
(2, 'khyati', 'patel', 'khyati.patel@techiestown.com', '4297f44b13955235245b2497399d7a93', '9956123456', '0000-00-00', 'Female', '', '2015-10-29', '0000-00-00', 'User', 0, '2015-10-29 09:00:25', '15clK7zF', 'Active'),
(3, 'keta', 'meswania', 'keta.meswania@techiestown.com', 'DShjDShj', '9956123456', '0000-00-00', 'Female', '', '2015-10-29', '0000-00-00', 'User', 0, '2015-10-31 03:07:05', 'zZq6L5AZ', 'Active'),
(4, 'rahul', 'gandhi', 'rahul.gandhi@techiestown.com', '4297f44b13955235245b2497399d7a93', '9956123456', '0000-00-00', 'Male', '', '2015-10-29', '0000-00-00', 'User', 0, '2015-10-29 10:31:48', 'BUzvOcVX', 'Active'),
(15, 'nidhi', 'dave', 'nidhi.dave@techiestown.com', '4297f44b13955235245b2497399d7a93', '9956123456', '0000-00-00', 'Female', 'one.jpg', '2015-10-29', '0000-00-00', 'User', 0, '0000-00-00 00:00:00', 'eny3haLS', 'Active'),
(16, 'bhavin', 'shah', 'bhavin.shah@techiestown.com', '4297f44b13955235245b2497399d7a93', '9956123456', '0000-00-00', 'Male', 'two.jpg', '2015-10-29', '0000-00-00', 'User', 0, '0000-00-00 00:00:00', 'WjIFEJ9j', 'Active'),
(17, 'mehul', 'patel', 'mehul.patel@techiestown.com', 'acd19bc417a1dc48fff61cc066e5ec5b', '', '0000-00-00', 'Male', '', '2015-10-29', '0000-00-00', 'Guest', 1591957791021058, '0000-00-00 00:00:00', '', 'Active'),
(20, 'Nikhil', 'patel', 'nikhil.patel@techiestown.com', '860a21798d876ff4c29ea2ac5e1af287', '9956123456', '0000-00-00', 'Male', '', '2015-10-29', '0000-00-00', 'User', 1591957791021058, '0000-00-00 00:00:00', '', 'Active'),
(24, 'vipul', 'Chauhan', 'vipul.chauhan@techiestwon.com', 'adb65001a5416aee3cebf29c6e09bf93', '9956123456', '2015-10-29', 'Male', '', '2015-10-30', '2015-10-30', 'User', 1591957791021058, '0000-00-00 00:00:00', '', 'Active'),
(25, 'parth', 'patel', 'parth.patel@techiestown.com', 'DShjDShj', '9897890987', '2015-10-30', 'Male', '', '2015-10-30', '0000-00-00', 'User', 0, '0000-00-00 00:00:00', '', 'Active'),
(26, 'Natalie', 'Portman', 'natalie.portman@gmail.com', 'DShjDShj', '123456789', '1989-11-26', 'Male', 'slide3.jpg', '2015-11-02', '0000-00-00', 'User', 0, '0000-00-00 00:00:00', '', 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- ميزبان: localhost
-- زمان توليد: 10 ژوئن 2008 ساعت 08:58 AM
-- نسخه سرور: 5.0.15
-- نسخه PHP: 5.2.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- پايگاه داده: 'db_download'
--

-- --------------------------------------------------------

--
-- Table structure for table 'online_tbl_monitor_attack'
--

CREATE TABLE IF NOT EXISTS online_tbl_monitor_attack (
  ip varchar(255) collate utf8_persian_ci NOT NULL,
  time_stamp_1 bigint(20) NOT NULL,
  time_stamp_2 bigint(20) NOT NULL,
  site varchar(255) collate utf8_persian_ci NOT NULL,
  block varchar(5) collate utf8_persian_ci NOT NULL default 'no',
  time_stamp_block bigint(20) NOT NULL default '0',
  KEY time_stamp_1 (time_stamp_1),
  KEY time_stamp_2 (time_stamp_2),
  KEY block (block),
  KEY time_stamp_block (time_stamp_block),
  KEY site (site),
  KEY ip (ip)
) TYPE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;


-- --------------------------------------------------------

--
-- Table structure for table 'online_tbl_user'
--

CREATE TABLE IF NOT EXISTS online_tbl_user (
  sessionid varchar(50) collate utf8_persian_ci NOT NULL,
  username varchar(50) collate utf8_persian_ci NOT NULL,
  ip varchar(255) collate utf8_persian_ci NOT NULL,
  host varchar(255) collate utf8_persian_ci NOT NULL,
  time_stamp bigint(20) unsigned NOT NULL,
  last_action bigint(20) unsigned NOT NULL,
  expire varchar(5) collate utf8_persian_ci NOT NULL default 'no',
  PRIMARY KEY  (sessionid),
  KEY last_action (last_action),
  KEY username (username)
) TYPE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;


-- --------------------------------------------------------

--
-- Table structure for table 'user_tbl_user'
--

CREATE TABLE IF NOT EXISTS user_tbl_user (
  username varchar(50) collate utf8_persian_ci NOT NULL,
  `password` varchar(50) collate utf8_persian_ci NOT NULL,
  last_login_date varchar(20) collate utf8_persian_ci NOT NULL,
  last_login_clock varchar(10) collate utf8_persian_ci NOT NULL,
  last_login_time_stamp bigint(20) unsigned NOT NULL,
  last_login_ip varchar(255) collate utf8_persian_ci NOT NULL,
  last_login_host varchar(255) collate utf8_persian_ci NOT NULL,
  time_of_logon bigint(20) unsigned NOT NULL,
  allow_daily_login bigint(20) unsigned NOT NULL default '0',
  allow_monthly_login bigint(20) unsigned NOT NULL default '0',
  max_daily_login bigint(20) unsigned NOT NULL default '0',
  max_monthly_login bigint(20) unsigned NOT NULL default '0',
  active_date longtext collate utf8_persian_ci NOT NULL,
  block varchar(5) collate utf8_persian_ci NOT NULL default 'no',
  PRIMARY KEY  (username),
  KEY allow_daily_login (allow_daily_login),
  KEY allow_monthly_login (allow_monthly_login),
  KEY block (block)
) TYPE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- حذف داده‌هاي جدول 'user_tbl_user'
--

INSERT INTO user_tbl_user (username, password, last_login_date, last_login_clock, last_login_time_stamp, last_login_ip, last_login_host, time_of_logon, allow_daily_login, allow_monthly_login, max_daily_login, max_monthly_login, active_date, block) VALUES
('admin', '670b14728ad9902aecba32e22fa4f6bd', '1387/03/21', '11:45', 1213085731, '127.0.0.1', 'localhost', 2052, 10, 10, 10, 10, '13870201;', 'no');

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 01. Nov 2022 um 10:23
-- Server-Version: 5.7.34
-- PHP-Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `viakch`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_fee` decimal(8,2) DEFAULT '0.00',
  `discount_code` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` decimal(8,0) DEFAULT '0',
  `invoice_address` text COLLATE utf8mb4_unicode_ci,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `booked_at` datetime NOT NULL,
  `cancelled_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bookmarked_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` json NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`id`, `description`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"3D-Software\", \"en\": \"3D-Software (en)\"}', '9009e30b-e354-4e69-95e9-565dc94a8a5c', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, '{\"de\": \"Bildgestaltung & Handwerk\", \"en\": \"Bildgestaltung & Handwerk (en)\"}', '2e927562-08a1-4de3-8a1a-dacf06165883', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, '{\"de\": \"Management & Kommunikation\", \"en\": \"Management & Kommunikation (en)\"}', '6e9b10b8-dc12-4296-9410-0f28b21c9e4c', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category_course`
--

CREATE TABLE `category_course` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `category_course`
--

INSERT INTO `category_course` (`category_id`, `course_id`, `created_at`, `updated_at`) VALUES
(3, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, 3, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, 4, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, 5, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, 6, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, 7, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(1, 8, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(1, 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, 10, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, 11, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, 12, '2022-11-01 08:22:14', '2022-11-01 08:22:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `iso` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` json NOT NULL,
  `order` tinyint(4) NOT NULL DEFAULT '-1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `countries`
--

INSERT INTO `countries` (`id`, `iso`, `name`, `order`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ch', '{\"de\": \"Schweiz\", \"en\": \"Switzerland\"}', 1, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(2, 'af', '{\"de\": \"Afghanistan\", \"en\": \"Afghanistan\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(3, 'eg', '{\"de\": \"Ägypten\", \"en\": \"Egypt\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(4, 'ax', '{\"de\": \"Åland\", \"en\": \"Åland Islands\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(5, 'al', '{\"de\": \"Albanien\", \"en\": \"Albania\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(6, 'dz', '{\"de\": \"Algerien\", \"en\": \"Algeria\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(7, 'as', '{\"de\": \"Amerikanisch-Samoa\", \"en\": \"American Samoa\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(8, 'vi', '{\"de\": \"Amerikanische Jungferninseln\", \"en\": \"Virgin Islands (U.S.)\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(9, 'ad', '{\"de\": \"Andorra\", \"en\": \"Andorra\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(10, 'ao', '{\"de\": \"Angola\", \"en\": \"Angola\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(11, 'ai', '{\"de\": \"Anguilla\", \"en\": \"Anguilla\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(12, 'aq', '{\"de\": \"Antarktis (Sonderstatus durch Antarktisvertrag)\", \"en\": \"Antarctica\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(13, 'ag', '{\"de\": \"Antigua und Barbuda\", \"en\": \"Antigua and Barbuda\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(14, 'gq', '{\"de\": \"Äquatorialguinea\", \"en\": \"Equatorial Guinea\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(15, 'ar', '{\"de\": \"Argentinien\", \"en\": \"Argentina\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(16, 'am', '{\"de\": \"Armenien\", \"en\": \"Armenia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(17, 'aw', '{\"de\": \"Aruba\", \"en\": \"Aruba\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(18, 'az', '{\"de\": \"Aserbaidschan\", \"en\": \"Azerbaijan\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(19, 'et', '{\"de\": \"Äthiopien\", \"en\": \"Ethiopia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(20, 'au', '{\"de\": \"Australien\", \"en\": \"Australia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(21, 'bs', '{\"de\": \"Bahamas\", \"en\": \"Bahamas\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(22, 'bh', '{\"de\": \"Bahrain\", \"en\": \"Bahrain\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(23, 'bd', '{\"de\": \"Bangladesch\", \"en\": \"Bangladesh\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(24, 'bb', '{\"de\": \"Barbados\", \"en\": \"Barbados\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(25, 'by', '{\"de\": \"Belarus\", \"en\": \"Belarus\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(26, 'be', '{\"de\": \"Belgien\", \"en\": \"Belgium\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(27, 'bz', '{\"de\": \"Belize\", \"en\": \"Belize\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(28, 'bj', '{\"de\": \"Benin\", \"en\": \"Benin\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(29, 'bm', '{\"de\": \"Bermuda\", \"en\": \"Bermuda\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(30, 'bt', '{\"de\": \"Bhutan\", \"en\": \"Bhutan\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(31, 'bo', '{\"de\": \"Bolivien\", \"en\": \"Bolivia (Plurinational State of)\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(32, 'bq', '{\"de\": \"Bonaire, Saba, Sint Eustatius\", \"en\": \"Bonaire, Sint Eustatius and Saba\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(33, 'ba', '{\"de\": \"Bosnien und Herzegowina\", \"en\": \"Bosnia and Herzegovina\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(34, 'bw', '{\"de\": \"Botswana\", \"en\": \"Botswana\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(35, 'bv', '{\"de\": \"Bouvetinsel\", \"en\": \"Bouvet Island\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(36, 'br', '{\"de\": \"Brasilien\", \"en\": \"Brazil\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(37, 'vg', '{\"de\": \"Britische Jungferninseln\", \"en\": \"Virgin Islands (British)\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(38, 'io', '{\"de\": \"Britisches Territorium im Indischen Ozean\", \"en\": \"British Indian Ocean Territory\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(39, 'bn', '{\"de\": \"Brunei\", \"en\": \"Brunei Darussalam\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(40, 'bg', '{\"de\": \"Bulgarien\", \"en\": \"Bulgaria\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(41, 'bf', '{\"de\": \"Burkina Faso\", \"en\": \"Burkina Faso\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(42, 'bi', '{\"de\": \"Burundi\", \"en\": \"Burundi\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(43, 'cl', '{\"de\": \"Chile\", \"en\": \"Chile\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(44, 'cn', '{\"de\": \"Volksrepublik China\", \"en\": \"China\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(45, 'ck', '{\"de\": \"Cookinseln\", \"en\": \"Cook Islands\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(46, 'cr', '{\"de\": \"Costa Rica\", \"en\": \"Costa Rica\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(47, 'cw', '{\"de\": \"Curaçao\", \"en\": \"Curaçao\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(48, 'dk', '{\"de\": \"Dänemark\", \"en\": \"Denmark\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(49, 'de', '{\"de\": \"Deutschland\", \"en\": \"Germany\"}', 2, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(50, 'dm', '{\"de\": \"Dominica\", \"en\": \"Dominica\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(51, 'do', '{\"de\": \"Dominikanische Republik\", \"en\": \"Dominican Republic\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(52, 'dj', '{\"de\": \"Dschibuti\", \"en\": \"Djibouti\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(53, 'ec', '{\"de\": \"Ecuador\", \"en\": \"Ecuador\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(54, 'ci', '{\"de\": \"Elfenbeinküste\", \"en\": \"Côte d\'Ivoire\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(55, 'sv', '{\"de\": \"El Salvador\", \"en\": \"El Salvador\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(56, 'er', '{\"de\": \"Eritrea\", \"en\": \"Eritrea\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(57, 'ee', '{\"de\": \"Estland\", \"en\": \"Estonia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(58, 'sz', '{\"de\": \"Eswatini\", \"en\": \"Eswatini\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(59, 'fk', '{\"de\": \"Falklandinseln\", \"en\": \"Falkland Islands (Malvinas)\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(60, 'fo', '{\"de\": \"Färöer\", \"en\": \"Faroe Islands\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(61, 'fj', '{\"de\": \"Fidschi\", \"en\": \"Fiji\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(62, 'fi', '{\"de\": \"Finnland\", \"en\": \"Finland\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(63, 'fr', '{\"de\": \"Frankreich\", \"en\": \"France\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(64, 'gf', '{\"de\": \"Französisch-Guayana\", \"en\": \"French Guiana\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(65, 'pf', '{\"de\": \"Französisch-Polynesien\", \"en\": \"French Polynesia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(66, 'tf', '{\"de\": \"Französische Süd- und Antarktisgebiete\", \"en\": \"French Southern Territories\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(67, 'ga', '{\"de\": \"Gabun\", \"en\": \"Gabon\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(68, 'gm', '{\"de\": \"Gambia\", \"en\": \"Gambia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(69, 'ge', '{\"de\": \"Georgien\", \"en\": \"Georgia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(70, 'gh', '{\"de\": \"Ghana\", \"en\": \"Ghana\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(71, 'gi', '{\"de\": \"Gibraltar\", \"en\": \"Gibraltar\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(72, 'gd', '{\"de\": \"Grenada\", \"en\": \"Grenada\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(73, 'gr', '{\"de\": \"Griechenland\", \"en\": \"Greece\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(74, 'gl', '{\"de\": \"Grönland\", \"en\": \"Greenland\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(75, 'gp', '{\"de\": \"Guadeloupe\", \"en\": \"Guadeloupe\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(76, 'gu', '{\"de\": \"Guam\", \"en\": \"Guam\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(77, 'gt', '{\"de\": \"Guatemala\", \"en\": \"Guatemala\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(78, 'gg', '{\"de\": \"Guernsey (Kanalinsel)\", \"en\": \"Guernsey\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(79, 'gn', '{\"de\": \"Guinea\", \"en\": \"Guinea\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(80, 'gw', '{\"de\": \"Guinea-Bissau\", \"en\": \"Guinea-Bissau\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(81, 'gy', '{\"de\": \"Guyana\", \"en\": \"Guyana\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(82, 'ht', '{\"de\": \"Haiti\", \"en\": \"Haiti\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(83, 'hm', '{\"de\": \"Heard und McDonaldinseln\", \"en\": \"Heard Island and McDonald Islands\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(84, 'hn', '{\"de\": \"Honduras\", \"en\": \"Honduras\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(85, 'hk', '{\"de\": \"Hongkong\", \"en\": \"Hong Kong\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(86, 'in', '{\"de\": \"Indien\", \"en\": \"India\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(87, 'id', '{\"de\": \"Indonesien\", \"en\": \"Indonesia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(88, 'im', '{\"de\": \"Insel Man\", \"en\": \"Isle of Man\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(89, 'iq', '{\"de\": \"Irak\", \"en\": \"Iraq\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(90, 'ir', '{\"de\": \"Iran\", \"en\": \"Iran (Islamic Republic of)\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(91, 'ie', '{\"de\": \"Irland\", \"en\": \"Ireland\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(92, 'is', '{\"de\": \"Island\", \"en\": \"Iceland\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(93, 'il', '{\"de\": \"Israel\", \"en\": \"Israel\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(94, 'it', '{\"de\": \"Italien\", \"en\": \"Italy\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(95, 'jm', '{\"de\": \"Jamaika\", \"en\": \"Jamaica\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(96, 'jp', '{\"de\": \"Japan\", \"en\": \"Japan\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(97, 'ye', '{\"de\": \"Jemen\", \"en\": \"Yemen\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(98, 'je', '{\"de\": \"Jersey (Kanalinsel)\", \"en\": \"Jersey\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(99, 'jo', '{\"de\": \"Jordanien\", \"en\": \"Jordan\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(100, 'ky', '{\"de\": \"Kaimaninseln\", \"en\": \"Cayman Islands\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(101, 'kh', '{\"de\": \"Kambodscha\", \"en\": \"Cambodia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(102, 'cm', '{\"de\": \"Kamerun\", \"en\": \"Cameroon\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(103, 'ca', '{\"de\": \"Kanada\", \"en\": \"Canada\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(104, 'cv', '{\"de\": \"Kap Verde\", \"en\": \"Cabo Verde\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(105, 'kz', '{\"de\": \"Kasachstan\", \"en\": \"Kazakhstan\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(106, 'qa', '{\"de\": \"Katar\", \"en\": \"Qatar\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(107, 'ke', '{\"de\": \"Kenia\", \"en\": \"Kenya\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(108, 'kg', '{\"de\": \"Kirgisistan\", \"en\": \"Kyrgyzstan\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(109, 'ki', '{\"de\": \"Kiribati\", \"en\": \"Kiribati\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(110, 'cc', '{\"de\": \"Kokosinseln\", \"en\": \"Cocos (Keeling) Islands\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(111, 'co', '{\"de\": \"Kolumbien\", \"en\": \"Colombia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(112, 'km', '{\"de\": \"Komoren\", \"en\": \"Comoros\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(113, 'cd', '{\"de\": \"Kongo, Demokratische Republik\", \"en\": \"Congo, Democratic Republic of the\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(114, 'cg', '{\"de\": \"Kongo, Republik\", \"en\": \"Congo\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(115, 'kp', '{\"de\": \"Korea, Nord\", \"en\": \"Korea (Democratic People\'s Republic of)\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(116, 'kr', '{\"de\": \"Korea, Süd\", \"en\": \"Korea, Republic of\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(117, 'hr', '{\"de\": \"Kroatien\", \"en\": \"Croatia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(118, 'cu', '{\"de\": \"Kuba\", \"en\": \"Cuba\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(119, 'kw', '{\"de\": \"Kuwait\", \"en\": \"Kuwait\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(120, 'la', '{\"de\": \"Laos\", \"en\": \"Lao People\'s Democratic Republic\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(121, 'ls', '{\"de\": \"Lesotho\", \"en\": \"Lesotho\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(122, 'lv', '{\"de\": \"Lettland\", \"en\": \"Latvia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(123, 'lb', '{\"de\": \"Libanon\", \"en\": \"Lebanon\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(124, 'lr', '{\"de\": \"Liberia\", \"en\": \"Liberia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(125, 'ly', '{\"de\": \"Libyen\", \"en\": \"Libya\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(126, 'li', '{\"de\": \"Liechtenstein\", \"en\": \"Liechtenstein\"}', 4, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(127, 'lt', '{\"de\": \"Litauen\", \"en\": \"Lithuania\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(128, 'lu', '{\"de\": \"Luxemburg\", \"en\": \"Luxembourg\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(129, 'mo', '{\"de\": \"Macau\", \"en\": \"Macao\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(130, 'mg', '{\"de\": \"Madagaskar\", \"en\": \"Madagascar\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(131, 'mw', '{\"de\": \"Malawi\", \"en\": \"Malawi\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(132, 'my', '{\"de\": \"Malaysia\", \"en\": \"Malaysia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(133, 'mv', '{\"de\": \"Malediven\", \"en\": \"Maldives\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(134, 'ml', '{\"de\": \"Mali\", \"en\": \"Mali\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(135, 'mt', '{\"de\": \"Malta\", \"en\": \"Malta\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(136, 'ma', '{\"de\": \"Marokko\", \"en\": \"Morocco\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(137, 'mh', '{\"de\": \"Marshallinseln\", \"en\": \"Marshall Islands\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(138, 'mq', '{\"de\": \"Martinique\", \"en\": \"Martinique\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(139, 'mr', '{\"de\": \"Mauretanien\", \"en\": \"Mauritania\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(140, 'mu', '{\"de\": \"Mauritius\", \"en\": \"Mauritius\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(141, 'yt', '{\"de\": \"Mayotte\", \"en\": \"Mayotte\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(142, 'mx', '{\"de\": \"Mexiko\", \"en\": \"Mexico\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(143, 'fm', '{\"de\": \"Mikronesien\", \"en\": \"Micronesia (Federated States of)\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(144, 'md', '{\"de\": \"Moldau\", \"en\": \"Moldova, Republic of\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(145, 'mc', '{\"de\": \"Monaco\", \"en\": \"Monaco\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(146, 'mn', '{\"de\": \"Mongolei\", \"en\": \"Mongolia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(147, 'me', '{\"de\": \"Montenegro\", \"en\": \"Montenegro\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(148, 'ms', '{\"de\": \"Montserrat\", \"en\": \"Montserrat\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(149, 'mz', '{\"de\": \"Mosambik\", \"en\": \"Mozambique\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(150, 'mm', '{\"de\": \"Myanmar\", \"en\": \"Myanmar\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(151, 'na', '{\"de\": \"Namibia\", \"en\": \"Namibia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(152, 'nr', '{\"de\": \"Nauru\", \"en\": \"Nauru\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(153, 'np', '{\"de\": \"Nepal\", \"en\": \"Nepal\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(154, 'nc', '{\"de\": \"Neukaledonien\", \"en\": \"New Caledonia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(155, 'nz', '{\"de\": \"Neuseeland\", \"en\": \"New Zealand\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(156, 'ni', '{\"de\": \"Nicaragua\", \"en\": \"Nicaragua\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(157, 'nl', '{\"de\": \"Niederlande\", \"en\": \"Netherlands\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(158, 'ne', '{\"de\": \"Niger\", \"en\": \"Niger\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(159, 'ng', '{\"de\": \"Nigeria\", \"en\": \"Nigeria\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(160, 'nu', '{\"de\": \"Niue\", \"en\": \"Niue\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(161, 'mp', '{\"de\": \"Nördliche Marianen\", \"en\": \"Northern Mariana Islands\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(162, 'mk', '{\"de\": \"Nordmazedonien\", \"en\": \"North Macedonia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(163, 'nf', '{\"de\": \"Norfolkinsel\", \"en\": \"Norfolk Island\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(164, 'no', '{\"de\": \"Norwegen\", \"en\": \"Norway\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(165, 'om', '{\"de\": \"Oman\", \"en\": \"Oman\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(166, 'at', '{\"de\": \"Österreich\", \"en\": \"Austria\"}', 3, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(167, 'tl', '{\"de\": \"Osttimor\", \"en\": \"Timor-Leste\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(168, 'pk', '{\"de\": \"Pakistan\", \"en\": \"Pakistan\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(169, 'ps', '{\"de\": \"Palästina\", \"en\": \"Palestine, State of\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(170, 'pw', '{\"de\": \"Palau\", \"en\": \"Palau\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(171, 'pa', '{\"de\": \"Panama\", \"en\": \"Panama\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(172, 'pg', '{\"de\": \"Papua-Neuguinea\", \"en\": \"Papua New Guinea\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(173, 'py', '{\"de\": \"Paraguay\", \"en\": \"Paraguay\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(174, 'pe', '{\"de\": \"Peru\", \"en\": \"Peru\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(175, 'ph', '{\"de\": \"Philippinen\", \"en\": \"Philippines\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(176, 'pn', '{\"de\": \"Pitcairninseln\", \"en\": \"Pitcairn\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(177, 'pl', '{\"de\": \"Polen\", \"en\": \"Poland\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(178, 'pt', '{\"de\": \"Portugal\", \"en\": \"Portugal\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(179, 'pr', '{\"de\": \"Puerto Rico\", \"en\": \"Puerto Rico\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(180, 're', '{\"de\": \"Réunion\", \"en\": \"Réunion\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(181, 'rw', '{\"de\": \"Ruanda\", \"en\": \"Rwanda\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(182, 'ro', '{\"de\": \"Rumänien\", \"en\": \"Romania\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(183, 'ru', '{\"de\": \"Russland\", \"en\": \"Russian Federation\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(184, 'sb', '{\"de\": \"Salomonen\", \"en\": \"Solomon Islands\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(185, 'bl', '{\"de\": \"Saint-Barthélemy\", \"en\": \"Saint Barthélemy\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(186, 'mf', '{\"de\": \"Saint-Martin (französischer Teil)\", \"en\": \"Saint Martin (French part)\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(187, 'zm', '{\"de\": \"Sambia\", \"en\": \"Zambia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(188, 'ws', '{\"de\": \"Samoa\", \"en\": \"Samoa\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(189, 'sm', '{\"de\": \"San Marino\", \"en\": \"San Marino\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(190, 'st', '{\"de\": \"São Tomé und Príncipe\", \"en\": \"Sao Tome and Principe\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(191, 'sa', '{\"de\": \"Saudi-Arabien\", \"en\": \"Saudi Arabia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(192, 'se', '{\"de\": \"Schweden\", \"en\": \"Sweden\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(193, 'sn', '{\"de\": \"Senegal\", \"en\": \"Senegal\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(194, 'rs', '{\"de\": \"Serbien\", \"en\": \"Serbia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(195, 'sc', '{\"de\": \"Seychellen\", \"en\": \"Seychelles\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(196, 'sl', '{\"de\": \"Sierra Leone\", \"en\": \"Sierra Leone\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(197, 'zw', '{\"de\": \"Simbabwe\", \"en\": \"Zimbabwe\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(198, 'sg', '{\"de\": \"Singapur\", \"en\": \"Singapore\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(199, 'sx', '{\"de\": \"Sint Maarten\", \"en\": \"Sint Maarten (Dutch part)\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(200, 'sk', '{\"de\": \"Slowakei\", \"en\": \"Slovakia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(201, 'si', '{\"de\": \"Slowenien\", \"en\": \"Slovenia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(202, 'so', '{\"de\": \"Somalia\", \"en\": \"Somalia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(203, 'es', '{\"de\": \"Spanien\", \"en\": \"Spain\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(204, 'lk', '{\"de\": \"Sri Lanka\", \"en\": \"Sri Lanka\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(205, 'sh', '{\"de\": \"St. Helena, Ascension und Tristan da Cunha\", \"en\": \"Saint Helena, Ascension and Tristan da Cunha\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(206, 'kn', '{\"de\": \"St. Kitts und Nevis\", \"en\": \"Saint Kitts and Nevis\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(207, 'lc', '{\"de\": \"St. Lucia\", \"en\": \"Saint Lucia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(208, 'pm', '{\"de\": \"Saint-Pierre und Miquelon\", \"en\": \"Saint Pierre and Miquelon\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(209, 'vc', '{\"de\": \"St. Vincent und die Grenadinen\", \"en\": \"Saint Vincent and the Grenadines\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(210, 'za', '{\"de\": \"Südafrika\", \"en\": \"South Africa\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(211, 'sd', '{\"de\": \"Sudan\", \"en\": \"Sudan\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(212, 'gs', '{\"de\": \"Südgeorgien und die Südlichen Sandwichinseln\", \"en\": \"South Georgia and the South Sandwich Islands\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(213, 'ss', '{\"de\": \"Südsudan\", \"en\": \"South Sudan\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(214, 'sr', '{\"de\": \"Suriname\", \"en\": \"Suriname\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(215, 'sj', '{\"de\": \"Spitzbergen und Jan Mayen\", \"en\": \"Svalbard and Jan Mayen\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(216, 'sy', '{\"de\": \"Syrien\", \"en\": \"Syrian Arab Republic\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(217, 'tj', '{\"de\": \"Tadschikistan\", \"en\": \"Tajikistan\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(218, 'tw', '{\"de\": \"Republik China\", \"en\": \"Taiwan, Province of China\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(219, 'tz', '{\"de\": \"Tansania\", \"en\": \"Tanzania, United Republic of\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(220, 'th', '{\"de\": \"Thailand\", \"en\": \"Thailand\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(221, 'tg', '{\"de\": \"Togo\", \"en\": \"Togo\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(222, 'tk', '{\"de\": \"Tokelau\", \"en\": \"Tokelau\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(223, 'to', '{\"de\": \"Tonga\", \"en\": \"Tonga\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(224, 'tt', '{\"de\": \"Trinidad und Tobago\", \"en\": \"Trinidad and Tobago\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(225, 'td', '{\"de\": \"Tschad\", \"en\": \"Chad\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(226, 'cz', '{\"de\": \"Tschechien\", \"en\": \"Czechia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(227, 'tn', '{\"de\": \"Tunesien\", \"en\": \"Tunisia\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(228, 'tr', '{\"de\": \"Türkei\", \"en\": \"Türkiye\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(229, 'tm', '{\"de\": \"Turkmenistan\", \"en\": \"Turkmenistan\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(230, 'tc', '{\"de\": \"Turks- und Caicosinseln\", \"en\": \"Turks and Caicos Islands\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(231, 'tv', '{\"de\": \"Tuvalu\", \"en\": \"Tuvalu\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(232, 'ug', '{\"de\": \"Uganda\", \"en\": \"Uganda\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(233, 'ua', '{\"de\": \"Ukraine\", \"en\": \"Ukraine\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(234, 'hu', '{\"de\": \"Ungarn\", \"en\": \"Hungary\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(235, 'um', '{\"de\": \"United States Minor Outlying Islands\", \"en\": \"United States Minor Outlying Islands\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(236, 'uy', '{\"de\": \"Uruguay\", \"en\": \"Uruguay\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(237, 'uz', '{\"de\": \"Usbekistan\", \"en\": \"Uzbekistan\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(238, 'vu', '{\"de\": \"Vanuatu\", \"en\": \"Vanuatu\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(239, 'va', '{\"de\": \"Vatikanstadt\", \"en\": \"Holy See\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(240, 've', '{\"de\": \"Venezuela\", \"en\": \"Venezuela (Bolivarian Republic of)\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(241, 'ae', '{\"de\": \"Vereinigte Arabische Emirate\", \"en\": \"United Arab Emirates\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(242, 'us', '{\"de\": \"Vereinigte Staaten\", \"en\": \"United States of America\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(243, 'gb', '{\"de\": \"Vereinigtes Königreich\", \"en\": \"United Kingdom of Great Britain and Northern Ireland\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(244, 'vn', '{\"de\": \"Vietnam\", \"en\": \"Viet Nam\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(245, 'wf', '{\"de\": \"Wallis und Futuna\", \"en\": \"Wallis and Futuna\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(246, 'cx', '{\"de\": \"Weihnachtsinsel\", \"en\": \"Christmas Island\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(247, 'eh', '{\"de\": \"Westsahara\", \"en\": \"Western Sahara\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(248, 'cf', '{\"de\": \"Zentralafrikanische Republik\", \"en\": \"Central African Republic\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(249, 'cy', '{\"de\": \"Zypern\", \"en\": \"Cyprus\"}', 99, NULL, '2022-11-01 08:22:11', '2022-11-01 08:22:11');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` tinyint(4) NOT NULL DEFAULT '0',
  `slug` json NOT NULL,
  `title` json NOT NULL,
  `subtitle` json NOT NULL,
  `short_description` json NOT NULL,
  `full_description` json DEFAULT NULL,
  `additional_information` json DEFAULT NULL,
  `facts_column_1` json DEFAULT NULL,
  `facts_column_2` json DEFAULT NULL,
  `facts_column_3` json DEFAULT NULL,
  `fee` decimal(8,2) DEFAULT '0.00',
  `reviews` text COLLATE utf8mb4_unicode_ci,
  `seo_description` json DEFAULT NULL,
  `seo_tags` json DEFAULT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `online` tinyint(4) NOT NULL DEFAULT '0',
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `order` tinyint(4) NOT NULL DEFAULT '-1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `courses`
--

INSERT INTO `courses` (`id`, `number`, `slug`, `title`, `subtitle`, `short_description`, `full_description`, `additional_information`, `facts_column_1`, `facts_column_2`, `facts_column_3`, `fee`, `reviews`, `seo_description`, `seo_tags`, `uuid`, `online`, `publish`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '{\"de\": \"storytelling-workshop\", \"en\": \"storytelling-workshop\"}', '{\"de\": \"Storytelling – Workshop\", \"en\": \"Storytelling – Workshop\"}', '{\"de\": \"Dignissimos ipsa ex ipsa provident.\", \"en\": \"Omnis est placeat ut consequatur repellendus eum.\"}', '{\"de\": \"Et libero at maiores animi perspiciatis officiis. Inventore in in blanditiis soluta et numquam placeat. Aspernatur beatae laborum odit sed. Nulla delectus sint minus minus porro deleniti. Quia sit aut molestias rerum hic voluptatem. Nihil dolores nemo quas tempore dolorem sequi modi. Praesentium eum veritatis dolores rerum cumque.\", \"en\": \"Et soluta veniam fugiat non et. Aliquam rem quod nihil ad vel aut ut quod. Ex ratione rem omnis vitae sit. Est id dolor corrupti pariatur qui. Minima mollitia modi occaecati sint quos est sed. Molestiae quas aspernatur consequatur est et. A quia et rerum. Et numquam enim rem numquam vero aliquam.\"}', '{\"de\": \"Cupiditate dolorem maxime aspernatur blanditiis tenetur est et. Et eaque voluptas perspiciatis earum. Id inventore eaque id harum et nesciunt. Ut qui ipsa sapiente repellat officiis quas earum laudantium. Quidem unde ex hic numquam harum magnam. Nostrum fugit accusamus quo sit animi. Vel blanditiis nostrum tempore quis.\", \"en\": \"Aperiam excepturi corrupti quas officia nisi natus. Corrupti modi earum blanditiis nesciunt voluptatibus nostrum. Consequuntur culpa velit ducimus nobis laudantium deleniti sunt possimus. Facere et quis quae adipisci numquam. Nihil ipsum eum illo. Neque perferendis ipsum aut nihil sunt vel nisi.\"}', '{\"de\": \"Architecto et velit sint sit. Tempora dolor non ut accusamus totam in repellat. Minima quia eveniet eaque ad natus. Hic sit est animi quia ut quo libero. Non quibusdam quas laborum corporis. Et ratione dicta quo sunt. Ut nostrum soluta quae voluptatem numquam aut. Iusto vel qui porro dolores ut aliquid. Consectetur quia nihil possimus veniam delectus.\", \"en\": \"Facere et cumque aut distinctio dicta ratione natus. Illo quidem ullam voluptas sed. Omnis repellat vero amet et eius ea facilis. Aliquam facilis aliquam autem cum voluptatum animi. Dolorem qui et suscipit sed nobis nobis eos rerum. Est odit nobis nobis facere. Suscipit tempore tenetur voluptates placeat id deserunt explicabo. Nam molestiae enim velit libero reiciendis quia assumenda.\"}', '{\"de\": \"Aut esse omnis saepe inventore. Hic id officiis cumque aut magnam. Debitis voluptatum dolorem explicabo saepe. Expedita ipsam inventore consequatur at corporis sint fugit corporis.\", \"en\": \"Doloribus architecto deserunt dolores consequatur cupiditate minus maiores. Ut tempore veritatis laboriosam eligendi non earum. Modi tempora at animi blanditiis aut dignissimos. Amet a corrupti expedita ea at commodi et. Sed enim recusandae voluptatem aperiam voluptatem consequatur. Quo optio ut ratione quam repellendus.\"}', '{\"de\": \"Ducimus id laboriosam expedita aliquam odio ex voluptatem. Cumque molestias est fuga repellat tempora enim. Iure neque qui et tempora dolorem voluptatum quasi ullam. At omnis et non rerum quasi saepe. Molestiae saepe dolor quia in iure.\", \"en\": \"Voluptatum cupiditate error in. Nesciunt sequi delectus veniam eius. Provident numquam repudiandae itaque mollitia. Cupiditate sunt vitae eum. Porro omnis repellendus qui sequi nemo facilis velit. Ducimus architecto quaerat corrupti ducimus odit. Ex laboriosam est doloremque aspernatur. Ex laudantium ea voluptatibus. Optio eum autem ex consequatur.\"}', '{\"de\": \"Aut sit asperiores ullam eligendi tempore. Sunt iusto harum veniam aliquid consequatur in non. Voluptatem temporibus et perferendis alias sit a pariatur maiores. Aut quo omnis consequuntur consequatur aut dolor. Suscipit praesentium fugiat voluptates voluptatem eius sed. Illo blanditiis est esse dolores. Vel necessitatibus excepturi quia molestias tenetur.\", \"en\": \"Quas voluptatem quasi provident porro sapiente. Ut reiciendis qui voluptatem quaerat. Eveniet laboriosam et est. Magnam et reprehenderit mollitia exercitationem quia aspernatur dignissimos. Rerum consequatur magni velit sint dolor laboriosam quis. Voluptate temporibus animi ab eius asperiores blanditiis quidem. Commodi dolorem totam animi neque aliquam consequatur ad mollitia.\"}', '960.00', NULL, '{\"de\": \"Ipsam vel quod quis aliquam. Cumque ratione ab molestiae incidunt sed. Ut eum delectus corrupti culpa. Tempore modi deleniti rerum sit. Nihil et cumque velit consequatur maxime. Quasi nesciunt autem voluptate natus. Totam voluptatem ipsam ut ea ad. Corrupti unde est dolore ducimus aperiam voluptas aut. Vel velit aperiam deleniti mollitia nobis dolorem ea.\", \"en\": \"Voluptas id qui ipsam ex. Animi distinctio dolorum aliquam odit id exercitationem. Mollitia illo ad atque est sequi amet amet nisi. Et sed sed et rerum sit quo beatae. Repudiandae et distinctio ea dolorem veniam magni. Earum reprehenderit impedit dolorem rerum qui ipsum. Sapiente est iure laudantium nihil et.\"}', '{\"de\": \"Et expedita est minima consequatur eaque dolor. Dolor inventore ea et eum ut libero similique. Quo sapiente asperiores ratione dignissimos consequuntur fugiat dicta quae. Repellendus est in ducimus ex ducimus. Et quis sequi soluta iste ut quia quae.\", \"en\": \"Voluptas inventore quasi ut tempore voluptatem modi quo. Et et dolores numquam officiis maxime. Sunt qui et quis consectetur est et at. Qui illum quisquam corporis repudiandae qui aut accusantium et. Dolorem ipsum quae cumque et omnis inventore ut. Ex nam dignissimos a quos est. Facilis veritatis exercitationem error accusantium aut aliquid. Velit rerum ipsa rem voluptas sit sed totam.\"}', '903916fc-d748-409d-9254-db936514c611', 0, 1, -1, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(2, 2, '{\"de\": \"blender-einfuehrungskurs\", \"en\": \"blender-einfuehrungskurs\"}', '{\"de\": \"Blender Einführungskurs\", \"en\": \"Blender Einführungskurs\"}', '{\"de\": \"Voluptas explicabo et consequuntur et incidunt enim.\", \"en\": \"Sint voluptatibus saepe dignissimos earum iusto illum delectus placeat.\"}', '{\"de\": \"Doloribus recusandae est facere. Vel magni et odit labore aut debitis. Quia ratione nostrum veritatis aut repellat. Quasi et eaque in esse. Quia quia debitis quia nam in consectetur deserunt. Impedit sit est dolores non asperiores qui.\", \"en\": \"Enim rerum aliquam ab. Blanditiis repellat laudantium optio sapiente doloremque. Optio quisquam provident officiis molestiae odio quas eos. Ab molestiae modi ut consequuntur sed ipsum rerum. Atque nobis vel adipisci nesciunt. Quia saepe eos quo est accusamus ut totam.\"}', '{\"de\": \"Ducimus velit molestiae inventore optio ea est tenetur aut. Et magnam rerum dolorem. Sed voluptatem consequuntur sapiente error alias. Omnis praesentium omnis rerum et debitis sint dolorum odio. Sunt tenetur cumque odio necessitatibus est voluptas quae vel. Sequi perferendis sequi ut facilis. Unde doloremque sed modi corporis cum omnis. Ut a ut omnis assumenda.\", \"en\": \"Doloremque hic quidem voluptatibus quae. Quaerat illo blanditiis voluptas rerum voluptas consequatur. Accusamus nostrum officia quo. Praesentium sint voluptatem quia tenetur vel. Quia id voluptas dignissimos officiis inventore deleniti sint quia. Veritatis amet labore quibusdam alias nesciunt. Iste et laboriosam voluptatem explicabo quo.\"}', '{\"de\": \"Eius eos deserunt voluptas eum qui esse. Corrupti vel exercitationem architecto a quidem voluptas est quis. Facere beatae quia quidem quis ut. Eos asperiores amet similique aut explicabo. Laborum unde recusandae consequuntur. Perspiciatis repellendus ut magnam similique placeat facere. Autem iusto optio quis nemo est velit reprehenderit.\", \"en\": \"Sunt placeat consectetur sed quis incidunt exercitationem. Aliquam aut molestiae ipsum eum maxime deleniti. Debitis nobis corporis aut earum. Ducimus aut voluptas ea sed accusantium dolor optio tempora. Soluta qui et et voluptatibus nostrum repudiandae. Sit natus nesciunt similique consequuntur eum. Exercitationem qui laborum ad modi rerum praesentium adipisci.\"}', '{\"de\": \"Possimus nam necessitatibus delectus inventore. Incidunt vel natus autem aliquid est voluptas id. Recusandae alias eius quisquam vitae cumque aut illum. Quo atque porro consequatur architecto expedita perferendis dicta nulla.\", \"en\": \"Amet sequi tempore magni repellat sed corrupti eligendi. Explicabo eveniet veniam magnam a earum. Nostrum impedit magnam quasi in et incidunt a quae. Sit est aspernatur provident a. Omnis eum dicta velit. Nesciunt non doloremque saepe.\"}', '{\"de\": \"Unde aut perferendis nostrum deserunt est. Est tempora maiores est quidem dolore. Sit quod sed asperiores est omnis. Voluptas officiis eaque et eveniet ipsam accusantium delectus molestias.\", \"en\": \"Fugit tenetur nam cupiditate quasi nulla natus. Unde dolor laborum quis eum dolor. Dolor consequatur tempora rerum rerum deserunt nobis molestias. Sed sapiente et rerum repudiandae magni. Aut excepturi facilis corrupti aut rerum soluta qui. Animi ut et magni voluptatem est. Dolorem incidunt sed repudiandae non voluptatem culpa.\"}', '{\"de\": \"Odio quidem distinctio dolorem debitis deleniti itaque et. Neque magnam culpa ducimus non. Est delectus quasi ut nulla natus quia. Rem asperiores nobis praesentium doloribus et rerum.\", \"en\": \"Sunt aperiam tempora voluptatem rerum a. Rerum molestiae eos modi et officia. Hic perferendis enim ut animi illo doloribus. Assumenda suscipit autem non blanditiis eum sed. Unde quasi beatae sed et quaerat. Aut molestiae aspernatur eius qui deleniti quia. Unde saepe est corporis rerum qui. Nihil aut et et quia.\"}', '960.00', NULL, '{\"de\": \"Voluptatibus quas voluptatibus pariatur inventore ut ex numquam. Repellendus optio repellat est et quod consequatur libero. Recusandae consequatur deserunt numquam cumque suscipit quis quibusdam. Odit delectus dolor rem nulla sequi adipisci facilis. Est consequatur hic quod excepturi. Sapiente enim eum odio molestias placeat officiis. Dignissimos est minima accusamus non.\", \"en\": \"Laudantium voluptas excepturi aut rerum. Dolor nisi quod rerum optio animi animi at. Nihil eos dolore est minima repellendus consequuntur veniam. Minus rerum unde perferendis quas fugit minima iste. Voluptatem aut dolores perspiciatis. Iste molestias in quasi ipsa est. Unde tempora sunt quia incidunt commodi officia. Et sapiente aliquid et fuga.\"}', '{\"de\": \"Doloremque tempore nihil expedita itaque dignissimos ut sunt. Nam eos quam veritatis facere ad. Sed repellendus est distinctio nemo est. Aliquid soluta delectus voluptatum quis quis. Dolores quidem incidunt alias ut. Necessitatibus eius natus distinctio repellendus et.\", \"en\": \"Architecto ea est in est ducimus autem. Et consequatur sed quia laudantium qui assumenda perferendis doloremque. Impedit hic porro qui praesentium ipsam est impedit esse. Cum mollitia corporis corporis sapiente suscipit et. Aliquam architecto sapiente consequatur et. Cupiditate eos aut blanditiis accusantium qui.\"}', '1af31bf6-3ef2-4e5f-96f6-01ab69e018fb', 0, 1, -1, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(3, 3, '{\"de\": \"blender-renderingkurs\", \"en\": \"blender-renderingkurs\"}', '{\"de\": \"Blender Renderingkurs\", \"en\": \"Blender Renderingkurs\"}', '{\"de\": \"Qui quis non totam sed.\", \"en\": \"Necessitatibus porro hic voluptate nihil et eos fugit.\"}', '{\"de\": \"Sed delectus est sint commodi itaque. Quidem velit nulla soluta eum et provident. Ut aut dolor voluptatem veniam voluptatem ex. Occaecati aut maxime molestiae enim deserunt. Qui animi quisquam itaque ipsam veritatis quos. Et et necessitatibus sequi sit non omnis. Nostrum enim est necessitatibus rerum.\", \"en\": \"Delectus ipsam iusto quo aut. Inventore officiis ut voluptatibus aspernatur ut eum autem. Quas eveniet quos inventore corrupti ut ea. Et autem rerum id exercitationem aut expedita quas. Voluptatem id fuga aut mollitia repudiandae sit sed. In non deserunt est voluptatibus quidem. Natus qui fugit omnis eos et cupiditate distinctio officia.\"}', '{\"de\": \"Inventore amet eius voluptatum est placeat dignissimos at. Odio consequuntur et illo. Molestias velit voluptates ea. Officia ad officia aut quibusdam aut quidem rerum. Quisquam ipsam in quae qui tempore hic commodi. Nam sint pariatur voluptas ea quidem adipisci quia. Optio reiciendis praesentium suscipit quaerat. Est perspiciatis fugiat sint. Molestiae autem ut quidem.\", \"en\": \"Optio occaecati sed velit fugiat inventore neque quaerat. Distinctio qui eos distinctio atque. Excepturi aliquam ut molestiae ad expedita sapiente rerum dolor. Voluptatem excepturi dolorem distinctio dicta et sunt. Dignissimos in dolor quisquam ducimus qui dolore. Aut dolor nostrum porro. Fugiat natus corporis voluptatem dolore nesciunt sit.\"}', '{\"de\": \"Numquam et minus dolores eaque est culpa et. Nisi beatae ducimus dignissimos qui. Qui et ut repudiandae sed. Nihil fugit consequatur quas aliquam aut porro soluta. Repudiandae rerum voluptatibus sapiente ea et. Sint dolores neque modi beatae libero. Et consectetur maxime aut saepe.\", \"en\": \"Non sapiente perspiciatis et fugiat tempore non. Aut sunt ut excepturi voluptatem laudantium. Sequi molestiae repellat quidem eum. Eligendi voluptatem quam itaque explicabo eos totam. Sit qui ad consequuntur labore consectetur ipsam vel iusto. Numquam in voluptas est et. Dignissimos ipsa vitae excepturi iure. Voluptatum velit vel eligendi eius.\"}', '{\"de\": \"Aut dolorem et rerum asperiores officia ut. Mollitia eum dolorem laborum et. Enim qui soluta fuga. Occaecati qui et non quia. Qui esse culpa nemo placeat temporibus repudiandae eveniet. Illum dolor quia vitae facilis saepe in. Voluptatum tempore molestiae consequatur in.\", \"en\": \"Consequatur ut possimus ratione tempore. Odit est asperiores ullam sed. Quaerat modi natus quis dolore et maiores dignissimos. Iure corporis eum quia pariatur minus. Voluptatum perferendis qui laborum earum consequatur voluptas. Est fugit voluptatem et culpa. Temporibus ut consequuntur earum quia dolor sit ab. Ut iusto labore ea distinctio.\"}', '{\"de\": \"Sunt totam et eum et. Eum sed quia ipsum. Quo occaecati nobis perspiciatis vel necessitatibus. Minus et corporis quos dolore natus. Quod numquam asperiores quia et modi nisi adipisci qui. Ullam quisquam dolorum et architecto officiis quas facere harum. Qui nostrum non numquam beatae.\", \"en\": \"Et non consequuntur odit officiis molestias molestiae et. Voluptas nisi rerum consequatur deleniti ratione tempore. Sed quis libero perspiciatis. Cupiditate necessitatibus ipsam nemo voluptatum laboriosam earum. Vitae enim pariatur necessitatibus facilis nemo. Et cupiditate explicabo eum dignissimos est laboriosam hic. Porro nostrum non alias nam ea earum quia.\"}', '{\"de\": \"Voluptatibus a unde eos aliquid sed et. Et perferendis delectus ipsum accusantium qui quisquam. Voluptas itaque placeat voluptas eum. Delectus qui veniam quam omnis ullam ducimus. Esse et distinctio neque velit eius corporis quibusdam. Quibusdam et deleniti quis voluptas et facere sit. Inventore qui aspernatur eaque rerum quam sit quaerat. Qui fugiat ad atque nihil distinctio quis consequatur.\", \"en\": \"Voluptate sint iure unde quisquam. Maiores laboriosam libero natus ut est cum. Iure recusandae non saepe praesentium iusto. Ut doloribus cum pariatur qui ut. Hic quisquam eos dolor deserunt. Blanditiis inventore nisi perspiciatis autem quia. Deleniti officiis voluptates est unde quae sapiente nihil distinctio. Harum blanditiis aut qui porro rerum. Ut atque id alias enim voluptas voluptatem.\"}', '720.00', NULL, '{\"de\": \"Itaque nihil magnam ea rerum ea omnis voluptatem. Qui eos et quia iste eos nobis eum. Ut ab ad non saepe earum nemo explicabo. Quasi eos et ad eius. Non ut corporis cum quod porro. Consectetur sint recusandae aut dolor consequuntur expedita. Error qui culpa facilis consectetur earum beatae beatae.\", \"en\": \"Ex minus eaque tempore error veniam id aut. Enim nulla aut facilis et eius libero. Animi sint qui qui placeat. Nobis voluptatem eius unde consequatur. Perspiciatis labore enim maxime nulla suscipit quis. At eum qui qui blanditiis. Dolores quidem nostrum quo aspernatur hic vel occaecati assumenda. Et et ut eius maxime doloremque laborum nemo.\"}', '{\"de\": \"Voluptatem est ducimus aut et quaerat maiores nisi porro. Velit aut et similique quos excepturi eius labore. Nihil cupiditate ipsa similique architecto dignissimos molestiae. Ut consequatur doloremque unde ut quam dolorem vel. Sit ipsam ut perferendis est doloremque et. Quia nam aut dolorum sit. Accusantium vel aspernatur consectetur qui.\", \"en\": \"Ut laudantium et sapiente temporibus. Magnam incidunt impedit et nulla molestias necessitatibus. Molestiae consectetur sit possimus ratione. Non repellendus non labore error fuga. Nobis consequatur voluptas in eligendi occaecati neque. Ullam quos autem corporis itaque. Sunt ab molestias quasi nemo. Rerum perferendis in quia porro dolorum.\"}', 'dcf56187-6787-429c-aef6-1ab3448f1af5', 0, 1, -1, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(4, 4, '{\"de\": \"blender-animationskurs\", \"en\": \"blender-animationskurs\"}', '{\"de\": \"Blender Animationskurs\", \"en\": \"Blender Animationskurs\"}', '{\"de\": \"Reiciendis deserunt expedita voluptas id quibusdam.\", \"en\": \"Magni excepturi eius sunt laborum omnis eligendi natus.\"}', '{\"de\": \"Rerum id et libero doloribus deserunt. Cum pariatur sed ut dolor rerum. Sequi blanditiis tempora quia omnis maxime non quo. At consequatur voluptatem hic voluptatibus harum eius consequatur. Asperiores vel suscipit beatae minima autem. Explicabo eveniet dolores qui nulla. Quia expedita quia molestiae enim tenetur consequuntur. Repellendus aut autem aliquid.\", \"en\": \"Ut et magnam omnis impedit non ab. Et nobis in sint soluta omnis. Non nemo est quia odio. Dolorem facilis placeat et. Et architecto nobis facilis est blanditiis. Impedit saepe et occaecati saepe. Qui non voluptatem numquam alias dolores et. Voluptatem iste cupiditate voluptate quia unde aut dicta.\"}', '{\"de\": \"Quo et dolorem voluptatem cumque. Aspernatur fugit nulla perferendis iste dolores et. Reprehenderit facere nisi culpa voluptatem. Vel sunt assumenda non libero commodi. Voluptates quisquam ea officiis. Esse odio amet et.\", \"en\": \"Ut facilis dolor est accusantium dolorum error distinctio. Libero voluptatibus est ea magnam. Dolorem quo in autem est. Soluta esse debitis modi voluptatem. Quisquam quo aut ipsum aspernatur. Consequuntur ipsum molestiae voluptas omnis similique quam fuga. Vero dolor sunt quis vel neque esse. Et consequatur quo et ut assumenda aperiam ea. Dolorum voluptates quisquam dolore est.\"}', '{\"de\": \"Magnam et voluptatem doloremque facilis provident. Ut est veniam quia et. Quia ut tempore sed consequuntur blanditiis sit voluptatem. Alias veniam vel ut et enim. Laborum ex ipsam corporis. Necessitatibus debitis autem odio dolorem et corrupti earum voluptates.\", \"en\": \"Vel optio necessitatibus cumque sed quisquam et velit. In ut porro maiores optio. Quia sit odit similique vel. Quo laborum sit et vel consequatur doloribus nisi. Consequatur laboriosam et neque qui. Illo est ab voluptas et aut saepe. Consectetur sint ipsa sequi dolores quasi. Doloremque voluptate distinctio culpa libero. Et iusto sequi saepe et ut expedita temporibus libero.\"}', '{\"de\": \"In fugiat quod rerum odit ex. Autem quia et eum culpa repellat ipsa. Tenetur dolore eligendi voluptas maiores. Qui eaque et consequatur tenetur. Beatae voluptatem rerum a eum dolores. Aut dolores voluptatem earum quas facilis. Ut repellendus omnis et iusto eum eum ea.\", \"en\": \"Magni qui adipisci sint sint et. Inventore iusto itaque minus veritatis. Ipsam nihil quo voluptatum reiciendis dolores repudiandae. Tempora sunt veritatis eos. Sit ipsa aliquam soluta labore. Ut autem reiciendis hic doloremque expedita. Nostrum expedita qui voluptates aliquam voluptas.\"}', '{\"de\": \"Minima autem iste atque suscipit in rem voluptatem. Omnis similique et voluptas ea quam. Consequatur blanditiis ratione doloribus accusantium. Provident nihil quidem in tempore rerum ut recusandae. Quia tenetur dolore eveniet architecto sint perferendis quia et. Sit molestias provident ipsam doloribus consequatur et velit et. Maiores vitae dolores veniam cupiditate vel.\", \"en\": \"Sequi maiores dignissimos animi qui corrupti. Occaecati occaecati quia neque excepturi. Est sint repellat dolores deleniti quia. Mollitia repellat ad tenetur ut voluptatem et earum. Rerum reiciendis architecto omnis et. Ex et repellendus nihil explicabo nemo. Enim facilis modi qui qui.\"}', '{\"de\": \"Quia et officiis vel facere ducimus illo sapiente sit. Nam ut beatae rerum id corrupti dolor. Nihil saepe tenetur perspiciatis odit. In odio aut blanditiis dolor. Est rerum voluptas natus vel dolores accusamus non. Tenetur totam occaecati consequatur quaerat ut tempora. Nulla vitae sit maiores rerum. Amet voluptatem ut quo laudantium repellat. Sint delectus temporibus perspiciatis.\", \"en\": \"Enim et aut maxime unde. Sed vel autem cumque porro quidem voluptatum dolor ex. Maxime alias quo id porro nesciunt. Vero iste quasi qui libero culpa quam sint. Ut amet eos vitae id quo ipsum ipsa. Sed quod eos sunt amet deleniti voluptate. Officia aut libero ut.\"}', '840.00', NULL, '{\"de\": \"Ullam voluptas molestias corporis consequuntur ut qui aspernatur atque. Ipsum eos dolor doloribus corrupti quibusdam non sed. Iste est quidem est optio repudiandae ut expedita. Temporibus libero nemo quia suscipit modi expedita vel. Enim quod repellendus aut corrupti itaque ut. Deleniti velit occaecati ut voluptatem iste.\", \"en\": \"Nesciunt ea cupiditate reiciendis in sint sint nam enim. Quo sit quia qui ut sint id qui laborum. Ea odio perspiciatis aperiam unde accusantium nemo est. Ducimus molestiae ea tempore libero architecto libero. Tenetur sunt reprehenderit eligendi rerum veritatis dolorem non. Recusandae atque vel et voluptatem consectetur neque non. Velit aut voluptatem similique quas tempore nostrum illum.\"}', '{\"de\": \"Eum rerum accusantium autem inventore. Iusto rerum aliquam id ut consequatur. Neque expedita rerum quaerat amet sed expedita. Repellat laudantium nulla omnis sequi consequatur accusantium. Non delectus minima quia voluptas. Delectus odit voluptates officiis quasi dolorem.\", \"en\": \"Ratione voluptatem doloremque minima omnis beatae eum. Et nihil nesciunt eum. Esse asperiores voluptatem voluptas minima necessitatibus minima. Voluptas quia officiis rerum qui. Cupiditate omnis sequi natus. Amet officia eum voluptates eos asperiores laborum quia. Velit sit delectus voluptatum cum rem est. Quidem perferendis perspiciatis id officia a beatae.\"}', 'd376da35-5ada-4c4e-821e-acc48504e2bf', 0, 1, -1, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(5, 5, '{\"de\": \"visual-facilitator-basics\", \"en\": \"visual-facilitator-basics\"}', '{\"de\": \"Visual Facilitator Basics\", \"en\": \"Visual Facilitator Basics\"}', '{\"de\": \"Et ut minima veniam laborum.\", \"en\": \"Neque sunt est sit consequatur qui ratione dicta.\"}', '{\"de\": \"In amet praesentium accusamus sit eos numquam omnis. Beatae minima ut dolores voluptas deleniti pariatur aut incidunt. Voluptatibus praesentium dolorum error molestiae dolorum. Eius laborum iure ipsa ea tempore laborum voluptatem ut. Reiciendis ratione veniam quibusdam tempora. Rerum perspiciatis quis id vitae quidem.\", \"en\": \"Minima iste vel consequatur tempora fuga et labore. Ad magni vel non ullam sed porro. Atque velit inventore repudiandae beatae ea est. Voluptates ea et velit hic ut optio fugit. Vero ut omnis corrupti corporis ut ea quidem.\"}', '{\"de\": \"Optio sunt qui dolor quos rerum incidunt. Vitae suscipit possimus ut optio qui. Numquam reprehenderit sapiente iste consequatur qui reiciendis quaerat. Quo et est omnis adipisci odio. Pariatur eaque explicabo mollitia corporis et explicabo ad. Iste est nemo repellat id placeat. Omnis aut accusamus soluta nihil. Qui reiciendis similique mollitia dolorem possimus repellat distinctio.\", \"en\": \"Qui mollitia quibusdam ut quae. Sapiente illum molestias rerum consectetur quibusdam explicabo quam. Sed quia in voluptatem alias soluta est. Voluptatum qui in et. Aut maiores assumenda architecto ut. Nemo totam nemo voluptatem asperiores molestiae.\"}', '{\"de\": \"Ipsam reiciendis eius sunt dolores cumque accusantium. Aut vitae amet aspernatur eius et fugiat sequi. Iure quis aperiam omnis animi sit labore. Nesciunt quasi sed fugiat eum mollitia ad non dicta. Dolor officiis nemo dolorum ratione sit et. Itaque magni libero molestiae et aspernatur. Harum molestiae sunt consequatur non. Est placeat quae quas dicta animi.\", \"en\": \"Suscipit corrupti ut dolor aliquid. Dolor ab fugiat magni at ab est non. Ut ducimus accusamus animi culpa velit atque earum. Consequatur praesentium sint voluptatem necessitatibus corrupti qui. Sunt vel praesentium iure autem voluptatum asperiores accusantium. Aliquid velit sit excepturi soluta qui ut.\"}', '{\"de\": \"Illum voluptatum consequuntur eveniet voluptatem culpa atque. Ea modi id voluptas aliquid aut cum nisi. Aliquid hic est autem eos. Quis nesciunt velit asperiores impedit doloribus quia in harum. Tenetur dolore eum magnam at est perferendis. Similique quae veritatis quis et et incidunt ullam. Ullam beatae consequatur ea dolorem enim.\", \"en\": \"Possimus aut enim architecto amet eos. Eum mollitia omnis quis assumenda in optio. Explicabo reiciendis porro dolore dolor quia. Similique error quas magni nesciunt rerum. Earum voluptatem alias deserunt numquam. Ad natus fugit officiis voluptatem quo. Sapiente ipsum molestiae non et. Vero saepe quis et repudiandae cupiditate. Dolor quia aut sint impedit accusantium magni.\"}', '{\"de\": \"Nulla nihil et illum sequi quis ea voluptate asperiores. Voluptas veniam eaque ullam veritatis. Sapiente quis quis delectus amet et quo. Enim adipisci laborum delectus dolores in quod.\", \"en\": \"Doloremque assumenda ipsum reprehenderit repudiandae eum. Voluptates ad sed omnis nostrum quisquam. Animi assumenda qui et illo accusamus est qui. Magni et voluptas in vel. Consequatur provident molestiae earum reiciendis sit similique. Eum libero dolorem eos vero sint aperiam. Ab unde veritatis ut perspiciatis et similique.\"}', '{\"de\": \"Culpa in a neque aut dignissimos. Nemo est et ducimus et minima. Aut quia ut velit qui nisi sit corrupti. Harum dolorem provident qui deleniti aliquid. Laboriosam temporibus ullam rerum porro aut quod voluptatum. Est porro quidem at. Reprehenderit esse incidunt nemo nisi ea velit.\", \"en\": \"Aliquid voluptatibus numquam et repellendus. Magnam provident possimus repellendus eveniet magnam est. Quia omnis excepturi veniam. Sit quam explicabo labore voluptas impedit iure. Molestias aut rerum deleniti aliquam est. Porro et quis illum veniam eum dolores quam.\"}', '960.00', NULL, '{\"de\": \"Nihil consequatur architecto et sed provident quis cupiditate. Reprehenderit maxime neque est iusto quibusdam fuga. Quia ipsum ut suscipit. Voluptas repellendus quod laborum a hic consequatur sed. Aut voluptas dolore inventore voluptates pariatur sunt. Earum quae totam aut vitae.\", \"en\": \"Praesentium nemo soluta cumque voluptatum sed aut. Perspiciatis eveniet quasi est eum. Placeat voluptatum libero praesentium laborum. Aut cumque ut aperiam qui dolorum quo repudiandae. Rerum ut error sint quia sunt. Qui rerum dolorem maxime eum perspiciatis nam. Ut magnam quisquam consectetur sint.\"}', '{\"de\": \"Est velit eaque alias molestiae. Blanditiis cupiditate enim natus voluptatem facilis consequuntur distinctio. Et culpa voluptas dicta rerum. Odio id error temporibus excepturi quisquam. Nam aperiam iusto unde ut eum. Magni ratione debitis repellendus. Adipisci assumenda ipsa voluptas eveniet distinctio delectus. Ullam qui sit voluptatem optio.\", \"en\": \"Necessitatibus ad ratione ratione rem. Possimus asperiores et laudantium autem. Sed quod autem eaque reiciendis. Dignissimos saepe aperiam omnis doloribus. Doloribus rerum explicabo non quibusdam reiciendis. Possimus fugit et illum voluptatum. Ducimus quas architecto voluptatem amet qui consequatur. Corporis veritatis id molestias ratione excepturi. Aut in autem ipsa esse culpa consequatur.\"}', '73d2b025-c9b4-4a75-b6f1-c7d8d7ce7237', 1, 1, -1, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(6, 6, '{\"de\": \"visual-facilitator-advanced\", \"en\": \"visual-facilitator-advanced\"}', '{\"de\": \"Visual Facilitator Advanced\", \"en\": \"Visual Facilitator Advanced\"}', '{\"de\": \"Architecto quo consequatur temporibus harum.\", \"en\": \"Delectus consequatur dolorem occaecati nihil cupiditate hic recusandae.\"}', '{\"de\": \"Illo fuga magni iure veritatis non cumque commodi. Recusandae odio eos atque fugiat doloribus. Id et est et exercitationem. Asperiores consectetur dolorum deserunt dicta nisi. Dolor voluptate et aliquid exercitationem et est consectetur. Vitae autem nihil et qui. Et aspernatur facilis possimus suscipit id.\", \"en\": \"Dolores qui molestiae quia et quia corporis eaque. Libero reprehenderit qui qui ullam. Eum nostrum quidem delectus et. Sapiente sed qui id quod inventore. Inventore nesciunt mollitia facilis tenetur id commodi laboriosam temporibus.\"}', '{\"de\": \"Consequuntur ipsam ex et dolorem. Dolores molestias quo aliquam temporibus alias. Aliquid distinctio veritatis doloribus dignissimos nostrum accusantium. Maiores ut nemo dolorem et sit. Quos consequatur sed commodi. Inventore fuga aut fuga esse iste. Doloribus ut expedita quidem expedita. Aperiam consequuntur officia ut optio. Eligendi quia rerum temporibus corporis possimus.\", \"en\": \"Expedita vero distinctio aliquid et ut. Impedit soluta incidunt commodi suscipit. Sunt dolore sed sit eligendi ut. Et saepe consequuntur velit fugiat voluptas praesentium et earum. Inventore natus autem at neque provident. Omnis ipsum numquam deleniti. Nesciunt error pariatur iste et.\"}', '{\"de\": \"Quod sequi qui qui quasi. Velit distinctio dolorem labore sunt eaque eius itaque minus. Eum debitis illo ut reprehenderit sit a explicabo deleniti. Et necessitatibus saepe expedita incidunt repudiandae. Qui aliquid molestias magni placeat praesentium. Ab vel nobis minus ad deleniti ex. Quam repellat fugit aut ex. Et molestiae expedita nemo ad sed repudiandae cupiditate commodi.\", \"en\": \"Dolorem sit itaque qui placeat. Repudiandae voluptatibus velit beatae cumque et aperiam voluptas enim. Est omnis iusto quae unde sapiente. Ut aliquam non architecto non. Iste illum dolor quia culpa.\"}', '{\"de\": \"Velit possimus suscipit officiis vel aut. Numquam delectus atque explicabo ratione officiis laudantium commodi. Rem sunt sequi provident id voluptatem facere. Alias voluptas et officiis ut fuga modi tempore aut. Suscipit sed voluptate odio dolorem sit dolorem fugit accusamus.\", \"en\": \"Ipsam sint aut nisi sed similique. Et rerum quo quaerat sequi. Esse perferendis facere ipsa labore omnis. Dolore consequatur rerum assumenda odit dolorem. Alias aspernatur quisquam voluptatum quae aut tenetur assumenda. Voluptatem est numquam beatae ab qui facere voluptas. Voluptas perferendis repellat vero sit.\"}', '{\"de\": \"Distinctio nulla hic aut sapiente officia consectetur et. Id adipisci commodi eius reiciendis rem nihil dolor dicta. Labore sed eveniet ratione dolorem corporis. Deleniti ea totam quas doloribus quaerat. Voluptates commodi voluptas ad quia reiciendis aliquid. Iusto reiciendis cupiditate temporibus. Autem placeat ad animi voluptas soluta ipsam. Est quae doloribus nulla excepturi neque temporibus.\", \"en\": \"Distinctio ipsum voluptas voluptatem consectetur ea. Exercitationem in dolore ducimus dicta. Molestiae quaerat id nesciunt sunt odit velit a. Nemo ut consequuntur facilis et cumque. Porro ut odit odio ratione voluptatem. Eius distinctio nostrum aut non non ut.\"}', '{\"de\": \"Molestias eum consequatur eos nihil voluptatum totam consequatur. Labore debitis qui quasi alias facere nihil aut. Debitis aut sapiente nemo ipsam. Rerum facilis blanditiis nisi quidem sit repellat. Ea fugiat dolores sed consequatur ea sequi. Aut sit in voluptas et. Est consequatur unde sed et sed. Quod placeat quas earum exercitationem reprehenderit ut.\", \"en\": \"Sunt cum quos quasi autem modi aliquam praesentium. Nostrum accusamus aut aliquid. Voluptatem sunt consequuntur non iusto. Temporibus dolorem minus qui et voluptatem. Est deserunt quibusdam facilis ullam. Eos tenetur voluptatum iste necessitatibus. Qui in suscipit sit non nulla in consequatur qui.\"}', '720.00', NULL, '{\"de\": \"Alias sit facilis voluptatum provident sed voluptatem. Nulla consequatur consequatur nihil molestias quam beatae. Nesciunt qui eaque labore velit inventore totam. Tempore ex labore distinctio eos voluptas qui quasi nihil. Nam nostrum deserunt dicta et. Aliquam quas totam nesciunt aut in est. Eum et omnis animi nisi sit. Voluptatem officiis illum optio architecto vel voluptatem ullam.\", \"en\": \"Qui neque consequatur sapiente. Expedita voluptas id repellat adipisci quo neque tenetur error. Vitae quas ullam libero similique accusantium placeat. Placeat dolor aliquid vel quo ratione nihil. Autem beatae itaque autem omnis. Dolore ea a cupiditate harum. Quo eum odio ut nam nesciunt deserunt quia architecto. Aspernatur vel incidunt voluptatem.\"}', '{\"de\": \"Odit est expedita molestias facere qui quod. Tenetur velit ducimus quidem molestiae voluptatem. Doloremque aliquid rerum tempore officia enim ut perferendis. Expedita aut praesentium et eum aliquam. Voluptatum doloribus necessitatibus qui ea. Libero nostrum at dolorem dolorem maxime accusamus perferendis labore. Vero vero officia voluptatibus dolor placeat voluptatibus.\", \"en\": \"Dolores et maiores unde similique. Qui provident amet consequatur repellat et soluta eligendi. Recusandae voluptas qui est voluptate mollitia id. Facilis repudiandae ipsam officia. Error et voluptatem rerum quod ut ut ad. Facere assumenda assumenda ad et asperiores. Dicta placeat perferendis tempora debitis. Aut earum pariatur sed nihil perspiciatis. Id velit dolor ut dolor vitae facere et.\"}', 'f4c7b0bc-2672-4146-9ef6-3e88eb7e00a1', 0, 1, -1, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(7, 7, '{\"de\": \"rhino-einstiegskurs\", \"en\": \"rhino-einstiegskurs\"}', '{\"de\": \"Rhino Einstiegskurs\", \"en\": \"Rhino Einstiegskurs\"}', '{\"de\": \"Aut repellendus voluptatem dolores nihil.\", \"en\": \"Numquam omnis id dolor totam velit delectus.\"}', '{\"de\": \"Unde maiores magni minus consectetur quibusdam quia. Tenetur quia dolores possimus non quasi sunt id. Totam modi sed sunt ea aspernatur nemo quis. Aliquid culpa consectetur et. Sit animi et enim modi doloribus. Necessitatibus ducimus et praesentium officia laudantium.\", \"en\": \"Quaerat accusantium quia similique. Nemo tempora alias sed eius ut dicta veritatis. Perspiciatis accusamus enim itaque. Et atque ut veniam facere aut. Et eos est est. In perspiciatis qui aliquam voluptas. Suscipit et vel fuga et ad doloribus.\"}', '{\"de\": \"Harum aliquid accusantium dolor ullam. Voluptatem similique consequatur id. Officiis similique ut suscipit voluptas asperiores accusamus. Repellat alias aut vel officiis. Officia dolor aut dignissimos beatae provident itaque et.\", \"en\": \"Vel culpa et numquam odit beatae nulla velit. Quidem autem soluta praesentium nam. Voluptatum in sed mollitia rem dolorum tempore dolores. Optio rem porro nihil dolore. Expedita velit omnis magni natus in. Quia quidem molestias inventore et. Velit quidem rerum tempora voluptatum sit quia nam.\"}', '{\"de\": \"Ipsam natus soluta exercitationem aliquam reiciendis. Aperiam labore est amet tempore. Dolores sapiente est quis quod vel quisquam. Sit commodi molestias voluptatibus ab corrupti voluptates. Debitis ipsa ducimus praesentium sunt. Eos rem repellendus vel qui et earum qui.\", \"en\": \"Voluptatem modi quas doloremque consectetur praesentium suscipit dolore. Iusto officia odio cum voluptatem cum magnam quia ut. Ut vel iusto maxime dolores. Excepturi et eveniet sed non quo laudantium. Dolore doloribus est culpa aut necessitatibus. Inventore sit et accusantium magnam sed officia.\"}', '{\"de\": \"Et eos excepturi voluptatem rerum qui eos. Eius enim deleniti aut quo. Autem occaecati similique velit unde nesciunt sed dolorem sit. Iste minima et qui maxime commodi. Eius ut eius minus vel quisquam facilis. Quibusdam tenetur voluptatem blanditiis occaecati architecto omnis qui.\", \"en\": \"Et odio rerum id aut. Ut reprehenderit sit aut alias. In harum commodi provident eius vel voluptas aut. Non harum dolores autem ea occaecati. Dignissimos magni quisquam reiciendis odit autem molestiae. Accusantium quis tempora necessitatibus cupiditate iste quis perspiciatis.\"}', '{\"de\": \"Doloremque et non et voluptatem ut. Qui dolores dolor repudiandae maiores consequatur voluptatem veritatis. Hic aut eum soluta quibusdam ut. Ratione eveniet laborum laudantium esse molestiae reprehenderit non repudiandae.\", \"en\": \"Harum quia quo et blanditiis nulla. Est ab nemo blanditiis earum unde non quidem. Ducimus maiores molestiae saepe vero. Quia qui in non reiciendis dignissimos commodi debitis dolorem. Et quibusdam voluptas delectus totam quaerat non. Quibusdam repellendus eius repellendus non est voluptatum. Ut quaerat rem adipisci nam.\"}', '{\"de\": \"Distinctio fugiat velit deleniti et. Labore totam reiciendis omnis iste voluptas iusto. Autem tenetur officia magnam et nihil earum. Eius inventore illum laboriosam et. Sed non et officia veniam asperiores neque cumque rerum. Inventore et quisquam omnis ipsa et hic. Tempora accusantium iste eos saepe ipsam et ipsum enim.\", \"en\": \"Fugit veritatis in autem. Alias error rerum et debitis commodi voluptatibus. Minus similique odit nisi quasi. Sint porro quos earum voluptas earum laborum. Ut mollitia occaecati voluptatem placeat. Alias rerum nostrum qui veniam. Sint doloremque ut deleniti libero. Quos ipsa ut aut sunt dolores placeat vel. Nemo asperiores a laborum quod delectus est perspiciatis voluptatum.\"}', '1120.00', NULL, '{\"de\": \"Ut sit ratione qui cumque explicabo. Nihil est soluta saepe ab soluta atque ex. In deleniti minus autem quam qui perspiciatis. Est non officiis omnis omnis magnam totam et. Reiciendis facilis ullam corporis vel quos. Eveniet inventore tenetur non architecto provident omnis.\", \"en\": \"Dolore qui voluptas quae. Ut tempore soluta ut et numquam. Debitis quibusdam reiciendis quis est. Deleniti iste rerum recusandae eos sed. Sunt ea perspiciatis earum est et amet. Eius nemo qui sit ratione eos. Et consequuntur esse et esse qui. A eveniet rerum autem vel nostrum. Et saepe similique rerum. Dolor nisi non eius qui. Accusantium ut voluptatem sit.\"}', '{\"de\": \"Hic distinctio sit quae quidem excepturi ut quam. Et adipisci incidunt cumque omnis. Repudiandae beatae nesciunt vel distinctio provident consequatur minima. Maiores eligendi assumenda quos ut animi quos in. Quibusdam aut fugiat cupiditate ea. Ut magni ullam necessitatibus ratione laborum enim sed corporis. Tempora quod modi doloremque ut suscipit. Corporis ut id nihil quo.\", \"en\": \"Recusandae architecto dignissimos consectetur exercitationem voluptas consequuntur sequi. Eum ut enim et quasi hic aut. Eos dicta aut et est libero qui. Voluptatum assumenda minus qui est. Maiores quidem asperiores molestiae libero. Autem possimus saepe numquam earum a est itaque. Eligendi eum et autem atque et dolorem. Eos repudiandae libero deleniti.\"}', 'c4a8fee6-dd6f-4756-b5c8-a36abffa03e0', 0, 1, -1, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(8, 8, '{\"de\": \"zbrush-einfuehrungskurs\", \"en\": \"zbrush-einfuehrungskurs\"}', '{\"de\": \"ZBrush Einführungskurs\", \"en\": \"ZBrush Einführungskurs\"}', '{\"de\": \"Quis dolor modi cumque ut aspernatur.\", \"en\": \"Minus et dolores qui dignissimos.\"}', '{\"de\": \"Id neque ut ea totam id. Minima aut corporis vero suscipit praesentium. Cupiditate vel delectus ducimus sapiente dicta vel. Maxime fuga odio et sit quam. Libero ad illum perferendis ut repellat dolores debitis. Quos blanditiis sed itaque aut minus delectus. Qui tempora ipsum veniam sit sit delectus nesciunt.\", \"en\": \"Aperiam neque itaque animi ut. Dolorum et aperiam sed consequuntur. Doloribus sint nisi ut saepe aspernatur. Maiores ut et rem quia repellendus. Reiciendis harum et optio odit repudiandae amet.\"}', '{\"de\": \"Aliquam omnis a quae facilis qui odit rerum. Perferendis sunt officia qui officiis. Rerum deleniti at eos expedita vel. Mollitia nemo cupiditate autem consequuntur. Earum porro accusantium et nihil. Repellendus aspernatur consequatur et possimus.\", \"en\": \"Enim sit perferendis nemo dolorum et assumenda esse. Dolore quibusdam cum odio ut omnis. Debitis quos delectus ut aut. Iusto architecto corrupti est quisquam. Eum nulla amet fugit ad quia. Natus omnis sunt autem tenetur aut error quisquam. Ipsa voluptatibus aut officia.\"}', '{\"de\": \"Suscipit et eos hic sunt tempore molestias. Amet dolore doloremque quis est. Quis quasi non ullam. Voluptatibus non cum sed facere incidunt velit. Similique voluptas aliquid minima omnis. Excepturi et dolor explicabo quis sunt. Laudantium quos ea qui atque. Molestiae eum architecto cum cum qui animi non. Nisi dolores aliquam quidem aut laboriosam aut.\", \"en\": \"Aliquam saepe est est. Minima est enim culpa est assumenda sapiente explicabo. Et nihil cupiditate tempora in sit. Distinctio atque vel sit rerum. Amet omnis et dolorum. Totam officia in ullam quos necessitatibus. Nemo quam sunt incidunt necessitatibus placeat officia. Quis est dolores fuga rerum veritatis.\"}', '{\"de\": \"Sed distinctio quos nobis sunt qui nihil. Optio rerum ullam animi amet. Eos est sit placeat nisi. Aliquid velit nesciunt expedita eos sint debitis quae eligendi. A unde delectus dolor quis. Molestiae cupiditate reiciendis quas sit.\", \"en\": \"Est est veniam voluptas facere. Id vitae accusamus impedit in quam. Et ut nesciunt ex et ducimus. Maxime expedita saepe nam aut ut dicta deleniti. Ut molestiae nobis est dolorum harum et laboriosam vitae. Aliquam sunt dolore itaque veniam odio praesentium. Et ad assumenda sapiente dolor autem sunt blanditiis. Vel repellat quo id dolor cum.\"}', '{\"de\": \"Dignissimos incidunt doloremque et consectetur nihil repellat iste. Unde laborum corporis harum enim qui. Quasi dignissimos quo voluptatem omnis voluptatem sapiente. Laboriosam fugiat eligendi perferendis placeat quisquam mollitia. Nulla porro dolores voluptatibus minus. Eum dolor nobis eum aut. In enim ab possimus autem qui. Vitae aperiam incidunt corporis sunt in molestiae.\", \"en\": \"Et recusandae vel dicta sequi in iusto. Iusto qui fugiat eum. Velit quos accusamus labore alias. Dignissimos dolorem illo quia repellat hic porro sit. Quod suscipit quia enim tempora. Explicabo vitae distinctio odio nemo. Qui quam ullam dolorum nobis.\"}', '{\"de\": \"Nisi dolorum fuga et alias libero. Reprehenderit excepturi harum nobis odio quaerat sit perferendis in. Deserunt voluptates eum aspernatur unde consequatur accusantium. Sed sed impedit explicabo aut placeat. Cupiditate non nihil a laboriosam similique quia possimus. Temporibus temporibus quos nemo harum iure nesciunt. Doloremque sit veniam facilis architecto nisi.\", \"en\": \"Voluptate corporis libero sunt non sit et sunt. Rerum quia autem fuga ex cupiditate. Voluptatibus illo velit quidem. Temporibus quis consequatur mollitia omnis veritatis dolorem alias. Ab similique quod recusandae. Error corrupti eos id commodi. Ad saepe itaque repellendus quas eveniet veniam corrupti. Nemo hic et voluptatem recusandae.\"}', '720.00', NULL, '{\"de\": \"Quia velit autem explicabo aut accusamus ad earum. Ex quod delectus nihil est. Sint qui qui quia delectus sit magni consequuntur. Dolor error perferendis nulla porro. Nisi omnis repudiandae ipsa et numquam. Quae provident consectetur iste architecto porro exercitationem voluptates.\", \"en\": \"Et quo eum adipisci ut tempora. Illo voluptatem recusandae in incidunt numquam repudiandae ut. Saepe tempora sed aut sit occaecati eos quod. Esse quae architecto amet omnis. Sint quae laudantium sed temporibus sint quaerat. Consequatur illo exercitationem et cumque. Quibusdam et harum labore reprehenderit. Exercitationem non et id occaecati animi. Aut voluptas quisquam et accusamus quasi ullam.\"}', '{\"de\": \"Aliquam et rem aut ipsam placeat. Accusamus ratione qui tenetur ratione sed non aperiam. Cumque consequatur dolores consequuntur quas. Dolores vel at deleniti odit ut a numquam. Minima dolor qui aspernatur enim qui porro. Occaecati non dolores eum qui possimus in. Reprehenderit aspernatur est et harum omnis excepturi.\", \"en\": \"Qui temporibus omnis et ex a iusto quo harum. Quia aspernatur voluptatibus itaque distinctio commodi dolor nemo. Nihil ea quod mollitia perferendis. Amet sit in labore delectus vero accusamus iusto.\"}', 'd8a8ed9b-f72c-462d-8b53-d61f7c02f026', 1, 1, -1, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL);
INSERT INTO `courses` (`id`, `number`, `slug`, `title`, `subtitle`, `short_description`, `full_description`, `additional_information`, `facts_column_1`, `facts_column_2`, `facts_column_3`, `fee`, `reviews`, `seo_description`, `seo_tags`, `uuid`, `online`, `publish`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 9, '{\"de\": \"social-media-marketing\", \"en\": \"social-media-marketing\"}', '{\"de\": \"Social Media Marketing\", \"en\": \"Social Media Marketing\"}', '{\"de\": \"Provident aperiam qui tempora accusantium molestiae reprehenderit enim.\", \"en\": \"Sequi quasi rem voluptatum rem beatae facere tenetur.\"}', '{\"de\": \"Culpa odit dolorem velit et omnis. Porro placeat et illo ea provident odit. Magnam est culpa natus molestias fugiat. Culpa perspiciatis magnam voluptates est sunt mollitia. Eius sed illum iure error. Officiis et repudiandae atque laudantium corporis rerum. Fuga dolorum ut sint vero iure voluptatem non. Sed in quidem nobis est. Quis maxime aut consequatur minus recusandae recusandae.\", \"en\": \"Iure maiores dolorum quis exercitationem. Ut saepe inventore voluptas qui consequuntur. Fugit qui omnis voluptatibus quia unde doloremque inventore. Incidunt minima harum nemo soluta omnis ut. Voluptatibus modi et quia beatae optio eos eveniet. Enim necessitatibus repellat et voluptatem. Sint dolor autem nam sequi fugiat id. Enim non et et et id corporis pariatur et.\"}', '{\"de\": \"Quo minima quo corrupti ipsam. Et qui consequatur commodi explicabo voluptatem minima. Officia repellat perferendis molestias velit numquam. Accusamus numquam dolorem et. Quia ut sunt corporis doloribus id dicta. Aut accusantium quo distinctio quos. Quis quia voluptas inventore.\", \"en\": \"Ea quia enim maiores. Consectetur odio facilis commodi sint tenetur consequatur. Sint molestiae perferendis natus quisquam. Deleniti sit et est maiores omnis asperiores excepturi. Occaecati harum ut voluptatem nostrum repellendus praesentium. Velit ducimus et ullam consequatur tenetur.\"}', '{\"de\": \"Laboriosam quae accusantium consequatur provident. Facilis nihil aut molestiae facere repellendus odio. Ut sequi accusantium distinctio nesciunt. Sunt cupiditate tempore et est quo. Culpa iste vero delectus quo. Esse deserunt voluptates pariatur voluptas maiores. Harum in dolorem non quis.\", \"en\": \"Porro eum totam voluptates quis voluptas culpa suscipit. Quibusdam praesentium vel distinctio quisquam ut. Reiciendis qui assumenda esse illum ea dolores reiciendis. Ut quo dignissimos sunt qui. Est maxime qui fugit sint doloremque porro dolores. Voluptate eum quo et animi cumque omnis et ut. Laudantium facilis illum qui aut vitae quis aut quod. Consequatur officia et enim molestiae rem et.\"}', '{\"de\": \"Quis facere enim voluptas inventore. Magnam voluptatum hic rerum alias voluptates. Et debitis natus repudiandae in et quam aliquam dolor. Nam qui ut rem atque vel sit accusamus. Maxime est veniam iusto quo est sit. Ut necessitatibus id voluptas a id dolore facere. Molestiae totam quo tempore qui voluptas.\", \"en\": \"Ut id corporis deleniti. Et itaque sed fugiat voluptates aut. Id voluptatem magni placeat id illo quaerat consequatur. Minus dolorem et rerum autem ea hic voluptas autem. Quaerat dolores totam eveniet officia quos laboriosam laudantium velit. Ex molestiae natus rerum ipsum. Unde et ex officiis possimus quo quia porro. Et qui aut occaecati et incidunt ut eum.\"}', '{\"de\": \"Neque et libero in corrupti quia qui molestiae. Et qui voluptate nostrum sequi. Delectus sit et amet unde aut minima. Tempore pariatur officia tenetur aut dolor. Iste aliquid voluptates similique temporibus. Quo est vero debitis blanditiis. Autem est non illo ut.\", \"en\": \"Distinctio qui quod voluptatibus deserunt suscipit sit. Ea provident sunt asperiores cum. Voluptatum et laudantium impedit. Ut aliquid culpa est ad sit. Vitae est accusantium et doloribus exercitationem sunt et. Sunt ut ipsa in sapiente.\"}', '{\"de\": \"Non perspiciatis doloribus itaque corrupti quis ipsum dolor. Ut ab qui autem quo non et quaerat. Voluptatem rem ad error molestias. Ex quis voluptatem quia ipsum unde quam alias unde. Odio quo eveniet tempora. Ut enim minima praesentium aperiam. Aut impedit aut autem repellendus. Saepe in ut quaerat recusandae. Maxime est consequatur vitae rerum. Molestiae modi nisi est est alias.\", \"en\": \"Quis est ut assumenda nobis dignissimos sed. Quo a et incidunt. Odio maiores sit numquam consequatur. Illum ipsum explicabo aut sit voluptatum ut. At ipsum hic minus vitae dignissimos. Alias fugiat autem exercitationem facilis non optio. Rerum voluptate magni deserunt corrupti voluptas atque iste. Eum eligendi corporis provident reiciendis molestiae.\"}', '840.00', NULL, '{\"de\": \"Fuga repellendus impedit est omnis. Similique tenetur expedita est est perspiciatis unde. Quia aliquam sit aut commodi. Dolores id quo doloremque itaque magnam occaecati. Eveniet fugiat blanditiis provident eaque eos perspiciatis dolore sunt. Quia error corrupti doloremque rem quisquam dicta. Consequatur tempora corrupti rerum vel eos et autem. Architecto ea dolores sit ab.\", \"en\": \"Ullam voluptas sint fugiat sunt deserunt magni et omnis. Et inventore ea voluptas. Odit veniam quidem sint qui autem impedit cupiditate. Molestiae quidem ipsam aut libero. Voluptatem ut deserunt unde expedita cupiditate dolores et. Aut ut laboriosam optio sint ut rerum voluptatem cum. Labore dolore ut rerum perferendis possimus et ullam.\"}', '{\"de\": \"Eum rerum dicta sit. Suscipit officiis sunt qui minima voluptates vel. Minus libero pariatur vel molestiae fugiat excepturi tenetur. Qui enim sequi voluptatem. Rerum ipsa non temporibus optio. Nesciunt itaque aut ut perferendis amet itaque maiores. Enim laboriosam voluptas aperiam cupiditate. Omnis animi enim architecto reiciendis ut ut ipsa.\", \"en\": \"Blanditiis quibusdam vitae odio eaque quo et. Vero sed optio id ab voluptatum dicta aut. Dolorum itaque quos natus. Culpa est unde voluptatem ipsum tempora cupiditate. Inventore rem consequuntur ut veniam velit sint ratione. Mollitia voluptas iusto et facere et. Aperiam ut ad error sed suscipit. Perspiciatis culpa sapiente ut in vel consequatur exercitationem.\"}', '89d26c48-08e1-4d5d-b33b-2bb227bc8bcf', 0, 1, -1, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(10, 10, '{\"de\": \"after-effects-ae-einstiegskurs\", \"en\": \"after-effects-ae-einstiegskurs\"}', '{\"de\": \"After Effects (AE) Einstiegskurs\", \"en\": \"After Effects (AE) Einstiegskurs\"}', '{\"de\": \"Et aut doloremque unde eum.\", \"en\": \"Magnam quis cum accusamus et.\"}', '{\"de\": \"Aliquam mollitia et vel et excepturi neque. Totam mollitia incidunt assumenda. Non autem ducimus quae et et quasi quaerat. Qui facere praesentium vel at aliquid dicta. Fugiat architecto ut voluptatem quia est ut explicabo. Assumenda cum sint libero tenetur id.\", \"en\": \"Voluptatem natus eligendi vel tenetur omnis. Quasi quia facilis voluptatum mollitia. Et fugiat dolores aut id. Repudiandae optio non impedit tenetur adipisci quia. Neque omnis est excepturi esse. Et impedit eum ipsa modi sint. Qui quidem ea quis et dolorum quo. Cumque modi sunt omnis est quia dignissimos exercitationem et.\"}', '{\"de\": \"Earum aut quae est aut voluptate. Amet itaque assumenda velit consectetur. Exercitationem nihil sit pariatur similique. Ab aut quas optio. Vero asperiores adipisci libero. Consequatur doloribus dolores voluptas. Est illum consequatur et doloremque nisi ea dolor.\", \"en\": \"Modi dolorum sed qui dolorem id. Nam illum quasi sit accusamus cum. Eveniet enim voluptas aut molestiae nam. Et similique incidunt reiciendis non. Temporibus delectus eos et est ea. Quia in quia dolor aut non. Nisi voluptatibus rerum voluptatem non fugit. Est consequatur sint et corporis ipsum. Ad dolorem maiores illum dolorum. Excepturi quia nesciunt id.\"}', '{\"de\": \"Soluta sit nostrum harum quia temporibus. Mollitia omnis rem explicabo vel aspernatur. Incidunt facilis omnis consectetur eaque nihil. At qui molestiae est ut voluptatibus sint. Explicabo in sit rem quod. Ut ut eum ducimus est. Explicabo quasi odio quia ipsa autem. Quos est voluptates veritatis quia voluptates sed.\", \"en\": \"Hic est voluptatem asperiores expedita cum. Maxime sapiente qui architecto ut. Possimus eveniet sed nam non. Dolore cumque culpa sed est veniam. Non laudantium asperiores accusamus similique libero enim. Unde fugit perferendis eaque excepturi eligendi. Laudantium iure accusamus aut illum. Doloremque voluptatibus dolorem iste accusantium hic molestiae sed sit.\"}', '{\"de\": \"Odio odit et corporis. Dignissimos dolor odit aut. A unde a deserunt nisi voluptatibus. Aut qui unde commodi quia earum repellendus ut dolorem. Et cum earum quia reprehenderit optio deserunt neque est. Rerum voluptas qui ea iure optio qui. Voluptatem repudiandae consequatur veniam et iure aut. Omnis rerum provident est assumenda aliquam ut.\", \"en\": \"Rerum ipsam sapiente rerum et est ea dignissimos voluptatem. Et magnam facilis est quae. Similique quae impedit explicabo temporibus aut non aut omnis. Maxime omnis voluptatibus consectetur dignissimos.\"}', '{\"de\": \"Et dolor quis magni placeat dolore natus quia totam. Voluptatem dignissimos cupiditate consequatur unde deleniti quia. Dolor cumque temporibus iure dolore et deserunt.\", \"en\": \"Tempora labore perferendis rerum velit sint. Hic est eius ducimus sed. Dicta est incidunt suscipit qui dignissimos placeat adipisci. Quam rerum accusantium omnis est. In et debitis voluptates corrupti quos animi ducimus. Vel non vitae et accusantium exercitationem. Ut neque asperiores nesciunt aut aspernatur voluptate magni nihil. Quos maxime dolorem blanditiis eveniet.\"}', '{\"de\": \"Ratione vitae sit rem quaerat quas. Numquam quam perferendis veritatis. Praesentium et est blanditiis laudantium nihil. Omnis libero voluptatem magni ducimus ea dolorem aut aut. Nulla voluptatum quos sunt aliquid. Beatae quidem consectetur aperiam consequuntur quia omnis doloremque sint. Consequatur quam quia incidunt amet.\", \"en\": \"Dolorem enim dicta et et odio optio aut fugiat. Et dicta repudiandae ratione minus repellat aut tempora. Omnis eos tenetur vitae tenetur non voluptatem ut. Sequi quis voluptatem delectus sint ipsam esse est. Fuga beatae numquam culpa quae et. Ducimus dolorem quos autem. Nihil magni tempora voluptas cumque similique qui ducimus.\"}', '1120.00', NULL, '{\"de\": \"Reprehenderit tenetur enim et deserunt impedit tempora et nulla. Autem voluptas tempora quaerat neque nihil. Officiis aspernatur suscipit sed error sed consequatur quod quisquam.\", \"en\": \"Et similique ab repellat molestias suscipit veritatis. Eligendi ipsa ducimus ea non. Ut voluptatem doloribus doloremque ea molestias. Qui cumque cum quia tempore nulla quibusdam recusandae. Hic sed excepturi ex sunt quod. Modi rem incidunt ut facere et. Unde sequi distinctio unde nemo omnis doloribus.\"}', '{\"de\": \"Voluptas ipsam eligendi quae natus sit. Excepturi ut dolorem quos. Velit quis autem aut. Possimus aut fugiat aut sit molestiae et dolores doloribus. Natus aut voluptatem sunt fugiat in repellendus. Iure distinctio voluptates doloribus. Amet minima temporibus et eos itaque rerum eos.\", \"en\": \"Quo veniam dolorem culpa nostrum similique. Quae et et ad ea. Voluptas ut laudantium consectetur deserunt. Animi iure illo voluptates dolore dolore commodi. Maiores numquam dolores voluptates quidem perferendis. Rem nam ducimus et ea sapiente eum. Laboriosam a autem maxime beatae. Animi maxime sint et nobis iure libero ab.\"}', 'fce31458-9530-47c4-8083-f34a09b74879', 1, 1, -1, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(11, 11, '{\"de\": \"rhino-grasshopper-kurs-fuer-einsteiger\", \"en\": \"rhino-grasshopper-kurs-fuer-einsteiger\"}', '{\"de\": \"Rhino Grasshopper Kurs für Einsteiger\", \"en\": \"Rhino Grasshopper Kurs für Einsteiger\"}', '{\"de\": \"Aut minus magni et dolores rerum dolor repellendus.\", \"en\": \"Velit iste eaque illo ab non placeat veritatis.\"}', '{\"de\": \"Consequatur illo magni et impedit hic. Qui pariatur sunt minima nisi sit quia aperiam. Qui consequuntur magni est praesentium. Enim aspernatur fuga expedita a veniam sint. Qui sapiente in suscipit rem nulla pariatur quam. Sunt et voluptas facere rerum. Qui in repellat iure. Iure deserunt asperiores voluptas commodi quia et.\", \"en\": \"Est quas sed est soluta alias omnis. Velit ea nobis voluptatum sit. Et illo qui quidem ut veniam dolores cum. Molestiae quae voluptas libero id. Neque voluptates id facere sit voluptatibus exercitationem hic sit. Repudiandae nemo exercitationem eius corrupti id fugit inventore error. Beatae earum quod voluptatem commodi libero et.\"}', '{\"de\": \"Voluptate delectus quaerat et facilis eum. Quae eligendi voluptatem qui impedit provident. Eum voluptates ut architecto corrupti. Quo minima est non est odit et. Autem veniam dolorum quam praesentium vitae omnis. Dignissimos assumenda asperiores aperiam sequi neque odio ratione. Nobis beatae ex sint ratione reiciendis sit provident.\", \"en\": \"Ut blanditiis et fuga nihil eveniet. Praesentium consectetur aut eos aperiam ut quia. Quam eligendi eos veritatis voluptatibus. Eos ullam et quae expedita ut dignissimos recusandae. Consequatur explicabo voluptatum qui quibusdam.\"}', '{\"de\": \"Molestias velit veniam fuga non ad porro et. Quia ut vitae totam necessitatibus delectus velit. Sit distinctio explicabo similique. Assumenda delectus alias qui dolores in. Et vel voluptatum maxime quibusdam qui. Dolores quaerat nobis inventore non. Rerum reiciendis cupiditate sit repellendus perspiciatis ipsum dolores.\", \"en\": \"Voluptatibus veniam repellendus aut eveniet. Non est sit voluptatum illo. Laudantium dolores quaerat numquam dolores rerum amet tempora. Vero deleniti consectetur facere quidem dolore. Atque veniam aut quaerat. Sint inventore quas sapiente illo. Rerum ullam est praesentium nulla voluptatem. Sequi rerum deserunt nulla quas sed.\"}', '{\"de\": \"Cum sunt autem atque fugit. Vitae eius ex mollitia est culpa veritatis. Nobis aut ea pariatur ipsum placeat. Fuga aut autem voluptate officiis sequi omnis placeat. Harum ratione impedit saepe omnis sint fugit. Possimus eius eos doloribus commodi est voluptatum. Quisquam ipsam qui sit est vel aut ut.\", \"en\": \"Quasi et voluptates ab. Repudiandae nihil necessitatibus nulla culpa. Voluptas quibusdam fuga inventore quas quia pariatur. A nemo qui nemo officiis modi non incidunt laborum. Sint dolorem consequatur ipsum rem ipsam. Eum provident et ut fuga assumenda. Sequi et dolorem provident consectetur. Omnis molestiae nulla explicabo quaerat asperiores fugiat nihil. Eaque nam rerum tempore accusamus quam.\"}', '{\"de\": \"Possimus quo dolorum ea sapiente accusamus omnis. Inventore a veritatis nostrum dolor non. Ea qui sequi modi explicabo. Delectus delectus soluta aut aut mollitia et. Voluptatem amet aut placeat quisquam. Reprehenderit sed doloremque repellendus illum voluptatem. Sint delectus consectetur cumque fuga rerum a voluptas.\", \"en\": \"Sed quia enim quas a illum aut non. Porro quia occaecati est recusandae non ut minima. Quo excepturi voluptas ab quibusdam. Eum ea laborum est nemo et.\"}', '{\"de\": \"Quas impedit eum dolores aperiam officiis ullam natus vitae. Nemo dicta quisquam est facilis. Dolorem in eaque qui voluptatum deserunt dolores assumenda. Culpa modi adipisci libero aut unde enim natus reiciendis. Optio et qui magni ipsum. Perferendis nisi et non. Consequatur voluptate mollitia illum rerum velit et.\", \"en\": \"Rerum et ipsam molestiae fugiat. Soluta illum quasi excepturi ut ipsam explicabo. Optio sequi atque sapiente rerum corporis et. Eaque commodi at maiores quasi recusandae. Neque enim soluta omnis excepturi beatae eius. Neque placeat doloremque autem. Autem voluptatibus quia ipsa enim itaque aperiam. Ipsam qui minima sed molestiae.\"}', '960.00', NULL, '{\"de\": \"Repellat sit porro minus et iste iusto. Et nisi nemo et velit. Repellat inventore officiis beatae vel odit molestiae consequuntur. Accusantium consectetur adipisci et atque voluptate qui. Id facilis nostrum quae sunt. Quo minus aliquid qui quae. Atque dolores non qui quis.\", \"en\": \"Qui magni reprehenderit eligendi dicta laboriosam dolorum incidunt. Qui consequatur rerum minima impedit assumenda repudiandae. Aut molestiae in corrupti nihil facere enim a velit. Magni minima velit aut nihil et. Dolorem et quis odio facilis eveniet dolores voluptatem. Quis omnis optio fugiat voluptas quo. Nemo tenetur est sed exercitationem aut eveniet quos.\"}', '{\"de\": \"Nesciunt deserunt omnis odio ut et minima. Veniam velit architecto quo ut velit eligendi. Inventore neque necessitatibus numquam et voluptatem aliquam. Labore odit fuga aliquam velit assumenda. Autem ex sint et impedit sit. Asperiores consequuntur vel at non explicabo minima.\", \"en\": \"Ipsam et perspiciatis eaque voluptas provident voluptate. Est provident odio ipsa ut eligendi eius sunt. Non distinctio sint iste iste. Deserunt ratione optio accusamus ipsum nemo aut expedita. Eum qui reiciendis optio dolores. Aliquam ut autem magni qui est commodi quibusdam. Quae velit non placeat quod sunt voluptatibus.\"}', '62028d96-49c0-445a-ad4f-b1e18fd78669', 0, 1, -1, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(12, 12, '{\"de\": \"geheimnisse-der-architekturvisualisierung\", \"en\": \"geheimnisse-der-architekturvisualisierung\"}', '{\"de\": \"Geheimnisse der Architekturvisualisierung\", \"en\": \"Geheimnisse der Architekturvisualisierung\"}', '{\"de\": \"Commodi qui dolores corporis odit nemo blanditiis totam nihil.\", \"en\": \"Qui libero aut magnam dolores soluta.\"}', '{\"de\": \"Suscipit numquam vitae animi. Perspiciatis assumenda culpa porro aperiam. Omnis vero quas quisquam labore omnis. Dolorem ipsam consequatur voluptatem exercitationem hic voluptates unde. Hic nihil accusantium ut expedita et qui. Rerum nesciunt debitis ducimus. Et quis similique dicta consequatur veritatis. Minima ipsam sunt voluptate.\", \"en\": \"Ratione qui sit temporibus harum. Vel consequatur atque omnis nam quibusdam ex. Eos ut eius ducimus similique culpa et. Eaque autem assumenda amet delectus et. Quia est et neque voluptas ipsum id reprehenderit. Inventore earum ut consequatur distinctio ab et non. Laboriosam assumenda enim id qui quod. Distinctio quis mollitia similique qui. Soluta ipsum dolorem sit esse consequatur.\"}', '{\"de\": \"Non totam quae repudiandae non mollitia tempore. Quisquam repudiandae est sunt quibusdam laboriosam sint officiis. Eum ut repellat inventore quam debitis iusto commodi. Repellendus esse et sit exercitationem a nihil nemo iste. Ea aperiam temporibus dolor. Ut accusamus culpa facere. Dicta neque sapiente ab voluptatum dolore sequi in. Consectetur possimus quasi et ad aut explicabo.\", \"en\": \"Earum nihil ut ut molestias eligendi. Occaecati repudiandae modi nemo aperiam ut ea pariatur. Nihil exercitationem quasi sint odit ut voluptas. Aspernatur voluptas et quos adipisci. Ipsam est quam saepe necessitatibus. Sint veritatis quis quibusdam ut at suscipit ab. Nihil exercitationem quam ut illum dolorem ea provident.\"}', '{\"de\": \"Voluptas ducimus et qui ut iure. Minus hic nisi sequi qui repudiandae recusandae non. Laudantium incidunt dolore rem libero sunt. Quo at saepe quasi consequatur autem. Qui autem quia sunt sapiente architecto. Maxime dolor hic hic vel. Impedit in esse et veniam iure. Ipsam ab ad quibusdam sit aut. Voluptate ea sunt voluptatem inventore eveniet cupiditate esse nulla. Aut quia quibusdam sed.\", \"en\": \"Eius sed omnis quia unde doloribus et earum. Et ut sapiente vero sunt. Consequuntur eum ut qui qui sequi itaque iure. Modi reiciendis pariatur enim quibusdam quam officia. Ea quia perferendis dolores quos ducimus. Commodi aspernatur laudantium amet vel possimus exercitationem consequatur. Ut natus nulla iste. Impedit qui distinctio enim.\"}', '{\"de\": \"Eos sit totam ut est. Iure sint consequatur natus dignissimos vel. Ut quia esse quis temporibus tempora ad fuga. Labore vitae minima enim delectus quibusdam iure repellat et. Rerum dolorum omnis molestiae est dolor occaecati est ad. Accusantium enim magnam vero placeat. Sit et sequi ullam quam dolor voluptas ad. Ea velit qui qui voluptas et fuga.\", \"en\": \"In aspernatur corrupti numquam aut. Non sed ut facere vitae unde dolore. Nihil beatae eligendi et occaecati magni. Optio praesentium id aut ducimus. Et dicta corrupti ea asperiores. Perspiciatis doloremque eos sed libero earum molestiae esse neque. Sit est optio error dolorum dolore molestiae.\"}', '{\"de\": \"Fuga ut veritatis voluptas. Aut reiciendis vero sed distinctio. Voluptas dignissimos officiis voluptas fuga consequuntur explicabo quisquam. Et at repudiandae et repudiandae beatae. Odit earum nihil numquam cumque velit suscipit aut sed. Et tenetur illo perspiciatis. Et odio ipsa sit vero culpa. Eligendi rerum error tempora exercitationem laboriosam accusantium dolor dolores.\", \"en\": \"Dicta debitis ut est ut totam odit commodi. Eligendi rem quae non molestiae veniam sint. Qui ut facilis quo est quo quibusdam ratione. Id ea excepturi nesciunt. Ab omnis autem eius nam dolor esse natus. Ad non illo quos molestiae. Laboriosam ea modi blanditiis distinctio quos. Ut est quis harum est dolores quia adipisci.\"}', '{\"de\": \"Temporibus error ipsum aspernatur autem. Autem suscipit minima nemo consectetur vero facere. Temporibus qui aut magni. Veniam sit consectetur est vitae voluptatem ut. Recusandae dignissimos maxime est suscipit. Nulla earum maxime et et enim. Quasi laboriosam sint aperiam. Saepe voluptas enim modi quia.\", \"en\": \"Voluptatem ipsum recusandae nobis architecto. Nemo perferendis aspernatur necessitatibus dolores qui rem odio. Maiores qui sequi temporibus. Ut numquam a soluta aut debitis in.\"}', '840.00', NULL, '{\"de\": \"Omnis et et quia est. Accusantium dolor et iusto ea quos vero praesentium amet. Quia mollitia non perspiciatis eos. Impedit inventore expedita officiis dolores. Sequi et quis quibusdam non expedita praesentium. Provident rem dolor sint sapiente temporibus quod quam. Veniam ipsa consectetur magnam voluptas iure doloribus a. Animi odit voluptatem hic vero est.\", \"en\": \"Blanditiis maxime necessitatibus quisquam aspernatur. Dolorem neque consequatur expedita et cum. Deserunt voluptatem unde reiciendis est minus. Eius ut id quaerat quae adipisci rerum recusandae. Aut ducimus neque eum. In sunt et quas eveniet.\"}', '{\"de\": \"Quibusdam error quidem illum omnis. Et qui ipsa explicabo. Ipsam nulla ab et mollitia. Odio dolorem natus repellat quaerat quasi iure distinctio. Sapiente voluptas numquam nihil fuga. Porro explicabo sit ut laborum non. Facilis aut sunt et quis est ipsum architecto. Ea et vero harum eum sint non magnam.\", \"en\": \"Eos molestiae nesciunt odio recusandae. Voluptatem nobis sapiente temporibus. Eum quia nihil a fugit voluptas esse eligendi dolor. Et recusandae ut recusandae voluptate. Voluptatem et voluptas non officia qui vel dicta voluptatem.\"}', '40e98be4-b52f-4536-8b78-63d1034f3e10', 0, 1, -1, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `course_language`
--

CREATE TABLE `course_language` (
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `course_language`
--

INSERT INTO `course_language` (`course_id`, `language_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(4, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(5, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(6, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(7, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(8, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(9, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(10, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(11, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(12, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `course_level`
--

CREATE TABLE `course_level` (
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `course_level`
--

INSERT INTO `course_level` (`course_id`, `level_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(4, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(5, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(6, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(7, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(8, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(9, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(10, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(11, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(12, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `course_software`
--

CREATE TABLE `course_software` (
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `software_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `course_software`
--

INSERT INTO `course_software` (`course_id`, `software_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(4, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(5, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(6, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(7, 3, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(8, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(9, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(10, 3, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(11, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(12, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `course_tag`
--

CREATE TABLE `course_tag` (
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `course_videos`
--

CREATE TABLE `course_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint(4) NOT NULL DEFAULT '-1',
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,0) NOT NULL DEFAULT '0',
  `valid_from` date DEFAULT NULL,
  `valid_to` date DEFAULT NULL,
  `fix` tinyint(4) NOT NULL DEFAULT '0',
  `percent` tinyint(4) NOT NULL DEFAULT '0',
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `registration_until` date DEFAULT NULL,
  `min_participants` tinyint(4) NOT NULL DEFAULT '1',
  `max_participants` tinyint(4) NOT NULL DEFAULT '1',
  `online` tinyint(4) NOT NULL DEFAULT '0',
  `fee` decimal(8,2) DEFAULT '0.00',
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `events`
--

INSERT INTO `events` (`id`, `date`, `registration_until`, `min_participants`, `max_participants`, `online`, `fee`, `uuid`, `publish`, `course_id`, `location_id`, `confirmed_at`, `closed_at`, `cancelled_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2022-12-20', '2022-12-10', 3, 8, 1, '1120.00', '250e2512-da79-42ac-99b3-010e05b7095a', 1, 1, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(2, '2022-07-20', '2022-07-10', 5, 16, 0, '960.00', '7c2d8f3c-d815-4847-a09e-b0a54d107724', 1, 5, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(3, '2023-04-21', '2023-04-11', 7, 12, 0, '720.00', 'c4251a9f-2446-489d-bda7-32e61bf28823', 1, 12, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(4, '2023-03-20', '2023-03-10', 4, 9, 0, '1120.00', '456dea86-6b27-49e3-aed0-0503f77313d8', 1, 6, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(5, '2022-07-23', '2022-07-13', 3, 10, 0, '840.00', '8112ba1c-bf99-44b0-8260-8bf62e8271db', 1, 12, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(6, '2023-02-16', '2023-02-06', 2, 14, 1, '960.00', 'e98e6369-c776-4cb7-900d-566a35440341', 1, 3, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(7, '2023-03-11', '2023-03-01', 3, 14, 0, '960.00', '798df5c4-2371-4d8c-aa43-28cfac7e1232', 1, 5, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(8, '2023-04-25', '2023-04-15', 7, 15, 0, '840.00', '5c3dc55a-cb76-4dc5-a7de-712cbe717900', 1, 1, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(9, '2023-05-31', '2023-05-21', 5, 16, 0, '720.00', '7604c556-28f2-403e-b85f-4d50aab21496', 1, 4, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(10, '2022-09-03', '2022-08-24', 5, 11, 0, '1120.00', '9ecf271d-3490-43ec-82c1-b6543180b986', 1, 5, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(11, '2022-08-23', '2022-08-13', 6, 13, 1, '960.00', 'b76a71ff-2c65-44ea-9e07-f69ec24187d8', 1, 7, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(12, '2022-12-11', '2022-12-01', 4, 8, 0, '840.00', '5ff2492d-a1ea-4df9-a68e-4d99f8045512', 1, 3, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(13, '2023-05-07', '2023-04-27', 5, 16, 0, '960.00', '9d60ee23-4051-416b-9d79-dd0bc896f325', 1, 1, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(14, '2023-05-02', '2023-04-22', 6, 13, 0, '840.00', 'e2bb2a24-1259-4eb8-9a7b-82d420e6daaf', 1, 6, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(15, '2023-03-01', '2023-02-19', 6, 11, 0, '840.00', '94d4f708-9af4-470e-b452-cfc3cabd48e0', 1, 8, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(16, '2023-05-21', '2023-05-11', 6, 12, 1, '1120.00', '98a58b9a-1d64-469c-8ca6-315f88fc0eb6', 1, 3, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(17, '2022-10-15', '2022-10-05', 8, 10, 0, '840.00', '59ff2e67-0299-419d-a28b-d313e60181c1', 1, 5, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(18, '2023-03-16', '2023-03-06', 2, 8, 0, '1120.00', '9bd4a8d0-77cc-46cf-959d-1508b8c1519a', 1, 3, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(19, '2023-01-16', '2023-01-06', 5, 16, 0, '840.00', '2e48022b-7e71-47cf-aad0-4863aefa983d', 1, 1, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(20, '2022-10-20', '2022-10-10', 4, 14, 0, '840.00', '4186fab0-4d7d-4d1b-89e5-b18e73f45011', 1, 3, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(21, '2023-06-09', '2023-05-30', 2, 13, 1, '960.00', 'ff7debd4-1195-4964-95ae-dceb63b395c3', 1, 10, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(22, '2023-04-21', '2023-04-11', 7, 15, 0, '720.00', 'ffc9c819-9466-4209-817a-856c98fc5904', 1, 8, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(23, '2023-04-25', '2023-04-15', 4, 12, 0, '960.00', '70b84420-bacb-444c-9b10-4993ea1e1ee3', 1, 10, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(24, '2022-10-27', '2022-10-17', 3, 15, 0, '840.00', '085b1dee-5b71-47c4-978c-d4d59cb49dea', 1, 10, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(25, '2023-03-31', '2023-03-21', 3, 16, 0, '840.00', 'ae91a379-7900-4a78-ba7d-3a239314bb24', 1, 5, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(26, '2023-01-30', '2023-01-20', 6, 16, 1, '960.00', '4d49a486-1f7f-4543-ac6a-c259e9fd8a62', 1, 7, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(27, '2023-03-16', '2023-03-06', 4, 13, 0, '1120.00', '5d640cb6-cb90-4586-aa18-351abc5a6e25', 1, 1, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(28, '2022-07-24', '2022-07-14', 3, 12, 0, '720.00', 'f5e54bf2-9a8a-4336-bfed-6796e4905eca', 1, 8, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(29, '2023-05-23', '2023-05-13', 3, 8, 0, '1120.00', '1fc0c952-2018-4322-9bc5-9a70a9a8d377', 1, 3, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(30, '2023-03-01', '2023-02-19', 3, 10, 0, '960.00', '77103e9c-ec12-43d3-8ef7-91cfa005f832', 1, 7, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(31, '2022-10-29', '2022-10-19', 6, 12, 1, '720.00', '63a7f24d-7993-49d1-aa6c-cb62fbb4f4ed', 1, 12, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(32, '2023-04-14', '2023-04-04', 6, 15, 0, '1120.00', '49a1d161-fc9c-4827-aa19-785cc33e01ee', 1, 2, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(33, '2023-06-09', '2023-05-30', 5, 15, 0, '1120.00', 'a36f2577-b9eb-47ce-adcf-a26ade48ee2e', 1, 8, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(34, '2023-01-23', '2023-01-13', 3, 15, 0, '840.00', '4a359f61-a8f7-4003-82f0-f8be4aa56ad2', 1, 5, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(35, '2022-09-11', '2022-09-01', 8, 13, 0, '720.00', 'e6365bd9-87d3-4796-a452-8e74222a5647', 1, 2, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(36, '2023-01-08', '2022-12-29', 5, 14, 1, '960.00', '28680624-124b-413d-b7f8-46ba37e32bbb', 1, 3, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(37, '2023-04-28', '2023-04-18', 2, 14, 0, '720.00', '3c0edc51-a27d-4d59-94ae-f374bb52d1a0', 1, 7, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(38, '2022-05-27', '2022-05-17', 8, 8, 0, '840.00', 'ec9bcf68-6596-4ba8-ada1-c511ba829b56', 1, 9, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(39, '2022-12-08', '2022-11-28', 2, 9, 0, '960.00', '7286d014-4546-4e58-8b39-e46d20542b3a', 1, 2, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(40, '2023-02-24', '2023-02-14', 8, 12, 0, '840.00', '2daa6657-b626-4dfe-be9d-8ed92fc4ba0f', 1, 12, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(41, '2022-06-04', '2022-05-25', 7, 15, 1, '960.00', '226d1d40-58ca-4788-bb14-e5df09de45ef', 1, 1, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(42, '2023-02-18', '2023-02-08', 8, 10, 0, '960.00', '67280bfe-75a2-4b75-8eb5-9fdf900ae5d5', 1, 11, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(43, '2023-05-08', '2023-04-28', 4, 10, 0, '1120.00', 'ba503bae-b310-4067-88ab-e182f12da7df', 1, 12, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(44, '2023-01-06', '2022-12-27', 2, 12, 0, '1120.00', '409ce197-a47a-41b4-b0e8-99232b786aa0', 1, 1, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(45, '2022-10-10', '2022-09-30', 3, 10, 0, '720.00', '2e79a0e9-dc15-4056-86c2-36d43d2a7eaf', 1, 5, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(46, '2022-08-19', '2022-08-09', 6, 13, 1, '720.00', 'c144f474-15dd-4017-a516-979bdec97f62', 1, 6, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(47, '2023-01-02', '2022-12-23', 3, 16, 0, '720.00', 'a815135a-fadc-4ff2-98f7-3618e1a270e6', 1, 1, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(48, '2023-02-01', '2023-01-22', 6, 15, 0, '720.00', 'cd64157f-3b0b-4302-8a89-7971772d5d3b', 1, 9, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(49, '2022-07-22', '2022-07-12', 2, 11, 0, '840.00', '27e9ac21-2080-4e0f-99be-5d6675587e79', 1, 8, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(50, '2023-05-28', '2023-05-18', 7, 8, 0, '960.00', 'b6e6ebff-1533-4611-afc1-6091983a9a42', 1, 1, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(51, '2022-12-31', '2022-12-21', 2, 14, 1, '720.00', '8d5c7023-abd7-4b01-bbad-1adaebdd401e', 1, 1, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(52, '2023-03-22', '2023-03-12', 8, 14, 0, '960.00', '4fd332d1-76d3-4ae3-9bbb-526031828d6d', 1, 12, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(53, '2022-06-09', '2022-05-30', 7, 8, 0, '1120.00', 'abdb4d21-d6ff-44be-88ae-3dc3065a9370', 1, 12, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(54, '2022-11-22', '2022-11-12', 4, 8, 0, '720.00', 'ba92f5ab-8eec-4341-b84d-b3b77c57603d', 1, 6, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(55, '2022-07-28', '2022-07-18', 2, 13, 0, '1120.00', 'dd8cdc15-64cd-4ad3-9a49-f68831b63f95', 1, 5, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(56, '2023-06-02', '2023-05-23', 5, 12, 1, '1120.00', 'e03ff690-e868-49ca-bd4a-815ff87b65e7', 1, 8, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(57, '2022-06-22', '2022-06-12', 4, 12, 0, '720.00', '89baeae5-6b4e-4f8c-ba36-32387470601a', 1, 2, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(58, '2023-01-19', '2023-01-09', 3, 14, 0, '960.00', '52ff6450-4c8f-4941-b80e-de096941c9e0', 1, 9, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(59, '2023-05-17', '2023-05-07', 8, 12, 0, '720.00', '5c111211-15e6-4882-adf2-4144ddd108f4', 1, 7, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(60, '2023-03-05', '2023-02-23', 4, 8, 0, '1120.00', 'bb9d970d-48f4-42d2-8c48-c4868ef4be2c', 1, 6, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(61, '2022-06-29', '2022-06-19', 6, 11, 1, '720.00', '6b7987c5-8413-4cdd-9a38-8d2e6f8bb242', 1, 2, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(62, '2022-10-23', '2022-10-13', 8, 10, 0, '720.00', '177eb838-6f57-4d36-803a-ff736989994f', 1, 3, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(63, '2023-05-21', '2023-05-11', 8, 14, 0, '960.00', '2982f19c-127e-490e-9208-22bb3c041893', 1, 3, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(64, '2023-04-05', '2023-03-26', 6, 14, 0, '840.00', '3029cd6e-202f-4267-9be3-16a71b79af7e', 1, 4, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(65, '2023-06-09', '2023-05-30', 2, 15, 0, '720.00', '13224ae1-f60f-4c53-acc3-bdccb7a8e6f8', 1, 3, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(66, '2022-06-18', '2022-06-08', 3, 8, 1, '960.00', '06d36b49-e8f6-4416-9646-49d69a49e748', 1, 6, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(67, '2022-08-23', '2022-08-13', 2, 15, 0, '1120.00', 'd361d8e9-bdcb-48ab-8e9c-45aaca868d62', 1, 11, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(68, '2022-08-30', '2022-08-20', 2, 16, 0, '840.00', 'b293ab6e-1681-4443-8a79-a74cc0a62957', 1, 11, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(69, '2023-03-14', '2023-03-04', 6, 12, 0, '840.00', 'a8c35aa5-53c8-4752-a258-f57d2fac2ce9', 1, 10, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(70, '2022-07-08', '2022-06-28', 3, 10, 0, '840.00', 'ee32bc05-a6a4-44d9-b5e0-f48cfaaa85a6', 1, 4, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(71, '2023-03-09', '2023-02-27', 4, 10, 1, '840.00', 'c9195c9c-f275-43ab-8f45-43c2bb0a9c8c', 1, 11, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(72, '2023-02-26', '2023-02-16', 6, 15, 0, '1120.00', 'fe353d68-5217-41be-b863-e40047bb56a7', 1, 9, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(73, '2023-03-27', '2023-03-17', 7, 13, 0, '720.00', '08659a8a-479c-4a5e-a507-4af304eab673', 1, 5, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(74, '2023-01-12', '2023-01-02', 4, 12, 0, '840.00', '739e7242-0353-4226-9b2f-95d92d153a96', 1, 4, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(75, '2022-09-26', '2022-09-16', 2, 16, 0, '1120.00', '2d2b3edc-9362-4d5d-9a92-6a9a257c026c', 1, 2, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(76, '2022-06-08', '2022-05-29', 7, 8, 1, '1120.00', 'f7b4e8f7-0ad6-4afb-976b-0f858d4fe2ae', 1, 8, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(77, '2023-02-02', '2023-01-23', 4, 13, 0, '720.00', '95647d54-4965-45e6-9fda-187dcb1b8f10', 1, 3, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(78, '2022-12-17', '2022-12-07', 3, 14, 0, '840.00', '3c278e0c-027e-4336-8c4f-721db2151e8d', 1, 9, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(79, '2023-06-12', '2023-06-02', 4, 11, 0, '840.00', 'c9d57313-0c70-4060-a5c5-74f5df1221f8', 1, 10, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(80, '2023-01-08', '2022-12-29', 7, 8, 0, '960.00', '7d0340af-2fad-4ede-81f5-4402c730e0b4', 1, 9, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(81, '2022-11-27', '2022-11-17', 5, 11, 1, '960.00', '2363baf1-e468-4a79-98a7-d90b7d942df8', 1, 3, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(82, '2022-12-29', '2022-12-19', 3, 16, 0, '960.00', '9474836b-8705-4551-98af-31eaa889ed12', 1, 5, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(83, '2022-10-28', '2022-10-18', 2, 13, 0, '840.00', 'f7202235-b204-49e1-90e7-fa3d9799a5ff', 1, 5, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(84, '2022-09-09', '2022-08-30', 3, 13, 0, '960.00', '30915a90-0fde-4845-b3c8-a3712ea06efa', 1, 2, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(85, '2022-08-29', '2022-08-19', 6, 8, 0, '840.00', '7c90f390-cb37-4c3b-88d5-8632b25e63e8', 1, 2, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(86, '2022-08-23', '2022-08-13', 4, 8, 1, '960.00', '84963fd0-624f-4181-8dcd-0d78d3e0c292', 1, 10, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(87, '2022-11-07', '2022-10-28', 4, 15, 0, '720.00', '73efc36a-b0f2-4a11-8c6d-5f8f8f76dee7', 1, 10, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(88, '2023-04-03', '2023-03-24', 6, 14, 0, '720.00', 'faaf8069-fce8-4d49-8d0e-b6163a0d6570', 1, 10, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(89, '2022-08-15', '2022-08-05', 8, 16, 0, '960.00', '8a051a06-fe8e-4e67-b846-f8ab5062994a', 1, 1, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(90, '2022-10-21', '2022-10-11', 4, 13, 0, '720.00', '650eb059-060d-414c-a02c-f8e24b23907d', 1, 1, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(91, '2022-09-20', '2022-09-10', 5, 14, 1, '720.00', 'e4f61c4e-b2d4-4c3e-ab69-6295c5b16afe', 1, 12, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(92, '2023-05-19', '2023-05-09', 8, 14, 0, '720.00', '7157d86e-727c-4b16-8594-5f0156539127', 1, 12, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(93, '2023-03-03', '2023-02-21', 7, 8, 0, '960.00', 'ce9802e1-a0f8-44fc-8f38-b1a74d8a346a', 1, 3, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(94, '2023-05-02', '2023-04-22', 2, 8, 0, '720.00', 'af9c2adc-d25e-4328-aed7-4472e53da77f', 1, 9, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(95, '2022-07-10', '2022-06-30', 4, 8, 0, '840.00', 'c5ee41a5-79e1-48fa-8779-bd36a9ff2f11', 1, 2, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(96, '2022-05-18', '2022-05-08', 6, 8, 1, '1120.00', '0a86b398-af88-48fa-9417-d911fa4cd2f6', 1, 2, NULL, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(97, '2023-05-16', '2023-05-06', 5, 15, 0, '1120.00', '606fe719-cbb1-4013-add1-80e363b7ecc1', 1, 9, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(98, '2023-06-04', '2023-05-25', 6, 9, 0, '1120.00', 'd1048ada-02cf-4c9e-af81-b1f862757df2', 1, 7, 2, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(99, '2023-06-01', '2023-05-22', 5, 14, 0, '720.00', '907c8b58-ce15-4a07-8b3a-80f1af127a71', 1, 9, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(100, '2023-01-13', '2023-01-03', 8, 12, 0, '840.00', '9e48fe46-fc4c-4d82-91da-1f9d2d8fa04a', 1, 3, 1, NULL, NULL, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event_dates`
--

CREATE TABLE `event_dates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `event_dates`
--

INSERT INTO `event_dates` (`id`, `date`, `time_start`, `time_end`, `event_id`, `created_at`, `updated_at`) VALUES
(1, '2022-12-20', '15:30:00', '21:15:00', 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, '2022-12-21', '15:30:00', '21:15:00', 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, '2022-07-20', '14:00:00', '19:00:00', 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(4, '2023-04-21', '14:00:00', '19:00:00', 3, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(5, '2023-03-20', '14:00:00', '19:00:00', 4, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(6, '2022-07-23', '15:30:00', '21:15:00', 5, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(7, '2022-07-24', '15:30:00', '21:15:00', 5, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(8, '2023-02-16', '14:00:00', '19:00:00', 6, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(9, '2023-03-11', '14:00:00', '19:00:00', 7, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(10, '2023-04-25', '14:00:00', '19:00:00', 8, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(11, '2023-05-31', '15:30:00', '21:15:00', 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(12, '2023-06-01', '15:30:00', '21:15:00', 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(13, '2022-09-03', '14:00:00', '19:00:00', 10, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(14, '2022-08-23', '14:00:00', '19:00:00', 11, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(15, '2022-12-11', '14:00:00', '19:00:00', 12, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(16, '2023-05-07', '15:30:00', '21:15:00', 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(17, '2023-05-08', '15:30:00', '21:15:00', 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(18, '2023-05-02', '14:00:00', '19:00:00', 14, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(19, '2023-03-01', '14:00:00', '19:00:00', 15, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(20, '2023-05-21', '14:00:00', '19:00:00', 16, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(21, '2022-10-15', '15:30:00', '21:15:00', 17, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(22, '2022-10-16', '15:30:00', '21:15:00', 17, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(23, '2023-03-16', '14:00:00', '19:00:00', 18, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(24, '2023-01-16', '14:00:00', '19:00:00', 19, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(25, '2022-10-20', '14:00:00', '19:00:00', 20, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(26, '2023-06-09', '15:30:00', '21:15:00', 21, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(27, '2023-06-10', '15:30:00', '21:15:00', 21, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(28, '2023-04-21', '14:00:00', '19:00:00', 22, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(29, '2023-04-25', '14:00:00', '19:00:00', 23, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(30, '2022-10-27', '14:00:00', '19:00:00', 24, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(31, '2023-03-31', '15:30:00', '21:15:00', 25, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(32, '2023-04-01', '15:30:00', '21:15:00', 25, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(33, '2023-01-30', '14:00:00', '19:00:00', 26, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(34, '2023-03-16', '14:00:00', '19:00:00', 27, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(35, '2022-07-24', '14:00:00', '19:00:00', 28, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(36, '2023-05-23', '15:30:00', '21:15:00', 29, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(37, '2023-05-24', '15:30:00', '21:15:00', 29, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(38, '2023-03-01', '14:00:00', '19:00:00', 30, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(39, '2022-10-29', '14:00:00', '19:00:00', 31, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(40, '2023-04-14', '14:00:00', '19:00:00', 32, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(41, '2023-06-09', '15:30:00', '21:15:00', 33, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(42, '2023-06-10', '15:30:00', '21:15:00', 33, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(43, '2023-01-23', '14:00:00', '19:00:00', 34, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(44, '2022-09-11', '14:00:00', '19:00:00', 35, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(45, '2023-01-08', '14:00:00', '19:00:00', 36, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(46, '2023-04-28', '15:30:00', '21:15:00', 37, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(47, '2023-04-29', '15:30:00', '21:15:00', 37, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(48, '2022-05-27', '14:00:00', '19:00:00', 38, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(49, '2022-12-08', '14:00:00', '19:00:00', 39, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(50, '2023-02-24', '14:00:00', '19:00:00', 40, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(51, '2022-06-04', '15:30:00', '21:15:00', 41, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(52, '2022-06-05', '15:30:00', '21:15:00', 41, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(53, '2023-02-18', '14:00:00', '19:00:00', 42, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(54, '2023-05-08', '14:00:00', '19:00:00', 43, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(55, '2023-01-06', '14:00:00', '19:00:00', 44, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(56, '2022-10-10', '15:30:00', '21:15:00', 45, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(57, '2022-10-11', '15:30:00', '21:15:00', 45, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(58, '2022-08-19', '14:00:00', '19:00:00', 46, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(59, '2023-01-02', '14:00:00', '19:00:00', 47, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(60, '2023-02-01', '14:00:00', '19:00:00', 48, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(61, '2022-07-22', '15:30:00', '21:15:00', 49, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(62, '2022-07-23', '15:30:00', '21:15:00', 49, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(63, '2023-05-28', '14:00:00', '19:00:00', 50, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(64, '2022-12-31', '14:00:00', '19:00:00', 51, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(65, '2023-03-22', '14:00:00', '19:00:00', 52, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(66, '2022-06-09', '15:30:00', '21:15:00', 53, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(67, '2022-06-10', '15:30:00', '21:15:00', 53, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(68, '2022-11-22', '14:00:00', '19:00:00', 54, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(69, '2022-07-28', '14:00:00', '19:00:00', 55, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(70, '2023-06-02', '14:00:00', '19:00:00', 56, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(71, '2022-06-22', '15:30:00', '21:15:00', 57, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(72, '2022-06-23', '15:30:00', '21:15:00', 57, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(73, '2023-01-19', '14:00:00', '19:00:00', 58, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(74, '2023-05-17', '14:00:00', '19:00:00', 59, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(75, '2023-03-05', '14:00:00', '19:00:00', 60, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(76, '2022-06-29', '15:30:00', '21:15:00', 61, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(77, '2022-06-30', '15:30:00', '21:15:00', 61, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(78, '2022-10-23', '14:00:00', '19:00:00', 62, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(79, '2023-05-21', '14:00:00', '19:00:00', 63, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(80, '2023-04-05', '14:00:00', '19:00:00', 64, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(81, '2023-06-09', '15:30:00', '21:15:00', 65, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(82, '2023-06-10', '15:30:00', '21:15:00', 65, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(83, '2022-06-18', '14:00:00', '19:00:00', 66, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(84, '2022-08-23', '14:00:00', '19:00:00', 67, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(85, '2022-08-30', '14:00:00', '19:00:00', 68, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(86, '2023-03-14', '15:30:00', '21:15:00', 69, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(87, '2023-03-15', '15:30:00', '21:15:00', 69, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(88, '2022-07-08', '14:00:00', '19:00:00', 70, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(89, '2023-03-09', '14:00:00', '19:00:00', 71, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(90, '2023-02-26', '14:00:00', '19:00:00', 72, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(91, '2023-03-27', '15:30:00', '21:15:00', 73, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(92, '2023-03-28', '15:30:00', '21:15:00', 73, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(93, '2023-01-12', '14:00:00', '19:00:00', 74, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(94, '2022-09-26', '14:00:00', '19:00:00', 75, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(95, '2022-06-08', '14:00:00', '19:00:00', 76, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(96, '2023-02-02', '15:30:00', '21:15:00', 77, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(97, '2023-02-03', '15:30:00', '21:15:00', 77, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(98, '2022-12-17', '14:00:00', '19:00:00', 78, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(99, '2023-06-12', '14:00:00', '19:00:00', 79, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(100, '2023-01-08', '14:00:00', '19:00:00', 80, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(101, '2022-11-27', '15:30:00', '21:15:00', 81, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(102, '2022-11-28', '15:30:00', '21:15:00', 81, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(103, '2022-12-29', '14:00:00', '19:00:00', 82, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(104, '2022-10-28', '14:00:00', '19:00:00', 83, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(105, '2022-09-09', '14:00:00', '19:00:00', 84, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(106, '2022-08-29', '15:30:00', '21:15:00', 85, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(107, '2022-08-30', '15:30:00', '21:15:00', 85, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(108, '2022-08-23', '14:00:00', '19:00:00', 86, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(109, '2022-11-07', '14:00:00', '19:00:00', 87, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(110, '2023-04-03', '14:00:00', '19:00:00', 88, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(111, '2022-08-15', '15:30:00', '21:15:00', 89, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(112, '2022-08-16', '15:30:00', '21:15:00', 89, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(113, '2022-10-21', '14:00:00', '19:00:00', 90, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(114, '2022-09-20', '14:00:00', '19:00:00', 91, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(115, '2023-05-19', '14:00:00', '19:00:00', 92, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(116, '2023-03-03', '15:30:00', '21:15:00', 93, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(117, '2023-03-04', '15:30:00', '21:15:00', 93, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(118, '2023-05-02', '14:00:00', '19:00:00', 94, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(119, '2022-07-10', '14:00:00', '19:00:00', 95, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(120, '2022-05-18', '14:00:00', '19:00:00', 96, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(121, '2023-05-16', '15:30:00', '21:15:00', 97, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(122, '2023-05-17', '15:30:00', '21:15:00', 97, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(123, '2023-06-04', '14:00:00', '19:00:00', 98, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(124, '2023-06-01', '14:00:00', '19:00:00', 99, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(125, '2023-01-13', '14:00:00', '19:00:00', 100, '2022-11-01 08:22:14', '2022-11-01 08:22:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event_user`
--

CREATE TABLE `event_user` (
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `event_user`
--

INSERT INTO `event_user` (`event_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 7, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(1, 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, 15, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(4, 8, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(5, 6, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(6, 10, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(7, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(7, 6, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(8, 16, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(9, 14, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(10, 8, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(11, 15, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(12, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(13, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(14, 6, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(15, 15, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(16, 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(17, 16, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(18, 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(19, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(20, 8, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(21, 6, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(22, 15, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(23, 15, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(24, 7, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(25, 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(26, 16, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(27, 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(28, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(29, 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(30, 11, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(31, 10, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(31, 15, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(32, 8, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(33, 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(34, 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(35, 15, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(36, 6, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(37, 7, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(37, 12, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(38, 11, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(39, 15, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(40, 6, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(41, 14, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(42, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(43, 10, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(43, 16, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(44, 6, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(45, 16, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(46, 7, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(47, 16, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(48, 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(49, 15, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(49, 16, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(50, 16, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(51, 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(52, 8, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(53, 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(54, 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(55, 14, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(56, 12, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(57, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(58, 16, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(59, 7, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(60, 10, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(61, 6, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(61, 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(62, 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(63, 16, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(64, 12, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(65, 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(66, 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(67, 10, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(67, 12, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(68, 7, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(69, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(70, 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(71, 14, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(72, 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(73, 6, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(73, 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(74, 11, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(75, 11, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(76, 8, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(77, 10, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(78, 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(79, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(79, 14, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(80, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(81, 12, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(82, 10, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(83, 2, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(84, 8, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(85, 11, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(85, 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(86, 11, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(87, 11, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(88, 12, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(89, 16, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(90, 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(91, 9, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(91, 11, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(92, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(93, 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(94, 6, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(95, 10, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(96, 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(97, 10, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(97, 16, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(98, 6, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(99, 13, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(100, 15, '2022-11-01 08:22:14', '2022-11-01 08:22:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fileables`
--

CREATE TABLE `fileables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_id` bigint(20) UNSIGNED NOT NULL,
  `fileable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fileable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` double NOT NULL DEFAULT '0',
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `order` tinyint(4) NOT NULL DEFAULT '-1',
  `publish` tinyint(4) NOT NULL DEFAULT '0',
  `locked` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `flags`
--

CREATE TABLE `flags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flaggable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flaggable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `genders`
--

CREATE TABLE `genders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `genders`
--

INSERT INTO `genders` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"männlich\", \"en\": \"male\"}', '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(2, '{\"de\": \"weiblich\", \"en\": \"female\"}', '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(3, '{\"de\": \"andere\", \"en\": \"other\"}', '2022-11-01 08:22:11', '2022-11-01 08:22:11');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `grid_rows`
--

CREATE TABLE `grid_rows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `layout` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `order` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `grid_row_items`
--

CREATE TABLE `grid_row_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` json DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `news_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` text COLLATE utf8mb4_unicode_ci,
  `ratio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` tinyint(4) NOT NULL DEFAULT '0',
  `grid_row_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `heroes`
--

CREATE TABLE `heroes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `heroes`
--

INSERT INTO `heroes` (`id`, `title`, `slug`, `uuid`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Startseite', 'home', 'db36b300-5c86-4e24-9df9-d0f6780b39a1', 1, '2022-11-01 08:22:14', '2022-11-01 08:22:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` double NOT NULL DEFAULT '0',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'visual',
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `orientation` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coords_w` double(16,12) DEFAULT NULL,
  `coords_h` double(16,12) DEFAULT NULL,
  `coords_x` double(16,12) DEFAULT NULL,
  `coords_y` double(16,12) DEFAULT NULL,
  `order` tinyint(4) NOT NULL DEFAULT '-1',
  `publish` tinyint(4) NOT NULL DEFAULT '0',
  `locked` tinyint(4) NOT NULL DEFAULT '0',
  `imageable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imageable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `total` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(8,2) DEFAULT '0.00',
  `vat` decimal(8,2) NOT NULL DEFAULT '0.00',
  `grand_total` decimal(8,2) NOT NULL DEFAULT '0.00',
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_address` text COLLATE utf8mb4_unicode_ci,
  `cancel_reason` text COLLATE utf8mb4_unicode_ci,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recipient` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processed` tinyint(4) NOT NULL DEFAULT '0',
  `error` longtext COLLATE utf8mb4_unicode_ci,
  `mailable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mailable_id` bigint(20) UNSIGNED NOT NULL,
  `mailable_class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` json NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `languages`
--

INSERT INTO `languages` (`id`, `description`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"deutsch\", \"en\": \"german\"}', '678b6353-b928-4398-bbfb-295e3eceae2f', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, '{\"de\": \"englisch\", \"en\": \"english\"}', 'ae074560-ec54-49fc-b4a4-b26293df1581', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` json NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `levels`
--

INSERT INTO `levels` (`id`, `description`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"Einsteiger\", \"en\": \"beginner\"}', 'cdd82595-c8ac-4a0e-8bc6-1d28adf854f6', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, '{\"de\": \"Vertiefung\", \"en\": \"in depth\"}', 'dedc26dd-fae5-470f-be51-fe7ab2da6d8e', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` json NOT NULL,
  `address` json NOT NULL,
  `map` text COLLATE utf8mb4_unicode_ci,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `locations`
--

INSERT INTO `locations` (`id`, `description`, `address`, `map`, `publish`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"Visualisierungs-Akademie, Zürich\", \"en\": \"Visualisierungs-Akademie, Zurich\"}', '{\"de\": \"Förlibuckstrasse 240\\n8006 Zürich\", \"en\": \"Förlibuckstrasse 240\\n8006 Zurich\"}', 'https://goo.gl/maps/JJhSmLv5aKpPz2Pw5', 1, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, '{\"de\": \"Visualisierungs-Akademie, Bern\", \"en\": \"Visualisierungs-Akademie, Bern\"}', '{\"de\": \"Bundesstrasse 4\\nBern\", \"en\": \"Bundesstrasse 4\\n3000 Bern\"}', 'https://goo.gl/maps/9JTRGV719VGY9BUA8', 1, NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `messageable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `messageable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `message_user`
--

CREATE TABLE `message_user` (
  `message_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2012_07_05_0726012_create_countries_table', 1),
(2, '2012_07_05_072601_create_genders_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2022_06_28_064555_create_roles_table', 1),
(8, '2022_06_28_064747_create_role_user_table', 1),
(9, '2022_06_29_080633_create_jobs_table', 1),
(10, '2022_07_04_184656_create_courses_table', 1),
(11, '2022_07_04_184942_create_locations_table', 1),
(12, '2022_07_04_185258_create_software_table', 1),
(13, '2022_07_04_185530_course_software', 1),
(14, '2022_07_04_185853_create_categories_table', 1),
(15, '2022_07_04_185858_create_tags_table', 1),
(16, '2022_07_04_185907_category_course', 1),
(17, '2022_07_04_185910_course_tag', 1),
(18, '2022_07_05_091920_create_events_table', 1),
(19, '2022_07_05_115239_create_sessions_table', 1),
(20, '2022_07_05_122224_create_event_dates_table', 1),
(21, '2022_07_05_130117_event_user', 1),
(22, '2022_07_07_085738_create_languages_table', 1),
(23, '2022_07_07_085826_course_language', 1),
(24, '2022_07_07_085950_create_levels_table', 1),
(25, '2022_07_07_085956_course_level', 1),
(26, '2022_07_14_210349_alter_users_table_add_publish_and_visible', 1),
(27, '2022_07_17_210404_alter_users_table_add_fields', 1),
(28, '2022_07_21_073837_create_images_table', 1),
(29, '2022_07_25_132612_create_bookings_table', 1),
(30, '2022_07_27_145023_alter_images_table_add_type', 1),
(31, '2022_07_30_133610_alter_users_table_add_confirm_token', 1),
(32, '2022_09_20_142334_create_bookmarks_table', 1),
(33, '2022_09_21_152239_alter_courses_table_add_order', 1),
(34, '2022_09_29_193637_create_course_videos_table', 1),
(35, '2022_09_30_073342_create_messages_table', 1),
(36, '2022_09_30_074034_create_message_user_table', 1),
(37, '2022_10_01_100859_create_files_table', 1),
(38, '2022_10_01_124005_create_fileables_table', 1),
(39, '2022_10_05_123516_create_user_addresses_table', 1),
(40, '2022_10_06_143726_create_discount_codes_table', 1),
(41, '2022_10_08_120118_alter_bookings_table_add_fields', 1),
(42, '2022_10_10_090954_alter_events_table_add_state_fields', 1),
(43, '2022_10_10_091751_alter_events_table_add_date_fields', 1),
(44, '2022_10_10_124729_create_invoices_table', 1),
(45, '2022_10_10_133512_alter_bookings_table_add_invoice_amount', 1),
(46, '2022_10_10_203020_alter_bookings_table_drop_billed', 1),
(47, '2022_10_10_211655_alter_users_table_drop_has_invoice_address', 1),
(48, '2022_10_12_161701_alter_tags_table_add_uuid', 1),
(49, '2022_10_12_163205_alter_categories_table_add_uuid', 1),
(50, '2022_10_12_163235_alter_levels_table_add_uuid', 1),
(51, '2022_10_12_163238_alter_languages_table_add_uuid', 1),
(52, '2022_10_12_163242_alter_software_table_add_uuid', 1),
(53, '2022_10_20_090126_create_team_members_table', 1),
(54, '2022_10_20_115358_alter_team_members_table_add_order', 1),
(55, '2022_10_20_133603_create_news_table', 1),
(56, '2022_10_20_142846_create_heroes_table', 1),
(57, '2022_10_21_132839_create_grid_rows_table', 1),
(58, '2022_10_22_155112_create_grid_row_items_table', 1),
(59, '2022_10_22_201006_alter_grid_rows_table_add_layout', 1),
(60, '2022_10_24_143032_alter_grid_row_items_table_add_title', 1),
(61, '2022_10_24_145950_alter_grid_row_items_table_add_ratio', 1),
(62, '2022_10_25_131705_alter_courses_table_add_fields', 1),
(63, '2022_10_25_135943_alter_course_table_rename_facts_columns', 1),
(64, '2022_10_26_110253_create_flags_table', 1),
(65, '2022_10_27_131859_alter_users_table_drop_expert_bio', 1),
(66, '2022_10_27_132111_alter_users_table_add_expert_order', 1),
(67, '2022_10_28_150854_alter_users_table_add_subscribe_newsletter', 1),
(68, '2022_10_31_155338_alter_events_table_add_closed', 1),
(69, '2022_10_31_164326_create_user_files_table', 1),
(70, '2022_10_31_195810_alter_invoices_table_drop_is_paid_and_is_cancelled', 1),
(71, '2022_10_31_203201_alter_discount_codes_table_drop_used', 1),
(72, '2022_10_31_211230_alter_bookings_table_drop_cancelled', 1),
(73, '2022_10_31_223446_alter_events_table_drop_confirmed_cancelled_and_closed', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` json NOT NULL,
  `text` json NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `roles`
--

INSERT INTO `roles` (`id`, `name`, `key`, `uuid`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '862e50a9-17b3-4979-a249-4da2813f1313', '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(2, 'Experte', 'expert', '0f1dbf1d-e509-45bd-90b7-00cbb6cf2d0f', '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(3, 'Student', 'student', '00d7ac58-f8fc-4bbc-8514-975fc3eb8e7d', '2022-11-01 08:22:11', '2022-11-01 08:22:11');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(2, 1, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(3, 1, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(1, 2, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(2, 2, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(3, 2, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(1, 3, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(1, 4, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(1, 5, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(2, 6, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(2, 7, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(2, 8, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(2, 9, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(2, 10, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(2, 11, '2022-11-01 08:22:11', '2022-11-01 08:22:11'),
(2, 12, '2022-11-01 08:22:12', '2022-11-01 08:22:12'),
(2, 13, '2022-11-01 08:22:12', '2022-11-01 08:22:12'),
(2, 14, '2022-11-01 08:22:12', '2022-11-01 08:22:12'),
(2, 15, '2022-11-01 08:22:12', '2022-11-01 08:22:12'),
(2, 16, '2022-11-01 08:22:12', '2022-11-01 08:22:12'),
(3, 17, '2022-11-01 08:22:12', '2022-11-01 08:22:12'),
(3, 18, '2022-11-01 08:22:12', '2022-11-01 08:22:12'),
(3, 19, '2022-11-01 08:22:12', '2022-11-01 08:22:12'),
(3, 20, '2022-11-01 08:22:12', '2022-11-01 08:22:12'),
(3, 21, '2022-11-01 08:22:12', '2022-11-01 08:22:12'),
(3, 22, '2022-11-01 08:22:12', '2022-11-01 08:22:12'),
(3, 23, '2022-11-01 08:22:12', '2022-11-01 08:22:12'),
(3, 24, '2022-11-01 08:22:12', '2022-11-01 08:22:12'),
(3, 25, '2022-11-01 08:22:12', '2022-11-01 08:22:12'),
(3, 26, '2022-11-01 08:22:13', '2022-11-01 08:22:13'),
(3, 27, '2022-11-01 08:22:13', '2022-11-01 08:22:13'),
(3, 28, '2022-11-01 08:22:13', '2022-11-01 08:22:13'),
(3, 29, '2022-11-01 08:22:13', '2022-11-01 08:22:13'),
(3, 30, '2022-11-01 08:22:13', '2022-11-01 08:22:13'),
(3, 31, '2022-11-01 08:22:13', '2022-11-01 08:22:13'),
(3, 32, '2022-11-01 08:22:13', '2022-11-01 08:22:13'),
(3, 33, '2022-11-01 08:22:13', '2022-11-01 08:22:13'),
(3, 34, '2022-11-01 08:22:13', '2022-11-01 08:22:13'),
(3, 35, '2022-11-01 08:22:13', '2022-11-01 08:22:13'),
(3, 36, '2022-11-01 08:22:13', '2022-11-01 08:22:13'),
(3, 37, '2022-11-01 08:22:13', '2022-11-01 08:22:13'),
(3, 38, '2022-11-01 08:22:13', '2022-11-01 08:22:13'),
(3, 39, '2022-11-01 08:22:13', '2022-11-01 08:22:13'),
(3, 40, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, 41, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, 42, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, 43, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, 44, '2022-11-01 08:22:14', '2022-11-01 08:22:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `software`
--

CREATE TABLE `software` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` json NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `software`
--

INSERT INTO `software` (`id`, `description`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"Rhinoceros 7\", \"en\": \"Rhinoceros 7 (en)\"}', 'd848629c-8b93-4893-bf43-25d9244251b5', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, '{\"de\": \"Blender 3\", \"en\": \"Blender 3 (en)\"}', '4ddcac35-785f-4ce2-8bfc-5a3e37e5bfcc', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, '{\"de\": \"SketchUp 2022\", \"en\": \"SketchUp 2022 (en)\"}', '7ecf08af-71ff-45d4-85fc-28728fa28026', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` json NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `tags`
--

INSERT INTO `tags` (`id`, `description`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"Modelling\", \"en\": \"Modelling (en)\"}', '7427666c-833d-4da0-ab87-79a6eb9dd90c', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(2, '{\"de\": \"Rendering\", \"en\": \"Rendering (en)\"}', '523fb14d-e455-4db1-aaa2-9a0189296131', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(3, '{\"de\": \"Visualisierung\", \"en\": \"Visualisierung (en)\"}', '93c44f15-a348-40f6-bb97-56fcb1b4662b', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(4, '{\"de\": \"Animation\", \"en\": \"Animation (en)\"}', '5283eebc-c438-4c26-8d9c-d217169374be', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(5, '{\"de\": \"Konstruktion\", \"en\": \"Konstruktion (en)\"}', '3d384e72-3d38-4ab4-b9d0-7559436a29e5', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(6, '{\"de\": \"Motion Graphics\", \"en\": \"Motion Graphics (en)\"}', '49efb2a2-6f71-413b-a687-069c796fa9a9', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(7, '{\"de\": \"Architektur\", \"en\": \"Architektur (en)\"}', '5c5d67c2-0e92-4d7f-b135-bbbfb30d13e7', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14'),
(8, '{\"de\": \"3D-Druck\", \"en\": \"3D-Druck (en)\"}', '26a42c2e-b6e1-423d-81ae-007c244678e9', NULL, '2022-11-01 08:22:14', '2022-11-01 08:22:14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `team_members`
--

CREATE TABLE `team_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` json NOT NULL,
  `info` json DEFAULT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `order` tinyint(4) NOT NULL DEFAULT '-1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expert_title` text COLLATE utf8mb4_unicode_ci,
  `expert_description` text COLLATE utf8mb4_unicode_ci,
  `expert_order` tinyint(4) NOT NULL DEFAULT '-1',
  `operating_system` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscribe_newsletter` tinyint(4) NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirm_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `visible` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `firstname`, `name`, `company`, `street`, `street_no`, `zip`, `city`, `phone`, `expert_title`, `expert_description`, `expert_order`, `operating_system`, `subscribe_newsletter`, `email`, `email_verified_at`, `password`, `uuid`, `gender_id`, `country_id`, `remember_token`, `confirm_token`, `publish`, `visible`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Marcel', 'Stadelmann', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'm@marceli.to', '2022-11-01 08:22:11', '$2y$10$2x8kWiIzI/dQ/S4mWfRTSOvm13peyj4IHBebbtdsCsVkoACl3r2vK', '90531cfa-b8a5-4687-b8e8-a1cff918d419', 1, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:11', '2022-11-01 08:22:11', NULL),
(2, 'Oliver', 'Schmid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'oliver.schmid@visualisierungs-akademie.ch', '2022-11-01 08:22:11', '$2y$10$bHfvdUboWVorZHa9yo6iWeGLNstgytbNyZukZfFVcz3xwwHofngcy', '223966e7-0bce-42b1-a616-fa05a77b9f5a', 1, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:11', '2022-11-01 08:22:11', NULL),
(3, 'Lutz', 'Kögler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'koegler@nightnurse.ch', '2022-11-01 08:22:11', '$2y$10$irqQZU3Jqho8WFft6/dSlOF/2BTHtOh07/Png26zxHVp2FpRz3d/O', 'a7bd0d2d-3644-4b3e-b4be-d3d1855d7000', 1, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:11', '2022-11-01 08:22:11', NULL),
(4, 'Benedikt', 'Flüeler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'bf@wbg.ch', '2022-11-01 08:22:11', '$2y$10$vCHSPFvNcrbDot1wPbDxuertLmt8gaVOw4An9uC7rQMfPPL341LDu', '10b9d086-73c6-4255-b89f-86950dd1a617', 1, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:11', '2022-11-01 08:22:11', NULL),
(5, 'Bettina', 'Puorger', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'bp@wbg.ch', '2022-11-01 08:22:11', '$2y$10$dAlF0Gm2EtdBXUeBeoj2Lekl8NRdjtdhwWbd0FL2f7ewRCImfYi2e', 'be61119c-b3be-4b4e-9266-b883042fc800', 2, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:11', '2022-11-01 08:22:11', NULL),
(6, 'Peter', 'Muster', 'Muster AG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'viak-experte@0704.ch', '2022-11-01 08:22:11', '$2y$10$qnMw493tBbGUEN.8uZcM/uAxN4iH1lIRuONnf8DWJ9zaT5iUH5VRG', 'd13b29da-8198-473d-a87e-6a6348c709be', 1, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:11', '2022-11-01 08:22:11', NULL),
(7, 'Alicia', 'Trantow', 'Sawayn, Prohaska and Wilderman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'miles.wilderman@oreilly.com', '2022-11-01 08:22:11', '$2y$10$HpOiQ20aHh3A6b8/6IuW1u9vz9BzxN6PyoSg75x1xxeqgHzROZb86', 'a1fb4306-4444-4239-acaa-2ad987e30959', 1, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:11', '2022-11-01 08:22:11', NULL),
(8, 'Jaqueline', 'Abshire', 'Hauck-Rowe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'chase.macejkovic@hotmail.com', '2022-11-01 08:22:11', '$2y$10$PP/LlDFnHfPj8EkrRVedw.A01eW6g3kn6ypBlk3jsvnvK/s.3SbFW', '73f28f47-7ee7-4204-b865-d3eb2450d64c', 1, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:11', '2022-11-01 08:22:11', NULL),
(9, 'Walter', 'Mann', 'Shanahan, Balistreri and Kuhn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'cronin.jessy@gmail.com', '2022-11-01 08:22:11', '$2y$10$ZIHmIKb45xF7JoP.hmsEveqGDokbTOpxAu.B5F2smB5a9HwS.9ARS', '64a72877-8d29-47cf-b1a4-9beb1fcc9b3a', 1, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:11', '2022-11-01 08:22:11', NULL),
(10, 'Idell', 'White', 'Schaefer PLC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'halle52@zboncak.com', '2022-11-01 08:22:11', '$2y$10$AHnGOVGsayq9mBJAz7zPH.ixe43U1zs3KUHEJUXF8A9Z1BYkvM4t.', 'b47c4054-f197-40ad-96a3-c7c66ed7c3ab', 2, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:11', '2022-11-01 08:22:11', NULL),
(11, 'Jesus', 'Walter', 'Keebler PLC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'fschamberger@yahoo.com', '2022-11-01 08:22:11', '$2y$10$VIgZsLTS9jWhkfxkeqx2sej9.zOrIJtB6lpu.UUw/X/IbmnU/OBWC', '90941bd1-8367-4df5-936a-980144b16209', 2, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:11', '2022-11-01 08:22:11', NULL),
(12, 'Delphia', 'Kulas', 'Fay and Sons', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'wyatt.hessel@hotmail.com', '2022-11-01 08:22:11', '$2y$10$VmL.Ri7WsJYJsMaGv1QtDefWfT65KnSX5dGeFODSRbwQOAeby.puS', '8a4a1877-7ff1-4552-b8cf-dffff75101a3', 1, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:12', '2022-11-01 08:22:12', NULL),
(13, 'Mathew', 'Watsica', 'Barrows-Bashirian', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'harber.hunter@gmail.com', '2022-11-01 08:22:12', '$2y$10$Z1gw3s4l.JjtzRcrvGKaLOyX.1F7nHYRhBKZeNisNsG81UdcEDhOq', 'b401d3fc-e154-4c4e-9767-0310c9d0a452', 1, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:12', '2022-11-01 08:22:12', NULL),
(14, 'Keith', 'Hintz', 'Spencer-Mann', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'ramona.marquardt@heidenreich.net', '2022-11-01 08:22:12', '$2y$10$LAiMoqbr44P1nJRqBBo7MuwQ2iFTeJLDPNJpzJNinNIcJoWtipNUC', 'a64e0b18-6b05-4dce-a0bd-87aa43c52a42', 2, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:12', '2022-11-01 08:22:12', NULL),
(15, 'Jamal', 'Stracke', 'Haag Group', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'utremblay@baumbach.net', '2022-11-01 08:22:12', '$2y$10$hLP.vOhVuh3Lp/Q166oooeieJkvF0ygtjDUPpeawbCbAeuqByqEs6', '473f1072-0141-4f23-ac2f-21d1cb93ddc4', 2, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:12', '2022-11-01 08:22:12', NULL),
(16, 'Orie', 'Nienow', 'Skiles, Kilback and Durgan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'hill.lacy@boyle.org', '2022-11-01 08:22:12', '$2y$10$XJeeJn8k6hcS76VZjtdEfunUh9ZKzvWfN/w5EdHXOA6oj9Jvm/3tW', '434f2f11-9523-4848-bcb0-7beabd3414cd', 2, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:12', '2022-11-01 08:22:12', NULL),
(17, 'Patrick', 'Schneider', 'Acme Inc', 'Breitestrasse', '9', '8400', 'Winterthur', '077 755 55 00', NULL, NULL, -1, NULL, 0, 'viak-student1@0704.ch', '2022-11-01 08:22:12', '$2y$10$VYlBQSJbWp2i3txG95fD4eKI22S6GwZkN.hM6s033VAiXD8rzUxNG', '77459436-8a00-45cb-8048-128acc20fc9f', 1, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:12', '2022-11-01 08:22:12', NULL),
(18, 'Michel', 'Blanc', '', 'Dorfstrasse', '12', '5400', 'Remigen', '076 642 01 04', NULL, NULL, -1, NULL, 0, 'viak-student2@0704.ch', '2022-11-01 08:22:12', '$2y$10$GQs9CXR.CkTeeS18sQpRaeIl1A5KwmPKoThNqU1T3wrL/K72KYga2', '6a259aea-ff18-4982-a28c-c0548e53f546', 1, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:12', '2022-11-01 08:22:12', NULL),
(19, 'Raphael', 'Bichsel', 'Bichsel Flugzeugwerke GmbH', 'Konrudstrasse', '4a', '8400', 'Winterthur', '077 870 09 20', NULL, NULL, -1, NULL, 0, 'viak-student3@0704.ch', '2022-11-01 08:22:12', '$2y$10$h9TAFunA.YUIxplAT7xioeeYl1hdbJoqEubP2YZjOqbzfLOz/OBlS', 'fe2af5f3-b982-4b85-9702-5923f08d4de2', 1, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:12', '2022-11-01 08:22:12', NULL),
(20, 'Balint', 'Kalotay', '', 'Billrothstrasse', '5', '8000', 'Zürich', '077 888 88 88', NULL, NULL, -1, NULL, 0, 'viak-student4@0704.ch', '2022-11-01 08:22:12', '$2y$10$IuYrjZHPbSebzx2sJUiQOO42HaWh/T9k6bnAgG/EJtayGqBrtFWKa', '5ad7699a-9b50-4500-ab7c-9728e837a8b7', 1, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:12', '2022-11-01 08:22:12', NULL),
(21, 'Gabriela', 'Morf', '', 'Letzigraben', '149', '8047', 'Zürich', '077 666 55 88', NULL, NULL, -1, NULL, 0, 'viak-student5@0704.ch', '2022-11-01 08:22:12', '$2y$10$tA0F4u4MxyCX8GLSGhkZ8OLxQtk3ofcRDgU3XvZsc9h9VhLlAxLR.', 'd8abefb4-2013-4667-94d9-fac474115dc3', 2, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:12', '2022-11-01 08:22:12', NULL),
(22, 'Mats', 'Thommen', '', 'Feldstrasse', '33', '8400', 'Winterthur', '079 456 21 21', NULL, NULL, -1, NULL, 0, 'viak-student6@0704.ch', '2022-11-01 08:22:12', '$2y$10$qYogAuGgIkfPn8sQlEIkF.PF99I.PVR7959GJJttkjmJltogeLUtC', '69b0fcfd-d445-4cf7-ae7e-67018ff39c08', 1, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:12', '2022-11-01 08:22:12', NULL),
(23, 'Bettina', 'Puorger', '', '', '', '8045', 'Zürich', '077 777 77 88', NULL, NULL, -1, NULL, 0, 'viak-bettina@0704.ch', '2022-11-01 08:22:12', '$2y$10$tzHcRUbelCQhXVbggqOmMeDDJZvGMx5J595ogriP/ElnnNbfkDghO', '06150103-5f84-430f-ba63-9860254860d8', 2, 1, NULL, NULL, 1, 1, '2022-11-01 08:22:12', '2022-11-01 08:22:12', NULL),
(24, 'Hildegard', 'Heathcote', 'Littel, Weber and Fisher', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'mdonnelly@gmail.com', '2022-11-01 08:22:12', '$2y$10$T6odPXfOGcdnPM2QtEcNWuRp6crmqBFV3eq4QavUBzi/qfVuRePG6', 'a813ea24-6723-4f00-b07b-3b1e85fa0ffa', 2, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:12', '2022-11-01 08:22:12', NULL),
(25, 'Arlie', 'Cruickshank', 'Cruickshank Ltd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'funk.clint@yahoo.com', '2022-11-01 08:22:12', '$2y$10$3p7NU64ADUFGz7ULJy/VveO82Ni7QOWf4EeVqTkcSJUBsY2TuG07e', '286198d6-db0b-4d87-bfb3-5af710794ce9', 2, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:12', '2022-11-01 08:22:12', NULL),
(26, 'Selmer', 'Marks', 'Keebler-Crist', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'coconnell@yahoo.com', '2022-11-01 08:22:12', '$2y$10$A/YvFSWyT6x96KvmtEga1OPtLTOfLMCT/9nEaoLCmwRCbPMSgYlEi', 'bd48cc36-a2fc-404a-bb87-d69d7c38fcc8', 2, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:13', '2022-11-01 08:22:13', NULL),
(27, 'Carmen', 'Torphy', 'Reichert Inc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'fern.hettinger@yahoo.com', '2022-11-01 08:22:13', '$2y$10$/q6tx6JEhUA/z727qpU7v.zUa9xVK5QBWmUbUD8zfOjhr.qLkj1Me', '2c4c29df-dfd1-46c6-bcda-fb421c133ec1', 2, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:13', '2022-11-01 08:22:13', NULL),
(28, 'William', 'Gusikowski', 'Herzog-Collier', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'wolf.willard@gmail.com', '2022-11-01 08:22:13', '$2y$10$RJV98wX6Oj2tGSioIs7PMe8Q.D7LJm9Enwl3FvHdsvKNdve2TU7re', '72930af8-2005-4a5f-bba4-b5bca1658a8f', 1, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:13', '2022-11-01 08:22:13', NULL),
(29, 'Deja', 'Corkery', 'Osinski Inc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'renner.nolan@bechtelar.com', '2022-11-01 08:22:13', '$2y$10$bKj8VgrjNgC3DrUqZd/cuehqnDpea/TTjtEn/b5Z9U1aE0HbumkrG', '71fc8ebf-c6e4-42dd-9e54-73057f2ec4ec', 2, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:13', '2022-11-01 08:22:13', NULL),
(30, 'Devan', 'Dooley', 'Watsica-Christiansen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'zelda.collier@hotmail.com', '2022-11-01 08:22:13', '$2y$10$qK6jkjG1DxFH4KZydJwa1OaLa3LAEtyNiFcXLsr/Ac4AkhjD6Fb8.', '6bb6f190-20b4-4e12-9176-fdcc8f8c4626', 2, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:13', '2022-11-01 08:22:13', NULL),
(31, 'Toni', 'Langosh', 'Sawayn-Gusikowski', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'xconnelly@gmail.com', '2022-11-01 08:22:13', '$2y$10$2QuuU3EYgdN.Hq.p5KoQnO5TB8MeK26W0s/7shw3sgDIK5cHK2bWi', '713db953-3689-4693-9127-4a72fef1adaf', 2, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:13', '2022-11-01 08:22:13', NULL),
(32, 'Lori', 'Hoppe', 'Waelchi-Kris', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'caroline29@wilkinson.com', '2022-11-01 08:22:13', '$2y$10$oezs4AJ0ZV0tZYjY5XMLbe2OVCYeZwv5sSS4xJ5K7d2LiHh3vNI56', 'bd317a07-97fa-4f68-bb3e-8ca3a46db020', 1, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:13', '2022-11-01 08:22:13', NULL),
(33, 'Ralph', 'Botsford', 'Wehner-Beatty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'jaycee.runte@gmail.com', '2022-11-01 08:22:13', '$2y$10$2TzGQx8KHrkyrE5HUdUqsu2A.9fS/wn..u1XD8BOEdbt5r/xWoD8q', '9f2354e4-699d-4794-8517-d7bc1e70d7d4', 2, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:13', '2022-11-01 08:22:13', NULL),
(34, 'Wiley', 'Denesik', 'Turcotte-Renner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'lyla35@swift.com', '2022-11-01 08:22:13', '$2y$10$STo6ZDZheInZXtW6nQvkIuQZ.nYm4V0XuNRSdhBhFM4Xa/Yjop/bG', '262c313d-8d44-4cd7-b203-7687d996636b', 2, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:13', '2022-11-01 08:22:13', NULL),
(35, 'Leila', 'Boyle', 'Jast, Bernhard and Kiehn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'gulgowski.spencer@schowalter.com', '2022-11-01 08:22:13', '$2y$10$vIMCfwzMaLgZcqRX5AJ82edWMDsh/GZqzi2pFhymmYrZYetYo5ttO', '933e30dc-19ee-4dbf-a26e-8014a5cdc0b3', 1, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:13', '2022-11-01 08:22:13', NULL),
(36, 'Alisha', 'Pacocha', 'Simonis, Hamill and Lakin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'effie33@gmail.com', '2022-11-01 08:22:13', '$2y$10$Fwhv84cbk0B31kudXiZ6bOTMv7BSBkE6pfiTZ7carpuVIqCjZIV1u', 'a4400e27-ef4e-437e-8db3-70ffec4889c8', 2, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:13', '2022-11-01 08:22:13', NULL),
(37, 'Lillie', 'Weber', 'Gerhold Ltd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'sonya14@fritsch.biz', '2022-11-01 08:22:13', '$2y$10$UxStRd2s2F7MwfW8y.sCdObQzwmlBLxeW0bGFJ49tzHOuQ9D5exP2', '2ad91fdd-7e43-441c-a084-8c41d31f6fa0', 1, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:13', '2022-11-01 08:22:13', NULL),
(38, 'Eddie', 'Spencer', 'Hyatt, Marquardt and Shields', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'luis.gibson@streich.info', '2022-11-01 08:22:13', '$2y$10$C2Ri5ZV9Bzc6dlIovfKyV.Tf8F0RC0eOT8TpsVacTjiPNZVvxweBG', 'c4e51cbe-e80c-4fdf-9c82-6cadc659775e', 1, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:13', '2022-11-01 08:22:13', NULL),
(39, 'Dedric', 'Wiegand', 'DuBuque PLC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'jaida02@nader.info', '2022-11-01 08:22:13', '$2y$10$d0np11Gs28x1CkZOBV2P7ukLe07.IALHQ3IP3IbK9iNb0IAouczH.', 'a382afe5-38ba-4b42-8842-73b051716767', 1, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:13', '2022-11-01 08:22:13', NULL),
(40, 'Roberto', 'Bins', 'Little, Stroman and Jerde', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'dayana.simonis@kunze.com', '2022-11-01 08:22:13', '$2y$10$MCo8Fu3sCgp1pF53ZKvWAORz6B35xO8R3KIHgWSEGoBNW9QNVV9iu', '2bdfdb6b-7ed7-49ac-8f3e-c9b3db78a69d', 1, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(41, 'Delphia', 'Waelchi', 'Nitzsche and Sons', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'joany42@kunde.net', '2022-11-01 08:22:14', '$2y$10$y0HpE5Y.c4.Z2vx3ZWHh9eclxTDeYnaOZpCNVhEfCQuXqizkdo75y', '2dc30987-b963-4fe2-b7f6-b93998165ce2', 2, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(42, 'Eugene', 'Runolfsdottir', 'Anderson Inc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'cicero83@dubuque.com', '2022-11-01 08:22:14', '$2y$10$ocXr0l4toAyQnMi4N4ToE.SXIyiu.KDdLJ43sYk4CCj085t4j8Ztm', 'f72c822c-b706-45dd-baa8-d8fef99ac48f', 2, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(43, 'Chanel', 'Koss', 'Willms, Schuppe and Wilkinson', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'bfunk@gmail.com', '2022-11-01 08:22:14', '$2y$10$JuJLc/MCpz6MLyt1dXMBpu.CYBSLbA2OPnmZ7CiaqRx8wCNYvfvZi', '3bc38bb0-671f-4484-bc59-8ff246a45012', 1, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL),
(44, 'Ollie', 'Green', 'Stehr, Koch and Muller', NULL, NULL, NULL, NULL, NULL, NULL, NULL, -1, NULL, 0, 'heathcote.gaylord@stoltenberg.com', '2022-11-01 08:22:14', '$2y$10$cUBBz75MPinB1gydkzUIie48ANHBqqGIab2yowA32apR6OJNGV4US', '0458b9af-4125-4c8c-ba64-0e210cf8bde9', 2, 1, NULL, NULL, 1, 0, '2022-11-01 08:22:14', '2022-11-01 08:22:14', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_files`
--

CREATE TABLE `user_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_event_id_foreign` (`event_id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Indizes für die Tabelle `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookmarks_event_id_foreign` (`event_id`),
  ADD KEY `bookmarks_user_id_foreign` (`user_id`);

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `category_course`
--
ALTER TABLE `category_course`
  ADD PRIMARY KEY (`course_id`,`category_id`),
  ADD KEY `category_course_category_id_foreign` (`category_id`);

--
-- Indizes für die Tabelle `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `course_language`
--
ALTER TABLE `course_language`
  ADD PRIMARY KEY (`course_id`,`language_id`),
  ADD KEY `course_language_language_id_foreign` (`language_id`);

--
-- Indizes für die Tabelle `course_level`
--
ALTER TABLE `course_level`
  ADD PRIMARY KEY (`course_id`,`level_id`),
  ADD KEY `course_level_level_id_foreign` (`level_id`);

--
-- Indizes für die Tabelle `course_software`
--
ALTER TABLE `course_software`
  ADD PRIMARY KEY (`course_id`,`software_id`),
  ADD KEY `course_software_software_id_foreign` (`software_id`);

--
-- Indizes für die Tabelle `course_tag`
--
ALTER TABLE `course_tag`
  ADD PRIMARY KEY (`course_id`,`tag_id`),
  ADD KEY `course_tag_tag_id_foreign` (`tag_id`);

--
-- Indizes für die Tabelle `course_videos`
--
ALTER TABLE `course_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_videos_course_id_foreign` (`course_id`);

--
-- Indizes für die Tabelle `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `discount_codes_code_unique` (`code`);

--
-- Indizes für die Tabelle `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_course_id_foreign` (`course_id`),
  ADD KEY `events_location_id_foreign` (`location_id`);

--
-- Indizes für die Tabelle `event_dates`
--
ALTER TABLE `event_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_dates_event_id_foreign` (`event_id`);

--
-- Indizes für die Tabelle `event_user`
--
ALTER TABLE `event_user`
  ADD PRIMARY KEY (`event_id`,`user_id`),
  ADD KEY `event_user_user_id_foreign` (`user_id`);

--
-- Indizes für die Tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `fileables`
--
ALTER TABLE `fileables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fileables_file_id_foreign` (`file_id`),
  ADD KEY `fileables_fileable_type_fileable_id_index` (`fileable_type`,`fileable_id`);

--
-- Indizes für die Tabelle `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flags_flaggable_type_flaggable_id_index` (`flaggable_type`,`flaggable_id`),
  ADD KEY `flags_name_flaggable_id_flaggable_type_index` (`name`,`flaggable_id`,`flaggable_type`);

--
-- Indizes für die Tabelle `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `grid_rows`
--
ALTER TABLE `grid_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `grid_row_items`
--
ALTER TABLE `grid_row_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grid_row_items_course_id_foreign` (`course_id`),
  ADD KEY `grid_row_items_news_id_foreign` (`news_id`),
  ADD KEY `grid_row_items_grid_row_id_foreign` (`grid_row_id`);

--
-- Indizes für die Tabelle `heroes`
--
ALTER TABLE `heroes`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_imageable_type_imageable_id_index` (`imageable_type`,`imageable_id`);

--
-- Indizes für die Tabelle `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_booking_id_foreign` (`booking_id`),
  ADD KEY `invoices_user_id_foreign` (`user_id`);

--
-- Indizes für die Tabelle `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_mailable_type_mailable_id_index` (`mailable_type`,`mailable_id`);

--
-- Indizes für die Tabelle `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_messageable_type_messageable_id_index` (`messageable_type`,`messageable_id`);

--
-- Indizes für die Tabelle `message_user`
--
ALTER TABLE `message_user`
  ADD PRIMARY KEY (`message_id`,`user_id`),
  ADD KEY `message_user_user_id_foreign` (`user_id`);

--
-- Indizes für die Tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indizes für die Tabelle `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indizes für die Tabelle `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indizes für die Tabelle `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indizes für die Tabelle `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_gender_id_foreign` (`gender_id`),
  ADD KEY `users_country_id_foreign` (`country_id`);

--
-- Indizes für die Tabelle `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_country_id_foreign` (`country_id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`);

--
-- Indizes für die Tabelle `user_files`
--
ALTER TABLE `user_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_files_filable_type_filable_id_index` (`filable_type`,`filable_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT für Tabelle `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `course_videos`
--
ALTER TABLE `course_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT für Tabelle `event_dates`
--
ALTER TABLE `event_dates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT für Tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `fileables`
--
ALTER TABLE `fileables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `flags`
--
ALTER TABLE `flags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `genders`
--
ALTER TABLE `genders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `grid_rows`
--
ALTER TABLE `grid_rows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `grid_row_items`
--
ALTER TABLE `grid_row_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `heroes`
--
ALTER TABLE `heroes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT für Tabelle `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `software`
--
ALTER TABLE `software`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT für Tabelle `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user_files`
--
ALTER TABLE `user_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `bookmarks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `category_course`
--
ALTER TABLE `category_course`
  ADD CONSTRAINT `category_course_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `category_course_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints der Tabelle `course_language`
--
ALTER TABLE `course_language`
  ADD CONSTRAINT `course_language_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `course_language_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`);

--
-- Constraints der Tabelle `course_level`
--
ALTER TABLE `course_level`
  ADD CONSTRAINT `course_level_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `course_level_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`);

--
-- Constraints der Tabelle `course_software`
--
ALTER TABLE `course_software`
  ADD CONSTRAINT `course_software_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `course_software_software_id_foreign` FOREIGN KEY (`software_id`) REFERENCES `software` (`id`);

--
-- Constraints der Tabelle `course_tag`
--
ALTER TABLE `course_tag`
  ADD CONSTRAINT `course_tag_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `course_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints der Tabelle `course_videos`
--
ALTER TABLE `course_videos`
  ADD CONSTRAINT `course_videos_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints der Tabelle `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `events_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Constraints der Tabelle `event_dates`
--
ALTER TABLE `event_dates`
  ADD CONSTRAINT `event_dates_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints der Tabelle `event_user`
--
ALTER TABLE `event_user`
  ADD CONSTRAINT `event_user_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `event_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `fileables`
--
ALTER TABLE `fileables`
  ADD CONSTRAINT `fileables_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`);

--
-- Constraints der Tabelle `grid_row_items`
--
ALTER TABLE `grid_row_items`
  ADD CONSTRAINT `grid_row_items_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `grid_row_items_grid_row_id_foreign` FOREIGN KEY (`grid_row_id`) REFERENCES `grid_rows` (`id`),
  ADD CONSTRAINT `grid_row_items_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`);

--
-- Constraints der Tabelle `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `message_user`
--
ALTER TABLE `message_user`
  ADD CONSTRAINT `message_user_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`),
  ADD CONSTRAINT `message_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `users_gender_id_foreign` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`);

--
-- Constraints der Tabelle `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

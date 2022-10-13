--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`id`, `description`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"3D-Software\", \"en\": \"3D-Software (en)\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01'),
(2, '{\"de\": \"Bildgestaltung & Handwerk\", \"en\": \"Bildgestaltung & Handwerk (en)\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01'),
(3, '{\"de\": \"Management & Kommunikation\", \"en\": \"Management & Kommunikation (en)\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01');

--
-- Daten für Tabelle `genders`
--

INSERT INTO `genders` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"männlich\", \"en\": \"male\"}', '2022-07-30 12:00:01', '2022-07-30 12:00:01'),
(2, '{\"de\": \"weiblich\", \"en\": \"female\"}', '2022-07-30 12:00:01', '2022-07-30 12:00:01'),
(3, '{\"de\": \"andere\", \"en\": \"other\"}', '2022-07-30 12:00:01', '2022-07-30 12:00:01');

--
-- Daten für Tabelle `languages`
--

INSERT INTO `languages` (`id`, `description`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"deutsch\", \"en\": \"german\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01'),
(2, '{\"de\": \"englisch\", \"en\": \"english\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01');


--
-- Daten für Tabelle `levels`
--

INSERT INTO `levels` (`id`, `description`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"Einsteiger\", \"en\": \"beginner\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01'),
(2, '{\"de\": \"Vertiefung\", \"en\": \"in depth\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01');


--
-- Daten für Tabelle `locations`
--

INSERT INTO `locations` (`id`, `description`, `address`, `map`, `publish`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"Visualisierungs-Akademie, Zürich\", \"en\": \"Visualisierungs-Akademie, Zurich\"}', '{\"de\": \"Förlibuckstrasse 240\\n8006 Zürich\", \"en\": \"Förlibuckstrasse 240\\n8006 Zurich\"}', 'https://goo.gl/maps/JJhSmLv5aKpPz2Pw5', 1, NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01');

--
-- Daten für Tabelle `countries`
--

INSERT INTO `countries` (`id`, `iso`, `name`, `order`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ch', '{\"de\": \"Schweiz\", \"en\": \"Switzerland\"}', 1, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(2, 'af', '{\"de\": \"Afghanistan\", \"en\": \"Afghanistan\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(3, 'eg', '{\"de\": \"Ägypten\", \"en\": \"Egypt\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(4, 'ax', '{\"de\": \"Åland\", \"en\": \"Åland Islands\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(5, 'al', '{\"de\": \"Albanien\", \"en\": \"Albania\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(6, 'dz', '{\"de\": \"Algerien\", \"en\": \"Algeria\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(7, 'as', '{\"de\": \"Amerikanisch-Samoa\", \"en\": \"American Samoa\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(8, 'vi', '{\"de\": \"Amerikanische Jungferninseln\", \"en\": \"Virgin Islands (U.S.)\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(9, 'ad', '{\"de\": \"Andorra\", \"en\": \"Andorra\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(10, 'ao', '{\"de\": \"Angola\", \"en\": \"Angola\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(11, 'ai', '{\"de\": \"Anguilla\", \"en\": \"Anguilla\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(12, 'aq', '{\"de\": \"Antarktis (Sonderstatus durch Antarktisvertrag)\", \"en\": \"Antarctica\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(13, 'ag', '{\"de\": \"Antigua und Barbuda\", \"en\": \"Antigua and Barbuda\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(14, 'gq', '{\"de\": \"Äquatorialguinea\", \"en\": \"Equatorial Guinea\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(15, 'ar', '{\"de\": \"Argentinien\", \"en\": \"Argentina\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(16, 'am', '{\"de\": \"Armenien\", \"en\": \"Armenia\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(17, 'aw', '{\"de\": \"Aruba\", \"en\": \"Aruba\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(18, 'az', '{\"de\": \"Aserbaidschan\", \"en\": \"Azerbaijan\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(19, 'et', '{\"de\": \"Äthiopien\", \"en\": \"Ethiopia\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(20, 'au', '{\"de\": \"Australien\", \"en\": \"Australia\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(21, 'bs', '{\"de\": \"Bahamas\", \"en\": \"Bahamas\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(22, 'bh', '{\"de\": \"Bahrain\", \"en\": \"Bahrain\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(23, 'bd', '{\"de\": \"Bangladesch\", \"en\": \"Bangladesh\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(24, 'bb', '{\"de\": \"Barbados\", \"en\": \"Barbados\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(25, 'by', '{\"de\": \"Belarus\", \"en\": \"Belarus\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(26, 'be', '{\"de\": \"Belgien\", \"en\": \"Belgium\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(27, 'bz', '{\"de\": \"Belize\", \"en\": \"Belize\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(28, 'bj', '{\"de\": \"Benin\", \"en\": \"Benin\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(29, 'bm', '{\"de\": \"Bermuda\", \"en\": \"Bermuda\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(30, 'bt', '{\"de\": \"Bhutan\", \"en\": \"Bhutan\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(31, 'bo', '{\"de\": \"Bolivien\", \"en\": \"Bolivia (Plurinational State of)\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(32, 'bq', '{\"de\": \"Bonaire, Saba, Sint Eustatius\", \"en\": \"Bonaire, Sint Eustatius and Saba\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(33, 'ba', '{\"de\": \"Bosnien und Herzegowina\", \"en\": \"Bosnia and Herzegovina\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(34, 'bw', '{\"de\": \"Botswana\", \"en\": \"Botswana\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(35, 'bv', '{\"de\": \"Bouvetinsel\", \"en\": \"Bouvet Island\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(36, 'br', '{\"de\": \"Brasilien\", \"en\": \"Brazil\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(37, 'vg', '{\"de\": \"Britische Jungferninseln\", \"en\": \"Virgin Islands (British)\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(38, 'io', '{\"de\": \"Britisches Territorium im Indischen Ozean\", \"en\": \"British Indian Ocean Territory\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(39, 'bn', '{\"de\": \"Brunei\", \"en\": \"Brunei Darussalam\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(40, 'bg', '{\"de\": \"Bulgarien\", \"en\": \"Bulgaria\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(41, 'bf', '{\"de\": \"Burkina Faso\", \"en\": \"Burkina Faso\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(42, 'bi', '{\"de\": \"Burundi\", \"en\": \"Burundi\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(43, 'cl', '{\"de\": \"Chile\", \"en\": \"Chile\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(44, 'cn', '{\"de\": \"Volksrepublik China\", \"en\": \"China\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(45, 'ck', '{\"de\": \"Cookinseln\", \"en\": \"Cook Islands\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(46, 'cr', '{\"de\": \"Costa Rica\", \"en\": \"Costa Rica\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(47, 'cw', '{\"de\": \"Curaçao\", \"en\": \"Curaçao\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(48, 'dk', '{\"de\": \"Dänemark\", \"en\": \"Denmark\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(49, 'de', '{\"de\": \"Deutschland\", \"en\": \"Germany\"}', 2, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:12'),
(50, 'dm', '{\"de\": \"Dominica\", \"en\": \"Dominica\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(51, 'do', '{\"de\": \"Dominikanische Republik\", \"en\": \"Dominican Republic\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(52, 'dj', '{\"de\": \"Dschibuti\", \"en\": \"Djibouti\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(53, 'ec', '{\"de\": \"Ecuador\", \"en\": \"Ecuador\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(54, 'ci', '{\"de\": \"Elfenbeinküste\", \"en\": \"Côte d\'Ivoire\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(55, 'sv', '{\"de\": \"El Salvador\", \"en\": \"El Salvador\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(56, 'er', '{\"de\": \"Eritrea\", \"en\": \"Eritrea\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(57, 'ee', '{\"de\": \"Estland\", \"en\": \"Estonia\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(58, 'sz', '{\"de\": \"Eswatini\", \"en\": \"Eswatini\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(59, 'fk', '{\"de\": \"Falklandinseln\", \"en\": \"Falkland Islands (Malvinas)\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(60, 'fo', '{\"de\": \"Färöer\", \"en\": \"Faroe Islands\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(61, 'fj', '{\"de\": \"Fidschi\", \"en\": \"Fiji\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(62, 'fi', '{\"de\": \"Finnland\", \"en\": \"Finland\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(63, 'fr', '{\"de\": \"Frankreich\", \"en\": \"France\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(64, 'gf', '{\"de\": \"Französisch-Guayana\", \"en\": \"French Guiana\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(65, 'pf', '{\"de\": \"Französisch-Polynesien\", \"en\": \"French Polynesia\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(66, 'tf', '{\"de\": \"Französische Süd- und Antarktisgebiete\", \"en\": \"French Southern Territories\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(67, 'ga', '{\"de\": \"Gabun\", \"en\": \"Gabon\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(68, 'gm', '{\"de\": \"Gambia\", \"en\": \"Gambia\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(69, 'ge', '{\"de\": \"Georgien\", \"en\": \"Georgia\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(70, 'gh', '{\"de\": \"Ghana\", \"en\": \"Ghana\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(71, 'gi', '{\"de\": \"Gibraltar\", \"en\": \"Gibraltar\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(72, 'gd', '{\"de\": \"Grenada\", \"en\": \"Grenada\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(73, 'gr', '{\"de\": \"Griechenland\", \"en\": \"Greece\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(74, 'gl', '{\"de\": \"Grönland\", \"en\": \"Greenland\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(75, 'gp', '{\"de\": \"Guadeloupe\", \"en\": \"Guadeloupe\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(76, 'gu', '{\"de\": \"Guam\", \"en\": \"Guam\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(77, 'gt', '{\"de\": \"Guatemala\", \"en\": \"Guatemala\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(78, 'gg', '{\"de\": \"Guernsey (Kanalinsel)\", \"en\": \"Guernsey\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(79, 'gn', '{\"de\": \"Guinea\", \"en\": \"Guinea\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(80, 'gw', '{\"de\": \"Guinea-Bissau\", \"en\": \"Guinea-Bissau\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(81, 'gy', '{\"de\": \"Guyana\", \"en\": \"Guyana\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(82, 'ht', '{\"de\": \"Haiti\", \"en\": \"Haiti\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(83, 'hm', '{\"de\": \"Heard und McDonaldinseln\", \"en\": \"Heard Island and McDonald Islands\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(84, 'hn', '{\"de\": \"Honduras\", \"en\": \"Honduras\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(85, 'hk', '{\"de\": \"Hongkong\", \"en\": \"Hong Kong\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(86, 'in', '{\"de\": \"Indien\", \"en\": \"India\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(87, 'id', '{\"de\": \"Indonesien\", \"en\": \"Indonesia\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(88, 'im', '{\"de\": \"Insel Man\", \"en\": \"Isle of Man\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(89, 'iq', '{\"de\": \"Irak\", \"en\": \"Iraq\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(90, 'ir', '{\"de\": \"Iran\", \"en\": \"Iran (Islamic Republic of)\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(91, 'ie', '{\"de\": \"Irland\", \"en\": \"Ireland\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(92, 'is', '{\"de\": \"Island\", \"en\": \"Iceland\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(93, 'il', '{\"de\": \"Israel\", \"en\": \"Israel\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(94, 'it', '{\"de\": \"Italien\", \"en\": \"Italy\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(95, 'jm', '{\"de\": \"Jamaika\", \"en\": \"Jamaica\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(96, 'jp', '{\"de\": \"Japan\", \"en\": \"Japan\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(97, 'ye', '{\"de\": \"Jemen\", \"en\": \"Yemen\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(98, 'je', '{\"de\": \"Jersey (Kanalinsel)\", \"en\": \"Jersey\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(99, 'jo', '{\"de\": \"Jordanien\", \"en\": \"Jordan\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(100, 'ky', '{\"de\": \"Kaimaninseln\", \"en\": \"Cayman Islands\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(101, 'kh', '{\"de\": \"Kambodscha\", \"en\": \"Cambodia\"}', 99, NULL, '2022-10-11 19:10:11', '2022-10-11 19:10:11'),
(102, 'cm', '{\"de\": \"Kamerun\", \"en\": \"Cameroon\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(103, 'ca', '{\"de\": \"Kanada\", \"en\": \"Canada\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(104, 'cv', '{\"de\": \"Kap Verde\", \"en\": \"Cabo Verde\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(105, 'kz', '{\"de\": \"Kasachstan\", \"en\": \"Kazakhstan\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(106, 'qa', '{\"de\": \"Katar\", \"en\": \"Qatar\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(107, 'ke', '{\"de\": \"Kenia\", \"en\": \"Kenya\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(108, 'kg', '{\"de\": \"Kirgisistan\", \"en\": \"Kyrgyzstan\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(109, 'ki', '{\"de\": \"Kiribati\", \"en\": \"Kiribati\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(110, 'cc', '{\"de\": \"Kokosinseln\", \"en\": \"Cocos (Keeling) Islands\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(111, 'co', '{\"de\": \"Kolumbien\", \"en\": \"Colombia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(112, 'km', '{\"de\": \"Komoren\", \"en\": \"Comoros\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(113, 'cd', '{\"de\": \"Kongo, Demokratische Republik\", \"en\": \"Congo, Democratic Republic of the\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(114, 'cg', '{\"de\": \"Kongo, Republik\", \"en\": \"Congo\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(115, 'kp', '{\"de\": \"Korea, Nord\", \"en\": \"Korea (Democratic People\'s Republic of)\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(116, 'kr', '{\"de\": \"Korea, Süd\", \"en\": \"Korea, Republic of\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(117, 'hr', '{\"de\": \"Kroatien\", \"en\": \"Croatia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(118, 'cu', '{\"de\": \"Kuba\", \"en\": \"Cuba\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(119, 'kw', '{\"de\": \"Kuwait\", \"en\": \"Kuwait\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(120, 'la', '{\"de\": \"Laos\", \"en\": \"Lao People\'s Democratic Republic\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(121, 'ls', '{\"de\": \"Lesotho\", \"en\": \"Lesotho\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(122, 'lv', '{\"de\": \"Lettland\", \"en\": \"Latvia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(123, 'lb', '{\"de\": \"Libanon\", \"en\": \"Lebanon\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(124, 'lr', '{\"de\": \"Liberia\", \"en\": \"Liberia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(125, 'ly', '{\"de\": \"Libyen\", \"en\": \"Libya\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(126, 'li', '{\"de\": \"Liechtenstein\", \"en\": \"Liechtenstein\"}', 4, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(127, 'lt', '{\"de\": \"Litauen\", \"en\": \"Lithuania\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(128, 'lu', '{\"de\": \"Luxemburg\", \"en\": \"Luxembourg\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(129, 'mo', '{\"de\": \"Macau\", \"en\": \"Macao\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(130, 'mg', '{\"de\": \"Madagaskar\", \"en\": \"Madagascar\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(131, 'mw', '{\"de\": \"Malawi\", \"en\": \"Malawi\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(132, 'my', '{\"de\": \"Malaysia\", \"en\": \"Malaysia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(133, 'mv', '{\"de\": \"Malediven\", \"en\": \"Maldives\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(134, 'ml', '{\"de\": \"Mali\", \"en\": \"Mali\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(135, 'mt', '{\"de\": \"Malta\", \"en\": \"Malta\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(136, 'ma', '{\"de\": \"Marokko\", \"en\": \"Morocco\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(137, 'mh', '{\"de\": \"Marshallinseln\", \"en\": \"Marshall Islands\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(138, 'mq', '{\"de\": \"Martinique\", \"en\": \"Martinique\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(139, 'mr', '{\"de\": \"Mauretanien\", \"en\": \"Mauritania\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(140, 'mu', '{\"de\": \"Mauritius\", \"en\": \"Mauritius\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(141, 'yt', '{\"de\": \"Mayotte\", \"en\": \"Mayotte\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(142, 'mx', '{\"de\": \"Mexiko\", \"en\": \"Mexico\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(143, 'fm', '{\"de\": \"Mikronesien\", \"en\": \"Micronesia (Federated States of)\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(144, 'md', '{\"de\": \"Moldau\", \"en\": \"Moldova, Republic of\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(145, 'mc', '{\"de\": \"Monaco\", \"en\": \"Monaco\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(146, 'mn', '{\"de\": \"Mongolei\", \"en\": \"Mongolia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(147, 'me', '{\"de\": \"Montenegro\", \"en\": \"Montenegro\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(148, 'ms', '{\"de\": \"Montserrat\", \"en\": \"Montserrat\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(149, 'mz', '{\"de\": \"Mosambik\", \"en\": \"Mozambique\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(150, 'mm', '{\"de\": \"Myanmar\", \"en\": \"Myanmar\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(151, 'na', '{\"de\": \"Namibia\", \"en\": \"Namibia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(152, 'nr', '{\"de\": \"Nauru\", \"en\": \"Nauru\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(153, 'np', '{\"de\": \"Nepal\", \"en\": \"Nepal\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(154, 'nc', '{\"de\": \"Neukaledonien\", \"en\": \"New Caledonia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(155, 'nz', '{\"de\": \"Neuseeland\", \"en\": \"New Zealand\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(156, 'ni', '{\"de\": \"Nicaragua\", \"en\": \"Nicaragua\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(157, 'nl', '{\"de\": \"Niederlande\", \"en\": \"Netherlands\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(158, 'ne', '{\"de\": \"Niger\", \"en\": \"Niger\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(159, 'ng', '{\"de\": \"Nigeria\", \"en\": \"Nigeria\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(160, 'nu', '{\"de\": \"Niue\", \"en\": \"Niue\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(161, 'mp', '{\"de\": \"Nördliche Marianen\", \"en\": \"Northern Mariana Islands\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(162, 'mk', '{\"de\": \"Nordmazedonien\", \"en\": \"North Macedonia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(163, 'nf', '{\"de\": \"Norfolkinsel\", \"en\": \"Norfolk Island\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(164, 'no', '{\"de\": \"Norwegen\", \"en\": \"Norway\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(165, 'om', '{\"de\": \"Oman\", \"en\": \"Oman\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(166, 'at', '{\"de\": \"österreich\", \"en\": \"Austria\"}', 3, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(167, 'tl', '{\"de\": \"Osttimor\", \"en\": \"Timor-Leste\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(168, 'pk', '{\"de\": \"Pakistan\", \"en\": \"Pakistan\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(169, 'ps', '{\"de\": \"Palästina\", \"en\": \"Palestine, State of\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(170, 'pw', '{\"de\": \"Palau\", \"en\": \"Palau\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(171, 'pa', '{\"de\": \"Panama\", \"en\": \"Panama\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(172, 'pg', '{\"de\": \"Papua-Neuguinea\", \"en\": \"Papua New Guinea\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(173, 'py', '{\"de\": \"Paraguay\", \"en\": \"Paraguay\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(174, 'pe', '{\"de\": \"Peru\", \"en\": \"Peru\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(175, 'ph', '{\"de\": \"Philippinen\", \"en\": \"Philippines\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(176, 'pn', '{\"de\": \"Pitcairninseln\", \"en\": \"Pitcairn\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(177, 'pl', '{\"de\": \"Polen\", \"en\": \"Poland\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(178, 'pt', '{\"de\": \"Portugal\", \"en\": \"Portugal\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(179, 'pr', '{\"de\": \"Puerto Rico\", \"en\": \"Puerto Rico\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(180, 're', '{\"de\": \"Réunion\", \"en\": \"Réunion\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(181, 'rw', '{\"de\": \"Ruanda\", \"en\": \"Rwanda\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(182, 'ro', '{\"de\": \"Rumänien\", \"en\": \"Romania\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(183, 'ru', '{\"de\": \"Russland\", \"en\": \"Russian Federation\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(184, 'sb', '{\"de\": \"Salomonen\", \"en\": \"Solomon Islands\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(185, 'bl', '{\"de\": \"Saint-Barthélemy\", \"en\": \"Saint Barthélemy\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(186, 'mf', '{\"de\": \"Saint-Martin (französischer Teil)\", \"en\": \"Saint Martin (French part)\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(187, 'zm', '{\"de\": \"Sambia\", \"en\": \"Zambia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(188, 'ws', '{\"de\": \"Samoa\", \"en\": \"Samoa\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(189, 'sm', '{\"de\": \"San Marino\", \"en\": \"San Marino\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(190, 'st', '{\"de\": \"São Tomé und Príncipe\", \"en\": \"Sao Tome and Principe\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(191, 'sa', '{\"de\": \"Saudi-Arabien\", \"en\": \"Saudi Arabia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(192, 'se', '{\"de\": \"Schweden\", \"en\": \"Sweden\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(193, 'sn', '{\"de\": \"Senegal\", \"en\": \"Senegal\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(194, 'rs', '{\"de\": \"Serbien\", \"en\": \"Serbia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(195, 'sc', '{\"de\": \"Seychellen\", \"en\": \"Seychelles\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(196, 'sl', '{\"de\": \"Sierra Leone\", \"en\": \"Sierra Leone\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(197, 'zw', '{\"de\": \"Simbabwe\", \"en\": \"Zimbabwe\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(198, 'sg', '{\"de\": \"Singapur\", \"en\": \"Singapore\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(199, 'sx', '{\"de\": \"Sint Maarten\", \"en\": \"Sint Maarten (Dutch part)\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(200, 'sk', '{\"de\": \"Slowakei\", \"en\": \"Slovakia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(201, 'si', '{\"de\": \"Slowenien\", \"en\": \"Slovenia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(202, 'so', '{\"de\": \"Somalia\", \"en\": \"Somalia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(203, 'es', '{\"de\": \"Spanien\", \"en\": \"Spain\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(204, 'lk', '{\"de\": \"Sri Lanka\", \"en\": \"Sri Lanka\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(205, 'sh', '{\"de\": \"St. Helena, Ascension und Tristan da Cunha\", \"en\": \"Saint Helena, Ascension and Tristan da Cunha\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(206, 'kn', '{\"de\": \"St. Kitts und Nevis\", \"en\": \"Saint Kitts and Nevis\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(207, 'lc', '{\"de\": \"St. Lucia\", \"en\": \"Saint Lucia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(208, 'pm', '{\"de\": \"Saint-Pierre und Miquelon\", \"en\": \"Saint Pierre and Miquelon\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(209, 'vc', '{\"de\": \"St. Vincent und die Grenadinen\", \"en\": \"Saint Vincent and the Grenadines\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(210, 'za', '{\"de\": \"Südafrika\", \"en\": \"South Africa\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(211, 'sd', '{\"de\": \"Sudan\", \"en\": \"Sudan\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(212, 'gs', '{\"de\": \"Südgeorgien und die Südlichen Sandwichinseln\", \"en\": \"South Georgia and the South Sandwich Islands\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(213, 'ss', '{\"de\": \"Südsudan\", \"en\": \"South Sudan\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(214, 'sr', '{\"de\": \"Suriname\", \"en\": \"Suriname\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(215, 'sj', '{\"de\": \"Spitzbergen und Jan Mayen\", \"en\": \"Svalbard and Jan Mayen\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(216, 'sy', '{\"de\": \"Syrien\", \"en\": \"Syrian Arab Republic\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(217, 'tj', '{\"de\": \"Tadschikistan\", \"en\": \"Tajikistan\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(218, 'tw', '{\"de\": \"Republik China\", \"en\": \"Taiwan, Province of China\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(219, 'tz', '{\"de\": \"Tansania\", \"en\": \"Tanzania, United Republic of\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(220, 'th', '{\"de\": \"Thailand\", \"en\": \"Thailand\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(221, 'tg', '{\"de\": \"Togo\", \"en\": \"Togo\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(222, 'tk', '{\"de\": \"Tokelau\", \"en\": \"Tokelau\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(223, 'to', '{\"de\": \"Tonga\", \"en\": \"Tonga\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(224, 'tt', '{\"de\": \"Trinidad und Tobago\", \"en\": \"Trinidad and Tobago\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(225, 'td', '{\"de\": \"Tschad\", \"en\": \"Chad\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(226, 'cz', '{\"de\": \"Tschechien\", \"en\": \"Czechia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(227, 'tn', '{\"de\": \"Tunesien\", \"en\": \"Tunisia\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(228, 'tr', '{\"de\": \"Türkei\", \"en\": \"Türkiye\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(229, 'tm', '{\"de\": \"Turkmenistan\", \"en\": \"Turkmenistan\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(230, 'tc', '{\"de\": \"Turks- und Caicosinseln\", \"en\": \"Turks and Caicos Islands\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(231, 'tv', '{\"de\": \"Tuvalu\", \"en\": \"Tuvalu\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(232, 'ug', '{\"de\": \"Uganda\", \"en\": \"Uganda\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(233, 'ua', '{\"de\": \"Ukraine\", \"en\": \"Ukraine\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(234, 'hu', '{\"de\": \"Ungarn\", \"en\": \"Hungary\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(235, 'um', '{\"de\": \"United States Minor Outlying Islands\", \"en\": \"United States Minor Outlying Islands\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(236, 'uy', '{\"de\": \"Uruguay\", \"en\": \"Uruguay\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(237, 'uz', '{\"de\": \"Usbekistan\", \"en\": \"Uzbekistan\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(238, 'vu', '{\"de\": \"Vanuatu\", \"en\": \"Vanuatu\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(239, 'va', '{\"de\": \"Vatikanstadt\", \"en\": \"Holy See\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(240, 've', '{\"de\": \"Venezuela\", \"en\": \"Venezuela (Bolivarian Republic of)\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(241, 'ae', '{\"de\": \"Vereinigte Arabische Emirate\", \"en\": \"United Arab Emirates\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(242, 'us', '{\"de\": \"Vereinigte Staaten\", \"en\": \"United States of America\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(243, 'gb', '{\"de\": \"Vereinigtes Königreich\", \"en\": \"United Kingdom of Great Britain and Northern Ireland\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(244, 'vn', '{\"de\": \"Vietnam\", \"en\": \"Viet Nam\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(245, 'wf', '{\"de\": \"Wallis und Futuna\", \"en\": \"Wallis and Futuna\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(246, 'cx', '{\"de\": \"Weihnachtsinsel\", \"en\": \"Christmas Island\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(247, 'eh', '{\"de\": \"Westsahara\", \"en\": \"Western Sahara\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(248, 'cf', '{\"de\": \"Zentralafrikanische Republik\", \"en\": \"Central African Republic\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12'),
(249, 'cy', '{\"de\": \"Zypern\", \"en\": \"Cyprus\"}', 99, NULL, '2022-10-11 19:10:12', '2022-10-11 19:10:12');

--
-- Daten für Tabelle `courses`
--

INSERT INTO `courses` (`id`, `number`, `slug`, `title`, `subtitle`, `text`, `fee`, `reviews`, `seo_description`, `seo_tags`, `uuid`, `online`, `publish`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '{\"de\": \"storytelling-workshop\", \"en\": \"storytelling-workshop\"}', '{\"de\": \"Storytelling – Workshop\", \"en\": \"Storytelling – Workshop\"}', '{\"de\": \"Molestias itaque ducimus officia cum qui magnam.\", \"en\": \"Velit nostrum distinctio vel.\"}', '{\"de\": \"Exercitationem dolores aut ipsum rerum aliquam. Sunt earum sit et perferendis aliquid. Odio ut quis at mollitia. Vel consequuntur aut facere ullam molestiae quaerat. Dolorem repudiandae neque debitis minus est molestiae. Ipsa enim consectetur perspiciatis rerum ipsum voluptas. Rerum magni optio praesentium in eum ipsa.\", \"en\": \"Sint culpa dolor alias beatae adipisci vel voluptatibus quam. Placeat aperiam delectus consectetur quibusdam cum et corrupti. Commodi soluta quo odio labore blanditiis omnis. Cum omnis ut accusamus. Blanditiis provident aut esse corporis harum sit. Iure dolore nihil velit assumenda ut autem repellendus. Sapiente quis tempora doloribus et.\"}', '376.00', NULL, '{\"en\":null}', '{\"en\":null}', 'f65bd833-d390-4439-b81d-83da2df4adf7', 0, 1, 0, '2022-07-30 12:56:54', '2022-10-04 11:53:24', NULL),
(2, 2, '{\"de\":\"blender-einfuhrungskurs\",\"en\":\"blender-einfuhrungskurs\"}', '{\"de\": \"Blender Einführungskurs\", \"en\": \"Blender Einführungskurs\"}', '{\"de\":\"mit Helge Maus\",\"en\":\"Rerum qui voluptate ea et aut.\"}', '{\"de\": \"Facere animi autem itaque. Autem quos ipsam omnis ut. Mollitia distinctio in molestiae facilis. Nemo temporibus vel quos quo maiores placeat. Labore rerum debitis aliquam itaque. Aliquam explicabo natus ut. Possimus aut eligendi voluptate expedita. Saepe adipisci officiis iusto earum mollitia aut omnis nihil. Dolores distinctio eveniet qui quis voluptate modi.\", \"en\": \"Modi id impedit quasi iste fugit inventore. Quas fuga voluptate quod dolore rerum eos. Quibusdam dolorem perferendis beatae qui repellat. Aut ut molestiae explicabo libero et quibusdam at quia. Eum voluptatem aut voluptates qui commodi occaecati explicabo sed. Autem eligendi eius in. Unde laborum et voluptatem possimus aut amet.\"}', '899.00', NULL, '{\"en\":null}', '{\"en\":null}', '21d29c48-ee8a-4549-a500-6f82f7ff7ddc', 1, 1, 1, '2022-07-30 12:56:54', '2022-10-04 10:33:56', NULL),
(3, 3, '{\"de\": \"blender-renderingkurs\", \"en\": \"blender-renderingkurs\"}', '{\"de\": \"Blender Renderingkurs\", \"en\": \"Blender Renderingkurs\"}', '{\"de\": \"Atque aspernatur qui blanditiis voluptatem.\", \"en\": \"Aut repudiandae praesentium est nihil dolor sequi sed accusantium.\"}', '{\"de\": \"Exercitationem praesentium libero aliquam repellat similique aut ab dolores. Similique odit dolorem aperiam quia. Culpa reiciendis voluptas ad rerum. Sit repellat harum quia vero. Harum dolor et est aspernatur commodi molestiae repellendus. Et dolor veniam laborum temporibus officia quia atque. Ipsa sapiente earum non qui omnis.\", \"en\": \"Dignissimos omnis ut ut. Atque enim est asperiores sequi labore possimus corporis molestiae. Nulla corporis aut fuga commodi. Corrupti qui voluptatibus non cumque. Omnis consequatur id est dolorum est laboriosam. Sint recusandae illo blanditiis eos. Dolore cupiditate labore dolorem dolorem est dicta occaecati consequatur.\"}', '899.00', NULL, '{\"en\":null}', '{\"en\":null}', '98514946-325f-4818-bcdb-4f6b351a490b', 1, 1, 2, '2022-07-30 12:56:54', '2022-10-04 10:32:16', NULL),
(4, 4, '{\"de\": \"blender-animationskurs\", \"en\": \"blender-animationskurs\"}', '{\"de\": \"Blender Animationskurs\", \"en\": \"Blender Animationskurs\"}', '{\"de\": \"Delectus qui enim commodi provident voluptatem.\", \"en\": \"Ea rerum officia quod fugiat sit in.\"}', '{\"de\": \"Iusto aut sapiente itaque eius facere error. Possimus magni et deleniti nisi quia cumque quis cumque. Voluptas quidem qui autem voluptates inventore illum. Ex eum ea quae dignissimos voluptatibus quia officia dolore. Incidunt et ratione error. Velit tempore maxime nemo nam. Enim adipisci non est sequi impedit. Quam amet et occaecati.\", \"en\": \"Doloribus optio in voluptatem natus. Assumenda dolorem minima consectetur rem est. Odio qui corrupti ea consequatur. Deserunt laudantium explicabo assumenda similique. Vel voluptas nostrum saepe distinctio et. Sequi corrupti quibusdam veniam quia. Voluptatum sit est in vitae pariatur. Voluptas illo provident consectetur minus reiciendis incidunt omnis.\"}', '899.00', NULL, '{\"en\":null}', '{\"en\":null}', '68ff897c-f766-4119-bea3-9f3422704d2f', 1, 1, 3, '2022-07-30 12:56:54', '2022-10-04 10:28:34', NULL),
(5, 5, '{\"de\": \"visual-facilitator-basics\", \"en\": \"visual-facilitator-basics\"}', '{\"de\": \"Visual Facilitator Basics\", \"en\": \"Visual Facilitator Basics\"}', '{\"de\": \"Molestiae temporibus quod aut sed iusto.\", \"en\": \"Sed est ut aut suscipit et recusandae.\"}', '{\"de\": \"In distinctio voluptatibus minus aut. Fuga qui praesentium voluptatum ratione et iste. Sapiente dignissimos cupiditate et molestias. Voluptatibus sequi eum voluptas non autem dolor voluptatem placeat.\", \"en\": \"Eum voluptatem velit a. Similique et quasi et totam nam autem. Autem consequuntur sed a harum vero molestias. Et maiores et laboriosam expedita. Soluta dolorum consequatur non nemo enim sit. Ratione quasi aliquam pariatur aut tempore sint. Sunt voluptatem sed iusto dicta sit similique.\"}', '1200.00', NULL, '{\"en\":null}', '{\"en\":null}', '272b01d4-b9af-4d01-bedd-29efbf245ac1', 0, 1, 4, '2022-07-30 12:56:54', '2022-09-21 12:30:56', NULL),
(6, 6, '{\"de\": \"visual-facilitator-advanced\", \"en\": \"visual-facilitator-advanced\"}', '{\"de\": \"Visual Facilitator Advanced\", \"en\": \"Visual Facilitator Advanced\"}', '{\"de\": \"Libero quaerat corporis libero nisi ipsum fuga non.\", \"en\": \"Et sed illo et aspernatur.\"}', '{\"de\": \"Possimus deleniti quia dolor laudantium velit eligendi facere. Blanditiis accusantium saepe ea aliquid. Est officiis molestias veritatis. In rerum nulla nostrum est vitae. Amet reiciendis nobis nobis consequatur quis nobis. Est et corrupti minima quasi id illo earum. Omnis dolorem asperiores placeat. Totam vitae eum illum nihil.\", \"en\": \"Dolorem eum nihil fugit quos. Expedita eaque quibusdam omnis repudiandae modi neque ratione. Eaque quo sit eveniet recusandae officiis accusamus. Numquam dolore aut ad sequi. Doloribus sint hic ipsum occaecati aspernatur autem. Quo voluptate veniam sequi corrupti in repellat ipsa. Debitis consequatur dignissimos eveniet iusto maiores. Nihil porro at culpa voluptatibus beatae quisquam nulla.\"}', '1200.00', NULL, '{\"en\":null}', '{\"en\":null}', 'b286339e-d010-4c75-bd69-f951d10a37e3', 1, 1, 5, '2022-07-30 12:56:54', '2022-09-21 12:30:56', NULL),
(7, 7, '{\"de\": \"rhino-einstiegskurs\", \"en\": \"rhino-einstiegskurs\"}', '{\"de\": \"Rhino Einstiegskurs\", \"en\": \"Rhino Einstiegskurs\"}', '{\"de\": \"Et odit cumque qui doloremque quibusdam quasi.\", \"en\": \"Error provident ut dolor incidunt.\"}', '{\"de\": \"Atque magnam natus voluptatum. Aspernatur et possimus minus porro omnis accusamus. Quia quia eligendi et qui voluptatem. Ea assumenda consequatur sed iste inventore consequatur modi. Est commodi in quos. Incidunt ad sed dolore error expedita. Officiis quia aliquid et ut facilis similique voluptas. Molestiae eius quis aut. Rerum porro et quas praesentium nemo aut.\", \"en\": \"Vero voluptas fugit sapiente officiis. Omnis reprehenderit veritatis excepturi. Fuga tempore et velit doloribus sed doloribus. Et qui in dicta quia magni qui. Maxime sit magni dolores. Nisi est debitis culpa ratione qui. Unde perferendis et dolorum excepturi ab nulla. Dignissimos facere necessitatibus dolores omnis et. Atque reiciendis sunt possimus qui et numquam.\"}', '949.00', NULL, '{\"en\":null}', '{\"en\":null}', '93c8254b-3f21-4c2c-b2e6-4adf09519df2', 1, 1, 6, '2022-07-30 12:56:54', '2022-09-21 12:30:56', NULL),
(8, 8, '{\"de\":\"zbrush-einfuhrungskurs\",\"en\":\"zbrush-einfuhrungskurs\"}', '{\"de\": \"ZBrush Einführungskurs\", \"en\": \"ZBrush Einführungskurs\"}', '{\"de\": \"Aliquam minima occaecati sit voluptatibus non sint.\", \"en\": \"Consequatur et labore corrupti dignissimos eum itaque earum dolorem.\"}', '{\"de\": \"Qui in sed debitis soluta esse et. Fuga repudiandae nostrum aut nostrum. Ducimus consequatur aperiam asperiores ab id et magnam. Corporis laboriosam et ut ea architecto. Ut iusto dolores ut dolor rerum. Eaque modi omnis et perspiciatis natus. Est ipsum sequi quas quo deserunt. Corporis debitis accusamus in aut non.\", \"en\": \"Ea earum enim ullam impedit enim animi vel. Natus sequi et corrupti recusandae eveniet consequatur aperiam. Et eligendi consequatur aut quis. Quam asperiores nesciunt hic et sint. Rerum a rerum ut illum fugiat. Et quis itaque minima quaerat illum nihil. Et et iure aliquid aspernatur animi sunt nemo. Autem voluptatem quia voluptas vel qui.\"}', '499.00', NULL, '{\"en\":null}', '{\"en\":null}', '629f31a1-a5bf-4590-a388-8f04c1b653a6', 0, 1, 7, '2022-07-30 12:56:54', '2022-09-21 12:30:56', NULL),
(9, 9, '{\"de\": \"social-media-marketing\", \"en\": \"social-media-marketing\"}', '{\"de\": \"Social Media Marketing\", \"en\": \"Social Media Marketing\"}', '{\"de\": \"Necessitatibus rerum aspernatur voluptas sint laudantium.\", \"en\": \"Quae dolorem totam excepturi reiciendis consequatur in aut saepe.\"}', '{\"de\": \"Numquam reiciendis sit voluptas et. Quisquam nihil dignissimos provident id vitae. Explicabo nobis recusandae omnis dolor odio. Ut ut eligendi corporis velit. Sit aspernatur quia vel exercitationem porro odio delectus voluptate. Tempora et excepturi qui ducimus sed.\", \"en\": \"Ipsa voluptatum nesciunt dolor perspiciatis nihil quidem mollitia. Animi placeat molestias suscipit praesentium eum blanditiis eum. Animi et aperiam et vitae. Quo fuga omnis reiciendis. Dolor unde reprehenderit ullam suscipit. At quis aliquid et nulla quia vitae ex. Eligendi et ipsa est est iste nihil.\"}', '499.00', NULL, '{\"en\":null}', '{\"en\":null}', 'ecb9e3f7-d87c-49e3-baaf-82ef41af320e', 0, 1, 8, '2022-07-30 12:56:54', '2022-09-21 12:30:56', NULL),
(10, 10, '{\"de\": \"after-effects-ae-einstiegskurs\", \"en\": \"after-effects-ae-einstiegskurs\"}', '{\"de\": \"After Effects (AE) Einstiegskurs\", \"en\": \"After Effects (AE) Einstiegskurs\"}', '{\"de\": \"Cumque sint accusamus voluptatum ex.\", \"en\": \"Aliquam nihil et dolor dolores et rerum est similique.\"}', '{\"de\": \"Et rerum modi exercitationem consectetur odio aut necessitatibus. Illum laborum ipsam error sed voluptates. Eligendi aut consequatur esse cupiditate ad iure. Consequatur rerum iste maxime temporibus. Adipisci voluptatem quia recusandae. Ipsum sint pariatur qui aut. Quo alias esse praesentium eos porro occaecati. Rerum dolores explicabo vel quo et nesciunt ut.\", \"en\": \"Veritatis occaecati odit molestias. Velit laborum nostrum quibusdam voluptatem autem velit fuga. Quaerat totam qui enim praesentium. Sequi blanditiis incidunt qui nisi est. Possimus error velit ea optio. Modi rerum quos rerum veritatis. Rem perferendis distinctio doloribus qui et autem. Nemo et voluptatem harum.\"}', '1295.00', NULL, '{\"en\":null}', '{\"en\":null}', '0fd0c166-6a47-41a9-935d-cbd1408d2286', 0, 1, 9, '2022-07-30 12:56:54', '2022-09-21 12:30:56', NULL),
(11, 11, '{\"de\":\"rhino-grasshopper-kurs-fur-einsteiger\",\"en\":\"rhino-grasshopper-kurs-fur-einsteiger\"}', '{\"de\": \"Rhino Grasshopper Kurs für Einsteiger\", \"en\": \"Rhino Grasshopper Kurs für Einsteiger\"}', '{\"de\": \"Amet harum recusandae dignissimos.\", \"en\": \"Qui commodi incidunt non tenetur et repellendus nihil.\"}', '{\"de\": \"Non reiciendis rerum iure voluptatum et tempora. Temporibus corporis ex ut aspernatur architecto. Nulla iste fugiat voluptatibus debitis ratione. Esse laboriosam eos nihil tempore ut ut. Vel ut et assumenda illo consequatur sint. Repellendus nihil ratione expedita consequuntur consectetur fugiat pariatur.\", \"en\": \"Consequuntur quo eaque dolores facilis voluptas minima aliquid. Ea eligendi iste autem soluta. Qui omnis non est et a non ratione. Cum unde voluptatem voluptatem quae et consequatur. Qui illo nobis deleniti id vel. Magni ea voluptatem consequatur optio qui accusamus.\"}', '949.00', NULL, '{\"en\":null}', '{\"en\":null}', '275c11c9-ba4c-4ee4-8535-a96d3a8d1518', 0, 1, 10, '2022-07-30 12:56:54', '2022-09-21 12:30:56', NULL),
(12, 12, '{\"de\": \"geheimnisse-der-architekturvisualisierung\", \"en\": \"geheimnisse-der-architekturvisualisierung\"}', '{\"de\": \"Geheimnisse der Architekturvisualisierung\", \"en\": \"Geheimnisse der Architekturvisualisierung\"}', '{\"de\": \"Explicabo perferendis et praesentium provident sit possimus.\", \"en\": \"At tenetur incidunt nulla totam et.\"}', '{\"de\": \"Architecto sapiente quis totam dolorum tenetur voluptatem qui. Amet ut et qui ut ut quo praesentium adipisci. Ut quo ducimus doloribus quam quibusdam. Accusamus et odit qui veniam et. Cupiditate est tenetur molestiae harum fugiat quidem reprehenderit. Totam voluptas aperiam placeat error. Minus illum recusandae voluptas corrupti est maiores. Fugiat esse consequatur dolorem voluptatem facere.\", \"en\": \"Eos fuga maxime ut qui incidunt natus et. Dolore iure ipsum est omnis quia eaque omnis. Et rerum facere et optio. Incidunt excepturi qui vitae nihil aspernatur distinctio consequatur reprehenderit. Quia est deleniti commodi accusamus aut. Eum tempora ad maxime ut. Sunt porro ab sint nihil.\"}', '499.00', NULL, '{\"en\":null}', '{\"en\":null}', 'f711d82b-97a8-4645-a9a6-79c4cfad8dda', 1, 1, 11, '2022-07-30 12:56:54', '2022-09-21 12:30:56', NULL);

--
-- Daten für Tabelle `images`
--

INSERT INTO `images` (`id`, `uuid`, `name`, `original_name`, `extension`, `size`, `type`, `caption`, `description`, `orientation`, `coords_w`, `coords_h`, `coords_x`, `coords_y`, `order`, `publish`, `locked`, `imageable_type`, `imageable_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '61c72882-cf51-41ed-b174-aed5b0764af4', '6304eae351ea7_Blender_Kurs_1_16_9.jpg', 'Blender_Kurs_1_16_9.jpg', 'jpg', 201684, 'teaser', NULL, NULL, 'l', 477.000000000000, 477.000000000000, 423.000000000000, 60.000000000000, -1, 1, 0, 'App\\Models\\Course', 2, '2022-08-23 11:02:07', '2022-08-23 10:57:39', '2022-08-23 11:02:07'),
(2, '3f8866c2-0008-483e-8753-1d749d24c799', '6304eb0d74405_Blender_Kurs_1_16_9.jpg', 'Blender_Kurs_1_16_9.jpg', 'jpg', 201684, 'visual', NULL, NULL, 'l', 1429.000000000000, 804.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 2, '2022-08-23 11:02:09', '2022-08-23 10:58:21', '2022-08-23 11:02:09'),
(3, '19611ab1-0d55-404e-831e-2c8488f74fd9', '6304ebf876f46_Blender_Kurs_1_16_9.jpg', 'Blender_Kurs_1_16_9.jpg', 'jpg', 210604, 'teaser', NULL, NULL, 'l', 400.000000000000, 400.000000000000, 485.000000000000, 74.000000000000, -1, 1, 0, 'App\\Models\\Course', 2, '2022-08-24 09:58:45', '2022-08-23 11:02:16', '2022-08-24 09:58:45'),
(4, '3d1fd4c8-8456-491f-b456-1d0d92311ed0', '6304ebfcbed8c_Blender_Kurs_1_16_9.jpg', 'Blender_Kurs_1_16_9.jpg', 'jpg', 210604, 'visual', NULL, NULL, 'l', 1429.000000000000, 804.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 2, '2022-08-24 09:58:47', '2022-08-23 11:02:20', '2022-08-24 09:58:47'),
(5, 'd7770ee3-2510-4527-9f2f-90c5f6652e00', '63062e9f3053d_Blender_Kurse_16_9_1.jpg', 'Blender_Kurse_16_9_1.jpg', 'jpg', 160492, 'visual', NULL, NULL, 'l', 0.000000000000, 0.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 2, '2022-08-24 09:59:47', '2022-08-24 09:58:55', '2022-08-24 09:59:47'),
(6, 'b1344299-359e-4759-9971-55118fa3bfd6', '63062ea387092_Blender_Kurse_16_9_1.jpg', 'Blender_Kurse_16_9_1.jpg', 'jpg', 160492, 'visual', NULL, NULL, 'l', 1429.000000000000, 804.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 2, NULL, '2022-08-24 09:58:59', '2022-08-24 10:00:33'),
(7, 'd76af3dd-31b6-44cd-bf2a-39de0e99d233', '63062ed9e691b_Blender_Kurse_16_9_1_thumb.jpg', 'Blender_Kurse_16_9_1_thumb.jpg', 'jpg', 144220, 'teaser', NULL, NULL, 'l', 804.000000000000, 804.000000000000, 490.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 2, NULL, '2022-08-24 09:59:54', '2022-08-24 10:00:19'),
(8, '5bc66440-6325-4f10-9ded-07f550d7f802', '63062f186a76f_Blender_Kurse_16_9_2.jpg', 'Blender_Kurse_16_9_2.jpg', 'jpg', 199270, 'visual', NULL, NULL, 'l', 1429.000000000000, 804.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 3, NULL, '2022-08-24 10:00:56', '2022-08-24 10:01:11'),
(9, 'c07f19b6-093e-4d23-98cc-b582d26bffba', '63062f5e5f217_Blender_Kurse_16_9_2_thumb.jpg', 'Blender_Kurse_16_9_2_thumb.jpg', 'jpg', 191233, 'teaser', NULL, NULL, 'p', 709.000000000000, 709.000000000000, 302.000000000000, 65.000000000000, -1, 1, 0, 'App\\Models\\Course', 3, NULL, '2022-08-24 10:02:06', '2022-08-24 10:02:26'),
(10, '806f26e3-d655-400e-9f79-69a75ae0756e', '63062f8de48b6_Blender_Kurse_16_9_3.jpg', 'Blender_Kurse_16_9_3.jpg', 'jpg', 133493, 'visual', NULL, NULL, 'l', 1429.000000000000, 804.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 4, NULL, '2022-08-24 10:02:54', '2022-08-24 10:03:46'),
(11, 'fd2ec83c-90c7-4685-a223-be8672a9fdb5', '63062f91791d9_Blender_Kurse_16_9_3_thumb.jpg', 'Blender_Kurse_16_9_3_thumb.jpg', 'jpg', 116890, 'teaser', NULL, NULL, 'p', 653.000000000000, 653.000000000000, 776.000000000000, 129.000000000000, -1, 1, 0, 'App\\Models\\Course', 4, NULL, '2022-08-24 10:02:57', '2022-08-24 10:03:39'),
(12, 'b24406ef-7a6b-4201-ad60-7a7cccd938dd', '630630d606b9d_AfterEffects_Kurse_16_9.jpg', 'AfterEffects_Kurse_16_9.jpg', 'jpg', 141266, 'visual', NULL, NULL, 'l', 1429.000000000000, 804.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 10, NULL, '2022-08-24 10:08:22', '2022-08-24 10:09:06'),
(13, 'cab079f1-5bed-4a1f-8b61-cbad074dd75c', '630630dbb72de_AfterEffects_Kurse_16_9.jpg', 'AfterEffects_Kurse_16_9.jpg', 'jpg', 141266, 'teaser', NULL, NULL, 'p', 804.000000000000, 804.000000000000, 291.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 10, NULL, '2022-08-24 10:08:27', '2022-08-24 10:08:59'),
(14, '09921c9a-1c62-412d-98df-aa73ff140f02', '63063297f18dc_ArchViz_Kurse_16_9.jpg', 'ArchViz_Kurse_16_9.jpg', 'jpg', 793931, 'visual', NULL, NULL, 'l', 2000.000000000000, 1125.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 12, NULL, '2022-08-24 10:15:52', '2022-08-24 10:16:42'),
(15, 'bad4ce23-7ee6-429a-b563-1b2977279bff', '6306329c576ac_ArchViz_Kurse_16_9.jpg', 'ArchViz_Kurse_16_9.jpg', 'jpg', 793931, 'teaser', NULL, NULL, 'p', 1125.000000000000, 1125.000000000000, 864.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 12, NULL, '2022-08-24 10:15:56', '2022-08-24 10:16:34'),
(16, '0d622e78-30e8-406f-a6e5-cf35851f701f', '6306364395e8d_Storytelling_Kurs_16_9.jpg', 'Storytelling_Kurs_16_9.jpg', 'jpg', 476681, 'visual', NULL, NULL, 'l', 2000.000000000000, 1125.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 1, NULL, '2022-08-24 10:31:31', '2022-08-24 10:32:12'),
(17, '75f212af-19c1-4f7a-890d-1a20bf5f2897', '6306364741599_Storytelling_Kurs_16_9.jpg', 'Storytelling_Kurs_16_9.jpg', 'jpg', 476681, 'teaser', NULL, NULL, 'l', 1069.000000000000, 1069.000000000000, 439.000000000000, 33.000000000000, -1, 1, 0, 'App\\Models\\Course', 1, NULL, '2022-08-24 10:31:35', '2022-08-24 10:32:04'),
(18, '7cc75348-12da-4036-a20d-a27d8ac1dc4f', '630637e677bd1_Iktnes_2000x1400px.jpg', 'Iktnes_2000x1400px.jpg', 'jpg', 2065330, 'visual', NULL, NULL, 'l', 1962.000000000000, 1104.000000000000, 16.000000000000, 16.000000000000, -1, 1, 0, 'App\\Models\\Course', 8, NULL, '2022-08-24 10:38:30', '2022-08-24 10:39:41'),
(19, 'a3532a5c-a68b-4c76-9836-972b4c03579e', '630637ec2879b_Iktnes_2000x1400px.jpg', 'Iktnes_2000x1400px.jpg', 'jpg', 2065330, 'teaser', NULL, NULL, 'p', 836.000000000000, 836.000000000000, 618.000000000000, 150.000000000000, -1, 1, 0, 'App\\Models\\Course', 8, NULL, '2022-08-24 10:38:36', '2022-08-24 10:41:11'),
(20, '6b0b17c1-c95b-4e4c-813c-0edcbe004f8d', '63063a5e78c9f_Rhino_Kurse_16_9.jpg', 'Rhino_Kurse_16_9.jpg', 'jpg', 110451, 'visual', NULL, NULL, 'l', 2000.000000000000, 1125.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 7, NULL, '2022-08-24 10:49:02', '2022-08-24 10:49:15'),
(21, 'd948cbc5-0b5c-48c0-a693-a3d43beb94b4', '63063a6253a24_Rhino_Kurse_16_9.jpg', 'Rhino_Kurse_16_9.jpg', 'jpg', 110451, 'teaser', NULL, NULL, 'p', 639.000000000000, 639.000000000000, 491.000000000000, 324.000000000000, -1, 1, 0, 'App\\Models\\Course', 7, '2022-08-24 10:54:23', '2022-08-24 10:49:06', '2022-08-24 10:54:23'),
(22, '78827b26-2108-4735-8641-0eef6d6efde4', '63063baa224e1_Rhino_Kurse_1_1.jpg', 'Rhino_Kurse_1_1.jpg', 'jpg', 122742, 'teaser', NULL, NULL, 'p', 1984.000000000000, 1984.000000000000, 16.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 7, NULL, '2022-08-24 10:54:34', '2022-08-24 10:54:53'),
(23, '4d5101ea-7522-4754-8ec3-3d229d941d79', '63063c89e0f9b_SocialMediaMarketing_16_9.jpg', 'SocialMediaMarketing_16_9.jpg', 'jpg', 561551, 'teaser', NULL, NULL, 'p', 1033.000000000000, 1033.000000000000, 457.000000000000, 37.000000000000, -1, 1, 0, 'App\\Models\\Course', 9, NULL, '2022-08-24 10:58:18', '2022-08-24 11:00:00'),
(24, 'add4e6b6-3cfd-49e8-afdb-ff826a78fd87', '63063c8e22162_SocialMediaMarketing_16_9.jpg', 'SocialMediaMarketing_16_9.jpg', 'jpg', 561551, 'visual', NULL, NULL, 'l', 2000.000000000000, 1125.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 9, NULL, '2022-08-24 10:58:22', '2022-08-24 10:58:39'),
(25, 'bf9db75e-c86d-499f-a52e-9906e1898260', '63063f398e7f6_Rhino_Grasshopper_Kurse_16_9.jpg', 'Rhino_Grasshopper_Kurse_16_9.jpg', 'jpg', 143733, 'visual', NULL, NULL, 'l', 2000.000000000000, 1125.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 11, NULL, '2022-08-24 11:09:45', '2022-08-24 11:10:10'),
(26, 'a0966e02-d6e6-4fc6-a9b7-c85df4148580', '63063f3f5868c_Grasshopper_logo.png', 'Grasshopper_logo.png', 'png', 156420, 'teaser', NULL, NULL, 'l', 310.000000000000, 310.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 11, NULL, '2022-08-24 11:09:51', '2022-08-24 11:10:03'),
(27, '7bef03c8-6d50-4e15-a4ba-dfbff8998e9f', '630648929c3a0_VisualBasics_16_9_1.jpg', 'VisualBasics_16_9_1.jpg', 'jpg', 160885, 'teaser', NULL, NULL, 'p', 1051.000000000000, 1051.000000000000, 302.000000000000, 29.000000000000, -1, 1, 0, 'App\\Models\\Course', 5, NULL, '2022-08-24 11:49:38', '2022-08-24 11:50:26'),
(28, '3944ffb7-001b-4426-b25b-b4e84f6eb63a', '630648987e65f_VisualBasics_16_9_1.jpg', 'VisualBasics_16_9_1.jpg', 'jpg', 160885, 'visual', NULL, NULL, 'l', 1920.000000000000, 1080.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 5, NULL, '2022-08-24 11:49:44', '2022-08-24 11:50:44'),
(29, '6c50a713-b66d-4e72-b253-964ae498ccd6', '630649d48e1d7_VisualAdvanced_16_9.jpg', 'VisualAdvanced_16_9.jpg', 'jpg', 144281, 'teaser', NULL, NULL, 'p', 875.000000000000, 875.000000000000, 248.000000000000, 205.000000000000, -1, 1, 0, 'App\\Models\\Course', 6, NULL, '2022-08-24 11:55:01', '2022-08-24 11:55:42'),
(30, '694032e3-6884-4a37-b161-b990cababa94', '630649e13af6d_VisualAdvanced_16_9.jpg', 'VisualAdvanced_16_9.jpg', 'jpg', 144281, 'visual', NULL, NULL, 'l', 1920.000000000000, 1080.000000000000, 0.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 6, NULL, '2022-08-24 11:55:13', '2022-08-24 11:55:25');

--
-- Daten für Tabelle `roles`
--

INSERT INTO `roles` (`id`, `name`, `key`, `uuid`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '417e8686-65a3-4ef3-b380-f0128cbbc331', '2022-07-30 12:00:01', '2022-07-30 12:00:01'),
(2, 'Experte', 'expert', '6ca9e9db-6d4e-432c-a384-15d478846757', '2022-07-30 12:00:01', '2022-07-30 12:00:01'),
(3, 'Student', 'student', '17501c90-856b-4f6f-8a5a-d563ef2bc106', '2022-07-30 12:00:01', '2022-07-30 12:00:01');

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `firstname`, `name`, `company`, `street`, `street_no`, `zip`, `city`, `phone`, `expert_title`, `expert_description`, `expert_bio`, `operating_system`, `email`, `email_verified_at`, `password`, `uuid`, `gender_id`, `country_id`, `remember_token`, `confirm_token`, `publish`, `visible`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Marcel', 'Stadelmann', NULL, 'Letzigraben', '149', '8047', 'Zürich', NULL, NULL, NULL, NULL, NULL, 'm@marceli.to', '2022-07-30 12:00:01', '$2y$10$omQHIUX.f4O8gtTvivz8HeEyxwODClJ7hnNbOsqjS1s4xoLh66qg.', '419b3e13-69a2-4517-815c-cf0eaa15d70d', 1, 1, NULL, NULL, 0, 0, '2022-10-01 12:00:01', '2022-10-01 12:00:01', NULL),
(2, 'Oliver', 'Schmid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'oliver.schmid@visualisierungs-akademie.ch', '2022-07-30 12:00:01', '$2y$10$B2o20W2Sn7DnJs43lMFjn.5EkGvH1pr3N5J3sXk7LRTsMZWUNz1Ju', '5d68d892-35f6-4222-827e-b15c18c83bfa', 1, 1, NULL, NULL, 1, 0, '2022-10-01 12:00:01', '2022-10-01 12:00:01', NULL),
(3, 'Lutz', 'Kögler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'koegler@nightnurse.ch', '2022-07-30 12:00:01', '$2y$10$aeFq9wQ/Jq6h9oE8XAa3s.PEtYcHKnmi/BJimmLnwkSLdEjG0Wl4m', '4b5a4359-36c4-43b5-8b60-018016ab5db7', 1, 1, NULL, NULL, 1, 0, '2022-10-01 12:00:01', '2022-10-01 12:00:01', NULL),
(4, 'Benedikt', 'Flüeler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bf@wbg.ch', '2022-07-30 12:00:01', '$2y$10$yLLw1shq.k6CDgm4e9AwjObXTI2tQ0ld1ja3OIYzOZI8x123g0FDe', '24b92c1a-3338-4b4d-a638-006a11a234ad', 1, 1, NULL, NULL, 1, 0, '2022-10-01 12:00:01', '2022-10-01 12:00:01', NULL),
(5, 'Bettina', 'Puorger', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bp@wbg.ch', '2022-07-30 12:00:01', '$2y$10$YT9z3OUO/oHhW2xyvA8jBeWN5YyM6C7AYUvS9/9tjqygUBQKx2iXq', 'c79b552a-dc65-469b-a03d-239780731912', 2, 1, NULL, NULL, 1, 0, '2022-10-01 12:00:01', '2022-10-01 12:00:01', NULL);


--
-- Daten für Tabelle `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-07-30 12:00:01', '2022-07-30 12:00:01'),
(2, 1, '2022-07-30 12:00:01', '2022-07-30 12:00:01'),
(3, 1, '2022-07-30 12:00:01', '2022-07-30 12:00:01'),
(1, 2, '2022-07-30 12:00:01', '2022-07-30 12:00:01'),
(1, 3, '2022-07-30 12:00:01', '2022-07-30 12:00:01'),
(1, 4, '2022-07-30 12:00:01', '2022-07-30 12:00:01'),
(1, 5, '2022-07-30 12:00:01', '2022-07-30 12:00:01');


--
-- Daten für Tabelle `software`
--

INSERT INTO `software` (`id`, `description`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"Rhinoceros 7\", \"en\": \"Rhinoceros 7 (en)\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01'),
(2, '{\"de\":\"Blender 3 (de)\",\"en\":\"Blender 3 (en)\"}', '', NULL, '2022-10-01 12:00:01', '2022-09-19 15:18:38'),
(3, '{\"de\": \"SketchUp 2022\", \"en\": \"SketchUp 2022 (en)\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01');


--
-- Daten für Tabelle `tags`
--

INSERT INTO `tags` (`id`, `description`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"Modelling\", \"en\": \"Modelling (en)\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01'),
(2, '{\"de\": \"Rendering\", \"en\": \"Rendering (en)\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01'),
(3, '{\"de\": \"Visualisierung\", \"en\": \"Visualisierung (en)\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01'),
(4, '{\"de\": \"Animation\", \"en\": \"Animation (en)\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01'),
(5, '{\"de\": \"Konstruktion\", \"en\": \"Konstruktion (en)\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01'),
(6, '{\"de\": \"Motion Graphics\", \"en\": \"Motion Graphics (en)\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01'),
(7, '{\"de\": \"Architektur\", \"en\": \"Architektur (en)\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01'),
(8, '{\"de\": \"3D-Druck\", \"en\": \"3D-Druck (en)\"}', '', NULL, '2022-10-01 12:00:01', '2022-10-01 12:00:01');
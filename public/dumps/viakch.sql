-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 29. Jul 2022 um 11:48
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
  `address` text COLLATE utf8mb4_unicode_ci,
  `billed` tinyint(4) NOT NULL DEFAULT '0',
  `cancelled` tinyint(4) NOT NULL DEFAULT '0',
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `booked_at` datetime NOT NULL,
  `cancelled_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `bookings`
--

INSERT INTO `bookings` (`id`, `uuid`, `number`, `address`, `billed`, `cancelled`, `event_id`, `user_id`, `booked_at`, `cancelled_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '63ff1e32-42d0-4045-a8eb-ee91fd413701', '000001', NULL, 0, 1, 1, 1, '2022-07-28 18:30:17', '2022-07-28 18:32:46', '2022-07-28 16:30:17', '2022-07-28 16:32:46', '2022-07-28 16:32:46'),
(2, '0901bbea-7976-44ce-9b59-46756c04a3ab', '000002', NULL, 0, 1, 1, 1, '2022-07-28 18:35:15', '2022-07-28 18:38:23', '2022-07-28 16:35:15', '2022-07-28 16:38:23', '2022-07-28 16:38:23'),
(3, 'c27ebbe7-15ce-439c-b1ee-808fcb90a786', '000003', NULL, 0, 0, 28, 17, '2022-07-29 05:19:41', NULL, '2022-07-29 03:19:41', '2022-07-29 03:19:41', NULL),
(4, 'a9cb03b8-acd9-4537-afdf-aa42a5897621', '000004', NULL, 0, 0, 11, 17, '2022-07-29 05:19:41', NULL, '2022-07-29 03:19:41', '2022-07-29 03:19:41', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"3D-Software\", \"en\": \"3D-Software (en)\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(2, '{\"de\": \"Bildgestaltung & Handwerk\", \"en\": \"Bildgestaltung & Handwerk (en)\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, '{\"de\": \"Management & Kommunikation\", \"en\": \"Management & Kommunikation (en)\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40');

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
(3, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(2, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(1, 3, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(1, 4, NULL, NULL),
(1, 5, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(1, 6, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(1, 7, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(2, 8, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 9, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(2, 10, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(2, 11, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 12, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(1, 14, NULL, NULL),
(1, 15, NULL, NULL);

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
  `text` json NOT NULL,
  `fee` decimal(8,2) DEFAULT '0.00',
  `reviews` text COLLATE utf8mb4_unicode_ci,
  `seo_description` json DEFAULT NULL,
  `seo_tags` json DEFAULT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `online` tinyint(4) NOT NULL DEFAULT '0',
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `courses`
--

INSERT INTO `courses` (`id`, `number`, `slug`, `title`, `subtitle`, `text`, `fee`, `reviews`, `seo_description`, `seo_tags`, `uuid`, `online`, `publish`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '{\"de\": \"storytelling-workshop\", \"en\": \"storytelling-workshop\"}', '{\"de\": \"Storytelling – Workshop\", \"en\": \"Storytelling – Workshop\"}', '{\"de\": \"Aut sed iste labore.\", \"en\": \"Quaerat quibusdam et laudantium quia.\"}', '{\"de\": \"Amet qui quam est error facilis sed aut. Nulla nemo atque suscipit earum nostrum laudantium. Tempora voluptas quia sit natus. Amet minus quae dolorum a explicabo sit saepe soluta. Sed ea molestiae ea consequatur explicabo asperiores. Impedit quis aperiam quibusdam vero quia cupiditate quis. Nobis praesentium quidem aut sit autem sed. Vero non quisquam nobis aut.\", \"en\": \"Cum molestias quidem sequi fugiat. Qui occaecati blanditiis error. Et nulla dolorum culpa numquam dolorum voluptatem velit. Ut quidem sit sit quia. Ut libero culpa maiores nihil. Itaque et eaque et aliquam in ea eaque. Accusamus voluptatem aut consequuntur architecto aliquid modi. Quam esse harum quam amet velit totam aliquam voluptatem.\"}', '720.00', NULL, '{\"en\": null}', '{\"en\": null}', '4e4968df-e07d-426e-ab03-a72fdfad246f', 0, 1, '2022-07-28 14:04:40', '2022-07-29 05:30:13', NULL),
(2, 2, '{\"de\": \"blender-einfuehrungskurs\", \"en\": \"blender-einfuehrungskurs\"}', '{\"de\": \"Blender Einführungskurs\", \"en\": \"Blender Einführungskurs\"}', '{\"de\": \"Error aut dolorum dolorum ipsa ut aliquam.\", \"en\": \"Repellat amet aut ducimus optio aperiam praesentium.\"}', '{\"de\": \"Veritatis voluptates ut eum tempore et architecto voluptas. Nostrum sint eius possimus voluptate at. Necessitatibus non sint deleniti maiores nulla sit voluptas. Sunt dolores fugiat beatae sapiente ducimus ab. Est ut est voluptate distinctio aspernatur nulla numquam ullam. Quos odio velit placeat veritatis. Id sit in autem aliquam natus beatae non.\", \"en\": \"Accusantium omnis occaecati est harum tenetur nesciunt aut et. Nulla minima id suscipit laborum quo. Voluptates rem quia eos. Aut perferendis nulla officiis quae. Quia voluptatem dolores nobis eligendi autem voluptatem debitis deleniti.\"}', '840.00', NULL, '{\"en\": null}', '{\"en\": null}', 'dd2399ea-0b3f-4f84-89fb-1af79c19bb01', 1, 1, '2022-07-28 14:04:40', '2022-07-28 17:03:25', NULL),
(3, 3, '{\"de\": \"blender-renderingkurs\", \"en\": \"blender-renderingkurs\"}', '{\"de\": \"Blender Renderingkurs\", \"en\": \"Blender Renderingkurs\"}', '{\"de\": \"In aut nemo eos qui provident expedita.\", \"en\": \"Et et nam similique impedit voluptate neque necessitatibus molestiae.\"}', '{\"de\": \"Cumque itaque nisi saepe illo perspiciatis perspiciatis. Id et a veritatis perspiciatis odit suscipit. Minima molestiae deserunt placeat in fugiat qui. Cumque qui aut tempore qui perferendis rerum ut. Omnis autem recusandae cupiditate non est optio. Atque ad blanditiis voluptate sequi. Nostrum dolor error ipsa sint et. Aspernatur hic voluptates eum minima et molestiae rem.\", \"en\": \"Saepe quia qui dolores eum et. Non maxime magni ipsum et tempore harum. Minima beatae ea quibusdam unde sit quis. Amet in blanditiis architecto inventore optio sed. Nam itaque sed architecto et iusto laboriosam quo. Aliquid voluptatem possimus et porro. Laudantium dolores quibusdam quia et aut numquam. Neque et ut itaque quis ex. Accusamus eum nulla nobis vel voluptatem nihil id est.\"}', '720.00', NULL, '{\"en\": null}', '{\"en\": null}', 'ab902c07-2064-4d1b-8e22-8db6b5b77f14', 0, 1, '2022-07-28 14:04:40', '2022-07-28 16:43:47', NULL),
(4, 4, '{\"de\": \"blender-animationskurs\", \"en\": \"blender-animationskurs\"}', '{\"de\": \"Blender Animationskurs\", \"en\": \"Blender Animationskurs\"}', '{\"de\": \"Qui voluptatem sit nulla dolor nemo sequi nisi.\", \"en\": \"Et officiis similique architecto qui id facere.\"}', '{\"de\": \"Aliquid est consequatur architecto molestiae rerum consequatur unde omnis. Quia mollitia consequatur enim nulla reprehenderit cum quis. Amet tempore eius reiciendis. Voluptatem ducimus accusantium porro ut. Qui doloribus est deleniti quis sit sunt. Molestiae tempore consequatur commodi consequatur corrupti atque.\", \"en\": \"Dicta quidem aliquam neque soluta labore non. Et blanditiis consectetur deserunt ea est. Aliquid quidem ullam id laudantium incidunt. Quia eveniet inventore perspiciatis deserunt ea magnam. Sit nostrum eos et ut vitae dolores ea voluptas. Qui rerum in aliquam et et earum quod natus.\"}', '960.00', NULL, '{\"en\": null}', '{\"en\": null}', 'd6b5dae2-e9c0-4464-9277-3f8f3d448da7', 1, 1, '2022-07-28 14:04:40', '2022-07-28 16:43:56', NULL),
(5, 5, '{\"de\": \"visual-facilitator-basics\", \"en\": \"visual-facilitator-basics\"}', '{\"de\": \"Visual Facilitator Basics\", \"en\": \"Visual Facilitator Basics\"}', '{\"de\": \"In fugit quo enim est.\", \"en\": \"Laborum voluptas adipisci officia sint.\"}', '{\"de\": \"Qui nesciunt est omnis mollitia facilis mollitia repellat. Mollitia deleniti laudantium repudiandae voluptatem qui enim. Voluptates exercitationem dolorem quia. Sed porro omnis itaque qui error veritatis. Aut excepturi reprehenderit ad et possimus ut. Libero expedita id aperiam. Veritatis deserunt tempora odit qui illum consequatur et.\", \"en\": \"Eum ut hic perspiciatis doloribus ad aut. Ipsa et perspiciatis repellendus ut. Sint autem est laudantium id maiores. Modi aut dolorem totam qui. Incidunt magnam numquam et cumque eos repellendus enim. Consequuntur mollitia aut suscipit eligendi ipsa blanditiis. Corrupti ut maiores maiores rerum nostrum et.\"}', '960.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'f42d4033-19bd-4c76-84b4-f1abde599be6', 0, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(6, 6, '{\"de\": \"visual-facilitator-advanced\", \"en\": \"visual-facilitator-advanced\"}', '{\"de\": \"Visual Facilitator Advanced\", \"en\": \"Visual Facilitator Advanced\"}', '{\"de\": \"Omnis velit exercitationem saepe iusto consequatur aut excepturi.\", \"en\": \"Quidem enim nobis expedita quis ullam.\"}', '{\"de\": \"Corrupti placeat quia delectus voluptates enim. Voluptatibus non et veritatis tenetur quia dicta qui. Nostrum laudantium autem ut ipsam molestiae aut consequatur optio. Deserunt voluptate pariatur modi doloremque. Eum totam esse est.\", \"en\": \"Labore incidunt et est non temporibus qui. Qui excepturi quibusdam est eos veniam. Provident omnis assumenda quas est et aut. Temporibus rem id veniam ea ut. Ullam perferendis ullam accusamus. Assumenda ut aut dolores non cumque itaque sed optio. Et laboriosam assumenda provident placeat quo.\"}', '840.00', NULL, '{\"en\": null}', '{\"en\": null}', '632b0b40-3fa1-4ae1-86c0-3c29380e6a6b', 0, 1, '2022-07-28 14:04:40', '2022-07-28 16:44:17', NULL),
(7, 7, '{\"de\": \"rhino-einstiegskurs\", \"en\": \"rhino-einstiegskurs\"}', '{\"de\": \"Rhino Einstiegskurs\", \"en\": \"Rhino Einstiegskurs\"}', '{\"de\": \"Qui quam voluptatem est qui et.\", \"en\": \"Sed commodi ullam beatae illum quo cumque inventore.\"}', '{\"de\": \"Aut non unde magni ab voluptatum ipsa odit soluta. Voluptatem expedita in officiis eius temporibus. A necessitatibus aliquam soluta. Rem aliquid rerum excepturi qui rerum qui. Voluptatem quisquam recusandae quisquam et. Atque aut facilis architecto voluptatibus delectus necessitatibus quos. Quod non aut aut laboriosam.\", \"en\": \"Ducimus sit voluptate provident. Unde quisquam deserunt ut minus odit voluptatem. Eos perspiciatis optio ex sapiente quas quam nam illo. Molestiae commodi ab ut et est quis voluptatem. Qui ut itaque cupiditate. Excepturi voluptas sit minima et qui. Quibusdam ipsam quae repudiandae consequuntur aut fugiat. Consequatur rerum ullam magni ut est reprehenderit.\"}', '960.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'ee2f787f-3785-4f5e-9426-ba60264082f6', 1, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(8, 8, '{\"de\": \"zbrush-einfuehrungskurs\", \"en\": \"zbrush-einfuehrungskurs\"}', '{\"de\": \"ZBrush Einführungskurs\", \"en\": \"ZBrush Einführungskurs\"}', '{\"de\": \"Repellat delectus corrupti et voluptas nulla.\", \"en\": \"Sunt est quod debitis quidem ipsum.\"}', '{\"de\": \"Nulla dolorem voluptatem et quia est dolor. Ut voluptatem laudantium ut est ut nemo. Quod a recusandae rerum cum. Quia error non optio sit. Nemo delectus autem ipsa unde. Fugiat in vitae vero ut. Eaque maxime quia dolore eaque. Aut ea ratione quisquam. Nihil magnam mollitia voluptatibus rerum. Omnis sed aut voluptate sint et. Rerum eligendi quis ipsum porro iste. Quia ut nihil sed omnis eligendi.\", \"en\": \"Doloremque aut quia eum similique veniam. Iure provident officiis cumque. Rerum aliquam eos assumenda ex unde. Hic est molestiae odio eaque eaque. Commodi quia iste quod fugiat. Qui sint quia laborum cum. Deleniti laborum inventore optio rerum. Magnam non et perspiciatis pariatur. Beatae sed ut quam odio. Nostrum ea nihil iusto officia aliquam.\"}', '840.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'c1224246-4578-4901-b9ab-4ddbeb647ea4', 1, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(9, 9, '{\"de\": \"social-media-marketing\", \"en\": \"social-media-marketing\"}', '{\"de\": \"Social Media Marketing\", \"en\": \"Social Media Marketing\"}', '{\"de\": \"Ducimus perspiciatis earum qui maxime ducimus corrupti eius et.\", \"en\": \"Debitis totam minus aut quibusdam nulla qui autem.\"}', '{\"de\": \"Adipisci aut non et cumque quis et. Ea natus aperiam et adipisci porro voluptatem. Animi odit doloribus sit non enim distinctio quo sit. Quam excepturi non sint vel sapiente. Modi quaerat ad dolorum distinctio autem harum ducimus.\", \"en\": \"Eveniet perspiciatis omnis deserunt cumque porro minus consequatur veritatis. Rerum officiis quibusdam cumque et est. Molestiae fugit ea deleniti. Quas quia laborum fuga est ut soluta quia.\"}', '840.00', NULL, '{\"en\": null}', '{\"en\": null}', '3f0a050a-b576-48a2-b2a6-94b9a5a134d3', 0, 1, '2022-07-28 14:04:40', '2022-07-28 16:44:39', NULL),
(10, 10, '{\"de\": \"after-effects-ae-einstiegskurs\", \"en\": \"after-effects-ae-einstiegskurs\"}', '{\"de\": \"After Effects (AE) Einstiegskurs\", \"en\": \"After Effects (AE) Einstiegskurs\"}', '{\"de\": \"Maxime quis quis asperiores sequi.\", \"en\": \"Quam expedita blanditiis ipsum est qui praesentium nisi officiis.\"}', '{\"de\": \"Numquam et sed similique quaerat architecto sint consequatur. Necessitatibus magnam sint maiores consequatur omnis nostrum laboriosam. Qui omnis sequi sed quia. Facere perferendis aspernatur eos recusandae. Hic dolores beatae repellendus nulla.\", \"en\": \"Nam corporis mollitia reiciendis dicta molestiae magnam eos voluptas. Cupiditate rem qui eos ea eaque nihil. Sed totam quo cupiditate. Deleniti non voluptate id aut aliquam. Id suscipit tenetur maiores et. Et est expedita repellendus eos. Vitae eos est itaque voluptate soluta sint accusamus. Voluptas quaerat consequatur nam aperiam eum officiis ea molestiae.\"}', '1120.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '18bcb79f-203c-4ddf-b0f7-e615f7a627e3', 1, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(11, 11, '{\"de\": \"rhino-grasshopper-kurs-fuer-einsteiger\", \"en\": \"rhino-grasshopper-kurs-fuer-einsteiger\"}', '{\"de\": \"Rhino Grasshopper Kurs für Einsteiger\", \"en\": \"Rhino Grasshopper Kurs für Einsteiger\"}', '{\"de\": \"Perspiciatis et ipsa rerum nihil eius doloribus sit iure.\", \"en\": \"Aliquam aut non sint non error ipsa.\"}', '{\"de\": \"Illum fugiat dolorem eos iusto impedit dicta. Voluptas placeat est ab est aut et. Et dolore nam sit rerum pariatur tempora. Molestias nemo et quia eos minima dolore. Hic dolore sed officiis. Dolorem rem quis eum quis ab iusto delectus. Quia explicabo blanditiis cum quidem. Velit veritatis distinctio tenetur rerum enim est. Officia doloribus mollitia nihil iure aspernatur aut soluta.\", \"en\": \"Quasi sed iusto qui ut impedit. Ipsa omnis eum ut rem quam qui voluptatem sunt. Ab molestiae qui quo et. Non dicta consequatur rerum ipsa quis quis. Labore in placeat soluta eaque esse iure et. Eos id qui deserunt error. Eum enim accusantium non. Excepturi alias eum excepturi qui quas quidem beatae. Repellendus ex natus omnis totam ratione.\"}', '1120.00', NULL, '{\"en\": null}', '{\"en\": null}', 'd9234615-7b4b-45d3-9000-92986f6638ad', 0, 1, '2022-07-28 14:04:40', '2022-07-28 16:45:04', NULL),
(12, 12, '{\"de\": \"geheimnisse-der-architekturvisualisierung\", \"en\": \"geheimnisse-der-architekturvisualisierung\"}', '{\"de\": \"Geheimnisse der Architekturvisualisierung\", \"en\": \"Geheimnisse der Architekturvisualisierung\"}', '{\"de\": \"Odio sunt sit minima cum rem.\", \"en\": \"Ut quam sequi voluptatum deserunt quibusdam velit a.\"}', '{\"de\": \"Voluptatem aliquam sed sit officia ad exercitationem voluptas et. Repellat ut veritatis eveniet. Possimus odit unde officia minima beatae quo incidunt. Itaque ratione et dolorum in ut ut. Iste dolor vitae totam aut quis recusandae voluptatibus. Velit et omnis ducimus veniam aut ut reiciendis libero. Eaque qui sed dignissimos reprehenderit. Reiciendis adipisci adipisci doloremque veniam delectus.\", \"en\": \"Quae quod qui sint et sint ut natus quia. Quo necessitatibus voluptatem voluptas laborum. Nesciunt illum optio quia quod esse nihil sit. Est voluptatem qui quo non dolorem porro. Aspernatur molestiae id quisquam quidem.\"}', '1120.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'c1a32d04-bd7c-47c9-ac87-efcd1bf1b530', 0, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(14, 99, '{\"de\": \"null\", \"en\": \"null\"}', '{\"de\": \"Necessitatibus venia\", \"en\": null}', '{\"de\": \"Ea repudiandae exped\", \"en\": null}', '{\"de\": \"<p>asdfa</p>\", \"en\": null}', '50.00', NULL, '{\"en\": null}', '{\"en\": null}', '04bbc248-8e86-4b73-89f8-bd818ac7d95b', 1, 0, '2022-07-28 15:56:41', '2022-07-28 17:09:31', NULL),
(15, 27, '{\"de\": \"null\", \"en\": \"null\"}', '{\"de\": \"Laborum Omnis elit\", \"en\": null}', '{\"de\": \"asdfasdfa\", \"en\": null}', '{\"de\": \"<p>asdfasdfasf</p>\", \"en\": null}', '55.00', 'asdfadsf', '{\"de\": \"asdfasdf\", \"en\": null}', '{\"de\": \"asdfasdf\", \"en\": null}', '1bde1e72-b072-4ce5-97df-384b37ae121e', 1, 0, '2022-07-28 16:06:10', '2022-07-28 16:45:19', NULL);

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
(1, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(2, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(4, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(5, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(6, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(7, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(8, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(9, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(10, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(11, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(12, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(14, 2, NULL, NULL),
(15, 2, NULL, NULL);

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
(1, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(2, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(4, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(5, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(6, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(7, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(8, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(9, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(10, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(11, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(12, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(14, 1, NULL, NULL),
(15, 1, NULL, NULL),
(15, 2, NULL, NULL);

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
(1, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(2, 2, NULL, NULL),
(3, 2, NULL, NULL),
(4, 2, NULL, NULL),
(5, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(6, 1, NULL, NULL),
(7, 3, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(8, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(9, 1, NULL, NULL),
(10, 3, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(11, 1, NULL, NULL),
(12, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(14, 1, NULL, NULL),
(14, 3, NULL, NULL),
(15, 1, NULL, NULL),
(15, 2, NULL, NULL),
(15, 3, NULL, NULL);

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

--
-- Daten für Tabelle `course_tag`
--

INSERT INTO `course_tag` (`course_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(14, 2, NULL, NULL),
(14, 3, NULL, NULL),
(14, 7, NULL, NULL),
(14, 8, NULL, NULL),
(15, 3, NULL, NULL),
(15, 6, NULL, NULL),
(15, 7, NULL, NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `events`
--

INSERT INTO `events` (`id`, `date`, `registration_until`, `min_participants`, `max_participants`, `online`, `fee`, `uuid`, `publish`, `course_id`, `location_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2022-11-04', '2022-10-24', 8, 16, 1, '960.00', '4d63fa0e-b693-4e57-b0be-9ebcdf226777', 1, 3, NULL, '2022-07-28 14:04:40', '2022-07-28 16:26:55', NULL),
(2, '2022-10-10', '2022-09-26', 8, 8, 0, '720.00', 'fae4641f-d777-4b2a-b31f-9f80dbd3f641', 1, 11, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(3, '2022-09-04', '2016-08-20', 4, 11, 0, '720.00', 'f006a4bd-1cd8-4728-b34a-b738880fbdb7', 1, 3, 1, '2022-07-28 14:04:40', '2022-07-28 14:08:17', NULL),
(4, '2022-09-21', '2022-09-07', 7, 10, 0, '840.00', '9754ace0-de34-4a4c-b6e7-f33f6a1aa223', 1, 3, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(5, '2022-08-26', '2022-08-12', 2, 15, 0, '720.00', 'c0956215-1bd9-488b-996d-38cc1c099380', 1, 8, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(6, '2022-10-19', '2022-10-05', 5, 9, 1, '720.00', '1d112280-bfef-47e7-aa07-bfaa70d191f2', 1, 9, NULL, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(7, '2022-10-09', '2022-09-25', 6, 10, 0, '1120.00', '9c1ab429-5fdf-44c3-9b42-f31cf9c6211b', 1, 4, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(8, '2022-10-01', '2022-09-17', 4, 14, 0, '1120.00', '98960890-b577-4b8b-8065-52349d6dbf03', 1, 9, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(9, '2022-11-07', '2022-10-24', 2, 13, 0, '1120.00', 'b0fcd0e3-6fba-48b9-ba7d-15018848266a', 1, 9, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(10, '2022-08-21', '2022-08-07', 8, 8, 0, '720.00', 'f713b365-d6ce-4047-801e-38d435ee178a', 1, 11, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(11, '2022-09-25', '2022-09-12', 4, 9, 1, '1120.00', 'ad67e187-7e7a-4525-abbe-3845db029073', 1, 2, NULL, '2022-07-28 14:04:40', '2022-07-28 15:31:23', NULL),
(12, '2022-09-24', '2022-09-10', 8, 13, 0, '1120.00', 'c4e9443d-b40f-4cee-bb11-8caa61dfcbae', 1, 11, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(13, '2022-11-06', '2022-10-23', 4, 8, 0, '840.00', '15a0bd48-6f7d-404c-9efc-941b9797aeb8', 1, 9, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(14, '2022-10-01', '2022-09-17', 3, 10, 0, '840.00', '4410fc15-9694-466c-b7b2-da6bddde185b', 1, 12, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(15, '2022-05-01', '2022-08-16', 4, 11, 0, '720.00', 'f006a4bd-1cd8-4728-b34a-b738880fbdb7', 1, 3, 1, '2022-07-28 14:04:40', '2022-07-28 15:18:15', NULL),
(16, '2022-08-06', '2022-07-23', 5, 9, 1, '720.00', 'd611e36b-e026-4f68-bb2a-6ee55e444453', 1, 9, NULL, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(17, '2022-07-04', '2022-06-20', 5, 16, 0, '1120.00', '87c88d91-09dd-4218-a6a4-2a4f2c23182e', 1, 9, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(18, '2022-10-06', '2022-09-22', 4, 11, 0, '720.00', '6d98a36b-c1c4-43a7-8f16-dcf69f62567f', 1, 8, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(19, '2022-07-24', '2022-07-10', 5, 14, 0, '960.00', 'd11ad875-51f8-438c-b799-a5a3270ed8f6', 1, 9, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(20, '2022-08-21', '2022-08-07', 5, 12, 0, '720.00', 'fd9a2a16-7b37-41dc-8533-c40f45e184e8', 1, 5, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(21, '2022-08-16', '2022-08-02', 7, 10, 1, '840.00', '7548a972-0abc-47bd-9941-ea0a63321122', 1, 7, NULL, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(22, '2022-11-01', '2022-10-18', 4, 15, 0, '840.00', 'bf0171c8-6fe7-4fbb-95a0-8dcd4896c94d', 1, 10, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(23, '2022-11-01', '2022-10-18', 7, 12, 0, '720.00', 'f3094295-a5e5-4246-9b29-575789ca10a5', 1, 6, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(24, '2022-10-12', '2022-09-28', 3, 16, 0, '1120.00', '7e99ba16-0b67-4c36-92b6-20b249a871b9', 1, 10, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(25, '2022-09-28', '2022-09-14', 4, 8, 0, '960.00', 'f71721fe-6f12-4418-b0e7-44c0a08927ae', 1, 9, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(26, '2022-09-20', '2022-09-06', 4, 8, 1, '960.00', '31c38c39-1d99-450f-8cc7-5bc2a690fc13', 1, 7, NULL, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(27, NULL, '2022-08-28', 5, 15, 1, '900.00', 'c0d25d8c-b00b-4d6a-894b-0515dd8de4a4', 1, 1, 2, '2022-07-28 18:05:00', '2022-07-28 18:05:00', NULL),
(28, '2022-09-04', '2022-08-29', 5, 12, 0, '960.00', 'b1b8912b-b345-464e-b1bb-986f4f94e45a', 1, 1, 1, '2022-07-28 18:07:23', '2022-07-28 18:07:43', NULL);

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
(3, '2022-10-10', '14:00:00', '19:00:00', 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(4, '2022-09-04', '14:00:00', '19:00:00', 3, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(5, '2022-09-21', '14:00:00', '19:00:00', 4, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(6, '2022-08-26', '15:30:00', '21:15:00', 5, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(7, '2022-08-27', '15:30:00', '21:15:00', 5, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(8, '2022-10-19', '14:00:00', '19:00:00', 6, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(9, '2022-10-09', '14:00:00', '19:00:00', 7, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(10, '2022-10-01', '14:00:00', '19:00:00', 8, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(11, '2022-11-07', '15:30:00', '21:15:00', 9, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(12, '2022-11-08', '15:30:00', '21:15:00', 9, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(13, '2022-08-21', '14:00:00', '19:00:00', 10, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(15, '2022-09-24', '14:00:00', '19:00:00', 12, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(16, '2022-11-06', '15:30:00', '21:15:00', 13, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(17, '2022-11-07', '15:30:00', '21:15:00', 13, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(18, '2022-10-01', '14:00:00', '19:00:00', 14, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(20, '2022-08-06', '14:00:00', '19:00:00', 16, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(21, '2022-07-04', '15:30:00', '21:15:00', 17, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(22, '2022-07-05', '15:30:00', '21:15:00', 17, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(23, '2022-10-06', '14:00:00', '19:00:00', 18, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(24, '2022-07-24', '14:00:00', '19:00:00', 19, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(25, '2022-08-21', '14:00:00', '19:00:00', 20, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(26, '2022-08-16', '15:30:00', '21:15:00', 21, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(27, '2022-08-17', '15:30:00', '21:15:00', 21, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(28, '2022-11-01', '14:00:00', '19:00:00', 22, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(29, '2022-11-01', '14:00:00', '19:00:00', 23, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(30, '2022-10-12', '14:00:00', '19:00:00', 24, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(31, '2022-09-28', '15:30:00', '21:15:00', 25, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(32, '2022-09-29', '15:30:00', '21:15:00', 25, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(33, '2022-09-20', '14:00:00', '19:00:00', 26, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(94, '2022-06-20', '15:00:00', '20:00:00', 15, '2022-07-28 15:18:15', '2022-07-28 15:18:15'),
(95, '2022-07-01', '18:00:00', '22:00:00', 15, '2022-07-28 15:18:15', '2022-07-28 15:18:15'),
(96, '2022-05-01', '17:00:00', '21:30:00', 15, '2022-07-28 15:18:15', '2022-07-28 15:18:15'),
(112, '2022-11-05', '14:30:00', '15:30:00', 1, '2022-07-28 16:26:55', '2022-07-28 16:26:55'),
(113, '2022-11-06', '15:30:00', '21:50:00', 1, '2022-07-28 16:26:55', '2022-07-28 16:26:55'),
(114, '2022-11-04', '15:30:00', '21:45:00', 1, '2022-07-28 16:26:55', '2022-07-28 16:26:55'),
(115, '2022-09-25', '18:00:00', '22:15:00', 11, '2022-07-28 17:59:02', '2022-07-28 17:59:02'),
(116, '2022-09-26', '14:00:00', '19:00:00', 11, '2022-07-28 17:59:02', '2022-07-28 17:59:02'),
(117, '2022-09-04', '15:30:00', '19:30:00', 27, '2022-07-28 18:05:00', '2022-07-28 18:05:00'),
(118, '2022-09-05', '15:30:00', '20:30:00', 27, '2022-07-28 18:05:00', '2022-07-28 18:05:00'),
(122, '2022-09-04', '15:30:00', '22:30:00', 28, '2022-07-28 18:07:43', '2022-07-28 18:07:43'),
(123, '2022-09-05', '15:30:00', '22:00:00', 28, '2022-07-28 18:07:43', '2022-07-28 18:07:43');

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
(1, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(1, 14, NULL, NULL),
(2, 10, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 6, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(4, 12, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(5, 9, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(6, 8, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(7, 10, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(7, 11, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(8, 11, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(9, 11, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(10, 8, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(11, 10, NULL, NULL),
(11, 14, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(12, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(13, 7, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(13, 11, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(14, 8, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(15, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(16, 7, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(17, 6, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(18, 2, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(19, 7, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(19, 15, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(20, 15, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(21, 8, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(22, 14, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(23, 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(24, 11, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(25, 8, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(25, 15, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(26, 12, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(27, 1, NULL, NULL),
(27, 10, NULL, NULL),
(27, 13, NULL, NULL),
(28, 8, NULL, NULL);

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
(1, '{\"de\": \"männlich\", \"en\": \"male\"}', '2022-07-28 14:04:37', '2022-07-28 14:04:37'),
(2, '{\"de\": \"weiblich\", \"en\": \"female\"}', '2022-07-28 14:04:37', '2022-07-28 14:04:37'),
(3, '{\"de\": \"andere\", \"en\": \"other\"}', '2022-07-28 14:04:37', '2022-07-28 14:04:37');

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

--
-- Daten für Tabelle `images`
--

INSERT INTO `images` (`id`, `uuid`, `name`, `original_name`, `extension`, `size`, `type`, `caption`, `description`, `orientation`, `coords_w`, `coords_h`, `coords_x`, `coords_y`, `order`, `publish`, `locked`, `imageable_type`, `imageable_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'b04cc1c7-89d2-4bc8-8071-d38c3a8e3780', '62e2da5314f91_m.jpg', 'm.jpg', 'jpg', 1504076, 'visual', NULL, NULL, 'p', 1816.000000000000, 1816.000000000000, 0.000000000000, 49.000000000000, -1, 1, 0, 'App\\Models\\User', 1, NULL, '2022-07-28 16:49:55', '2022-07-28 16:50:11'),
(2, '5ebc53e4-5975-49f5-ac4d-73ef5d68c96d', '62e37dbe2f137_viak-experte-3.jpg', 'viak-experte-3.jpg', 'jpg', 71992, 'teaser', NULL, NULL, 'l', 648.000000000000, 648.000000000000, 326.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\User', 14, NULL, '2022-07-29 04:27:10', '2022-07-29 04:28:26'),
(3, '47442a21-1a6e-4a6f-b61d-000f336b0145', '62e37e106fd9c_viak-experte-3.jpg', 'viak-experte-3.jpg', 'jpg', 71992, 'visual', NULL, NULL, 'l', 1152.000000000000, 648.000000000000, 85.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\User', 14, NULL, '2022-07-29 04:28:32', '2022-07-29 04:28:42'),
(4, 'cae06e64-d665-46e8-bda3-4c15edb87d8f', '62e38c5f00ed2_Storytelling_Kurs_l_01.jpg', 'Storytelling_Kurs_l_01.jpg', 'jpg', 215889, 'visual', NULL, NULL, 'l', 1152.000000000000, 648.000000000000, 219.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 1, NULL, '2022-07-29 05:29:35', '2022-07-29 05:29:48'),
(5, 'cb1998ff-3f32-4e1b-995b-a8daf5902943', '62e38c73c9ccf_Storytelling_Kurs_l_01.jpg', 'Storytelling_Kurs_l_01.jpg', 'jpg', 215889, 'teaser', NULL, NULL, 'p', 648.000000000000, 648.000000000000, 493.000000000000, 0.000000000000, -1, 1, 0, 'App\\Models\\Course', 1, NULL, '2022-07-29 05:29:56', '2022-07-29 05:30:11');

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

--
-- Daten für Tabelle `jobs`
--

INSERT INTO `jobs` (`id`, `recipient`, `processed`, `error`, `mailable_type`, `mailable_id`, `mailable_class`, `created_at`, `updated_at`) VALUES
(1, 'm@marceli.to', 1, NULL, 'App\\Models\\Event', 1, 'App\\Mail\\EventBooked', '2022-07-28 16:30:17', '2022-07-28 16:31:03'),
(2, 'm@marceli.to', 1, NULL, 'App\\Models\\Event', 1, 'App\\Mail\\EventCancelled', '2022-07-28 16:32:46', '2022-07-28 16:33:03'),
(3, 'm@marceli.to', 1, NULL, 'App\\Models\\Event', 1, 'App\\Mail\\EventBooked', '2022-07-28 16:35:15', '2022-07-28 16:36:03'),
(4, 'm@marceli.to', 1, NULL, 'App\\Models\\Event', 1, 'App\\Mail\\EventCancelled', '2022-07-28 16:38:23', '2022-07-28 16:39:02'),
(5, 'viak-student@0704.ch', 1, NULL, 'App\\Models\\Event', 28, 'App\\Mail\\EventBooked', '2022-07-29 03:19:41', '2022-07-29 03:20:02'),
(6, 'viak-student@0704.ch', 1, NULL, 'App\\Models\\Event', 11, 'App\\Mail\\EventBooked', '2022-07-29 03:19:41', '2022-07-29 03:21:02');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `languages`
--

INSERT INTO `languages` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"deutsch\", \"en\": \"german\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(2, '{\"de\": \"englisch\", \"en\": \"english\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `levels`
--

INSERT INTO `levels` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"Einsteiger\", \"en\": \"beginner\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(2, '{\"de\": \"Vertiefung\", \"en\": \"in depth\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `locations`
--

INSERT INTO `locations` (`id`, `description`, `address`, `map`, `publish`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"Visualisierungs-Akademie, Zürich\", \"en\": \"Visualisierungs-Akademie, Zurich\"}', '{\"de\": \"Förlibuckstrasse 240\\n8006 Zürich\", \"en\": \"Förlibuckstrasse 240\\n8006 Zurich\"}', 'https://goo.gl/maps/JJhSmLv5aKpPz2Pw5', 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(2, '{\"de\": \"Visualisierungs-Akademie, Bern\", \"en\": \"Visualisierungs-Akademie, Bern\"}', '{\"de\": \"Bundesstrasse 4\\nBern\", \"en\": \"Bundesstrasse 4\\n3000 Bern\"}', 'https://goo.gl/maps/9JTRGV719VGY9BUA8', 1, '2022-07-28 14:04:40', '2022-07-28 14:04:40');

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
(1, '2012_07_05_072601_create_genders_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_06_28_064555_create_roles_table', 1),
(7, '2022_06_28_064747_create_role_user_table', 1),
(8, '2022_06_29_080633_create_jobs_table', 1),
(9, '2022_07_04_184656_create_courses_table', 1),
(10, '2022_07_04_184942_create_locations_table', 1),
(11, '2022_07_04_185258_create_software_table', 1),
(12, '2022_07_04_185530_course_software', 1),
(13, '2022_07_04_185853_create_categories_table', 1),
(14, '2022_07_04_185858_create_tags_table', 1),
(15, '2022_07_04_185907_category_course', 1),
(16, '2022_07_04_185910_course_tag', 1),
(17, '2022_07_05_091920_create_events_table', 1),
(18, '2022_07_05_115239_create_sessions_table', 1),
(19, '2022_07_05_122224_create_event_dates_table', 1),
(20, '2022_07_05_130117_event_user', 1),
(21, '2022_07_07_085738_create_languages_table', 1),
(22, '2022_07_07_085826_course_language', 1),
(23, '2022_07_07_085950_create_levels_table', 1),
(24, '2022_07_07_085956_course_level', 1),
(25, '2022_07_14_210349_alter_users_table_add_publish_and_visible', 1),
(26, '2022_07_17_210404_alter_users_table_add_fields', 1),
(27, '2022_07_21_073837_create_images_table', 1),
(28, '2022_07_25_132612_create_bookings_table', 1),
(29, '2022_07_27_145023_alter_images_table_add_type', 1);

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
(1, 'Admin', 'admin', '8170d46d-6ae2-47ee-80e2-8c3c2ff87ea0', '2022-07-28 14:04:37', '2022-07-28 14:04:37'),
(2, 'Experte', 'expert', '80f49293-f471-47e2-8643-8b9203bbda71', '2022-07-28 14:04:37', '2022-07-28 14:04:37'),
(3, 'Student', 'student', '5ea6e086-8528-4742-ad0d-98270ec5ca97', '2022-07-28 14:04:37', '2022-07-28 14:04:37');

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
(1, 1, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(2, 1, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(3, 1, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(1, 2, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(2, 2, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(3, 2, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(1, 3, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(1, 4, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(1, 5, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(2, 6, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(2, 7, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(2, 8, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(2, 9, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(2, 10, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(2, 11, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(2, 12, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(2, 13, '2022-07-28 14:04:38', '2022-07-28 14:04:38'),
(2, 14, '2022-07-28 14:04:39', '2022-07-28 14:04:39'),
(2, 15, '2022-07-28 14:04:39', '2022-07-28 14:04:39'),
(2, 16, '2022-07-28 14:04:39', '2022-07-28 14:04:39'),
(3, 17, '2022-07-28 14:04:39', '2022-07-28 14:04:39'),
(3, 18, '2022-07-28 14:04:39', '2022-07-28 14:04:39'),
(3, 19, '2022-07-28 14:04:39', '2022-07-28 14:04:39'),
(3, 20, '2022-07-28 14:04:39', '2022-07-28 14:04:39'),
(3, 21, '2022-07-28 14:04:39', '2022-07-28 14:04:39'),
(3, 22, '2022-07-28 14:04:39', '2022-07-28 14:04:39'),
(3, 23, '2022-07-28 14:04:39', '2022-07-28 14:04:39'),
(3, 24, '2022-07-28 14:04:39', '2022-07-28 14:04:39'),
(3, 25, '2022-07-28 14:04:39', '2022-07-28 14:04:39'),
(3, 26, '2022-07-28 14:04:39', '2022-07-28 14:04:39'),
(3, 27, '2022-07-28 14:04:39', '2022-07-28 14:04:39'),
(3, 28, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 29, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 30, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 31, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 32, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 33, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 34, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 35, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 36, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 37, '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, 38, '2022-07-28 14:04:40', '2022-07-28 14:04:40');

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

--
-- Daten für Tabelle `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2aGpNA8gZM3WE7jzmfqkocg7bmpMmr0ZmKxYcy3a', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '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', 1659082989),
('C78XzNTLOsO6lSMWj3ibWW9tc0HTbwGBsbFedkYn', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoibmV0MTRKeEs5dTBZdGJNWXJpUVBtOXE2bUFiMlNJOTF2T0dySFJyWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly92aWFrLmNoLmxvY2FsL2tvbnRha3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTY1OTA3NjAwMDt9czoxMzoic2VsZWN0ZWQtcm9sZSI7TzoxNToiQXBwXE1vZGVsc1xSb2xlIjozMDp7czoxMToiACoAZmlsbGFibGUiO2E6Mzp7aTowO3M6NDoidXVpZCI7aToxO3M6NDoibmFtZSI7aToyO3M6Mzoia2V5Ijt9czo4OiIAKgBjYXN0cyI7YToyOntzOjEwOiJjcmVhdGVkX2F0IjtzOjEwOiJkYXRlOmQubS5ZIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjEwOiJkYXRlOmQubS5ZIjt9czoxMzoiACoAY29ubmVjdGlvbiI7czo1OiJteXNxbCI7czo4OiIAKgB0YWJsZSI7czo1OiJyb2xlcyI7czoxMzoiACoAcHJpbWFyeUtleSI7czoyOiJpZCI7czoxMDoiACoAa2V5VHlwZSI7czozOiJpbnQiO3M6MTI6ImluY3JlbWVudGluZyI7YjoxO3M6NzoiACoAd2l0aCI7YTowOnt9czoxMjoiACoAd2l0aENvdW50IjthOjA6e31zOjE5OiJwcmV2ZW50c0xhenlMb2FkaW5nIjtiOjA7czoxMDoiACoAcGVyUGFnZSI7aToxNTtzOjY6ImV4aXN0cyI7YjoxO3M6MTg6Indhc1JlY2VudGx5Q3JlYXRlZCI7YjowO3M6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDtzOjEzOiIAKgBhdHRyaWJ1dGVzIjthOjY6e3M6MjoiaWQiO2k6MTtzOjQ6Im5hbWUiO3M6NToiQWRtaW4iO3M6Mzoia2V5IjtzOjU6ImFkbWluIjtzOjQ6InV1aWQiO3M6MzY6IjgxNzBkNDZkLTZhZTItNDdlZS04MGUyLThjM2MyZmY4N2VhMCI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyMi0wNy0yOCAxNjowNDozNyI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyMi0wNy0yOCAxNjowNDozNyI7fXM6MTE6IgAqAG9yaWdpbmFsIjthOjY6e3M6MjoiaWQiO2k6MTtzOjQ6Im5hbWUiO3M6NToiQWRtaW4iO3M6Mzoia2V5IjtzOjU6ImFkbWluIjtzOjQ6InV1aWQiO3M6MzY6IjgxNzBkNDZkLTZhZTItNDdlZS04MGUyLThjM2MyZmY4N2VhMCI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyMi0wNy0yOCAxNjowNDozNyI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyMi0wNy0yOCAxNjowNDozNyI7fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6MTc6IgAqAGNsYXNzQ2FzdENhY2hlIjthOjA6e31zOjIxOiIAKgBhdHRyaWJ1dGVDYXN0Q2FjaGUiO2E6MDp7fXM6ODoiACoAZGF0ZXMiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6OToiACoAaGlkZGVuIjthOjA6e31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO319czoxMzoiY291cnNlX2ZpbHRlciI7YToxOntzOjU6Iml0ZW1zIjthOjY6e3M6ODoiY2F0ZWdvcnkiO047czo4OiJzb2Z0d2FyZSI7TjtzOjg6Imxhbmd1YWdlIjtOO3M6NToibGV2ZWwiO047czo4OiJsb2NhdGlvbiI7TjtzOjY6ImV4cGVydCI7Tjt9fX0=', 1659082552);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `software`
--

CREATE TABLE `software` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `software`
--

INSERT INTO `software` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"Rhinoceros 7\", \"en\": \"Rhinoceros 7 (en)\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(2, '{\"de\": \"Blender 3\", \"en\": \"Blender 3 (en)\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, '{\"de\": \"SketchUp 2022\", \"en\": \"SketchUp 2022 (en)\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `tags`
--

INSERT INTO `tags` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"Modelling\", \"en\": \"Modelling (en)\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(2, '{\"de\": \"Rendering\", \"en\": \"Rendering (en)\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(3, '{\"de\": \"Visualisierung\", \"en\": \"Visualisierung (en)\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(4, '{\"de\": \"Animation\", \"en\": \"Animation (en)\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(5, '{\"de\": \"Konstruktion\", \"en\": \"Konstruktion (en)\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(6, '{\"de\": \"Motion Graphics\", \"en\": \"Motion Graphics (en)\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(7, '{\"de\": \"Architektur\", \"en\": \"Architektur (en)\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40'),
(8, '{\"de\": \"3D-Druck\", \"en\": \"3D-Druck (en)\"}', '2022-07-28 14:04:40', '2022-07-28 14:04:40');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_invoice_address` tinyint(4) NOT NULL DEFAULT '0',
  `invoice_address` text COLLATE utf8mb4_unicode_ci,
  `expert_title` text COLLATE utf8mb4_unicode_ci,
  `expert_description` text COLLATE utf8mb4_unicode_ci,
  `expert_bio` text COLLATE utf8mb4_unicode_ci,
  `operating_system` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `visible` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `firstname`, `name`, `street`, `street_no`, `zip`, `city`, `phone`, `has_invoice_address`, `invoice_address`, `expert_title`, `expert_description`, `expert_bio`, `operating_system`, `email`, `email_verified_at`, `password`, `uuid`, `gender_id`, `remember_token`, `publish`, `visible`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Marcel', 'Stadelmann', 'Schulstrasse', '12', '8000', 'Zürich', NULL, 0, NULL, NULL, NULL, NULL, NULL, 'm@marceli.to', '2022-07-28 14:04:37', '$2y$10$xabHen6GAvcxaFhOxTqqa.dRRJElnJrnLsaiyy2uAJJTBuqGT6q2q', '19d48dc0-f5cf-45c5-92c0-7976618697bd', 1, NULL, 1, 1, '2022-07-28 14:04:38', '2022-07-28 16:49:16', NULL),
(2, 'Oliver', 'Schmid', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'oliver.schmid@visualisierungs-akademie.ch', '2022-07-28 14:04:38', '$2y$10$Jbx19/5dNV1jRGOq7HatNOXkPcZPB95PTh3/TThUDWWLLvqE3aETy', '11f776f4-8de2-47c7-98a7-67a507057c95', 1, NULL, 1, 0, '2022-07-28 14:04:38', '2022-07-28 14:04:38', NULL),
(3, 'Lutz', 'Kögler', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'koegler@nightnurse.ch', '2022-07-28 14:04:38', '$2y$10$H2d3uEKsWN4MXYFdyqTyUeXdMIxJf5kGWAQ4qcSDO/GCrgp2.BcR.', '2533202f-f079-43fd-ab8c-6aeaef5965e6', 1, NULL, 1, 0, '2022-07-28 14:04:38', '2022-07-28 14:04:38', NULL),
(4, 'Benedikt', 'Flüeler', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'bf@wbg.ch', '2022-07-28 14:04:38', '$2y$10$EBQm7CzhgNmitpW8vyzJdOmXmyeVnNuPvI.93bgXy4cYyBakwhIum', 'eeeaafa2-f541-47c6-ba2f-280ab80b7641', 1, NULL, 1, 0, '2022-07-28 14:04:38', '2022-07-28 14:04:38', NULL),
(5, 'Bettina', 'Puorger', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'bp@wbg.ch', '2022-07-28 14:04:38', '$2y$10$8iYWX1G5ifsr6bILZhz62.FLfQ4AKUztPeLGfe8Gb9eeMJy0oeWPm', '634861d8-e828-4310-bb10-a665c5924209', 2, NULL, 1, 0, '2022-07-28 14:04:38', '2022-07-28 14:04:38', NULL),
(6, 'Peter', 'Muster', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'viak-experte@0704.ch', '2022-07-28 14:04:38', '$2y$10$1QYpOMI2o6wq33SbYXUSreupD5wBQT/4virLkz15W74zkWIIBQdhu', 'b0fa4625-0b56-40e1-96a1-ced4ff6ad0c0', 1, NULL, 1, 1, '2022-07-28 14:04:38', '2022-07-28 14:04:38', NULL),
(7, 'Kellen', 'Tillman', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'eleanore.fritsch@hotmail.com', '2022-07-28 14:04:38', '$2y$10$CwwYTcFCpBMZbMJmgwl1SeKwATlO6wQMYRtJk2xRds6Zo/IMaHH.O', '98cbfc0b-892b-4a3f-82c2-b9b6133542b9', 1, NULL, 1, 1, '2022-07-28 14:04:38', '2022-07-28 14:04:38', NULL),
(8, 'Lisa', 'Huel', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'bettie95@gmail.com', '2022-07-28 14:04:38', '$2y$10$RBmVzF8N5b2xNZS2shi.puiZanzdF4wu8MtoFuleI9tW9AWSx1J3W', '07567013-a66b-4857-ab5c-d09bcb4ede9c', 1, NULL, 1, 1, '2022-07-28 14:04:38', '2022-07-28 14:04:38', NULL),
(9, 'Mateo', 'Harris', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'maximo00@terry.org', '2022-07-28 14:04:38', '$2y$10$5riG92P/xICB4mdlLxviN.94jydmYZVZDq5LiblwYLPxAyM/XD1wK', 'b80f0824-d013-4734-a280-2b82a734d0fd', 1, NULL, 1, 1, '2022-07-28 14:04:38', '2022-07-28 14:04:38', NULL),
(10, 'Beth', 'Walter', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'tito53@gmail.com', '2022-07-28 14:04:38', '$2y$10$CCtzCmgZWgUUZUawhbTUA.sntx/XFsZ6eeRFyJoOm9NWiqxqA37NW', '4299b04f-2845-4a10-810a-266accdeacb2', 2, NULL, 1, 1, '2022-07-28 14:04:38', '2022-07-28 14:04:38', NULL),
(11, 'Oscar', 'Heller', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'lgaylord@yahoo.com', '2022-07-28 14:04:38', '$2y$10$AvqdbIDXFVRpzz5wXbdxkOL5HZGxorFzDC810DTFvMrWfMYQMeeBO', 'ddf72e14-d034-4e25-a8d1-3db2e233fc37', 2, NULL, 1, 1, '2022-07-28 14:04:38', '2022-07-28 14:04:38', NULL),
(12, 'Edythe', 'Gislason', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'edgar.rutherford@gmail.com', '2022-07-28 14:04:38', '$2y$10$CK2qzJPLFVu0LMdN2yVUYOhIo8enrcpyz0RD5kBVbMmrLVkBr8Cwe', 'a92d41cf-3d45-4b39-99fc-fb7d854f10ff', 2, NULL, 1, 1, '2022-07-28 14:04:38', '2022-07-28 14:04:38', NULL),
(13, 'Darren', 'Schoen', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'sid.west@johns.com', '2022-07-28 14:04:38', '$2y$10$XZfAbXQVn3lV3y3o8Axtnu9nWmxtooFp6ZrTiVW5igE8b8aHGv1nW', '982ba444-073d-49a7-8a9a-1aa099466507', 1, NULL, 1, 1, '2022-07-28 14:04:38', '2022-07-28 14:04:38', NULL),
(14, 'Celine', 'Blick', 'Teststrasse', NULL, '8000', 'Zürich', NULL, 0, NULL, 'Die VFX- und Animationsexpertin', '<div>\n<div>Helge Maus ist renomierter Trainer im Bereich 3D und d&uuml;rfte vielen ein Begriff sein.</div>\n<div>&nbsp;</div>\n<div>Er unterst&uuml;tzt seine Kund/-innen mit professionellen Produktions-Workflows und Techniken. Dabei stehen folgende Tools im Mittelpunkt: Houdini FX, Cinema 4D, Maya, Blender, NUKE, After Effects, V-Ray, RenderMan, Corona, Unreal Engine, Unity, Substance Painter, DaVinci Resolve &amp; Fusion.</div>\n<div>&nbsp;</div>\n<div>Er hat einige Jahre als Freelancer f&uuml;r Adobe Systems gearbeitet und ist Maxon Certified Lead Instructor. Seine Kunden kommen haupts&auml;chlich aus dem Bereich VFX, Postproduction, MotionGraphics, Broadcast, Automotive &amp; Architektur. Er hat u.a. mit folgenden Firmen gearbeitet: Jura, Vitra, Dyson, Jung-von-Matt, Pirates\'n Paradise, redseven Entertainment, ProSiebenSat.1, SKY Deutschland, NDR, rbb, Sony DADC, Intel viele weitere internationale Firmen.</div>\n</div>', NULL, NULL, 'paula.dibbert@gmail.com', '2022-07-28 14:04:38', '$2y$10$Gai7ZlfmSMlZKuzBDWAwEuaqrbF9dGgLeMDpL1XoO2t/NNvG7/Ck6', '92b6f663-afa2-4032-a88f-6e0f5ff75ca0', 1, NULL, 1, 1, '2022-07-28 14:04:39', '2022-07-29 05:26:50', NULL),
(15, 'Reyes', 'Hane', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'trenton.wintheiser@gaylord.com', '2022-07-28 14:04:39', '$2y$10$Z1ICGAnDyMLlKzZOx4C2KertE.FacNMjVTr4xXEuccAtKfmIhCu/u', 'c9886d9c-a2c0-4590-86ac-b5d084820c50', 1, NULL, 1, 1, '2022-07-28 14:04:39', '2022-07-28 14:04:39', NULL),
(16, 'Ettie', 'Monahan', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'nedra09@hodkiewicz.com', '2022-07-28 14:04:39', '$2y$10$4Is.l3mlXxHDL0WoEbUKAevjChpZiw6kOrs9dEBhjS0xLUGhcMdi.', '35f5a6c2-de36-4a02-80e1-ebaba93be51e', 1, NULL, 1, 1, '2022-07-28 14:04:39', '2022-07-28 14:04:39', NULL),
(17, 'Paul', 'Mosimann', 'Letzigraben', '149', '8047', 'Zürich', '078 749 74 09', 0, NULL, NULL, NULL, NULL, NULL, 'viak-student@0704.ch', '2022-07-28 14:04:39', '$2y$10$mhkw383CCydnnDhGRaBObulGWEfmvQsjhRQYx6kIGUxIKZPRSF3vm', '5352787e-e8c3-4fb1-ad7f-f67869b58e1d', 1, NULL, 1, 1, '2022-07-28 14:04:39', '2022-07-28 14:04:39', NULL),
(18, 'Gaetano', 'Breitenberg', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'klein.marcus@towne.com', '2022-07-28 14:04:39', '$2y$10$04iWqIRT0zdZEFM2EOwljuJOvy96ckIY80Nc1ir9DbGr039Vig2vC', '3b7d2dba-9ba8-4d1b-b1f9-104d37ba0884', 1, NULL, 1, 0, '2022-07-28 14:04:39', '2022-07-28 14:04:39', NULL),
(19, 'Cassie', 'Simonis', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'lhaley@hotmail.com', '2022-07-28 14:04:39', '$2y$10$C49JioFXqP7y/oYkv6O.WO1P8E3j82VaFd.sdsVHRM4w3DRkm3Yrq', 'da63c90f-2c23-4f6b-be18-b61b6eedddd6', 2, NULL, 1, 0, '2022-07-28 14:04:39', '2022-07-28 14:04:39', NULL),
(20, 'Ewell', 'Hessel', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'lucinda.harvey@schultz.com', '2022-07-28 14:04:39', '$2y$10$bEPhDOra8QjJILPjYmmkPua6tLtnmrS2QyXk/c2XIlQJrTP.iVKN6', '76acc33d-da10-4316-8349-4c1a4440fd50', 2, NULL, 1, 0, '2022-07-28 14:04:39', '2022-07-28 14:04:39', NULL),
(21, 'Michele', 'Nader', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'ebert.eusebio@barton.com', '2022-07-28 14:04:39', '$2y$10$.Ebt6SuNygB6XnZbdg8Fked.1deLC7U6xMfCnhXr.a9RQ7ZxDjEpW', 'ae636cc5-90f4-48e5-8c6e-7ddfd26e80ae', 2, NULL, 1, 0, '2022-07-28 14:04:39', '2022-07-28 14:04:39', NULL),
(22, 'Deontae', 'Crist', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'qreinger@botsford.org', '2022-07-28 14:04:39', '$2y$10$DHGWPBRMTm2fYaeoyCQfdeltEA/77YvhpO7htxIHETRlahIVwtp4.', '4e2dbf73-b027-408a-96c6-262c5e344a37', 1, NULL, 1, 0, '2022-07-28 14:04:39', '2022-07-28 14:04:39', NULL),
(23, 'Lavon', 'Will', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'vwillms@yahoo.com', '2022-07-28 14:04:39', '$2y$10$WgaUhTLbaZU9kgalSK118uihXkWWXdy3HHexG.iTcIu9oIkhaHgYy', 'c9a53834-1a48-4778-a8cf-1dc0b8976300', 1, NULL, 1, 0, '2022-07-28 14:04:39', '2022-07-28 14:04:39', NULL),
(24, 'Margret', 'Renner', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'arielle.hackett@muller.biz', '2022-07-28 14:04:39', '$2y$10$g19WgwXIUh3MmGXIe2EgGOATJaJuQdcvhd/OOMmIbpblQF758xkRG', 'b39543e7-f4f5-4482-b460-d310d7b7ef86', 2, NULL, 1, 0, '2022-07-28 14:04:39', '2022-07-28 14:04:39', NULL),
(25, 'Keegan', 'Green', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'watsica.scarlett@yahoo.com', '2022-07-28 14:04:39', '$2y$10$pEzgL6.O72mrbWmcb2h2Wubyrw8XQ2WtMiHoLJY47OY7glO/CkI/m', '01ce489c-a7d7-47f3-afff-d16387644ebd', 2, NULL, 1, 0, '2022-07-28 14:04:39', '2022-07-28 14:04:39', NULL),
(26, 'Walton', 'Cummerata', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'pstark@walsh.com', '2022-07-28 14:04:39', '$2y$10$z04zFnaYgDhgPfHhmmv.EeblgRlJzgEhUBCMNh2woIW3/TWP62UEe', 'cdcf1326-4f8a-4c8f-8783-e658102197e4', 2, NULL, 1, 0, '2022-07-28 14:04:39', '2022-07-28 14:04:39', NULL),
(27, 'Jena', 'Ortiz', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'camden.larkin@lakin.com', '2022-07-28 14:04:39', '$2y$10$uPbeRmTIXbe7SFzuhBIRuOcxxrXk.gxVVeNW1sL07q.68ufYuVrFO', 'd8394c82-6c12-45cf-94c7-a2636cb61a78', 1, NULL, 1, 0, '2022-07-28 14:04:39', '2022-07-28 14:04:39', NULL),
(28, 'Regan', 'Bednar', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'herminio.miller@yahoo.com', '2022-07-28 14:04:39', '$2y$10$Iu2frM8kAUnK7lskbIJ3vekpstSTKFTdeqRikG/fXOPth0XCfofsS', '71e7234e-e39d-474d-a3bd-9525ce806ed3', 2, NULL, 1, 0, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(29, 'Tatyana', 'Harber', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'hermiston.leslie@kreiger.org', '2022-07-28 14:04:40', '$2y$10$LkVzSTZATttzQoEFYUYpoegQYNlm3fQ/W4h3RNaF07F/b.7NfESA2', '53d786f3-517f-4461-b028-c038b2f2afa9', 1, NULL, 1, 0, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(30, 'Kay', 'Glover', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'reinger.jason@schuppe.info', '2022-07-28 14:04:40', '$2y$10$6E3I8VK0zKR5XCtn.aNT8uLoV.uKxJYC9H7PknNtXHtP.91xyqFNi', 'd044b38d-f176-4cd8-9894-dbc4d4daead8', 1, NULL, 1, 0, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(31, 'Kasey', 'Wuckert', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'bahringer.ian@auer.biz', '2022-07-28 14:04:40', '$2y$10$Q1WhBSL6NQ/UyPbcLeq0JuUPVVZkcS7ulJ2y/ae8CNIYiU.wnKPf6', '8b0c5eaf-895c-4fbf-81e9-ea17c67ba9e0', 1, NULL, 1, 0, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(32, 'Alia', 'Parisian', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'laverne.gleason@gmail.com', '2022-07-28 14:04:40', '$2y$10$J5I/aBfSErAV.Wg5/Gb/vewI00c2zvkdsUdAW.XORK48bjMOMBStq', '1a5b33c2-d1f4-4e0a-a2e1-89de0d586140', 1, NULL, 1, 0, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(33, 'Darren', 'Schmeler', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'qpowlowski@hotmail.com', '2022-07-28 14:04:40', '$2y$10$FaCrG8ZW.UoN3eYuTqctj.A9tjGNBiyriC.DoaiedvyY0/z6NodiK', '881d786d-b77b-4e3c-a053-99b881725691', 2, NULL, 1, 0, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(34, 'Mustafa', 'Raynor', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'emmy.bechtelar@hotmail.com', '2022-07-28 14:04:40', '$2y$10$brTtW8.rzKWJ2m.wdjCEieTRoCDE4K4nVFegRsYz439CBO4xIKXNS', '03f4d696-6cef-46fc-af30-37109acb874b', 2, NULL, 1, 0, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(35, 'Kallie', 'Koepp', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'padberg.dashawn@gmail.com', '2022-07-28 14:04:40', '$2y$10$OtQ3AmXdXJWWE3ai6gStoO.NteZx9ZyGVE8VZgdI0FMc3P23F902G', '3f8651a8-847f-487a-b56b-72e454b86fe6', 1, NULL, 1, 0, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(36, 'Jalyn', 'Christiansen', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'amayert@dibbert.com', '2022-07-28 14:04:40', '$2y$10$GG14pf8PjSJ0ICHQN1CLsO5Y55YN5a.Yd2HxKuH9hV9u/J0EDvU/S', '8c28b2b2-00f9-44d8-9843-b0012f731c1f', 1, NULL, 1, 0, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(37, 'Candida', 'Boyer', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'daphney.hills@yahoo.com', '2022-07-28 14:04:40', '$2y$10$TNBY2pcJOz15QNznUuHYpO6WZItYnzZI5tFaeq1lXe9gXNjLveS3C', 'c2dbb97a-42e4-4d42-9f63-7492dbc0772b', 1, NULL, 1, 0, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL),
(38, 'Deven', 'Dickinson', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'tremblay.caden@yahoo.com', '2022-07-28 14:04:40', '$2y$10$mMco/W7gXkWbPpRG2r4U3.85BVOQjldaFBz/Q8l4GM0nEBwTbWV46', 'b7702ad7-afdd-41bb-8bcb-19524e141c23', 2, NULL, 1, 0, '2022-07-28 14:04:40', '2022-07-28 14:04:40', NULL);

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
-- Indizes für die Tabelle `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_imageable_type_imageable_id_index` (`imageable_type`,`imageable_id`);

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
-- Indizes für die Tabelle `migrations`
--
ALTER TABLE `migrations`
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
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_gender_id_foreign` (`gender_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT für Tabelle `event_dates`
--
ALTER TABLE `event_dates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT für Tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `genders`
--
ALTER TABLE `genders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT für Tabelle `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
-- Constraints der Tabelle `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_gender_id_foreign` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

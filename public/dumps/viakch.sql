-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 27. Jul 2022 um 15:07
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
(1, '{\"de\": \"3D-Software\", \"en\": \"3D-Software (en)\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, '{\"de\": \"Bildgestaltung & Handwerk\", \"en\": \"Bildgestaltung & Handwerk (en)\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, '{\"de\": \"Management & Kommunikation\", \"en\": \"Management & Kommunikation (en)\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06');

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
(2, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, 3, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, 4, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(1, 5, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, 6, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(1, 7, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(1, 8, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(1, 9, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, 10, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, 11, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, 12, '2022-07-27 13:07:06', '2022-07-27 13:07:06');

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
(1, 1, '{\"de\": \"storytelling-workshop\", \"en\": \"storytelling-workshop\"}', '{\"de\": \"Storytelling – Workshop\", \"en\": \"Storytelling – Workshop\"}', '{\"de\": \"Repellat voluptatem dolorem nam qui id.\", \"en\": \"Nesciunt exercitationem qui accusamus repellendus non explicabo officiis.\"}', '{\"de\": \"Fugiat quaerat ut architecto voluptatibus sed sint est voluptatem. Distinctio perferendis sit vel error pariatur asperiores reprehenderit. Sint autem culpa esse sit. Voluptas esse nostrum et voluptatum aliquam. Aut ad distinctio neque dolorum voluptate alias dolores. Eum facilis nihil nihil nobis.\", \"en\": \"Dolorum et officia id ea tenetur sed sapiente molestias. Accusantium nulla aut voluptatem. Voluptatem quisquam reiciendis quisquam aut labore perferendis in. Corporis est cum omnis dicta ipsam alias dolor.\"}', '960.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '71e124c4-70d9-4eec-918f-41f9edc7f3eb', 0, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(2, 2, '{\"de\": \"blender-einfuehrungskurs\", \"en\": \"blender-einfuehrungskurs\"}', '{\"de\": \"Blender Einführungskurs\", \"en\": \"Blender Einführungskurs\"}', '{\"de\": \"Et ullam aperiam accusantium velit quibusdam saepe.\", \"en\": \"Cupiditate qui quia quia.\"}', '{\"de\": \"Voluptatibus quis sint nemo ut. Magnam magni officia ipsa in quas facere minima. Rem sint velit sed repellat dolorem. Praesentium ut accusantium velit dolore. Iusto at nisi blanditiis non modi expedita consequatur. Et aut voluptate numquam numquam omnis ad eos. Aut velit atque perferendis sit. Dicta adipisci quis a aut.\", \"en\": \"Voluptate et et ipsa voluptatibus laborum omnis. Sunt ducimus et possimus non. Omnis neque optio quia. Aut dolores blanditiis voluptatem quia impedit qui temporibus sit. Est aut consequatur recusandae eos illo.\"}', '840.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'a21bf19c-7e79-4dba-ba62-34b39f026ac9', 1, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(3, 3, '{\"de\": \"blender-renderingkurs\", \"en\": \"blender-renderingkurs\"}', '{\"de\": \"Blender Renderingkurs\", \"en\": \"Blender Renderingkurs\"}', '{\"de\": \"Et quibusdam vel enim commodi minus.\", \"en\": \"Id in architecto illo dolor mollitia aut facilis.\"}', '{\"de\": \"Culpa aut ratione id nam. Porro tempore autem nesciunt. Eum cumque et quisquam vitae molestiae. Earum cumque mollitia magnam dolores voluptas officiis maxime. Laboriosam nobis quas aliquam nisi. Provident eligendi aliquam inventore nihil sequi hic ipsum. Eius dignissimos ipsa enim eum rem.\", \"en\": \"Reiciendis adipisci dolorem soluta iusto. Molestiae omnis illum et. Laboriosam reprehenderit veniam incidunt sit non. Unde voluptas tenetur perferendis quia. Sequi qui a cum incidunt voluptatem aliquam. Sequi quibusdam consequatur voluptates quis. Laboriosam aut fuga qui voluptas nobis velit.\"}', '840.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '694e916a-33ac-4d65-be03-af45e47e1aaa', 1, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(4, 4, '{\"de\": \"blender-animationskurs\", \"en\": \"blender-animationskurs\"}', '{\"de\": \"Blender Animationskurs\", \"en\": \"Blender Animationskurs\"}', '{\"de\": \"Voluptatum et accusamus molestiae soluta excepturi.\", \"en\": \"Ipsa corporis ex cupiditate mollitia numquam minima.\"}', '{\"de\": \"Id quae quidem voluptatem et. Unde amet perferendis aut qui voluptas ullam enim tempore. Ut nisi quo ab libero fugit iste qui numquam. A qui cumque modi asperiores. Quis consequuntur velit eum. Consequatur doloremque aut eum natus.\", \"en\": \"Enim sit enim inventore architecto ut nemo asperiores. Recusandae sed modi non voluptatem quas. Autem est velit dolorum quae maiores. Cupiditate non ullam et sunt. Atque maxime eius quisquam commodi ut modi totam. Aspernatur similique ea dolorem recusandae. Ea doloribus harum et doloribus.\"}', '1120.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '51424e47-3ff7-4824-8fe4-779b997873b5', 1, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(5, 5, '{\"de\": \"visual-facilitator-basics\", \"en\": \"visual-facilitator-basics\"}', '{\"de\": \"Visual Facilitator Basics\", \"en\": \"Visual Facilitator Basics\"}', '{\"de\": \"Quibusdam amet a minima.\", \"en\": \"Officia non voluptatibus quis omnis.\"}', '{\"de\": \"Et ut aspernatur et cupiditate laboriosam. Libero officiis officia dignissimos laborum. Necessitatibus ut praesentium non quas distinctio voluptatem. Qui est temporibus laborum voluptatem. Beatae dolores in et. Perferendis accusamus dolore et facere pariatur impedit qui.\", \"en\": \"Alias et aut exercitationem quo totam quia ut. Vero et ut sed repellendus provident voluptas animi. Amet quod modi expedita laudantium maxime aut quo. Itaque consequatur necessitatibus aperiam quia. Explicabo ea qui aut omnis. Commodi illo voluptatibus id quia et. Possimus voluptatem unde qui exercitationem enim aliquam. Et necessitatibus ipsam corporis unde necessitatibus.\"}', '1120.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'd555e7fb-48a2-44e4-9637-ac3d4303a6e0', 1, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(6, 6, '{\"de\": \"visual-facilitator-advanced\", \"en\": \"visual-facilitator-advanced\"}', '{\"de\": \"Visual Facilitator Advanced\", \"en\": \"Visual Facilitator Advanced\"}', '{\"de\": \"Eum quasi dolorum provident consectetur.\", \"en\": \"Corrupti non vel beatae et.\"}', '{\"de\": \"Reiciendis incidunt aspernatur minima consequatur minus. Illo sequi est enim culpa quia nostrum aut. Ducimus reiciendis aut perferendis hic. Qui dolor placeat velit voluptatem cum amet. Suscipit dolore dolore consectetur alias aut et dolor consectetur. Dolor dolorem voluptatem nemo. Reiciendis laborum rem architecto aut facilis.\", \"en\": \"Quo nihil et et blanditiis. Assumenda sit voluptatibus saepe quisquam quia est id. Et similique praesentium quas autem cumque ex iusto. Explicabo et natus sed et exercitationem in tempora. Est eos tempora aperiam eligendi quam iusto quibusdam. Rerum commodi quis iste amet. Reiciendis et beatae doloribus sit. Placeat doloremque officiis ut ut.\"}', '960.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'f0fdd650-b4f1-4cbd-a2d4-8a46c8864524', 1, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(7, 7, '{\"de\": \"rhino-einstiegskurs\", \"en\": \"rhino-einstiegskurs\"}', '{\"de\": \"Rhino Einstiegskurs\", \"en\": \"Rhino Einstiegskurs\"}', '{\"de\": \"Rem distinctio qui quaerat animi perspiciatis.\", \"en\": \"Amet aut et id amet saepe dolor.\"}', '{\"de\": \"Atque totam laborum aut nisi pariatur. Odio tempora modi atque odit adipisci nesciunt. Magnam fugit cupiditate voluptas nulla. Blanditiis ipsum sequi sed at quas sequi eius. Accusamus omnis et velit modi occaecati. Dolor itaque hic numquam ex molestias omnis deleniti. Non doloribus rerum fugit ipsum ut ipsam atque libero. Et cupiditate itaque odit sunt modi est vel qui.\", \"en\": \"Nemo magnam id aliquam. Omnis rerum sed dignissimos sapiente est. Eos fuga aut aliquam ullam itaque sint. Nihil quo aliquam placeat est ducimus. Consectetur totam unde aut rerum eaque voluptatem. Eos ea eaque eum laboriosam odio eum. Sit fuga et quo voluptas voluptas adipisci laboriosam beatae.\"}', '720.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '6ddbea5b-5128-4dba-8923-45d4a17be9fb', 0, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(8, 8, '{\"de\": \"zbrush-einfuehrungskurs\", \"en\": \"zbrush-einfuehrungskurs\"}', '{\"de\": \"ZBrush Einführungskurs\", \"en\": \"ZBrush Einführungskurs\"}', '{\"de\": \"Et magni reprehenderit ea nihil quisquam.\", \"en\": \"Ut esse odit corrupti cumque ullam ab et.\"}', '{\"de\": \"Aut nisi porro est nesciunt sint. Vel autem recusandae tempora. Ea officia non at nihil consequuntur numquam reprehenderit. Et eum ut sequi dolore. Magni qui provident quibusdam necessitatibus. Quae minus nisi occaecati mollitia et aut quas.\", \"en\": \"Aliquid velit corporis impedit eaque doloremque in porro. Quo molestiae quas cumque quidem. Molestiae quae saepe illum voluptatem corrupti in. Cupiditate omnis quae non. Est numquam sed accusantium doloremque. Excepturi rerum commodi repellat vel doloribus.\"}', '720.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '56db99f4-ba04-491a-b93d-11b69ad2f01e', 0, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(9, 9, '{\"de\": \"social-media-marketing\", \"en\": \"social-media-marketing\"}', '{\"de\": \"Social Media Marketing\", \"en\": \"Social Media Marketing\"}', '{\"de\": \"Eum voluptatem omnis autem soluta.\", \"en\": \"Animi eum aut non tempora itaque alias corporis quia.\"}', '{\"de\": \"Sed et dolor laborum. Nostrum illum minus dicta ad inventore accusantium. Saepe dolorem repellendus voluptatem error ut. Est vel earum officiis ad voluptatem. Aliquam enim quo aut corrupti ipsam explicabo repudiandae labore. Error ut tempora non. Rerum temporibus quia mollitia architecto dolorem quisquam ut. A aut quaerat sint fuga.\", \"en\": \"Est dolorem laborum distinctio suscipit iure quod quod voluptatem. Ut occaecati rerum quia. Aut pariatur nam nihil possimus dicta ut. Maxime dolorum et rem rerum. Ipsam est et quia nemo corrupti dolorem et. Consequuntur labore iste vitae nihil non. Quis aut sed ab et sed maiores dolores quisquam. Quas quaerat qui dolore suscipit qui adipisci.\"}', '960.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '2b4c7339-a5de-4140-8ae9-6a53e2e238f2', 1, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(10, 10, '{\"de\": \"after-effects-ae-einstiegskurs\", \"en\": \"after-effects-ae-einstiegskurs\"}', '{\"de\": \"After Effects (AE) Einstiegskurs\", \"en\": \"After Effects (AE) Einstiegskurs\"}', '{\"de\": \"Expedita tempore eius vel aliquid quam adipisci rerum.\", \"en\": \"In reprehenderit totam qui pariatur aliquid ipsum.\"}', '{\"de\": \"Minima non placeat pariatur quo. Consequuntur in et aut atque animi iusto deserunt. Non est voluptatum voluptas tempore asperiores. Aut ut accusamus sit quo aperiam illo. Qui dolore consequatur sint ab odit ducimus amet. Minima et eos sit non consequatur exercitationem asperiores. Ad voluptatem voluptatibus odit dolores dignissimos ratione eos.\", \"en\": \"Facere rerum est dicta vero. Necessitatibus iure excepturi et quos dolorem ut. Repudiandae exercitationem rerum quo. Doloremque non est corporis id sed ut. Veritatis aut et tenetur dolorem natus id. Perferendis id nam ipsa excepturi dolores aut. Delectus molestiae et consequatur iste et. Fuga praesentium magnam molestias ut qui quia iste sit.\"}', '960.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '7479fdcd-9bd4-4ddd-9296-97641326808e', 0, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(11, 11, '{\"de\": \"rhino-grasshopper-kurs-fuer-einsteiger\", \"en\": \"rhino-grasshopper-kurs-fuer-einsteiger\"}', '{\"de\": \"Rhino Grasshopper Kurs für Einsteiger\", \"en\": \"Rhino Grasshopper Kurs für Einsteiger\"}', '{\"de\": \"Labore fugiat cupiditate quo qui tempore illo.\", \"en\": \"Quam perferendis nihil ut et autem nostrum reiciendis.\"}', '{\"de\": \"Dolor voluptatem incidunt cum cumque. Occaecati porro distinctio quia. Neque labore ut dolor est animi neque voluptate. Nisi repellat eligendi ea aut odio voluptatem. Repudiandae rerum ut possimus officia ut et sit. Expedita consectetur quas cupiditate et sed cumque quidem.\", \"en\": \"Voluptatibus a ut distinctio officia. Sit vel ut ut omnis qui. Neque error aut ad voluptatibus totam. Ab mollitia consequuntur illum rerum qui. Sint deleniti recusandae incidunt est aut. Et blanditiis ut aut eos minima consectetur. Deserunt velit dolorem provident inventore expedita sit. Sit qui quae reprehenderit.\"}', '1120.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '064e0237-c0d9-4c10-b565-a8335ca736b6', 0, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(12, 12, '{\"de\": \"geheimnisse-der-architekturvisualisierung\", \"en\": \"geheimnisse-der-architekturvisualisierung\"}', '{\"de\": \"Geheimnisse der Architekturvisualisierung\", \"en\": \"Geheimnisse der Architekturvisualisierung\"}', '{\"de\": \"Non pariatur ut qui voluptas quia.\", \"en\": \"Aut omnis possimus ipsa eum ut.\"}', '{\"de\": \"Harum molestiae aut pariatur ratione. Qui quasi illo quia quo. Est qui explicabo dicta sunt iste maiores quo. Facere unde aspernatur laudantium eaque qui expedita. Et possimus consectetur blanditiis impedit consequatur voluptatem voluptate iste. Ea repudiandae aspernatur ipsam et quae aliquam corrupti. Tenetur ullam natus incidunt ipsam.\", \"en\": \"Molestias qui et magnam quis. Est ut quidem in ipsam unde odio fugit. Non at facere saepe. Voluptatum placeat sit unde quia ea nisi est delectus. Eius molestiae aperiam nihil dolorem voluptatem quaerat. Id dolor quia est accusamus rerum soluta.\"}', '720.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '4b625753-a9d8-4f61-b697-e06a04d46e78', 0, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL);

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
(1, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(4, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(5, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(6, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(7, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(8, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(9, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(10, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(11, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(12, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06');

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
(1, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(4, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(5, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(6, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(7, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(8, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(9, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(10, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(11, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(12, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06');

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
(1, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, 3, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(4, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(5, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(6, 3, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(7, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(8, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(9, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(10, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(11, 3, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(12, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06');

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
(1, '2022-08-21', '2022-08-07', 7, 10, 1, '840.00', '9a0b9b1c-ec6f-4b31-b200-b6f2b8aa1a51', 1, 5, NULL, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(2, '2022-09-02', '2022-08-19', 8, 13, 0, '720.00', '1777c014-cb5a-4647-94f5-85ceb42f4867', 1, 4, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(3, '2022-07-28', '2022-07-14', 4, 13, 0, '720.00', '1e5834e7-89fb-4f05-9a33-b8491b5c15cd', 1, 1, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(4, '2022-09-25', '2022-09-11', 3, 10, 0, '840.00', 'a37ec3a8-23ba-4abb-8dfb-0bd4d19e2499', 1, 8, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(5, '2022-10-19', '2022-10-05', 6, 13, 0, '720.00', '5d62168c-8fc1-4658-ba35-3afca7840cf4', 1, 9, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(6, '2022-10-26', '2022-10-12', 8, 13, 1, '960.00', 'b81c5180-7f2e-4123-83ef-c10628a732f9', 1, 12, NULL, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(7, '2022-09-30', '2022-09-16', 7, 11, 0, '960.00', 'f2212dd5-6d4c-452e-a373-5ee18f86e7ff', 1, 6, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(8, '2022-07-21', '2022-07-07', 5, 14, 0, '840.00', '364830ca-13d7-4daa-9b32-bcd7abcb6dd5', 1, 3, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(9, '2022-07-13', '2022-06-29', 2, 9, 0, '720.00', '47a9f1b9-6616-4d4f-a5cc-5995828b88be', 1, 4, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(10, '2022-10-01', '2022-09-17', 7, 10, 0, '840.00', 'aa7a64da-284c-45c2-b839-cde2db48db71', 1, 11, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(11, '2022-10-29', '2022-10-15', 2, 9, 1, '1120.00', 'dc003e82-bbb6-44c8-9b17-c7373206f808', 1, 9, NULL, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(12, '2022-07-03', '2022-06-19', 2, 11, 0, '720.00', 'b23c0289-2688-4809-8d1e-6198749f41ba', 1, 11, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(13, '2022-09-01', '2022-08-18', 4, 13, 0, '720.00', 'd7580dd1-ede6-4f5a-b9c7-3450b19798aa', 1, 4, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(14, '2022-07-28', '2022-07-14', 7, 13, 0, '840.00', '04807f43-3401-4822-add7-cd65721bdc46', 1, 12, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(15, '2022-10-02', '2022-09-18', 4, 8, 0, '720.00', 'acf91507-4df9-49c5-a328-e283ee101b00', 1, 10, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(16, '2022-09-10', '2022-08-27', 8, 15, 1, '840.00', '52eb8cf1-d553-4bb3-a7bb-07aaff56272f', 1, 5, NULL, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(17, '2022-09-13', '2022-08-30', 6, 9, 0, '720.00', '060b82d0-a507-4c1a-9fbf-d04acbf604a6', 1, 4, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(18, '2022-11-05', '2022-10-22', 4, 12, 0, '840.00', '0f86bc8e-ac8f-43b0-bc5d-4f0da9d1721a', 1, 6, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(19, '2022-08-31', '2022-08-17', 5, 12, 0, '960.00', '524adb8b-c8b9-44d2-8263-e4dfbeb4b9df', 1, 12, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(20, '2022-07-03', '2022-06-19', 4, 12, 0, '840.00', '39af3b8a-7d72-4df0-b241-61e874e38e25', 1, 8, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(21, '2022-07-10', '2022-06-26', 4, 11, 1, '960.00', '1e748ddb-9832-45d3-92ef-6f761089f745', 1, 5, NULL, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(22, '2022-07-08', '2022-06-24', 2, 8, 0, '1120.00', 'b48fa269-1d5a-4c3e-9de0-be80a8fcc268', 1, 10, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(23, '2022-10-03', '2022-09-19', 2, 12, 0, '720.00', '4f2ec24d-cac4-429d-8d1f-4a497880a468', 1, 6, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(24, '2022-08-14', '2022-07-31', 7, 16, 0, '720.00', 'aa8f2c0e-5aab-4fb9-a24c-fe633041798e', 1, 10, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(25, '2022-08-26', '2022-08-12', 8, 8, 0, '960.00', 'b5a17dee-37a5-4c4e-ad19-3f0812eadb77', 1, 5, 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(26, '2022-08-25', '2022-08-11', 3, 16, 1, '720.00', '88446b4d-4b0a-449c-8592-9e66c23ed824', 1, 9, NULL, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL);

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
(1, '2022-08-21', '15:30:00', '21:15:00', 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, '2022-08-22', '15:30:00', '21:15:00', 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, '2022-09-02', '14:00:00', '19:00:00', 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(4, '2022-07-28', '14:00:00', '19:00:00', 3, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(5, '2022-09-25', '14:00:00', '19:00:00', 4, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(6, '2022-10-19', '15:30:00', '21:15:00', 5, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(7, '2022-10-20', '15:30:00', '21:15:00', 5, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(8, '2022-10-26', '14:00:00', '19:00:00', 6, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(9, '2022-09-30', '14:00:00', '19:00:00', 7, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(10, '2022-07-21', '14:00:00', '19:00:00', 8, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(11, '2022-07-13', '15:30:00', '21:15:00', 9, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(12, '2022-07-14', '15:30:00', '21:15:00', 9, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(13, '2022-10-01', '14:00:00', '19:00:00', 10, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(14, '2022-10-29', '14:00:00', '19:00:00', 11, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(15, '2022-07-03', '14:00:00', '19:00:00', 12, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(16, '2022-09-01', '15:30:00', '21:15:00', 13, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(17, '2022-09-02', '15:30:00', '21:15:00', 13, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(18, '2022-07-28', '14:00:00', '19:00:00', 14, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(19, '2022-10-02', '14:00:00', '19:00:00', 15, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(20, '2022-09-10', '14:00:00', '19:00:00', 16, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(21, '2022-09-13', '15:30:00', '21:15:00', 17, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(22, '2022-09-14', '15:30:00', '21:15:00', 17, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(23, '2022-11-05', '14:00:00', '19:00:00', 18, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(24, '2022-08-31', '14:00:00', '19:00:00', 19, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(25, '2022-07-03', '14:00:00', '19:00:00', 20, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(26, '2022-07-10', '15:30:00', '21:15:00', 21, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(27, '2022-07-11', '15:30:00', '21:15:00', 21, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(28, '2022-07-08', '14:00:00', '19:00:00', 22, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(29, '2022-10-03', '14:00:00', '19:00:00', 23, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(30, '2022-08-14', '14:00:00', '19:00:00', 24, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(31, '2022-08-26', '15:30:00', '21:15:00', 25, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(32, '2022-08-27', '15:30:00', '21:15:00', 25, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(33, '2022-08-25', '14:00:00', '19:00:00', 26, '2022-07-27 13:07:06', '2022-07-27 13:07:06');

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
(1, 2, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(1, 8, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, 7, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, 5, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(4, 7, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(5, 10, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(6, 11, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(7, 8, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(7, 10, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(8, 15, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(9, 7, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(10, 9, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(11, 5, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(12, 7, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(13, 7, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(13, 14, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(14, 12, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(15, 8, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(16, 7, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(17, 14, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(18, 13, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(19, 9, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(19, 10, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(20, 11, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(21, 15, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(22, 9, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(23, 11, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(24, 13, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(25, 9, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(25, 14, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(26, 13, '2022-07-27 13:07:06', '2022-07-27 13:07:06');

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
(1, '{\"de\": \"männlich\", \"en\": \"male\"}', '2022-07-27 13:07:03', '2022-07-27 13:07:03'),
(2, '{\"de\": \"weiblich\", \"en\": \"female\"}', '2022-07-27 13:07:03', '2022-07-27 13:07:03'),
(3, '{\"de\": \"andere\", \"en\": \"other\"}', '2022-07-27 13:07:03', '2022-07-27 13:07:03');

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
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `languages`
--

INSERT INTO `languages` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"deutsch\", \"en\": \"german\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, '{\"de\": \"englisch\", \"en\": \"english\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06');

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
(1, '{\"de\": \"Einsteiger\", \"en\": \"beginner\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, '{\"de\": \"Vertiefung\", \"en\": \"in depth\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06');

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
(1, '{\"de\": \"Visualisierungs-Akademie, Zürich\", \"en\": \"Visualisierungs-Akademie, Zurich\"}', '{\"de\": \"Förlibuckstrasse 240\\n8006 Zürich\", \"en\": \"Förlibuckstrasse 240\\n8006 Zurich\"}', 'https://goo.gl/maps/JJhSmLv5aKpPz2Pw5', 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, '{\"de\": \"Visualisierungs-Akademie, Bern\", \"en\": \"Visualisierungs-Akademie, Bern\"}', '{\"de\": \"Bundesstrasse 4\\nBern\", \"en\": \"Bundesstrasse 4\\n3000 Bern\"}', 'https://goo.gl/maps/9JTRGV719VGY9BUA8', 1, '2022-07-27 13:07:06', '2022-07-27 13:07:06');

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
(1, 'Admin', 'admin', '489de00c-ea81-4222-a05c-0e71de2f0926', '2022-07-27 13:07:03', '2022-07-27 13:07:03'),
(2, 'Experte', 'expert', 'a5623142-5ef2-4c96-9b6a-c07b56bcfb40', '2022-07-27 13:07:03', '2022-07-27 13:07:03'),
(3, 'Student', 'student', '82e26b5f-4e30-441c-8950-b064519fd04b', '2022-07-27 13:07:03', '2022-07-27 13:07:03');

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
(1, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(2, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(3, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(1, 2, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(2, 2, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(3, 2, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(1, 3, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(1, 4, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(2, 5, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(2, 6, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(2, 7, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(2, 8, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(2, 9, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(2, 10, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(2, 11, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(2, 12, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(2, 13, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(2, 14, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(2, 15, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(3, 16, '2022-07-27 13:07:04', '2022-07-27 13:07:04'),
(3, 17, '2022-07-27 13:07:05', '2022-07-27 13:07:05'),
(3, 18, '2022-07-27 13:07:05', '2022-07-27 13:07:05'),
(3, 19, '2022-07-27 13:07:05', '2022-07-27 13:07:05'),
(3, 20, '2022-07-27 13:07:05', '2022-07-27 13:07:05'),
(3, 21, '2022-07-27 13:07:05', '2022-07-27 13:07:05'),
(3, 22, '2022-07-27 13:07:05', '2022-07-27 13:07:05'),
(3, 23, '2022-07-27 13:07:05', '2022-07-27 13:07:05'),
(3, 24, '2022-07-27 13:07:05', '2022-07-27 13:07:05'),
(3, 25, '2022-07-27 13:07:05', '2022-07-27 13:07:05'),
(3, 26, '2022-07-27 13:07:05', '2022-07-27 13:07:05'),
(3, 27, '2022-07-27 13:07:05', '2022-07-27 13:07:05'),
(3, 28, '2022-07-27 13:07:05', '2022-07-27 13:07:05'),
(3, 29, '2022-07-27 13:07:05', '2022-07-27 13:07:05'),
(3, 30, '2022-07-27 13:07:05', '2022-07-27 13:07:05'),
(3, 31, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, 32, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, 33, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, 34, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, 35, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, 36, '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, 37, '2022-07-27 13:07:06', '2022-07-27 13:07:06');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `software`
--

INSERT INTO `software` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '{\"de\": \"Rhinoceros 7\", \"en\": \"Rhinoceros 7 (en)\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, '{\"de\": \"Blender 3\", \"en\": \"Blender 3 (en)\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, '{\"de\": \"SketchUp 2022\", \"en\": \"SketchUp 2022 (en)\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06');

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
(1, '{\"de\": \"Modelling\", \"en\": \"Modelling (en)\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(2, '{\"de\": \"Rendering\", \"en\": \"Rendering (en)\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(3, '{\"de\": \"Visualisierung\", \"en\": \"Visualisierung (en)\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(4, '{\"de\": \"Animation\", \"en\": \"Animation (en)\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(5, '{\"de\": \"Konstruktion\", \"en\": \"Konstruktion (en)\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(6, '{\"de\": \"Motion Graphics\", \"en\": \"Motion Graphics (en)\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(7, '{\"de\": \"Architektur\", \"en\": \"Architektur (en)\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06'),
(8, '{\"de\": \"3D-Druck\", \"en\": \"3D-Druck (en)\"}', '2022-07-27 13:07:06', '2022-07-27 13:07:06');

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
(1, 'Marcel', 'Stadelmann', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'm@marceli.to', '2022-07-27 13:07:03', '$2y$10$BJRNHZiajn1eeF53KbNyhe7i9ks0VTf5fV4oEEEBSI2WUGQiGyyjO', 'a4617ef8-2e30-418c-b1e5-18702f64ce17', 1, NULL, 1, 0, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(2, 'Oliver', 'Schmid', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'oliver.schmid@visualisierungs-akademie.ch', '2022-07-27 13:07:03', '$2y$10$syblAsNzasmURwJRK5.pPOwJodoG8aqr/9dMsn57xEf5gIZClygzW', 'b9854bb0-1582-47fa-859d-1c82980a22ff', 1, NULL, 1, 0, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(3, 'Lutz', 'Kögler', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'koegler@nightnurse.ch', '2022-07-27 13:07:03', '$2y$10$cQJL2YdVDl.USr3m3oW98eM5do7KrP/Tcl2zHuqthYtmeQ9w7LGYq', '4849e518-2945-46a5-a347-04ef38c01951', 1, NULL, 1, 0, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(4, 'Benedikt', 'Flüeler', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'bf@wbg.ch', '2022-07-27 13:07:04', '$2y$10$BJQTp69PNeqlM8QgwAwIpO2f/k1zaSt6iz7XTjawT9pQ.MCDboPwO', 'e1ae77cc-870c-4f84-8364-0abf777ef496', 1, NULL, 1, 0, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(5, 'Peter', 'Muster', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'viak-experte@0704.ch', '2022-07-27 13:07:04', '$2y$10$7YojbnMg/TtoJRwR5NhvYOw0K2dz8fwit6meGUkLsQI/BfVnvdGLi', 'f9ab17b8-5d8a-4452-abbb-73cff44d2b7b', 1, NULL, 1, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(6, 'Travis', 'Wuckert', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'xkessler@gmail.com', '2022-07-27 13:07:04', '$2y$10$sxCf5ghhmlWeK652/0YAf.15m6PVLEztG0vU4ckqE0jh7FrTJU2PW', 'f3dd6adc-0e86-48bc-8ae7-e13e71b7a020', 1, NULL, 1, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(7, 'Amalia', 'Lowe', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'aliza.schultz@christiansen.com', '2022-07-27 13:07:04', '$2y$10$L8sFIjlHgQ5H5FVhxbfkTeZrWiurzjhgRS/LwIKmAQ4mnmdm/WMby', '4789d1f6-cf69-493c-bbb6-1aae23fe763f', 1, NULL, 1, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(8, 'Pascale', 'Ernser', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'mjones@muller.net', '2022-07-27 13:07:04', '$2y$10$h0PyfPcf8tnUrY8Z8VcceOwhh6A61tXUakG3.o/kIPArh1x1ymbzG', '7a4ab1c5-0366-4c39-886c-af2cc5cb54a3', 2, NULL, 1, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(9, 'Marisa', 'Heidenreich', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'gherman@skiles.com', '2022-07-27 13:07:04', '$2y$10$Ih17jKwJYXcoGzzlsJYZrO.YG78/BvldXc0zvMw9Bh5Ll5ZQaDEzG', '5b5f4007-24f2-4efa-9a90-58e3d8132493', 1, NULL, 1, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(10, 'Berniece', 'Shanahan', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'gaylord.dovie@gmail.com', '2022-07-27 13:07:04', '$2y$10$92U0vA8wTnWSqa0VSbDFk.JMs1TMGQ9l7B2kphUq8EdsPgUOBiWJS', '7efb05b5-deb3-43fb-b1b8-0f2f0e7fc668', 1, NULL, 1, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(11, 'Filiberto', 'Bogan', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'kerluke.janice@yahoo.com', '2022-07-27 13:07:04', '$2y$10$FLDHscIkNHkKUYj.K4PzT.1j1ISytcyHV6zh5tsqT3Fbrcj60ND5i', '9c1eda0e-c690-4f23-b1c0-398965f59ded', 1, NULL, 1, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(12, 'Stephany', 'Brown', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'kurtis92@bartoletti.com', '2022-07-27 13:07:04', '$2y$10$c.cNMKHekTJnggnws6jgw..KBtNZ8bwncI7wpY8I9x1T2UXQBac5e', '6394f224-a4e8-4354-80aa-f12336853b67', 2, NULL, 1, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(13, 'Lacy', 'Parker', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'lwillms@gmail.com', '2022-07-27 13:07:04', '$2y$10$DMc0BDt2teM6W1csMMjiY.eiHT6DIP1oelykygor.SFsTsoyk5tPC', '1f5d56b8-204d-4191-b636-311ea0900e03', 1, NULL, 1, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(14, 'Dolores', 'Halvorson', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'claude.zboncak@gmail.com', '2022-07-27 13:07:04', '$2y$10$xeaGULiHa34Dd1R6y2MIx.9k/R6OeP7.LVzZs6LTiIOmCZGJg2bP2', '4568c103-500e-405d-967b-f3618a5d4c59', 1, NULL, 1, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(15, 'Lempi', 'Carroll', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'hzulauf@yahoo.com', '2022-07-27 13:07:04', '$2y$10$tNrogAdoU5gQiJanUUdWhOYyRcMmpHhyXABQNBWGE1PG5yQxSGFTO', 'd60727c2-76d7-4a78-a945-05ebddfd6afb', 2, NULL, 1, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(16, 'Paul', 'Mosimann', 'Letzigraben', '149', '8047', 'Zürich', '078 749 74 09', 0, NULL, NULL, NULL, NULL, NULL, 'viak-student@0704.ch', '2022-07-27 13:07:04', '$2y$10$QRV0FsIhzjqb2TPD40o/ouCYUw7MQGy1gdYDygd3JYctuiRCluWKO', '3f689358-5f69-469e-b0d8-ed4a668fc275', 1, NULL, 1, 1, '2022-07-27 13:07:04', '2022-07-27 13:07:04', NULL),
(17, 'Weston', 'Kunde', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'mable.weber@hane.com', '2022-07-27 13:07:04', '$2y$10$8LP6Dwq0ZMlcEVykX0whnu4jxxSx6cGQfRvDFhbod.bL1E8xWzWSe', '8f48f47a-cfe9-43e6-b1a4-5a156e07b736', 2, NULL, 1, 0, '2022-07-27 13:07:05', '2022-07-27 13:07:05', NULL),
(18, 'Jarrell', 'Pagac', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'lauriane48@yahoo.com', '2022-07-27 13:07:05', '$2y$10$J5IcO20DZCZYTDj1Q0LZN.hkRqHyXwtLE8r/lzpxIxhfkmLRCrViW', '2060c1e0-e3dc-43a8-a98d-b040b13caf5e', 1, NULL, 1, 0, '2022-07-27 13:07:05', '2022-07-27 13:07:05', NULL),
(19, 'Sheridan', 'Schimmel', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'claude73@hotmail.com', '2022-07-27 13:07:05', '$2y$10$mcmmlJhvkO/dpNct3Y53W.VR4C4LHt.9xFz3wNVgUs5iM2rCP/58e', 'fc7ead57-c1da-443c-b8f0-1e103113ac3b', 2, NULL, 1, 0, '2022-07-27 13:07:05', '2022-07-27 13:07:05', NULL),
(20, 'Otilia', 'Murphy', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'erdman.hailey@little.com', '2022-07-27 13:07:05', '$2y$10$B3fDoIZz4y3CGYrMr5DqZ.KiPm.BZSe7UYa4dv.6dPeQAtp56vDMK', '0d5894a2-ac19-497e-8b27-3fe5fc7e0708', 1, NULL, 1, 0, '2022-07-27 13:07:05', '2022-07-27 13:07:05', NULL),
(21, 'Jordon', 'Hill', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'bhodkiewicz@gmail.com', '2022-07-27 13:07:05', '$2y$10$TOXOjq9GcerLgqUjJ2/bhuUxhq9hRKzfXv6F13bHX5bVJeNU/ecpC', 'be94d92f-4455-431b-8f92-2881893e6527', 1, NULL, 1, 0, '2022-07-27 13:07:05', '2022-07-27 13:07:05', NULL),
(22, 'Tierra', 'Kling', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'vweissnat@hotmail.com', '2022-07-27 13:07:05', '$2y$10$cdY59VzNs1Eope6.jxb1feAjJtkTPy83oGvLln6aC40/B3PNjsJ9C', 'da448fbc-27e1-4dac-8bc8-76e1087d9074', 2, NULL, 1, 0, '2022-07-27 13:07:05', '2022-07-27 13:07:05', NULL),
(23, 'Gus', 'Gerhold', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'vnolan@yahoo.com', '2022-07-27 13:07:05', '$2y$10$a2EevsSw04RrDSkkjGRrsuhOeB16mGbA8QYG8L/olouLrCh/mMEdG', 'b8666bce-1c54-441e-9c0f-22a327a9d368', 1, NULL, 1, 0, '2022-07-27 13:07:05', '2022-07-27 13:07:05', NULL),
(24, 'Orin', 'Becker', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'donna.jaskolski@dicki.com', '2022-07-27 13:07:05', '$2y$10$rgQa0H5g20QN8yJg1cV9buRAHaCkh1VFitmzvAHKHvbu.tn/QjKY6', 'c8d948fb-a90d-433c-b9bc-f51bfc8bb950', 1, NULL, 1, 0, '2022-07-27 13:07:05', '2022-07-27 13:07:05', NULL),
(25, 'Danika', 'Stamm', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'alvina25@hackett.com', '2022-07-27 13:07:05', '$2y$10$nlyeKN1R.1nJ.eVBfSSZNexeTvre.WYxJ2XFpSAaH/Th.Hc//7upC', '694f946b-5e91-49e4-883e-58c4b5cfbcc8', 1, NULL, 1, 0, '2022-07-27 13:07:05', '2022-07-27 13:07:05', NULL),
(26, 'Alia', 'Waters', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'jett05@kreiger.info', '2022-07-27 13:07:05', '$2y$10$H9rFme9lWe94qkr7E8lXxuPJLIa6SViYPqY6hqO82sUkN0kbVudYi', '936ee5b3-459c-476d-a24b-6564ae99ba2a', 1, NULL, 1, 0, '2022-07-27 13:07:05', '2022-07-27 13:07:05', NULL),
(27, 'Tracy', 'Buckridge', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'brice.lehner@yahoo.com', '2022-07-27 13:07:05', '$2y$10$ITPIFx.syOFHmx7dBsznwOssjqa49SYjglGGoli6Squ180Vs65sYO', 'e8ec87e4-8e99-4bcb-b504-0b5f2b28ef96', 2, NULL, 1, 0, '2022-07-27 13:07:05', '2022-07-27 13:07:05', NULL),
(28, 'Victoria', 'Wilkinson', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'modesta11@herzog.com', '2022-07-27 13:07:05', '$2y$10$QVPt6CBorpaTtNRJ7F.KdO9FPlEgDpCmy09asPGCWRmPgDYPaJyeC', 'c3eb9135-4a57-4571-b974-ab8ab1145f2d', 2, NULL, 1, 0, '2022-07-27 13:07:05', '2022-07-27 13:07:05', NULL),
(29, 'Rogers', 'Simonis', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'koelpin.leatha@gmail.com', '2022-07-27 13:07:05', '$2y$10$w5a8lGlvUJjYnBMV.e/mqOrOfDzW2py7Xoy/rPivT2Bl/xfH1yiJO', '404dadae-055d-4dea-93ba-8092ee03e3d0', 1, NULL, 1, 0, '2022-07-27 13:07:05', '2022-07-27 13:07:05', NULL),
(30, 'Hubert', 'Johnston', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'zgislason@okon.com', '2022-07-27 13:07:05', '$2y$10$xVmgBVCF6QKfcxgIpWKTJ.hXQcBPSzoMRCiR47jnamN/fKrCNqgS.', '288e1888-d8d4-41a2-b52f-3a534e731b92', 1, NULL, 1, 0, '2022-07-27 13:07:05', '2022-07-27 13:07:05', NULL),
(31, 'Annalise', 'Ratke', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'luz25@jenkins.com', '2022-07-27 13:07:05', '$2y$10$FguUDJ/3xfROqnG2KzVqNeBYoj.ep5ylmMMNFsV3QzJYCLRhV6q06', '16fec774-fb68-4716-905b-a2c169dadb15', 1, NULL, 1, 0, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(32, 'Electa', 'Keeling', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'alva10@reichert.org', '2022-07-27 13:07:06', '$2y$10$vfaR.45XJ7j2gpH/62pgXuakG0tuTG8NRVbmR0crcYBiubzevG2tq', 'bb5656db-03c2-4968-96df-5e5e91faca7d', 2, NULL, 1, 0, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(33, 'Haleigh', 'Rodriguez', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'haley.lorena@gmail.com', '2022-07-27 13:07:06', '$2y$10$yGPjzNPemijyUQCTEiI9heck5pGN/fM77xkS14iwFbYKtBMzlaGZK', '0e0aad73-1992-4a1a-8072-a83832875fa1', 1, NULL, 1, 0, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(34, 'Graciela', 'Harris', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'will.javon@wilderman.org', '2022-07-27 13:07:06', '$2y$10$kKHW2LLmGrQlEHY9rHGSOON30/IeM9f.FRmGZStvLcpEgaA7dkmf.', '6508cbe6-278b-4ba1-9543-db7d1615d3c8', 2, NULL, 1, 0, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(35, 'Carleton', 'Swaniawski', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'jspencer@yahoo.com', '2022-07-27 13:07:06', '$2y$10$GmveObCTz7D6DwYNudazSOOgm0.v.rv8jqMH1mYj/mURPS6HajYeK', '1b162e2d-cb6a-461a-9d59-25dbe220e2cf', 2, NULL, 1, 0, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(36, 'Hanna', 'Rohan', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'keyon14@prosacco.com', '2022-07-27 13:07:06', '$2y$10$S0HnF/WuofMnFHtENF8thO0lCqzt.2IIL4gwobdIEkwEme/OI4K0a', '10e6ff52-3324-4b68-bab6-47e531a80270', 2, NULL, 1, 0, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL),
(37, 'Abner', 'Lubowitz', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'qparker@ankunding.info', '2022-07-27 13:07:06', '$2y$10$oVhwE1krSkqD6rM5EniBa.9JOBjy.JRy0ddJKWWUdHBCcoUwbFCHO', '233a5ba0-545b-4f8d-a54d-81d0743bec58', 1, NULL, 1, 0, '2022-07-27 13:07:06', '2022-07-27 13:07:06', NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `event_dates`
--
ALTER TABLE `event_dates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 27. Jul 2022 um 06:45
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
(1, '{\"de\": \"3D-Software\", \"en\": \"3D-Software (en)\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(2, '{\"de\": \"Bildgestaltung & Handwerk\", \"en\": \"Bildgestaltung & Handwerk (en)\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, '{\"de\": \"Management & Kommunikation\", \"en\": \"Management & Kommunikation (en)\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54');

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
(3, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(1, 3, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(1, 4, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, 5, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, 6, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(2, 7, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(2, 8, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, 9, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, 10, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(2, 11, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, 12, '2022-07-26 19:48:54', '2022-07-26 19:48:54');

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
(1, 1, '{\"de\": \"storytelling-workshop\", \"en\": \"storytelling-workshop\"}', '{\"de\": \"Storytelling – Workshop\", \"en\": \"Storytelling – Workshop\"}', '{\"de\": \"Adipisci possimus impedit explicabo saepe.\", \"en\": \"Natus vel sapiente sit deleniti voluptatibus.\"}', '{\"de\": \"Cupiditate qui optio fugit. Voluptas est possimus a veritatis dignissimos sit. Aut perferendis temporibus qui quisquam magni laudantium facere. Consectetur laboriosam molestiae ducimus quia quam aliquid. Temporibus facilis laboriosam omnis fuga qui quis totam. Recusandae mollitia quia esse animi similique. Et voluptatem impedit odio doloremque inventore recusandae voluptatem.\", \"en\": \"Et maiores consequatur quod velit. Nihil voluptate sed sunt sit numquam. Aut esse ipsa voluptatibus sit natus omnis. Ipsa et veniam quia perferendis libero quo. Rerum aliquid sed consectetur quo autem itaque. Ad dolorem corrupti dolores eos at doloremque itaque. Nihil voluptate porro et eligendi nihil optio quis et. Quis odit voluptate ea non eligendi.\"}', '720.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'db446f5e-12cf-4083-861c-b65af0e452f6', 1, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(2, 2, '{\"de\": \"blender-einfuehrungskurs\", \"en\": \"blender-einfuehrungskurs\"}', '{\"de\": \"Blender Einführungskurs\", \"en\": \"Blender Einführungskurs\"}', '{\"de\": \"Earum qui molestias mollitia perspiciatis provident.\", \"en\": \"Doloribus magnam sed eos esse.\"}', '{\"de\": \"Officiis ab eos non eius nihil rem et soluta. Fuga vitae dolores a. Amet minima exercitationem quos ut. Aut optio ut facilis. Esse dolores molestias accusamus quisquam cumque magni quia. Dolor nisi possimus saepe exercitationem et. Occaecati blanditiis eum quisquam incidunt libero ex. Ea eos ratione in fugit voluptatum.\", \"en\": \"Est cumque animi laborum quis non minima. Recusandae tenetur enim quo ea exercitationem natus molestias. Quaerat cum ex modi voluptates labore. Ut qui rerum saepe voluptate. Adipisci eius molestiae voluptatem rerum eum enim unde quod. Vitae pariatur temporibus mollitia culpa. Dolor est corporis fuga cumque et. Atque quod voluptas ab.\"}', '960.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '07a83b98-b597-4f21-8b5b-536e6729b2b5', 0, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(3, 3, '{\"de\": \"blender-renderingkurs\", \"en\": \"blender-renderingkurs\"}', '{\"de\": \"Blender Renderingkurs\", \"en\": \"Blender Renderingkurs\"}', '{\"de\": \"Odio aut cum adipisci quia reprehenderit.\", \"en\": \"Et possimus fugiat aut odit unde.\"}', '{\"de\": \"Esse tempora quam magnam rerum ad. Nulla et ex sunt sed natus nesciunt ut. Placeat sint omnis minima debitis reprehenderit. Ut et consequatur excepturi velit. Saepe nihil facere voluptates repudiandae. Ad ea aut voluptatum sed quia. Ut velit sint officia qui. Dolorem ipsam qui assumenda voluptas.\", \"en\": \"Quia ut quod delectus necessitatibus sint sit. Labore facilis velit perspiciatis enim facilis asperiores. At ut numquam repellat ratione ut ipsum in. Quasi animi qui quia architecto. Ratione et fuga velit et. Quia debitis at error sunt officia sequi tempore amet. Quisquam nihil quidem inventore laudantium tempora ut voluptatem. Delectus amet ut et maiores debitis.\"}', '960.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'd50dd5ba-4716-48fd-9a5a-7ae31d591ece', 1, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(4, 4, '{\"de\": \"blender-animationskurs\", \"en\": \"blender-animationskurs\"}', '{\"de\": \"Blender Animationskurs\", \"en\": \"Blender Animationskurs\"}', '{\"de\": \"Et quo mollitia autem non dolore optio et.\", \"en\": \"Ducimus adipisci consequuntur ea iure libero beatae aliquam assumenda.\"}', '{\"de\": \"Natus eos ipsam rerum. Fugit tempora reiciendis consequuntur a in. Optio recusandae in consequatur. Magni dolor consectetur facere sunt neque dolores. Dolorem qui dolores tempore quis tenetur qui. Rerum quia quia voluptatem et illum et. Mollitia nulla ut ab autem qui omnis suscipit sunt. Est et quae placeat dolorem.\", \"en\": \"Voluptas nihil fugit ut earum enim et commodi. Nihil facere omnis sed quia ut nulla. Dolorem voluptas dignissimos nisi vel. Aliquid sed eum dolorum. Vel consequatur iure inventore animi nesciunt sequi harum numquam. Quam sapiente saepe eveniet soluta maxime sed.\"}', '720.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '3f7b4365-204c-44f8-afc4-ee77b2054c88', 1, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(5, 5, '{\"de\": \"visual-facilitator-basics\", \"en\": \"visual-facilitator-basics\"}', '{\"de\": \"Visual Facilitator Basics\", \"en\": \"Visual Facilitator Basics\"}', '{\"de\": \"Consequuntur qui numquam aut excepturi rerum.\", \"en\": \"Similique adipisci dolorum harum qui excepturi dolorem recusandae.\"}', '{\"de\": \"Facere aut quisquam hic expedita quo delectus itaque. Est qui non fugiat quia est sint. Et unde vel similique molestiae. In quidem quos necessitatibus quas praesentium sed et. Assumenda eum voluptatem atque dicta nihil distinctio sapiente eaque. Dolorum nam fugiat ducimus corporis incidunt corporis totam. Et nam quas et reprehenderit voluptatibus quo.\", \"en\": \"Animi assumenda sunt placeat. Natus eligendi excepturi commodi sit. Vel explicabo pariatur amet omnis voluptas aut animi. Aspernatur omnis rerum adipisci rerum incidunt. Est laboriosam impedit qui. Ut laborum distinctio sed et. Delectus ipsam cumque quia harum est quae. Voluptatibus illum aut omnis quam soluta ex eius.\"}', '720.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '57094149-b0a2-4f66-8dab-48f20a6fecec', 1, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(6, 6, '{\"de\": \"visual-facilitator-advanced\", \"en\": \"visual-facilitator-advanced\"}', '{\"de\": \"Visual Facilitator Advanced\", \"en\": \"Visual Facilitator Advanced\"}', '{\"de\": \"Officiis atque iste amet modi architecto blanditiis aspernatur necessitatibus.\", \"en\": \"Sint inventore omnis maiores non incidunt officia et aut.\"}', '{\"de\": \"Assumenda pariatur est voluptas alias quisquam nam. Natus ut qui fugit laboriosam. Occaecati eligendi veniam voluptatum veniam dolores blanditiis qui. Rerum excepturi ratione nam quae laborum nisi. Voluptas rem soluta animi sed tempore qui. Sed sit velit eos maiores.\", \"en\": \"Porro voluptates dolorem non inventore necessitatibus est suscipit ex. Rem sapiente et ratione ab asperiores libero optio. Illum non explicabo libero saepe dolor optio. Recusandae quis vero eos. Vitae veritatis nostrum quo nobis et doloremque et. Et iusto id dolores voluptatum et aut. Sit itaque ducimus excepturi unde officia at. Provident libero optio ut perspiciatis dolor.\"}', '1120.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '4290bf09-3292-46e7-9947-34cd708966f5', 1, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(7, 7, '{\"de\": \"rhino-einstiegskurs\", \"en\": \"rhino-einstiegskurs\"}', '{\"de\": \"Rhino Einstiegskurs\", \"en\": \"Rhino Einstiegskurs\"}', '{\"de\": \"Aut est molestiae minima nostrum maxime corrupti.\", \"en\": \"Assumenda recusandae doloribus incidunt.\"}', '{\"de\": \"Nobis perferendis dignissimos eveniet eveniet temporibus. Eos ducimus est ullam in sit. Consequuntur eos aut delectus voluptate. Nihil voluptatem eius rem earum tenetur. Distinctio sint vero fugit aut aut cumque. Dolor soluta dolorem eius non expedita repellendus corrupti. Ad ab totam neque et doloribus eum saepe. Culpa sunt quo est quam fugit blanditiis ea ut.\", \"en\": \"Quia commodi beatae praesentium at qui velit rerum. Autem tempore rerum illo totam consequatur. Iusto odit recusandae est est. Sunt autem maxime praesentium. Adipisci fuga omnis molestias fugit quis sunt. Iure et fugiat nobis iste eos quo et sequi. In quia tempora rerum. Ipsum ut eligendi non assumenda quia et. Similique est aut architecto alias quis est ratione.\"}', '960.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'fd965bb6-d0ab-4b73-862d-d9062898e169', 1, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(8, 8, '{\"de\": \"zbrush-einfuehrungskurs\", \"en\": \"zbrush-einfuehrungskurs\"}', '{\"de\": \"ZBrush Einführungskurs\", \"en\": \"ZBrush Einführungskurs\"}', '{\"de\": \"Debitis voluptatibus harum omnis quas quo odio.\", \"en\": \"Sunt occaecati quas minima ipsam ut id.\"}', '{\"de\": \"Vero sunt odit aliquid suscipit veniam consectetur. Voluptatum mollitia excepturi ex nostrum. Quam aliquam blanditiis sit ducimus. Quo nemo aut dolor beatae omnis quisquam expedita odio. Totam illo maxime in at excepturi. Odio nam consectetur velit saepe. Eaque aut exercitationem cumque dolorem libero repellendus in. Odit id doloremque sint aspernatur.\", \"en\": \"Architecto doloremque accusamus quia id assumenda eum. Doloribus laboriosam est magnam tempora non nam quae. Et minima repellendus excepturi sed adipisci est. Et qui ullam inventore suscipit. Dignissimos et laudantium et minima tempora repudiandae. Magnam et modi esse delectus dolore. Aliquam cum facere eius labore et debitis.\"}', '840.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'dd9bb7c5-39ff-4315-ab2e-302964617b52', 1, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(9, 9, '{\"de\": \"social-media-marketing\", \"en\": \"social-media-marketing\"}', '{\"de\": \"Social Media Marketing\", \"en\": \"Social Media Marketing\"}', '{\"de\": \"Aut itaque repellat sunt maxime consequuntur ut.\", \"en\": \"Dicta suscipit autem voluptates illo impedit magni dicta et.\"}', '{\"de\": \"Doloremque quaerat quia aliquid voluptates quos nisi nemo. Error quod libero sit labore. Consequuntur labore consequatur aperiam cumque corrupti. Qui id ut sit expedita distinctio. Perspiciatis in beatae quisquam rem dolores. Qui harum odit nemo iure ut. Ullam repellat voluptatibus quas iste.\", \"en\": \"Nihil quos perferendis et enim. Doloremque mollitia aut eaque nobis ea voluptate. Explicabo ducimus deserunt debitis. Sequi incidunt laudantium facilis quo unde. Ut pariatur asperiores omnis. Ullam sed ut cumque dolorem ea et dicta amet. Aut facilis qui omnis. Corporis perferendis exercitationem id ea. Aut delectus quos voluptatibus placeat culpa. Et quia et eos quis sunt.\"}', '840.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'e5d09e64-6f88-44f7-9987-de8ff513b0ae', 0, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(10, 10, '{\"de\": \"after-effects-ae-einstiegskurs\", \"en\": \"after-effects-ae-einstiegskurs\"}', '{\"de\": \"After Effects (AE) Einstiegskurs\", \"en\": \"After Effects (AE) Einstiegskurs\"}', '{\"de\": \"Est magnam in atque quis autem esse.\", \"en\": \"Ullam sed non similique dignissimos nihil.\"}', '{\"de\": \"Ex architecto quo soluta quos. Commodi eligendi voluptatem libero qui illum iure est. Quis reprehenderit dolorem rerum dolorem. Omnis cupiditate nobis est dolorem. Sequi sit et sunt odit eum quidem et. A repudiandae officiis dolores iure. Non veritatis est possimus quidem et quasi aliquid. Ullam cumque autem et possimus et ut temporibus est. Facilis quibusdam neque consequatur voluptates.\", \"en\": \"Et autem ducimus molestiae perspiciatis et ut quo voluptas. Deleniti nobis debitis omnis soluta nemo rerum et. Quidem quo iure iste earum. Voluptatem enim eveniet dolore commodi officia corrupti. Harum quae velit saepe consequatur quia libero aliquam. Consequuntur molestias sequi eos. Quas necessitatibus tenetur qui.\"}', '840.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '7d00bc61-c885-4133-8767-e35a4cf552c9', 0, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(11, 11, '{\"de\": \"rhino-grasshopper-kurs-fuer-einsteiger\", \"en\": \"rhino-grasshopper-kurs-fuer-einsteiger\"}', '{\"de\": \"Rhino Grasshopper Kurs für Einsteiger\", \"en\": \"Rhino Grasshopper Kurs für Einsteiger\"}', '{\"de\": \"Nihil laborum nam quaerat quo.\", \"en\": \"Ducimus dolore nemo quia numquam eos.\"}', '{\"de\": \"Repudiandae quia et eum omnis sit natus qui. Eligendi eius assumenda qui quia. Impedit eum quo non illo fuga tempora culpa. Quo quis iure dolore quia perspiciatis perspiciatis. Distinctio sunt harum et id ab sequi eaque. Autem voluptatem adipisci ex. Nihil sit et unde quod sit libero.\", \"en\": \"Vel nam deleniti consequatur est tempore. Ut soluta omnis atque consectetur qui non debitis. Minima sint quam id aliquam. Neque magnam consectetur dolorem iure recusandae assumenda minima. Nesciunt consectetur consequatur sapiente et sapiente quae. Ducimus voluptatum dolor rerum rerum officia tempore. Aut possimus cum aut omnis sed nulla at. Quod amet rerum dolorum ut sequi vel natus.\"}', '720.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '033fce50-29fa-4348-861f-18d60ef9b8a3', 0, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(12, 12, '{\"de\": \"geheimnisse-der-architekturvisualisierung\", \"en\": \"geheimnisse-der-architekturvisualisierung\"}', '{\"de\": \"Geheimnisse der Architekturvisualisierung\", \"en\": \"Geheimnisse der Architekturvisualisierung\"}', '{\"de\": \"Eius minima magnam vel atque sed.\", \"en\": \"Esse voluptatibus eum labore cumque quis deserunt.\"}', '{\"de\": \"Quis eos et est cum. Suscipit corrupti aperiam et sed. Possimus molestiae consectetur suscipit nihil. Odio optio rerum qui et voluptatem quia. Eveniet vel recusandae sint iste vel sunt aut illum. Esse dolor velit fugit id velit commodi. Sunt esse nihil et neque ut et. Qui sit laudantium qui velit cupiditate. Possimus neque aliquam in cumque eveniet quam. Quia nisi ad porro ut.\", \"en\": \"Sunt ut quia ullam. Nihil tempora illo omnis et. Deleniti veritatis enim suscipit eos. Molestiae ullam magni aut. Cum libero eaque voluptas natus. Ab rerum voluptatum fugiat et soluta. Eveniet doloremque voluptas eos. Qui repellat incidunt vel saepe numquam. Doloremque incidunt ad aut.\"}', '960.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'd8b8429f-c9c7-446b-ae69-71334b96a213', 1, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL);

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
(1, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(2, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(4, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(5, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(6, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(7, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(8, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(9, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(10, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(11, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(12, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54');

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
(1, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(2, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(4, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(5, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(6, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(7, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(8, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(9, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(10, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(11, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(12, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54');

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
(1, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(2, 3, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, 3, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(4, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(5, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(6, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(7, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(8, 3, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(9, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(10, 3, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(11, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(12, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54');

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
(1, '2022-10-20', '2022-10-06', 5, 11, 1, '1120.00', '4589e740-272f-4f03-9cb8-4bf7b706a525', 1, 4, NULL, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(2, '2022-09-12', '2022-08-29', 7, 13, 0, '720.00', '428d65a0-2638-4443-be1c-a02f80be6f18', 1, 6, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(3, '2022-10-09', '2022-09-25', 6, 9, 0, '1120.00', '1fcc77cd-837e-4b4e-9497-f81ccc961350', 1, 11, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(4, '2022-09-25', '2022-09-11', 4, 10, 0, '960.00', '04982d7e-6902-4b1b-aaf3-0f4b30e2c524', 1, 1, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(5, '2022-08-18', '2022-08-04', 2, 15, 0, '720.00', '4345b2c9-b246-44e8-b722-9965d497be7b', 1, 6, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(6, '2022-10-27', '2022-10-13', 2, 15, 1, '720.00', '394e3126-37de-4424-b653-f7e1e50fd0cc', 1, 8, NULL, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(7, '2022-07-24', '2022-07-10', 5, 8, 0, '960.00', '0307a8b7-5a17-4dc6-a1ac-41b0ca5e763c', 1, 2, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(8, '2022-08-24', '2022-08-10', 6, 13, 0, '840.00', '8ecb096c-f168-47b1-93be-fb3f7ab68c7d', 1, 3, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(9, '2022-09-12', '2022-08-29', 8, 12, 0, '720.00', '9fe05635-df33-4606-a96a-75e38fed6630', 1, 1, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(10, '2022-08-05', '2022-07-22', 7, 8, 0, '960.00', '168d15ea-3f4e-40ab-bdf8-70a02b8b8479', 1, 5, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(11, '2022-10-31', '2022-10-17', 7, 14, 1, '960.00', '32227f9d-26ba-4fa9-9c94-7387f8a5d7d1', 1, 11, NULL, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(12, '2022-09-06', '2022-08-23', 8, 12, 0, '960.00', '1ecbc667-0ee5-4db4-8bda-4e46d475e371', 1, 11, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(13, '2022-10-30', '2022-10-16', 6, 15, 0, '960.00', '4fd5bc7d-ef30-45f8-bfe3-1ac1f3a665ce', 1, 5, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(14, '2022-07-27', '2022-07-13', 5, 13, 0, '720.00', '14661ab3-f602-477c-93af-eca52b03e611', 1, 6, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(15, '2022-09-06', '2022-08-23', 7, 15, 0, '720.00', '9b5aa9f7-e6da-4dbd-817c-c837dc52b3aa', 1, 2, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(16, '2022-11-14', '2022-10-31', 7, 10, 1, '720.00', 'd1866621-1b5e-4a9d-b770-9f584a88d0c1', 1, 7, NULL, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(17, '2022-08-10', '2022-07-27', 7, 11, 0, '840.00', 'd61ab99c-9336-40bf-8ef9-9ef9d2b0ac83', 1, 6, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(18, '2022-07-05', '2022-06-21', 7, 16, 0, '1120.00', '52014343-84b9-4b29-a17b-b7941e87ee8b', 1, 8, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(19, '2022-07-09', '2022-06-25', 8, 13, 0, '840.00', 'a42c9acc-eeb8-4a06-a841-e20b34854057', 1, 3, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(20, '2022-10-20', '2022-10-06', 8, 14, 0, '1120.00', '2920738f-9053-4149-82ff-6dd5d732c008', 1, 1, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(21, '2022-07-17', '2022-07-03', 2, 10, 1, '1120.00', '7ae6bc78-a6bf-4aec-be42-614c56d09b30', 1, 12, NULL, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(22, '2022-07-11', '2022-06-27', 6, 11, 0, '1120.00', '5704af6d-3ff0-4a45-a9f5-451825aec51a', 1, 2, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(23, '2022-09-17', '2022-09-03', 8, 16, 0, '720.00', '5e5439fa-454c-47d9-98aa-c9ca240824e7', 1, 1, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(24, '2022-09-11', '2022-08-28', 4, 11, 0, '720.00', '45b02434-0c8b-406e-9c1f-a40d97c83590', 1, 10, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(25, '2022-08-31', '2022-08-17', 4, 13, 0, '960.00', '2e29809b-7e69-4cc0-ab6e-23a7786534cf', 1, 9, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(26, '2022-07-01', '2022-06-17', 6, 11, 1, '840.00', 'a4387165-3e70-45a7-a8fb-375557dd799a', 1, 5, NULL, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL);

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
(1, '2022-10-20', '15:30:00', '21:15:00', 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(2, '2022-10-21', '15:30:00', '21:15:00', 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, '2022-09-12', '14:00:00', '19:00:00', 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(4, '2022-10-09', '14:00:00', '19:00:00', 3, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(5, '2022-09-25', '14:00:00', '19:00:00', 4, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(6, '2022-08-18', '15:30:00', '21:15:00', 5, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(7, '2022-08-19', '15:30:00', '21:15:00', 5, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(8, '2022-10-27', '14:00:00', '19:00:00', 6, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(9, '2022-07-24', '14:00:00', '19:00:00', 7, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(10, '2022-08-24', '14:00:00', '19:00:00', 8, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(11, '2022-09-12', '15:30:00', '21:15:00', 9, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(12, '2022-09-13', '15:30:00', '21:15:00', 9, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(13, '2022-08-05', '14:00:00', '19:00:00', 10, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(14, '2022-10-31', '14:00:00', '19:00:00', 11, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(15, '2022-09-06', '14:00:00', '19:00:00', 12, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(16, '2022-10-30', '15:30:00', '21:15:00', 13, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(17, '2022-10-31', '15:30:00', '21:15:00', 13, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(18, '2022-07-27', '14:00:00', '19:00:00', 14, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(19, '2022-09-06', '14:00:00', '19:00:00', 15, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(20, '2022-11-14', '14:00:00', '19:00:00', 16, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(21, '2022-08-10', '15:30:00', '21:15:00', 17, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(22, '2022-08-11', '15:30:00', '21:15:00', 17, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(23, '2022-07-05', '14:00:00', '19:00:00', 18, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(24, '2022-07-09', '14:00:00', '19:00:00', 19, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(25, '2022-10-20', '14:00:00', '19:00:00', 20, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(26, '2022-07-17', '15:30:00', '21:15:00', 21, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(27, '2022-07-18', '15:30:00', '21:15:00', 21, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(28, '2022-07-11', '14:00:00', '19:00:00', 22, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(29, '2022-09-17', '14:00:00', '19:00:00', 23, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(30, '2022-09-11', '14:00:00', '19:00:00', 24, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(31, '2022-08-31', '15:30:00', '21:15:00', 25, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(32, '2022-09-01', '15:30:00', '21:15:00', 25, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(33, '2022-07-01', '14:00:00', '19:00:00', 26, '2022-07-26 19:48:54', '2022-07-26 19:48:54');

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
(1, 11, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(1, 15, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(2, 13, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, 11, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(4, 12, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(5, 15, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(6, 12, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(7, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(7, 11, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(8, 15, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(9, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(10, 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(11, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(12, 8, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(13, 12, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(13, 13, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(14, 9, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(15, 15, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(16, 9, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(17, 6, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(18, 15, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(19, 10, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(19, 14, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(20, 2, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(21, 9, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(22, 13, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(23, 12, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(24, 7, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(25, 10, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(25, 14, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(26, 13, '2022-07-26 19:48:54', '2022-07-26 19:48:54');

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
(1, '{\"de\": \"männlich\", \"en\": \"male\"}', '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(2, '{\"de\": \"weiblich\", \"en\": \"female\"}', '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(3, '{\"de\": \"andere\", \"en\": \"other\"}', '2022-07-26 19:48:51', '2022-07-26 19:48:51');

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
(1, '{\"de\": \"deutsch\", \"en\": \"german\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(2, '{\"de\": \"englisch\", \"en\": \"english\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54');

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
(1, '{\"de\": \"Einsteiger\", \"en\": \"beginner\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(2, '{\"de\": \"Vertiefung\", \"en\": \"in depth\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54');

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
(1, '{\"de\": \"Visualisierungs-Akademie, Zürich\", \"en\": \"Visualisierungs-Akademie, Zurich\"}', '{\"de\": \"Förlibuckstrasse 240\\n8006 Zürich\", \"en\": \"Förlibuckstrasse 240\\n8006 Zurich\"}', 'https://goo.gl/maps/JJhSmLv5aKpPz2Pw5', 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(2, '{\"de\": \"Visualisierungs-Akademie, Bern\", \"en\": \"Visualisierungs-Akademie, Bern\"}', '{\"de\": \"Bundesstrasse 4\\nBern\", \"en\": \"Bundesstrasse 4\\n3000 Bern\"}', 'https://goo.gl/maps/9JTRGV719VGY9BUA8', 1, '2022-07-26 19:48:54', '2022-07-26 19:48:54');

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
(28, '2022_07_25_132612_create_bookings_table', 1);

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
(1, 'Admin', 'admin', '3d017647-71e0-43b6-9c21-277939452383', '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(2, 'Experte', 'expert', 'd3b09c6a-c5c3-492d-845e-3b434e3b080e', '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(3, 'Student', 'student', '5eba2185-e2fc-4a50-8a86-e63c9c7b65a7', '2022-07-26 19:48:51', '2022-07-26 19:48:51');

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
(1, 1, '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(2, 1, '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(3, 1, '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(1, 2, '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(2, 2, '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(3, 2, '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(1, 3, '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(1, 4, '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(1, 5, '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(2, 6, '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(2, 7, '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(2, 8, '2022-07-26 19:48:51', '2022-07-26 19:48:51'),
(2, 9, '2022-07-26 19:48:52', '2022-07-26 19:48:52'),
(2, 10, '2022-07-26 19:48:52', '2022-07-26 19:48:52'),
(2, 11, '2022-07-26 19:48:52', '2022-07-26 19:48:52'),
(2, 12, '2022-07-26 19:48:52', '2022-07-26 19:48:52'),
(2, 13, '2022-07-26 19:48:52', '2022-07-26 19:48:52'),
(2, 14, '2022-07-26 19:48:52', '2022-07-26 19:48:52'),
(2, 15, '2022-07-26 19:48:52', '2022-07-26 19:48:52'),
(2, 16, '2022-07-26 19:48:52', '2022-07-26 19:48:52'),
(3, 17, '2022-07-26 19:48:52', '2022-07-26 19:48:52'),
(3, 18, '2022-07-26 19:48:52', '2022-07-26 19:48:52'),
(3, 19, '2022-07-26 19:48:52', '2022-07-26 19:48:52'),
(3, 20, '2022-07-26 19:48:52', '2022-07-26 19:48:52'),
(3, 21, '2022-07-26 19:48:52', '2022-07-26 19:48:52'),
(3, 22, '2022-07-26 19:48:52', '2022-07-26 19:48:52'),
(3, 23, '2022-07-26 19:48:53', '2022-07-26 19:48:53'),
(3, 24, '2022-07-26 19:48:53', '2022-07-26 19:48:53'),
(3, 25, '2022-07-26 19:48:53', '2022-07-26 19:48:53'),
(3, 26, '2022-07-26 19:48:53', '2022-07-26 19:48:53'),
(3, 27, '2022-07-26 19:48:53', '2022-07-26 19:48:53'),
(3, 28, '2022-07-26 19:48:53', '2022-07-26 19:48:53'),
(3, 29, '2022-07-26 19:48:53', '2022-07-26 19:48:53'),
(3, 30, '2022-07-26 19:48:53', '2022-07-26 19:48:53'),
(3, 31, '2022-07-26 19:48:53', '2022-07-26 19:48:53'),
(3, 32, '2022-07-26 19:48:53', '2022-07-26 19:48:53'),
(3, 33, '2022-07-26 19:48:53', '2022-07-26 19:48:53'),
(3, 34, '2022-07-26 19:48:53', '2022-07-26 19:48:53'),
(3, 35, '2022-07-26 19:48:53', '2022-07-26 19:48:53'),
(3, 36, '2022-07-26 19:48:53', '2022-07-26 19:48:53'),
(3, 37, '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, 38, '2022-07-26 19:48:54', '2022-07-26 19:48:54');

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
('WfoIpeGYsqMrqaMrZRCdsYDOhmEYWoP4HrRr9TZq', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSktNbDFrZnhxQm83QVlGQnRjM2lzWmtsbkN5cWYya0tQM2IyVzFjYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly92aWFrLmNoLmxvY2FsL2Rhc2hib2FyZC9jb3Vyc2UvZWRpdC8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE2NTg5MDQxMzg7fXM6MTM6InNlbGVjdGVkLXJvbGUiO086MTU6IkFwcFxNb2RlbHNcUm9sZSI6MzA6e3M6MTE6IgAqAGZpbGxhYmxlIjthOjM6e2k6MDtzOjQ6InV1aWQiO2k6MTtzOjQ6Im5hbWUiO2k6MjtzOjM6ImtleSI7fXM6ODoiACoAY2FzdHMiO2E6Mjp7czoxMDoiY3JlYXRlZF9hdCI7czoxMDoiZGF0ZTpkLm0uWSI7czoxMDoidXBkYXRlZF9hdCI7czoxMDoiZGF0ZTpkLm0uWSI7fXM6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6NToicm9sZXMiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MjoiaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxOToicHJldmVudHNMYXp5TG9hZGluZyI7YjowO3M6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7czoxMzoiACoAYXR0cmlidXRlcyI7YTo2OntzOjI6ImlkIjtpOjE7czo0OiJuYW1lIjtzOjU6IkFkbWluIjtzOjM6ImtleSI7czo1OiJhZG1pbiI7czo0OiJ1dWlkIjtzOjM2OiIzZDAxNzY0Ny03MWUwLTQzYjYtOWMyMS0yNzc5Mzk0NTIzODMiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjItMDctMjYgMjE6NDg6NTEiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjItMDctMjYgMjE6NDg6NTEiO31zOjExOiIAKgBvcmlnaW5hbCI7YTo2OntzOjI6ImlkIjtpOjE7czo0OiJuYW1lIjtzOjU6IkFkbWluIjtzOjM6ImtleSI7czo1OiJhZG1pbiI7czo0OiJ1dWlkIjtzOjM2OiIzZDAxNzY0Ny03MWUwLTQzYjYtOWMyMS0yNzc5Mzk0NTIzODMiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjItMDctMjYgMjE6NDg6NTEiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjItMDctMjYgMjE6NDg6NTEiO31zOjEwOiIAKgBjaGFuZ2VzIjthOjA6e31zOjE3OiIAKgBjbGFzc0Nhc3RDYWNoZSI7YTowOnt9czoyMToiACoAYXR0cmlidXRlQ2FzdENhY2hlIjthOjA6e31zOjg6IgAqAGRhdGVzIjthOjA6e31zOjEzOiIAKgBkYXRlRm9ybWF0IjtOO3M6MTA6IgAqAGFwcGVuZHMiO2E6MDp7fXM6MTk6IgAqAGRpc3BhdGNoZXNFdmVudHMiO2E6MDp7fXM6MTQ6IgAqAG9ic2VydmFibGVzIjthOjA6e31zOjEyOiIAKgByZWxhdGlvbnMiO2E6MDp7fXM6MTA6IgAqAHRvdWNoZXMiO2E6MDp7fXM6MTA6InRpbWVzdGFtcHMiO2I6MTtzOjk6IgAqAGhpZGRlbiI7YTowOnt9czoxMDoiACoAdmlzaWJsZSI7YTowOnt9czoxMDoiACoAZ3VhcmRlZCI7YToxOntpOjA7czoxOiIqIjt9fX0=', 1658904242);

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
(1, '{\"de\": \"Rhinoceros 7\", \"en\": \"Rhinoceros 7 (en)\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(2, '{\"de\": \"Blender 3\", \"en\": \"Blender 3 (en)\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, '{\"de\": \"SketchUp 2022\", \"en\": \"SketchUp 2022 (en)\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54');

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
(1, '{\"de\": \"Modelling\", \"en\": \"Modelling (en)\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(2, '{\"de\": \"Rendering\", \"en\": \"Rendering (en)\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(3, '{\"de\": \"Visualisierung\", \"en\": \"Visualisierung (en)\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(4, '{\"de\": \"Animation\", \"en\": \"Animation (en)\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(5, '{\"de\": \"Konstruktion\", \"en\": \"Konstruktion (en)\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(6, '{\"de\": \"Motion Graphics\", \"en\": \"Motion Graphics (en)\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(7, '{\"de\": \"Architektur\", \"en\": \"Architektur (en)\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54'),
(8, '{\"de\": \"3D-Druck\", \"en\": \"3D-Druck (en)\"}', '2022-07-26 19:48:54', '2022-07-26 19:48:54');

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
(1, 'Marcel', 'Stadelmann', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'm@marceli.to', '2022-07-26 19:48:51', '$2y$10$KrdnIKl3wW0GA8mIs66o4eeT/9WmVIwQQPbbCvUlOlTTYC4HKA4ba', '56c962c7-afbc-4ec9-9225-4140fc0d63bb', 1, NULL, 1, 0, '2022-07-26 19:48:51', '2022-07-26 19:48:51', NULL),
(2, 'Oliver', 'Schmid', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'oliver.schmid@visualisierungs-akademie.ch', '2022-07-26 19:48:51', '$2y$10$SL1PQ541/ecfVwXrBxOnS.6O7laCPOm12XIoFzp104omNMwmF0Jbm', '9d14478c-3688-4a2a-9488-061cf0c9d7bb', 1, NULL, 1, 0, '2022-07-26 19:48:51', '2022-07-26 19:48:51', NULL),
(3, 'Lutz', 'Kögler', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'koegler@nightnurse.ch', '2022-07-26 19:48:51', '$2y$10$84IIoDoqhIxV3q1NOeev4.iZaF0r0wacaye9kIRl5ezV2S5hDVYMS', '5cb3e340-c1e6-4983-aab1-eff515714219', 1, NULL, 1, 0, '2022-07-26 19:48:51', '2022-07-26 19:48:51', NULL),
(4, 'Benedikt', 'Flüeler', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'bf@wbg.ch', '2022-07-26 19:48:51', '$2y$10$XfietGoSkqz.QjU7EPRUhuJPXOx.t14afB3CWm8VgWNCUfIykPlNu', '76753146-bb9e-41ec-b3c5-c347c4a1a2d5', 1, NULL, 1, 0, '2022-07-26 19:48:51', '2022-07-26 19:48:51', NULL),
(5, 'Bettina', 'Puorger', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'bp@wbg.ch', '2022-07-26 19:48:51', '$2y$10$HaX3kKIDOij/hLxw6G.EgOfR6HdYCnmTAna/MIJRiB0UkZp1mMs1q', '53893f74-09dd-45a9-9543-48b20ffe856c', 2, NULL, 1, 0, '2022-07-26 19:48:51', '2022-07-26 19:48:51', NULL),
(6, 'Peter', 'Muster', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'viak-experte@0704.ch', '2022-07-26 19:48:51', '$2y$10$BQTlkRUasEDUR2koQM5jWORfUqZXph6dN35smYyX69URnfO6UNZte', 'dcb570a2-be36-4ed1-8119-3f8974e54080', 1, NULL, 1, 1, '2022-07-26 19:48:51', '2022-07-26 19:48:51', NULL),
(7, 'Niko', 'Lynch', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'moshe.gorczany@jacobi.com', '2022-07-26 19:48:51', '$2y$10$8MBt7RBEMJWlPC6e97C2YuEwlkS.RX/RxTGqFpa4CZvYVVXBeza8C', '94fab4ba-7daf-475b-807b-315bd6129e49', 1, NULL, 1, 1, '2022-07-26 19:48:51', '2022-07-26 19:48:51', NULL),
(8, 'Marcelina', 'Windler', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'ettie43@hotmail.com', '2022-07-26 19:48:51', '$2y$10$ZP./RC6r3e175ibqJtbMTuWELuXbqZN905jWhBQVmiDtJCBU7As7q', 'd6427928-b72e-4cf6-b69c-68267b86e743', 1, NULL, 1, 1, '2022-07-26 19:48:51', '2022-07-26 19:48:51', NULL),
(9, 'Ernie', 'King', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'lind.verdie@gmail.com', '2022-07-26 19:48:51', '$2y$10$HERqbAmfqnBdkdejPJOtKerw939fg9W.ksirz07MBZ6m8PWlgY/vi', 'afc47c05-86ef-49a8-96ea-cec90d55fa94', 1, NULL, 1, 1, '2022-07-26 19:48:51', '2022-07-26 19:48:51', NULL),
(10, 'Jude', 'Will', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'mikayla.runolfsdottir@gmail.com', '2022-07-26 19:48:52', '$2y$10$rUt53rlqZTgGhtQkEUEKg.UP.vXeLIorGix4KRe/JRJdZsU1DpiR2', 'f9c77dc7-805e-456e-a4db-dfa84c84ba6e', 2, NULL, 1, 1, '2022-07-26 19:48:52', '2022-07-26 19:48:52', NULL),
(11, 'Elinor', 'Connelly', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'krystel96@gmail.com', '2022-07-26 19:48:52', '$2y$10$AQZL6ohQGi6HiNWeIs7vW.VM/T0SrAffFU42RDEOK6Y2yjeX7/0nW', 'a167874a-70c3-4750-9421-534b349f4d3c', 2, NULL, 1, 1, '2022-07-26 19:48:52', '2022-07-26 19:48:52', NULL),
(12, 'Arnoldo', 'Runte', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'enrico.dach@yahoo.com', '2022-07-26 19:48:52', '$2y$10$rnRLppW07oFB/NaQVCmbvuLZsyXtC/NmKQhgUOFcXKSYkDZR5TxX2', 'c7e0365e-0ebd-417f-8ed6-7a59a935b037', 2, NULL, 1, 1, '2022-07-26 19:48:52', '2022-07-26 19:48:52', NULL),
(13, 'Arno', 'Stark', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'bauch.loy@strosin.net', '2022-07-26 19:48:52', '$2y$10$05Oo7Z.BHjC.nVSFkAyvhen4N7sN08lvnSnfHAGaw4F.Ddmw0cCOe', 'ebe83bc1-abe3-4367-818a-825806fb649e', 2, NULL, 1, 1, '2022-07-26 19:48:52', '2022-07-26 19:48:52', NULL),
(14, 'Brody', 'Rath', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'micah98@mante.org', '2022-07-26 19:48:52', '$2y$10$YlETy/Xs2LR21VBE5aAMo.Vpt0SUYDepYruOH.olhqSmEP2d7xrge', '38c10ac8-8c1e-4004-a0f0-6cc9f9bf038f', 1, NULL, 1, 1, '2022-07-26 19:48:52', '2022-07-26 19:48:52', NULL),
(15, 'Joey', 'Ebert', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'cummings.xzavier@hotmail.com', '2022-07-26 19:48:52', '$2y$10$09I9gIRqkhB27qEKct.In.atiB.xb7s72akKj7jpNq0PYDdBKQFuC', 'ab71a16d-b772-44df-8918-279008576e2e', 2, NULL, 1, 1, '2022-07-26 19:48:52', '2022-07-26 19:48:52', NULL),
(16, 'Jabari', 'Orn', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'merlin.schimmel@kuhn.com', '2022-07-26 19:48:52', '$2y$10$jqQWV89tHFEufIAc9OuwFeRWB7QzrOcIM6wy89DZvLzhBeVwXSbdu', '02c909ff-6eca-4445-bb13-08dbdff5b656', 2, NULL, 1, 1, '2022-07-26 19:48:52', '2022-07-26 19:48:52', NULL),
(17, 'Paul', 'Mosimann', 'Letzigraben', '149', '8047', 'Zürich', '078 749 74 09', 0, NULL, NULL, NULL, NULL, NULL, 'viak-student@0704.ch', '2022-07-26 19:48:52', '$2y$10$yeF1FBvs9knTKPzRNgbtjeLa5DQqb79wwN.DqhejqPs4viKOcTfM6', '37b5ddc6-a72b-41f0-86fa-cbe7e905e0ce', 1, NULL, 1, 1, '2022-07-26 19:48:52', '2022-07-26 19:48:52', NULL),
(18, 'Sigrid', 'Berge', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'stefan.hoeger@dach.com', '2022-07-26 19:48:52', '$2y$10$rpK5yL0anRVkan921yIVyuGpF7WgXr78.60g/NfmCKQGah.Xgatae', '36b58a32-262e-40e2-bc1d-cc004227e1f0', 1, NULL, 1, 0, '2022-07-26 19:48:52', '2022-07-26 19:48:52', NULL),
(19, 'Edison', 'Ruecker', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'fwiza@yahoo.com', '2022-07-26 19:48:52', '$2y$10$L1sou5SFtG5.Kfz2l7/s3et1f.XYMMMuVnkm4xeTZvhCnJuIKg8TO', 'dee0c130-6373-4550-9d6c-c38a572ac566', 2, NULL, 1, 0, '2022-07-26 19:48:52', '2022-07-26 19:48:52', NULL),
(20, 'Logan', 'Cartwright', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'bernhard.georgiana@kreiger.com', '2022-07-26 19:48:52', '$2y$10$AkEvMVvlZTKA619gOVy0O.OhfGEM0G4eFZkWoVztN78q6KDiuOnbe', '6f9806ea-8a64-4451-9188-c3259e2cc406', 2, NULL, 1, 0, '2022-07-26 19:48:52', '2022-07-26 19:48:52', NULL),
(21, 'Stanford', 'Klein', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'zfay@herzog.info', '2022-07-26 19:48:52', '$2y$10$otsWCpbUXM0ZD.D24rYxKOCdH0L2q/CeGKggGm.iEtf0RHzReFuSC', '79d1f24e-bb0c-4160-897d-4c5d632b0f7b', 2, NULL, 1, 0, '2022-07-26 19:48:52', '2022-07-26 19:48:52', NULL),
(22, 'Jazmin', 'Mertz', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'koch.godfrey@bechtelar.net', '2022-07-26 19:48:52', '$2y$10$XTwktRlO0oVDpAhBXKsFvuKLhPNHKqxCEzV.QpH6cidLn7msbPmpa', 'f008433d-42e0-49d5-b698-df9b8b157b27', 2, NULL, 1, 0, '2022-07-26 19:48:52', '2022-07-26 19:48:52', NULL),
(23, 'Natalie', 'Hagenes', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'shanie49@gmail.com', '2022-07-26 19:48:52', '$2y$10$P8xt9CgL9egCwcFjDMjYceIwtgwmvTy30M2zK5XhVYZPqLxd06eUS', '2195cf59-de18-4be3-ac73-168230117d3f', 2, NULL, 1, 0, '2022-07-26 19:48:53', '2022-07-26 19:48:53', NULL),
(24, 'Jewell', 'Weissnat', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'twunsch@strosin.com', '2022-07-26 19:48:53', '$2y$10$sASljqZ2EFNANibDGpsJ.e91UWWyRPoQrUjzU3uUqU9v0JtwvbBty', 'c1a36e4c-2ece-4bab-a322-aae7f738fd0d', 1, NULL, 1, 0, '2022-07-26 19:48:53', '2022-07-26 19:48:53', NULL),
(25, 'Rahul', 'Bernhard', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'albertha.powlowski@ryan.net', '2022-07-26 19:48:53', '$2y$10$kIqYcgD56OUBsj2GF2Pz5uuULQk0FeGTc20GyqLdpSgSNGEoyi/a6', '5e87b606-18d7-48e1-8602-742ab2d1dea9', 1, NULL, 1, 0, '2022-07-26 19:48:53', '2022-07-26 19:48:53', NULL),
(26, 'Kellie', 'Beier', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'heloise.hudson@dooley.biz', '2022-07-26 19:48:53', '$2y$10$DhBi3wiSDkrrTfj1gaUewuLDziXEinHITpnlW59X.kb52anujxTaO', '1dde59fb-8075-4828-b97c-ec44f0d6dea5', 2, NULL, 1, 0, '2022-07-26 19:48:53', '2022-07-26 19:48:53', NULL),
(27, 'Mustafa', 'Raynor', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'deshawn36@gmail.com', '2022-07-26 19:48:53', '$2y$10$TJdU9fVbtDwNL7q1vMw2OuND6Nthhg/7cYXmnzeDrun2krQnD8tcK', 'e6cf2be0-c2cb-4a46-803b-05034c1c985e', 2, NULL, 1, 0, '2022-07-26 19:48:53', '2022-07-26 19:48:53', NULL),
(28, 'Arthur', 'Ward', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'dawn.kohler@yahoo.com', '2022-07-26 19:48:53', '$2y$10$7O3.eRXeiKbGwrNpCs8xeO4S0vmPlMW1gAvSiRLWzQ4cRUfGCat42', '5752d161-e3bb-4130-ad0a-9a811da40f4b', 1, NULL, 1, 0, '2022-07-26 19:48:53', '2022-07-26 19:48:53', NULL),
(29, 'Orpha', 'Crona', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'baumbach.jaycee@gmail.com', '2022-07-26 19:48:53', '$2y$10$ab269zVesdz3GDz9yg8mzO4M2mBX9o0U9K3jjRwQ6WyC5RkKs/Psi', '8081dadd-3c8f-4e2b-b0fe-5312a0a20ea1', 2, NULL, 1, 0, '2022-07-26 19:48:53', '2022-07-26 19:48:53', NULL),
(30, 'Jana', 'Kemmer', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'luisa.boehm@yahoo.com', '2022-07-26 19:48:53', '$2y$10$Mwr1lAH/7P0NY6lSPJmj7O1grt4wwssFGHLR7UuNArdqYs4rZottS', 'cd669bcc-7322-4479-83d3-868731d90b36', 2, NULL, 1, 0, '2022-07-26 19:48:53', '2022-07-26 19:48:53', NULL),
(31, 'Bobbie', 'Zboncak', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'kaylee65@kshlerin.com', '2022-07-26 19:48:53', '$2y$10$VGa3kep9a0vB/FJpK.WXdeQdSJmc85yjVAbJhIA/94/nn/iG4oej6', '1fb60aa4-7db3-4555-bfef-adac25e595c1', 1, NULL, 1, 0, '2022-07-26 19:48:53', '2022-07-26 19:48:53', NULL),
(32, 'Donato', 'Reinger', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'ernie81@frami.org', '2022-07-26 19:48:53', '$2y$10$wSTuA68z.hh26bQjcvHkguqZX6.bZmMpkbafpSr0q8Yr7EbGKPcDK', '7bc3dd4a-00d7-4a0b-bbe6-1f45824d279b', 1, NULL, 1, 0, '2022-07-26 19:48:53', '2022-07-26 19:48:53', NULL),
(33, 'Deanna', 'Goyette', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'von.glenda@eichmann.com', '2022-07-26 19:48:53', '$2y$10$qMCBnOi18CY5d9Fd2nnsMOcos8bx0MEmQDv9pM5LgqiCW9n.2xA.e', 'b4717131-4261-44b4-bc58-d288b95eae97', 1, NULL, 1, 0, '2022-07-26 19:48:53', '2022-07-26 19:48:53', NULL),
(34, 'Cecil', 'Bruen', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'annetta08@heathcote.org', '2022-07-26 19:48:53', '$2y$10$2gpBHcFy3N5/vwpvzkzriOqVZSwJs7gvARi4YRiI2ZDYHUvlCJYvq', '85fddead-a79a-489b-be6f-3711ce835d46', 2, NULL, 1, 0, '2022-07-26 19:48:53', '2022-07-26 19:48:53', NULL),
(35, 'Kelsi', 'Funk', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'roselyn98@bogan.com', '2022-07-26 19:48:53', '$2y$10$ZNeuazCtXqh1wmkzemOQK.BvmpkcWtWWuv.Bd9rj3UGTRBTAbwjxa', '8e610935-c3ae-4b22-9f93-f5ee1e752c73', 2, NULL, 1, 0, '2022-07-26 19:48:53', '2022-07-26 19:48:53', NULL),
(36, 'Deshawn', 'Barton', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'bwilkinson@dietrich.com', '2022-07-26 19:48:53', '$2y$10$IXIvzqtUxdqIRz9MPnDkA.Iah9AHoB9K/S4bw.8nnOsRrXeHw1tMu', 'e1afc66e-60aa-4ef4-9095-6d2a0617e41c', 1, NULL, 1, 0, '2022-07-26 19:48:53', '2022-07-26 19:48:53', NULL),
(37, 'Austyn', 'Emard', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'robel.kathlyn@gmail.com', '2022-07-26 19:48:53', '$2y$10$oOxuPQO5IVxA00HaJmOzgu2xSQBpuidn5RP0CflKnHuTGQnEVGHf.', '046c77c2-8b31-44e1-a416-7fc99f1f4997', 1, NULL, 1, 0, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL),
(38, 'Cheyenne', 'Stehr', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'dawn18@yahoo.com', '2022-07-26 19:48:54', '$2y$10$PA9XlybIEGsP/l3FE4txL.51ivb4IsIxWLC9ChWvioJnJmpn7kASC', '6d11f9a1-541e-4811-8d92-390626627703', 2, NULL, 1, 0, '2022-07-26 19:48:54', '2022-07-26 19:48:54', NULL);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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

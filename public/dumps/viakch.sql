-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 30. Jul 2022 um 16:57
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
(1, '{\"de\": \"3D-Software\", \"en\": \"3D-Software (en)\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(2, '{\"de\": \"Bildgestaltung & Handwerk\", \"en\": \"Bildgestaltung & Handwerk (en)\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(3, '{\"de\": \"Management & Kommunikation\", \"en\": \"Management & Kommunikation (en)\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54');

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
(3, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(2, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(2, 3, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(1, 4, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(1, 5, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(1, 6, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(1, 7, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(1, 8, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(3, 9, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(2, 10, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(3, 11, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(1, 12, '2022-07-30 14:56:54', '2022-07-30 14:56:54');

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
(1, 1, '{\"de\": \"storytelling-workshop\", \"en\": \"storytelling-workshop\"}', '{\"de\": \"Storytelling – Workshop\", \"en\": \"Storytelling – Workshop\"}', '{\"de\": \"Molestias itaque ducimus officia cum qui magnam.\", \"en\": \"Velit nostrum distinctio vel.\"}', '{\"de\": \"Exercitationem dolores aut ipsum rerum aliquam. Sunt earum sit et perferendis aliquid. Odio ut quis at mollitia. Vel consequuntur aut facere ullam molestiae quaerat. Dolorem repudiandae neque debitis minus est molestiae. Ipsa enim consectetur perspiciatis rerum ipsum voluptas. Rerum magni optio praesentium in eum ipsa.\", \"en\": \"Sint culpa dolor alias beatae adipisci vel voluptatibus quam. Placeat aperiam delectus consectetur quibusdam cum et corrupti. Commodi soluta quo odio labore blanditiis omnis. Cum omnis ut accusamus. Blanditiis provident aut esse corporis harum sit. Iure dolore nihil velit assumenda ut autem repellendus. Sapiente quis tempora doloribus et.\"}', '960.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'f65bd833-d390-4439-b81d-83da2df4adf7', 0, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(2, 2, '{\"de\": \"blender-einfuehrungskurs\", \"en\": \"blender-einfuehrungskurs\"}', '{\"de\": \"Blender Einführungskurs\", \"en\": \"Blender Einführungskurs\"}', '{\"de\": \"Fugiat voluptate voluptate eum aut sunt aspernatur.\", \"en\": \"Rerum qui voluptate ea et aut.\"}', '{\"de\": \"Facere animi autem itaque. Autem quos ipsam omnis ut. Mollitia distinctio in molestiae facilis. Nemo temporibus vel quos quo maiores placeat. Labore rerum debitis aliquam itaque. Aliquam explicabo natus ut. Possimus aut eligendi voluptate expedita. Saepe adipisci officiis iusto earum mollitia aut omnis nihil. Dolores distinctio eveniet qui quis voluptate modi.\", \"en\": \"Modi id impedit quasi iste fugit inventore. Quas fuga voluptate quod dolore rerum eos. Quibusdam dolorem perferendis beatae qui repellat. Aut ut molestiae explicabo libero et quibusdam at quia. Eum voluptatem aut voluptates qui commodi occaecati explicabo sed. Autem eligendi eius in. Unde laborum et voluptatem possimus aut amet.\"}', '960.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '21d29c48-ee8a-4549-a500-6f82f7ff7ddc', 1, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(3, 3, '{\"de\": \"blender-renderingkurs\", \"en\": \"blender-renderingkurs\"}', '{\"de\": \"Blender Renderingkurs\", \"en\": \"Blender Renderingkurs\"}', '{\"de\": \"Atque aspernatur qui blanditiis voluptatem.\", \"en\": \"Aut repudiandae praesentium est nihil dolor sequi sed accusantium.\"}', '{\"de\": \"Exercitationem praesentium libero aliquam repellat similique aut ab dolores. Similique odit dolorem aperiam quia. Culpa reiciendis voluptas ad rerum. Sit repellat harum quia vero. Harum dolor et est aspernatur commodi molestiae repellendus. Et dolor veniam laborum temporibus officia quia atque. Ipsa sapiente earum non qui omnis.\", \"en\": \"Dignissimos omnis ut ut. Atque enim est asperiores sequi labore possimus corporis molestiae. Nulla corporis aut fuga commodi. Corrupti qui voluptatibus non cumque. Omnis consequatur id est dolorum est laboriosam. Sint recusandae illo blanditiis eos. Dolore cupiditate labore dolorem dolorem est dicta occaecati consequatur.\"}', '720.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '98514946-325f-4818-bcdb-4f6b351a490b', 0, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(4, 4, '{\"de\": \"blender-animationskurs\", \"en\": \"blender-animationskurs\"}', '{\"de\": \"Blender Animationskurs\", \"en\": \"Blender Animationskurs\"}', '{\"de\": \"Delectus qui enim commodi provident voluptatem.\", \"en\": \"Ea rerum officia quod fugiat sit in.\"}', '{\"de\": \"Iusto aut sapiente itaque eius facere error. Possimus magni et deleniti nisi quia cumque quis cumque. Voluptas quidem qui autem voluptates inventore illum. Ex eum ea quae dignissimos voluptatibus quia officia dolore. Incidunt et ratione error. Velit tempore maxime nemo nam. Enim adipisci non est sequi impedit. Quam amet et occaecati.\", \"en\": \"Doloribus optio in voluptatem natus. Assumenda dolorem minima consectetur rem est. Odio qui corrupti ea consequatur. Deserunt laudantium explicabo assumenda similique. Vel voluptas nostrum saepe distinctio et. Sequi corrupti quibusdam veniam quia. Voluptatum sit est in vitae pariatur. Voluptas illo provident consectetur minus reiciendis incidunt omnis.\"}', '960.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '68ff897c-f766-4119-bea3-9f3422704d2f', 1, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(5, 5, '{\"de\": \"visual-facilitator-basics\", \"en\": \"visual-facilitator-basics\"}', '{\"de\": \"Visual Facilitator Basics\", \"en\": \"Visual Facilitator Basics\"}', '{\"de\": \"Molestiae temporibus quod aut sed iusto.\", \"en\": \"Sed est ut aut suscipit et recusandae.\"}', '{\"de\": \"In distinctio voluptatibus minus aut. Fuga qui praesentium voluptatum ratione et iste. Sapiente dignissimos cupiditate et molestias. Voluptatibus sequi eum voluptas non autem dolor voluptatem placeat.\", \"en\": \"Eum voluptatem velit a. Similique et quasi et totam nam autem. Autem consequuntur sed a harum vero molestias. Et maiores et laboriosam expedita. Soluta dolorum consequatur non nemo enim sit. Ratione quasi aliquam pariatur aut tempore sint. Sunt voluptatem sed iusto dicta sit similique.\"}', '720.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '272b01d4-b9af-4d01-bedd-29efbf245ac1', 0, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(6, 6, '{\"de\": \"visual-facilitator-advanced\", \"en\": \"visual-facilitator-advanced\"}', '{\"de\": \"Visual Facilitator Advanced\", \"en\": \"Visual Facilitator Advanced\"}', '{\"de\": \"Libero quaerat corporis libero nisi ipsum fuga non.\", \"en\": \"Et sed illo et aspernatur.\"}', '{\"de\": \"Possimus deleniti quia dolor laudantium velit eligendi facere. Blanditiis accusantium saepe ea aliquid. Est officiis molestias veritatis. In rerum nulla nostrum est vitae. Amet reiciendis nobis nobis consequatur quis nobis. Est et corrupti minima quasi id illo earum. Omnis dolorem asperiores placeat. Totam vitae eum illum nihil.\", \"en\": \"Dolorem eum nihil fugit quos. Expedita eaque quibusdam omnis repudiandae modi neque ratione. Eaque quo sit eveniet recusandae officiis accusamus. Numquam dolore aut ad sequi. Doloribus sint hic ipsum occaecati aspernatur autem. Quo voluptate veniam sequi corrupti in repellat ipsa. Debitis consequatur dignissimos eveniet iusto maiores. Nihil porro at culpa voluptatibus beatae quisquam nulla.\"}', '960.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'b286339e-d010-4c75-bd69-f951d10a37e3', 1, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(7, 7, '{\"de\": \"rhino-einstiegskurs\", \"en\": \"rhino-einstiegskurs\"}', '{\"de\": \"Rhino Einstiegskurs\", \"en\": \"Rhino Einstiegskurs\"}', '{\"de\": \"Et odit cumque qui doloremque quibusdam quasi.\", \"en\": \"Error provident ut dolor incidunt.\"}', '{\"de\": \"Atque magnam natus voluptatum. Aspernatur et possimus minus porro omnis accusamus. Quia quia eligendi et qui voluptatem. Ea assumenda consequatur sed iste inventore consequatur modi. Est commodi in quos. Incidunt ad sed dolore error expedita. Officiis quia aliquid et ut facilis similique voluptas. Molestiae eius quis aut. Rerum porro et quas praesentium nemo aut.\", \"en\": \"Vero voluptas fugit sapiente officiis. Omnis reprehenderit veritatis excepturi. Fuga tempore et velit doloribus sed doloribus. Et qui in dicta quia magni qui. Maxime sit magni dolores. Nisi est debitis culpa ratione qui. Unde perferendis et dolorum excepturi ab nulla. Dignissimos facere necessitatibus dolores omnis et. Atque reiciendis sunt possimus qui et numquam.\"}', '720.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '93c8254b-3f21-4c2c-b2e6-4adf09519df2', 1, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(8, 8, '{\"de\": \"zbrush-einfuehrungskurs\", \"en\": \"zbrush-einfuehrungskurs\"}', '{\"de\": \"ZBrush Einführungskurs\", \"en\": \"ZBrush Einführungskurs\"}', '{\"de\": \"Aliquam minima occaecati sit voluptatibus non sint.\", \"en\": \"Consequatur et labore corrupti dignissimos eum itaque earum dolorem.\"}', '{\"de\": \"Qui in sed debitis soluta esse et. Fuga repudiandae nostrum aut nostrum. Ducimus consequatur aperiam asperiores ab id et magnam. Corporis laboriosam et ut ea architecto. Ut iusto dolores ut dolor rerum. Eaque modi omnis et perspiciatis natus. Est ipsum sequi quas quo deserunt. Corporis debitis accusamus in aut non.\", \"en\": \"Ea earum enim ullam impedit enim animi vel. Natus sequi et corrupti recusandae eveniet consequatur aperiam. Et eligendi consequatur aut quis. Quam asperiores nesciunt hic et sint. Rerum a rerum ut illum fugiat. Et quis itaque minima quaerat illum nihil. Et et iure aliquid aspernatur animi sunt nemo. Autem voluptatem quia voluptas vel qui.\"}', '720.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '629f31a1-a5bf-4590-a388-8f04c1b653a6', 0, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(9, 9, '{\"de\": \"social-media-marketing\", \"en\": \"social-media-marketing\"}', '{\"de\": \"Social Media Marketing\", \"en\": \"Social Media Marketing\"}', '{\"de\": \"Necessitatibus rerum aspernatur voluptas sint laudantium.\", \"en\": \"Quae dolorem totam excepturi reiciendis consequatur in aut saepe.\"}', '{\"de\": \"Numquam reiciendis sit voluptas et. Quisquam nihil dignissimos provident id vitae. Explicabo nobis recusandae omnis dolor odio. Ut ut eligendi corporis velit. Sit aspernatur quia vel exercitationem porro odio delectus voluptate. Tempora et excepturi qui ducimus sed.\", \"en\": \"Ipsa voluptatum nesciunt dolor perspiciatis nihil quidem mollitia. Animi placeat molestias suscipit praesentium eum blanditiis eum. Animi et aperiam et vitae. Quo fuga omnis reiciendis. Dolor unde reprehenderit ullam suscipit. At quis aliquid et nulla quia vitae ex. Eligendi et ipsa est est iste nihil.\"}', '720.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'ecb9e3f7-d87c-49e3-baaf-82ef41af320e', 0, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(10, 10, '{\"de\": \"after-effects-ae-einstiegskurs\", \"en\": \"after-effects-ae-einstiegskurs\"}', '{\"de\": \"After Effects (AE) Einstiegskurs\", \"en\": \"After Effects (AE) Einstiegskurs\"}', '{\"de\": \"Cumque sint accusamus voluptatum ex.\", \"en\": \"Aliquam nihil et dolor dolores et rerum est similique.\"}', '{\"de\": \"Et rerum modi exercitationem consectetur odio aut necessitatibus. Illum laborum ipsam error sed voluptates. Eligendi aut consequatur esse cupiditate ad iure. Consequatur rerum iste maxime temporibus. Adipisci voluptatem quia recusandae. Ipsum sint pariatur qui aut. Quo alias esse praesentium eos porro occaecati. Rerum dolores explicabo vel quo et nesciunt ut.\", \"en\": \"Veritatis occaecati odit molestias. Velit laborum nostrum quibusdam voluptatem autem velit fuga. Quaerat totam qui enim praesentium. Sequi blanditiis incidunt qui nisi est. Possimus error velit ea optio. Modi rerum quos rerum veritatis. Rem perferendis distinctio doloribus qui et autem. Nemo et voluptatem harum.\"}', '1120.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '0fd0c166-6a47-41a9-935d-cbd1408d2286', 0, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(11, 11, '{\"de\": \"rhino-grasshopper-kurs-fuer-einsteiger\", \"en\": \"rhino-grasshopper-kurs-fuer-einsteiger\"}', '{\"de\": \"Rhino Grasshopper Kurs für Einsteiger\", \"en\": \"Rhino Grasshopper Kurs für Einsteiger\"}', '{\"de\": \"Amet harum recusandae dignissimos.\", \"en\": \"Qui commodi incidunt non tenetur et repellendus nihil.\"}', '{\"de\": \"Non reiciendis rerum iure voluptatum et tempora. Temporibus corporis ex ut aspernatur architecto. Nulla iste fugiat voluptatibus debitis ratione. Esse laboriosam eos nihil tempore ut ut. Vel ut et assumenda illo consequatur sint. Repellendus nihil ratione expedita consequuntur consectetur fugiat pariatur.\", \"en\": \"Consequuntur quo eaque dolores facilis voluptas minima aliquid. Ea eligendi iste autem soluta. Qui omnis non est et a non ratione. Cum unde voluptatem voluptatem quae et consequatur. Qui illo nobis deleniti id vel. Magni ea voluptatem consequatur optio qui accusamus.\"}', '840.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', '275c11c9-ba4c-4ee4-8535-a96d3a8d1518', 0, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(12, 12, '{\"de\": \"geheimnisse-der-architekturvisualisierung\", \"en\": \"geheimnisse-der-architekturvisualisierung\"}', '{\"de\": \"Geheimnisse der Architekturvisualisierung\", \"en\": \"Geheimnisse der Architekturvisualisierung\"}', '{\"de\": \"Explicabo perferendis et praesentium provident sit possimus.\", \"en\": \"At tenetur incidunt nulla totam et.\"}', '{\"de\": \"Architecto sapiente quis totam dolorum tenetur voluptatem qui. Amet ut et qui ut ut quo praesentium adipisci. Ut quo ducimus doloribus quam quibusdam. Accusamus et odit qui veniam et. Cupiditate est tenetur molestiae harum fugiat quidem reprehenderit. Totam voluptas aperiam placeat error. Minus illum recusandae voluptas corrupti est maiores. Fugiat esse consequatur dolorem voluptatem facere.\", \"en\": \"Eos fuga maxime ut qui incidunt natus et. Dolore iure ipsum est omnis quia eaque omnis. Et rerum facere et optio. Incidunt excepturi qui vitae nihil aspernatur distinctio consequatur reprehenderit. Quia est deleniti commodi accusamus aut. Eum tempora ad maxime ut. Sunt porro ab sint nihil.\"}', '840.00', NULL, '{\"de\": null, \"en\": null}', '{\"de\": null, \"en\": null}', 'f711d82b-97a8-4645-a9a6-79c4cfad8dda', 1, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL);

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
(1, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(2, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(3, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(4, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(5, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(6, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(7, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(8, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(9, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(10, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(11, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(12, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54');

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
(1, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(2, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(3, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(4, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(5, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(6, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(7, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(8, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(9, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(10, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(11, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(12, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54');

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
(1, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(2, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(3, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(4, 3, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(5, 3, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(6, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(7, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(8, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(9, 3, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(10, 3, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(11, 3, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(12, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54');

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
(1, '2022-10-31', '2022-10-17', 4, 12, 1, '960.00', 'e6724d94-35db-4b71-9a19-eb93b8db5704', 1, 7, NULL, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(2, '2022-09-30', '2022-09-16', 7, 11, 0, '720.00', '7be352d9-d4e8-4285-8b6c-bfaa0f6f3f1c', 1, 11, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(3, '2022-07-27', '2022-07-13', 4, 12, 0, '960.00', '41ebb3a0-1b04-4f50-86b7-c90f782fd2ce', 1, 8, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(4, '2022-10-21', '2022-10-07', 4, 11, 0, '1120.00', 'eb7eafe8-7333-4c08-a3d6-e197a2e30195', 1, 5, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(5, '2022-08-31', '2022-08-17', 7, 10, 0, '720.00', '55d7e387-cc65-4c83-90fc-89a87cdd7043', 1, 1, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(6, '2022-09-11', '2022-08-28', 7, 16, 1, '960.00', 'b09ad03e-1327-45b5-8f93-ae0d738e35e3', 1, 9, NULL, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(7, '2022-07-16', '2022-07-02', 5, 8, 0, '840.00', 'b2743c29-9223-493b-9837-1bba7f87e846', 1, 9, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(8, '2022-08-15', '2022-08-01', 3, 16, 0, '840.00', '1dea3c90-15dc-4bcb-9270-4eef4560ff11', 1, 3, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(9, '2022-07-07', '2022-06-23', 8, 16, 0, '960.00', '08947a3f-a65d-4adc-9866-d1077a9045d1', 1, 12, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(10, '2022-10-31', '2022-10-17', 6, 13, 0, '840.00', '5bdd3f3c-5647-48f9-919f-98d20a009caa', 1, 9, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(11, '2022-07-30', '2022-07-16', 2, 15, 1, '960.00', '3a59f4ed-2eec-4062-ad81-72aad2e92d79', 1, 8, NULL, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(12, '2022-11-09', '2022-10-26', 7, 10, 0, '840.00', 'ba8c645e-5c14-4446-9f39-51bf69a9804a', 1, 7, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(13, '2022-10-31', '2022-10-17', 2, 12, 0, '720.00', 'cd9c136e-56be-4246-92f0-bc77dce2d015', 1, 11, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(14, '2022-11-13', '2022-10-30', 8, 11, 0, '720.00', '1330655d-63e9-4af6-9503-184d8d0450ac', 1, 10, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(15, '2022-10-18', '2022-10-04', 2, 13, 0, '960.00', '6b35a0b6-ea79-4791-89ed-44862e7b811f', 1, 1, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(16, '2022-08-12', '2022-07-29', 7, 16, 1, '1120.00', 'c56d398b-b6ba-4d8b-aa7d-4d0021adc07b', 1, 12, NULL, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(17, '2022-10-17', '2022-10-03', 2, 9, 0, '720.00', 'e48c4fd2-c161-49a4-a4d4-8e2327d1c9eb', 1, 9, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(18, '2022-09-25', '2022-09-11', 3, 12, 0, '960.00', '157865fd-8bbf-4214-bac7-d6d157968016', 1, 4, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(19, '2022-11-06', '2022-10-23', 2, 16, 0, '1120.00', '1fd4a264-6a76-4e18-9092-bf3f89a23471', 1, 10, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(20, '2022-09-09', '2022-08-26', 7, 9, 0, '960.00', 'a1791a84-97dd-4fb5-90de-b4dfd9b3be6d', 1, 3, 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(21, '2022-09-15', '2022-09-01', 6, 15, 1, '840.00', '69bfa0b7-28f4-4925-b7a6-051a756d6856', 1, 3, NULL, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(22, '2022-10-31', '2022-10-17', 2, 14, 0, '960.00', '13fa2461-add1-47d6-9234-2055e199b165', 1, 8, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(23, '2022-09-18', '2022-09-04', 5, 14, 0, '960.00', '1a72ba64-0ae5-427f-8a3a-aefa090c4d7e', 1, 4, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(24, '2022-10-27', '2022-10-13', 7, 12, 0, '840.00', '9460bfdc-dff1-4050-98c9-e646e3efa910', 1, 3, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(25, '2022-08-18', '2022-08-04', 7, 11, 0, '840.00', '0fe4e83e-2abe-4229-ad8b-acaa6b8becd8', 1, 4, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(26, '2022-09-25', '2022-09-11', 8, 14, 1, '720.00', 'a486099e-15a4-4883-97eb-99ad52b25bd7', 1, 12, NULL, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL);

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
(1, '2022-10-31', '15:30:00', '21:15:00', 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(2, '2022-11-01', '15:30:00', '21:15:00', 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(3, '2022-09-30', '14:00:00', '19:00:00', 2, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(4, '2022-07-27', '14:00:00', '19:00:00', 3, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(5, '2022-10-21', '14:00:00', '19:00:00', 4, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(6, '2022-08-31', '15:30:00', '21:15:00', 5, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(7, '2022-09-01', '15:30:00', '21:15:00', 5, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(8, '2022-09-11', '14:00:00', '19:00:00', 6, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(9, '2022-07-16', '14:00:00', '19:00:00', 7, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(10, '2022-08-15', '14:00:00', '19:00:00', 8, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(11, '2022-07-07', '15:30:00', '21:15:00', 9, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(12, '2022-07-08', '15:30:00', '21:15:00', 9, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(13, '2022-10-31', '14:00:00', '19:00:00', 10, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(14, '2022-07-30', '14:00:00', '19:00:00', 11, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(15, '2022-11-09', '14:00:00', '19:00:00', 12, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(16, '2022-10-31', '15:30:00', '21:15:00', 13, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(17, '2022-11-01', '15:30:00', '21:15:00', 13, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(18, '2022-11-13', '14:00:00', '19:00:00', 14, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(19, '2022-10-18', '14:00:00', '19:00:00', 15, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(20, '2022-08-12', '14:00:00', '19:00:00', 16, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(21, '2022-10-17', '15:30:00', '21:15:00', 17, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(22, '2022-10-18', '15:30:00', '21:15:00', 17, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(23, '2022-09-25', '14:00:00', '19:00:00', 18, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(24, '2022-11-06', '14:00:00', '19:00:00', 19, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(25, '2022-09-09', '14:00:00', '19:00:00', 20, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(26, '2022-09-15', '15:30:00', '21:15:00', 21, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(27, '2022-09-16', '15:30:00', '21:15:00', 21, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(28, '2022-10-31', '14:00:00', '19:00:00', 22, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(29, '2022-09-18', '14:00:00', '19:00:00', 23, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(30, '2022-10-27', '14:00:00', '19:00:00', 24, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(31, '2022-08-18', '15:30:00', '21:15:00', 25, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(32, '2022-08-19', '15:30:00', '21:15:00', 25, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(33, '2022-09-25', '14:00:00', '19:00:00', 26, '2022-07-30 14:56:54', '2022-07-30 14:56:54');

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
(1, 8, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(1, 10, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(2, 14, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(3, 13, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(4, 8, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(5, 7, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(6, 15, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(7, 8, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(7, 9, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(8, 6, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(9, 14, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(10, 7, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(11, 14, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(12, 15, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(13, 10, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(13, 16, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(14, 7, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(15, 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(16, 16, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(17, 10, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(18, 15, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(19, 14, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(19, 16, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(20, 9, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(21, 12, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(22, 8, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(23, 14, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(24, 11, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(25, 9, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(25, 16, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(26, 12, '2022-07-30 14:56:54', '2022-07-30 14:56:54');

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
(1, '{\"de\": \"männlich\", \"en\": \"male\"}', '2022-07-30 14:56:51', '2022-07-30 14:56:51'),
(2, '{\"de\": \"weiblich\", \"en\": \"female\"}', '2022-07-30 14:56:51', '2022-07-30 14:56:51'),
(3, '{\"de\": \"andere\", \"en\": \"other\"}', '2022-07-30 14:56:51', '2022-07-30 14:56:51');

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
(1, '{\"de\": \"deutsch\", \"en\": \"german\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(2, '{\"de\": \"englisch\", \"en\": \"english\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54');

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
(1, '{\"de\": \"Einsteiger\", \"en\": \"beginner\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(2, '{\"de\": \"Vertiefung\", \"en\": \"in depth\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54');

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
(1, '{\"de\": \"Visualisierungs-Akademie, Zürich\", \"en\": \"Visualisierungs-Akademie, Zurich\"}', '{\"de\": \"Förlibuckstrasse 240\\n8006 Zürich\", \"en\": \"Förlibuckstrasse 240\\n8006 Zurich\"}', 'https://goo.gl/maps/JJhSmLv5aKpPz2Pw5', 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(2, '{\"de\": \"Visualisierungs-Akademie, Bern\", \"en\": \"Visualisierungs-Akademie, Bern\"}', '{\"de\": \"Bundesstrasse 4\\nBern\", \"en\": \"Bundesstrasse 4\\n3000 Bern\"}', 'https://goo.gl/maps/9JTRGV719VGY9BUA8', 1, '2022-07-30 14:56:54', '2022-07-30 14:56:54');

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
(29, '2022_07_27_145023_alter_images_table_add_type', 1),
(30, '2022_07_30_133610_alter_users_table_add_confirm_token', 1);

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
(1, 'Admin', 'admin', '417e8686-65a3-4ef3-b380-f0128cbbc331', '2022-07-30 14:56:51', '2022-07-30 14:56:51'),
(2, 'Experte', 'expert', '6ca9e9db-6d4e-432c-a384-15d478846757', '2022-07-30 14:56:51', '2022-07-30 14:56:51'),
(3, 'Student', 'student', '17501c90-856b-4f6f-8a5a-d563ef2bc106', '2022-07-30 14:56:51', '2022-07-30 14:56:51');

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
(1, 1, '2022-07-30 14:56:51', '2022-07-30 14:56:51'),
(2, 1, '2022-07-30 14:56:51', '2022-07-30 14:56:51'),
(3, 1, '2022-07-30 14:56:51', '2022-07-30 14:56:51'),
(1, 2, '2022-07-30 14:56:51', '2022-07-30 14:56:51'),
(1, 3, '2022-07-30 14:56:51', '2022-07-30 14:56:51'),
(1, 4, '2022-07-30 14:56:51', '2022-07-30 14:56:51'),
(1, 5, '2022-07-30 14:56:51', '2022-07-30 14:56:51'),
(2, 6, '2022-07-30 14:56:52', '2022-07-30 14:56:52'),
(2, 7, '2022-07-30 14:56:52', '2022-07-30 14:56:52'),
(2, 8, '2022-07-30 14:56:52', '2022-07-30 14:56:52'),
(2, 9, '2022-07-30 14:56:52', '2022-07-30 14:56:52'),
(2, 10, '2022-07-30 14:56:52', '2022-07-30 14:56:52'),
(2, 11, '2022-07-30 14:56:52', '2022-07-30 14:56:52'),
(2, 12, '2022-07-30 14:56:52', '2022-07-30 14:56:52'),
(2, 13, '2022-07-30 14:56:52', '2022-07-30 14:56:52'),
(2, 14, '2022-07-30 14:56:52', '2022-07-30 14:56:52'),
(2, 15, '2022-07-30 14:56:52', '2022-07-30 14:56:52'),
(2, 16, '2022-07-30 14:56:52', '2022-07-30 14:56:52'),
(3, 17, '2022-07-30 14:56:52', '2022-07-30 14:56:52'),
(3, 18, '2022-07-30 14:56:52', '2022-07-30 14:56:52'),
(3, 19, '2022-07-30 14:56:52', '2022-07-30 14:56:52'),
(3, 20, '2022-07-30 14:56:53', '2022-07-30 14:56:53'),
(3, 21, '2022-07-30 14:56:53', '2022-07-30 14:56:53'),
(3, 22, '2022-07-30 14:56:53', '2022-07-30 14:56:53'),
(3, 23, '2022-07-30 14:56:53', '2022-07-30 14:56:53'),
(3, 24, '2022-07-30 14:56:53', '2022-07-30 14:56:53'),
(3, 25, '2022-07-30 14:56:53', '2022-07-30 14:56:53'),
(3, 26, '2022-07-30 14:56:53', '2022-07-30 14:56:53'),
(3, 27, '2022-07-30 14:56:53', '2022-07-30 14:56:53'),
(3, 28, '2022-07-30 14:56:53', '2022-07-30 14:56:53'),
(3, 29, '2022-07-30 14:56:53', '2022-07-30 14:56:53'),
(3, 30, '2022-07-30 14:56:53', '2022-07-30 14:56:53'),
(3, 31, '2022-07-30 14:56:53', '2022-07-30 14:56:53'),
(3, 32, '2022-07-30 14:56:53', '2022-07-30 14:56:53'),
(3, 33, '2022-07-30 14:56:53', '2022-07-30 14:56:53'),
(3, 34, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(3, 35, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(3, 36, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(3, 37, '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(3, 38, '2022-07-30 14:56:54', '2022-07-30 14:56:54');

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
(1, '{\"de\": \"Rhinoceros 7\", \"en\": \"Rhinoceros 7 (en)\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(2, '{\"de\": \"Blender 3\", \"en\": \"Blender 3 (en)\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(3, '{\"de\": \"SketchUp 2022\", \"en\": \"SketchUp 2022 (en)\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54');

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
(1, '{\"de\": \"Modelling\", \"en\": \"Modelling (en)\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(2, '{\"de\": \"Rendering\", \"en\": \"Rendering (en)\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(3, '{\"de\": \"Visualisierung\", \"en\": \"Visualisierung (en)\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(4, '{\"de\": \"Animation\", \"en\": \"Animation (en)\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(5, '{\"de\": \"Konstruktion\", \"en\": \"Konstruktion (en)\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(6, '{\"de\": \"Motion Graphics\", \"en\": \"Motion Graphics (en)\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(7, '{\"de\": \"Architektur\", \"en\": \"Architektur (en)\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54'),
(8, '{\"de\": \"3D-Druck\", \"en\": \"3D-Druck (en)\"}', '2022-07-30 14:56:54', '2022-07-30 14:56:54');

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

INSERT INTO `users` (`id`, `firstname`, `name`, `street`, `street_no`, `zip`, `city`, `phone`, `has_invoice_address`, `invoice_address`, `expert_title`, `expert_description`, `expert_bio`, `operating_system`, `email`, `email_verified_at`, `password`, `uuid`, `gender_id`, `remember_token`, `confirm_token`, `publish`, `visible`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Marcel', 'Stadelmann', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'm@marceli.to', '2022-07-30 14:56:51', '$2y$10$omQHIUX.f4O8gtTvivz8HeEyxwODClJ7hnNbOsqjS1s4xoLh66qg.', '419b3e13-69a2-4517-815c-cf0eaa15d70d', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:51', '2022-07-30 14:56:51', NULL),
(2, 'Oliver', 'Schmid', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'oliver.schmid@visualisierungs-akademie.ch', '2022-07-30 14:56:51', '$2y$10$B2o20W2Sn7DnJs43lMFjn.5EkGvH1pr3N5J3sXk7LRTsMZWUNz1Ju', '5d68d892-35f6-4222-827e-b15c18c83bfa', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:51', '2022-07-30 14:56:51', NULL),
(3, 'Lutz', 'Kögler', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'koegler@nightnurse.ch', '2022-07-30 14:56:51', '$2y$10$aeFq9wQ/Jq6h9oE8XAa3s.PEtYcHKnmi/BJimmLnwkSLdEjG0Wl4m', '4b5a4359-36c4-43b5-8b60-018016ab5db7', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:51', '2022-07-30 14:56:51', NULL),
(4, 'Benedikt', 'Flüeler', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'bf@wbg.ch', '2022-07-30 14:56:51', '$2y$10$yLLw1shq.k6CDgm4e9AwjObXTI2tQ0ld1ja3OIYzOZI8x123g0FDe', '24b92c1a-3338-4b4d-a638-006a11a234ad', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:51', '2022-07-30 14:56:51', NULL),
(5, 'Bettina', 'Puorger', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'bp@wbg.ch', '2022-07-30 14:56:51', '$2y$10$YT9z3OUO/oHhW2xyvA8jBeWN5YyM6C7AYUvS9/9tjqygUBQKx2iXq', 'c79b552a-dc65-469b-a03d-239780731912', 2, NULL, NULL, 1, 0, '2022-07-30 14:56:51', '2022-07-30 14:56:51', NULL),
(6, 'Peter', 'Muster', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'viak-experte@0704.ch', '2022-07-30 14:56:51', '$2y$10$.uqS3dnPG9aXULekxFgkM.o9Gtr87P/1YXXHLZEsd6Fe5vQqAN3Lu', '8b54d54e-352e-4a31-b665-042b2470cec8', 1, NULL, NULL, 1, 1, '2022-07-30 14:56:52', '2022-07-30 14:56:52', NULL),
(7, 'Josefa', 'Windler', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'jamey10@yahoo.com', '2022-07-30 14:56:52', '$2y$10$5BYVeNttheKJTXtt5qUSrOaClG.rPNpWO6yyM68YVR10NSBYTNfZS', 'cd7105d2-bc04-467a-818d-d13bbf4ec2b5', 1, NULL, NULL, 1, 1, '2022-07-30 14:56:52', '2022-07-30 14:56:52', NULL),
(8, 'Yolanda', 'Hickle', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'anastacio.greenfelder@koch.biz', '2022-07-30 14:56:52', '$2y$10$1aAHSFnRBd0nuU0lQQe/4.vb6OBPDDGV.vi.8G8Vq.Vv3YRuOsi9.', 'a533752f-4b7d-4eb5-8434-af14230a933f', 1, NULL, NULL, 1, 1, '2022-07-30 14:56:52', '2022-07-30 14:56:52', NULL),
(9, 'Alexandrine', 'Kuvalis', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'carroll.danial@renner.com', '2022-07-30 14:56:52', '$2y$10$XnYklsmH8x.3qjzjwyWnDeUWL6ZcgCHhWJgAC1kC1nvwktpUW3TTi', '22297ced-da4e-4ca4-834a-ce19910925dc', 2, NULL, NULL, 1, 1, '2022-07-30 14:56:52', '2022-07-30 14:56:52', NULL),
(10, 'Milo', 'Fritsch', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'wilderman.johathan@yahoo.com', '2022-07-30 14:56:52', '$2y$10$4MhAvIYS7h48ALNPFs8xv.wxAWNl8tFzxdoLB0A.b.mnnaf0vHDVO', '8abebf4b-8b46-42d7-8657-b73b40f7f2ff', 1, NULL, NULL, 1, 1, '2022-07-30 14:56:52', '2022-07-30 14:56:52', NULL),
(11, 'Marcel', 'Armstrong', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'al26@kemmer.biz', '2022-07-30 14:56:52', '$2y$10$sZoFZNEX7R98zGCTvuG.HO8fap/cq5JhfR613YZ3Bw6OXEHWlZ3R6', 'e9b59e53-6d66-4331-814f-6f0751141c68', 1, NULL, NULL, 1, 1, '2022-07-30 14:56:52', '2022-07-30 14:56:52', NULL),
(12, 'Myah', 'Beer', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'xrogahn@graham.net', '2022-07-30 14:56:52', '$2y$10$Yl8U7nAwW8Pjvr4zQXLQUOm02kvFWfoc2KDrZW7XDEVD/grsOKg/6', 'b4af65e6-13f3-4328-be1f-3b7aefdaa306', 1, NULL, NULL, 1, 1, '2022-07-30 14:56:52', '2022-07-30 14:56:52', NULL),
(13, 'Rory', 'Effertz', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'gwalsh@armstrong.net', '2022-07-30 14:56:52', '$2y$10$YVGl0cq6EPw9G6tJh1OEJOp3JIsBi5PVILoYaAYq4p586u0vEXhxy', 'abbf47c9-760f-4278-86dc-272dc97d040b', 2, NULL, NULL, 1, 1, '2022-07-30 14:56:52', '2022-07-30 14:56:52', NULL),
(14, 'Wilma', 'Douglas', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'dickinson.jaida@gmail.com', '2022-07-30 14:56:52', '$2y$10$biDTDzgZoHLPx7fIGCu7VuItebuQ0uq.IinsZkJUqEOyXWR.yxT0O', '8e7d70f3-7273-4e0e-a131-235b6f49c1a9', 2, NULL, NULL, 1, 1, '2022-07-30 14:56:52', '2022-07-30 14:56:52', NULL),
(15, 'Ubaldo', 'Boehm', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'devonte.rohan@goodwin.com', '2022-07-30 14:56:52', '$2y$10$J9RP4RxwBaYO7zWuGz644ed7z37i1QilyGryFU8A9gdM9Ezeu8IvO', '8731d4cf-8c80-4972-ae0d-67a900026cd9', 1, NULL, NULL, 1, 1, '2022-07-30 14:56:52', '2022-07-30 14:56:52', NULL),
(16, 'Simone', 'Kshlerin', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'nkerluke@yahoo.com', '2022-07-30 14:56:52', '$2y$10$vABpc1g5teka4mNeeO3.Ce9ZT53uSt3cuuBkfN2E5uv5fb.8QyYNW', '222fe788-d7d3-4d3e-9219-4e7245c8cb1d', 1, NULL, NULL, 1, 1, '2022-07-30 14:56:52', '2022-07-30 14:56:52', NULL),
(17, 'Paul', 'Mosimann', 'Letzigraben', '149', '8047', 'Zürich', '078 749 74 09', 0, NULL, NULL, NULL, NULL, NULL, 'viak-student@0704.ch', '2022-07-30 14:56:52', '$2y$10$.le/oEjiZGubiqoDs4fkeO./3rgHljXN4YG44qwk25ySAeXK8kv66', '32840daf-5699-4b87-9088-b77f46e59af5', 1, NULL, NULL, 1, 1, '2022-07-30 14:56:52', '2022-07-30 14:56:52', NULL),
(18, 'Alvah', 'McLaughlin', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'jerod.langosh@hotmail.com', '2022-07-30 14:56:52', '$2y$10$Hk2L1npJIF8DvMSgWO/xZ.BV3n/W93zp04H53BD.Vnr2jz3lFMynm', 'f8c74074-fa2f-4a38-b753-e3483ab6a6f9', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:52', '2022-07-30 14:56:52', NULL),
(19, 'Grayce', 'Stanton', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'jaden55@stroman.com', '2022-07-30 14:56:52', '$2y$10$P4a2DR3yn9XWuZFR4/aAHO9XmqHKhg.ruC7E/H1fSoNIn6ERSiq4u', 'd9dc066e-39a7-4861-adbd-6ab52500f119', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:52', '2022-07-30 14:56:52', NULL),
(20, 'Lewis', 'Gottlieb', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'zakary.yundt@osinski.com', '2022-07-30 14:56:52', '$2y$10$xHwBYHTORnnbfCO2d0WWAOIpe3Am3GMGAZnhcuQHLIVJvVUI6CIHK', '7279edb3-350e-4a6d-bf4a-12564ac67994', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:53', '2022-07-30 14:56:53', NULL),
(21, 'Esta', 'Schroeder', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'rau.mozell@hauck.org', '2022-07-30 14:56:53', '$2y$10$YFyzkZdACHvoPA355yZevecUfNpVivO2WmgJPUQRi26rnnb.g2bCK', 'eebf1810-edb5-4354-88bc-2491cec2d10a', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:53', '2022-07-30 14:56:53', NULL),
(22, 'Melvin', 'McClure', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'schinner.mireille@yahoo.com', '2022-07-30 14:56:53', '$2y$10$SuAlg3C3Zd5I.jaeVWvpheu71GoamvpsacmzJURrmfnOoBxPUHYQm', '2f733ae6-9a9d-44f2-991b-1a9f0fe14df3', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:53', '2022-07-30 14:56:53', NULL),
(23, 'Adell', 'Bins', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'stiedemann.violet@hotmail.com', '2022-07-30 14:56:53', '$2y$10$C3EHltPSFkl3e4DeHz68xuHWSjKQDQzUNFsvA7bFqaOKSS/CTmvHS', '2767450d-30c5-41c2-9634-7399204a061c', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:53', '2022-07-30 14:56:53', NULL),
(24, 'Tierra', 'Tillman', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'kyler91@yahoo.com', '2022-07-30 14:56:53', '$2y$10$TwKS/qN6fYdygIOZMT9rkeNLuu7d02Lck0ke8tSOMZotUDTIvfgTq', 'b3737f61-4201-4542-83de-0e8621ee675e', 2, NULL, NULL, 1, 0, '2022-07-30 14:56:53', '2022-07-30 14:56:53', NULL),
(25, 'Dana', 'Kunde', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'ferne75@gmail.com', '2022-07-30 14:56:53', '$2y$10$me.rWy03WGcVUYx8qQKBjejCN8sXM11wCX9tOU5Zb03vDrutTRgh2', '249d16a5-84aa-46a6-8343-8e5162a13295', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:53', '2022-07-30 14:56:53', NULL),
(26, 'Misael', 'Howe', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'talia46@yahoo.com', '2022-07-30 14:56:53', '$2y$10$Sz7qQng20Dk3LszwseBWxO92LXQEXKhkx4ROhCHVwm5KNJM1fx/eW', '77b647ac-1392-4c50-85a4-ca84308e302c', 2, NULL, NULL, 1, 0, '2022-07-30 14:56:53', '2022-07-30 14:56:53', NULL),
(27, 'Dallas', 'Kerluke', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'elvera.farrell@bartoletti.com', '2022-07-30 14:56:53', '$2y$10$CSkKh1W0vKt3HXOowpEq4.aeajaNMMReWIcBt/vtgZJcxfG0YyVhe', '6d1dae16-58a2-43d3-8101-e21e3f9c4b34', 2, NULL, NULL, 1, 0, '2022-07-30 14:56:53', '2022-07-30 14:56:53', NULL),
(28, 'Joshua', 'Hessel', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'windler.taya@gmail.com', '2022-07-30 14:56:53', '$2y$10$8u6mZULv9Sy0F6rPf2WYUeN2DrndcDoDdXa4B5RsmffFsnuKMFnVW', 'cacb4ee9-d170-4474-8d78-2a81d4e7c1bc', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:53', '2022-07-30 14:56:53', NULL),
(29, 'Annie', 'Brekke', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'tyrique79@yahoo.com', '2022-07-30 14:56:53', '$2y$10$9isnx6FKRQy1mZJCcT3h/e06tz/Ewuq9O8cafJgSjC8bvryoYqoqe', 'd78f3340-aa93-420d-9ef6-8df65a217ce3', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:53', '2022-07-30 14:56:53', NULL),
(30, 'Zack', 'Kautzer', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'krystina54@brekke.com', '2022-07-30 14:56:53', '$2y$10$D9xt9v9l8q3p.Cd5jYlyR.r.NW5d3ZkAMZ/ofvfjrgUF1umtZK0ba', 'ca809373-e280-4c8e-aa76-a34aef545562', 2, NULL, NULL, 1, 0, '2022-07-30 14:56:53', '2022-07-30 14:56:53', NULL),
(31, 'Sigurd', 'Predovic', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'jadyn16@senger.info', '2022-07-30 14:56:53', '$2y$10$gyo92ELIYn/93vcD1Yf0eurAIJwtvyeIRaPkvNblJvW.luS.sn/xu', '30cf1696-a750-4a17-b8a6-bf9b14cb356f', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:53', '2022-07-30 14:56:53', NULL),
(32, 'Mandy', 'Goyette', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'ludie61@vonrueden.com', '2022-07-30 14:56:53', '$2y$10$aQCEOZ1U7.ep8JXcrXneR.8dc60UNyXest/WSMuZKPSnsIkRKCIgG', '1aed8c2d-0677-4bce-9ab5-bd8cb084a6b5', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:53', '2022-07-30 14:56:53', NULL),
(33, 'Dayton', 'DuBuque', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'anastasia.schamberger@yahoo.com', '2022-07-30 14:56:53', '$2y$10$2K4S2o6g2r7du0YaGf5JwusDD4nvtQdZ75qvuPc2PSy0XHlFSEroS', '6bb3ffc6-d3b5-4df6-aa94-5c689dacbccf', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:53', '2022-07-30 14:56:53', NULL),
(34, 'Jaquan', 'Heaney', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'grady.bruce@hotmail.com', '2022-07-30 14:56:53', '$2y$10$M5WeQYYF3KamSQPk9EXsWuc2CYJ.e/pKCP8sEAFZfCSw9Ax5eJsZ.', 'f11c6642-6deb-41a5-931d-e7aa8e2b96f6', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(35, 'Pansy', 'Nicolas', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'crosenbaum@price.net', '2022-07-30 14:56:54', '$2y$10$dki3ETo3UIwWkkHlRY9xTuW8FnpqHQuGibCZQ41v3jdWwNlzjcqLW', 'db7b640b-b602-4bd7-9cac-72a65249ee77', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(36, 'Marjorie', 'Stracke', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'ruecker.alison@yahoo.com', '2022-07-30 14:56:54', '$2y$10$Ky2lsPWVkcF0pUwZ6EuuJOBDI0m5974OutQnRp.e95CN5trWGYPiK', '6e5da063-a0aa-4069-a81b-51b5f551e737', 2, NULL, NULL, 1, 0, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(37, 'Layne', 'Marks', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'gdare@marks.com', '2022-07-30 14:56:54', '$2y$10$48xucJgyv2b5.Q5LGCYy.ONYZUsMgWIzyT8kz3kHzrvzIaEaCZjtS', 'eceeeb38-ad50-4884-9b14-43f24e77b20a', 2, NULL, NULL, 1, 0, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL),
(38, 'Stephen', 'Abernathy', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'thettinger@hane.com', '2022-07-30 14:56:54', '$2y$10$.9yz4qjZXurwcT.ehZ7b9.kVVkfogSk5ymR00BD8oP.lYWZzmqvEO', '3a5d8fc1-df2b-4bb8-a9a7-a2e626bacc8b', 1, NULL, NULL, 1, 0, '2022-07-30 14:56:54', '2022-07-30 14:56:54', NULL);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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

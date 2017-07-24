-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2017 at 10:06 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system`
--

-- --------------------------------------------------------

--
-- Table structure for table `blob_file`
--

CREATE TABLE `blob_file` (
  `file_id` int(11) NOT NULL,
  `file_sha256` char(64) NOT NULL,
  `context_id` int(11) DEFAULT NULL,
  `file_name` varchar(2048) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `contenttype` varchar(256) DEFAULT NULL,
  `path` varchar(2048) DEFAULT NULL,
  `content` longblob,
  `json` text,
  `created_at` datetime NOT NULL,
  `accessed_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `featured_image` longtext COLLATE utf8mb4_unicode_ci,
  `tags` longtext COLLATE utf8mb4_unicode_ci,
  `xml_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `featured_image`, `tags`, `xml_file`, `creator_id`, `created_at`, `updated_at`) VALUES
(4, 'Production Possibilities Curve', 'Economics is a social science and economists are confronted with a real world that is too complex and dynamic to be understood completely. One way in which economists deal with this complex reality is to build and use models that simplify the real world and help us to focus on the important forces that shape our economic lives. In this section we will make use of such a model, the production possibilities curve or frontier, to illustrate the problem of scarcity, choice, inefficiency, efficiency and opportunity cost.', NULL, '', NULL, 1, '2017-03-22 04:05:21', '2017-03-22 04:05:21'),
(5, 'Demand and Supply', NULL, NULL, '', NULL, 1, '2017-03-23 03:18:13', '2017-03-23 03:18:13'),
(6, 'Test course', 'summary for course', NULL, '', NULL, 12, '2017-03-23 07:32:39', '2017-03-23 07:32:39'),
(7, 'Demo Module', 'Summary for demo module', NULL, '', NULL, 12, '2017-03-23 12:27:04', '2017-03-23 12:27:04'),
(8, 'EContent Learning at its best', 'Elearning Content', NULL, '', NULL, 14, '2017-04-03 13:53:29', '2017-04-03 13:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `course_users`
--

CREATE TABLE `course_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opted_out` tinyint(4) NOT NULL DEFAULT '0',
  `opted_out_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_users`
--

INSERT INTO `course_users` (`id`, `course_id`, `user_id`, `email`, `opted_out`, `opted_out_date`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, 'josh1@live.co.za', 0, NULL, '2017-03-22 06:02:10', '2017-03-22 06:02:10'),
(2, 4, NULL, 'josh@3ncode.com', 0, NULL, '2017-03-22 06:13:48', '2017-03-22 06:13:48'),
(3, 7, NULL, 'joshua.harington@eon.co.za', 0, NULL, '2017-03-23 12:53:45', '2017-03-23 12:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `graphs`
--

CREATE TABLE `graphs` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(256, 'default', '{"displayName":"App\\\\Jobs\\\\SendCourseNotificationEmail","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"timeout":null,"data":{"commandName":"App\\\\Jobs\\\\SendCourseNotificationEmail","command":"O:36:\\"App\\\\Jobs\\\\SendCourseNotificationEmail\\":6:{s:9:\\"\\u0000*\\u0000course\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":2:{s:5:\\"class\\";s:17:\\"App\\\\Models\\\\Course\\";s:2:\\"id\\";i:4;}s:8:\\"\\u0000*\\u0000email\\";s:16:\\"josh1@live.co.za\\";s:6:\\"\\u0000*\\u0000job\\";N;s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:5:\\"delay\\";N;}"}}', 255, NULL, 1490169764, 1490169764);

-- --------------------------------------------------------

--
-- Table structure for table `key_request`
--

CREATE TABLE `key_request` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(512) NOT NULL,
  `notes` text,
  `admin` text,
  `state` smallint(6) DEFAULT NULL,
  `lti` tinyint(4) DEFAULT NULL,
  `json` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lms_plugins`
--

CREATE TABLE `lms_plugins` (
  `plugin_id` int(11) NOT NULL,
  `plugin_path` varchar(255) NOT NULL,
  `version` bigint(20) NOT NULL,
  `title` varchar(2048) DEFAULT NULL,
  `json` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lms_plugins`
--

INSERT INTO `lms_plugins` (`plugin_id`, `plugin_path`, `version`, `title`, `json`, `created_at`, `updated_at`) VALUES
(1, 'admin/lti/database.php', 201701121623, NULL, NULL, '2017-01-19 09:16:12', '2017-01-19 09:16:12'),
(11, 'admin/key/database.php', 201701121623, NULL, NULL, '2017-01-19 09:16:12', '2017-01-19 09:16:12'),
(12, 'admin/blob/database.php', 201701121623, NULL, NULL, '2017-01-19 09:16:12', '2017-01-19 09:16:12'),
(13, 'admin/mail/database.php', 201701121623, NULL, NULL, '2017-01-19 09:16:12', '2017-01-19 09:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `lti2_consumer`
--

CREATE TABLE `lti2_consumer` (
  `consumer_pk` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consumer_key256` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consumer_key` text COLLATE utf8mb4_unicode_ci,
  `secret` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lti_version` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consumer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consumer_version` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consumer_guid` text COLLATE utf8mb4_unicode_ci,
  `profile` text COLLATE utf8mb4_unicode_ci,
  `tool_proxy` text COLLATE utf8mb4_unicode_ci,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `protected` tinyint(4) DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT NULL,
  `enable_from` datetime DEFAULT NULL,
  `enable_until` datetime DEFAULT NULL,
  `last_access` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lti2_context`
--

CREATE TABLE `lti2_context` (
  `context_pk` int(10) UNSIGNED NOT NULL,
  `consumer_pk` int(11) NOT NULL,
  `lti_context_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lti2_nonce`
--

CREATE TABLE `lti2_nonce` (
  `consumer_pk` int(11) NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lti2_resource_link`
--

CREATE TABLE `lti2_resource_link` (
  `resource_link_pk` int(10) UNSIGNED NOT NULL,
  `context_pk` int(11) DEFAULT NULL,
  `consumer_pk` int(11) DEFAULT NULL,
  `lti_resource_link_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `primary_resource_link_pk` int(11) NOT NULL,
  `share_approved` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lti2_share_key`
--

CREATE TABLE `lti2_share_key` (
  `share_key_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resource_link_pk` int(11) NOT NULL,
  `auto_approve` tinyint(4) NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lti2_tool_proxy`
--

CREATE TABLE `lti2_tool_proxy` (
  `tool_proxy_pk` int(10) UNSIGNED NOT NULL,
  `tool_proxy_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consumer_pk` int(10) UNSIGNED NOT NULL,
  `tool_proxy` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lti2_user_result`
--

CREATE TABLE `lti2_user_result` (
  `user_pk` int(10) UNSIGNED NOT NULL,
  `resource_link_pk` int(11) NOT NULL,
  `lti_user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lti_result_sourcedid` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lti_context`
--

CREATE TABLE `lti_context` (
  `context_id` int(11) NOT NULL,
  `context_sha256` char(64) NOT NULL,
  `context_key` text NOT NULL,
  `key_id` int(11) NOT NULL,
  `title` text,
  `json` text,
  `settings` text,
  `settings_url` text,
  `entity_version` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lti_context`
--

INSERT INTO `lti_context` (`context_id`, `context_sha256`, `context_key`, `key_id`, `title`, `json`, `settings`, `settings_url`, `entity_version`, `created_at`, `updated_at`) VALUES
(1, '48e34f46273af9216b28aa476263b28814de979e10d173c2873a7d655e980835', '456434513', 1, 'Introduction to Programming', NULL, NULL, NULL, 0, '2017-01-20 09:39:51', '2017-01-20 09:39:51'),
(3, '5f082ff8351e08d254cbbebf7927f37adffeee6681ecb3910b811c16129d90cc', 'bltiextensions', 1, 'TEDEd', '{"bltititle":"TEDEd","bltidescription":"Search YouTube videos in the TEDEd Channel. A new icon will show up in your course rich editor letting you search the TEDEd channel and click to embed videos in your course material.","bltilaunch_url":"https:\\/\\/www.edu-apps.org\\/lti_public_resources\\/?tool_id=youtube_ted_ed","bltiextensions":{"@attributes":{"platform":"canvas.instructure.com"},"lticmproperty":["www.edu-apps.org","https:\\/\\/www.edu-apps.org\\/assets\\/lti_public_resources\\/ted_ed_icon.png","anonymous","600","560","TEDEd","youtube_ted_ed"],"lticmoptions":[{"@attributes":{"name":"editor_button"},"lticmproperty":"true"},{"@attributes":{"name":"resource_selection"},"lticmproperty":"true"}]}}', '', '', 1, '2017-03-06 20:56:44', '2017-03-06 20:56:44'),
(8, 'c702e001f8c0abede71e68fcb244bcb399b40acc0b90ab4f95bb850d9169716d', 'cartridge_icon', 1, 'College Board', '{"bltititle":"College Board","bltidescription":"Links to SAT and AP practice tests","bltiicon":"https:\\/\\/www.edu-apps.org\\/tools\\/college_board\\/icon.png","bltilaunch_url":"https:\\/\\/www.edu-apps.org\\/tool_redirect?id=college_board","bltiextensions":{"@attributes":{"platform":"canvas.instructure.com"},"lticmproperty":["college_board","anonymous"],"lticmoptions":[{"@attributes":{"name":"editor_button"},"lticmproperty":["https:\\/\\/www.edu-apps.org\\/tool_redirect?id=college_board","https:\\/\\/www.edu-apps.org\\/tools\\/college_board\\/icon.png","College Board","690","530","true"]},{"@attributes":{"name":"resource_selection"},"lticmproperty":["https:\\/\\/www.edu-apps.org\\/tool_redirect?id=college_board","https:\\/\\/www.edu-apps.org\\/tools\\/college_board\\/icon.png","College Board","690","530","true"]}]},"cartridge_bundle":{"@attributes":{"identifierref":"BLTI001_Bundle"}},"cartridge_icon":{"@attributes":{"identifierref":"BLTI001_Icon"}}}', '', '', 1, '2017-03-21 21:11:10', '2017-03-21 21:11:10'),
(9, '5feceb66ffc86f38d952786c6d696c79c2dbc239dd4e91b46729d73a27fb57e9', '0', 1, 'College Board', 'false', '', '', 1, '2017-03-21 21:11:48', '2017-03-21 21:11:48'),
(35, '166e5fb037f51db16329991a90a51c2a66b1709319ff1be013f7d2375a5bdf88', '@attributes', 1, 'educreations', '{"cartridge_basiclti_link":{"bltititle":"educreations","bltidescription":"Teacher-recorded whiteboard sessions","bltiicon":"https:\\/\\/www.edu-apps.org\\/tools\\/educreations\\/icon.png","bltilaunch_url":"https:\\/\\/www.edu-apps.org\\/tool_redirect?id=educreations","bltiextensions":{"lticmproperty":[{"@value":"educreations","@attributes":{"name":"tool_id"}},{"@value":"anonymous","@attributes":{"name":"privacy_level"}}],"lticmoptions":[{"lticmproperty":[{"@value":"https:\\/\\/www.edu-apps.org\\/tool_redirect?id=educreations","@attributes":{"name":"url"}},{"@value":"https:\\/\\/www.edu-apps.org\\/tools\\/educreations\\/icon.png","@attributes":{"name":"icon_url"}},{"@value":"educreations","@attributes":{"name":"text"}},{"@value":"690","@attributes":{"name":"selection_width"}},{"@value":"530","@attributes":{"name":"selection_height"}},{"@value":"true","@attributes":{"name":"enabled"}}],"@attributes":{"name":"editor_button"}},{"lticmproperty":[{"@value":"https:\\/\\/www.edu-apps.org\\/tool_redirect?id=educreations","@attributes":{"name":"url"}},{"@value":"https:\\/\\/www.edu-apps.org\\/tools\\/educreations\\/icon.png","@attributes":{"name":"icon_url"}},{"@value":"educreations","@attributes":{"name":"text"}},{"@value":"690","@attributes":{"name":"selection_width"}},{"@value":"530","@attributes":{"name":"selection_height"}},{"@value":"true","@attributes":{"name":"enabled"}}],"@attributes":{"name":"resource_selection"}}],"@attributes":{"platform":"canvas.instructure.com"}},"cartridge_bundle":{"@value":"","@attributes":{"identifierref":"BLTI001_Bundle"}},"cartridge_icon":{"@value":"","@attributes":{"identifierref":"BLTI001_Icon"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd       http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0.xsd       http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd       http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 20:51:26', '2017-04-03 20:51:26'),
(38, '98483c6eb40b6c31a448c22a66ded3b5e5e8d5119cac8327b655c8b5c4836489', 'testkey', 34, 'XanEdu', '{"cartridge_basiclti_link":{"bltititle":"XanEdu","bltidescription":"XanEdu LTI App","bltilaunch_url":"","bltiextensions":{"lticmproperty":[{"@value":"xanedu.com","@attributes":{"name":"domain"}},{"@value":"http:\\/\\/coursepacks.xanedu.com\\/images\\/cpcc_xanedu.gif","@attributes":{"name":"icon_url"}},{"@value":"name_only","@attributes":{"name":"privacy_level"}},{"@value":"xanedu","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:12:58', '2017-04-03 21:12:58'),
(39, 'efe79ca59f358f2fd20a4686c639e7f98cef01e9918d8fa27284205f7ec0e6cf', '693c299c5978d4e583fe8053630aded3', 35, 'Edueto', '{"cartridge_basiclti_link":{"bltititle":"Edueto","bltidescription":"Create original online exercises, tests and homework.","bltilaunch_url":"https:\\/\\/www.edueto.com\\/lti","bltiextensions":{"lticmoptions":{"lticmproperty":[{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"https:\\/\\/www.edueto.com\\/lti","@attributes":{"name":"url"}},{"@value":"public","@attributes":{"name":"visibility"}}],"@attributes":{"name":"course_navigation"}},"lticmproperty":[{"@value":"public","@attributes":{"name":"privacy_level"}},{"@value":"12354884848979848","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:13:42', '2017-04-03 21:13:42'),
(40, '3a86e4c51bcc8d434e8e28a81b71a5af4f5d2525f4874a38f3644fb6291b3406', 'nokey', 36, 'Quizlet', '{"cartridge_basiclti_link":{"bltititle":"Quizlet","bltidescription":"Search for and embed publicly available flashcards and question sets from Quizlet. Questions can be embedded directly into content as flash cards, review, or as a study game.","bltilaunch_url":"https:\\/\\/www.edu-apps.org\\/lti_public_resources\\/?tool_id=quizlet","bltiextensions":{"lticmproperty":[{"@value":"edu-apps.org","@attributes":{"name":"domain"}},{"@value":"https:\\/\\/www.edu-apps.org\\/assets\\/lti_public_resources\\/quizlet_icon.png","@attributes":{"name":"icon_url"}},{"@value":"anonymous","@attributes":{"name":"privacy_level"}},{"@value":"600","@attributes":{"name":"selection_height"}},{"@value":"560","@attributes":{"name":"selection_width"}},{"@value":"quizlet","@attributes":{"name":"tool_id"}}],"lticmoptions":[{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"editor_button"}},{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"resource_selection"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:14:31', '2017-04-03 21:14:31'),
(41, '9f57f937ffe7b48f1cdf4850e0f01ed4d48bc3d5f1de543d3bfdba42f8a1cd24', '1f633fcb-2ab4-490a-832f-45ed74b5e29e', 37, 'Box', '{"cartridge_basiclti_link":{"bltititle":"Box","bltidescription":"Embed files from Box","bltilaunch_url":"https:\\/\\/www.edu-apps.org\\/box\\/","bltiextensions":{"lticmoptions":[{"lticmproperty":[{"@value":"disabled","@attributes":{"name":"default"}},{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"public","@attributes":{"name":"visibility"}}],"@attributes":{"name":"course_navigation"}},{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"editor_button"}},{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"homework_submission"}},{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"resource_selection"}},{"lticmproperty":[{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"public","@attributes":{"name":"visibility"}}],"@attributes":{"name":"user_navigation"}}],"lticmproperty":[{"@value":"edu-apps.org","@attributes":{"name":"domain"}},{"@value":"https:\\/\\/www.edu-apps.org\\/assets\\/lti_box_engine\\/icon.png","@attributes":{"name":"icon_url"}},{"@value":"anonymous","@attributes":{"name":"privacy_level"}},{"@value":"200","@attributes":{"name":"selection_height"}},{"@value":"430","@attributes":{"name":"selection_width"}},{"@value":"lti_box_engine","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:15:10', '2017-04-03 21:15:10'),
(42, 'ffea9f6351fcaadafe8ef3c06fd19a777f81f322a8f372a0f4dfdffaaa38f7ab', 'o4Z4iNcXNPkSvYBXG', 38, 'Flinga', '{"cartridge_basiclti_link":{"bltititle":"Flinga","bltilaunch_url":"https:\\/\\/demo.flinga.fi","bltiextensions":{"lticmoptions":[{"lticmproperty":[{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"https:\\/\\/demo.flinga.fi","@attributes":{"name":"url"}},{"@value":"public","@attributes":{"name":"visibility"}}],"@attributes":{"name":"course_navigation"}},{"lticmproperty":[{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"Flinga","@attributes":{"name":"text"}},{"@value":"https:\\/\\/demo.flinga.fi","@attributes":{"name":"url"}}],"@attributes":{"name":"resource_selection"}}],"lticmproperty":[{"@value":"demo.flinga.fi","@attributes":{"name":"domain"}},{"@value":"Flinga","@attributes":{"name":"link_text"}},{"@value":"name_only","@attributes":{"name":"privacy_level"}},{"@value":"800","@attributes":{"name":"selection_height"}},{"@value":"960","@attributes":{"name":"selection_width"}},{"@value":"flinga","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:16:16', '2017-04-03 21:16:16'),
(43, '166253b8f92ae0bc431aa587a64251665513aa31f0304a757f7e3f4d3c559f33', 'mahara', 39, 'Open Educational Search', '{"cartridge_basiclti_link":{"bltititle":"Open Educational Search","bltidescription":"","bltilaunch_url":"https:\\/\\/openedsearch.azurewebsites.net\\/","bltiicon":"https:\\/\\/openedsearch.azurewebsites.net\\/Store\\/StoreIcon16.png","blticustom":"","bltiextensions":{"lticmproperty":[{"@value":"microsoft_opened_search","@attributes":{"name":"tool_id"}},{"@value":"https:\\/\\/openedsearch.azurewebsites.net\\/Store\\/StoreIcon16.png","@attributes":{"name":"icon_url"}},{"@value":"public","@attributes":{"name":"privacy_level"}},{"@value":"openedsearch.azurewebsites.net","@attributes":{"name":"domain"}},{"@value":"Open Educational Search","@attributes":{"name":"text"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemalocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:17:03', '2017-04-03 21:17:03'),
(44, '9123dcbb0b42652b0e105956c68d3ca2ff34584f324fa41a29aedd32b883e131', 'generator', 40, 'Paperscorer', '{"cartridge_basiclti_link":{"bltititle":"Paperscorer","bltidescription":"Paperscorer","bltiicon":"https:\\/\\/canvas.paperscorer.com\\/img\\/ps.png","bltilaunch_url":"https:\\/\\/canvas.paperscorer.com\\/app\\/index_lti.php","bltiextensions":{"lticmproperty":[{"@value":"ps-bubble-sheet","@attributes":{"name":"tool_id"}},{"@value":"public","@attributes":{"name":"privacy_level"}}],"lticmoptions":{"lticmproperty":[{"@value":"https:\\/\\/canvas.paperscorer.com\\/app\\/index_lti.php","@attributes":{"name":"url"}},{"@value":"Paperscorer","@attributes":{"name":"text"}},{"@value":"admins","@attributes":{"name":"visibility"}},{"@value":"enabled","@attributes":{"name":"default"}},{"@value":"true","@attributes":{"name":"enabled"}}],"@attributes":{"name":"course_navigation"}},"@attributes":{"platform":"canvas.instructure.com"}},"cartridge_bundle":{"@value":"","@attributes":{"identifierref":"BLTI001_Bundle"}},"cartridge_icon":{"@value":"","@attributes":{"identifierref":"BLTI001_Icon"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd     http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0.xsd     http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd     http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:18:01', '2017-04-03 21:18:01'),
(45, '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 'test', 41, 'Apex Learning', '{"cartridge_basiclti_link":{"bltititle":"Apex Learning","bltidescription":"Apex Learning sets the industry standard for effective blended and virtual learning solutions, offering a comprehensive catalog of rigorous, standards-based courses and tutorials to support student achievement in grades 6-12.","bltilaunch_url":"https:\\/\\/www.apexvs.com\\/ApexUI\\/LTI\\/Launch.aspx","bltiextensions":{"lticmproperty":[{"@value":"www.apexvs.com","@attributes":{"name":"domain"}},{"@value":"http:\\/\\/www.apexlearning.com\\/sites\\/all\\/themes\\/apex\\/logo.png","@attributes":{"name":"icon_url"}},{"@value":"Apex Learning","@attributes":{"name":"link_text"}},{"@value":"public","@attributes":{"name":"privacy_level"}},{"@value":"apex_learning","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:18:39', '2017-04-03 21:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `lti_domain`
--

CREATE TABLE `lti_domain` (
  `key_id` int(11) NOT NULL,
  `context_id` int(11) DEFAULT NULL,
  `domain` longtext,
  `port` int(11) DEFAULT NULL,
  `consumer_key` text,
  `secret` text,
  `json` text,
  `logo_uri` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lti_domain`
--

INSERT INTO `lti_domain` (`key_id`, `context_id`, `domain`, `port`, `consumer_key`, `secret`, `json`, `logo_uri`, `created_at`, `updated_at`) VALUES
(34, 38, '', 80, 'testkey', 'testkey', '{"cartridge_basiclti_link":{"bltititle":"XanEdu","bltidescription":"XanEdu LTI App","bltilaunch_url":"","bltiextensions":{"lticmproperty":[{"@value":"xanedu.com","@attributes":{"name":"domain"}},{"@value":"http:\\/\\/coursepacks.xanedu.com\\/images\\/cpcc_xanedu.gif","@attributes":{"name":"icon_url"}},{"@value":"name_only","@attributes":{"name":"privacy_level"}},{"@value":"xanedu","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', 'https://edu-app-center.s3.amazonaws.com/uploads/production/lti_app/banner_image/xanedu.png', '2017-04-03 23:12:58', '2017-04-03 23:12:58'),
(35, 39, 'https://www.edueto.com/lti', 80, '693c299c5978d4e583fe8053630aded3', '1039d57b324a98030918fd6389b6c614', '{"cartridge_basiclti_link":{"bltititle":"Edueto","bltidescription":"Create original online exercises, tests and homework.","bltilaunch_url":"https:\\/\\/www.edueto.com\\/lti","bltiextensions":{"lticmoptions":{"lticmproperty":[{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"https:\\/\\/www.edueto.com\\/lti","@attributes":{"name":"url"}},{"@value":"public","@attributes":{"name":"visibility"}}],"@attributes":{"name":"course_navigation"}},"lticmproperty":[{"@value":"public","@attributes":{"name":"privacy_level"}},{"@value":"12354884848979848","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', 'https://edu-app-center.s3.amazonaws.com/uploads/production/lti_app/banner_image/edueto.png', '2017-04-03 23:13:42', '2017-04-03 23:13:42'),
(36, 40, 'https://www.edu-apps.org/lti_public_resources/?tool_id=quizlet', 80, 'nokey', 'nosecret', '{"cartridge_basiclti_link":{"bltititle":"Quizlet","bltidescription":"Search for and embed publicly available flashcards and question sets from Quizlet. Questions can be embedded directly into content as flash cards, review, or as a study game.","bltilaunch_url":"https:\\/\\/www.edu-apps.org\\/lti_public_resources\\/?tool_id=quizlet","bltiextensions":{"lticmproperty":[{"@value":"edu-apps.org","@attributes":{"name":"domain"}},{"@value":"https:\\/\\/www.edu-apps.org\\/assets\\/lti_public_resources\\/quizlet_icon.png","@attributes":{"name":"icon_url"}},{"@value":"anonymous","@attributes":{"name":"privacy_level"}},{"@value":"600","@attributes":{"name":"selection_height"}},{"@value":"560","@attributes":{"name":"selection_width"}},{"@value":"quizlet","@attributes":{"name":"tool_id"}}],"lticmoptions":[{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"editor_button"}},{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"resource_selection"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', 'https://edu-app-center.s3.amazonaws.com/uploads/production/lti_app/banner_image/pr_quizlet.png', '2017-04-03 23:14:31', '2017-04-03 23:14:31'),
(37, 41, 'https://www.edu-apps.org/box/', 80, '1f633fcb-2ab4-490a-832f-45ed74b5e29e', '911ff8c29815093248e34da27f5cb028', '{"cartridge_basiclti_link":{"bltititle":"Box","bltidescription":"Embed files from Box","bltilaunch_url":"https:\\/\\/www.edu-apps.org\\/box\\/","bltiextensions":{"lticmoptions":[{"lticmproperty":[{"@value":"disabled","@attributes":{"name":"default"}},{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"public","@attributes":{"name":"visibility"}}],"@attributes":{"name":"course_navigation"}},{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"editor_button"}},{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"homework_submission"}},{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"resource_selection"}},{"lticmproperty":[{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"public","@attributes":{"name":"visibility"}}],"@attributes":{"name":"user_navigation"}}],"lticmproperty":[{"@value":"edu-apps.org","@attributes":{"name":"domain"}},{"@value":"https:\\/\\/www.edu-apps.org\\/assets\\/lti_box_engine\\/icon.png","@attributes":{"name":"icon_url"}},{"@value":"anonymous","@attributes":{"name":"privacy_level"}},{"@value":"200","@attributes":{"name":"selection_height"}},{"@value":"430","@attributes":{"name":"selection_width"}},{"@value":"lti_box_engine","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', 'https://edu-app-center.s3.amazonaws.com/uploads/production/lti_app/banner_image/box_embed_lti.png', '2017-04-03 23:15:10', '2017-04-03 23:15:10'),
(38, 42, 'https://demo.flinga.fi', 80, 'o4Z4iNcXNPkSvYBXG', 'r5TLZsb4ovQsodFHR', '{"cartridge_basiclti_link":{"bltititle":"Flinga","bltilaunch_url":"https:\\/\\/demo.flinga.fi","bltiextensions":{"lticmoptions":[{"lticmproperty":[{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"https:\\/\\/demo.flinga.fi","@attributes":{"name":"url"}},{"@value":"public","@attributes":{"name":"visibility"}}],"@attributes":{"name":"course_navigation"}},{"lticmproperty":[{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"Flinga","@attributes":{"name":"text"}},{"@value":"https:\\/\\/demo.flinga.fi","@attributes":{"name":"url"}}],"@attributes":{"name":"resource_selection"}}],"lticmproperty":[{"@value":"demo.flinga.fi","@attributes":{"name":"domain"}},{"@value":"Flinga","@attributes":{"name":"link_text"}},{"@value":"name_only","@attributes":{"name":"privacy_level"}},{"@value":"800","@attributes":{"name":"selection_height"}},{"@value":"960","@attributes":{"name":"selection_width"}},{"@value":"flinga","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', 'https://edu-app-center.s3.amazonaws.com/uploads/production/lti_app/banner_image/flinga.png', '2017-04-03 23:16:16', '2017-04-03 23:16:16'),
(39, 43, 'https://openedsearch.azurewebsites.net/', 80, 'mahara', 'maharakey', '{"cartridge_basiclti_link":{"bltititle":"Open Educational Search","bltidescription":"","bltilaunch_url":"https:\\/\\/openedsearch.azurewebsites.net\\/","bltiicon":"https:\\/\\/openedsearch.azurewebsites.net\\/Store\\/StoreIcon16.png","blticustom":"","bltiextensions":{"lticmproperty":[{"@value":"microsoft_opened_search","@attributes":{"name":"tool_id"}},{"@value":"https:\\/\\/openedsearch.azurewebsites.net\\/Store\\/StoreIcon16.png","@attributes":{"name":"icon_url"}},{"@value":"public","@attributes":{"name":"privacy_level"}},{"@value":"openedsearch.azurewebsites.net","@attributes":{"name":"domain"}},{"@value":"Open Educational Search","@attributes":{"name":"text"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemalocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', 'https://edu-app-center.s3.amazonaws.com/uploads/production/lti_app/banner_image/f808b8c7-602b-4715-bead-a4230b58365f.png', '2017-04-03 23:17:03', '2017-04-03 23:17:03'),
(40, 44, 'https://canvas.paperscorer.com/app/index_lti.php', 80, 'generator', 'generator', '{"cartridge_basiclti_link":{"bltititle":"Paperscorer","bltidescription":"Paperscorer","bltiicon":"https:\\/\\/canvas.paperscorer.com\\/img\\/ps.png","bltilaunch_url":"https:\\/\\/canvas.paperscorer.com\\/app\\/index_lti.php","bltiextensions":{"lticmproperty":[{"@value":"ps-bubble-sheet","@attributes":{"name":"tool_id"}},{"@value":"public","@attributes":{"name":"privacy_level"}}],"lticmoptions":{"lticmproperty":[{"@value":"https:\\/\\/canvas.paperscorer.com\\/app\\/index_lti.php","@attributes":{"name":"url"}},{"@value":"Paperscorer","@attributes":{"name":"text"}},{"@value":"admins","@attributes":{"name":"visibility"}},{"@value":"enabled","@attributes":{"name":"default"}},{"@value":"true","@attributes":{"name":"enabled"}}],"@attributes":{"name":"course_navigation"}},"@attributes":{"platform":"canvas.instructure.com"}},"cartridge_bundle":{"@value":"","@attributes":{"identifierref":"BLTI001_Bundle"}},"cartridge_icon":{"@value":"","@attributes":{"identifierref":"BLTI001_Icon"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd     http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0.xsd     http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd     http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', 'https://edu-app-center.s3.amazonaws.com/uploads/production/lti_app/banner_image/773dbfe9-5ead-4781-9f51-147b0f898342.png', '2017-04-03 23:18:01', '2017-04-03 23:18:01'),
(41, 45, 'https://www.apexvs.com/ApexUI/LTI/Launch.aspx', 80, 'test', 'test', '{"cartridge_basiclti_link":{"bltititle":"Apex Learning","bltidescription":"Apex Learning sets the industry standard for effective blended and virtual learning solutions, offering a comprehensive catalog of rigorous, standards-based courses and tutorials to support student achievement in grades 6-12.","bltilaunch_url":"https:\\/\\/www.apexvs.com\\/ApexUI\\/LTI\\/Launch.aspx","bltiextensions":{"lticmproperty":[{"@value":"www.apexvs.com","@attributes":{"name":"domain"}},{"@value":"http:\\/\\/www.apexlearning.com\\/sites\\/all\\/themes\\/apex\\/logo.png","@attributes":{"name":"icon_url"}},{"@value":"Apex Learning","@attributes":{"name":"link_text"}},{"@value":"public","@attributes":{"name":"privacy_level"}},{"@value":"apex_learning","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', 'https://edu-app-center.s3.amazonaws.com/uploads/production/lti_app/banner_image/apex_learning.png', '2017-04-03 23:18:39', '2017-04-03 23:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `lti_key`
--

CREATE TABLE `lti_key` (
  `key_id` int(11) NOT NULL,
  `key_sha256` char(64) NOT NULL,
  `key_key` text NOT NULL,
  `secret` text,
  `new_secret` text,
  `ack` text,
  `user_id` int(11) DEFAULT NULL,
  `consumer_profile` text,
  `new_consumer_profile` text,
  `tool_profile` text,
  `new_tool_profile` text,
  `json` text,
  `settings` text,
  `settings_url` text,
  `entity_version` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lti_key`
--

INSERT INTO `lti_key` (`key_id`, `key_sha256`, `key_key`, `secret`, `new_secret`, `ack`, `user_id`, `consumer_profile`, `new_consumer_profile`, `tool_profile`, `new_tool_profile`, `json`, `settings`, `settings_url`, `entity_version`, `created_at`, `updated_at`) VALUES
(1, '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '12345', 'secret', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2017-01-19 07:16:12', '0000-00-00 00:00:00'),
(2, 'd4c9d9027326271a89ce51fcaf328ed673f17be33469ff979e8ab8dd501e664f', 'google.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2017-01-19 07:16:12', '0000-00-00 00:00:00'),
(34, '98483c6eb40b6c31a448c22a66ded3b5e5e8d5119cac8327b655c8b5c4836489', 'testkey', 'testkey', NULL, '', 14, '', '', '', '', '{"cartridge_basiclti_link":{"bltititle":"XanEdu","bltidescription":"XanEdu LTI App","bltilaunch_url":"","bltiextensions":{"lticmproperty":[{"@value":"xanedu.com","@attributes":{"name":"domain"}},{"@value":"http:\\/\\/coursepacks.xanedu.com\\/images\\/cpcc_xanedu.gif","@attributes":{"name":"icon_url"}},{"@value":"name_only","@attributes":{"name":"privacy_level"}},{"@value":"xanedu","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:12:58', '2017-04-03 21:12:58'),
(35, 'efe79ca59f358f2fd20a4686c639e7f98cef01e9918d8fa27284205f7ec0e6cf', '693c299c5978d4e583fe8053630aded3', '1039d57b324a98030918fd6389b6c614', NULL, '', 14, '', '', '', '', '{"cartridge_basiclti_link":{"bltititle":"Edueto","bltidescription":"Create original online exercises, tests and homework.","bltilaunch_url":"https:\\/\\/www.edueto.com\\/lti","bltiextensions":{"lticmoptions":{"lticmproperty":[{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"https:\\/\\/www.edueto.com\\/lti","@attributes":{"name":"url"}},{"@value":"public","@attributes":{"name":"visibility"}}],"@attributes":{"name":"course_navigation"}},"lticmproperty":[{"@value":"public","@attributes":{"name":"privacy_level"}},{"@value":"12354884848979848","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:13:41', '2017-04-03 21:13:41'),
(36, '3a86e4c51bcc8d434e8e28a81b71a5af4f5d2525f4874a38f3644fb6291b3406', 'nokey', 'nosecret', NULL, '', 14, '', '', '', '', '{"cartridge_basiclti_link":{"bltititle":"Quizlet","bltidescription":"Search for and embed publicly available flashcards and question sets from Quizlet. Questions can be embedded directly into content as flash cards, review, or as a study game.","bltilaunch_url":"https:\\/\\/www.edu-apps.org\\/lti_public_resources\\/?tool_id=quizlet","bltiextensions":{"lticmproperty":[{"@value":"edu-apps.org","@attributes":{"name":"domain"}},{"@value":"https:\\/\\/www.edu-apps.org\\/assets\\/lti_public_resources\\/quizlet_icon.png","@attributes":{"name":"icon_url"}},{"@value":"anonymous","@attributes":{"name":"privacy_level"}},{"@value":"600","@attributes":{"name":"selection_height"}},{"@value":"560","@attributes":{"name":"selection_width"}},{"@value":"quizlet","@attributes":{"name":"tool_id"}}],"lticmoptions":[{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"editor_button"}},{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"resource_selection"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:14:31', '2017-04-03 21:14:31'),
(37, '9f57f937ffe7b48f1cdf4850e0f01ed4d48bc3d5f1de543d3bfdba42f8a1cd24', '1f633fcb-2ab4-490a-832f-45ed74b5e29e', '911ff8c29815093248e34da27f5cb028', NULL, '', 14, '', '', '', '', '{"cartridge_basiclti_link":{"bltititle":"Box","bltidescription":"Embed files from Box","bltilaunch_url":"https:\\/\\/www.edu-apps.org\\/box\\/","bltiextensions":{"lticmoptions":[{"lticmproperty":[{"@value":"disabled","@attributes":{"name":"default"}},{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"public","@attributes":{"name":"visibility"}}],"@attributes":{"name":"course_navigation"}},{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"editor_button"}},{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"homework_submission"}},{"lticmproperty":{"@value":"true","@attributes":{"name":"enabled"}},"@attributes":{"name":"resource_selection"}},{"lticmproperty":[{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"public","@attributes":{"name":"visibility"}}],"@attributes":{"name":"user_navigation"}}],"lticmproperty":[{"@value":"edu-apps.org","@attributes":{"name":"domain"}},{"@value":"https:\\/\\/www.edu-apps.org\\/assets\\/lti_box_engine\\/icon.png","@attributes":{"name":"icon_url"}},{"@value":"anonymous","@attributes":{"name":"privacy_level"}},{"@value":"200","@attributes":{"name":"selection_height"}},{"@value":"430","@attributes":{"name":"selection_width"}},{"@value":"lti_box_engine","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:15:10', '2017-04-03 21:15:10'),
(38, 'ffea9f6351fcaadafe8ef3c06fd19a777f81f322a8f372a0f4dfdffaaa38f7ab', 'o4Z4iNcXNPkSvYBXG', 'r5TLZsb4ovQsodFHR', NULL, '', 14, '', '', '', '', '{"cartridge_basiclti_link":{"bltititle":"Flinga","bltilaunch_url":"https:\\/\\/demo.flinga.fi","bltiextensions":{"lticmoptions":[{"lticmproperty":[{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"https:\\/\\/demo.flinga.fi","@attributes":{"name":"url"}},{"@value":"public","@attributes":{"name":"visibility"}}],"@attributes":{"name":"course_navigation"}},{"lticmproperty":[{"@value":"true","@attributes":{"name":"enabled"}},{"@value":"Flinga","@attributes":{"name":"text"}},{"@value":"https:\\/\\/demo.flinga.fi","@attributes":{"name":"url"}}],"@attributes":{"name":"resource_selection"}}],"lticmproperty":[{"@value":"demo.flinga.fi","@attributes":{"name":"domain"}},{"@value":"Flinga","@attributes":{"name":"link_text"}},{"@value":"name_only","@attributes":{"name":"privacy_level"}},{"@value":"800","@attributes":{"name":"selection_height"}},{"@value":"960","@attributes":{"name":"selection_width"}},{"@value":"flinga","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:16:16', '2017-04-03 21:16:16'),
(39, '166253b8f92ae0bc431aa587a64251665513aa31f0304a757f7e3f4d3c559f33', 'mahara', 'maharakey', NULL, '', 14, '', '', '', '', '{"cartridge_basiclti_link":{"bltititle":"Open Educational Search","bltidescription":"","bltilaunch_url":"https:\\/\\/openedsearch.azurewebsites.net\\/","bltiicon":"https:\\/\\/openedsearch.azurewebsites.net\\/Store\\/StoreIcon16.png","blticustom":"","bltiextensions":{"lticmproperty":[{"@value":"microsoft_opened_search","@attributes":{"name":"tool_id"}},{"@value":"https:\\/\\/openedsearch.azurewebsites.net\\/Store\\/StoreIcon16.png","@attributes":{"name":"icon_url"}},{"@value":"public","@attributes":{"name":"privacy_level"}},{"@value":"openedsearch.azurewebsites.net","@attributes":{"name":"domain"}},{"@value":"Open Educational Search","@attributes":{"name":"text"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemalocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:17:03', '2017-04-03 21:17:03'),
(40, '9123dcbb0b42652b0e105956c68d3ca2ff34584f324fa41a29aedd32b883e131', 'generator', 'generator', NULL, '', 14, '', '', '', '', '{"cartridge_basiclti_link":{"bltititle":"Paperscorer","bltidescription":"Paperscorer","bltiicon":"https:\\/\\/canvas.paperscorer.com\\/img\\/ps.png","bltilaunch_url":"https:\\/\\/canvas.paperscorer.com\\/app\\/index_lti.php","bltiextensions":{"lticmproperty":[{"@value":"ps-bubble-sheet","@attributes":{"name":"tool_id"}},{"@value":"public","@attributes":{"name":"privacy_level"}}],"lticmoptions":{"lticmproperty":[{"@value":"https:\\/\\/canvas.paperscorer.com\\/app\\/index_lti.php","@attributes":{"name":"url"}},{"@value":"Paperscorer","@attributes":{"name":"text"}},{"@value":"admins","@attributes":{"name":"visibility"}},{"@value":"enabled","@attributes":{"name":"default"}},{"@value":"true","@attributes":{"name":"enabled"}}],"@attributes":{"name":"course_navigation"}},"@attributes":{"platform":"canvas.instructure.com"}},"cartridge_bundle":{"@value":"","@attributes":{"identifierref":"BLTI001_Bundle"}},"cartridge_icon":{"@value":"","@attributes":{"identifierref":"BLTI001_Icon"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd     http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0.xsd     http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd     http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:18:01', '2017-04-03 21:18:01'),
(41, '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 'test', 'test', NULL, '', 14, '', '', '', '', '{"cartridge_basiclti_link":{"bltititle":"Apex Learning","bltidescription":"Apex Learning sets the industry standard for effective blended and virtual learning solutions, offering a comprehensive catalog of rigorous, standards-based courses and tutorials to support student achievement in grades 6-12.","bltilaunch_url":"https:\\/\\/www.apexvs.com\\/ApexUI\\/LTI\\/Launch.aspx","bltiextensions":{"lticmproperty":[{"@value":"www.apexvs.com","@attributes":{"name":"domain"}},{"@value":"http:\\/\\/www.apexlearning.com\\/sites\\/all\\/themes\\/apex\\/logo.png","@attributes":{"name":"icon_url"}},{"@value":"Apex Learning","@attributes":{"name":"link_text"}},{"@value":"public","@attributes":{"name":"privacy_level"}},{"@value":"apex_learning","@attributes":{"name":"tool_id"}}],"@attributes":{"platform":"canvas.instructure.com"}},"@attributes":{"schemaLocation":"http:\\/\\/www.imsglobal.org\\/xsd\\/imslticc_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticc_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imsbasiclti_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imsbasiclti_v1p0p1.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticm_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticm_v1p0.xsd http:\\/\\/www.imsglobal.org\\/xsd\\/imslticp_v1p0 http:\\/\\/www.imsglobal.org\\/xsd\\/lti\\/ltiv1p0\\/imslticp_v1p0.xsd"}}}', '', '', 1, '2017-04-03 21:18:39', '2017-04-03 21:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `lti_link`
--

CREATE TABLE `lti_link` (
  `link_id` int(11) NOT NULL,
  `link_sha256` char(64) NOT NULL,
  `link_key` text NOT NULL,
  `context_id` int(11) NOT NULL,
  `path` text,
  `title` text,
  `json` text,
  `settings` text,
  `settings_url` text,
  `entity_version` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lti_link`
--

INSERT INTO `lti_link` (`link_id`, `link_sha256`, `link_key`, `context_id`, `path`, `title`, `json`, `settings`, `settings_url`, `entity_version`, `created_at`, `updated_at`) VALUES
(1, '92cef4029ac060d448065916b25ead6c273e25114224d01c283fdc2ce250c463', '292832126', 1, NULL, 'Weekly Blog', NULL, NULL, NULL, 0, '2017-01-20 09:39:51', '2017-01-20 09:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `lti_membership`
--

CREATE TABLE `lti_membership` (
  `membership_id` int(11) NOT NULL,
  `context_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` smallint(6) DEFAULT NULL,
  `role_override` smallint(6) DEFAULT NULL,
  `json` text,
  `entity_version` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lti_membership`
--

INSERT INTO `lti_membership` (`membership_id`, `context_id`, `user_id`, `role`, `role_override`, `json`, `entity_version`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL, 0, '2017-01-20 09:39:51', '2017-01-20 09:39:51'),
(2, 1, 2, 0, NULL, NULL, 0, '2017-03-07 06:26:31', '2017-03-07 06:26:31'),
(3, 1, 3, 0, NULL, NULL, 0, '2017-03-07 06:26:37', '2017-03-07 06:26:37'),
(4, 1, 4, 0, NULL, NULL, 0, '2017-03-13 11:29:25', '2017-03-13 11:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `lti_nonce`
--

CREATE TABLE `lti_nonce` (
  `nonce` char(128) NOT NULL,
  `key_id` int(11) NOT NULL,
  `entity_version` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lti_nonce`
--

INSERT INTO `lti_nonce` (`nonce`, `key_id`, `entity_version`, `created_at`) VALUES
('011c050f70da764d7aa8a195c584cdd4', 1, 0, '2017-03-27 18:18:26'),
('047331d41e1d11647fa45f901de4fc0a', 1, 0, '2017-03-27 18:13:45'),
('05c45389a21d62a9388b8afb59a0cffb', 1, 0, '2017-03-27 18:17:28'),
('0a64686bdb00ba7d79191985313dc1b1', 1, 0, '2017-03-27 18:20:06'),
('0c0707bf09759f3d92a2869c6f282eac', 1, 0, '2017-03-27 18:13:39'),
('1600cf4733ad5300f82332f060c7a197', 1, 0, '2017-03-27 18:16:27'),
('161f7413f22b2f7594a0f6649deaae57', 1, 0, '2017-03-27 18:16:00'),
('1f3dd0aba526b2428668549d52f85498', 1, 0, '2017-03-27 18:22:05'),
('22cb42464f785cc1b35a85864c15d283', 1, 0, '2017-03-28 07:20:40'),
('266ba06d6ab67385101eea4c9a3aa1c6', 1, 0, '2017-03-28 07:22:09'),
('3ac126d37c319f3885a29c8a218ce42a', 1, 0, '2017-03-28 07:21:35'),
('44353cb6a43f6bf0afcb92b2c51f61db', 1, 0, '2017-03-28 07:17:31'),
('522b20dda9844edc82809af03bf0dcc4', 1, 0, '2017-03-28 07:17:43'),
('550195122729fb62273c05b264518f9c', 1, 0, '2017-03-28 07:17:20'),
('70175242b397be14477aa93253a1ab85', 1, 0, '2017-03-27 18:17:40'),
('70d974bedec3f2836ba8efbf531b14af', 1, 0, '2017-03-28 07:16:43'),
('715f073c7fbc21436f23f77e9ddce22d', 1, 0, '2017-03-27 18:17:17'),
('7d472ee857c1fef9cdf220b71f12ab75', 1, 0, '2017-03-28 07:22:58'),
('807b480e5b6a02e0efef3e0330afa832', 1, 0, '2017-03-27 18:16:40'),
('8d0ba2ea167bc6c3eb1eec52f67dbc15', 1, 0, '2017-03-28 07:20:58'),
('905cb58538e6092552b86fbfedf1cb0c', 1, 0, '2017-03-27 18:15:41'),
('9cc158d64e2dde9775f47fce8d240ddf', 1, 0, '2017-03-27 18:19:33'),
('9e686e9055477ff5b4058e2e76df4b2b', 1, 0, '2017-03-28 07:23:37'),
('9ef8bfb64261ffac2722699e51570f88', 1, 0, '2017-03-28 07:20:49'),
('b253915c78596cfc272d950d4f066525', 1, 0, '2017-03-27 18:30:25'),
('d42b2090d61c4c5a5e5f103fed05e0da', 1, 0, '2017-03-28 07:26:32'),
('e7404df97343cec67f767089ab59ac0d', 1, 0, '2017-03-28 07:22:20'),
('eb84f05634d893a178b93f79f26f40b4', 1, 0, '2017-03-27 18:18:00'),
('fd372fb7dc004c19e3c57710b389e412', 1, 0, '2017-03-27 18:17:17');

-- --------------------------------------------------------

--
-- Table structure for table `lti_result`
--

CREATE TABLE `lti_result` (
  `result_id` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `result_url` text,
  `sourcedid` text,
  `service_id` int(11) DEFAULT NULL,
  `ipaddr` varchar(64) DEFAULT NULL,
  `grade` float DEFAULT NULL,
  `note` text,
  `server_grade` float DEFAULT NULL,
  `json` text,
  `entity_version` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `retrieved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lti_result`
--

INSERT INTO `lti_result` (`result_id`, `link_id`, `user_id`, `result_url`, `sourcedid`, `service_id`, `ipaddr`, `grade`, `note`, `server_grade`, `json`, `entity_version`, `created_at`, `updated_at`, `retrieved_at`) VALUES
(1, 1, 1, NULL, 'eba99f886a944318b11234787c1bd636', 1, NULL, NULL, NULL, NULL, NULL, 0, '2017-01-20 09:39:51', '2017-01-20 09:39:51', NULL),
(2, 1, 2, NULL, '26e988d4c7312a8b49dfa8deb9faa5ee', 1, NULL, NULL, NULL, NULL, NULL, 0, '2017-03-07 06:26:31', '2017-03-07 06:26:31', NULL),
(3, 1, 3, NULL, 'd92dc727b3c069898d06e1f0fec491b1', 1, NULL, NULL, NULL, NULL, NULL, 0, '2017-03-07 06:26:37', '2017-03-07 06:26:37', NULL),
(4, 1, 4, NULL, '8a65e0c80e8948d535d378fe3105944f', 1, NULL, NULL, NULL, NULL, NULL, 0, '2017-03-13 11:29:25', '2017-03-13 11:29:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lti_service`
--

CREATE TABLE `lti_service` (
  `service_id` int(11) NOT NULL,
  `service_sha256` char(64) NOT NULL,
  `service_key` text NOT NULL,
  `key_id` int(11) NOT NULL,
  `format` varchar(1024) DEFAULT NULL,
  `json` text,
  `entity_version` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lti_service`
--

INSERT INTO `lti_service` (`service_id`, `service_sha256`, `service_key`, `key_id`, `format`, `json`, `entity_version`, `created_at`, `updated_at`) VALUES
(1, '22ad141bc0e61c84483b6e3c28d7435a0b0568f900a9b73ee6ca1e6b14889f5b', 'http://tsugi.dev/lti/tool_consumer_outcome.php?b64=MTIzNDU6OjpzZWNyZXQ6Ojo=', 1, NULL, NULL, 0, '2017-01-20 09:39:51', '2017-01-20 09:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `lti_user`
--

CREATE TABLE `lti_user` (
  `user_id` int(11) NOT NULL,
  `user_sha256` char(64) NOT NULL,
  `user_key` text NOT NULL,
  `key_id` int(11) NOT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `displayname` text,
  `email` text,
  `locale` char(63) DEFAULT NULL,
  `subscribe` smallint(6) DEFAULT NULL,
  `json` text,
  `login_at` datetime DEFAULT NULL,
  `ipaddr` varchar(64) DEFAULT NULL,
  `entity_version` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lti_user`
--

INSERT INTO `lti_user` (`user_id`, `user_sha256`, `user_key`, `key_id`, `profile_id`, `displayname`, `email`, `locale`, `subscribe`, `json`, `login_at`, `ipaddr`, `entity_version`, `created_at`, `updated_at`) VALUES
(1, '92cef4029ac060d448065916b25ead6c273e25114224d01c283fdc2ce250c463', '292832126', 1, NULL, 'Jane Instructor', 'inst@ischool.edu', NULL, NULL, NULL, NULL, NULL, 0, '2017-01-20 09:39:51', '2017-01-20 09:39:51'),
(2, 'e8167fb16b4a0fb3978449b74ffeb28a3b8d1dd5e25c85436cb452f6a5690161', '998928898', 1, NULL, 'Sue Student', 'student@ischool.edu', NULL, NULL, NULL, NULL, NULL, 0, '2017-03-07 06:26:31', '2017-03-07 06:26:31'),
(3, 'a7c072f8e9c6eb84b2c5d2b6d4f092e8e982a34945401f67f7da93e8e7283529', '121212331', 1, NULL, 'Ed Student', 'ed@ischool.edu', NULL, NULL, NULL, NULL, NULL, 0, '2017-03-07 06:26:37', '2017-03-07 06:26:37'),
(4, 'd43403a2c3dae4e4332bf99111e6e066ecda233354d5fa44484dff058e483bb8', '777777777', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2017-03-13 11:29:25', '2017-03-13 11:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `mail_bulk`
--

CREATE TABLE `mail_bulk` (
  `bulk_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `context_id` int(11) NOT NULL,
  `subject` varchar(256) DEFAULT NULL,
  `body` text,
  `json` text,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mail_sent`
--

CREATE TABLE `mail_sent` (
  `sent_id` int(11) NOT NULL,
  `context_id` int(11) NOT NULL,
  `link_id` int(11) DEFAULT NULL,
  `user_to` int(11) DEFAULT NULL,
  `user_from` int(11) DEFAULT NULL,
  `subject` varchar(256) DEFAULT NULL,
  `body` text,
  `json` text,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2017_01_01_000000_RolesPermissionsDB', 2),
(9, '2017_01_17_000000_create_lti_tables', 3),
(10, '2017_01_19_000000_create_tsugi_tables', 3),
(11, '2017_03_07_055520_create_user_l_t_i_links_table', 4),
(12, '2016_12_01_000000_PHPSaasWrapperMigrations', 5),
(13, '2017_03_18_182434_create_courses_table', 6),
(14, '2016_12_01_000000_CreateDummyTables', 7),
(15, '2017_03_20_100136_create_storylines_table', 8),
(16, '2017_03_20_100138_create_storyline_items_table', 8),
(17, '2017_03_20_075834_create_graphs_table', 9),
(18, '2017_03_22_072102_create_course_users_table', 10),
(19, '2017_03_22_074018_create_jobs_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'UNISA Personal Access Client', 'WXSzhl15Y8Vw8Hq5wh9hPiYDZwMaqIUm5s50b11Y', 'http://localhost', 1, 0, 0, '2017-03-05 16:21:06', '2017-03-05 16:21:06'),
(2, NULL, 'UNISA Password Grant Client', 'bnriNqfRGmY11hr8EuBgIKCuMtRFDipciSRQef2t', 'http://localhost', 0, 1, 0, '2017-03-05 16:21:06', '2017-03-05 16:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-03-05 16:21:06', '2017-03-05 16:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(6, 'Edit Page', 'edit-page', '2017-03-08 09:08:53', '2017-03-08 09:08:53'),
(7, 'View Page', 'view-page', '2017-03-08 09:08:56', '2017-03-08 09:08:56'),
(8, 'Create Page', 'create-page', '2017-03-08 09:08:58', '2017-03-08 09:08:58'),
(9, 'Delete Page', 'delete-page', '2017-03-08 09:09:03', '2017-03-08 09:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `permission_groups`
--

CREATE TABLE `permission_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_group_items`
--

CREATE TABLE `permission_group_items` (
  `permission_group_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `profile_sha256` char(64) NOT NULL,
  `profile_key` text NOT NULL,
  `key_id` int(11) NOT NULL,
  `displayname` text,
  `email` text,
  `locale` char(63) DEFAULT NULL,
  `subscribe` smallint(6) DEFAULT NULL,
  `json` text,
  `login_at` datetime DEFAULT NULL,
  `entity_version` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `psw_services_available`
--

CREATE TABLE `psw_services_available` (
  `service_id` int(10) UNSIGNED NOT NULL,
  `service_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `psw_services_linked`
--

CREATE TABLE `psw_services_linked` (
  `service_link_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(4, 'Instructor', 'instructor', '2017-03-08 06:36:33', '2017-03-08 06:36:33'),
(5, 'Learner', 'learner', '2017-03-08 07:40:35', '2017-03-08 07:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `permission_id`) VALUES
(4, 6),
(4, 7),
(5, 7),
(4, 8),
(4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `storylines`
--

CREATE TABLE `storylines` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL,
  `version` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storylines`
--

INSERT INTO `storylines` (`id`, `course_id`, `creator_id`, `version`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '2017-03-20 08:15:16', '2017-03-20 08:15:16'),
(2, 1, 1, NULL, '2017-03-20 08:59:26', '2017-03-20 08:59:26'),
(3, 1, 1, NULL, '2017-03-20 09:00:02', '2017-03-20 09:00:02'),
(4, 1, 1, NULL, '2017-03-20 09:00:28', '2017-03-20 09:00:28'),
(5, 1, 1, NULL, '2017-03-20 09:01:08', '2017-03-20 09:01:08'),
(6, 2, 1, NULL, '2017-03-20 09:03:46', '2017-03-20 09:03:46'),
(7, 3, 1, NULL, '2017-03-20 14:40:09', '2017-03-20 14:40:09'),
(8, 3, 1, NULL, '2017-03-20 14:42:16', '2017-03-20 14:42:16'),
(9, 3, 1, NULL, '2017-03-20 14:42:19', '2017-03-20 14:42:19'),
(10, 3, 1, NULL, '2017-03-20 14:43:40', '2017-03-20 14:43:40'),
(11, 3, 1, NULL, '2017-03-20 14:43:54', '2017-03-20 14:43:54'),
(12, 3, 1, NULL, '2017-03-21 06:04:48', '2017-03-21 06:04:48'),
(13, 4, 1, NULL, '2017-03-22 04:18:10', '2017-03-22 04:18:10'),
(14, 4, 1, NULL, '2017-03-22 04:42:40', '2017-03-22 04:42:40'),
(15, 4, 11, NULL, '2017-03-22 07:03:34', '2017-03-22 07:03:34'),
(16, 5, 1, NULL, '2017-03-23 04:15:04', '2017-03-23 04:15:04'),
(17, 6, 12, NULL, '2017-03-23 07:33:44', '2017-03-23 07:33:44'),
(18, 6, 13, NULL, '2017-03-23 07:34:28', '2017-03-23 07:34:28'),
(19, 6, 13, NULL, '2017-03-23 10:59:41', '2017-03-23 10:59:41'),
(20, 7, 12, NULL, '2017-03-23 12:32:30', '2017-03-23 12:32:30'),
(21, 7, 12, NULL, '2017-03-23 12:49:09', '2017-03-23 12:49:09'),
(22, 7, 14, NULL, '2017-04-03 21:40:12', '2017-04-03 21:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `storyline_items`
--

CREATE TABLE `storyline_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `storyline_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` longtext COLLATE utf8mb4_unicode_ci,
  `file_url` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storyline_items`
--

INSERT INTO `storyline_items` (`id`, `parent_id`, `storyline_id`, `type`, `name`, `description`, `file_name`, `file_url`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'group', 'Part 1', NULL, NULL, NULL, '2017-03-20 08:15:16', '2017-03-20 08:15:16'),
(2, 1, 1, 'content', 'Content 1', NULL, '1029.html', '/EON/system/public/vendor/storyline/core/files/html/1029.html', '2017-03-20 08:15:16', '2017-03-20 08:15:16'),
(3, NULL, 1, 'group', 'Part 2', NULL, NULL, NULL, '2017-03-20 08:15:16', '2017-03-20 08:15:16'),
(4, 3, 1, 'content', 'Content 2', NULL, '1032.html', '/EON/system/public/vendor/storyline/core/files/html/1032.html', '2017-03-20 08:15:16', '2017-03-20 08:15:16'),
(5, NULL, 2, 'group', 'Part 1.1', NULL, NULL, NULL, '2017-03-20 08:59:26', '2017-03-20 08:59:26'),
(6, 5, 2, 'content', 'Content 1.1', NULL, '1029.html', '/EON/system/public/vendor/storyline/core/files/html/1029.html', '2017-03-20 08:59:26', '2017-03-20 08:59:26'),
(7, NULL, 2, 'group', 'Part 2.2', NULL, NULL, NULL, '2017-03-20 08:59:26', '2017-03-20 08:59:26'),
(8, 7, 2, 'content', 'Content 2.2', NULL, '1032.html', '/EON/system/public/vendor/storyline/core/files/html/1032.html', '2017-03-20 08:59:26', '2017-03-20 08:59:26'),
(9, NULL, 3, 'group', 'Part 1.1', NULL, NULL, NULL, '2017-03-20 09:00:02', '2017-03-20 09:00:02'),
(10, 9, 3, 'content', 'Content 1.1', NULL, '1029.html', '/EON/system/public/vendor/storyline/core/files/html/1029.html', '2017-03-20 09:00:02', '2017-03-20 09:00:02'),
(11, NULL, 3, 'group', 'Part 2.2', NULL, NULL, NULL, '2017-03-20 09:00:02', '2017-03-20 09:00:02'),
(12, 11, 3, 'content', 'Content 2.2', NULL, '1032.html', '/EON/system/public/vendor/storyline/core/files/html/1032.html', '2017-03-20 09:00:02', '2017-03-20 09:00:02'),
(13, NULL, 3, 'group', 'Group Final', NULL, NULL, NULL, '2017-03-20 09:00:02', '2017-03-20 09:00:02'),
(14, 13, 3, 'content', 'Content Hey', NULL, '1036.html', '/EON/system/public/vendor/storyline/core/files/html/1036.html', '2017-03-20 09:00:02', '2017-03-20 09:00:02'),
(15, NULL, 4, 'group', 'Part 1.1', NULL, NULL, NULL, '2017-03-20 09:00:28', '2017-03-20 09:00:28'),
(16, 15, 4, 'content', 'Content 1.1', NULL, '1029.html', '/EON/system/public/vendor/storyline/core/files/html/1029.html', '2017-03-20 09:00:28', '2017-03-20 09:00:28'),
(17, NULL, 4, 'group', 'Group Final', NULL, NULL, NULL, '2017-03-20 09:00:28', '2017-03-20 09:00:28'),
(18, 17, 4, 'content', 'Content Hey', NULL, '1036.html', '/EON/system/public/vendor/storyline/core/files/html/1036.html', '2017-03-20 09:00:28', '2017-03-20 09:00:28'),
(19, NULL, 4, 'group', 'Part 2.2', NULL, NULL, NULL, '2017-03-20 09:00:28', '2017-03-20 09:00:28'),
(20, 19, 4, 'content', 'Content 2.2', NULL, '1032.html', '/EON/system/public/vendor/storyline/core/files/html/1032.html', '2017-03-20 09:00:28', '2017-03-20 09:00:28'),
(21, NULL, 5, 'group', 'Part 1.1', NULL, NULL, NULL, '2017-03-20 09:01:08', '2017-03-20 09:01:08'),
(22, 21, 5, 'content', 'Content 1.1', NULL, '1029.html', '/EON/system/public/vendor/storyline/core/files/html/1029.html', '2017-03-20 09:01:08', '2017-03-20 09:01:08'),
(23, 21, 5, 'group', 'Group Sub 1.1.1', NULL, NULL, NULL, '2017-03-20 09:01:08', '2017-03-20 09:01:08'),
(24, 23, 5, 'group', 'Group Sub Sub 1.1.1.1', NULL, NULL, NULL, '2017-03-20 09:01:08', '2017-03-20 09:01:08'),
(25, 24, 5, 'content', 'Content For sub sub', NULL, '1096.html', '/EON/system/public/vendor/storyline/core/files/html/1096.html', '2017-03-20 09:01:08', '2017-03-20 09:01:08'),
(26, NULL, 5, 'group', 'Group Final', NULL, NULL, NULL, '2017-03-20 09:01:08', '2017-03-20 09:01:08'),
(27, 26, 5, 'content', 'Content Hey', NULL, '1036.html', '/EON/system/public/vendor/storyline/core/files/html/1036.html', '2017-03-20 09:01:08', '2017-03-20 09:01:08'),
(28, NULL, 5, 'group', 'Part 2.2', NULL, NULL, NULL, '2017-03-20 09:01:08', '2017-03-20 09:01:08'),
(29, 28, 5, 'content', 'Content 2.2', NULL, '1032.html', '/EON/system/public/vendor/storyline/core/files/html/1032.html', '2017-03-20 09:01:08', '2017-03-20 09:01:08'),
(30, NULL, 6, 'group', 'Default Group ', NULL, NULL, NULL, '2017-03-20 09:03:46', '2017-03-20 09:03:46'),
(31, 30, 6, 'content', 'Page 1', NULL, '1032.html', '/EON/system/public/vendor/storyline/core/files/html/1032.html', '2017-03-20 09:03:46', '2017-03-20 09:03:46'),
(32, NULL, 7, 'group', 'Group', NULL, NULL, NULL, '2017-03-20 14:40:09', '2017-03-20 14:40:09'),
(33, 32, 7, 'content', 'Content', NULL, '1490027955.html', '/EON/system/public/vendor/storyline/core/files/content/1490027955.html', '2017-03-20 14:40:09', '2017-03-20 14:40:09'),
(34, NULL, 8, 'group', 'Group', NULL, NULL, NULL, '2017-03-20 14:42:16', '2017-03-20 14:42:16'),
(35, 34, 8, 'content', 'Content', NULL, '1490027955.html', '/EON/system/public/vendor/storyline/core/files/content/1490027955.html', '2017-03-20 14:42:16', '2017-03-20 14:42:16'),
(36, NULL, 9, 'group', 'Group', NULL, NULL, NULL, '2017-03-20 14:42:19', '2017-03-20 14:42:19'),
(37, 36, 9, 'content', 'Content', NULL, '1490027955.html', '/EON/system/public/vendor/storyline/core/files/content/1490027955.html', '2017-03-20 14:42:19', '2017-03-20 14:42:19'),
(38, NULL, 10, 'group', 'Group', NULL, NULL, NULL, '2017-03-20 14:43:40', '2017-03-20 14:43:40'),
(39, 38, 10, 'content', 'Content', NULL, '1490027955.html', '/EON/system/public/vendor/storyline/core/files/content/1490027955.html', '2017-03-20 14:43:40', '2017-03-20 14:43:40'),
(40, NULL, 11, 'group', 'Group', NULL, NULL, NULL, '2017-03-20 14:43:54', '2017-03-20 14:43:54'),
(41, 40, 11, 'content', 'Content', NULL, '1490027955.html', '/EON/system/public/vendor/storyline/core/files/content/1490027955.html', '2017-03-20 14:43:54', '2017-03-20 14:43:54'),
(42, NULL, 12, 'group', 'Group', NULL, NULL, NULL, '2017-03-21 06:04:48', '2017-03-21 06:04:48'),
(43, 42, 12, 'content', 'Content', NULL, '1490027955.html', '/EON/system/public/vendor/storyline/core/files/content/1490027955.html', '2017-03-21 06:04:48', '2017-03-21 06:04:48'),
(44, 42, 12, 'content', 'With LTI', NULL, '1490083450.html', '/EON/system/public/vendor/storyline/core/files/content/1490083450.html', '2017-03-21 06:04:48', '2017-03-21 06:04:48'),
(45, NULL, 13, 'content', 'Asumptions', NULL, 'PPC-Assumptions.html', '/EON/system/public/vendor/storyline/core/files/content/PPC-Assumptions.html', '2017-03-22 04:18:10', '2017-03-22 04:18:10'),
(46, NULL, 14, 'content', 'Asumptions', NULL, 'PPC-Assumptions.html', '/EON/system/public/vendor/storyline/core/files/content/PPC-Assumptions.html', '2017-03-22 04:42:40', '2017-03-22 04:42:40'),
(47, NULL, 14, 'content', 'A Production Possibilities Table', NULL, 'A-PPC-Table.html', '/EON/system/public/vendor/storyline/core/files/content/A-PPC-Table.html', '2017-03-22 04:42:40', '2017-03-22 04:42:40'),
(48, NULL, 15, 'content', 'Asumptions', NULL, 'PPC-Assumptions.html', '/EON/system/public/vendor/storyline/core/files/content/PPC-Assumptions.html', '2017-03-22 07:03:34', '2017-03-22 07:03:34'),
(49, NULL, 15, 'content', 'A Production Possibilities Table', NULL, 'A-PPC-Table.html', '/EON/system/public/vendor/storyline/core/files/content/A-PPC-Table.html', '2017-03-22 07:03:34', '2017-03-22 07:03:34'),
(50, NULL, 15, 'content', 'New File', NULL, 'new-file.html', '/EON/system/public/vendor/storyline/core/files/content/new-file.html', '2017-03-22 07:03:34', '2017-03-22 07:03:34'),
(51, NULL, 16, 'content', 'Introduction', NULL, 'Supply-Intro-to-supply.html', '/EON/system/public/vendor/storyline/core/files/content/Supply-Intro-to-supply.html', '2017-03-23 04:15:04', '2017-03-23 04:15:04'),
(52, NULL, 16, 'group', 'Demand', NULL, NULL, NULL, '2017-03-23 04:15:04', '2017-03-23 04:15:04'),
(53, 52, 16, 'content', 'An Economic\'s definition of demand', NULL, 'Demand-an-economists-definition-of-demand.html', '/EON/system/public/vendor/storyline/core/files/content/Demand-an-economists-definition-of-demand.html', '2017-03-23 04:15:04', '2017-03-23 04:15:04'),
(54, 52, 16, 'content', 'Factors that determine the demand for goods', NULL, 'Demand-Factors-that-determine-the-demand-for-goods.html', '/EON/system/public/vendor/storyline/core/files/content/Demand-Factors-that-determine-the-demand-for-goods.html', '2017-03-23 04:15:04', '2017-03-23 04:15:04'),
(55, NULL, 16, 'group', 'Supply', NULL, NULL, NULL, '2017-03-23 04:15:04', '2017-03-23 04:15:04'),
(56, 55, 16, 'content', 'Introduction to supply', NULL, 'Supply-Intro-to-supply.html', '/EON/system/public/vendor/storyline/core/files/content/Supply-Intro-to-supply.html', '2017-03-23 04:15:04', '2017-03-23 04:15:04'),
(57, 55, 16, 'content', 'Factors that influence supply', NULL, 'Supply-factors-that-influence-supply.html', '/EON/system/public/vendor/storyline/core/files/content/Supply-factors-that-influence-supply.html', '2017-03-23 04:15:04', '2017-03-23 04:15:04'),
(58, NULL, 17, 'content', 'Intro', NULL, 'Supply-Intro-to-supply.html', '/EON/system/public/vendor/storyline/core/files/content/Supply-Intro-to-supply.html', '2017-03-23 07:33:44', '2017-03-23 07:33:44'),
(59, NULL, 17, 'group', 'Demand', NULL, NULL, NULL, '2017-03-23 07:33:44', '2017-03-23 07:33:44'),
(60, 59, 17, 'content', 'Definition', NULL, 'Demand-an-economists-definition-of-demand.html', '/EON/system/public/vendor/storyline/core/files/content/Demand-an-economists-definition-of-demand.html', '2017-03-23 07:33:44', '2017-03-23 07:33:44'),
(61, 59, 17, 'content', 'Factors', NULL, 'Demand-Factors-that-determine-the-demand-for-goods.html', '/EON/system/public/vendor/storyline/core/files/content/Demand-Factors-that-determine-the-demand-for-goods.html', '2017-03-23 07:33:44', '2017-03-23 07:33:44'),
(62, NULL, 18, 'content', 'Intro', NULL, 'Supply-Intro-to-supply.html', '/EON/system/public/vendor/storyline/core/files/content/Supply-Intro-to-supply.html', '2017-03-23 07:34:28', '2017-03-23 07:34:28'),
(63, NULL, 18, 'group', 'Demand Group Dropdown', NULL, NULL, NULL, '2017-03-23 07:34:28', '2017-03-23 07:34:28'),
(64, 63, 18, 'content', 'Definition', NULL, 'Demand-an-economists-definition-of-demand.html', '/EON/system/public/vendor/storyline/core/files/content/Demand-an-economists-definition-of-demand.html', '2017-03-23 07:34:28', '2017-03-23 07:34:28'),
(65, 63, 18, 'content', 'Factors', NULL, 'Demand-Factors-that-determine-the-demand-for-goods.html', '/EON/system/public/vendor/storyline/core/files/content/Demand-Factors-that-determine-the-demand-for-goods.html', '2017-03-23 07:34:28', '2017-03-23 07:34:28'),
(66, NULL, 19, 'content', 'New', NULL, 'new.html', '/EON/system/public/vendor/storyline/core/files/content/new.html', '2017-03-23 10:59:41', '2017-03-23 10:59:41'),
(67, NULL, 19, 'content', 'Intro', NULL, 'Supply-Intro-to-supply.html', '/EON/system/public/vendor/storyline/core/files/content/Supply-Intro-to-supply.html', '2017-03-23 10:59:41', '2017-03-23 10:59:41'),
(68, NULL, 19, 'group', 'Demand Group Dropdown', NULL, NULL, NULL, '2017-03-23 10:59:41', '2017-03-23 10:59:41'),
(69, 68, 19, 'content', 'Definition', NULL, 'Demand-an-economists-definition-of-demand.html', '/EON/system/public/vendor/storyline/core/files/content/Demand-an-economists-definition-of-demand.html', '2017-03-23 10:59:41', '2017-03-23 10:59:41'),
(70, 68, 19, 'content', 'Factors', NULL, 'Demand-Factors-that-determine-the-demand-for-goods.html', '/EON/system/public/vendor/storyline/core/files/content/Demand-Factors-that-determine-the-demand-for-goods.html', '2017-03-23 10:59:41', '2017-03-23 10:59:41'),
(71, NULL, 20, 'content', 'Introduction', NULL, NULL, NULL, '2017-03-23 12:32:30', '2017-03-23 12:32:30'),
(72, NULL, 20, 'group', 'Topic 1', NULL, NULL, NULL, '2017-03-23 12:32:30', '2017-03-23 12:32:30'),
(73, 72, 20, 'content', 'Page 1', NULL, NULL, NULL, '2017-03-23 12:32:30', '2017-03-23 12:32:30'),
(74, 72, 20, 'content', 'Page 2', NULL, NULL, NULL, '2017-03-23 12:32:30', '2017-03-23 12:32:30'),
(75, 72, 20, 'group', 'Sub Topic 1', NULL, NULL, NULL, '2017-03-23 12:32:30', '2017-03-23 12:32:30'),
(76, 75, 20, 'content', 'Sub Topic Page 1', NULL, NULL, NULL, '2017-03-23 12:32:30', '2017-03-23 12:32:30'),
(77, NULL, 21, 'content', 'Introduction', NULL, 'Demo-Intro.html', '/EON/system/public/vendor/storyline/core/files/content/Demo-Intro.html', '2017-03-23 12:49:09', '2017-03-23 12:49:09'),
(78, NULL, 21, 'group', 'Topic 1', NULL, NULL, NULL, '2017-03-23 12:49:09', '2017-03-23 12:49:09'),
(79, 78, 21, 'content', 'Page 1', NULL, 'demo-page1.html', '/EON/system/public/vendor/storyline/core/files/content/demo-page1.html', '2017-03-23 12:49:09', '2017-03-23 12:49:09'),
(80, 78, 21, 'content', 'Page 2', NULL, 'demo-page2.html', '/EON/system/public/vendor/storyline/core/files/content/demo-page2.html', '2017-03-23 12:49:09', '2017-03-23 12:49:09'),
(81, 78, 21, 'group', 'Sub Topic 1', NULL, NULL, NULL, '2017-03-23 12:49:09', '2017-03-23 12:49:09'),
(82, 81, 21, 'content', 'Sub Topic Page 1', NULL, 'demo-sub-topic-page-1.html', '/EON/system/public/vendor/storyline/core/files/content/demo-sub-topic-page-1.html', '2017-03-23 12:49:09', '2017-03-23 12:49:09'),
(83, NULL, 22, 'content', 'Introduction', NULL, NULL, NULL, '2017-04-03 21:40:12', '2017-04-03 21:40:12'),
(84, NULL, 22, 'group', 'Topic 1', NULL, NULL, NULL, '2017-04-03 21:40:13', '2017-04-03 21:40:13'),
(85, 84, 22, 'content', 'Page 1', NULL, 'demo-page1.html', '/EON/system/public/vendor/storyline/core/files/content/demo-page1.html', '2017-04-03 21:40:13', '2017-04-03 21:40:13'),
(86, 84, 22, 'content', 'Page 2', NULL, 'demo-page2.html', '/EON/system/public/vendor/storyline/core/files/content/demo-page2.html', '2017-04-03 21:40:13', '2017-04-03 21:40:13'),
(87, 84, 22, 'group', 'Sub Topic 1', NULL, NULL, NULL, '2017-04-03 21:40:13', '2017-04-03 21:40:13'),
(88, 87, 22, 'content', 'Sub Topic Page 1', NULL, 'demo-sub-topic-page-1.html', '/EON/system/public/vendor/storyline/core/files/content/demo-sub-topic-page-1.html', '2017-04-03 21:40:13', '2017-04-03 21:40:13'),
(89, NULL, 22, 'content', 'Content', NULL, NULL, NULL, '2017-04-03 21:40:13', '2017-04-03 21:40:13'),
(90, NULL, 22, 'group', 'Group', NULL, NULL, NULL, '2017-04-03 21:40:13', '2017-04-03 21:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Josh', 'josh1@live.co.za', '$2y$10$u0OFR/Q/Z/ea0l6QwObQAuMMR9RcEGph1CHsmZKt1eJOTVej4DQka', 'I4bSD0RbgCjpPJQ7wSMTpzEN2jdpH6fgAjke3ZLDi3CHmYeKr5EQKrZW5Op4', '2017-03-05 16:21:32', '2017-03-05 16:21:32'),
(11, 'Ed Student', 'ed@ischool.edu', NULL, NULL, '2017-03-07 21:54:57', '2017-03-07 21:54:57'),
(12, 'Jane Instructor23', 'inst@ischool.edu', '$2y$10$LPH005YbRDaEGVUMiHySfemvHrlyXmPeJHXrb2/WaHXEKR6.HXfh.', NULL, '2017-03-07 22:06:40', '2017-03-08 23:06:02'),
(13, 'Sue Student', 'student@ischool.edu', NULL, NULL, '2017-03-07 22:11:50', '2017-03-07 22:11:50'),
(14, 'Peace', 'peacengara@aol.com', '$2y$10$SJZrGu45YErRuo2Ys5E1qOclP07MbxRNFvTosTTRekpI48Nz3gyri', NULL, '2017-04-03 13:50:03', '2017-04-03 13:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `users_lti_links`
--

CREATE TABLE `users_lti_links` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `lti_user_id` int(10) UNSIGNED NOT NULL,
  `context_id` int(10) UNSIGNED NOT NULL,
  `lis_person_contact_email_primary` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lis_person_name_family` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lis_person_name_full` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lis_person_name_given` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lis_person_sourcedid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lis_result_sourcedid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_lti_links`
--

INSERT INTO `users_lti_links` (`id`, `user_id`, `lti_user_id`, `context_id`, `lis_person_contact_email_primary`, `lis_person_name_family`, `lis_person_name_full`, `lis_person_name_given`, `lis_person_sourcedid`, `lis_result_sourcedid`, `roles`, `created_at`, `updated_at`) VALUES
(10, 11, 121212331, 456434513, 'ed@ischool.edu', 'Student', 'Ed Student', 'Ed', 'ischool.edu:ed', 'd92dc727b3c069898d06e1f0fec491b1', 'Learner', '2017-03-07 21:54:57', '2017-03-07 21:54:57'),
(11, 12, 292832126, 456434513, 'inst@ischool.edu', 'Instructor', 'Jane Instructor', 'Jane', 'ischool.edu:inst', 'eba99f886a944318b11234787c1bd636', 'Instructor', '2017-03-07 22:06:40', '2017-03-07 22:06:40'),
(12, 13, 998928898, 456434513, 'student@ischool.edu', 'Student', 'Sue Student', 'Sue', 'ischool.edu:student', '26e988d4c7312a8b49dfa8deb9faa5ee', 'Learner', '2017-03-07 22:11:50', '2017-03-07 22:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `has_permission` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blob_file`
--
ALTER TABLE `blob_file`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `blob_indx_1` (`file_sha256`) USING HASH,
  ADD KEY `blob_ibfk_1` (`context_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_users`
--
ALTER TABLE `course_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `graphs`
--
ALTER TABLE `graphs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`);

--
-- Indexes for table `key_request`
--
ALTER TABLE `key_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `key_request_fk_1` (`user_id`);

--
-- Indexes for table `lms_plugins`
--
ALTER TABLE `lms_plugins`
  ADD PRIMARY KEY (`plugin_id`),
  ADD UNIQUE KEY `plugin_path` (`plugin_path`);

--
-- Indexes for table `lti2_consumer`
--
ALTER TABLE `lti2_consumer`
  ADD PRIMARY KEY (`consumer_pk`),
  ADD UNIQUE KEY `lti2_consumer_consumer_key256_unique` (`consumer_key256`);

--
-- Indexes for table `lti2_context`
--
ALTER TABLE `lti2_context`
  ADD PRIMARY KEY (`context_pk`),
  ADD KEY `lti2_context_consumer_pk_index` (`consumer_pk`);

--
-- Indexes for table `lti2_nonce`
--
ALTER TABLE `lti2_nonce`
  ADD PRIMARY KEY (`consumer_pk`,`value`);

--
-- Indexes for table `lti2_resource_link`
--
ALTER TABLE `lti2_resource_link`
  ADD PRIMARY KEY (`resource_link_pk`),
  ADD KEY `lti2_resource_link_context_pk_index` (`context_pk`),
  ADD KEY `lti2_resource_link_consumer_pk_index` (`consumer_pk`);

--
-- Indexes for table `lti2_share_key`
--
ALTER TABLE `lti2_share_key`
  ADD PRIMARY KEY (`share_key_id`),
  ADD KEY `lti2_share_key_resource_link_pk_index` (`resource_link_pk`);

--
-- Indexes for table `lti2_tool_proxy`
--
ALTER TABLE `lti2_tool_proxy`
  ADD PRIMARY KEY (`tool_proxy_pk`),
  ADD KEY `lti2_tool_proxy_tool_proxy_id_index` (`tool_proxy_id`),
  ADD KEY `lti2_tool_proxy_consumer_pk_index` (`consumer_pk`);

--
-- Indexes for table `lti2_user_result`
--
ALTER TABLE `lti2_user_result`
  ADD PRIMARY KEY (`user_pk`),
  ADD KEY `lti2_user_result_resource_link_pk_index` (`resource_link_pk`);

--
-- Indexes for table `lti_context`
--
ALTER TABLE `lti_context`
  ADD PRIMARY KEY (`context_id`),
  ADD UNIQUE KEY `key_id` (`key_id`,`context_sha256`);

--
-- Indexes for table `lti_domain`
--
ALTER TABLE `lti_domain`
  ADD UNIQUE KEY `key_id` (`key_id`,`context_id`) USING BTREE,
  ADD KEY `lti_domain_ibfk_2` (`context_id`);

--
-- Indexes for table `lti_key`
--
ALTER TABLE `lti_key`
  ADD PRIMARY KEY (`key_id`);

--
-- Indexes for table `lti_link`
--
ALTER TABLE `lti_link`
  ADD PRIMARY KEY (`link_id`),
  ADD UNIQUE KEY `link_sha256` (`link_sha256`,`context_id`),
  ADD KEY `lti_link_ibfk_1` (`context_id`);

--
-- Indexes for table `lti_membership`
--
ALTER TABLE `lti_membership`
  ADD PRIMARY KEY (`membership_id`),
  ADD UNIQUE KEY `context_id` (`context_id`,`user_id`),
  ADD KEY `lti_membership_ibfk_2` (`user_id`);

--
-- Indexes for table `lti_nonce`
--
ALTER TABLE `lti_nonce`
  ADD UNIQUE KEY `key_id` (`key_id`,`nonce`),
  ADD KEY `nonce_indx_1` (`nonce`) USING HASH;

--
-- Indexes for table `lti_result`
--
ALTER TABLE `lti_result`
  ADD PRIMARY KEY (`result_id`),
  ADD UNIQUE KEY `link_id` (`link_id`,`user_id`),
  ADD KEY `lti_result_ibfk_2` (`user_id`),
  ADD KEY `lti_result_ibfk_3` (`service_id`);

--
-- Indexes for table `lti_service`
--
ALTER TABLE `lti_service`
  ADD PRIMARY KEY (`service_id`),
  ADD UNIQUE KEY `key_id` (`key_id`,`service_sha256`);

--
-- Indexes for table `lti_user`
--
ALTER TABLE `lti_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `key_id` (`key_id`,`user_sha256`);

--
-- Indexes for table `mail_bulk`
--
ALTER TABLE `mail_bulk`
  ADD PRIMARY KEY (`bulk_id`),
  ADD KEY `mail_bulk_ibfk_1` (`context_id`),
  ADD KEY `mail_bulk_ibfk_2` (`user_id`);

--
-- Indexes for table `mail_sent`
--
ALTER TABLE `mail_sent`
  ADD PRIMARY KEY (`sent_id`),
  ADD KEY `mail_sent_ibfk_1` (`context_id`),
  ADD KEY `mail_sent_ibfk_2` (`link_id`),
  ADD KEY `mail_sent_ibfk_3` (`user_to`),
  ADD KEY `mail_sent_ibfk_4` (`user_from`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_groups`
--
ALTER TABLE `permission_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_group_items`
--
ALTER TABLE `permission_group_items`
  ADD PRIMARY KEY (`permission_group_id`),
  ADD KEY `permission_group_items_group_id_foreign` (`group_id`),
  ADD KEY `permission_group_items_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD UNIQUE KEY `profile_sha256` (`profile_sha256`),
  ADD UNIQUE KEY `profile_id` (`profile_id`,`profile_sha256`);

--
-- Indexes for table `psw_services_available`
--
ALTER TABLE `psw_services_available`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `psw_services_linked`
--
ALTER TABLE `psw_services_linked`
  ADD PRIMARY KEY (`service_link_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `roles_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `storylines`
--
ALTER TABLE `storylines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storyline_items`
--
ALTER TABLE `storyline_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_lti_links`
--
ALTER TABLE `users_lti_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`group_id`),
  ADD KEY `users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `users_permissions_group_id_foreign` (`group_id`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`,`group_id`),
  ADD KEY `users_roles_role_id_foreign` (`role_id`),
  ADD KEY `users_roles_group_id_foreign` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blob_file`
--
ALTER TABLE `blob_file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `course_users`
--
ALTER TABLE `course_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `graphs`
--
ALTER TABLE `graphs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;
--
-- AUTO_INCREMENT for table `key_request`
--
ALTER TABLE `key_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_plugins`
--
ALTER TABLE `lms_plugins`
  MODIFY `plugin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `lti2_consumer`
--
ALTER TABLE `lti2_consumer`
  MODIFY `consumer_pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lti2_context`
--
ALTER TABLE `lti2_context`
  MODIFY `context_pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lti2_resource_link`
--
ALTER TABLE `lti2_resource_link`
  MODIFY `resource_link_pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lti2_tool_proxy`
--
ALTER TABLE `lti2_tool_proxy`
  MODIFY `tool_proxy_pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lti2_user_result`
--
ALTER TABLE `lti2_user_result`
  MODIFY `user_pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lti_context`
--
ALTER TABLE `lti_context`
  MODIFY `context_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `lti_key`
--
ALTER TABLE `lti_key`
  MODIFY `key_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `lti_link`
--
ALTER TABLE `lti_link`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lti_membership`
--
ALTER TABLE `lti_membership`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `lti_result`
--
ALTER TABLE `lti_result`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `lti_service`
--
ALTER TABLE `lti_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lti_user`
--
ALTER TABLE `lti_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `mail_bulk`
--
ALTER TABLE `mail_bulk`
  MODIFY `bulk_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mail_sent`
--
ALTER TABLE `mail_sent`
  MODIFY `sent_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permission_group_items`
--
ALTER TABLE `permission_group_items`
  MODIFY `permission_group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `psw_services_available`
--
ALTER TABLE `psw_services_available`
  MODIFY `service_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `psw_services_linked`
--
ALTER TABLE `psw_services_linked`
  MODIFY `service_link_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `storylines`
--
ALTER TABLE `storylines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `storyline_items`
--
ALTER TABLE `storyline_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users_lti_links`
--
ALTER TABLE `users_lti_links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `blob_file`
--
ALTER TABLE `blob_file`
  ADD CONSTRAINT `blob_ibfk_1` FOREIGN KEY (`context_id`) REFERENCES `lti_context` (`context_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `key_request`
--
ALTER TABLE `key_request`
  ADD CONSTRAINT `key_request_fk_1` FOREIGN KEY (`user_id`) REFERENCES `lti_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lti_context`
--
ALTER TABLE `lti_context`
  ADD CONSTRAINT `lti_context_ibfk_1` FOREIGN KEY (`key_id`) REFERENCES `lti_key` (`key_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lti_domain`
--
ALTER TABLE `lti_domain`
  ADD CONSTRAINT `lti_domain_ibfk_1` FOREIGN KEY (`key_id`) REFERENCES `lti_key` (`key_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lti_domain_ibfk_2` FOREIGN KEY (`context_id`) REFERENCES `lti_context` (`context_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lti_link`
--
ALTER TABLE `lti_link`
  ADD CONSTRAINT `lti_link_ibfk_1` FOREIGN KEY (`context_id`) REFERENCES `lti_context` (`context_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lti_membership`
--
ALTER TABLE `lti_membership`
  ADD CONSTRAINT `lti_membership_ibfk_1` FOREIGN KEY (`context_id`) REFERENCES `lti_context` (`context_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lti_membership_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `lti_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lti_result`
--
ALTER TABLE `lti_result`
  ADD CONSTRAINT `lti_result_ibfk_1` FOREIGN KEY (`link_id`) REFERENCES `lti_link` (`link_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lti_result_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `lti_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lti_result_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `lti_service` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lti_service`
--
ALTER TABLE `lti_service`
  ADD CONSTRAINT `lti_service_ibfk_1` FOREIGN KEY (`key_id`) REFERENCES `lti_key` (`key_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lti_user`
--
ALTER TABLE `lti_user`
  ADD CONSTRAINT `lti_user_ibfk_1` FOREIGN KEY (`key_id`) REFERENCES `lti_key` (`key_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mail_bulk`
--
ALTER TABLE `mail_bulk`
  ADD CONSTRAINT `mail_bulk_ibfk_1` FOREIGN KEY (`context_id`) REFERENCES `lti_context` (`context_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mail_bulk_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `lti_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mail_sent`
--
ALTER TABLE `mail_sent`
  ADD CONSTRAINT `mail_sent_ibfk_1` FOREIGN KEY (`context_id`) REFERENCES `lti_context` (`context_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mail_sent_ibfk_2` FOREIGN KEY (`link_id`) REFERENCES `lti_link` (`link_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mail_sent_ibfk_3` FOREIGN KEY (`user_to`) REFERENCES `lti_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mail_sent_ibfk_4` FOREIGN KEY (`user_from`) REFERENCES `lti_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `permission_group_items`
--
ALTER TABLE `permission_group_items`
  ADD CONSTRAINT `permission_group_items_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `permission_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_group_items_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `roles_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD CONSTRAINT `users_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD CONSTRAINT `users_roles_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`ltiuser`@`localhost` EVENT `lti_nonce_auto` ON SCHEDULE EVERY 1 HOUR STARTS '2017-01-18 10:35:40' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM lti_nonce WHERE created_at < (UNIX_TIMESTAMP() - 3600)$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Adminer 4.8.1 MySQL 5.7.41 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

Drop database if exist `ebooks`;
CREATE DATABASE `ebooks` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ebooks`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors` (
                           `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                           `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `patronymic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `information` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `authors` (`id`, `surname`, `name`, `patronymic`, `information`, `created_at`, `updated_at`) VALUES
    (1,	'Пушкин',	'Александр',	'Сергеевич',	'Русский поэт, писатель',	'2023-03-19 04:01:57',	'2023-03-19 04:01:57');

DROP TABLE IF EXISTS `author_books`;
CREATE TABLE `author_books` (
                                `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                `author_id` bigint(20) unsigned DEFAULT NULL,
                                `book_id` bigint(20) unsigned DEFAULT NULL,
                                `created_at` timestamp NULL DEFAULT NULL,
                                `updated_at` timestamp NULL DEFAULT NULL,
                                PRIMARY KEY (`id`),
                                KEY `author_books_author_id_foreign` (`author_id`),
                                KEY `author_books_book_id_foreign` (`book_id`),
                                CONSTRAINT `author_books_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                                CONSTRAINT `author_books_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `author_books` (`id`, `author_id`, `book_id`, `created_at`, `updated_at`) VALUES
    (1,	1,	2,	'2023-03-26 18:48:08',	'2023-03-26 18:48:08');

DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE `bookmarks` (
                             `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                             `user_id` bigint(20) unsigned DEFAULT NULL,
                             `book_id` bigint(20) unsigned DEFAULT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL,
                             PRIMARY KEY (`id`),
                             KEY `bookmarks_user_id_foreign` (`user_id`),
                             KEY `bookmarks_book_id_foreign` (`book_id`),
                             CONSTRAINT `bookmarks_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                             CONSTRAINT `bookmarks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `bookmarks` (`id`, `user_id`, `book_id`, `created_at`, `updated_at`) VALUES
                                                                                     (26,	19,	2,	'2023-04-01 20:55:16',	'2023-04-01 20:55:16'),
                                                                                     (27,	19,	4,	'2023-04-03 10:44:24',	'2023-04-03 10:44:24');

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
                         `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                         `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `year_of_issue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `rating` double NOT NULL DEFAULT '0',
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `books` (`id`, `title`, `year_of_issue`, `image`, `file`, `rating`, `created_at`, `updated_at`) VALUES
                                                                                                                (2,	'Мастер и Маргарита',	'2019',	'images/books/RXrllYYZ2eQgrs94MFCjsbCWYmOD5YPIoPNSLn3K.jpg',	'books/SWh8of35zd2CYuy7f4MhaIfCN7dyq1ra5zMnchIl.epub',	4.6,	'2023-03-19 04:28:35',	'2023-03-19 05:03:52'),
                                                                                                                (3,	'Война и мир',	'1812',	'images/books/hqJJEnmrWS5kaux8rcauTPa4AabikvoOG15SYZbI.jpg',	'books/PcZAMIWF1d5A7q0BcHA8y14VLu1j0k83y1OyhzkX.epub',	5.4,	'2023-03-26 19:00:11',	'2023-04-03 19:02:11'),
                                                                                                                (4,	'Тихий дон',	'1924',	'images/books/V6OxB18yFEbxWLvDmNs93jyGf0COVyM2AIACAqUT.jpg',	'books/kxO4qdjHrW2i2gZWlpjxe2zTcU0aTw0tI5lRXHNA.epub',	5,	'2023-03-28 06:35:34',	'2023-04-03 16:47:33'),
                                                                                                                (5,	'Преступление и наказание',	'1900',	NULL,	'books/lPBb3LLPvQ6tHqJ66kBMue1mRQuIJz93w0fNteIz.epub',	8,	'2023-03-29 15:52:10',	'2023-04-03 18:35:52'),
                                                                                                                (6,	'Мертвые души',	'1844',	'images/books/BzRaCkI3Jx6hLUb2I4ooKyWyYFxDXrId0UXXO9yc.jpg',	'books/Tg1apQ6jV3sXImRyZL1BCEQaf1VewUC0gTKRmaLC.epub',	8,	'2023-03-29 15:53:02',	'2023-04-03 09:54:58');

DROP TABLE IF EXISTS `bookshelves`;
CREATE TABLE `bookshelves` (
                               `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                               `shelf_id` bigint(20) unsigned DEFAULT NULL,
                               `book_id` bigint(20) unsigned DEFAULT NULL,
                               `created_at` timestamp NULL DEFAULT NULL,
                               `updated_at` timestamp NULL DEFAULT NULL,
                               PRIMARY KEY (`id`),
                               KEY `bookshelves_shelf_id_foreign` (`shelf_id`),
                               KEY `bookshelves_book_id_foreign` (`book_id`),
                               CONSTRAINT `bookshelves_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                               CONSTRAINT `bookshelves_shelf_id_foreign` FOREIGN KEY (`shelf_id`) REFERENCES `shelves` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                              `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `batch` int(11) NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
                                                          (1,	'2014_10_12_000000_create_users_table',	1),
                                                          (2,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
                                                          (3,	'2023_03_17_181315_create_authors_table',	1),
                                                          (4,	'2023_03_17_181433_create_books_table',	1),
                                                          (5,	'2023_03_17_181545_create_shelves_table',	1),
                                                          (6,	'2023_03_17_181701_create_author_books_table',	1),
                                                          (7,	'2023_03_17_182137_create_bookshelves_table',	1),
                                                          (8,	'2023_03_17_182242_create_reviews_table',	1),
                                                          (9,	'2023_03_17_182415_create_bookmarks_table',	1),
                                                          (10,	'2023_03_17_182510_create_quotes_table',	1),
                                                          (11,	'2023_03_17_182640_create_moderators_table',	1),
                                                          (12,	'2023_03_20_182816_remove_user_password',	2);

DROP TABLE IF EXISTS `moderators`;
CREATE TABLE `moderators` (
                              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                              `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `created_at` timestamp NULL DEFAULT NULL,
                              `updated_at` timestamp NULL DEFAULT NULL,
                              PRIMARY KEY (`id`),
                              UNIQUE KEY `moderators_login_unique` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
                                          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                          `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `tokenable_id` bigint(20) unsigned NOT NULL,
                                          `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `abilities` text COLLATE utf8mb4_unicode_ci,
                                          `last_used_at` timestamp NULL DEFAULT NULL,
                                          `expires_at` timestamp NULL DEFAULT NULL,
                                          `created_at` timestamp NULL DEFAULT NULL,
                                          `updated_at` timestamp NULL DEFAULT NULL,
                                          PRIMARY KEY (`id`),
                                          UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
                                          KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
                                                                                                                                                                          (1,	'App\\Models\\User',	5,	'token',	'f844341eea242abd62bef9dc1ebf59f3fb655f6b74a04398bc0d8348651d514b',	'[\"*\"]',	'2023-03-18 09:42:18',	NULL,	'2023-03-18 09:18:05',	'2023-03-18 09:42:18'),
                                                                                                                                                                          (2,	'App\\Models\\User',	5,	'token',	'832be7c9532e7fbbd19e7547e9b004d9b84c83f5bd992cbe8cc94195842ae8b4',	'[\"*\"]',	'2023-03-18 09:29:31',	NULL,	'2023-03-18 09:29:24',	'2023-03-18 09:29:31'),
                                                                                                                                                                          (3,	'App\\Models\\User',	5,	'token',	'bc2dca685739a65205309b51d01cca083e41de071a42af6ad83a328b68874fa3',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 09:42:02',	'2023-03-18 09:42:02'),
                                                                                                                                                                          (4,	'App\\Models\\User',	5,	'token',	'540d2dde2c13475becac889b756ac1a6453301b45f2078b1a04241964932ab43',	'[\"*\"]',	'2023-03-18 09:44:56',	NULL,	'2023-03-18 09:44:12',	'2023-03-18 09:44:56'),
                                                                                                                                                                          (5,	'App\\Models\\User',	5,	'token',	'b8730a44cf66ebbcae92c42b0c114abe23fbe6b0f64ae8c4662c898647a7e141',	'[\"*\"]',	'2023-03-18 09:53:30',	NULL,	'2023-03-18 09:53:02',	'2023-03-18 09:53:30'),
                                                                                                                                                                          (6,	'App\\Models\\User',	5,	'token',	'38d368faeb5dd7510a196136bf1a76832f50f13c8cf1943b3ad20ef299901dc6',	'[\"*\"]',	'2023-03-18 13:48:45',	NULL,	'2023-03-18 09:53:45',	'2023-03-18 13:48:45'),
                                                                                                                                                                          (7,	'App\\Models\\User',	14,	'token',	'ce46b7614b92ec5de4483dd605f91bec046ce6865b7c5cf808f75ca6a63682a0',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 15:13:40',	'2023-03-18 15:13:40'),
                                                                                                                                                                          (8,	'App\\Models\\User',	14,	'token',	'e37bf4b0259cefa237a66b438ca9b124304c3d9c046f044b461bf58925e686b1',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 15:15:13',	'2023-03-18 15:15:13'),
                                                                                                                                                                          (9,	'App\\Models\\User',	14,	'token',	'b773c15b3a428bd42d93f1449a3e00a1e897267990a4c9528a1c882d802b636c',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 15:16:17',	'2023-03-18 15:16:17'),
                                                                                                                                                                          (10,	'App\\Models\\User',	14,	'token',	'5d81967506a54b6d5833916c5618969edeb2975d03746995e08b65506595ec92',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 15:16:47',	'2023-03-18 15:16:47'),
                                                                                                                                                                          (11,	'App\\Models\\User',	14,	'token',	'77affbe418f6ed0b417d09498a0797bf8a20fe0ed44e68f2a777df841b524b1f',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 15:17:03',	'2023-03-18 15:17:03'),
                                                                                                                                                                          (12,	'App\\Models\\User',	14,	'token',	'13b85b1c43574ed9df0c982c6aa4690776fb1ae301976b3d061d21df76994baf',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 15:17:24',	'2023-03-18 15:17:24'),
                                                                                                                                                                          (13,	'App\\Models\\User',	14,	'token',	'66ff2beb77c81f1fe4e1d98a3c2f1f37550772aa13192077c415c049337e4b5c',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 15:18:04',	'2023-03-18 15:18:04'),
                                                                                                                                                                          (14,	'App\\Models\\User',	14,	'token',	'd600f3bad93a92ce349266a9faca05643761f4f50eec00b5ed48d40dcc8b6e92',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 15:19:04',	'2023-03-18 15:19:04'),
                                                                                                                                                                          (15,	'App\\Models\\User',	14,	'token',	'fc6d6abb6e6dacd65c10c5431b5bacfc40dc330e0045de4b7f504163aa332cd3',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 15:23:18',	'2023-03-18 15:23:18'),
                                                                                                                                                                          (16,	'App\\Models\\User',	14,	'token',	'd5feb872a4327ebaae16a305497afdc8e75d0232cdcd936b9ef3a17a2d6e5b0d',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 15:25:59',	'2023-03-18 15:25:59'),
                                                                                                                                                                          (17,	'App\\Models\\User',	14,	'token',	'5ead33a3b4b4dac61aed5c10b96ae286944a6fdf8a59beaf7042c99dd67ea002',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 15:27:59',	'2023-03-18 15:27:59'),
                                                                                                                                                                          (18,	'App\\Models\\User',	15,	'token',	'5cbbf33f2f05c90646c4209bfafc1468190ee344a63e19de29bb4d9a1bb3a56e',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 15:31:24',	'2023-03-18 15:31:24'),
                                                                                                                                                                          (19,	'App\\Models\\User',	15,	'token',	'0f66b66c23c01522cebff198737e7b94034f101eb083b1d58facc0ea0bf5e9e9',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 15:35:49',	'2023-03-18 15:35:49'),
                                                                                                                                                                          (20,	'App\\Models\\User',	17,	'token',	'4469815d07790ba1a71f267245d0d3cd9a49a3587dff7fe294ce8c51cc3b307a',	'[\"*\"]',	NULL,	NULL,	'2023-03-18 16:57:31',	'2023-03-18 16:57:31'),
                                                                                                                                                                          (21,	'App\\Models\\User',	17,	'token',	'967972e172ce9d18f25149abaefb9b8e5f65b59fd77a4cafba0496f4348459cf',	'[\"*\"]',	'2023-03-18 16:57:56',	NULL,	'2023-03-18 16:57:47',	'2023-03-18 16:57:56'),
                                                                                                                                                                          (22,	'App\\Models\\User',	19,	'token',	'48122f077082110b34886920da11cfbf5410b6ec9cbfc2be1b7d8293376016ef',	'[\"*\"]',	'2023-03-28 06:44:32',	NULL,	'2023-03-19 03:55:26',	'2023-03-28 06:44:32'),
                                                                                                                                                                          (23,	'App\\Models\\User',	19,	'token',	'eed6f64554bcc7aa713bd8fb6e181ed00aac6b395995d8817541a61827ff40c7',	'[\"*\"]',	NULL,	NULL,	'2023-03-25 11:11:18',	'2023-03-25 11:11:18'),
                                                                                                                                                                          (24,	'App\\Models\\User',	19,	'token',	'6c96d07ae8f2d85f3115ac7d75a4e615f21ed0371afac10eac90599a526ed26a',	'[\"*\"]',	NULL,	NULL,	'2023-03-25 11:38:20',	'2023-03-25 11:38:20'),
                                                                                                                                                                          (25,	'App\\Models\\User',	19,	'token',	'5746c7652939177d2f42b8d7b7d23eed716d6a347723211bbc5aa4de537c35f0',	'[\"*\"]',	NULL,	NULL,	'2023-03-25 11:41:42',	'2023-03-25 11:41:42'),
                                                                                                                                                                          (26,	'App\\Models\\User',	19,	'token',	'232736299ee957008ca2e1aeac7debd823e120c6159f436875eb928f07f4eb55',	'[\"*\"]',	'2023-04-03 19:02:10',	NULL,	'2023-03-26 17:25:22',	'2023-04-03 19:02:10');

DROP TABLE IF EXISTS `quotes`;
CREATE TABLE `quotes` (
                          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                          `user_id` bigint(20) unsigned DEFAULT NULL,
                          `book_id` bigint(20) unsigned DEFAULT NULL,
                          `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `created_at` timestamp NULL DEFAULT NULL,
                          `updated_at` timestamp NULL DEFAULT NULL,
                          PRIMARY KEY (`id`),
                          KEY `quotes_user_id_foreign` (`user_id`),
                          KEY `quotes_book_id_foreign` (`book_id`),
                          CONSTRAINT `quotes_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                          CONSTRAINT `quotes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
                           `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                           `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `book_id` bigint(20) unsigned DEFAULT NULL,
                           `user_id` bigint(20) unsigned DEFAULT NULL,
                           `rating` int(11) NOT NULL,
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`),
                           KEY `reviews_book_id_foreign` (`book_id`),
                           KEY `reviews_user_id_foreign` (`user_id`),
                           CONSTRAINT `reviews_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                           CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `reviews` (`id`, `description`, `book_id`, `user_id`, `rating`, `created_at`, `updated_at`) VALUES
                                                                                                            (1,	'Очень крутая книга',	6,	20,	8,	'2023-04-03 07:04:11',	'2023-04-03 07:04:11'),
                                                                                                            (3,	'ввввв',	4,	19,	5,	'2023-04-03 16:47:33',	'2023-04-03 16:47:33'),
                                                                                                            (4,	'аккке',	3,	19,	6,	'2023-04-03 17:04:33',	'2023-04-03 17:04:33'),
                                                                                                            (5,	'ррр',	3,	19,	5,	'2023-04-03 18:06:29',	'2023-04-03 18:06:29'),
                                                                                                            (6,	'ллллл',	5,	19,	8,	'2023-04-03 18:35:52',	'2023-04-03 18:35:52'),
                                                                                                            (7,	'ллллл',	5,	19,	8,	'2023-04-03 18:36:09',	'2023-04-03 18:36:09'),
                                                                                                            (8,	'ннее',	3,	19,	3,	'2023-04-03 18:46:28',	'2023-04-03 18:46:28'),
                                                                                                            (9,	'лву',	3,	19,	5,	'2023-04-03 18:58:17',	'2023-04-03 18:58:17'),
                                                                                                            (10,	'лву',	3,	19,	8,	'2023-04-03 19:02:10',	'2023-04-03 19:02:10');

DROP TABLE IF EXISTS `shelves`;
CREATE TABLE `shelves` (
                           `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                           `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `user_id` bigint(20) unsigned DEFAULT NULL,
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`),
                           KEY `shelves_user_id_foreign` (`user_id`),
                           CONSTRAINT `shelves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `shelves` (`id`, `title`, `user_id`, `created_at`, `updated_at`) VALUES
                                                                                 (1,	'Классика',	19,	'2023-04-02 07:34:12',	'2023-04-02 07:34:12'),
                                                                                 (17,	'тттттт',	19,	'2023-04-02 13:08:57',	'2023-04-02 13:08:57');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                         `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `patronymic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email_verified_at` timestamp NULL DEFAULT NULL,
                         `is_verified` tinyint(1) NOT NULL DEFAULT '0',
                         `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `users_username_unique` (`username`),
                         UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `surname`, `name`, `patronymic`, `username`, `email`, `email_verified_at`, `is_verified`, `remember_token`, `created_at`, `updated_at`) VALUES
                                                                                                                                                                       (19,	'Гришин',	'Павел',	NULL,	'pav5',	'isip_p.s.grishin@mpt.ru',	'2023-03-19 03:53:53',	0,	'26|dOeffSVl5Q8sMQxMqy27iXuoKspFOKGWZhQ2smMB',	'2023-03-19 03:51:05',	'2023-03-26 17:25:22'),
                                                                                                                                                                       (20,	'Иванов',	'Иван',	'Иванович',	'electronduke',	'g.pav5@mail.ru',	NULL,	0,	NULL,	'2023-03-25 18:45:45',	'2023-03-25 18:45:45');

-- 2023-04-03 19:04:06
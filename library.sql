-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2023 at 07:45 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id_author` bigint(20) UNSIGNED NOT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id_author`, `author_name`, `author_surname`, `gender`) VALUES
(1, 'Sophie', 'Liard', 'male'),
(2, 'Mark', 'Seal', 'male'),
(3, 'Richard', 'Butterwick', 'male'),
(4, 'John', 'Jakes', 'male'),
(5, 'Yotam', 'Ottolenghi', 'male'),
(6, 'Iulia', 'Bochis', 'female'),
(7, 'Stephen', 'King', 'male'),
(8, 'Shelley', 'Parker-Chan', 'male'),
(9, 'Brandon', 'Sanderson', 'male'),
(10, 'Rebecca', 'Roanhorse', 'female'),
(11, 'Joe', 'Abercrombie', 'male'),
(12, 'Lucinda', 'Riley', 'female'),
(13, 'Andrzej', 'Ziemiański', 'male'),
(14, 'Robert', 'Rient', 'male'),
(15, 'Kristin', 'Hannah', 'male'),
(16, 'B.A.', 'Paris', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id_book` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` bigint(20) UNSIGNED NOT NULL,
  `publisher_id` bigint(20) UNSIGNED NOT NULL,
  `cathegory_id` bigint(20) UNSIGNED NOT NULL,
  `age_to_rent` int(11) NOT NULL,
  `is_rented` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id_book`, `title`, `author`, `publisher_id`, `cathegory_id`, `age_to_rent`, `is_rented`, `active`) VALUES
(1, 'The Folding Lady. Poskładaj się', 1, 1, 1, 16, 0, 1),
(2, 'Zostaw broń, weź cannoli. Kulisy powstania filmu \"Ojciec Chrzestny\"', 2, 2, 2, 14, 0, 1),
(3, 'Światło i płomień. Odrodzenie i zniszczenie Rzeczypospolitej', 3, 3, 3, 12, 0, 1),
(4, 'Północ i Południe', 4, 2, 4, 16, 0, 1),
(5, 'Ottolenghi Test Kitchen. Shelf love. Spiżarnia dobrych pomysłów', 5, 4, 5, 8, 0, 1),
(6, 'Słońce, morze, gwiazdy. Kojąca podróż przez starożytne prawdy', 6, 1, 6, 14, 0, 1),
(7, 'Baśniowa opowieść', 7, 2, 7, 12, 0, 1),
(8, 'Ta, która stała się Słońcem. Cykl Świetlisty Cesarz. Tom 1', 8, 5, 7, 16, 0, 1),
(9, 'Rytm wojny. Seria Archiwum Burzowego Światła. Tom 4. Część 2', 9, 6, 7, 13, 0, 1),
(10, 'Rytm wojny. Seria Archiwum Burzowego Światła. Tom 4. Część 1', 9, 6, 7, 13, 0, 1),
(11, 'Czarne słońce', 10, 6, 7, 13, 0, 1),
(12, 'Czerwona kraina', 11, 6, 7, 18, 0, 1),
(13, 'Ostre cięcia. Cykl Pierwsze prawo', 11, 6, 7, 16, 0, 1),
(14, 'Atlas. Historia Pa Salta', 12, 2, 4, 14, 0, 1),
(15, 'Virion. Tom 3. Legion', 13, 5, 7, 12, 0, 1),
(16, 'Wizje roślin, czyli 50 roślin leczniczych i jeden grzyb', 14, 7, 1, 6, 0, 1),
(17, 'Magiczna chwila', 15, 7, 4, 12, 0, 1),
(18, 'Uwięziona', 16, 2, 9, 16, 0, 1),
(19, 'Miłość i wojna', 4, 2, 4, 14, 0, 1),
(20, 'Piekło i niebo', 4, 2, 4, 14, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cathegories`
--

CREATE TABLE `cathegories` (
  `id_cathegory` bigint(20) UNSIGNED NOT NULL,
  `cathegory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cathegories`
--

INSERT INTO `cathegories` (`id_cathegory`, `cathegory_name`) VALUES
(1, 'Poradniki'),
(2, 'Kultura'),
(3, 'Historia'),
(4, 'Powieść'),
(5, 'Kulinaria'),
(6, 'Rozwój osobisty'),
(7, 'Fantasy'),
(8, 'F'),
(9, 'Thriller');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_27_120112_create_cathegories_table', 1),
(6, '2022_12_27_120200_create_publishers_table', 1),
(7, '2022_12_27_120300_create_authors_table', 1),
(8, '2022_12_27_120330_create_books_table', 1),
(9, '2022_12_27_120449_create_rents_table', 1),
(10, '2022_12_27_141159_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create-users', 'web', '2023-01-02 16:55:29', '2023-01-02 16:55:29'),
(2, 'add-book', 'web', '2023-01-02 16:55:29', '2023-01-02 16:55:29'),
(3, 'remove-book', 'web', '2023-01-02 16:55:29', '2023-01-02 16:55:29'),
(4, 'rent-book', 'web', '2023-01-02 16:55:29', '2023-01-02 16:55:29'),
(5, 'admin-panel', 'web', '2023-01-02 16:55:29', '2023-01-02 16:55:29'),
(6, 'all-rents', 'web', '2023-01-02 16:55:29', '2023-01-02 16:55:29'),
(7, 'block-user', 'web', '2023-01-02 16:55:29', '2023-01-02 16:55:29');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id_publisher` bigint(20) UNSIGNED NOT NULL,
  `publisher_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id_publisher`, `publisher_name`) VALUES
(1, 'Insignis Media'),
(2, 'Albatros'),
(3, 'Wydawnictwo Literackie'),
(4, 'Filo'),
(5, 'Fabryka Słów'),
(6, 'MAG'),
(7, 'Świat Książki');

-- --------------------------------------------------------

--
-- Table structure for table `rents`
--

CREATE TABLE `rents` (
  `id_rent` bigint(20) UNSIGNED NOT NULL,
  `start_rent` datetime NOT NULL,
  `return_date` date NOT NULL,
  `overdue` tinyint(1) NOT NULL,
  `rent_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Oczekuje na odbiór',
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rents`
--

INSERT INTO `rents` (`id_rent`, `start_rent`, `return_date`, `overdue`, `rent_state`, `book_id`, `user_id`) VALUES
(1, '2023-01-02 18:29:54', '2023-01-02', 0, 'Zwrócono', 16, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2023-01-02 16:55:29', '2023-01-02 16:55:29'),
(2, 'Bibliotekarz', 'web', '2023-01-02 16:55:29', '2023-01-02 16:55:29'),
(3, 'Klient', 'web', '2023-01-02 16:55:29', '2023-01-02 16:55:29');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(6, 1),
(6, 2),
(7, 1),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `books_rented` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `modified_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `login`, `email`, `password`, `birth_date`, `books_rented`, `created_at`, `updated_at`, `created_by`, `modified_by`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$.yH1sol/VDCXVn7uyKIQQOK0I.mACsQMB7kK2QvwGOGfDVOZkcsyi', '2000-06-06', 0, '2023-01-02 16:56:03', '2023-01-02 17:04:11', 1, 1),
(3, 'bibliotekarz', 'bibliotekarz@gmail.com', '$2y$10$D6yv9cHXMjrj5kMUxSJOpuaSML5cQPxlqcSKV9g3ZRVZ7PoXVVVHC', '2010-05-02', 0, '2023-01-02 17:33:49', '2023-01-02 17:34:11', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id_author`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id_book`),
  ADD KEY `books_author_foreign` (`author`),
  ADD KEY `books_publisher_id_foreign` (`publisher_id`),
  ADD KEY `books_cathegory_id_foreign` (`cathegory_id`);

--
-- Indexes for table `cathegories`
--
ALTER TABLE `cathegories`
  ADD PRIMARY KEY (`id_cathegory`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id_publisher`);

--
-- Indexes for table `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id_rent`),
  ADD KEY `rents_book_id_foreign` (`book_id`),
  ADD KEY `rents_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_login_unique` (`login`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_created_by_foreign` (`created_by`),
  ADD KEY `users_modified_by_foreign` (`modified_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id_author` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id_book` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cathegories`
--
ALTER TABLE `cathegories`
  MODIFY `id_cathegory` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id_publisher` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rents`
--
ALTER TABLE `rents`
  MODIFY `id_rent` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_author_foreign` FOREIGN KEY (`author`) REFERENCES `authors` (`id_author`),
  ADD CONSTRAINT `books_cathegory_id_foreign` FOREIGN KEY (`cathegory_id`) REFERENCES `cathegories` (`id_cathegory`),
  ADD CONSTRAINT `books_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id_publisher`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rents`
--
ALTER TABLE `rents`
  ADD CONSTRAINT `rents_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id_book`),
  ADD CONSTRAINT `rents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE SET NULL;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id_user`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id_user`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

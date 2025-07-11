-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2025 at 04:39 PM
-- Server version: 8.0.40-0ubuntu0.22.04.1
-- PHP Version: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spmb_smansagel`
--

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `berkas_persyaratan_id` bigint UNSIGNED NOT NULL,
  `path_upload` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id`, `siswa_id`, `berkas_persyaratan_id`, `path_upload`, `created_at`, `updated_at`) VALUES
(18, 2, 32, 'berkas/sandi_maulidika_32_1747836749.pdf', '2025-05-21 07:12:29', '2025-05-21 07:12:29'),
(19, 2, 33, 'berkas/sandi_maulidika_33_1747836749.pdf', '2025-05-21 07:12:29', '2025-05-21 07:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `berkas_persyaratan`
--

CREATE TABLE `berkas_persyaratan` (
  `id` bigint UNSIGNED NOT NULL,
  `jalur_pendaftaran_id` bigint UNSIGNED NOT NULL,
  `nama_berkas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_required` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berkas_persyaratan`
--

INSERT INTO `berkas_persyaratan` (`id`, `jalur_pendaftaran_id`, `nama_berkas`, `is_required`, `created_at`, `updated_at`) VALUES
(1, 1, 'IJAZAH/SURAT KETERANGAN', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(2, 1, 'KARTU KELUARGA', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(3, 1, 'AKTE KELAHIRAN', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(4, 1, 'PERNYATAAN ORANG TUA DI ATAS MATERAI', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(5, 1, 'SPTJM NILAI RAPOR', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(6, 2, 'IJAZAH/SURAT KETERANGAN', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(7, 2, 'KARTU KELUARGA', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(8, 2, 'AKTE KELAHIRAN', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(9, 2, 'PERNYATAAN ORANG TUA DI ATAS MATERAI', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(10, 2, 'PIP/PKH/SUKET DOKTER BAGI DISABILITAS', 0, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(11, 3, 'IJAZAH/SURAT KETERANGAN', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(12, 3, 'KARTU KELUARGA', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(13, 3, 'AKTE KELAHIRAN', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(14, 3, 'PERNYATAAN ORANG TUA DI ATAS MATERAI', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(15, 3, 'SPTJM NILAI RAPOR', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(16, 3, 'SPTJM RANKING/PERINGKAT', 0, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(17, 3, 'SPTJM PRESTASI AKADEMIK', 1, '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(18, 5, 'IJAZAH/SURAT KETERANGAN', 1, '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(19, 5, 'KARTU KELUARGA', 1, '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(20, 5, 'AKTE KELAHIRAN', 1, '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(21, 5, 'PERNYATAAN ORANG TUA DI ATAS MATERAI', 1, '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(22, 5, 'SPTJM NILAI RAPOR', 1, '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(23, 5, 'SPTJM PRESTASI NON-AKADEMI', 1, '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(24, 5, 'SPTJM PENGALAMAN ORGANISASI KESISWAAN', 1, '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(25, 6, 'IJAZAH/SURAT KETERANGAN', 1, '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(26, 6, 'SURAT KETERANGAN DOMISILI', 1, '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(27, 6, 'AKTE KELAHIRAN', 1, '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(28, 6, 'PERNYATAAN ORANG TUA DIATAS MATERAI', 1, '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(29, 6, 'SURAT PINDAH TUGAS DARI PIMPINAN INSTASI/LEMBAGA/TNI/POLRI/PERUSAHAN (BUMN/BUMD) YANG MEMPERKERJAAN ORANGTUA', 1, '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(30, 6, 'SURAT PENUGASAN (BAGI ANAK GURU)', 0, '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(31, 6, 'KARTU KELUARGA (BAGI ANAK GURU)', 0, '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(32, 7, 'Testing FIle', 1, NULL, NULL),
(33, 7, 'Testing File 2', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jalur_pendaftaran`
--

CREATE TABLE `jalur_pendaftaran` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jalur_pendaftaran`
--

INSERT INTO `jalur_pendaftaran` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Domisili', '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(2, 'Afirmasi', '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(3, 'Prestasi Akademik', '2025-05-19 04:12:35', '2025-05-19 04:12:35'),
(5, 'Prestasi Non Akademik', '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(6, 'Mutasi', '2025-05-19 08:52:28', '2025-05-19 08:52:28'),
(7, 'Testing', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_19_090700_create_siswa_table', 1),
(5, '2025_05_19_091102_create_jalur_table', 1),
(6, '2025_05_19_091755_create_berkas_table', 1),
(7, '2025_05_19_092206_create_berkas_persyaratan_table', 1),
(9, '2025_05_19_151232_create_nilai_table', 2),
(10, '2025_05_20_015335_add_role_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` int NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `siswa_id`, `nama`, `nilai`, `semester`, `created_at`, `updated_at`) VALUES
(26, 2, 'Bhs. Indonesia semester 1', 6, '1', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(27, 2, 'Bhs. Indonesia semester 2', 76, '2', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(28, 2, 'Bhs. Indonesia semester 3', 76, '3', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(29, 2, 'Bhs. Indonesia semester 4', 76, '4', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(30, 2, 'Bhs. Indonesia semester 5', 76, '5', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(31, 2, 'Bhs. Inggris semester 1', 76, '1', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(32, 2, 'Bhs. Inggris semester 2', 767, '2', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(33, 2, 'Bhs. Inggris semester 3', 67, '3', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(34, 2, 'Bhs. Inggris semester 4', 67, '4', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(35, 2, 'Bhs. Inggris semester 5', 67, '5', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(36, 2, 'Matematika semester 1', 67, '1', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(37, 2, 'Matematika semester 2', 67, '2', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(38, 2, 'Matematika semester 3', 676, '3', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(39, 2, 'Matematika semester 4', 76, '4', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(40, 2, 'Matematika semester 5', 76, '5', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(41, 2, 'IPA semester 1', 76, '1', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(42, 2, 'IPA semester 2', 76, '2', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(43, 2, 'IPA semester 3', 76, '3', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(44, 2, 'IPA semester 4', 76, '4', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(45, 2, 'IPA semester 5', 767, '5', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(46, 2, 'IPS semester 1', 67, '1', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(47, 2, 'IPS semester 2', 67, '2', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(48, 2, 'IPS semester 3', 676, '3', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(49, 2, 'IPS semester 4', 76, '4', '2025-05-20 21:02:22', '2025-05-20 21:02:22'),
(50, 2, 'IPS semester 5', 767, '5', '2025-05-20 21:02:22', '2025-05-20 21:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('oa6JxTcuStEXszMbbRSZmnfCdG9FmutlBKXxPywr', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0.1 Safari/605.1.15', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTE3UGF0RkVvR2RScmphS1k4cDRWdlpoeTBodmdIdHdWdjhTb1E3biI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1750347408),
('ZTYVmkLxxUTO0qu47kEgNyUn1x6OS4mktU8IwRGt', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSlJTbjBZT0o1Z2QxSzhhbDk4WmJBWWpUN2RCWTN6M0tzcEFIZmlnUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wZW5kYWZ0YXJhbi8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1748188940);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint UNSIGNED NOT NULL,
  `no_pendaftaran` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nisn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sekolah_asal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_lulus` year DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_3x4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_kk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jarak_kesekolah` int DEFAULT NULL,
  `latitude` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jalur_pendaftaran_id` bigint UNSIGNED DEFAULT NULL,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penghasilan_ayah` decimal(12,2) DEFAULT NULL,
  `penghasilan_ibu` decimal(12,2) DEFAULT NULL,
  `alamat` tinytext COLLATE utf8mb4_unicode_ci,
  `is_complete` int NOT NULL DEFAULT '0',
  `status` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tidak_lengkap',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `no_pendaftaran`, `user_id`, `nama_siswa`, `nisn`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `no_hp`, `sekolah_asal`, `tahun_lulus`, `nik`, `foto_3x4`, `upload_kk`, `jarak_kesekolah`, `latitude`, `longitude`, `jalur_pendaftaran_id`, `nama_ayah`, `nama_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `penghasilan_ayah`, `penghasilan_ibu`, `alamat`, `is_complete`, `status`, `created_at`, `updated_at`) VALUES
(2, '0001', 1, 'Sandi Maulidika', '0067806123', 'Gelumbang', '2025-05-19', 'Laki-laki', 'Islam', '085380945896', 'SMP 2 Jakarta', 2025, '01263176237162', 'Tidak wajib', 'Tidak wajib', 15, '-2.9630674216609267', '104.8078575551942', 7, 'asdasd', 'sadasdas', 'dfsdfsd', 'asdasds', '2312312.00', '1231231.00', 'Gelumbang, Kampung 2\r\nrt/rw 03/04 no 15', 1, 'pending', '2025-05-19 04:21:11', '2025-05-21 07:53:10'),
(3, '0002', 8, 'Bejok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'pending', '2025-05-19 10:40:15', '2025-05-19 10:40:15'),
(4, '0003', 2, 'Sandi Maulidika', '00678206123', 'Gelumbang', '2025-05-19', 'Laki-laki', 'Islam', '085380945896', 'SMP 2 Jakarta', 2025, '012631762237162', 'Tidak wajib', 'Tidak wajib', 15, '-2.9630674216609267', '104.8078575551942', 7, 'asdasd', 'sadasdas', 'dfsdfsd', 'asdasds', '2312312.00', '1231231.00', 'Gelumbang, Kampung 2\r\nrt/rw 03/04 no 15', 0, 'pending', '2025-05-19 04:21:11', '2025-05-22 09:07:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','verifikator','siswa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'siswa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Sandi Maulidika', 'sandimaulidika@gmail.com', NULL, '$2y$12$b5NrcVZ7JKkiSQuizUcxsuPbIZvKhYDMyrw5mJnOk1MvEDLDqnybO', NULL, '2025-05-19 04:21:11', '2025-05-19 04:21:11', 'admin'),
(2, 'Doni', 'doni@gmail.com', NULL, '$2y$12$b5NrcVZ7JKkiSQuizUcxsuPbIZvKhYDMyrw5mJnOk1MvEDLDqnybO', NULL, '2025-05-19 04:21:11', '2025-05-19 04:21:11', 'siswa'),
(8, 'Bejok', 'bejok@gmail.com', NULL, '$2y$12$Et3YuXfnXWcCF5yE6CFITuZZ7l8EViE4Ts.QBvkfsD4BlK7jQn1Yi', NULL, '2025-05-19 10:40:15', '2025-05-25 08:59:50', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berkas_persyaratan`
--
ALTER TABLE `berkas_persyaratan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jalur_pendaftaran`
--
ALTER TABLE `jalur_pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jalur_pendaftaran_nama_unique` (`nama`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_nisn_unique` (`nisn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `berkas_persyaratan`
--
ALTER TABLE `berkas_persyaratan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jalur_pendaftaran`
--
ALTER TABLE `jalur_pendaftaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

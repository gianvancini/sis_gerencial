-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Maio-2023 às 18:37
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ger_estoque`
--
CREATE DATABASE IF NOT EXISTS `ger_estoque` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ger_estoque`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `endereco`, `uf`, `cidade`, `telefone`, `data_nascimento`, `created_at`, `updated_at`) VALUES
(1, 'Carlos Pena', 'Rua deodoro fonsea', 'RN', 'Bento Fernandes', '54982315255', '1994-06-04', '2023-05-04 03:38:12', '2023-05-18 19:36:00'),
(4, 'Joao Paulo', 'Avenida dos pinheiros', 'PE', 'Belém do São Francisco', '54872115635', '0025-06-02', '2023-05-10 01:18:40', '2023-05-10 20:39:53'),
(5, 'Alberto', 'Rua C', 'AL', 'Canapi', NULL, NULL, '2023-05-16 03:38:48', '2023-05-16 03:38:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--

CREATE TABLE `marcas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `marcas`
--

INSERT INTO `marcas` (`id`, `nome`, `created_at`, `updated_at`) VALUES
(1, 'Apple', '2023-05-04 04:31:58', '2023-05-04 04:32:24'),
(2, 'Xiaomi', '2023-05-04 04:32:07', '2023-05-04 04:32:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_03_224438_create_clientes_table', 2),
(6, '2023_05_04_005725_create_vendedors_table', 3),
(7, '2023_05_04_012024_create_tipos_table', 4),
(8, '2023_05_04_012001_create_marcas_table', 5),
(9, '2023_05_10_113831_create_produtos_table', 6),
(11, '2023_05_10_214228_create_pagamentos_table', 7),
(12, '2023_05_10_230356_create_venda_table', 8),
(13, '2023_05_10_231639_create_venda_produtos_table', 9),
(14, '2023_05_13_210249_add_falta_pagar_to_vendas', 10),
(15, '2023_05_13_211737_add_id_venda_to_pagamentos_table', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data_pag` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_venda` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `pagamentos`
--

INSERT INTO `pagamentos` (`id`, `descricao`, `valor`, `data_pag`, `created_at`, `updated_at`, `id_venda`) VALUES
(1, 'pago na entrega', '500.00', '2023-05-15', '2023-05-16 02:58:43', '2023-05-16 02:58:43', 40),
(2, 'pago em dinheiro', '900.00', '2023-05-16', '2023-05-16 03:24:05', '2023-05-16 03:24:05', NULL),
(3, 'pago em dinheiro', '1000.00', '2023-05-16', '2023-05-16 03:25:19', '2023-05-16 03:25:19', NULL),
(4, 'pago em dinheiro', '1000.00', '2023-05-16', '2023-05-16 03:29:03', '2023-05-16 03:29:03', NULL),
(5, 'pago em dinheiro', '1000.00', '2023-05-16', '2023-05-16 03:31:46', '2023-05-16 03:31:46', NULL),
(6, 'pago em dinheiro', '1000.00', '2023-05-16', '2023-05-16 03:34:31', '2023-05-16 03:34:31', 43),
(7, 'pago na retirada', '7500.00', '2023-05-16', '2023-05-16 03:40:10', '2023-05-16 03:40:10', 44),
(8, 'parcela 2, pago dinheiro', '800.00', '2023-05-17', '2023-05-17 23:28:35', '2023-05-17 23:28:35', 45),
(9, 'Pago na retirada', '1350.00', '2023-05-14', '2023-05-17 23:31:15', '2023-05-17 23:31:15', 45),
(10, 'Pago na retirada', '1350.00', '2023-05-14', '2023-05-17 23:31:42', '2023-05-17 23:31:42', 45),
(11, 'pago', '400.00', '2023-05-17', '2023-05-17 23:32:24', '2023-05-17 23:32:24', 45),
(12, 'Pago na retirada', '1000.00', '2023-05-17', '2023-05-17 23:34:34', '2023-05-17 23:34:34', 46),
(13, 'Pago na retirada', '1000.00', '2023-05-17', '2023-05-17 23:35:08', '2023-05-17 23:35:08', 46),
(14, 'ok', '600.00', '2023-05-17', '2023-05-17 23:35:48', '2023-05-17 23:35:48', 47),
(15, 'pagou tudo', '3000.00', '2023-05-17', '2023-05-17 23:36:26', '2023-05-17 23:36:26', 35),
(16, 'pago na retirada', '1600.00', '2023-05-17', '2023-05-17 23:37:43', '2023-05-17 23:37:43', 48),
(17, 'pago na retirada', '1600.00', '2023-05-17', '2023-05-17 23:38:14', '2023-05-17 23:38:14', 48),
(18, 'pago na retirada', '1600.00', '2023-05-17', '2023-05-17 23:38:23', '2023-05-17 23:38:23', 48),
(19, 'ok', '3000.00', '2023-05-17', '2023-05-17 23:41:07', '2023-05-17 23:41:07', 49),
(20, 'a', '1000.00', '2023-05-17', '2023-05-17 23:43:01', '2023-05-17 23:43:01', 49),
(21, 'a', '2999.00', '2023-05-17', '2023-05-17 23:43:28', '2023-05-17 23:43:28', 50),
(22, 'a', '100.00', '2023-05-17', '2023-05-17 23:44:26', '2023-05-17 23:44:26', 37),
(23, 'a', '100.00', '2023-05-17', '2023-05-17 23:44:50', '2023-05-17 23:44:50', 36),
(24, 'a', '900.00', '2023-05-17', '2023-05-17 23:50:00', '2023-05-17 23:50:00', 37),
(25, 'a', '100.00', '2023-05-17', '2023-05-17 23:50:50', '2023-05-17 23:50:50', 37),
(26, 'a', '1000.00', '2023-05-18', '2023-05-18 15:18:56', '2023-05-18 15:18:56', 37),
(27, 'a', '900.00', '2023-05-18', '2023-05-18 15:53:13', '2023-05-18 15:53:13', 37),
(28, NULL, '6000.00', '2023-05-18', '2023-05-18 15:58:54', '2023-05-18 15:58:54', 53),
(29, NULL, '4600.00', '2023-05-18', '2023-05-18 16:56:22', '2023-05-18 16:56:22', 54),
(30, NULL, '1900.00', '2023-05-18', '2023-05-18 16:56:55', '2023-05-18 16:56:55', 55);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `marca_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tipo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `preco_custo` decimal(8,2) NOT NULL,
  `preco_venda` decimal(8,2) NOT NULL,
  `estoque` int(11) NOT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `marca_id`, `tipo_id`, `preco_custo`, `preco_venda`, `estoque`, `observacao`, `created_at`, `updated_at`) VALUES
(7, 'iphone 14 pro max 128gb', 1, 1, '2100.00', '3000.00', 0, NULL, '2023-05-13 16:08:21', '2023-05-18 16:56:01'),
(8, 'Apple watch 8 41mm', 1, 2, '1500.00', '1900.00', 1, NULL, '2023-05-13 16:08:49', '2023-05-18 16:56:49'),
(9, 'Poco x5 128gb/6gb', 2, 1, '1000.00', '1600.00', 2, NULL, '2023-05-13 16:09:16', '2023-05-18 16:56:01'),
(10, 'BTV 13', 2, 4, '850.00', '1150.00', 0, NULL, '2023-05-13 16:09:37', '2023-05-13 16:09:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos`
--

CREATE TABLE `tipos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tipos`
--

INSERT INTO `tipos` (`id`, `nome`, `created_at`, `updated_at`) VALUES
(1, 'Smartphone', '2023-05-04 04:37:42', '2023-05-04 04:37:42'),
(2, 'Smartwatch', '2023-05-04 04:37:50', '2023-05-04 04:38:27'),
(4, 'TvBox', '2023-05-04 04:38:53', '2023-05-10 20:48:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'gian', 'gian@gian.gian', NULL, '$2y$10$OTO7DQsPfEkFCfS0/nn9ZeBKGTQZQuE00ESwp8qCCwqsCEf6uYQwS', NULL, '2023-05-04 02:31:41', '2023-05-04 02:31:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_venda` date NOT NULL,
  `cliente_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vendedor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_venda` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `falta_pagar` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id`, `data_venda`, `cliente_id`, `vendedor_id`, `total_venda`, `created_at`, `updated_at`, `falta_pagar`) VALUES
(20, '2023-05-13', 1, 4, '0.00', '2023-05-13 16:23:01', '2023-05-13 16:23:01', NULL),
(21, '2023-05-13', 1, 4, '0.00', '2023-05-13 22:39:28', '2023-05-13 22:39:28', NULL),
(22, '2023-05-13', 1, 1, '0.00', '2023-05-13 22:40:30', '2023-05-13 22:40:30', NULL),
(23, '2023-05-13', 1, 1, '0.00', '2023-05-13 22:44:41', '2023-05-13 22:44:41', NULL),
(24, '2023-05-13', 1, 4, '0.00', '2023-05-13 22:52:35', '2023-05-13 22:52:35', NULL),
(25, '2023-05-13', 1, 4, '0.00', '2023-05-13 23:29:22', '2023-05-13 23:29:22', NULL),
(26, '2023-05-13', 4, 4, '1600.00', '2023-05-13 23:42:37', '2023-05-13 23:43:36', NULL),
(27, '2023-05-13', 1, 1, '1500.00', '2023-05-13 23:43:49', '2023-05-13 23:44:06', NULL),
(28, '2023-05-13', 1, 4, '2999.00', '2023-05-13 23:44:47', '2023-05-13 23:45:43', NULL),
(29, '2023-05-13', 1, 4, '5997.00', '2023-05-13 23:47:14', '2023-05-13 23:47:25', NULL),
(30, '2023-05-13', 4, 4, '3000.00', '2023-05-13 23:59:19', '2023-05-13 23:59:26', NULL),
(31, '2023-05-13', 1, 4, '3000.00', '2023-05-14 00:30:25', '2023-05-14 00:30:32', NULL),
(32, '2023-05-13', 1, 4, '3000.00', '2023-05-14 00:43:01', '2023-05-14 00:43:07', NULL),
(33, '2023-05-13', 1, 4, '3000.00', '2023-05-14 00:44:47', '2023-05-14 00:45:02', NULL),
(34, '2023-05-13', 1, 4, '3000.00', '2023-05-14 00:48:18', '2023-05-14 00:58:23', NULL),
(35, '2023-05-13', 1, 4, '3000.00', '2023-05-14 01:04:17', '2023-05-17 23:36:26', '0.00'),
(36, '2023-05-13', 1, 4, '3000.00', '2023-05-14 01:04:58', '2023-05-17 23:44:50', '2900.00'),
(37, '2023-05-13', 1, 4, '3000.00', '2023-05-14 01:05:44', '2023-05-18 15:53:13', '0.00'),
(38, '2023-05-13', 1, 4, '3000.00', '2023-05-14 01:06:10', '2023-05-14 01:06:27', '3000.00'),
(39, '2023-05-15', 1, 4, '3000.00', '2023-05-16 02:34:10', '2023-05-16 02:34:18', '3000.00'),
(40, '2023-05-15', 1, 1, '3000.00', '2023-05-16 02:57:25', '2023-05-16 02:57:31', '3000.00'),
(41, '2023-05-16', 1, 4, '3000.00', '2023-05-16 03:07:09', '2023-05-16 03:07:19', '3000.00'),
(42, '2023-05-16', 1, 4, '1000.00', '2023-05-16 03:19:58', '2023-05-16 03:20:12', '1000.00'),
(43, '2023-05-16', 4, 3, '1500.00', '2023-05-16 03:24:55', '2023-05-16 03:34:31', '500.00'),
(44, '2023-05-16', 5, 1, '9000.00', '2023-05-16 03:39:37', '2023-05-16 03:40:10', '1500.00'),
(45, '2023-05-17', 5, 3, '4800.00', '2023-05-17 22:45:51', '2023-05-17 23:32:24', '900.00'),
(46, '2023-05-17', 4, 1, '1600.00', '2023-05-17 23:34:13', '2023-05-17 23:35:08', '-400.00'),
(47, '2023-05-17', 4, 4, '2100.00', '2023-05-17 23:35:26', '2023-05-17 23:35:48', '1500.00'),
(48, '2023-05-17', 4, 4, '1600.00', '2023-05-17 23:37:27', '2023-05-17 23:38:23', '-3200.00'),
(49, '2023-05-17', 5, 4, '3000.00', '2023-05-17 23:40:52', '2023-05-17 23:43:01', '-1000.00'),
(50, '2023-05-17', 5, 4, '2999.00', '2023-05-17 23:43:14', '2023-05-17 23:43:28', '0.00'),
(51, '2023-05-17', 4, 3, '0.00', '2023-05-18 00:16:17', '2023-05-18 00:16:17', NULL),
(52, '2023-05-17', 5, 4, '6800.00', '2023-05-18 00:22:18', '2023-05-18 00:48:43', '6800.00'),
(53, '2023-05-18', 1, 1, '6000.00', '2023-05-18 15:57:14', '2023-05-18 15:58:54', '0.00'),
(54, '2023-04-19', 5, 4, '4600.00', '2023-05-18 16:55:52', '2023-05-18 16:56:22', '0.00'),
(55, '2023-03-18', 5, 4, '1900.00', '2023-05-18 16:56:43', '2023-05-18 16:56:55', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda_produtos`
--

CREATE TABLE `venda_produtos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venda_id` bigint(20) UNSIGNED DEFAULT NULL,
  `produto_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `desconto` decimal(8,2) NOT NULL,
  `item_total` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `venda_produtos`
--

INSERT INTO `venda_produtos` (`id`, `venda_id`, `produto_id`, `quantidade`, `desconto`, `item_total`, `created_at`, `updated_at`) VALUES
(1, 25, 8, 2, '100.00', '3800.00', '2023-05-13 23:29:43', '2023-05-13 23:29:43'),
(3, 26, 7, 1, '100.00', '2900.00', '2023-05-13 23:42:59', '2023-05-13 23:42:59'),
(4, 26, 7, 1, '100.00', '2900.00', '2023-05-13 23:43:36', '2023-05-13 23:43:36'),
(5, 26, 9, 1, '0.00', '1600.00', '2023-05-13 23:43:36', '2023-05-13 23:43:36'),
(6, 27, 7, 1, '0.00', '3000.00', '2023-05-13 23:44:06', '2023-05-13 23:44:06'),
(7, 27, 8, 1, '400.00', '1500.00', '2023-05-13 23:44:06', '2023-05-13 23:44:06'),
(8, 28, 7, 1, '1.00', '2999.00', '2023-05-13 23:45:43', '2023-05-13 23:45:43'),
(9, 28, 7, 1, '1.00', '2999.00', '2023-05-13 23:45:43', '2023-05-13 23:45:43'),
(10, 28, 7, 1, '1.00', '2999.00', '2023-05-13 23:45:43', '2023-05-13 23:45:43'),
(11, 29, 7, 1, '1.00', '2999.00', '2023-05-13 23:47:25', '2023-05-13 23:47:25'),
(12, 29, 7, 1, '2.00', '2998.00', '2023-05-13 23:47:25', '2023-05-13 23:47:25'),
(13, 30, 7, 1, '0.00', '3000.00', '2023-05-13 23:59:26', '2023-05-13 23:59:26'),
(14, 31, 7, 1, '0.00', '3000.00', '2023-05-14 00:30:32', '2023-05-14 00:30:32'),
(15, 32, 7, 1, '0.00', '3000.00', '2023-05-14 00:43:07', '2023-05-14 00:43:07'),
(16, 33, 7, 1, '0.00', '3000.00', '2023-05-14 00:45:02', '2023-05-14 00:45:02'),
(17, 34, 7, 1, '0.00', '3000.00', '2023-05-14 00:58:23', '2023-05-14 00:58:23'),
(18, 35, 7, 1, '0.00', '3000.00', '2023-05-14 01:04:23', '2023-05-14 01:04:23'),
(19, 36, 7, 1, '0.00', '3000.00', '2023-05-14 01:05:04', '2023-05-14 01:05:04'),
(20, 37, 7, 1, '0.00', '3000.00', '2023-05-14 01:05:49', '2023-05-14 01:05:49'),
(21, 38, 7, 1, '0.00', '3000.00', '2023-05-14 01:06:27', '2023-05-14 01:06:27'),
(22, 39, 7, 1, '0.00', '3000.00', '2023-05-16 02:34:18', '2023-05-16 02:34:18'),
(23, 40, 7, 1, '0.00', '3000.00', '2023-05-16 02:57:31', '2023-05-16 02:57:31'),
(24, 41, 7, 1, '0.00', '3000.00', '2023-05-16 03:07:19', '2023-05-16 03:07:19'),
(25, 42, 9, 1, '600.00', '1000.00', '2023-05-16 03:20:12', '2023-05-16 03:20:12'),
(26, 43, 8, 1, '400.00', '1500.00', '2023-05-16 03:25:05', '2023-05-16 03:25:05'),
(27, 44, 7, 3, '0.00', '9000.00', '2023-05-16 03:39:45', '2023-05-16 03:39:45'),
(28, 45, 7, 1, '100.00', '2900.00', '2023-05-17 22:46:04', '2023-05-17 22:46:04'),
(29, 45, 8, 1, '0.00', '1900.00', '2023-05-17 22:46:04', '2023-05-17 22:46:04'),
(30, 46, 9, 1, '0.00', '1600.00', '2023-05-17 23:34:23', '2023-05-17 23:34:23'),
(31, 47, 7, 1, '900.00', '2100.00', '2023-05-17 23:35:38', '2023-05-17 23:35:38'),
(32, 48, 9, 1, '0.00', '1600.00', '2023-05-17 23:37:33', '2023-05-17 23:37:33'),
(33, 49, 7, 1, '0.00', '3000.00', '2023-05-17 23:40:59', '2023-05-17 23:40:59'),
(34, 50, 7, 1, '1.00', '2999.00', '2023-05-17 23:43:21', '2023-05-17 23:43:21'),
(35, 52, 7, 1, '0.00', '3000.00', '2023-05-18 00:48:43', '2023-05-18 00:48:43'),
(36, 52, 8, 2, '0.00', '3800.00', '2023-05-18 00:48:43', '2023-05-18 00:48:43'),
(37, 53, 7, 2, '0.00', '6000.00', '2023-05-18 15:57:25', '2023-05-18 15:57:25'),
(38, 54, 7, 1, '0.00', '3000.00', '2023-05-18 16:56:01', '2023-05-18 16:56:01'),
(39, 54, 9, 1, '0.00', '1600.00', '2023-05-18 16:56:01', '2023-05-18 16:56:01'),
(40, 55, 8, 1, '0.00', '1900.00', '2023-05-18 16:56:49', '2023-05-18 16:56:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedors`
--

CREATE TABLE `vendedors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_admissao` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `vendedors`
--

INSERT INTO `vendedors` (`id`, `nome`, `endereco`, `uf`, `cidade`, `telefone`, `data_nascimento`, `data_admissao`, `created_at`, `updated_at`) VALUES
(1, 'Mirta Mole', 'Rua Vaca', 'PE', 'Araripina', '15699584878', '1999-04-12', '2022-01-01', '2023-05-04 04:17:06', '2023-05-18 19:36:49'),
(3, 'Pedro', 'Rua Vacaria, 979', 'RS', 'Coqueiro Baixo', '25962254875', '0111-11-01', '0111-11-11', '2023-05-05 19:47:06', '2023-05-18 19:36:26'),
(4, 'Alecs', 'rua P', 'RS', 'Agudo', '5482287845', '0006-05-02', '0060-05-04', '2023-05-05 19:57:09', '2023-05-05 21:26:32');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagamentos_id_venda_foreign` (`id_venda`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices para tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_marca_id_foreign` (`marca_id`),
  ADD KEY `produtos_tipo_id_foreign` (`tipo_id`);

--
-- Índices para tabela `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendas_cliente_id_foreign` (`cliente_id`),
  ADD KEY `vendas_vendedor_id_foreign` (`vendedor_id`);

--
-- Índices para tabela `venda_produtos`
--
ALTER TABLE `venda_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venda_produtos_venda_id_foreign` (`venda_id`),
  ADD KEY `venda_produtos_produto_id_foreign` (`produto_id`);

--
-- Índices para tabela `vendedors`
--
ALTER TABLE `vendedors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `venda_produtos`
--
ALTER TABLE `venda_produtos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `vendedors`
--
ALTER TABLE `vendedors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `pagamentos_id_venda_foreign` FOREIGN KEY (`id_venda`) REFERENCES `vendas` (`id`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_marca_id_foreign` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `produtos_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipos` (`id`);

--
-- Limitadores para a tabela `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `vendas_vendedor_id_foreign` FOREIGN KEY (`vendedor_id`) REFERENCES `vendedors` (`id`);

--
-- Limitadores para a tabela `venda_produtos`
--
ALTER TABLE `venda_produtos`
  ADD CONSTRAINT `venda_produtos_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `venda_produtos_venda_id_foreign` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

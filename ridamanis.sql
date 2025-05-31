/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50739 (5.7.39)
 Source Host           : localhost:3306
 Source Schema         : ridamanis

 Target Server Type    : MySQL
 Target Server Version : 50739 (5.7.39)
 File Encoding         : 65001

 Date: 31/05/2025 13:04:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for kandidat
-- ----------------------------
DROP TABLE IF EXISTS `kandidat`;
CREATE TABLE `kandidat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `visimisi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kandidat
-- ----------------------------
BEGIN;
INSERT INTO `kandidat` (`id`, `nama`, `visimisi`) VALUES (1, 'Prabowo 1', 'Indonesia Berkelanjutan');
INSERT INTO `kandidat` (`id`, `nama`, `visimisi`) VALUES (3, 'Anies', 'Indonesia Maju');
INSERT INTO `kandidat` (`id`, `nama`, `visimisi`) VALUES (4, 'GAnjar', 'isi');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for pax
-- ----------------------------
DROP TABLE IF EXISTS `pax`;
CREATE TABLE `pax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `kode_booking` varchar(255) DEFAULT NULL,
  `tanggal_issued` datetime DEFAULT NULL,
  `nomor` varchar(255) DEFAULT NULL,
  `tanggal_berangkat` datetime DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `arrival` varchar(255) DEFAULT NULL,
  `pax` varchar(255) DEFAULT NULL,
  `ga_miles` varchar(255) DEFAULT NULL,
  `type_of_trip` varchar(255) DEFAULT NULL,
  `code_corp` varchar(255) DEFAULT NULL,
  `poi` varchar(255) DEFAULT NULL,
  `flight_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nomor_tiket` varchar(255) DEFAULT NULL,
  `sub_class` varchar(255) DEFAULT NULL,
  `respon_pnr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pax
-- ----------------------------
BEGIN;
INSERT INTO `pax` (`id`, `nama`, `kode_booking`, `tanggal_issued`, `nomor`, `tanggal_berangkat`, `origin`, `arrival`, `pax`, `ga_miles`, `type_of_trip`, `code_corp`, `poi`, `flight_number`, `email`, `nomor_tiket`, `sub_class`, `respon_pnr`) VALUES (17, 'Andis', '003', '2025-05-14 00:00:00', '0895635054733', '2025-05-28 00:00:00', 'KDI', 'UPG', '2', 'NO DATA', 'ONE WAY', 'UMUM', '3', '605', 'testing@gmail.com', '089323232323', 'Y', 'CONFIRM');
COMMIT;

-- ----------------------------
-- Table structure for pemilihan
-- ----------------------------
DROP TABLE IF EXISTS `pemilihan`;
CREATE TABLE `pemilihan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kandidat_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pemilihan
-- ----------------------------
BEGIN;
INSERT INTO `pemilihan` (`id`, `kandidat_id`, `user_id`, `tanggal`) VALUES (3, 3, 1, '2025-04-27 12:00:26');
INSERT INTO `pemilihan` (`id`, `kandidat_id`, `user_id`, `tanggal`) VALUES (4, 1, 8, '2025-04-27 12:39:47');
INSERT INTO `pemilihan` (`id`, `kandidat_id`, `user_id`, `tanggal`) VALUES (5, 1, 9, '2025-04-27 12:40:02');
INSERT INTO `pemilihan` (`id`, `kandidat_id`, `user_id`, `tanggal`) VALUES (6, 1, 10, '2025-04-27 13:03:42');
INSERT INTO `pemilihan` (`id`, `kandidat_id`, `user_id`, `tanggal`) VALUES (7, 1, 11, '2025-05-15 19:47:45');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` tinyint(4) DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` tinyint(4) DEFAULT '1',
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `role`, `name`, `email`, `kelas`, `jenis`, `last_name`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 1, 'Testing', 'testing@gmail.com', NULL, 0, 'Tes', NULL, '$2y$10$BEE.OhNIx2xwcOJ0LHSjrOpZlFFHLAgQGSfXJbFvOYCYyAIIezpda', NULL, NULL, NULL, '2025-04-23 12:47:23', '2025-04-23 12:47:23');
INSERT INTO `users` (`id`, `role`, `name`, `email`, `kelas`, `jenis`, `last_name`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES (6, 0, 'dsd', 'testing323@gmail.com', 'dsdsd', 2, 'dsd', NULL, '$2y$10$ZRR6dj23l1mTw5HeirRgkuWZC5lNoq1Nq0ueqxcDV8uAKvk6/dYU.', NULL, NULL, NULL, '2025-04-26 12:45:09', '2025-04-26 13:03:58');
INSERT INTO `users` (`id`, `role`, `name`, `email`, `kelas`, `jenis`, `last_name`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES (7, 0, 'Kesiswaan', 'Kabag@gmail.com', '-', 3, 'Kabag', NULL, '$2y$10$mUABpcPfAO6b3z6340QGo.FwOKVygKAYE0LqnUHcMb2N04pjUYNmq', NULL, NULL, NULL, '2025-04-26 13:04:55', '2025-04-26 13:27:44');
INSERT INTO `users` (`id`, `role`, `name`, `email`, `kelas`, `jenis`, `last_name`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES (8, 0, 'tes', 'tes1@gmail.com', '1', 2, '1', NULL, '$2y$10$ySzxKPjMmaYgy9S0E09IzeSAuuqo9oBwn3xyC192Wte8wC69cbURi', NULL, NULL, NULL, '2025-04-27 04:38:39', '2025-04-27 04:39:18');
INSERT INTO `users` (`id`, `role`, `name`, `email`, `kelas`, `jenis`, `last_name`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES (9, 0, 'tes', 'tes2@gmail.com', '2', 2, '2', NULL, '$2y$10$.nB.b82vyn7UJeXxP64WbensVZfZcqV85LfoIIM26oBpEm3rhPrjW', NULL, NULL, NULL, '2025-04-27 04:39:01', '2025-04-27 04:39:21');
INSERT INTO `users` (`id`, `role`, `name`, `email`, `kelas`, `jenis`, `last_name`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES (10, 0, 'tes', 'tes3@gmail.com', '3', 2, '3', NULL, '$2y$10$WxcU0RuACH6ZFBRl1UFtAeVbB7GkY8rAboN/sBSJfZaPN4WJnUpW2', NULL, NULL, NULL, '2025-04-27 05:02:56', '2025-04-27 05:03:16');
INSERT INTO `users` (`id`, `role`, `name`, `email`, `kelas`, `jenis`, `last_name`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES (11, 0, 'siswa123', 'siswa1@gmail.com', '1', 2, '1', NULL, '$2y$10$.nmeOy5gTbHA01I7PHIOduuSSzmIRq95zzCe1/mixP5EsUXCtNWEG', NULL, NULL, NULL, '2025-05-15 11:45:40', '2025-05-15 11:47:03');
COMMIT;

-- ----------------------------
-- Table structure for wa_outbox
-- ----------------------------
DROP TABLE IF EXISTS `wa_outbox`;
CREATE TABLE `wa_outbox` (
  `NOMOR` bigint(20) NOT NULL AUTO_INCREMENT,
  `NOWA` varchar(50) NOT NULL DEFAULT '',
  `PESAN` text CHARACTER SET utf8 NOT NULL,
  `TANGGAL_JAM` datetime DEFAULT NULL,
  `STATUS` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT 'ANTRIAN',
  `SOURCE` varchar(50) DEFAULT NULL,
  `SENDER` varchar(10) NOT NULL DEFAULT 'NODEJS' COMMENT 'ANY, NODEJS, QISCUS',
  `SUCCESS` varchar(1) DEFAULT NULL,
  `RESPONSE` text,
  `REQUEST` text,
  `TYPE` varchar(15) NOT NULL DEFAULT 'TEXT' COMMENT 'TEXT, IMAGE, VIDEO',
  `FILE` varchar(100) DEFAULT NULL,
  `KUNJUNGAN` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`NOMOR`)
) ENGINE=InnoDB AUTO_INCREMENT=21715 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wa_outbox
-- ----------------------------
BEGIN;
INSERT INTO `wa_outbox` (`NOMOR`, `NOWA`, `PESAN`, `TANGGAL_JAM`, `STATUS`, `SOURCE`, `SENDER`, `SUCCESS`, `RESPONSE`, `REQUEST`, `TYPE`, `FILE`, `KUNJUNGAN`) VALUES (2, '082343940155@c.us', '*PEMBERITAHUAN JADWAL KONTROL* \n \nKepada Yth. *Bambang Simulasi Tes*,\n \nAnda memiliki jadwal kontrol pada:\n \n*Tanggal*: 2025-02-26\n*Estimasi Jam Pelayanan*: 08:33:00\n \nData Pasien:\n- *No. Kartu*: \n- *No. RM*: 989083\n- *Tujuan Poli*: Interna\n- *Dokter*: [Nama Dokter]\n \nSurat ini hanya berlaku *1 (satu) kali kunjungan* pada tanggal di atas.\nHarap datang 30 lebih awal dan membawa surat ini saat berkunjung.\n \n_Pesan bertujuan untuk meningkatkan efisiensi pemberitahuan kepada pasien, jika terdapat kekeliruan jangan sunkan untuk membalas pesan ini._\n \n*RS TADJUDDIN CHALID*', '2025-02-25 15:36:28', 'Terproses', 'KONTROL', 'NODEJS', '1', '{\"status\":true,\"message\":\"Sukses\",\"response\":{\"_data\":{\"id\":{\"fromMe\":true,\"remote\":\"6282343940155@c.us\",\"id\":\"3EB0F903A3818E7D5A266D\",\"_serialized\":\"true_6282343940155@c.us_3EB0F903A3818E7D5A266D\"},\"viewed\":false,\"body\":\"*PEMBERITAHUAN JADWAL KONTROL* \n \nKepada Yth. *Bambang Simulasi Tes*,\n \nAnda memiliki jadwal kontrol pada:\n \n*Tanggal*: 2025-02-26\n*Estimasi Jam Pelayanan*: 08:33:00\n \nData Pasien:\n- *No. Kartu*: \n- *No. RM*: 989083\n- *Tujuan Poli*: Interna\n- *Dokter*: [Nama Dokter]\n \nSurat ini hanya berlaku *1 (satu) kali kunjungan* pada tanggal di atas.\nHarap datang 30 lebih awal dan membawa surat ini saat berkunjung.\n \n_Pesan bertujuan untuk meningkatkan efisiensi pemberitahuan kepada pasien, jika terdapat kekeliruan jangan sunkan untuk membalas pesan ini._\n \n*RS TADJUDDIN CHALID*\r\n\r\n#000002\",\"type\":\"chat\",\"t\":1740468820,\"from\":{\"server\":\"c.us\",\"user\":\"6282133373706\",\"_serialized\":\"6282133373706@c.us\"},\"to\":{\"server\":\"c.us\",\"user\":\"6282343940155\",\"_serialized\":\"6282343940155@c.us\"},\"ack\":0,\"isNewMsg\":true,\"star\":false,\"kicNotified\":false,\"isFromTemplate\":false,\"pollInvalidated\":false,\"isSentCagPollCreation\":false,\"latestEditMsgKey\":null,\"latestEditSenderTimestampMs\":null,\"mentionedJidList\":[],\"groupMentions\":[],\"isEventCanceled\":false,\"eventInvalidated\":false,\"isVcardOverMmsDocument\":false,\"isForwarded\":false,\"labels\":[],\"hasReaction\":false,\"productHeaderImageRejected\":false,\"lastPlaybackProgress\":0,\"isDynamicReplyButtonsMsg\":false,\"isCarouselCard\":false,\"parentMsgId\":null,\"callSilenceReason\":null,\"isVideoCall\":false,\"isMdHistoryMsg\":false,\"stickerSentTs\":0,\"isAvatar\":false,\"lastUpdateFromServerTs\":0,\"invokedBotWid\":null,\"bizBotType\":null,\"botResponseTargetId\":null,\"botPluginType\":null,\"botPluginReferenceIndex\":null,\"botPluginSearchProvider\":null,\"botPluginSearchUrl\":null,\"botPluginSearchQuery\":null,\"botPluginMaybeParent\":false,\"botReelPluginThumbnailCdnUrl\":null,\"botMsgBodyType\":null,\"requiresDirectConnection\":null,\"bizContentPlaceholderType\":null,\"hostedBizEncStateMismatch\":false,\"senderOrRecipientAccountTypeHosted\":false,\"placeholderCreatedWhenAccountIsHosted\":false,\"links\":[]},\"id\":{\"fromMe\":true,\"remote\":\"6282343940155@c.us\",\"id\":\"3EB0F903A3818E7D5A266D\",\"_serialized\":\"true_6282343940155@c.us_3EB0F903A3818E7D5A266D\"},\"ack\":0,\"hasMedia\":false,\"body\":\"*PEMBERITAHUAN JADWAL KONTROL* \n \nKepada Yth. *Bambang Simulasi Tes*,\n \nAnda memiliki jadwal kontrol pada:\n \n*Tanggal*: 2025-02-26\n*Estimasi Jam Pelayanan*: 08:33:00\n \nData Pasien:\n- *No. Kartu*: \n- *No. RM*: 989083\n- *Tujuan Poli*: Interna\n- *Dokter*: [Nama Dokter]\n \nSurat ini hanya berlaku *1 (satu) kali kunjungan* pada tanggal di atas.\nHarap datang 30 lebih awal dan membawa surat ini saat berkunjung.\n \n_Pesan bertujuan untuk meningkatkan efisiensi pemberitahuan kepada pasien, jika terdapat kekeliruan jangan sunkan untuk membalas pesan ini._\n \n*RS TADJUDDIN CHALID*\r\n\r\n#000002\",\"type\":\"chat\",\"timestamp\":1740468820,\"from\":\"6282133373706@c.us\",\"to\":\"6282343940155@c.us\",\"deviceType\":\"android\",\"isForwarded\":false,\"forwardingScore\":0,\"isStatus\":false,\"isStarred\":false,\"fromMe\":true,\"hasQuotedMsg\":false,\"hasReaction\":false,\"vCards\":[],\"mentionedIds\":[],\"groupMentions\":[],\"isGif\":false,\"links\":[]}}', 'number=082343940155@c.us\r\nmessage=*PEMBERITAHUAN JADWAL KONTROL* \r\n \r\nKepada Yth. *Bambang Simulasi Tes*,\r\n \r\nAnda memiliki jadwal kontrol pada:\r\n \r\n*Tanggal*: 2025-02-26\r\n*Estimasi Jam Pelayanan*: 08:33:00\r\n \r\nData Pasien:\r\n- *No. Kartu*: \r\n- *No. RM*: 989083\r\n- *Tujuan Poli*: Interna\r\n- *Dokter*: [Nama Dokter]\r\n \r\nSurat ini hanya berlaku *1 (satu) kali kunjungan* pada tanggal di atas.\r\nHarap datang 30 lebih awal dan membawa surat ini saat berkunjung.\r\n \r\n_Pesan bertujuan untuk meningkatkan efisiensi pemberitahuan kepada pasien, jika terdapat kekeliruan jangan sunkan untuk membalas pesan ini._\r\n \r\n*RS TADJUDDIN CHALID*\r\n\r\n#000002\r\n', 'TEXT', NULL, '');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

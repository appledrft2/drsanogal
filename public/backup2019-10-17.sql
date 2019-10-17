DROP TABLE announcements;

CREATE TABLE `announcements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `cover_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `announcements_user_id_index` (`user_id`),
  CONSTRAINT `announcements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO announcements VALUES("1","1","test announcement","<div style=\"text-align: justify; \"><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</div><div>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</div><div>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</div><div>consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse</div><div>cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</div><div>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div></div>","uploads/noimage.png","2019-10-12 15:45:46","2019-10-12 16:00:24");



DROP TABLE appointments;

CREATE TABLE `appointments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) unsigned NOT NULL,
  `next_appointment` date NOT NULL,
  `next_appointment2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visited` date NOT NULL,
  `temperature` double NOT NULL,
  `kilogram` double NOT NULL,
  `appointment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `amount` double NOT NULL,
  `isPaid` tinyint(1) NOT NULL DEFAULT '0',
  `isNotified` tinyint(1) NOT NULL DEFAULT '0',
  `isCompleted` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Completed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_patient_id_index` (`patient_id`),
  CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO appointments VALUES("1","1","2019-09-30","","10:09 PM","2019-09-30","38.55","52.1","Others","500","","500","1","0","Not Completed","2019-09-30 22:30:43","2019-09-30 22:30:52");



DROP TABLE billing_products;

CREATE TABLE `billing_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `billing_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `billing_products_billing_id_index` (`billing_id`),
  CONSTRAINT `billing_products_billing_id_foreign` FOREIGN KEY (`billing_id`) REFERENCES `billings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO billing_products VALUES("1","1","test","Other","Other","500.99","1","2019-09-30 22:30:53","2019-09-30 22:30:53");



DROP TABLE billing_services;

CREATE TABLE `billing_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `billing_id` bigint(20) unsigned NOT NULL,
  `appointment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `billing_services_billing_id_index` (`billing_id`),
  CONSTRAINT `billing_services_billing_id_foreign` FOREIGN KEY (`billing_id`) REFERENCES `billings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO billing_services VALUES("1","1","Others","500","2019-09-30 22:30:52","2019-09-30 22:30:52");



DROP TABLE billings;

CREATE TABLE `billings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `rcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `netamount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `billings_client_id_index` (`client_id`),
  CONSTRAINT `billings_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO billings VALUES("1","1","RS-2023","1000.99","989.99","2019-09-30 22:30:52","2019-09-30 22:30:53");



DROP TABLE client_forms;

CREATE TABLE `client_forms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_forms_client_id_index` (`client_id`),
  CONSTRAINT `client_forms_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE clients;

CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smsNotify` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO clients VALUES("1","John Paul Ronda","Male","Student","johnpaul@gmail.com","09151535384","122345332"," ","Mobile","Prk.Sampaguita,Brgy. Alimango, Escalante City, Negros Occidental","2019-09-13 18:39:40","2019-09-14 16:10:23");
INSERT INTO clients VALUES("2","Ragie Cadagat Doromal","Male","Student","ragiedoromal06@gmail.com","09151535150"," "," ","Mobile","Prk.Sampaguita,Brgy. Alimango, Escalante City, Negros Occidental","2019-10-17 16:55:34","2019-10-17 16:55:34");



DROP TABLE form_categories;

CREATE TABLE `form_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE manage_appointments;

CREATE TABLE `manage_appointments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO manage_appointments VALUES("1","service1","service description 1","2019-10-11 14:41:47","2019-10-15 09:07:40");



DROP TABLE migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES("22","2014_10_12_000000_create_users_table","1");
INSERT INTO migrations VALUES("23","2014_10_12_100000_create_password_resets_table","1");
INSERT INTO migrations VALUES("24","2019_07_02_111515_create_clients_table","1");
INSERT INTO migrations VALUES("25","2019_07_02_165426_create_announcements_table","1");
INSERT INTO migrations VALUES("26","2019_07_03_130331_create_patients_table","1");
INSERT INTO migrations VALUES("27","2019_07_04_160529_create_appointments_table","1");
INSERT INTO migrations VALUES("28","2019_07_04_162727_create_suppliers_table","1");
INSERT INTO migrations VALUES("29","2019_07_05_090403_create_products_table","1");
INSERT INTO migrations VALUES("30","2019_07_07_134050_create_preventives_table","1");
INSERT INTO migrations VALUES("31","2019_07_09_050906_create_stock_ins_table","1");
INSERT INTO migrations VALUES("32","2019_07_09_125416_create_stockindetail_table","1");
INSERT INTO migrations VALUES("33","2019_07_11_234121_create_stock_outs_table","1");
INSERT INTO migrations VALUES("34","2019_07_14_143315_create_stockout_details_table","1");
INSERT INTO migrations VALUES("35","2019_07_16_162758_create_product_categories_table","1");
INSERT INTO migrations VALUES("36","2019_07_17_130028_create_product_units_table","1");
INSERT INTO migrations VALUES("37","2019_07_17_234154_create_billings_table","1");
INSERT INTO migrations VALUES("38","2019_07_17_234626_create_billing_products_table","1");
INSERT INTO migrations VALUES("39","2019_07_18_001132_create_billing_services_table","1");
INSERT INTO migrations VALUES("40","2019_07_23_165136_create_manage_appointments_table","1");
INSERT INTO migrations VALUES("41","2019_07_25_134234_create_client_forms_table","1");
INSERT INTO migrations VALUES("42","2019_07_31_234258_create_form_categories_table","1");
INSERT INTO migrations VALUES("43","2019_10_17_141704_create_systemlogs_table","2");



DROP TABLE password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE patients;

CREATE TABLE `patients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `breed` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `markings` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_considerations` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `veterinarian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patients_client_id_index` (`client_id`),
  CONSTRAINT `patients_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO patients VALUES("1","1","Max","Shih Tzu","Male","Canine","none","none","Dr. Sanogal","2019-04-11","2019-09-14 15:58:15","2019-09-14 15:58:15");



DROP TABLE preventives;

CREATE TABLE `preventives` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` bigint(20) unsigned NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kg` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` double NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `preventives_appointment_id_index` (`appointment_id`),
  CONSTRAINT `preventives_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE product_categories;

CREATE TABLE `product_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE product_units;

CREATE TABLE `product_units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE products;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original` double NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `lowstock` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_supplier_id_index` (`supplier_id`),
  CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products VALUES("1","1","test","Other","Other","100","200","3019","108","uploads/noimage.png","2019-09-26 15:32:20","2019-10-17 15:51:26");
INSERT INTO products VALUES("2","1","product 1","Other","Other","200","300","108","2","uploads/noimage.png","2019-10-11 15:19:10","2019-10-17 15:52:53");



DROP TABLE stock_in_details;

CREATE TABLE `stock_in_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stockin_id` bigint(20) unsigned NOT NULL,
  `original` double NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_in_details_stockin_id_index` (`stockin_id`),
  CONSTRAINT `stock_in_details_stockin_id_foreign` FOREIGN KEY (`stockin_id`) REFERENCES `stock_ins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stock_in_details VALUES("6","test","6","100","200","10","2019-10-17 15:51:26","2019-10-17 15:51:26");
INSERT INTO stock_in_details VALUES("7","product 1","7","200","300","10","2019-10-17 15:52:53","2019-10-17 15:52:53");



DROP TABLE stock_ins;

CREATE TABLE `stock_ins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint(20) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` date NOT NULL,
  `amount` double NOT NULL,
  `term` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `mop` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `partial` double DEFAULT '0',
  `due` date NOT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_ins_supplier_id_index` (`supplier_id`),
  CONSTRAINT `stock_ins_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stock_ins VALUES("6","1","DC-8385","2019-10-17","1000","","Credit","0","2019-11-01","0","Unpaid","2019-10-17 15:51:26","2019-10-17 15:51:26");
INSERT INTO stock_ins VALUES("7","1","DC-5055","2019-10-17","2000","","Cash","0","2019-11-01","0","Unpaid","2019-10-17 15:52:53","2019-10-17 15:52:53");



DROP TABLE stock_out_details;

CREATE TABLE `stock_out_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_out_id` bigint(20) unsigned NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `netamount` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_out_details_stock_out_id_foreign` (`stock_out_id`),
  CONSTRAINT `stock_out_details_stock_out_id_foreign` FOREIGN KEY (`stock_out_id`) REFERENCES `stock_outs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stock_out_details VALUES("1","tsdfsdf","1","Other","Other","500.99","4899.9","10","5010","2019-09-30 22:13:15","2019-09-30 22:13:15");
INSERT INTO stock_out_details VALUES("2","product 1","2","Other","Other","2131","900","1","2131","2019-10-11 15:21:07","2019-10-11 15:21:07");
INSERT INTO stock_out_details VALUES("3","test","2","Other","Other","500.99","2449.95","5","2505","2019-10-11 15:21:07","2019-10-11 15:21:07");
INSERT INTO stock_out_details VALUES("4","product 1","3","Other","Other","2131","9000","10","21310","2019-10-15 08:58:11","2019-10-15 08:58:11");
INSERT INTO stock_out_details VALUES("5","test","3","Other","Other","500.99","979.98","2","1002","2019-10-15 08:58:11","2019-10-15 08:58:11");



DROP TABLE stock_outs;

CREATE TABLE `stock_outs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stock_outs VALUES("1","RS-2761","5009.9","2019-09-30 22:13:15","2019-09-30 22:13:16");
INSERT INTO stock_outs VALUES("2","RS-1779","4635.95","2019-10-11 15:21:07","2019-10-11 15:21:07");
INSERT INTO stock_outs VALUES("3","RS-6794","22311.98","2019-10-15 08:58:11","2019-10-15 08:58:11");



DROP TABLE suppliers;

CREATE TABLE `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO suppliers VALUES("1","Supplier 1","12322432342","Bacolod City","2019-09-26 15:32:03","2019-10-17 15:25:10");



DROP TABLE systemlogs;

CREATE TABLE `systemlogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `activity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO systemlogs VALUES("8","Ragie Doromal logged in successfully","2019-10-17 14:37:15","2019-10-17 14:37:15");
INSERT INTO systemlogs VALUES("9","Ragie Doromal logged out successfully","2019-10-17 14:37:23","2019-10-17 14:37:23");
INSERT INTO systemlogs VALUES("10","Ragie Doromal logged in successfully","2019-10-17 14:37:34","2019-10-17 14:37:34");
INSERT INTO systemlogs VALUES("11","Ragie Doromal has logged out successfully","2019-10-17 14:43:42","2019-10-17 14:43:42");
INSERT INTO systemlogs VALUES("12","Ragie Doromal has logged in successfully","2019-10-17 14:43:46","2019-10-17 14:43:46");
INSERT INTO systemlogs VALUES("13","Ragie Doromal has logged out successfully","2019-10-17 14:44:17","2019-10-17 14:44:17");
INSERT INTO systemlogs VALUES("14","Ragie Doromal has logged in successfully","2019-10-17 14:44:25","2019-10-17 14:44:25");
INSERT INTO systemlogs VALUES("15","Ragie Doromal has logged out successfully","2019-10-17 14:44:47","2019-10-17 14:44:47");
INSERT INTO systemlogs VALUES("16","bryan has logged in successfully","2019-10-17 14:44:54","2019-10-17 14:44:54");
INSERT INTO systemlogs VALUES("17","bryan has logged out successfully","2019-10-17 14:44:59","2019-10-17 14:44:59");
INSERT INTO systemlogs VALUES("18","Ragie Doromal has logged in successfully","2019-10-17 14:45:04","2019-10-17 14:45:04");
INSERT INTO systemlogs VALUES("19","Ragie Doromal has logged out successfully","2019-10-17 15:23:56","2019-10-17 15:23:56");
INSERT INTO systemlogs VALUES("20","bryan has logged in successfully","2019-10-17 15:24:02","2019-10-17 15:24:02");
INSERT INTO systemlogs VALUES("21","bryan has logged out successfully","2019-10-17 15:56:36","2019-10-17 15:56:36");
INSERT INTO systemlogs VALUES("22","Ragie Doromal has logged in successfully","2019-10-17 15:56:53","2019-10-17 15:56:53");
INSERT INTO systemlogs VALUES("23","Ragie Doromal has logged out successfully","2019-10-17 17:00:02","2019-10-17 17:00:02");
INSERT INTO systemlogs VALUES("24","bryan has logged in successfully","2019-10-17 17:00:07","2019-10-17 17:00:07");
INSERT INTO systemlogs VALUES("25","bryan has logged out successfully","2019-10-17 17:01:34","2019-10-17 17:01:34");
INSERT INTO systemlogs VALUES("26","Ragie Doromal has logged in successfully","2019-10-17 17:31:07","2019-10-17 17:31:07");
INSERT INTO systemlogs VALUES("27","Ragie Doromal has logged out successfully","2019-10-17 18:07:23","2019-10-17 18:07:23");
INSERT INTO systemlogs VALUES("28","Ragie Doromal has logged in successfully","2019-10-17 18:07:40","2019-10-17 18:07:40");



DROP TABLE users;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES("1","uploads/9xd9TBPNOmJS80rAL83yixjvbwm6j4kDnOCzZY4w.jpeg","Ragie Doromal","doctor","admin@admin.com","","$2y$10$AZAapa9DoqH7AMy41ihSBuKXLMfAlG6f32AyRWXXtkE8oFrtrZC5y","","2019-09-13 07:38:02","2019-10-17 16:47:24");
INSERT INTO users VALUES("2","uploads/no-profile.jpg","bryan","staff","staff@admin.com","","$2y$10$HWuNxvs4GZCvQwLatQw1AeB2I4pa4ou4SMBpgmdJGLkyh5NJ.ndW6","","2019-10-17 14:44:43","2019-10-17 14:44:43");




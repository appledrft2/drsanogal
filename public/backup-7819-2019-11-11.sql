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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO appointments VALUES("11","2","2019-11-10","2019-11-20","09:11 AM","2019-11-10","38.55","52.11","5 in 1 vaccination","1500.00","","1500","1","0","Not Completed","2019-11-10 09:19:20","2019-11-10 11:46:04");
INSERT INTO appointments VALUES("12","2","2019-11-10","2019-11-16","09:11 AM","2019-11-10","38.55","52.11","Bordetella","250.00","","250","1","0","Not Completed","2019-11-10 09:19:20","2019-11-11 10:48:26");
INSERT INTO appointments VALUES("14","2","2019-11-10","2019-11-16","02:11 PM","2019-11-10","38.55","52.1","Deworming","150.00","","150","0","0","Not Completed","2019-11-10 14:01:19","2019-11-11 10:48:26");
INSERT INTO appointments VALUES("15","4","2019-11-11","2019-11-16","10:11 AM","2019-11-11","35.6","20.88","Tick and Flea Prevention","100.00","","100","0","0","Not Completed","2019-11-11 10:32:46","2019-11-11 10:48:26");
INSERT INTO appointments VALUES("16","4","2019-11-11","2019-11-16","10:11 AM","2019-11-11","35.6","20.88","Rabies Vaccination","100.00","","100","0","0","Not Completed","2019-11-11 10:32:46","2019-11-11 10:32:46");



DROP TABLE backuplists;

CREATE TABLE `backuplists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO backuplists VALUES("2","backup-3880-2019-11-08.sql","2019-11-08 13:46:53","0000-00-00 00:00:00");



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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO billing_products VALUES("3","13","VitalC","Medicine","bot","250","2","2019-11-10 11:31:30","2019-11-10 11:31:30");
INSERT INTO billing_products VALUES("4","14","VitalC","Medicine","bot","250","3","2019-11-10 11:45:21","2019-11-10 11:45:21");



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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO billing_services VALUES("5","13","Bordetella","250","2019-11-10 11:31:30","2019-11-10 11:31:30");
INSERT INTO billing_services VALUES("6","14","5 in 1 vaccination","1500","2019-11-10 11:45:21","2019-11-10 11:45:21");



DROP TABLE billings;

CREATE TABLE `billings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `rcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `netamount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payments` double unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `billings_client_id_index` (`client_id`),
  CONSTRAINT `billings_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO billings VALUES("13","2","RS-7277","750","350","2019-11-10 11:31:30","2019-11-10 11:31:30","1000");
INSERT INTO billings VALUES("14","2","RS-2208","2250","1650","2019-11-10 11:45:21","2019-11-10 11:45:21","3000");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO client_forms VALUES("2","2","files/1573222018_BoardingConsent-Cantilla.docx","Boarding Consent","2019-11-08 22:06:59","2019-11-08 22:06:59");



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
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_name_unique` (`name`),
  UNIQUE KEY `clients_email_unique` (`email`),
  UNIQUE KEY `clients_contact_unique` (`contact`),
  UNIQUE KEY `clients_work_unique` (`work`),
  UNIQUE KEY `clients_home_unique` (`home`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO clients VALUES("2","Willmar Cantilla","Male","Student","willmar123@gmail.com","09151535150","","","Mobile","Sagay City","Active","2019-11-08 20:35:38","2019-11-08 20:35:38");
INSERT INTO clients VALUES("3","Maureen Martin","Female","Student","mmartin06@gmail.com","09475846732","","","Mobile","Prk.Sampaguita,Brgy. Alimango, Escalante City, Negros Occidental","Active","2019-11-11 10:29:44","2019-11-11 10:29:44");



DROP TABLE form_categories;

CREATE TABLE `form_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO form_categories VALUES("2","Boarding Consent","","2019-11-08 21:44:28","2019-11-08 21:44:28");
INSERT INTO form_categories VALUES("12","Anesthesia & Surgery Consent","","2019-11-08 21:44:49","2019-11-08 21:44:49");
INSERT INTO form_categories VALUES("22","Laboratories","","2019-11-08 21:45:02","2019-11-08 21:45:02");
INSERT INTO form_categories VALUES("32","Other","","2019-11-08 21:45:10","2019-11-08 21:45:10");



DROP TABLE manage_appointments;

CREATE TABLE `manage_appointments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO manage_appointments VALUES("2","5 in 1 vaccination","1500.00","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.","2019-11-08 21:35:53","2019-11-10 07:29:42");
INSERT INTO manage_appointments VALUES("12","Deworming","100.00","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.","2019-11-08 21:36:05","2019-11-08 21:36:05");
INSERT INTO manage_appointments VALUES("22","Rabies Vaccination","100.00","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.","2019-11-08 21:36:09","2019-11-08 21:36:09");
INSERT INTO manage_appointments VALUES("32","Bordetella","250.00","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.","2019-11-08 21:36:16","2019-11-10 07:29:49");
INSERT INTO manage_appointments VALUES("42","Leptospirosis","100.00","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.","2019-11-08 21:36:23","2019-11-08 21:36:23");
INSERT INTO manage_appointments VALUES("52","Heartworm Prevention","100.00","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.","2019-11-08 21:36:28","2019-11-08 21:36:28");
INSERT INTO manage_appointments VALUES("62","Tick and Flea Prevention","100.00","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.","2019-11-08 21:36:32","2019-11-08 21:36:32");
INSERT INTO manage_appointments VALUES("72","Mange Treatment","100.00","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.","2019-11-08 21:36:38","2019-11-08 21:36:38");
INSERT INTO manage_appointments VALUES("82","Laboratory","100.00","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.","2019-11-08 21:37:00","2019-11-08 21:37:00");
INSERT INTO manage_appointments VALUES("92","Check-up","399.00","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.","2019-11-08 21:37:07","2019-11-10 07:29:58");



DROP TABLE migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES("2","2014_10_12_000000_create_users_table","1");
INSERT INTO migrations VALUES("12","2014_10_12_100000_create_password_resets_table","1");
INSERT INTO migrations VALUES("22","2019_07_02_111515_create_clients_table","1");
INSERT INTO migrations VALUES("32","2019_07_02_165426_create_announcements_table","1");
INSERT INTO migrations VALUES("42","2019_07_03_130331_create_patients_table","1");
INSERT INTO migrations VALUES("52","2019_07_04_160529_create_appointments_table","1");
INSERT INTO migrations VALUES("62","2019_07_04_162727_create_suppliers_table","1");
INSERT INTO migrations VALUES("72","2019_07_05_090403_create_products_table","1");
INSERT INTO migrations VALUES("82","2019_07_07_134050_create_preventives_table","1");
INSERT INTO migrations VALUES("92","2019_07_09_050906_create_stock_ins_table","1");
INSERT INTO migrations VALUES("102","2019_07_09_125416_create_stockindetail_table","1");
INSERT INTO migrations VALUES("112","2019_07_11_234121_create_stock_outs_table","1");
INSERT INTO migrations VALUES("122","2019_07_14_143315_create_stockout_details_table","1");
INSERT INTO migrations VALUES("132","2019_07_16_162758_create_product_categories_table","1");
INSERT INTO migrations VALUES("142","2019_07_17_130028_create_product_units_table","1");
INSERT INTO migrations VALUES("152","2019_07_17_234154_create_billings_table","1");
INSERT INTO migrations VALUES("162","2019_07_17_234626_create_billing_products_table","1");
INSERT INTO migrations VALUES("172","2019_07_18_001132_create_billing_services_table","1");
INSERT INTO migrations VALUES("182","2019_07_23_165136_create_manage_appointments_table","1");
INSERT INTO migrations VALUES("192","2019_07_25_134234_create_client_forms_table","1");
INSERT INTO migrations VALUES("202","2019_07_31_234258_create_form_categories_table","1");
INSERT INTO migrations VALUES("212","2019_10_17_141704_create_systemlogs_table","1");
INSERT INTO migrations VALUES("222","2019_10_24_105224_create_backuplists_table","1");
INSERT INTO migrations VALUES("232","2019_10_24_132422_create_reschedules_table","1");



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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO patients VALUES("2","2","Brownie","Bulldog","Male","Canine","none","none","Ragie Doromal","2019-03-06","2019-11-08 20:36:06","2019-11-08 20:36:06");
INSERT INTO patients VALUES("3","3","Scrappy","Shih Tzu","Male","Canine","none","none","Rocel Sanogal","2019-06-04","2019-11-11 10:30:33","2019-11-11 10:32:00");
INSERT INTO patients VALUES("4","3","Rosey","Pug","Male","Canine","none","none","Rocel Sanogal","2019-07-10","2019-11-11 10:31:50","2019-11-11 10:31:50");



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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO product_categories VALUES("2","Dog Food","","2019-11-08 21:45:32","2019-11-08 21:45:32");
INSERT INTO product_categories VALUES("12","Cat Food","","2019-11-08 21:45:37","2019-11-08 21:45:37");
INSERT INTO product_categories VALUES("22","Medicine","","2019-11-08 21:45:53","2019-11-08 21:45:53");



DROP TABLE product_units;

CREATE TABLE `product_units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO product_units VALUES("2","pc","","2019-11-08 21:46:24","2019-11-08 21:46:24");
INSERT INTO product_units VALUES("12","kg","","2019-11-08 21:46:27","2019-11-08 21:46:27");
INSERT INTO product_units VALUES("22","bot","","2019-11-08 21:46:31","2019-11-08 21:46:31");
INSERT INTO product_units VALUES("32","ml","","2019-11-08 21:46:38","2019-11-08 21:46:38");



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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products VALUES("2","2","Whiskas","Cat Food","pc","100","150","138","151","uploads/noimage.png","2019-11-08 21:06:26","2019-11-10 14:09:13");
INSERT INTO products VALUES("12","2","Pedegree","Dog Food","pc","100","150","99","50","uploads/noimage.png","2019-11-09 08:25:08","2019-11-10 09:22:48");
INSERT INTO products VALUES("22","2","VitalC","Medicine","bot","200","250","92","50","uploads/noimage.png","2019-11-09 08:29:21","2019-11-10 11:45:21");



DROP TABLE reschedules;

CREATE TABLE `reschedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` bigint(20) unsigned NOT NULL,
  `prev_date` date NOT NULL,
  `reschedule_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reschedules_appointment_id_index` (`appointment_id`),
  CONSTRAINT `reschedules_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO reschedules VALUES("5","12","2019-11-14","2019-11-15","2019-11-10 11:45:55","2019-11-10 11:45:55");
INSERT INTO reschedules VALUES("6","11","2019-11-15","2019-11-20","2019-11-10 11:46:04","2019-11-10 11:46:04");
INSERT INTO reschedules VALUES("7","12","2019-11-15","2019-11-20","2019-11-10 11:46:04","2019-11-10 11:46:04");
INSERT INTO reschedules VALUES("8","12","2019-11-15","2019-11-16","2019-11-11 10:48:26","2019-11-11 10:48:26");
INSERT INTO reschedules VALUES("9","14","2019-11-15","2019-11-16","2019-11-11 10:48:26","2019-11-11 10:48:26");
INSERT INTO reschedules VALUES("10","15","2019-11-15","2019-11-16","2019-11-11 10:48:26","2019-11-11 10:48:26");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stock_in_details VALUES("2","Whiskas","2","100","150","50","2019-11-08 21:06:53","2019-11-08 21:06:53");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stock_ins VALUES("2","2","DC-4670","2019-11-08","4500","","Credit","0","2019-11-30","0.10","Unpaid","2019-11-08 21:06:53","2019-11-08 21:06:53");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stock_out_details VALUES("1","Pedegree","1","Dog Food","pc","150","50","1","150","2019-11-10 09:22:48","2019-11-10 09:22:48");
INSERT INTO stock_out_details VALUES("2","Whiskas","2","Cat Food","pc","150","600","12","1800","2019-11-10 14:09:13","2019-11-10 14:09:13");



DROP TABLE stock_outs;

CREATE TABLE `stock_outs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payments` double unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stock_outs VALUES("1","RS-2327","150","2019-11-10 09:22:48","2019-11-10 09:22:48","");
INSERT INTO stock_outs VALUES("2","RS-5117","1800","2019-11-10 14:09:13","2019-11-10 14:09:13","2000");



DROP TABLE suppliers;

CREATE TABLE `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO suppliers VALUES("2","Falcor Marketing","122383625","Bacolod City","2019-11-08 21:06:08","2019-11-08 21:06:08");



DROP TABLE systemlogs;

CREATE TABLE `systemlogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO systemlogs VALUES("2","Ragie Doromal","Doctor","Logged In Successfully","2019-11-08 20:34:36","2019-11-08 20:34:36");
INSERT INTO systemlogs VALUES("12","Ragie Doromal","Doctor"," Added new account named \"Yul Bryan Varca\"","2019-11-08 20:34:59","2019-11-08 20:34:59");
INSERT INTO systemlogs VALUES("22","Ragie Doromal","Doctor"," Added new client named \"Willmar Cantilla\" ","2019-11-08 20:35:38","2019-11-08 20:35:38");
INSERT INTO systemlogs VALUES("32","Ragie Doromal","Doctor"," Added new patient named \"Brownie\" from owner Willmar Cantilla","2019-11-08 20:36:06","2019-11-08 20:36:06");
INSERT INTO systemlogs VALUES("42","Ragie Doromal","Doctor"," Added new appointment \"Others\" from pet Brownie owned by Willmar Cantilla","2019-11-08 20:36:32","2019-11-08 20:36:32");
INSERT INTO systemlogs VALUES("52","Ragie Doromal","Doctor"," Created new supplier named \"Falcor Marketing\" ","2019-11-08 21:06:08","2019-11-08 21:06:08");
INSERT INTO systemlogs VALUES("62","Ragie Doromal","Doctor"," Added new product named \"Whiskas\"","2019-11-08 21:06:26","2019-11-08 21:06:26");
INSERT INTO systemlogs VALUES("72","Ragie Doromal","Doctor"," Added new delivery from supplier \"Falcor Marketing\" with an amount of ?4500","2019-11-08 21:06:53","2019-11-08 21:06:53");
INSERT INTO systemlogs VALUES("82","Ragie Doromal","Doctor"," Updated product named \"Whiskas\"","2019-11-08 21:07:16","2019-11-08 21:07:16");
INSERT INTO systemlogs VALUES("92","Ragie Doromal","Doctor","Logged In Successfully","2019-11-08 21:21:31","2019-11-08 21:21:31");
INSERT INTO systemlogs VALUES("102","Ragie Doromal","Doctor","Logged Out Successfully","2019-11-08 21:26:58","2019-11-08 21:26:58");
INSERT INTO systemlogs VALUES("112","Yul Bryan Varca","Staff","Logged In Successfully","2019-11-08 21:27:07","2019-11-08 21:27:07");
INSERT INTO systemlogs VALUES("122","Yul Bryan Varca","Staff","Logged Out Successfully","2019-11-08 21:30:45","2019-11-08 21:30:45");
INSERT INTO systemlogs VALUES("132","Ragie Doromal","Doctor","Logged In Successfully","2019-11-08 21:30:52","2019-11-08 21:30:52");
INSERT INTO systemlogs VALUES("142","Ragie Doromal","Doctor"," Updated appointment \"Deworming\" from pet Brownie owned by Willmar Cantilla","2019-11-08 21:49:28","2019-11-08 21:49:28");
INSERT INTO systemlogs VALUES("152","Ragie Doromal","Doctor","Logged In Successfully","2019-11-08 22:06:17","2019-11-08 22:06:17");
INSERT INTO systemlogs VALUES("162","Ragie Doromal","Doctor"," Added new client named \"Maureen Martin\" ","2019-11-08 22:09:22","2019-11-08 22:09:22");
INSERT INTO systemlogs VALUES("172","Ragie Doromal","Doctor"," Added new patient named \"Rose\" from owner Maureen Martin","2019-11-08 22:09:54","2019-11-08 22:09:54");
INSERT INTO systemlogs VALUES("182","Ragie Doromal","Doctor"," Added new appointment \"5 in 1 vaccination\" from pet Rose owned by Maureen Martin","2019-11-08 22:10:16","2019-11-08 22:10:16");
INSERT INTO systemlogs VALUES("192","Ragie Doromal","Doctor","Logged Out Successfully","2019-11-08 22:14:38","2019-11-08 22:14:38");
INSERT INTO systemlogs VALUES("202","Yul Bryan Varca","Staff","Logged In Successfully","2019-11-08 22:14:46","2019-11-08 22:14:46");
INSERT INTO systemlogs VALUES("212","Yul Bryan Varca","Staff","Logged Out Successfully","2019-11-08 22:35:15","2019-11-08 22:35:15");
INSERT INTO systemlogs VALUES("222","Yul Bryan Varca","Staff","Logged Out Successfully","2019-11-08 22:35:22","2019-11-08 22:35:22");
INSERT INTO systemlogs VALUES("232","Ragie Doromal","Doctor","Logged In Successfully","2019-11-09 08:24:22","2019-11-09 08:24:22");
INSERT INTO systemlogs VALUES("242","Ragie Doromal","Doctor"," Added new product named \"Pedegree\"","2019-11-09 08:25:08","2019-11-09 08:25:08");
INSERT INTO systemlogs VALUES("252","Ragie Doromal","Doctor"," Updated product named \"Whiskas\"","2019-11-09 08:25:20","2019-11-09 08:25:20");
INSERT INTO systemlogs VALUES("262","Ragie Doromal","Doctor"," Added new product named \"VitalC\"","2019-11-09 08:29:21","2019-11-09 08:29:21");
INSERT INTO systemlogs VALUES("272","Ragie Doromal","Doctor","Logged In Successfully","2019-11-09 21:58:53","2019-11-09 21:58:53");
INSERT INTO systemlogs VALUES("273","Ragie Doromal","Doctor","Logged In Successfully","2019-11-10 07:02:21","2019-11-10 07:02:21");
INSERT INTO systemlogs VALUES("274","Ragie Doromal","Doctor"," Added new appointment \"5 in 1 vaccination\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:23:28","2019-11-10 07:23:28");
INSERT INTO systemlogs VALUES("275","Ragie Doromal","Doctor"," Added new appointment \"5 in 1 vaccination\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:25:54","2019-11-10 07:25:54");
INSERT INTO systemlogs VALUES("276","Ragie Doromal","Doctor"," Added new appointment \"Bordetella\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:25:54","2019-11-10 07:25:54");
INSERT INTO systemlogs VALUES("277","Ragie Doromal","Doctor"," Deleted appointment \"Bordetella\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:26:33","2019-11-10 07:26:33");
INSERT INTO systemlogs VALUES("278","Ragie Doromal","Doctor"," Deleted appointment \"5 in 1 vaccination\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:26:36","2019-11-10 07:26:36");
INSERT INTO systemlogs VALUES("279","Ragie Doromal","Doctor"," Deleted appointment \"5 in 1 vaccination\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:26:38","2019-11-10 07:26:38");
INSERT INTO systemlogs VALUES("280","Ragie Doromal","Doctor"," Added new appointment \"5 in 1 vaccination\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:26:46","2019-11-10 07:26:46");
INSERT INTO systemlogs VALUES("281","Ragie Doromal","Doctor"," Added new appointment \"Deworming\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:27:25","2019-11-10 07:27:25");
INSERT INTO systemlogs VALUES("282","Ragie Doromal","Doctor"," Added new appointment \"Mange Treatment\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:27:25","2019-11-10 07:27:25");
INSERT INTO systemlogs VALUES("283","Ragie Doromal","Doctor"," Deleted appointment \"Deworming\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:27:35","2019-11-10 07:27:35");
INSERT INTO systemlogs VALUES("284","Ragie Doromal","Doctor"," Deleted appointment \"5 in 1 vaccination\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:27:38","2019-11-10 07:27:38");
INSERT INTO systemlogs VALUES("285","Ragie Doromal","Doctor"," Added new appointment \"5 in 1 vaccination\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:30:51","2019-11-10 07:30:51");
INSERT INTO systemlogs VALUES("286","Ragie Doromal","Doctor"," Added new appointment \"Bordetella\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:30:51","2019-11-10 07:30:51");
INSERT INTO systemlogs VALUES("287","Ragie Doromal","Doctor"," Added new appointment \"Heartworm Prevention\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:30:51","2019-11-10 07:30:51");
INSERT INTO systemlogs VALUES("288","Ragie Doromal","Doctor"," Deleted appointment \"Mange Treatment\" from pet Brownie owned by Willmar Cantilla","2019-11-10 07:31:09","2019-11-10 07:31:09");
INSERT INTO systemlogs VALUES("289","Ragie Doromal","Doctor","Logged Out Successfully","2019-11-10 09:10:57","2019-11-10 09:10:57");
INSERT INTO systemlogs VALUES("290","Ragie Doromal","Doctor"," Deleted appointment \"Bordetella\" from pet Brownie owned by Willmar Cantilla","2019-11-10 09:18:19","2019-11-10 09:18:19");
INSERT INTO systemlogs VALUES("291","Ragie Doromal","Doctor"," Deleted appointment \"5 in 1 vaccination\" from pet Brownie owned by Willmar Cantilla","2019-11-10 09:18:21","2019-11-10 09:18:21");
INSERT INTO systemlogs VALUES("292","Ragie Doromal","Doctor"," Deleted appointment \"Heartworm Prevention\" from pet Brownie owned by Willmar Cantilla","2019-11-10 09:18:25","2019-11-10 09:18:25");
INSERT INTO systemlogs VALUES("293","Ragie Doromal","Doctor","Logged In Successfully","2019-11-10 09:18:26","2019-11-10 09:18:26");
INSERT INTO systemlogs VALUES("294","Ragie Doromal","Doctor"," Deleted appointment \"5 in 1 vaccination\" from pet Brownie owned by Willmar Cantilla","2019-11-10 09:18:27","2019-11-10 09:18:27");
INSERT INTO systemlogs VALUES("295","Ragie Doromal","Doctor"," Added new appointment \"5 in 1 vaccination\" from pet Brownie owned by Willmar Cantilla","2019-11-10 09:19:20","2019-11-10 09:19:20");
INSERT INTO systemlogs VALUES("296","Ragie Doromal","Doctor"," Added new appointment \"Bordetella\" from pet Brownie owned by Willmar Cantilla","2019-11-10 09:19:20","2019-11-10 09:19:20");
INSERT INTO systemlogs VALUES("297","Ragie Doromal","Doctor"," Added new transaction from point of sales with an amount of ?150","2019-11-10 09:22:48","2019-11-10 09:22:48");
INSERT INTO systemlogs VALUES("298","Ragie Doromal","Doctor","Logged Out Successfully","2019-11-10 11:45:37","2019-11-10 11:45:37");
INSERT INTO systemlogs VALUES("299","Ragie Doromal","Doctor","Logged In Successfully","2019-11-10 11:45:43","2019-11-10 11:45:43");
INSERT INTO systemlogs VALUES("300","Ragie Doromal","Doctor"," Added new appointment \"Deworming\" from pet Brownie owned by Willmar Cantilla","2019-11-10 14:01:09","2019-11-10 14:01:09");
INSERT INTO systemlogs VALUES("301","Ragie Doromal","Doctor"," Deleted appointment \"Deworming\" from pet Brownie owned by Willmar Cantilla","2019-11-10 14:01:13","2019-11-10 14:01:13");
INSERT INTO systemlogs VALUES("302","Ragie Doromal","Doctor"," Added new appointment \"5 in 1 vaccination\" from pet Brownie owned by Willmar Cantilla","2019-11-10 14:01:19","2019-11-10 14:01:19");
INSERT INTO systemlogs VALUES("303","Ragie Doromal","Doctor"," Updated appointment \"Deworming\" from pet Brownie owned by Willmar Cantilla","2019-11-10 14:01:34","2019-11-10 14:01:34");
INSERT INTO systemlogs VALUES("304","Ragie Doromal","Doctor"," Added new appointment \"Bordetella\" from pet Brownie owned by Willmar Cantilla","2019-11-10 14:01:53","2019-11-10 14:01:53");
INSERT INTO systemlogs VALUES("305","Ragie Doromal","Doctor"," Added new appointment \"Laboratory\" from pet Brownie owned by Willmar Cantilla","2019-11-10 14:01:53","2019-11-10 14:01:53");
INSERT INTO systemlogs VALUES("306","Ragie Doromal","Doctor"," Deleted appointment \"Laboratory\" from pet Brownie owned by Willmar Cantilla","2019-11-10 14:01:56","2019-11-10 14:01:56");
INSERT INTO systemlogs VALUES("307","Ragie Doromal","Doctor"," Deleted appointment \"Bordetella\" from pet Brownie owned by Willmar Cantilla","2019-11-10 14:01:58","2019-11-10 14:01:58");
INSERT INTO systemlogs VALUES("308","Ragie Doromal","Doctor"," Added new transaction from point of sales with an amount of ?1800","2019-11-10 14:09:14","2019-11-10 14:09:14");
INSERT INTO systemlogs VALUES("309","Ragie Doromal","Doctor","Logged In Successfully","2019-11-10 19:21:35","2019-11-10 19:21:35");
INSERT INTO systemlogs VALUES("310","Ragie Doromal","Doctor","Logged Out Successfully","2019-11-10 19:24:59","2019-11-10 19:24:59");
INSERT INTO systemlogs VALUES("311","Ragie Doromal","Doctor","Logged In Successfully","2019-11-11 10:28:56","2019-11-11 10:28:56");
INSERT INTO systemlogs VALUES("312","Ragie Doromal","Doctor"," Added new client named \"Maureen Martin\" ","2019-11-11 10:29:44","2019-11-11 10:29:44");
INSERT INTO systemlogs VALUES("313","Ragie Doromal","Doctor","Logged In Successfully","2019-11-11 10:29:45","2019-11-11 10:29:45");
INSERT INTO systemlogs VALUES("314","Ragie Doromal","Doctor"," Added new patient named \"Scrappy\" from owner Maureen Martin","2019-11-11 10:30:33","2019-11-11 10:30:33");
INSERT INTO systemlogs VALUES("315","Ragie Doromal","Doctor"," Added new account named \"Rocel Sanogal\"","2019-11-11 10:31:07","2019-11-11 10:31:07");
INSERT INTO systemlogs VALUES("316","Ragie Doromal","Doctor"," Added new patient named \"Rosey\" from owner Maureen Martin","2019-11-11 10:31:50","2019-11-11 10:31:50");
INSERT INTO systemlogs VALUES("317","Ragie Doromal","Doctor"," Updated patient named \"Scrappy\" from owner Maureen Martin","2019-11-11 10:32:00","2019-11-11 10:32:00");
INSERT INTO systemlogs VALUES("318","Ragie Doromal","Doctor"," Added new appointment \"Tick and Flea Prevention\" from pet Rosey owned by Maureen Martin","2019-11-11 10:32:46","2019-11-11 10:32:46");
INSERT INTO systemlogs VALUES("319","Ragie Doromal","Doctor"," Added new appointment \"Rabies Vaccination\" from pet Rosey owned by Maureen Martin","2019-11-11 10:32:46","2019-11-11 10:32:46");
INSERT INTO systemlogs VALUES("320","Ragie Doromal","Doctor"," Updated appointment \"Deworming\" from pet Brownie owned by Willmar Cantilla","2019-11-11 10:33:42","2019-11-11 10:33:42");
INSERT INTO systemlogs VALUES("321","Ragie Doromal","Doctor"," Updated appointment \"Bordetella\" from pet Brownie owned by Willmar Cantilla","2019-11-11 10:33:57","2019-11-11 10:33:57");
INSERT INTO systemlogs VALUES("322","Ragie Doromal","Doctor","Logged Out Successfully","2019-11-11 10:34:31","2019-11-11 10:34:31");
INSERT INTO systemlogs VALUES("323","Ragie Doromal","Doctor","Logged In Successfully","2019-11-11 10:46:35","2019-11-11 10:46:35");
INSERT INTO systemlogs VALUES("324","Ragie Doromal","Doctor","Logged In Successfully","2019-11-11 14:17:39","2019-11-11 14:17:39");



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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES("1","uploads/no-profile.jpg","Ragie Doromal","doctor","admin@drsandjveterinaryclinic.shop","","$2y$10$aRQG9PWM4GNolEvgUMlwyOwNS3eLcPUI59LwOwI/8GEUW5QHDXNIK","","2019-11-09 20:10:39","2019-11-09 20:10:39");
INSERT INTO users VALUES("12","uploads/no-profile.jpg","Yul Bryan Varca","staff","staff@drsandjveterinaryclinic.shop","0000-00-00 00:00:00","$2y$10$WSGqHPY5r9nk.nQGzga.WuUDGGaoe8xaVrEg9l2LTO8zwq8huq8Zy","","2019-11-08 20:34:59","2019-11-08 20:34:59");
INSERT INTO users VALUES("13","uploads/no-profile.jpg","Rocel Sanogal","doctor","admin2@admin.com","","$2y$10$lLvy18.bjgPPLrKAxWYIN.suwVkt7/eVuu2ax0FkDAX0hHJ0HkTPu","","2019-11-11 10:31:07","2019-11-11 10:31:07");




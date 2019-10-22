DROP TABLE activity_log;

CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_log_log_name_index` (`log_name`),
  KEY `subject` (`subject_id`,`subject_type`),
  KEY `causer` (`causer_id`,`causer_type`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO activity_log VALUES("1","default","Look, I logged something","","","","","[]","2019-10-19 17:27:25","2019-10-19 17:27:25");



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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO appointments VALUES("2","4","2019-10-18","2019-10-25","10:10 AM","2019-10-18","38.55","52.11","Deworming","1500","","1500","1","0","Not Completed","2019-10-18 10:49:35","2019-10-18 10:50:29");
INSERT INTO appointments VALUES("3","4","2019-10-18","","10:10 AM","2019-10-18","38.55","52.11","Check Up","500","","500","1","0","Not Completed","2019-10-18 10:49:36","2019-10-18 10:50:29");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO billing_products VALUES("1","2","S&J Dog Cologne 120ml","Accessories","bot","300","1","2019-10-18 10:50:29","2019-10-18 10:50:29");
INSERT INTO billing_products VALUES("2","2","Vital-C","Medicine","tab","60","1","2019-10-18 10:50:29","2019-10-18 10:50:29");



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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO billing_services VALUES("2","2","Deworming","1500","2019-10-18 10:50:29","2019-10-18 10:50:29");
INSERT INTO billing_services VALUES("3","2","Check Up","500","2019-10-18 10:50:29","2019-10-18 10:50:29");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO billings VALUES("2","2","RS-1470","2360","2010","2019-10-18 10:50:29","2019-10-18 10:50:29");



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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO clients VALUES("2","Maureen Martin","Female","Student","maruen@gmail.com","0923452643"," "," ","Mobile","Old Sagay","2019-10-18 10:47:42","2019-10-22 10:01:35");
INSERT INTO clients VALUES("6","Liff Cadagat Dionesa","Male","Student","liff@gmail.com","09151535158"," "," ","Mobile","Escalante City","2019-10-22 10:01:47","2019-10-22 10:01:47");



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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO manage_appointments VALUES("1","Check Up","Check up the client\'s pet.","2019-10-17 20:31:05","2019-10-17 20:31:05");
INSERT INTO manage_appointments VALUES("2","5 in 1 vaccination","","2019-10-17 20:42:51","2019-10-17 20:42:51");
INSERT INTO manage_appointments VALUES("3","Deworming","","2019-10-17 20:42:58","2019-10-17 20:42:58");
INSERT INTO manage_appointments VALUES("4","Rabies Vaccination","","2019-10-17 20:43:05","2019-10-17 20:43:05");
INSERT INTO manage_appointments VALUES("5","Bordetella","","2019-10-17 20:43:14","2019-10-17 20:43:14");
INSERT INTO manage_appointments VALUES("6","Leptospirosis","","2019-10-17 20:43:19","2019-10-17 20:43:19");
INSERT INTO manage_appointments VALUES("7","Heartworm","","2019-10-17 20:43:24","2019-10-17 20:43:24");
INSERT INTO manage_appointments VALUES("8","Prevention","","2019-10-17 20:43:28","2019-10-17 20:43:28");
INSERT INTO manage_appointments VALUES("9","Tick and Flea Prevention","","2019-10-17 20:43:35","2019-10-17 20:43:35");
INSERT INTO manage_appointments VALUES("10","Mange Treatment","","2019-10-17 20:43:41","2019-10-17 20:43:41");
INSERT INTO manage_appointments VALUES("11","Laboratory","","2019-10-17 20:43:51","2019-10-17 20:43:51");
INSERT INTO manage_appointments VALUES("12","Check-up","","2019-10-17 20:43:57","2019-10-17 20:43:57");



DROP TABLE migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES("1","2014_10_12_000000_create_users_table","1");
INSERT INTO migrations VALUES("2","2014_10_12_100000_create_password_resets_table","1");
INSERT INTO migrations VALUES("3","2019_07_02_111515_create_clients_table","1");
INSERT INTO migrations VALUES("4","2019_07_02_165426_create_announcements_table","1");
INSERT INTO migrations VALUES("5","2019_07_03_130331_create_patients_table","1");
INSERT INTO migrations VALUES("6","2019_07_04_160529_create_appointments_table","1");
INSERT INTO migrations VALUES("7","2019_07_04_162727_create_suppliers_table","1");
INSERT INTO migrations VALUES("8","2019_07_05_090403_create_products_table","1");
INSERT INTO migrations VALUES("9","2019_07_07_134050_create_preventives_table","1");
INSERT INTO migrations VALUES("10","2019_07_09_050906_create_stock_ins_table","1");
INSERT INTO migrations VALUES("11","2019_07_09_125416_create_stockindetail_table","1");
INSERT INTO migrations VALUES("12","2019_07_11_234121_create_stock_outs_table","1");
INSERT INTO migrations VALUES("13","2019_07_14_143315_create_stockout_details_table","1");
INSERT INTO migrations VALUES("14","2019_07_16_162758_create_product_categories_table","1");
INSERT INTO migrations VALUES("15","2019_07_17_130028_create_product_units_table","1");
INSERT INTO migrations VALUES("16","2019_07_17_234154_create_billings_table","1");
INSERT INTO migrations VALUES("17","2019_07_17_234626_create_billing_products_table","1");
INSERT INTO migrations VALUES("18","2019_07_18_001132_create_billing_services_table","1");
INSERT INTO migrations VALUES("19","2019_07_23_165136_create_manage_appointments_table","1");
INSERT INTO migrations VALUES("20","2019_07_25_134234_create_client_forms_table","1");
INSERT INTO migrations VALUES("21","2019_07_31_234258_create_form_categories_table","1");
INSERT INTO migrations VALUES("22","2019_10_17_141704_create_systemlogs_table","1");
INSERT INTO migrations VALUES("23","2019_10_19_172428_create_activity_log_table","2");



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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO patients VALUES("4","2","Teddy","Shih Tzu","Female","Canine","none","none","Dr. Varca","2019-10-18","2019-10-18 10:48:10","2019-10-18 10:48:10");
INSERT INTO patients VALUES("5","6","max","shepered","Male","Canine","none","none","Dr. Sanogal","2019-10-22","2019-10-22 10:04:12","2019-10-22 10:04:12");
INSERT INTO patients VALUES("6","6","test1","test","Male","Canine","none","none","Dr Sanogal","2019-10-21","2019-10-22 10:05:41","2019-10-22 10:09:25");
INSERT INTO patients VALUES("7","6","james","Shih Tzu","Male","Canine","none","none","Dr.Sanogal","2019-10-29","2019-10-22 10:06:47","2019-10-22 10:06:47");



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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO product_categories VALUES("1","Dog Food","","2019-10-17 20:32:49","2019-10-17 20:32:49");
INSERT INTO product_categories VALUES("2","Cat Food","","2019-10-17 20:32:53","2019-10-17 20:32:53");
INSERT INTO product_categories VALUES("3","Medicine","","2019-10-17 20:32:58","2019-10-17 20:32:58");
INSERT INTO product_categories VALUES("4","Accessories","","2019-10-17 20:33:05","2019-10-17 20:33:05");



DROP TABLE product_units;

CREATE TABLE `product_units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO product_units VALUES("1","pc","","2019-10-17 20:33:24","2019-10-17 20:33:24");
INSERT INTO product_units VALUES("2","kg","","2019-10-17 20:33:27","2019-10-17 20:33:27");
INSERT INTO product_units VALUES("3","bot","","2019-10-17 20:33:31","2019-10-17 20:33:31");
INSERT INTO product_units VALUES("4","tab","","2019-10-17 20:33:35","2019-10-17 20:33:35");



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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products VALUES("1","1","Pedegree","Dog Food","pc","100","150","100","50","uploads/noimage.png","2019-10-17 20:32:38","2019-10-17 20:51:21");
INSERT INTO products VALUES("2","1","Whiskas","Cat Food","pc","100","150","110","50","uploads/noimage.png","2019-10-17 20:34:27","2019-10-17 20:50:44");
INSERT INTO products VALUES("3","1","Vital-C","Medicine","tab","50","60","159","50","uploads/noimage.png","2019-10-17 20:35:19","2019-10-18 10:50:29");
INSERT INTO products VALUES("4","1","S&J Dog Cologne 120ml","Accessories","bot","250","300","48","25","uploads/noimage.png","2019-10-17 20:36:17","2019-10-18 10:50:29");



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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stock_in_details VALUES("1","Pedegree","1","100","150","10","2019-10-17 20:50:44","2019-10-17 20:50:44");
INSERT INTO stock_in_details VALUES("2","Vital-C","1","50","60","10","2019-10-17 20:50:44","2019-10-17 20:50:44");
INSERT INTO stock_in_details VALUES("3","Whiskas","1","100","150","10","2019-10-17 20:50:44","2019-10-17 20:50:44");



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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stock_ins VALUES("1","1","DC-4169","2019-10-17","2500","","Cash","0","2019-10-31","0","Unpaid","2019-10-17 20:50:44","2019-10-17 20:50:45");



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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stock_out_details VALUES("1","Pedegree","1","Dog Food","pc","150","50","1","150","2019-10-17 20:37:12","2019-10-17 20:37:12");
INSERT INTO stock_out_details VALUES("2","S&J Dog Cologne 120ml","1","Accessories","bot","300","50","1","300","2019-10-17 20:37:13","2019-10-17 20:37:13");
INSERT INTO stock_out_details VALUES("3","Pedegree","2","Dog Food","pc","150","450","9","1350","2019-10-17 20:51:22","2019-10-17 20:51:22");



DROP TABLE stock_outs;

CREATE TABLE `stock_outs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stock_outs VALUES("1","RS-2641","450","2019-10-17 20:37:12","2019-10-17 20:37:13");
INSERT INTO stock_outs VALUES("2","RS-6482","1350","2019-10-17 20:51:21","2019-10-17 20:51:22");



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

INSERT INTO suppliers VALUES("1","Supplier 1","09151535158","Escalante City","2019-10-17 20:32:10","2019-10-17 20:32:10");



DROP TABLE systemlogs;

CREATE TABLE `systemlogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `activity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO systemlogs VALUES("18","Doctor : Ragie Doromal has Logged Out Successfully","2019-10-19 18:20:21","2019-10-19 18:20:21");
INSERT INTO systemlogs VALUES("19","Doctor : Ragie Doromal has Logged Out Successfully","2019-10-19 18:21:06","2019-10-19 18:21:06");
INSERT INTO systemlogs VALUES("20","Doctor : Ragie Doromal has Logged In Successfully","2019-10-19 18:21:29","2019-10-19 18:21:29");
INSERT INTO systemlogs VALUES("21","Doctor : Ragie Doromal has Logged In Successfully","2019-10-19 20:31:57","2019-10-19 20:31:57");
INSERT INTO systemlogs VALUES("22","Doctor : Ragie Doromal has Logged In Successfully","2019-10-19 20:32:28","2019-10-19 20:32:28");
INSERT INTO systemlogs VALUES("23","Doctor : Ragie Doromal has Logged Out Successfully","2019-10-19 20:32:51","2019-10-19 20:32:51");
INSERT INTO systemlogs VALUES("24","Doctor : Ragie Doromal has Logged In Successfully","2019-10-19 20:32:58","2019-10-19 20:32:58");
INSERT INTO systemlogs VALUES("25"," Doctor : Ragie Doromal created new announcement \"sdfs\" ","2019-10-19 20:35:23","2019-10-19 20:35:23");
INSERT INTO systemlogs VALUES("26"," Doctor : Ragie Doromal created new announcement \"sfsdf\" ","2019-10-19 20:35:58","2019-10-19 20:35:58");
INSERT INTO systemlogs VALUES("27"," Doctor : Ragie Doromal created new announcement titled \"gdfg\" ","2019-10-19 20:36:24","2019-10-19 20:36:24");
INSERT INTO systemlogs VALUES("28"," Doctor : Ragie Doromal deleted an announcement titled \"gdfg\" ","2019-10-19 20:38:06","2019-10-19 20:38:06");
INSERT INTO systemlogs VALUES("29"," Doctor : Ragie Doromal deleted an announcement titled \"sfsdf\" ","2019-10-19 20:38:18","2019-10-19 20:38:18");
INSERT INTO systemlogs VALUES("30"," Doctor : Ragie Doromal deleted an announcement titled \"sdfs\" ","2019-10-19 20:38:20","2019-10-19 20:38:20");
INSERT INTO systemlogs VALUES("31"," Doctor : Ragie Doromal updated an announcement titled \"This is an announcement\" to This is an announcement 2","2019-10-19 20:39:08","2019-10-19 20:39:08");
INSERT INTO systemlogs VALUES("32","Doctor : Ragie Doromal has Logged In Successfully","2019-10-20 11:23:59","2019-10-20 11:23:59");
INSERT INTO systemlogs VALUES("33","Doctor : Ragie Doromal has Logged In Successfully","2019-10-22 09:54:41","2019-10-22 09:54:41");
INSERT INTO systemlogs VALUES("34"," Doctor : Ragie Doromal deleted an announcement titled \"This is an announcement 2\" ","2019-10-22 09:58:30","2019-10-22 09:58:30");
INSERT INTO systemlogs VALUES("35","Doctor : Ragie Doromal has Logged Out Successfully","2019-10-22 09:59:53","2019-10-22 09:59:53");
INSERT INTO systemlogs VALUES("36","Doctor : Ragie Doromal has Logged In Successfully","2019-10-22 09:59:59","2019-10-22 09:59:59");
INSERT INTO systemlogs VALUES("37","deleted a client named \"Liff Cadagat Dionesa\" ","2019-10-22 10:00:21","2019-10-22 10:00:21");
INSERT INTO systemlogs VALUES("38","deleted a client named \"Liff Cadagat Dionesa\" ","2019-10-22 10:00:26","2019-10-22 10:00:26");
INSERT INTO systemlogs VALUES("39","deleted a client named \"Willmar Cantilla\" ","2019-10-22 10:00:45","2019-10-22 10:00:45");
INSERT INTO systemlogs VALUES("40","deleted a client named \"Liff Cadagat Dionesas\" ","2019-10-22 10:00:50","2019-10-22 10:00:50");
INSERT INTO systemlogs VALUES("41"," Doctor : Ragie Doromal updated a client named \"Maureen Martins\" to Maureen Martins","2019-10-22 10:01:30","2019-10-22 10:01:30");
INSERT INTO systemlogs VALUES("42"," Doctor : Ragie Doromal updated a client named \"Maureen Martin\" to Maureen Martin","2019-10-22 10:01:35","2019-10-22 10:01:35");
INSERT INTO systemlogs VALUES("43"," Doctor : Ragie Doromal added new client named \"Liff Cadagat Dionesa\" ","2019-10-22 10:01:47","2019-10-22 10:01:47");
INSERT INTO systemlogs VALUES("44"," Doctor : Ragie Doromal added new patient named \"max\" ","2019-10-22 10:04:12","2019-10-22 10:04:12");
INSERT INTO systemlogs VALUES("45"," Doctor : Ragie Doromal added new patient named \"test\" to owner 6","2019-10-22 10:05:41","2019-10-22 10:05:41");
INSERT INTO systemlogs VALUES("46"," Doctor : Ragie Doromal added new patient named \"james\" to owner Liff Cadagat Dionesa","2019-10-22 10:06:57","2019-10-22 10:06:57");
INSERT INTO systemlogs VALUES("47"," Doctor : Ragie Doromal deleted a patient named \"james\" to owner Liff Cadagat Dionesa","2019-10-22 10:08:37","2019-10-22 10:08:37");
INSERT INTO systemlogs VALUES("48"," Doctor : Ragie Doromal updated a patient named \"test1\" to test1 from owner Liff Cadagat Dionesa","2019-10-22 10:09:25","2019-10-22 10:09:25");
INSERT INTO systemlogs VALUES("49","Doctor : Ragie Doromal has Logged Out Successfully","2019-10-22 10:10:02","2019-10-22 10:10:02");
INSERT INTO systemlogs VALUES("50","Doctor : Ragie Doromal has Logged In Successfully","2019-10-22 16:05:21","2019-10-22 16:05:21");



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

INSERT INTO users VALUES("1","uploads/j7u5kzOyZnmlLVwPAY5JI93QlHfyYkDaHn7N9LLd.jpeg","Ragie Doromal","doctor","admin@drsandjveterinaryclinic.shop","","$2y$10$d99nKKLz5z6AhS.iyRcpCOjRU/e4j4UL1XuQHoQPXIwcnmHvjFv32","","2019-10-17 20:22:03","2019-10-17 20:27:11");
INSERT INTO users VALUES("2","uploads/no-profile.jpg","Bryan","staff","staff@drsandjveterinaryclinic.shop","","$2y$10$fnOkpuHijksj/E8KakbbVuwyEj56qkws45d1pbv8Tm3XtFho3Hivi","","2019-10-17 20:44:42","2019-10-17 20:44:42");




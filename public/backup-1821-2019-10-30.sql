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

INSERT INTO announcements VALUES("1","1","this is an announcement","<p>the clinic will be closed at nov 2. 2019, and will be opened at nov 5 2019&nbsp;</p><p><br></p><p>-the management</p>","uploads/1572415669_pic.jpg","2019-10-30 14:07:55","2019-10-30 14:07:55");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO appointments VALUES("1","1","2019-10-30","","02:10 PM","2019-10-30","38.55","52.11","Check-up","500","the dog has worm problem","500","0","0","Not Completed","2019-10-30 14:43:45","2019-10-30 14:43:45");
INSERT INTO appointments VALUES("2","1","2019-10-30","2019-11-02","02:10 PM","2019-10-30","38.55","52.11","Deworming","200","","200","0","0","Not Completed","2019-10-30 14:43:45","2019-10-30 14:43:45");



DROP TABLE backuplists;

CREATE TABLE `backuplists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




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
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO clients VALUES("2","Willmar C. Cantilla","Male","Student","ragiedoromal08@gmail.com","09151535150"," "," ","Mobile","Prk.Sampaguita,Brgy. Alimango, Escalante City, Negros Occidental","Active","2019-10-30 14:14:45","2019-10-30 14:14:45");
INSERT INTO clients VALUES("3","JOSE SMITH","Male","Student","maidadarina27@gmail.com","09151535156"," "," ","Mobile","Prk.Sampaguita,Brgy. Alimango, Escalante City, Negros Occidental","Active","2019-10-30 14:16:56","2019-10-30 14:16:56");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO manage_appointments VALUES("1","Check-up","","2019-10-30 14:24:09","2019-10-30 14:24:09");
INSERT INTO manage_appointments VALUES("2","Deworming","Deworming is the","2019-10-30 14:24:14","2019-10-30 14:24:46");



DROP TABLE migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
INSERT INTO migrations VALUES("23","2019_10_24_105224_create_backuplists_table","1");
INSERT INTO migrations VALUES("24","2019_10_24_132422_create_reschedules_table","1");



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

INSERT INTO patients VALUES("1","2","Spot","Shih Tzu","Male","Canine","none","none","Ragie Doromal","2018-11-14","2019-10-30 14:22:58","2019-10-30 14:22:58");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO product_categories VALUES("1","Cat Food","","2019-10-30 15:03:08","2019-10-30 15:03:08");
INSERT INTO product_categories VALUES("2","Dog Food","","2019-10-30 15:03:13","2019-10-30 15:03:13");



DROP TABLE product_units;

CREATE TABLE `product_units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO product_units VALUES("1","pcs","","2019-10-30 15:03:20","2019-10-30 15:03:20");
INSERT INTO product_units VALUES("2","bot","","2019-10-30 15:03:27","2019-10-30 15:03:27");



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

INSERT INTO products VALUES("1","1","Pedegree","Dog Food","bot","100","150","25","10","uploads/noimage.png","2019-10-30 15:04:40","2019-10-30 15:06:36");
INSERT INTO products VALUES("2","1","Whiskas","Cat Food","pcs","100","150","25","10","uploads/noimage.png","2019-10-30 15:05:54","2019-10-30 15:06:36");



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




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

INSERT INTO stock_in_details VALUES("1","Pedegree","1","100","150","10","2019-10-30 15:06:36","2019-10-30 15:06:36");
INSERT INTO stock_in_details VALUES("2","Whiskas","1","100","150","10","2019-10-30 15:06:36","2019-10-30 15:06:36");



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

INSERT INTO stock_ins VALUES("1","1","DC-5374","2019-10-30","2000","","Cash","0","2019-11-01","0","Unpaid","2019-10-30 15:06:36","2019-10-30 15:06:36");



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE stock_outs;

CREATE TABLE `stock_outs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO stock_outs VALUES("1","RS-4554","1","2019-10-30 14:05:53","2019-10-30 14:05:53");



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

INSERT INTO suppliers VALUES("1","Falcor Marketing","09475846732","Prk.Sampaguita,Brgy. Alimango, Escalante City, Negros Occidental","2019-10-30 15:02:55","2019-10-30 15:02:55");



DROP TABLE systemlogs;

CREATE TABLE `systemlogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO systemlogs VALUES("1","Ragie Doromal","Doctor","Logged In Successfully","2019-10-30 13:53:19","2019-10-30 13:53:19");
INSERT INTO systemlogs VALUES("2","Ragie Doromal","Doctor","Logged Out Successfully","2019-10-30 13:53:41","2019-10-30 13:53:41");
INSERT INTO systemlogs VALUES("3","Ragie Doromal","Doctor","Logged In Successfully","2019-10-30 13:54:10","2019-10-30 13:54:10");
INSERT INTO systemlogs VALUES("4","Ragie Doromal","Doctor"," Added new account named \"Yul Bryan Varca\"","2019-10-30 14:04:56","2019-10-30 14:04:56");
INSERT INTO systemlogs VALUES("5","Ragie Doromal","Doctor","Logged Out Successfully","2019-10-30 14:05:12","2019-10-30 14:05:12");
INSERT INTO systemlogs VALUES("6","Yul Bryan Varca","Staff","Logged In Successfully","2019-10-30 14:05:19","2019-10-30 14:05:19");
INSERT INTO systemlogs VALUES("7","Yul Bryan Varca","Staff","Logged Out Successfully","2019-10-30 14:05:58","2019-10-30 14:05:58");
INSERT INTO systemlogs VALUES("8","Ragie Doromal","Doctor","Logged In Successfully","2019-10-30 14:06:07","2019-10-30 14:06:07");
INSERT INTO systemlogs VALUES("9","Ragie Doromal","Doctor"," Created new announcement titled \"this is an announcement\" ","2019-10-30 14:07:49","2019-10-30 14:07:49");
INSERT INTO systemlogs VALUES("10","Ragie Doromal","Doctor","Logged Out Successfully","2019-10-30 14:11:59","2019-10-30 14:11:59");
INSERT INTO systemlogs VALUES("11","Yul Bryan Varca","Staff","Logged In Successfully","2019-10-30 14:12:11","2019-10-30 14:12:11");
INSERT INTO systemlogs VALUES("12","Yul Bryan Varca","Staff"," Added new client named \"Willmar C. Cantilla\" ","2019-10-30 14:14:12","2019-10-30 14:14:12");
INSERT INTO systemlogs VALUES("13","Yul Bryan Varca","Staff"," Added new client named \"Willmar C. Cantilla\" ","2019-10-30 14:14:45","2019-10-30 14:14:45");
INSERT INTO systemlogs VALUES("14","Yul Bryan Varca","Staff"," Deleted  client named \"Willmar C. Cantilla\" ","2019-10-30 14:15:26","2019-10-30 14:15:26");
INSERT INTO systemlogs VALUES("15","Yul Bryan Varca","Staff"," Added new client named \"JOSE SMITH\" ","2019-10-30 14:16:56","2019-10-30 14:16:56");
INSERT INTO systemlogs VALUES("16","Yul Bryan Varca","Staff"," Added new patient named \"Spot\" from owner Willmar C. Cantilla","2019-10-30 14:22:58","2019-10-30 14:22:58");
INSERT INTO systemlogs VALUES("17","Yul Bryan Varca","Staff","Logged Out Successfully","2019-10-30 14:23:25","2019-10-30 14:23:25");
INSERT INTO systemlogs VALUES("18","Ragie Doromal","Doctor","Logged In Successfully","2019-10-30 14:23:32","2019-10-30 14:23:32");
INSERT INTO systemlogs VALUES("19","Ragie Doromal","Doctor"," Added new appointment \"Check-up\" from pet Spot owned by Willmar C. Cantilla","2019-10-30 14:43:45","2019-10-30 14:43:45");
INSERT INTO systemlogs VALUES("20","Ragie Doromal","Doctor"," Added new appointment \"Deworming\" from pet Spot owned by Willmar C. Cantilla","2019-10-30 14:43:45","2019-10-30 14:43:45");
INSERT INTO systemlogs VALUES("21","Ragie Doromal","Doctor","Logged Out Successfully","2019-10-30 14:44:46","2019-10-30 14:44:46");
INSERT INTO systemlogs VALUES("22","Ragie Doromal","Doctor","Logged In Successfully","2019-10-30 14:45:00","2019-10-30 14:45:00");
INSERT INTO systemlogs VALUES("23","Ragie Doromal","Doctor","Logged Out Successfully","2019-10-30 14:45:06","2019-10-30 14:45:06");
INSERT INTO systemlogs VALUES("24","Yul Bryan Varca","Staff","Logged In Successfully","2019-10-30 14:45:22","2019-10-30 14:45:22");
INSERT INTO systemlogs VALUES("25","Yul Bryan Varca","Staff","Logged Out Successfully","2019-10-30 14:58:24","2019-10-30 14:58:24");
INSERT INTO systemlogs VALUES("26","Ragie Doromal","Doctor","Logged In Successfully","2019-10-30 15:02:23","2019-10-30 15:02:23");
INSERT INTO systemlogs VALUES("27","Ragie Doromal","Doctor"," Created new supplier named \"Falcor Marketing\" ","2019-10-30 15:02:55","2019-10-30 15:02:55");
INSERT INTO systemlogs VALUES("28","Ragie Doromal","Doctor"," Added new product named \"Pedegree\"","2019-10-30 15:04:40","2019-10-30 15:04:40");
INSERT INTO systemlogs VALUES("29","Ragie Doromal","Doctor"," Added new product named \"Whiskas\"","2019-10-30 15:05:54","2019-10-30 15:05:54");
INSERT INTO systemlogs VALUES("30","Ragie Doromal","Doctor"," Added new delivery from supplier \"Falcor Marketing\" with an amount of ?2000","2019-10-30 15:06:36","2019-10-30 15:06:36");
INSERT INTO systemlogs VALUES("31","Ragie Doromal","Doctor","Logged Out Successfully","2019-10-30 15:31:26","2019-10-30 15:31:26");
INSERT INTO systemlogs VALUES("32","Yul Bryan Varca","Staff","Logged In Successfully","2019-10-30 15:31:35","2019-10-30 15:31:35");
INSERT INTO systemlogs VALUES("33","Yul Bryan Varca","Staff","Logged Out Successfully","2019-10-30 15:32:19","2019-10-30 15:32:19");
INSERT INTO systemlogs VALUES("34","Yul Bryan Varca","Staff","Logged In Successfully","2019-10-30 17:01:51","2019-10-30 17:01:51");
INSERT INTO systemlogs VALUES("35","Ragie Doromal","Doctor","Logged In Successfully","2019-10-30 17:02:10","2019-10-30 17:02:10");



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

INSERT INTO users VALUES("1","uploads/no-profile.jpg","Ragie Doromal","doctor","admin@drsandjveterinaryclinic.shop","","$2y$10$vlGXepKrxdZX5SPkc./fluXwf7HL4xxH3xBQ.bWOQkuoXvYsTgD92","","2019-10-30 13:53:19","2019-10-30 13:53:19");
INSERT INTO users VALUES("2","uploads/no-profile.jpg","Yul Bryan Varca","staff","yul@gmail.com","","$2y$10$uLyn3ZPCQWnuwPKFlNTshOUAiX5st68ReKoA62Ch/sCRVNt5mApkq","","2019-10-30 14:04:56","2019-10-30 14:04:56");




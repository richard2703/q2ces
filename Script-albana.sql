CREATE TABLE roles (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  guard_name varchar(255) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY roles_name_guard_name_unique (name,guard_name)
);
INSERT INTO roles VALUES 
(1,'Admin','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(2,'User','web','2022-07-25 20:54:16','2022-07-25 20:54:16');

CREATE TABLE permissions (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  guard_name varchar(255) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY permissions_name_guard_name_unique (name,guard_name)
);
INSERT INTO permissions VALUES 
(1,'permission_index','web','2022-07-25 20:54:15','2022-07-25 20:54:15'),
(2,'permission_create','web','2022-07-25 20:54:15','2022-07-25 20:54:15'),
(3,'permission_show','web','2022-07-25 20:54:15','2022-07-25 20:54:15'),
(4,'permission_edit','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(5,'permission_destroy','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(6,'role_index','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(7,'role_create','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(8,'role_show','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(9,'role_edit','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(10,'role_destroy','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(11,'user_index','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(12,'user_create','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(13,'user_show','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(14,'user_edit','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(15,'user_destroy','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(16,'post_index','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(17,'post_create','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(18,'post_show','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(19,'post_edit','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
(20,'post_destroy','web','2022-07-25 20:54:16','2022-07-25 20:54:16');

CREATE TABLE users (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  email_verified_at timestamp NULL,
  password varchar(255) NOT NULL,
  two_factor_secret text DEFAULT NULL,
  two_factor_recovery_codes text DEFAULT NULL,
  remember_token varchar(100) DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  username varchar(255) NULL,
  PRIMARY KEY (id),
  UNIQUE KEY users_email_unique (email),
  UNIQUE KEY users_username_unique (username)
);

create  table model_has_permissions (
permission_id bigint(20) unsigned NOT NULL auto_increment,
model_type varchar(255) NOT NULL,
model_id bigint(20) unsigned NOT NULL,
PRIMARY KEY (permission_id,model_id,model_type),
KEY model_has_permissions_model_id_model_type_index (model_id,model_type),
CONSTRAINT model_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES permissions (id) ON DELETE CASCADE 
);

CREATE TABLE model_has_roles (
  role_id bigint(20) unsigned NOT NULL,
  model_type varchar(255) NOT NULL,
  model_id bigint(20) unsigned NOT NULL,
  PRIMARY KEY (role_id,model_id,model_type),
  KEY model_has_roles_model_id_model_type_index (model_id,model_type),
  CONSTRAINT model_has_roles_role_id_foreign FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE cascade
);

CREATE TABLE role_has_permissions (
  permission_id bigint(20) unsigned NOT NULL,
  role_id bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
);
INSERT INTO role_has_permissions VALUES 
(1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),
(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),
(14,1),(15,1),(16,1),(16,2),(17,1),(17,2),
(18,1),(18,2),(19,1),(19,2),(20,1),(20,2);

CREATE TABLE password_resets (
  email varchar(255) NOT NULL,
  token varchar(255) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  KEY password_resets_email_index (email)
);

/*No creo que sirva para algo*/
create table failed_jobs(
id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
uuid varchar(255) NOT NULL,
connection text NOT NULL,
queue text NOT NULL,
payload longtext NOT NULL,
exception longtext NOT NULL,
failed_at timestamp NOT NULL DEFAULT current_timestamp(),
PRIMARY KEY (id),
UNIQUE KEY failed_jobs_uuid_unique (uuid)
);

/*No lo usamos*/
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);







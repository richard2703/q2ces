/***************************************Tablas de sistema de permisos*/

CREATE TABLE roles (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    guard_name varchar(255) NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY roles_name_guard_name_unique (name, guard_name)
);

CREATE TABLE permissions (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    guard_name varchar(255) NOT NULL,
    apodo varchar(255) NULL,
    comentario text,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY permissions_name_guard_name_unique (name, guard_name)
);

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
    PRIMARY KEY (id)
);

create table model_has_permissions (
    permission_id bigint(20) unsigned NOT NULL auto_increment,
    model_type varchar(255) NOT NULL,
    model_id bigint(20) unsigned NOT NULL,
    PRIMARY KEY (permission_id, model_id, model_type),
    KEY model_has_permissions_model_id_model_type_index (model_id, model_type),
    CONSTRAINT model_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES permissions (id) ON DELETE CASCADE
);

CREATE TABLE model_has_roles (
    role_id bigint(20) unsigned NOT NULL,
    model_type varchar(255) NOT NULL,
    model_id bigint(20) unsigned NOT NULL,
    PRIMARY KEY (role_id, model_id, model_type),
    KEY model_has_roles_model_id_model_type_index (model_id, model_type),
    CONSTRAINT model_has_roles_role_id_foreign FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE cascade
);

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

CREATE TABLE role_has_permissions (
    permission_id bigint(20) unsigned NOT NULL,
    role_id bigint(20) unsigned NOT NULL,
    PRIMARY KEY (`permission_id`, `role_id`),
    KEY `role_has_permissions_role_id_foreign` (`role_id`),
    CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
    CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
);

/***************************************FIN Tablas de sistema de permisos*/

/***************************************DATOS Tablas de sistema de permisos*/

INSERT INTO
    roles
VALUES
    (1,'Admin','web','2022-07-25 20:54:16','2022-07-25 20:54:16'),
    (2,'User','web','2022-07-25 20:54:16','2022-07-25 20:54:16');

INSERT INTO
    `users`
VALUES
    (1,'admin','a@a.com',NULL,'$2y$10$xchASRodwuYH58CYgTt3r.RWshZp3BzYMd6T7pg3ZNZxd4d3fXzUy',NULL,NULL,NULL,'2022-09-26 19:48:41','2022-09-26 19:48:41',NULL);

INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('permission_index','web','2022-07-25 19:54:15','2022-07-25 19:54:15'),
	 ('permission_create','web','2022-07-25 19:54:15','2022-07-25 19:54:15'),
	 ('permission_show','web','2022-07-25 19:54:15','2022-07-25 19:54:15'),
	 ('permission_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('permission_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('role_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('role_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('role_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('role_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('role_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('user_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('user_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('user_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('user_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('user_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('asistencia_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('asistencia_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('asistencia_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('asistencia_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('asistencia_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('personal_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('personal_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('personal_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('personal_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('personal_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('cajachica_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('cajachica_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('cajachica_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('cajachica_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('cajachica_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('maquinaria_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('maquinaria_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('maquinaria_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('maquinaria_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('maquinaria_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('calendario_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('calendario_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('calendario_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('calendario_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('calendario_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('combustible_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('combustible_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('combustible_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('combustible_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('combustible_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('inventario_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('inventario_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('inventario_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('inventario_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('inventario_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('obra_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('obra_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('obra_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('obra_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('obra_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('puesto_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('puesto_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('puesto_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('puesto_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('puesto_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('inventario_restock','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('inventario_mover','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('asistencia_cortesemanal','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('asistencia_horasextra','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('catalogos_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('catalogos_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('catalogos_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('catalogos_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('catalogos_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
     ('maquinaria_mtq_dash','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('maquinaria_mtq_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('maquinaria_mtq_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('maquinaria_mtq_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('maquinaria_mtq_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('maquinaria_mtq_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('docs_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('docs_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('docs_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('docs_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('docs_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('tiposDocs_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('tiposDocs_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('tiposDocs_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('tiposDocs_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('tiposDocs_destroy','web','2022-07-25 19:54:16','2022-07-25�19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('ubicaciones_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('ubicaciones_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('ubicaciones_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('ubicaciones_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('ubicaciones_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('lugares_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('lugares_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('lugares_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('lugares_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('lugares_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('tipoServicios_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('tipoServicios_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('tipoServicios_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('tipoServicios_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('tipoServicios_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('calendarioMtq_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('calendarioMtq_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('calendarioMtq_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('calendarioMtq_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('calendarioMtq_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('checkList_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('checkList_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('checkList_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('checkList_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('checkList_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('mantenimiento_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('mantenimiento_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('mantenimiento_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('mantenimiento_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('mantenimiento_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('bitacora_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('bitacora_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('bitacora_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('bitacora_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('bitacora_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('grupo_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('grupo_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('grupo_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('grupo_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('grupo_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('tarea_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('tarea_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('tarea_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('tarea_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('tarea_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');
	
INSERT INTO permissions (name,guard_name,created_at,updated_at) VALUES
	 ('cliente_index','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('cliente_create','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('cliente_show','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('cliente_edit','web','2022-07-25 19:54:16','2022-07-25 19:54:16'),
	 ('cliente_destroy','web','2022-07-25 19:54:16','2022-07-25 19:54:16');

INSERT INTO
    `model_has_roles`
VALUES
    (1, 'App\\Models\\User', 1);

INSERT INTO
    role_has_permissions
VALUES
    (1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
    (8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
    (14, 1),
	(15, 1);

/***************************************FIN DATOS Tablas de sistema de permisos*/

/***************************************Tablas de Sin FK*/

create table puestoNivel(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    requiereAsistencia int(1) NOT NULL DEFAULT '0',
    usaCajaChica TINYINT(1) NOT NULL DEFAULT '0',
    usoCombustible bigint(20) unsigned NOT null,
    comentario text NULL,
    primary key (id)
);

CREATE TABLE tipoEquipo(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(255) not NULL,
    tipo varchar(200) not NULL,
    comentario text NULL,
    PRIMARY KEY (id)
);

create table estados(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    color varchar(8) NULL,
    comentario text NULL,
    primary key (id)
);

create table prioridades(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    color varchar(8) NULL,
    comentario text NULL,
    primary key (id)
);

create table reparaciones(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    codigo varchar(8) NULL,
    comentario text NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id)
);

create table userEstatus(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    color varchar(8) NULL,
    comentario text NULL,
    primary key (id)
);

create table maquinariaEstatus(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    color varchar(8) NULL,
    comentario text NULL,
    primary key (id)
);

create table tipoAsistencia(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    comentario text NULL,
    color varchar(200) not NULL,
    esAsistencia int NULL,
    primary key (id)
);

create table tipoHoraExtra(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    valor int NULL,
    comentario text NULL,
    color varchar(200) not NULL,
    primary key (id)
);

create table conceptos(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    codigo varchar(200) not NULL,
    nombre varchar(200) not NULL,
    comentario text NULL,
    primary key (id)
);

create table tareaCategoria(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    comentario text NULL,
    primary key (id)
);

create table tareaTipo(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    comentario text NULL,
    primary key (id)
);

create table tareaUbicacion(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    comentario text NULL,
    primary key (id)
);

create table marca(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) NULL,
    comentario text NULL,
    tipo VARCHAR(255) null,
    activo TINYINT(1) NOT NULL DEFAULT '1',
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id)
);

create table proveedorCategoria(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) NULL,
    comentario text NULL,
    activo TINYINT(1) NOT NULL DEFAULT '1',
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id)
);

create table refaccionTipo(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) NULL,
    comentario text NULL,
    activo TINYINT(1) NOT NULL DEFAULT '1',
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id)
);

create table tiposServicios (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    codigo varchar(200) null,
    costo float(10, 2) not NULL,
    comentario text NULL,
    activo TINYINT(1) NOT NULL DEFAULT '1',
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key(id)
);

create table ubicaciones(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    direccion varchar(200) null,
    comentario text NULL,
    activo TINYINT(1) NOT NULL DEFAULT '1',
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key(id)
);

create table serviciosMtq (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    codigo varchar(200) null,
    color varchar(15) not NULL,
    comentario text NULL,
    activo TINYINT(1) NOT NULL DEFAULT '1',
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key(id)
);

CREATE TABLE tipoUniforme(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(100) not NULL,
    comentario text NULL,
    PRIMARY KEY (id)
);

CREATE TABLE clientes(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(255) NULL,
    razonSocial varchar(255) NULL,
    rfc varchar(255) NULL,
    calle varchar(255) NULL,
	exterior varchar(255) NULL,
    interior varchar(255) NULL,
    colonia varchar(255) NULL,
    estado varchar(255) NULL,
    ciudad varchar(255) NULL,
    cp varchar(255) NULL,
    logo varchar(255) NULL,
    fiscal varchar(255) NULL,
    estatus varchar(255) NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id)
);

create table bitacoras(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(255) NULL,
    comentario text NULL,
    activa TINYINT(1) NOT NULL DEFAULT '1',
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id)
);

create table grupo(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(255) NULL,
    comentario text NULL,
    activo TINYINT(1) NOT NULL DEFAULT '1',
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id)
);

CREATE TABLE tiposDocs(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	nombre varchar(200) null,
	comentario text null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id)
);

create table maquinariaCategoria(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    comentario text NULL,
    primary key (id)
);

create table maquinariaTipo(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    comentario text NULL,
    primary key (id)
);

create table tipoValorTarea(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    comentario text NULL,
    primary key (id)
);

create table comprobante(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    comentario text NULL,
    primary key (id)
);

create table tipoMantenimiento(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    comentario text NULL,
    primary key (id)
);

/***************************************FIN Tablas de Sin FK*/

/***************************************DATOS Tablas de Sin FK*/

INSERT INTO
    `puestoNivel` (`id`,`nombre`,`comentario`,`requiereAsistencia`)
VALUES
    (NULL,'Administrativo','Descripción del puesto',0),
    (NULL, 'Gerente', 'Descripción del puesto', 0),
    (NULL, 'Coordinador', 'Descripción del puesto', 0),
    (NULL, 'Mecánico', 'Descripción del puesto', 1),
    (NULL, 'Operador', 'Descripción del puesto', 1),
    (NULL, 'Auxiliar', 'Descripción del puesto', 1);

INSERT INTO
    tipoAsistencia
VALUES
    (1, 'Asistencia',   'Asistio a trabajar','green','1'),
    (2,'Falta','No se presento a trabajar','red','0'),
    (3,'Incapacidad','Se encuentra con incapacidad','darkcyan','0'),
    (4,'Vacaciones','Con permiso de vacaciones','orange','1'),
    (5,'Descanso','Con permiso de descanso o feriado','purple','0');

INSERT INTO
    `tareaCategoria` (`id`,`nombre`,`comentario`)
VALUES
    (NULL,'No definida','Sin categoría definida');

INSERT INTO
    `tareaTipo` (`id`,`nombre`,`comentario`)
VALUES
    (NULL,'No definido','Sin tipo definido');

INSERT INTO
    `tareaUbicacion` (`id`,`nombre`,`comentario`)
VALUES
    (NULL,'No definida','Sin ubicación definida');

INSERT INTO
    `ubicaciones`
values
	(1,'Maquinaria','Maquinaria','Apartado para seleccionar maquinaria',1,'2022-09-26 19:48:41','2022-09-26 19:48:41');

INSERT INTO
    userEstatus
VALUES
    (1, 'Activo', 'green', 'Usuario activo'),
    (2, 'Inactivo', 'darkcyan', 'El usuario esta inactivo'),
    (3, 'Baja', 'orange', 'El usuario fue dado de baja'),
    (4, 'Borrado','red','El usario fue borrado de forma definitiva');

INSERT INTO
    maquinariaEstatus
VALUES
    (1, 'Activo', 'green', 'Maquinaría activa'),
    (2,'Inactivo','darkcyan','La maquinaría esta inactiva'),
    (3,'Baja','orange','La maquinaría esta fue dada de baja'),
    (4,'Borrado','red','La maquinaría fue borrada de forma definitiva');

INSERT INTO
serviciosMtq (id, nombre, codigo, color, comentario, activo, created_at, updated_at)
VALUES
    (1, 'Revision', 'MT-01', '#2db512', 'Para equipos que necesiten ser revisados', 1, '2023-08-15 09:06:58', '2023-08-15 09:06:58'),
    (2, 'Afinacion', 'MT-02', '#f7c90d', 'Para equipos que necesiten ser afinados', 1, '2023-08-15 09:07:31', '2023-08-17 13:36:41'),
    (3, 'Reparacion', 'MT-03', '#be2727', 'Para equipos que necesiten ser reparados', 1, '2023-08-15 11:03:57', '2023-08-15 11:03:57');

INSERT into `maquinariaCategoria` (`id`, `nombre`, `comentario`) values
(1, 'Accesorios', 'Accesorios de Maquinaría'),
(2, 'Camperes', 'Campers'),
(3, 'Cisterna', 'Cisterna'),
(4, 'Maquinaría Ligera', 'Maquinaría Ligera'),
(5, 'Maquinaría Pesada', 'Maquinaría Pesada'),
(6, 'Retroexcavadoras', 'Retroexcavadoras'),
(7, 'Tractocamiones', 'Tractocamiones'),
(8, 'Otros', 'Otros'),
(9, 'Utilitarios','Utilitarios');

INSERT INTO `maquinariaTipo` (`id`, `nombre`, `comentario`) VALUES
(1, 'Pesada', 'Maquinaría Pesada'),
(2, 'Ligera', 'Maquinaría Ligera'),
(3, 'Grua', 'Gruas y montacargas'),
(4, 'No Aplica', 'No aplica para�ningun�tipo');

INSERT INTO tiposDocs  (`id`, `nombre`, `comentario`) VALUES
(1, 'Personal', 'Documentos de Personal'),
(2, 'Maquinaria', 'Documentos de Personal');


INSERT INTO `tipoHoraExtra` (`id`, `nombre`, `valor`, `comentario`, `color`) VALUES
(1, 'No aplica', 0.00, 'No aplica hora extra', 'gray'),
(2, 'De Ley', 82.14, 'De Ley', 'blue'),
(3, 'Q2S', 100.00, 'Q2C', 'green'),
(4, 'Otros', 120.00, 'Bonos o compensaciones', 'purple');


INSERT INTO `estados` (`id`, `nombre`, `color`, `comentario`) VALUES
(1, 'Espera', 'blue', 'En espera de antención'),
(2, 'Realizando', 'gray', 'Ya se está trabajando'),
(3, 'Terminado', 'navy', 'Ya se termino de ejecutar');


INSERT INTO `comprobante` (`id`, `nombre`, `comentario`) VALUES
(1, 'Factura', 'Facturas'),
(2, 'Nota', 'Nota de remisión.'),
(3, 'Remisión', 'Remisión'),
(4, 'Vale Q2Ces', 'Vale de la empresa');

INSERT INTO `tipoMantenimiento` (`id`, `nombre`, `comentario`) VALUES
(1, 'Correctivo', 'Mantenimiento correctivo de equipo'),
(2, '250', 'Mantenimiento preventivo de 250 horas de trabajo'),
(3, '500', 'Mantenimiento preventivo de 500 horas de trabajo.'),
(4, '1000', 'Mantenimiento preventivo de 1000 horas de trabajo');

/***************************************FIN DATOS Tablas de Sin FK*/

/***************************************Tablas Relacionadas*/

create table tarea(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(255) NULL,
    comentario text NULL,
    categoriaId bigint(20) unsigned NULL,
    ubicacionId bigint(20) unsigned NULL,
    tipoId bigint(20) unsigned NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    activa TINYINT(1) NOT NULL DEFAULT '1',
    tipoValor INT(2) NOT NULL DEFAULT '1',
    primary key (id),
    CONSTRAINT FK_tarea_categoria foreign key (categoriaId) references tareaCategoria(id),
    CONSTRAINT FK_tarea_tipo foreign key (tipoId) references tareaTipo(id),
    CONSTRAINT FK_tarea_ubicacion foreign key (ubicacionId) references tareaUbicacion(id)
);

create table grupoTareas(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    grupoId bigint(20) unsigned NOT NULL,
    tareaId bigint(20) unsigned NOT NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id),
    CONSTRAINT FK_grupo_grupo foreign key (grupoId) references grupo(id),
    CONSTRAINT FK_grupo_tarea foreign key (tareaID) references tarea(id)
);

CREATE TABLE tareas(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    userId bigint(20) unsigned NOT NULL,
    responsable bigint(20) unsigned NOT NULL,
    titulo varchar(255) not NULL,
    fechaInicio date NULL,
    fechaFin date NULL,
    prioridadId bigint(20) unsigned NOT NULL,
    estadoId bigint(20) unsigned NOT NULL,
    fechaInicioR date not NULL,
    fechaFinR date not NULL,
    comentario text NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_tareas_userId foreign key (userId) references users(id),
    CONSTRAINT FK_tareas_responsable foreign key (responsable) references users(id),
    CONSTRAINT FK_tareas_prioridadId foreign key (prioridadId) references prioridades(id),
    CONSTRAINT FK_tareas_estadoId foreign key (estadoId) references estados(id)
);

create table grupoBitacoras(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    bitacoraId bigint(20) unsigned NOT NULL,
    grupoId bigint(20) unsigned NOT NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id),
    CONSTRAINT FK_grupoBitacora_bitacora foreign key (bitacoraId) references bitacoras(id),
    CONSTRAINT FK_grupoBitacora_tarea foreign key (grupoId) references grupo(id)
);

CREATE TABLE eventos(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    userId bigint(20) unsigned NOT NULL,
    titulo varchar(255) not NULL,
    fechaInicio date NULL,
    fechaFin date NULL,
    prioridadId bigint(20) unsigned NOT NULL,
    comentario text NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_eventos_userId foreign key (userId) references users(id),
    CONSTRAINT FK_eventos_prioridadId foreign key (prioridadId) references prioridades(id)
);

CREATE TABLE obras(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(255) NULL,
    tipo varchar(255) NULL,
    calle varchar(255) NULL,
    numero varchar(255) NULL,
    colonia varchar(255) NULL,
    estado varchar(255) NULL,
    ciudad varchar(255) NULL,
    cp varchar(255) NULL,
    logo varchar(255) NULL,
    foto varchar(255) NULL,
    estatus varchar(255) NULL,
    clienteId bigint(20) unsigned NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_obras_cliente foreign key (clienteId) references clientes(id)
);

CREATE TABLE residente(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    userId bigint(20) unsigned NULL,
    obraId bigint(20) unsigned NULL,
    clienteId bigint(20) unsigned null,
    nombre varchar(255) NULL,
    apellido varchar(255) NULL,
    empresa varchar(255) NULL,
    puesto varchar(255) NULL,
    telefono varchar(255) NULL,
    firma varchar(255) NULL,
    email varchar(255) NOT NULL,
    comentario text NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_residente_userId foreign key (userId) references users(id),
    CONSTRAINT FK_residente_obraId foreign key (obraId) references obras(id),
    CONSTRAINT FK_residente_clienteId foreign key (clienteId) references clientes(id)
);

CREATE TABLE proveedor(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(255) NULL,
    razonSocial varchar(255) NULL,
    rfc varchar(255) NULL,
    calle varchar(255) NULL,
	exterior varchar(255) NULL,
    interior varchar(255) NULL,
    colonia varchar(255) NULL,
    estado varchar(255) NULL,
    ciudad varchar(255) NULL,
    cp varchar(255) NULL,
    logo varchar(255) NULL,
    fiscal varchar(255) NULL,
    estatus varchar(255) NULL,
    categoriaId bigint(20) unsigned NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_proveedor_categoria foreign key (categoriaId) references proveedorCategoria(id)
);

CREATE TABLE inventario(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    numparte varchar(255) NOT NULL,
    nombre varchar(255) NOT NULL,
    marcaId bigint(20) unsigned NOT NULL,
    modelo varchar(255) NULL,
    proveedorId bigint(20) unsigned NOT NULL,
    cantidad float(10, 2) NULL,
    reorden float(10, 2) NULL,
    maximo float(10, 2) NULL,
    valor float(10, 2) NULL,
    imagen varchar(255) NULL,
    tipo varchar(255) NULL,
    uniformeTipoId bigint(20) unsigned  NULL,
    uniformeTalla varchar(16) NULL,
    uniformeRetornable int(1) NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_inventario_tipouniforme foreign key (uniformeTipoId) references tipoUniforme(id),
    CONSTRAINT FK_inventario_marca foreign key (marcaId) references marca(id),
    CONSTRAINT FK_inventario_proveedor foreign key (proveedorId) references proveedor(id)
);

CREATE TABLE restock(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    productoId bigint(20) unsigned NOT NULL,
    cantidad float(10, 2) not NULL,
    costo float(10, 2) not NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_inventario_producto foreign key (productoId) references inventario(id)
);

CREATE TABLE inventarioMovimientos(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    inventarioId bigint(20) unsigned NOT NULL,
    usuarioId bigint(20) unsigned NOT NULL,
    movimiento int(4) NOT NULL,
    cantidad float(10, 2) NOT NULL,
    precioUnitario float(10, 2) NOT NULL,
    total float(10, 2) NOT NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_inventarioMovimiento_inventario foreign key (inventarioId) references inventario(id),
    CONSTRAINT FK_inventarioMovimiento_usuario foreign key (usuarioId) references users(id)
);

create table lugares(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    comentario text NULL,
    activo TINYINT(1) NOT NULL DEFAULT '1',
    ubicacionId bigint(20) unsigned NUll,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key(id),
    CONSTRAINT FK_lugares_ubicacionId foreign key (ubicacionId) references ubicaciones(id)
);

create table puesto(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not NULL,
    comentario text NULL,
    puestoNivelId bigint(20) unsigned NULL,
    primary key (id),
    CONSTRAINT FK_puesto_puestoNivelId foreign key (puestoNivelId) references puestoNivel(id)
);

CREATE TABLE docs(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	nombre varchar(200) null,
	tipoId bigint(20) unsigned NOT null,
	comentario text null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_docs_tipoId foreign key (tipoId) references tiposDocs(id)
);

CREATE TABLE personal(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    userId bigint(20) unsigned NULL,
    estatusId bigint(20) unsigned NULL,
    nombres varchar(255) NULL,
    apellidoP varchar(255) NULL,
    apellidoM varchar(255) NULL,
    fechaNacimiento datetime NULL,
    lugarNacimiento varchar(255) NULL,
    curp varchar(21) NULL,
    ine varchar(20) NULL,
    rfc varchar(20) NULL,
    licencia varchar(20) NULL,
    tipoLicencia varchar(200) NULL,
    cpf varchar(25) NULL,
    cpe varchar(25) NULL,
    sexo varchar(10) NULL,
    civil varchar(25) NULL,
    hijos int NULL,
    sangre varchar(10) NULL,
    aler text NULL,
    profe varchar (255) NULL,
    calle varchar(255) NULL,
    numero varchar(255) NULL,
    interior varchar (255) NULL,
    colonia varchar(255) NULL,
    estado varchar(255) NULL,
    ciudad varchar(255) NULL,
    cp varchar(255) NULL,
    particular varchar(255) NULL,
    celular varchar(255) NULL,
    mailpersonal varchar(255) NULL,
    mailEmpresarial varchar(255) NULL,
    casa varchar(255) NULL,
    foto varchar(255) NULL,
    puestoNivelId bigint(20) unsigned NULL,
    puestoId bigint(20) unsigned NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_personal_userId foreign key (userId) references users(id),
    CONSTRAINT FK_personal_puestoId foreign key (puestoId) references puesto(id),
    CONSTRAINT FK_personal_userEstatusId foreign key (estatusId) references userEstatus(id),
    CONSTRAINT FK_personal_puestoNivelId foreign key (puestoNivelId) references puestoNivel(id)
);

CREATE TABLE equipo(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    personalId bigint(20) unsigned NOT NULL,
    chaleco varchar(200) NULL,
    camisa varchar(200) NULL,
    botas varchar(200) NULL,
    guantes varchar(200) NULL,
    comentarios text NULL,
    pc varchar(200) NULL,
    pcSerial varchar(200) NULL,
    celular varchar(200) NULL,
    celularImei varchar(200) NULL,
    radio varchar(200) NULL,
    radioSerial varchar(200) NULL,
    cargadorSerial varchar(200) NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_equipo_personalId foreign key (personalId) references personal(id)
);

CREATE TABLE contactos(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    personalId bigint(20) unsigned NOT NULL,
    nombre varchar(255) NULL,
    particular varchar(255) NULL,
    celular varchar(255) NULL,
    parentesco varchar(255) NULL,
    nombreP varchar(255) NULL,
    nombreM varchar(255) NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_contactos_personalId foreign key (personalId) references personal(id)
);

CREATE TABLE beneficiario(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    personalId bigint(20) unsigned NOT NULL,
    nombres varchar(255) NULL,
    apellidoP varchar(255) NULL,
    apellidoM varchar(255) NULL,
    particular varchar(255) NULL,
    celular varchar(255) NULL,
    nacimiento datetime NULL,
    emailB varchar(255) NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_beneficiario_personalId foreign key (personalId) references personal(id)
);

CREATE TABLE fiscal(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    personalId bigint(20) unsigned NOT NULL,
    cp varchar(255) NULL,
    tipo varchar(255) NULL,
    calle varchar(255) NULL,
    numero varchar(255) NULL,
    interior varchar (255) NULL,
    colonia varchar(255) NULL,
    localidad varchar(255) NULL,
    municipio varchar(255) NULL,
    estado varchar(255) NULL,
    entre varchar(255) NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_fiscal_personalId foreign key (personalId) references personal(id)
);

CREATE TABLE asignacionEquipo(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    personalId bigint(20) unsigned NOT NULL,
    equipoId bigint(20) unsigned NOT NULL,
    cantidad int not NULL,
    marcaId bigint(20) unsigned not NULL,
    serial varchar(200) NULL,
    comentario text NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_asignacionEquipo_personalId foreign key (personalId) references personal(id),
    CONSTRAINT FK_asignacionEquipo_equipoId foreign key (equipoId) references tipoEquipo(id),
    CONSTRAINT FK_asignacionEquipo_marcaId foreign key (marcaId) references marca(id)
);

CREATE TABLE asignacionUniforme(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    personalId bigint(20) unsigned NOT NULL,
    inventarioId bigint(20) unsigned NOT NULL,
    cantidad int not NULL,
    comentario text NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_asignacionUniforme_personalId foreign key (personalId) references personal(id),
    CONSTRAINT FK_asignacionUniforme_inventarioId foreign key (inventarioId) references inventario(id)
);

CREATE TABLE userdocs(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    personalId bigint(20) unsigned NOT NULL,
	ruta varchar(255) NULL,
    tipoId bigint(20) unsigned null,
    fechaVencimiento date not NULL,
    estatus varchar(255) NULL,
    requerido int null,
    vencimiento int null,
    comentarios text NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_userdocs_personalId foreign key (personalId) references personal(id),
    CONSTRAINT FK_userdocs_tipoId foreign key (tipoId) references docs(id)
);

CREATE TABLE nomina(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    personalId bigint(20) unsigned NULL,
    nomina int NULL,
    imss varchar(255) NULL,
    clinica varchar(255) NULL,
    infonavit varchar(255) NULL,
    afore varchar(255) NULL,
    pago varchar(25) NULL,
    tarjeta varchar(255) NULL,
    banco varchar(255) NULL,
    ingreso datetime NULL,
    vactotales int NULL,
    vactomadas int NULL,
    primavactotal float(10, 2) NULL,
    primavactomadas float(10, 2) NULL,
    fechaPagoPrimaVac date NULL,
    laborables int NULL,
    horario varchar(255) NULL,
    hEntrada time null,
    hSalida time null,
    jefeId bigint(20) unsigned NULL,
    neto float(10, 2) NULL,
    bruto float(10, 2) NULL,
    diario float(10, 2) NULL,
    diariointegrado float(10, 2) NULL,
    mensualintegrado float(10, 2) NULL,
    imssAportacion float(10, 2) NULL,
    imssriesgo float(10, 2) NULL,
    aforeAportacion float(10, 2) NULL,
    isr float(10, 2) NULL,
    ispt float(10, 2) NULL,
    aguinaldo float(10, 2) NULL,
    ptu float(10, 2) NULL,
    puestoId bigint(20) unsigned NULL,
    asistencia int(1) unsigned NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_nomina_personalId foreign key (personalId) references personal(id),
    CONSTRAINT FK_nomina_puestoId foreign key (puestoId) references puesto(id),
    CONSTRAINT FK_nomina_jefeId foreign key (jefeId) references personal(id)
);

CREATE TABLE maquinaria(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    estatusId bigint(20) unsigned NULL,
    bitacoraId bigint(20) unsigned NULL,
    nombre varchar(255) NULL,
    identificador varchar(32) NULL,
    tipoId bigint(20) unsigned NULL,
    categoriaId bigint(20) unsigned NULL,
    marcaId bigint(20) unsigned NULL,
    submarca varchar(255) NULL,
    modelo varchar(255) NULL,
    ano int NULL,
    uso varchar(255) NULL,
    color varchar(255) NULL,
    placas varchar(255) NULL,
    motor varchar(255) NULL,
    nummotor varchar(255) NULL,
    numserie varchar(255) NULL,
    vin varchar(255) NULL,
    capacidad varchar(255) NULL,
    combustible varchar(255) NULL,
    tanque int NULL,
    ejes varchar(255) NULL,
    rinD varchar(255) NULL,
    rinT varchar(255) NULL,
    llantaD varchar(255) NULL,
    llantaT varchar(255) NULL,
    aceitemotor varchar(255) NULL,
    aceitetras varchar(255) NULL,
    aceitehidra varchar(255) NULL,
    aceitedirec varchar(255) NULL,
    filtroaceite varchar(255) NULL,
    filtroaire varchar(255) NULL,
    bujias varchar(255) NULL,
    tipobujia varchar(255) NULL,
    horometro int NULL,
    kilometraje int null default 0,
    kom varchar(255) null ,
    foto varchar(255) NULL,
    foto2 varchar(255) NULL,
    foto3 varchar(255) NULL,
    foto4 varchar(255) NULL,
    cisterna int(1) NULL,
    cisternaNivel float(10, 2) NULL,
    compania varchar(200) NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_maquinaria_maquinariaEstatusId foreign key (estatusId) references maquinariaEstatus(id),
    CONSTRAINT FK_maquinaria_bitacoraId FOREIGN KEY (bitacoraId) REFERENCES bitacoras (id),
    CONSTRAINT FK_maquinaria_categoriaId foreign key (categoriaId) references maquinariaCategoria(id),
    constraint FK_maquinaria_marcaId foreign key (marcaId) references marca(id),
    CONSTRAINT FK_maquinaria_tipoId foreign key (tipoId) references maquinariaTipo(id)
);

CREATE TABLE maqdocs (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    maquinariaId BIGINT(20) UNSIGNED NOT NULL,
    ruta VARCHAR(255) NULL,
    tipo VARCHAR(255) NULL,
    fechaVencimiento DATE NOT NULL,
    estatus VARCHAR(255) NULL,
    comentarios TEXT NULL,
    tipoId BIGINT(20) UNSIGNED NULL,
    requerido INT NULL,
    vencimiento INT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_maqdocs_maquinariaId FOREIGN KEY (maquinariaId) REFERENCES maquinaria(id),
    CONSTRAINT FK_maqdocs_tipoId FOREIGN KEY (tipoId) REFERENCES docs(id)
);

CREATE TABLE accesorios(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(255) NULL,
    marca varchar(255) NULL,
    modelo varchar(255) NULL,
    color varchar(255) NULL,
    ano varchar(255) NULL,
    serie varchar(255) NULL,
    foto varchar(255) NULL,
    maquinariaId bigint(20) unsigned NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_accesorios_maquinariaId foreign key (maquinariaId) references maquinaria(id)
);

CREATE TABLE maqacce(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    maquinariaId bigint(20) unsigned NOT NULL,
    accesorioId bigint(20) unsigned NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_maqacce_maquinariaId foreign key (maquinariaId) references maquinaria(id),
    CONSTRAINT FK_maqacce_accesorioId foreign key (accesorioId) references accesorios(id)
);

CREATE TABLE obraMaqPer(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    maquinariaId bigint(20) unsigned NOT NULL,
    personalId bigint(20) unsigned NOT NULL,
    obraId bigint(20) unsigned NOT NULL,
    inicio datetime NULL,
    fin datetime NULL,
    combustible int DEFAULT 0,
    PRIMARY KEY (id),
    CONSTRAINT FK_obraMaqPer_maquinaria foreign key (maquinariaId) references maquinaria(id),
    CONSTRAINT FK_obraMaqPer_persona foreign key (personalId) references personal(id),
    CONSTRAINT FK_obraMaqPer_obras foreign key (obraId) references obras(id)
);

CREATE TABLE maqimagen(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    maquinariaId bigint(20) unsigned NOT NULL,
    ruta varchar(255) NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_maqimagen_maquinariaId foreign key (maquinariaId) references maquinaria(id)
);

create table usoMaquinarias (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    maquinariaId bigint(20) unsigned not null,
    uso float(10, 2) not null,
    comentario text NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key(id),
    CONSTRAINT FK_usoMaquinarias_maquinariaId foreign key (maquinariaId) references maquinaria(id)
);

CREATE TABLE invconsu(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    productoId bigint(20) unsigned NOT NULL,
    tipo varchar(255) NULL,
    cantidad float(10, 2) not NULL,
    desde bigint(20) unsigned NOT NULL,
    hasta bigint(20) unsigned NOT NULL,
    comentarios text DEFAULT NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_invconsu_producto foreign key (productoId) references inventario(id),
    CONSTRAINT FK_invconsu_desde foreign key (desde) references maquinaria(id),
    CONSTRAINT FK_invconsu_hasta foreign key (hasta) references maquinaria(id)
);

CREATE TABLE carga(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    maquinariaId bigint(20) unsigned NOT NULL,
    operadorId bigint(20) unsigned NOT NULL,
    precio float(10, 2) not NULL,
    litros float(10, 2) not NULL,
    userId bigint(20) unsigned NOT null,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_carga_operadorlId foreign key (operadorId) references personal(id),
    CONSTRAINT FK_carga_maquinariaId foreign key (maquinariaId) references maquinaria(id),
    CONSTRAINT FK_carga_userId foreign key (userId) references users(id)
);

CREATE TABLE descarga(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    maquinariaId bigint(20) unsigned NOT NULL,
    operadorId bigint(20) unsigned NOT NULL,
    servicioId bigint(20) unsigned NOT NULL,
    receptorId bigint(20) unsigned NOT NULL,
    litros float(10, 2) not NULL,
    km int not NULL,
    imgKm varchar(255) not NULL,
    horas float(10, 2) not NULL,
    imgHoras varchar(255) not NULL,
    userId bigint(20) unsigned NOT null,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_descarga_operadorlId foreign key (operadorId) references personal(id),
    CONSTRAINT FK_descarga_maquinariaId foreign key (maquinariaId) references maquinaria(id),
    CONSTRAINT FK_descarga_serviciolId foreign key (operadorId) references personal(id),
    CONSTRAINT FK_descarga_receptorId foreign key (maquinariaId) references maquinaria(id),
    CONSTRAINT FK_descarga_userId foreign key (userId) references users(id)
);

CREATE TABLE mtqEventos (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    mantenimientoId bigint(20) unsigned NOT NULL,
    maquinariaId bigint(20) unsigned NOT NULL,
    fecha date NOT NULL,
    descripcion text NULL,
    estatus bigint(20) unsigned NOT NULL,
    color varchar(255) NOT NULL,
    start datetime NULL,
    end datetime NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_mtqEventos_mantenimientoId foreign key (mantenimientoId) references serviciosMtq(id),
    CONSTRAINT FK_mtqEventos_maquinariaId foreign key (maquinariaId) references maquinaria(id)
);

CREATE TABLE solicitudesListas(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    solicitudId bigint(20) unsigned NOT NULL,
    inventarioId bigint(20) unsigned NOT NULL,
    cantidad float(10, 2) not NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_solicitudesListas_solicitudId foreign key (solicitudId) references users(id),
    CONSTRAINT FK_solicitudesListas_inventarioId foreign key (inventarioId) references maquinaria(id)
);

CREATE TABLE mantenimientos(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    maquinariaId bigint(20) unsigned NOT NULL,
    personalId bigint(20) unsigned NOT NULL,
    titulo varchar(255) not NULL,
    tipoMantenimientoId bigint(20) unsigned NOT NULL,
    fechaInicio date not NULL,
    fechaReal date NULL,
    estadoId bigint(20) unsigned NOT NULL,
    comentario text NULL,
    adscripcion varchar(200) NULL,
    horometro int NULL,
    kilometraje int NULL,
    subtotal float(10,2) NULL,
    iva float(10,2) NULL,
    costo float(10,2) NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_mantenimientos_userId foreign key (maquinariaId) references maquinaria(id),
    CONSTRAINT FK_mantenimientos_estadoId foreign key (estadoId) references estados(id),
    CONSTRAINT FK_mantenimiento_personalId foreign key (personalId) references users(id),
    CONSTRAINT FK_mantenimiento_tipoId foreign key (tipoMantenimientoId) references tipoMantenimiento(id)
);

create table gastosMantenimiento(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    mantenimientoId bigint(20) unsigned NOT NULL,
    inventarioId bigint(20) unsigned NOT NULL,
    cantidad int not NULL,
    costo float(16,2) NULL,
    total float(16,2) NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id),
    constraint FK_gastosmantenimiento_mantenimientoId foreign key (mantenimientoId) references mantenimientos(id),
    constraint FK_gastosmantenimiento_productoId foreign key (inventarioId) references inventario(id)
);

CREATE TABLE servicios(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    userId bigint(20) unsigned NOT NULL,
    maquinariaId bigint(20) unsigned NOT NULL,
    reparacionId bigint(20) unsigned NOT NULL,
    titulo varchar(255) not NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    prioridadId bigint(20) unsigned NOT NULL,
    estadoId bigint(20) unsigned NOT NULL,
    comentario text NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_servicios_userId foreign key (userId) references users(id),
    CONSTRAINT FK_servicios_maquinariaId foreign key (maquinariaId) references maquinaria(id),
    CONSTRAINT FK_servicios_reparacionId foreign key (reparacionId) references reparaciones(id),
    CONSTRAINT FK_servicios_prioridadId foreign key (prioridadId) references prioridades(id),
    CONSTRAINT FK_servicios_estadoId foreign key (estadoId) references estados(id)
);

CREATE TABLE solicitudes(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    userId bigint(20) unsigned NOT NULL,
    responsable bigint(20) unsigned NOT NULL,
    maquinariaId bigint(20) unsigned NOT NULL,
    servicioId bigint(20) unsigned NOT NULL,
    titulo varchar(255) not NULL,
    fechaSolicitud date not NULL,
    fechaRequerimiento date not NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    prioridadId bigint(20) unsigned NOT NULL,
    estadoId bigint(20) unsigned NOT NULL,
    comentario text NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_solicitudes_userId foreign key (userId) references users(id),
    CONSTRAINT FK_solicitudes_maquinariaId foreign key (maquinariaId) references maquinaria(id),
    CONSTRAINT FK_solicitudes_serviciosId foreign key (servicioId) references solicitudes(id),
    CONSTRAINT FK_solicitudes_prioridadId foreign key (prioridadId) references prioridades(id),
    CONSTRAINT FK_solicitudes_estadoId foreign key (estadoId) references estados(id)
);

CREATE TABLE historialServicios(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    solicitudId bigint(20) unsigned NOT NULL,
    servicioId bigint(20) unsigned NOT NULL,
    estadoId bigint(20) unsigned NOT NULL,
    comentario float(10, 2) not NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_historialServicios_solicitudId foreign key (solicitudId) references solicitudes(id),
    CONSTRAINT FK_historialServicios_servicioId foreign key (servicioId) references servicios(id),
    CONSTRAINT FK_historialServicios_estadoId foreign key (estadoId) references estados(id)
);

create table asistencia(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    personalId bigint(20) unsigned NOT NULL,
    asistenciaId bigint(20) unsigned NOT NULL,
    fecha date not NULL,
    horasExtra int NULL,
    tipoHoraExtraId bigint(20) unsigned null,
    comentario text NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id),
    constraint FK_asistencia_personalId foreign key (personalId) references personal(id),
    constraint FK_asistencia_asistenciaId foreign key (asistenciaId) references tipoAsistencia(id),
    constraint FK_asistencia_tipoHoraExtraId foreign key (tipoHoraExtraId) references tipoHoraExtra(id)
);

create table cajaChica(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    dia date not NULL,
    concepto bigint(20) unsigned NOT NULL,
    comprobante float(10,2) NULL,
    ncomprobante int not NULL,
    cliente varchar(200),
    obra bigint(20) unsigned  NULL,
    equipo bigint(20) unsigned NOT NULL,
    personal bigint(20) unsigned NOT NULL,
    tipo varchar(200) NULL,
    cantidad float(10,2) not NULL,
    total float(10, 2) NULL,
    comentario text NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id),
    CONSTRAINT FK_cajachica_concepto foreign key (concepto) references conceptos(id),
    CONSTRAINT FK_cajachica_obra foreign key (obra) references obras(id),
    CONSTRAINT FK_cajachica_equipo foreign key (equipo) references maquinaria(id),
    CONSTRAINT FK_cajachica_personal foreign key (personal) references personal(id)
);

create table checkList(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    bitacoraId bigint(20) unsigned NOT NULL,
    usuarioId bigint(20) unsigned NOT NULL,
    maquinariaId bigint(20) unsigned NOT NULL,
    registrada datetime NULL,
    comentario text NULL,
    primary key (id),
    CONSTRAINT FK_checkListBitacora foreign key (bitacoraId) references bitacoras(id),
    CONSTRAINT FK_checkListUsuario foreign key (usuarioId) references users(id),
    CONSTRAINT FK_checkListMaquinaria foreign key (maquinariaId) references maquinaria(id)
);

create table checkListRegistros(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    checkListId bigint(20) unsigned NOT NULL,
    maquinariaId bigint(20) unsigned NOT NULL,
    maquinaria varchar(255) NOT NULL,
    bitacoraId bigint(20) unsigned NOT NULL,
    bitacora varchar(255) NOT NULL,
    grupoId bigint(20) unsigned NOT NULL,
    grupo varchar(255) NOT NULL,
    tareaId bigint(20) unsigned NOT NULL,
    tarea varchar(255) NOT NULL,
    tareaTipoValor INT(2) NOT NULL DEFAULT '1',
    resultado varchar(255) NULL,
    valor int(8) NULL,
    usuarioId bigint(20) unsigned NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    primary key (id),
    CONSTRAINT FK_checkListRegistrosBitacora foreign key (bitacoraId) references bitacoras(id),
    CONSTRAINT FK_checkListRegistrosUsuario foreign key (usuarioId) references users(id),
    CONSTRAINT FK_checkListRegistrosMaquinaria foreign key (maquinariaId) references maquinaria(id),
    CONSTRAINT FK_checkListRegistrosGrupo foreign key (grupoId) references grupo(id),
    CONSTRAINT FK_checkListRegistrosTarea foreign key (tareaId) references tarea(id),
    CONSTRAINT FK_checkListHistorico foreign key (checkListId) references checkList(id)
);

create table refacciones (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(200) NULL,
    numeroParte VARCHAR(200) NULL,
    marcaId BIGINT(20) UNSIGNED NOT NULL,
    tipoRefaccionId BIGINT(20) UNSIGNED NOT NULL,
    maquinariaId BIGINT(20) UNSIGNED NOT NULL,
    comentario TEXT NULL,
    activo TINYINT(1) NOT NULL DEFAULT '1',
    relacionInventarioId BIGINT(20) unsigned NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_refacciones_marca FOREIGN KEY (marcaId) REFERENCES marca(id),
    CONSTRAINT FK_refacciones_maquinaria FOREIGN KEY (maquinariaId) REFERENCES maquinaria(id),
    CONSTRAINT FK_refacciones_tipo FOREIGN KEY (tipoRefaccionId) REFERENCES refaccionTipo(id),
    CONSTRAINT FK_refacciones_inventario FOREIGN KEY (relacionInventarioId) REFERENCES inventario(id)
);

CREATE TABLE extintores(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	identificador varchar(200) null,
	serie varchar(200) not NULL,
    capacidad int not null,
    ultimaRevision date null,
    proximaRevision date not null,
    tipo varchar(200) not null,
    ubicacionId bigint(20) unsigned NUll,
    lugarId bigint(20) unsigned NUll,
    maquinariaId bigint(20) unsigned null,
    comentario text NULL,
    activo TINYINT(1) NOT NULL DEFAULT '1',
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_extintores_ubicacionId foreign key (ubicacionId) references ubicaciones(id),
    CONSTRAINT FK_extintores_lugarId foreign key (lugarId) references lugares(id),
    CONSTRAINT FK_extintores_maquinariaId foreign key (maquinariaId) references maquinaria(id)
);

/***************************************FIN Tablas Relacionadas*/

/***************************************DATOS Tablas Relacionadas*/

INSERT INTO
    `puesto` (`id`, `nombre`, `comentario`)
VALUES
    (NULL, 'Almacenista', 'Descripción del puesto'),
    (NULL,'Auxiliar General','Descripción del puesto'),
    (NULL, 'Carpintero', 'Descripción del puesto'),
    (NULL,'Gerente de Operaciones','Descripción del puesto'),
    (NULL, 'Chofer', 'Descripción del puesto'),
    (NULL,'Chofer de Tractocamion','Descripción del puesto'),
    (NULL,'Coordinador de Operaciones','Descripción del puesto'),
    (NULL,'Capturista de Datos','Descripción del puesto'),
    (NULL, 'Jefe de Taller', 'Descripción del puesto'),
    (NULL, 'Electrico', 'Descripción del puesto'),
    (NULL,'Guardia de Seguridad','Descripción del puesto'),
    (NULL, 'Herrero', 'Descripción del puesto'),
    (NULL, 'Inventarios', 'Descripción del puesto'),
    (NULL,'Operador de Maquinaria','Descripción del puesto'),
    (NULL, 'Pintor', 'Descripción del puesto'),
    (NULL, 'Plomero', 'Descripción del puesto'),
    (NULL, 'Velador', 'Descripción del puesto'),
    (NULL, 'Vigilante', 'Descripción del puesto'),
    (NULL, 'Mecánica', 'Descripción del puesto'),
    (NULL,'Electromecanico','Descripción del puesto'),
    (NULL, 'Laminero', 'Descripción del puesto'),
    (NULL, 'Sistemas', 'Descripción del puesto');

/***************************************FIN DATOS Tablas Relacionadas*/

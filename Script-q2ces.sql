CREATE TABLE roles (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    guard_name varchar(255) NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY roles_name_guard_name_unique (name, guard_name)
);

INSERT INTO
    roles
VALUES
    (
        1,
        'Admin',
        'web',
        '2022-07-25 20:54:16',
        '2022-07-25 20:54:16'
    ),
    (
        2,
        'User',
        'web',
        '2022-07-25 20:54:16',
        '2022-07-25 20:54:16'
    );

CREATE TABLE permissions (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    guard_name varchar(255) NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY permissions_name_guard_name_unique (name, guard_name)
);
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
	 ('asistencia_horasextra','web','2022-07-25 19:54:16','2022-07-25 19:54:16');

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
    username varchar(255) null,
    PRIMARY KEY (id)
);

INSERT INTO
    `users`
VALUES
    (
        1,
        'admin',
        'a@a.com',
        NULL,
        '$2y$10$xchASRodwuYH58CYgTt3r.RWshZp3BzYMd6T7pg3ZNZxd4d3fXzUy',
        NULL,
        NULL,
        NULL,
        '2022-09-26 19:48:41',
        '2022-09-26 19:48:41',
        NULL
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

INSERT INTO
    `model_has_roles`
VALUES
    (1, 'App\\Models\\User', 1);

CREATE TABLE role_has_permissions (
    permission_id bigint(20) unsigned NOT NULL,
    role_id bigint(20) unsigned NOT NULL,
    PRIMARY KEY (`permission_id`, `role_id`),
    KEY `role_has_permissions_role_id_foreign` (`role_id`),
    CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
    CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
);

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

/* Para soporte de puesto de personal */
create table puesto(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not null,
    comentario text null,
    puestoNivelId bigint(20) unsigned NULL,
    primary key (id),
    CONSTRAINT FK_puesto_puestoNivelId foreign key (puestoNivelId) references puestoNivel(id)
);

INSERT INTO
    `puesto` (`id`, `nombre`, `comentario`)
VALUES
    (NULL, 'Almacenista', 'Descripción del puesto'),
    (
        NULL,
        'Auxiliar General',
        'Descripción del puesto'
    ),
    (NULL, 'Carpintero', 'Descripción del puesto'),
    (
        NULL,
        'Gerente de Operaciones',
        'Descripción del puesto'
    ),
    (NULL, 'Chofer', 'Descripción del puesto'),
    (
        NULL,
        'Chofer de Tractocamión',
        'Descripción del puesto'
    ),
    (
        NULL,
        'Coordinador de Operaciones',
        'Descripción del puesto'
    ),
    (
        NULL,
        'Capturista de Datos',
        'Descripción del puesto'
    ),
    (NULL, 'Jefe de Taller', 'Descripción del puesto'),
    (NULL, 'Electrico', 'Descripción del puesto'),
    (
        NULL,
        'Guardia de Seguridad',
        'Descripción del puesto'
    ),
    (NULL, 'Herrero', 'Descripción del puesto'),
    (NULL, 'Inventarios', 'Descripción del puesto'),
    (
        NULL,
        'Operador de Maquinaría',
        'Descripción del puesto'
    ),
    (NULL, 'Pintor', 'Descripción del puesto'),
    (NULL, 'Plomero', 'Descripción del puesto'),
    (NULL, 'Velador', 'Descripción del puesto'),
    (NULL, 'Vigilante', 'Descripción del puesto'),
    (NULL, 'Mecánica', 'Descripción del puesto'),
    (
        NULL,
        'Electromecánico',
        'Descripción del puesto'
    ),
    (NULL, 'Laminero', 'Descripción del puesto'),
    (NULL, 'Sistemas', 'Descripción del puesto');

/* Para soporte de nivel puesto de personal */
create table puestoNivel(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not null,
    requiereAsistencia int(1) NOT NULL DEFAULT '0',
    usaCajaChica TINYINT(1) NOT NULL DEFAULT '0',
    comentario text null,
    primary key (id)
);

INSERT INTO
    `puestoNivel` (
        `id`,
        `nombre`,
        `comentario`,
        `requiereAsistencia`
    )
VALUES
    (
        NULL,
        'Administrativo',
        'Descripción del puesto',
        0
    ),
    (NULL, 'Gerente', 'Descripción del puesto', 0),
    (NULL, 'Coordinador', 'Descripción del puesto', 0),
    (NULL, 'Mecánico', 'Descripción del puesto', 1),
    (NULL, 'Operador', 'Descripción del puesto', 1),
    (NULL, 'Auxiliar', 'Descripción del puesto', 1);

CREATE TABLE personal(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    userId bigint(20) unsigned NULL,
    estatusId bigint(20) unsigned NULL,
    nombres varchar(255) NULL,
    apellidoP varchar(255) NULL,
    apellidoM varchar(255) NULL,
    fechaNacimiento datetime null,
    lugarNacimiento varchar(255) null,
    curp varchar(21) NULL,
    ine varchar(20) NULL,
    rfc varchar(20) NULL,
    licencia varchar(20) NULL,
    cpf varchar(25) NULL,
    cpe varchar(25) NULL,
    sexo varchar(10) NULL,
    civil varchar(25) NULL,
    hijos int null,
    sangre varchar(10) NULL,
    aler text null,
    profe varchar (255) null,
    calle varchar(255) NULL,
    numero varchar(255) NULL,
    interior varchar (255) null,
    colonia varchar(255) NULL,
    estado varchar(255) NULL,
    ciudad varchar(255) null,
    cp varchar(255) NULL,
    particular varchar(255) NULL,
    celular varchar(255) NULL,
    mailpersonal varchar(255) NULL,
    mailEmpresarial varchar(255) NULL,
    casa varchar(255) NULL,
    foto varchar(255) NULL,
    puestoNivelId bigint(20) unsigned NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_personal_userId foreign key (userId) references users(id),
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
    comentarios text null,
    pc varchar(200) NULL,
    pcSerial varchar(200) NULL,
    celular varchar(200) NULL,
    celularImei varchar(200) NULL,
    radio varchar(200) NULL,
    radioSerial varchar(200) NULL,
    cargadorSerial varchar(200) null,
    PRIMARY KEY (id),
    CONSTRAINT FK_equipo_personalId foreign key (personalId) references personal(id)
);

CREATE TABLE userdocs(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    personalId bigint(20) unsigned NOT NULL,
    dvitae varchar(255) NULL,
    dnacimiento varchar(255) NULL,
    dine varchar(255) NULL,
    dcurp varchar(255) NULL,
    dlicencia varchar(255) NULL,
    dlicenciaEstatus varchar(255) NULL,
    dcedula varchar(255) NULL,
    dfiscal varchar(255) NULL,
    ddomicilio varchar(255) NULL,
    dpenales varchar(255) NULL,
    drecomendacion varchar(255) NULL,
    ddc3 varchar(255) NULL,
    dmedico varchar(255) NULL,
    ddoping varchar(255) NULL,
    destudios varchar(255) NULL,
    dnss varchar(255) NULL,
    dari varchar(255) NULL,
    dpuesto varchar(255) NULL,
    dcontrato varchar(255) NULL,
    dcontratoEstatus varchar(255) NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_userdocs_personalId foreign key (personalId) references personal(id)
);

CREATE TABLE contactos(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    personalId bigint(20) unsigned NOT NULL,
    nombre varchar(255) NULL,
    particular varchar(255) NULL,
    celular varchar(255) NULL,
    parentesco varchar(255) NULL,
    nombreP varchar(255) null,
    nombreM varchar(255) null,
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
    nacimiento datetime null,
    PRIMARY KEY (id),
    CONSTRAINT FK_beneficiario_personalId foreign key (personalId) references personal(id)
);

CREATE TABLE nomina(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    personalId bigint(20) unsigned NULL,
    nomina int null,
    imss varchar(255) NULL,
    clinica varchar(255) NULL,
    infonavit varchar(255) NULL,
    afore varchar(255) NULL,
    pago varchar(25) null,
    tarjeta varchar(255) NULL,
    banco varchar(255) NULL,
    ingreso datetime null,
    vactotales int null,
    vactomadas int null,
    primavactotal float(10, 2) null,
    primavactomadas float(10, 2) null,
    fechaPagoPrimaVac date null,
    laborables int null,
    horario varchar(255) NULL,
    jefeId bigint(20) unsigned NULL,
    neto float(10, 2) null,
    bruto float(10, 2) null,
    diario float(10, 2) null,
    diariointegrado float(10, 2) null,
    mensualintegrado float(10, 2) null,
    imssAportacion float(10, 2) null,
    imssriesgo float(10, 2) null,
    aforeAportacion float(10, 2) null,
    isr float(10, 2) null,
    ispt float(10, 2) null,
    aguinaldo float(10, 2) null,
    ptu float(10, 2) null,
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
    nombre varchar(255) NULL,
    identificador varchar(32) NULL,
    tipo varchar(255) NULL,
    categoria varchar(255) NULL,
    marca varchar(255) NULL,
    submarca varchar(255) NULL,
    modelo varchar(255) NULL,
    ano int null,
    uso varchar(255) NULL,
    color varchar(255) NULL,
    placas varchar(255) NULL,
    motor varchar(255) NULL,
    nummotor varchar(255) NULL,
    numserie varchar(255) NULL,
    vin varchar(255) NULL,
    capacidad varchar(255) NULL,
    combustible varchar(255) null,
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
    kilometraje int NULL,
    kom varchar(255) NULL,
    foto varchar(255) NULL,
    foto2 varchar(255) NULL,
    foto3 varchar(255) NULL,
    foto4 varchar(255) NULL,
    cisterna int(1) NULL,
    cisternaNivel float(10, 2) NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_maquinaria_maquinariaEstatusId foreign key (estatusId) references maquinariaEstatus(id)
);

CREATE TABLE maqdocs(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    maquinariaId bigint(20) unsigned NOT NULL,
    ruta varchar(255) null,
    tipo varchar(255) null,
    fechaVencimiento date not null,
    estatus varchar(255) NULL,
    comentarios text null,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_maqdocs_maquinariaId foreign key (maquinariaId) references maquinaria(id)
);

CREATE TABLE accesorios(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(255) NULL,
    marca varchar(255) NULL,
    modelo varchar(255) NULL,
    color varchar(255) NULL,
    ano varchar(255) NULL,
    serie varchar(255) NULL,
    foto varchar(255) null,
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
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id)
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

CREATE TABLE inventario(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    numparte varchar(255) NOT NULL,
    nombre varchar(255) NOT NULL,
    marca varchar(255) NULL,
    modelo varchar(255) NULL,
    proveedor varchar(255) NULL,
    cantidad float(10, 2) null,
    reorden float(10, 2) null,
    maximo float(10, 2) null,
    Valor float(10, 2) null,
    imagen varchar(255) NULL,
    tipo varchar(255) NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id)
);

CREATE TABLE restock(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    productoId bigint(20) unsigned NOT NULL,
    cantidad float(10, 2) not null,
    costo float(10, 2) not null,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_inventario_producto foreign key (productoId) references inventario(id)
);

CREATE TABLE invconsu(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    productoId bigint(20) unsigned NOT NULL,
    tipo varchar(255) NULL,
    cantidad float(10, 2) not null,
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

CREATE TABLE fiscal(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    personalId bigint(20) unsigned NOT NULL,
    cp varchar(255) NULL,
    tipo varchar(255) null,
    calle varchar(255) NULL,
    numero varchar(255) NULL,
    interior varchar (255) null,
    colonia varchar(255) NULL,
    localidad varchar(255) null,
    municipio varchar(255) null,
    estado varchar(255) NULL,
    entre varchar(255) null,
    PRIMARY KEY (id),
    CONSTRAINT FK_fiscal_personalId foreign key (personalId) references personal(id)
);

CREATE TABLE maqimagen(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    maquinariaId bigint(20) unsigned NOT NULL,
    ruta varchar(255) null,
    PRIMARY KEY (id),
    CONSTRAINT FK_maqimagen_maquinariaId foreign key (maquinariaId) references maquinaria(id)
);

CREATE TABLE carga(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    maquinariaId bigint(20) unsigned NOT NULL,
    operadorId bigint(20) unsigned NOT NULL,
    precio float(10, 2) not null,
    litros float(10, 2) not null,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_carga_operadorlId foreign key (operadorId) references personal(id),
    CONSTRAINT FK_carga_maquinariaId foreign key (maquinariaId) references maquinaria(id)
);

CREATE TABLE descarga(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    maquinariaId bigint(20) unsigned NOT NULL,
    operadorId bigint(20) unsigned NOT NULL,
    servicioId bigint(20) unsigned NOT NULL,
    receptorId bigint(20) unsigned NOT NULL,
    litros float(10, 2) not null,
    km int not null,
    imgKm varchar(255) not null,
    horas float(10, 2) not null,
    imgHoras varchar(255) not null,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_descarga_operadorlId foreign key (operadorId) references personal(id),
    CONSTRAINT FK_descarga_maquinariaId foreign key (maquinariaId) references maquinaria(id),
    CONSTRAINT FK_descarga_serviciolId foreign key (operadorId) references personal(id),
    CONSTRAINT FK_descarga_receptorId foreign key (maquinariaId) references maquinaria(id)
);

CREATE TABLE residente(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    userId bigint(20) unsigned NOT NULL,
    obraId bigint(20) unsigned NOT NULL,
    nombre varchar(255) null,
    apellido varchar(255) null,
    empresa varchar(255) null,
    puesto varchar(255) null,
    telefono varchar(255) null,
    firma varchar(255) null,
    email varchar(255) NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_residente_userId foreign key (userId) references users(id),
    CONSTRAINT FK_residente_obraId foreign key (obraId) references obras(id)
);

create table estados(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not null,
    color varchar(8) null,
    comentario text null,
    primary key (id)
);

create table prioridades(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not null,
    color varchar(8) null,
    comentario text null,
    primary key (id)
);

create table reparaciones(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not null,
    codigo varchar(8) null,
    comentario text null,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id)
);

CREATE TABLE tareas(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    userId bigint(20) unsigned NOT NULL,
    responsable bigint(20) unsigned NOT NULL,
    titulo varchar(255) not null,
    fechaInicio date null,
    fechaFin date null,
    prioridadId bigint(20) unsigned NOT NULL,
    estadoId bigint(20) unsigned NOT NULL,
    fechaInicioR date not null,
    fechaFinR date not null,
    comentario text null,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_tareas_userId foreign key (userId) references users(id),
    CONSTRAINT FK_tareas_responsable foreign key (responsable) references users(id),
    CONSTRAINT FK_tareas_prioridadId foreign key (prioridadId) references prioridades(id),
    CONSTRAINT FK_tareas_estadoId foreign key (estadoId) references estados(id)
);

CREATE TABLE eventos(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    userId bigint(20) unsigned NOT NULL,
    titulo varchar(255) not null,
    fechaInicio date null,
    fechaFin date null,
    prioridadId bigint(20) unsigned NOT NULL,
    comentario text null,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_eventos_userId foreign key (userId) references users(id),
    CONSTRAINT FK_eventos_prioridadId foreign key (prioridadId) references prioridades(id)
);

CREATE TABLE mantenimientos(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    maquinariaId bigint(20) unsigned NOT NULL,
    personalId bigint(20) unsigned NOT NULL,
    titulo varchar(255) not null,
    tipo varchar(255) not null,
    fechaInicio date not null,
    fechaReal date null,
    estadoId bigint(20) unsigned NOT NULL,
    comentario text null,
    adscripcion varchar(200) null,
    horometro int null,
    kilometraje int null,
    subtotal float(10,2) null,
    iva float(10,2) null,
    costo float(10,2) null,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_mantenimientos_userId foreign key (maquinariaId) references maquinaria(id),
    CONSTRAINT FK_mantenimientos_estadoId foreign key (estadoId) references estados(id),
    CONSTRAINT FK_mantenimiento_personalId foreign key (personalId) references personal(id)
);

CREATE TABLE servicios(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    userId bigint(20) unsigned NOT NULL,
    maquinariaId bigint(20) unsigned NOT NULL,
    reparacionId bigint(20) unsigned NOT NULL,
    titulo varchar(255) not null,
    created_at datetime NULL,
    updated_at datetime NULL,
    prioridadId bigint(20) unsigned NOT NULL,
    estadoId bigint(20) unsigned NOT NULL,
    comentario text null,
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
    serviciosId bigint(20) unsigned NOT NULL,
    titulo varchar(255) not null,
    fechaSolicitud date not null,
    fechaRequerimiento date not null,
    created_at datetime NULL,
    updated_at datetime NULL,
    prioridadId bigint(20) unsigned NOT NULL,
    estadoId bigint(20) unsigned NOT NULL,
    comentario text null,
    PRIMARY KEY (id),
    CONSTRAINT FK_solicitudes_userId foreign key (userId) references users(id),
    CONSTRAINT FK_solicitudes_userId foreign key (maquinariaId) references maquinaria(id),
    CONSTRAINT FK_solicitudes_serviciosId foreign key (serviciosId) references solicitudes(id),
    CONSTRAINT FK_solicitudes_prioridadId foreign key (prioridadId) references prioridades(id),
    CONSTRAINT FK_solicitudes_estadoId foreign key (estadoId) references estados(id)
);

CREATE TABLE solicitudesListas(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    solicitudId bigint(20) unsigned NOT NULL,
    inventarioId bigint(20) unsigned NOT NULL,
    cantidad float(10, 2) not null,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_solicitudesListas_solicitudId foreign key (solicitudId) references users(id),
    CONSTRAINT FK_solicitudesListas_inventarioId foreign key (inventarioId) references maquinaria(id)
);

CREATE TABLE historialServicios(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    solicitudId bigint(20) unsigned NOT NULL,
    servicioId bigint(20) unsigned NOT NULL,
    estadoId bigint(20) unsigned NOT NULL,
    comentario float(10, 2) not null,
    created_at datetime NULL,
    updated_at datetime NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_historialServicios_solicitudId foreign key (solicitudId) references solicitudes(id),
    CONSTRAINT FK_historialServicios_servicioId foreign key (servicioId) references servicios(id),
    CONSTRAINT FK_historialServicios_estadoId foreign key (estadoId) references estados(id)
);

create table tipoAsistencia(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not null,
    comentario text null,
    primary key (id)
);

create table userEstatus(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not null,
    color varchar(8) null,
    comentario text null,
    primary key (id)
);

INSERT INTO
    userEstatus
VALUES
    (1, 'Activo', 'green', 'Usuario activo'),
    (2, 'Inactivo', 'yellow', 'El usuario esta inactivo'),
    (3, 'Baja', 'orange', 'El usuario fue dado de baja'),
    (
        4,
        'Borrado',
        'red',
        'El usario fue borrado de forma definitiva'
    );

create table maquinariaEstatus(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not null,
    color varchar(8) null,
    comentario text null,
    primary key (id)
);

INSERT INTO
    maquinariaEstatus
VALUES
    (1, 'Activo', 'green', 'Maquinaría activa'),
    (
        2,
        'Inactivo',
        'yellow',
        'La maquinaría esta inactiva'
    ),
    (
        3,
        'Baja',
        'orange',
        'La maquinaría esta fue dada de baja'
    ),
    (
        4,
        'Borrado',
        'red',
        'La maquinaría fue borrada de forma definitiva'
    );

create table tipoAsistencia(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not null,
    comentario text null,,
    color varchar(200) not null,
    esAsistencia int null,
    primary key (id)
);

INSERT INTO
    tipoasistencia
VALUES
    (1, 'Asistencia',   'Asistio a trabajar'),
    (
        2,
        'Falta',
        'No se presento a trabajar'
    ),
    (
        3,
        'Incapacidad',
        'Se encuentra con incapacidad'
    ),
    (
        4,
        'Vacaciones',
        'Con permiso de vacaciones'
    ),
    (
        5,
        'Descanso',
        'Con permiso de descanso o feriado'
    );

create table tipoHoraExtra(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) not null,
    valor int null,
    comentario text null,
    color varchar(200) not null,
    primary key (id)
);

create table asistencia(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    personalId bigint(20) unsigned NOT NULL,
    asistenciaId bigint(20) unsigned NOT NULL,
    fecha date not null,
    horasExtra int null,
    tipoHoraExtraId int null,
    comentario text null,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id),
    CONSTRAINT FK_asistencia_personalId foreign key (personalId) references personal(id),
    CONSTRAINT FK_asistencia_asistenciaId foreign key (asistenciaId) references tipoAsistencia(id),
    CONSTRAINT FK_asistencia_tipoHoraExtraId foreign key (tipoHoraExtraId) references tipoHoraExtra(id)
);

-- create table bMantenimiento(
--     id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
--     personalId bigint(20) unsigned NOT NULL,
--     maquinariaId bigint(20) unsigned NOT NULL,
--     fecha date not null,
--     adscripcion varchar(200) null,
--     horometro int null,
--     km int null,
--     subtotal float(10,2) null,
--     iva float(10,2) null,
--     costo float(10,2) null,
--     created_at datetime NULL,
--     updated_at datetime NULL,
--     primary key (id),
--     CONSTRAINT FK_bmantenimiento_personalId foreign key (personalId) references personal(id),
--     CONSTRAINT FK_bmantenimiento_userId foreign key (maquinariaId) references maquinaria(id)
-- );

create table gastosMantenimiento(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    mantenimientoId bigint(20) unsigned NOT NULL,
    inventarioId bigint(20) unsigned NOT NULL,
    cantidad int not null,
    costo float(16,2) null,
    total float(16,2) null,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id),
    CONSTRAINT FK_gastosmantenimiento_mantenimientoId foreign key (mantenimientoId) references mantenimiento(id),
    CONSTRAINT FK_gastosmantenimiento_productoId foreign key (inventarioId) references inventario(id)
);
create table conceptos(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    codigo varchar(200) not null,
    nombre varchar(200) not null,
    comentario text null,
    primary key (id)
);

create table cajaChica(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    dia date not null,
    concepto bigint(20) unsigned NOT null,
    comprobante float(10,2) null,
    ncomprobante int not null,
    cliente varchar(200),
    obra bigint(20) unsigned NOT null,
    equipo bigint(20) unsigned NOT null,
    personal bigint(20) unsigned NOT null,
    tipo varchar(200) null,
    cantidad int not null,
    total float(10, 2) null,
    comentario text null,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id),
    CONSTRAINT FK_cajachica_concepto foreign key (concepto) references conceptos(id),
    CONSTRAINT FK_cajachica_obra foreign key (obra) references obras(id),
    CONSTRAINT FK_cajachica_equipo foreign key (equipo) references maquinaria(id),
    CONSTRAINT FK_cajachica_personal foreign key (personal) references personal(id)
);

create table tarea(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    categoria varchar(200) null,
    nombre varchar(200) null,
    ubicacion varchar(200) null,
    tipo varchar(200) null,
    comentario text null,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id)
);

create table bitacoras(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    nombre varchar(200) null,
    comentario text null,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id)
);

create table grupo(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    bitacoraId bigint(20) unsigned NOT NULL,
    tareaID bigint(20) unsigned NOT NULL,
    created_at datetime NULL,
    updated_at datetime NULL,
    primary key (id),
    CONSTRAINT FK_grupo_bitacora foreign key (bitacoraId) references bitacoras(id),
    CONSTRAINT FK_grupo_tarea foreign key (tareaID) references tarea(id)
);

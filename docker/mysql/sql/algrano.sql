-- Script de creación de la base de datos para MySQL (modificado y corregido)
CREATE DATABASE
IF NOT EXISTS algrano;

USE algrano;
-- Tabla Rol
CREATE TABLE
IF NOT EXISTS rol
(
    id_rol CHAR
(9) NOT NULL PRIMARY KEY,
    rol VARCHAR
(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
-- Tabla Usuario
CREATE TABLE
IF NOT EXISTS usuario
(
    DNI CHAR
(9) NOT NULL PRIMARY KEY,
    usuario VARCHAR
(30) NOT NULL,
    contraseña CHAR
(255) NOT NULL,
    direccion VARCHAR
(100) NOT NULL,
    correo VARCHAR
(50) UNIQUE NOT NULL,
    fec_nac DATE NOT NULL,
    id_rol_usuario CHAR
(9) NOT NULL,
    FOREIGN KEY
(id_rol_usuario) REFERENCES rol
(id_rol) ON
DELETE CASCADE
) ENGINE = InnoDB
DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
-- Tabla Productos
CREATE TABLE
IF NOT EXISTS producto
(
    id_producto CHAR
(9) PRIMARY KEY,
    nombre VARCHAR
(255) NOT NULL,
    precio_ud DECIMAL
(10, 2) NOT NULL,
    imagen VARCHAR
(255)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
-- Tabla Productos Detalle
CREATE TABLE
IF NOT EXISTS productos_detalle
(
    id_producto_detalle CHAR
(9) PRIMARY KEY,
    nombre VARCHAR
(255) NOT NULL,
    tipo ENUM
('Grano', 'Molido') NOT NULL,
    descripcion TEXT,
    stock INT NOT NULL DEFAULT 0,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    origen VARCHAR
(100),
    FOREIGN KEY
(id_producto_detalle) REFERENCES producto
(id_producto) ON
DELETE CASCADE
) ENGINE = InnoDB
DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
-- Tabla Pedido
CREATE TABLE
IF NOT EXISTS pedido
(
    codigo_pedido CHAR
(9) PRIMARY KEY,
    DNI_cliente CHAR
(9) NOT NULL,
    precio_total DECIMAL
(10, 2) NOT NULL,
    fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM
(
        'Pendiente',
        'Pagado',
        'Enviado',
        'Entregado',
        'Cancelado'
    ) DEFAULT 'Pendiente',
    FOREIGN KEY
(DNI_cliente) REFERENCES usuario
(DNI) ON
DELETE CASCADE
) ENGINE = InnoDB
DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
-- Tabla Detalles Pedido
CREATE TABLE
IF NOT EXISTS pedidos_detalle
(
    codigo_detalle CHAR
(9) PRIMARY KEY NOT NULL,
    id_producto_pedido CHAR
(9) NOT NULL,
    tipo ENUM
('Grano', 'Molido') NOT NULL,
    subtotal DECIMAL
(10, 2) NOT NULL,
    cantidad_descrita INT NOT NULL,
    codigo_pedido CHAR
(9) NOT NULL,
    FOREIGN KEY
(codigo_pedido) REFERENCES pedido
(codigo_pedido) ON
DELETE CASCADE,
    FOREIGN KEY (id_producto_pedido)
REFERENCES producto
(id_producto) ON
DELETE CASCADE
) ENGINE = InnoDB
DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
-- Script de inserción de datos iniciales
-- Roles
INSERT INTO
    rol
    (id_rol, rol)
VALUES
    ('0', 'invitado'),
    ('1', 'cliente'),
    ('2', 'empleado'),
    ('3', 'administrador');
-- Usuarios
INSERT INTO
    usuario
    (
    DNI,
    usuario,
    contraseña,
    direccion,
    correo,
    fec_nac,
    id_rol_usuario
    )
VALUES
    (
        '45123248K',
        'AlgranoAdmin',
        '162132b381fbadbe5c3d288539aa0243f3a3c0ada934134aa9f2f5ac850fa8a331447d213e77f6b29373a39321e4e9d96f3f4cfe1e7fceed626a59a04b603442',
        'Camino del lomo,32',
        'algrano@gmail.com',
        '1987-06-23',
        '3'
    ),
    (
        '76594532F',
        'Lxrenzx189',
        '2ec33b24018e46699d86954b3d20be96bfea1ea17f3d8be30af00ac8864923f19aa230fb340e1d3583deca1d62678304e1f9a019c3dee88f48d4961531b9bbfb',
        'Camino de la serpiente,21',
        'lorenzo189@gmail.com',
        '1987-06-23',
        '1'
    ),
    (
        '56432655M',
        'EmpleadoMiguel123',
        '69d02a6c3c9ea7ff711e454020a16a81f7ee438cd3334e0f9be3eb0338df2dff58a231963c681e736143eeb6c1d3280d5f053d9892ff33ff09d95cf8294c556f',
        'Camino de los objetos,5',
        'miguelAlgrano@gmail.com',
        '1970-01-01',
        '2'
    );
-- Productos
INSERT INTO
    producto
    (
    id_producto,
    nombre,
    precio_ud,
    imagen
    )
VALUES
    (
        'PROD001',
        'Café Arabico',
        12.50,
        '../img/Productos/Arabico.png'
    ),
    (
        'PROD002',
        'Café Robusta',
        9.75,
        '../img/Productos/Café Robusto.png'
    ),
    (
        'PROD003',
        'Café Java',
        15.50,
        '../img/Productos/Café Java.png'
        ),
    (
        'PROD004',
        'Café Kenya',
        25.50,
        '../img/Productos/Café Kenya.png'
    ),
    (
        'PROD005',
        'Café Mezcla Arábica Robusta',
        30.00,
        '../img/Productos/Café Mezcla Arábica.png'
    );
-- Detalles de Productos
INSERT INTO
    productos_detalle
    (
    id_producto_detalle,
    nombre,
    tipo,
    descripcion,
    stock,
    origen
    )
VALUES
    (
        'PROD001',
        'Café Arábica',
        'Grano',
        'Café con sabor suave, equilibrado, aromático.',
        100,
        'Colombia'
    ),
    (
        'PROD002',
        'Café Robusta',
        'Molido',
        'Café con un sabor fuerte, amargo y terroso, con notas de nuez y chocolate amargo.',
        80,
        'Brasil'
        ),
    (
        'PROD003',
        'Café Java',
        'Molido',
        'Café con sabor fuerte, dulce y ligeramente picante, con notas de chocolate, frutos secos y especias.',
        50,
        'Indonesia'
        ),
    (
        'PROD004',
        'Café Kenya',
        'Molido',
        'Café con sabor brillante, afrutado y a menudo con notas cítricas, especialmente de limón.',
        100,
        'Kenia'
    ),
    (
        'PROD005',
        'Café Mezcla Arábica Robusta',
        'Grano',
        'Café con un sabor suave, afrutado e intenso, es muy cremoso y de un olor espectacular.',
        50,
        'Yemen'
    );
-- Pedidos
INSERT INTO
    pedido
    (
    codigo_pedido,
    DNI_cliente,
    precio_total,
    estado
    )
VALUES
    (
        'PED001',
        '76594532F',
        35.00,
        'Pagado'
    );
-- Detalles del pedido
INSERT INTO
    pedidos_detalle
    (
    codigo_detalle,
    id_producto_pedido,
    tipo,
    subtotal,
    cantidad_descrita,
    codigo_pedido
    )
VALUES
    (
        'DET001',
        'PROD001',
        'Grano',
        25.00,
        2,
        'PED001'
    );

INSERT INTO
    pedidos_detalle
    (
    codigo_detalle,
    id_producto_pedido,
    tipo,
    subtotal,
    cantidad_descrita,
    codigo_pedido
    )
VALUES
    (
        'DET002',
        'PROD002',
        'Molido',
        10.00,
        3,
        'PED001'
    );
-- Crear usuario de base de datos y asignar permisos
CREATE USER
IF NOT EXISTS 'algrano_admin' @'localhost' IDENTIFIED BY 'AlgranoAdmin';

CREATE USER
IF NOT EXISTS 'algrano_empleado' @'localhost' IDENTIFIED BY 'EmpleadoMiguel123';
-- Asignar privilegios
GRANT ALL PRIVILEGES ON algrano.* TO 'algrano_admin' @'localhost';

GRANT
SELECT,
INSERT
,
UPDATE ON algrano.producto TO 'algrano_empleado' @'localhost'
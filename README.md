# PROYECTO ALGRANO S.L. ☕

Este proyecto es una aplicación web que gestiona una tienda web de café en grano y molido. Está desarrollado en PHP y utiliza una base de datos MySQL para almacenar la información de usuarios,empleados,pedidos,productos...

## Descripción 📝

El sistema cuenta con dos tipos de usuarios:

- **Cliente**: Realiza pedidos en web.
- **Empleado**: Sube productos y gestiona el inventario de la tienda.

### Funcionalidades 🛒🛍

- **Autenticación**: Los usuarios(Clientes o Empleados) deben iniciar sesión para acceder a las páginas protegidas del sistema.
- **Páginas protegidas**: Las páginas solo son accesibles si el usuario ha iniciado sesión y tiene los permisos adecuados.
- **Cierre de sesión**: En todas las páginas protegidas hay un enlace para cerrar sesión.

## Instalación 🛠 ⚙

1. Clona este repositorio en tu máquina local:

   ```bash
   git clone https://github.com/Jxse11/ALGRANO_SL_PRODUCCION.git

2. Acceda a la carpeta con el nombre docker
3. Ejecuta el siguiente comando para levantar los contenedores:
   ```bash
   docker-compose up -d --build
   ```
   
   ```-up```: Levanta los servicios definidos en el archivo docker-compose.yml.

   ```-d```: Lo hace en segundo plano (modo "detached").

   ```--build```: Fuerza la reconstrucción de las imágenes antes de levantar los contenedores.

4. Una vez levantados los contenedores con exito, debe dirigirse a la carpeta mysql/sql y debe de encontrar el script de creación y llenado de la base de datos, una vez copiado dirigase al dominio de phpMyAdmin, y pegue y ejecute el codigo completo(Se creará la base de datos con los campos de prueba, asi como sus tablas correspondientes).
5. Finalmente acceder al dominio de la web y realizar pruebas sobre este.

## Dominios Web Locales 💻🖥
Web: ```http:\\localhost:8080```

phpMyAdmin: ```http:\\localhost:8081```

Si deseas contribuir al proyecto, por favor crea un "fork" del repositorio y haz un "pull request" con tus cambios. Asegúrate de seguir las buenas prácticas de codificación y documentación.

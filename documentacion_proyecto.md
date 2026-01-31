# Documentación del Proyecto

## Descripción del Proyecto

Este proyecto es una aplicación web de gestión de usuarios desarrollada como parte de un proyecto universitario. Permite a los usuarios registrarse, iniciar sesión, acceder a un dashboard protegido y editar su perfil de usuario. La aplicación utiliza tecnologías web estándar para crear una experiencia completa de gestión de usuarios.

## Tecnologías Utilizadas

- **Frontend:**
  - HTML5: Estructura semántica de las páginas.
  - CSS3: Estilos y diseño responsivo básico.
  - JavaScript: Manipulación del DOM, manejo de eventos y comunicación AJAX con Fetch API.

- **Backend:**
  - PHP: Lógica del servidor con Programación Orientada a Objetos (POO).
  - MySQL: Base de datos relacional para almacenar usuarios.

- **Entorno de Desarrollo:**
  - XAMPP: Servidor local para Apache, MySQL y PHP.
  - Git/GitHub: Control de versiones y repositorio.

- **Seguridad:**
  - Prepared Statements con PDO para prevenir inyección SQL.
  - Hashing de contraseñas con password_hash().
  - Sesiones para autenticación.
  - Sanitización de entradas.

## Funcionalidades Implementadas

- **Registro de Usuarios:** Formulario para crear una nueva cuenta con nombre de usuario, email y contraseña.
- **Inicio de Sesión:** Autenticación de usuarios existentes.
- **Dashboard Protegido:** Página de bienvenida accesible solo para usuarios logueados, con opción de logout.
- **Edición de Perfil:** Permite cambiar el nombre de usuario.
- **Comunicación AJAX:** Envío asíncrono de formularios para una mejor experiencia de usuario, con indicadores de carga (spinners) y manejo de errores.
- **Programación Orientada a Objetos:** Clases Database y User para encapsular la lógica de base de datos y usuario.
- **Seguridad Básica:** Protección contra ataques comunes como SQL injection y XSS básico.
- **Interfaz de Usuario:** Diseño simple y responsivo con feedback visual para errores y éxito.

## Instrucciones Detalladas para la Ejecución del Proyecto

1. **Requisitos Previos:**
   - Instalar XAMPP (https://www.apachefriends.org/).
   - Asegurarse de que Apache y MySQL estén corriendo.

2. **Configuración de la Base de Datos:**
   - Abrir phpMyAdmin en http://localhost/phpmyadmin.
   - Crear una base de datos llamada `gestion_usuarios`.
   - Ejecutar el siguiente script SQL para crear la tabla de usuarios (mi_proyecto_db.sql):

     ```sql
     CREATE TABLE users (
         id INT AUTO_INCREMENT PRIMARY KEY,
         username VARCHAR(50) NOT NULL UNIQUE,
         email VARCHAR(100) NOT NULL UNIQUE,
         password VARCHAR(255) NOT NULL,
         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );
     ```

3. **Configuración del Proyecto:**
   - Clonar o descargar el proyecto en `C:\xampp\htdocs\gestion-usuarios`.
   - Editar `config/database.php` con las credenciales de la base de datos (usuario: root, contraseña: vacía por defecto en XAMPP).

4. **Ejecución:**
   - Iniciar Apache y MySQL en XAMPP.
   - Abrir el navegador y ir a `http://localhost/gestion-usuarios/`.
   - Registrarse o iniciar sesión.

5. **Notas:**
   - Asegurarse de que las sesiones estén habilitadas en PHP.
   - Para desarrollo, usar la consola del navegador para debugging de JavaScript.
To-Do List – PHP + MySQL (PROYECTO DE SANTIAGO,BAUTISTA,LOPEZ)
Descripción:
Este proyecto es una aplicación To-Do List desarrollada en PHP con MySQL.
Permite a los usuarios registrarse, iniciar sesión y gestionar sus propias tareas (crear, completar y eliminar).

Cada usuario solo puede ver y modificar sus propias tareas.

LO QUE USE PARA ESTE PROYECTO

PHP

MySQL

PDO

HTML / CSS

Bootstrap 5

XAMPP

ESTRUCTURA DEL PROYECTO
recuperatorio-leo/
│
├── config/
│   └── db.php                # conexión a la base de datos
│
├── includes/
│   ├── header.php            # header HTML + bootstrap
│   ├── footer.php            # cierre del HTML
│   └── navbar.php            # barra de navegación
│
├── publico/
│   ├── index.php             # redirección inicial
│   ├── sesion.php            # login
│   ├── registro.php          # registro de usuarios
│   ├── dashboard.php         # listado de tareas
│   ├── crear_tarea.php       # crear nueva tarea
│   ├── eliminar_tarea.php    # elimina tarea
│   ├── marcar_completada.php # marca tarea como completada
│   └── logout.php            # cerrar sesión
│
├── sql/
│   └── create_tables.sql     # script de la base de datos
│
└── assets/
    └── style.css             # estilos propios

//BASE DE DATOS

El proyecto usa una base llamada:

todolist

Tabla usuarios

Guarda los datos de los usuarios

El email es único

La contraseña se guarda encriptada

Tabla tareas

Cada tarea pertenece a un usuario

Tiene estado pendiente o completada

Se elimina automáticamente si se borra el usuario

//SISTEMAS DE USUARIOS

Registro con validaciones básicas

Login con contraseña encriptada (password_hash)

Manejo de sesión con $_SESSION

Protección de rutas (si no está logueado, no entra)

//EL FLUJO DE LA APP

El usuario entra al sitio

Si no está logueado → va al login

Puede registrarse si no tiene cuenta

Inicia sesión

Accede al dashboard

Puede:

crear tareas

marcarlas como completadas

eliminarlas

Puede cerrar sesión

//FUNCIONES PRINCIPALES

Registro de usuarios

Inicio de sesión

Crear tareas

Listar tareas

Filtrar tareas

Completar tareas

Eliminar tareas

Cerrar sesión

//SEGURIDAD

Uso de PDO con prepared statements

Contraseñas encriptadas

Verificación de sesión en cada página

Cada usuario ve solo sus datos

//INSTALACION
a la hora de instalar es muy breve,solo necesitamos;
tener instalado xampp
apache y mysql activos
un navegador web

una vez eso hecho,Abrir phpMyAdmin y crear una base de datos llamada:
todolist

importamos el archivo:sql/create_tables.sql
y verificamos la conexion en db.php
/CONCLUSIONES

Este proyecto fue realizado con fines para practicar:
PHP
sesiones
base de datos
CRUD
organización de archivos
tambien:
a la hora de implementarlo,pude tener un aprendizaje sobre lo que es php y su forma de programar,al no tener algo que me indique cual es el error,tuve que buscar la forma de solucionar las cosas,reforzar mi analisis,asesorarme de manera externa,entre otras cosas que elevo mi conocimiento.

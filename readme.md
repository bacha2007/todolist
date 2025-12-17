Proyecto: Gestor de Tareas en PHP

Este proyecto es una aplicación web de gestión de tareas desarrollada en PHP + MySQL, con sistema de registro, login, sesiones y CRUD de tareas por usuario

Objetivo del Proyecto
cual es realmente la finalidad?
Permitir que cada usuario:
* Se registre e inicie sesión
* Cree tareas propias
* Marque tareas como completadas
* Elimine tareas
* Visualice solo sus propias tareas
* Cierre sesión de forma segura

---

Estructura del Proyecto

tu_proyecto/
│
├── auth/
│   ├── registro.php        # Registro de usuarios
│   ├── login.php           # Inicio de sesión
│   ├── logout.php          # Cierre de sesión
│
├── panel/
│   ├── dashboard.php       # Panel principal del usuario
│   ├── crear_tarea.php     # Crear nueva tarea
│   ├── marcar_completada.php # Cambiar estado de tarea
│   ├── eliminar_tarea.php  # Eliminar tarea
│
├── config/
│   └── db.php              # Conexión PDO a la base de datos
│
├── includes/
│   ├── header.php          # Cabecera HTML
│   └── footer.php          # Pie HTML
│
└── README.md               # Documentación del proyecto

Base de Datos (MySQL)

Tabla: `usuarios`

| Campo     | Tipo           | Descripción               |
| --------- | -------------- | ------------------------- |
| id        | INT PK AI      | Identificador del usuario |
| nombre    | VARCHAR        | Nombre del usuario        |
| email     | VARCHAR UNIQUE | Email de acceso           |
| password  | VARCHAR        | Contraseña en hash        |
| creado_at | TIMESTAMP      | Fecha de creación         |

---
Tabla: `tareas`

| Campo      | Tipo      | Descripción            |
| ---------- | --------- | ---------------------- |
| id         | INT PK AI | ID de la tarea         |
| usuario_id | INT FK    | Usuario dueño          |
| titulo     | VARCHAR   | Texto de la tarea      |
| estado     | ENUM      | pendiente / completada |
| creado_at  | TIMESTAMP | Fecha                  |

---
DER (Diagrama Entidad-Relación)

```
USUARIOS (1) ──────── (N) TAREAS
   id ----------------- usuario_id
```

* Un usuario puede tener muchas tareas
* Una tarea pertenece a un solo usuario

---

Flujo de Autenticación

1Registro → `registro.php`

* Valida campos
* Hashea contraseña
* Inserta usuario
* Redirige a login

2Login → `login.php`

* Verifica credenciales
* Inicia sesión
* Guarda datos en `$_SESSION`
* Redirige a dashboard

3 Protección

* Archivos privados verifican:

```php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
```

4️ Logout → `logout.php`

* Destruye sesión
* Redirige a login

---

Dashboard

Funciones:

* Saludo al usuario
* Listado de tareas
* Filtros por estado
* Acciones CRUD

Filtros:

```php
?filter=todas
?filter=pendientes
?filter=completadas
```

---

Seguridad Implementada

* Contraseñas con `password_hash()`
* Verificación con `password_verify()`
* Sesiones PHP
* Protección por usuario en consultas SQL
* Uso de `htmlspecialchars()` en salidas
* PDO con prepared statements

---

Errores que se corrigieron (Aprendizaje)

* Headers enviados antes de `header()`
* `session_start()` mal ubicado
* Errores de sintaxis (`$stmt->execute`)
* Rutas relativas incorrectas
* Falta de control por usuario en DELETE

---
 Posibles Mejoras Futuras

* Edición de tareas
* Roles de usuario
* Validaciones avanzadas

---
Estado del Proyecto

 Funcional
 Seguro
 Escalable
 Documentado

---
hecho por :santiago,bautista,lopez
Stack: PHP 8+, MySQL, PDO, Bootstrap
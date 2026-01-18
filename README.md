# Museo Prehistórico Huilassik Park para la Paz

## Requisitos

- PHP 8.1+ (recomendado).
- Extensiones: `pdo`, `pdo_mysql`, `mbstring`.
- Base de datos MySQL/MariaDB.

## Configuración de base de datos

Edita `config/config.php` con tu configuración local:

```php
'db' => [
    'host' => 'localhost',
    'name' => 'museo_prehistorico',
    'user' => 'root',
    'pass' => '',
    'charset' => 'utf8mb4',
],
```

## Panel administrativo

**Ruta de acceso:** `/admin/login.php` (o `/public/admin/login.php` si el servidor apunta a la raíz del proyecto).

### Migraciones y usuario administrador

Puedes ejecutar los SQL manualmente:

1. `database/migrations/001_create_users.sql`
2. `database/migrations/002_alter_users.sql` (solo si la tabla ya existía).

O usar el instalador seguro:

```bash
ADMIN_EMAIL=admin@huilassikpark.local ADMIN_PASSWORD='Admin12345*' php scripts/setup.php
```

> El instalador crea el usuario admin solo si no existe ninguno y usa `password_hash`.

**Credenciales por defecto (solo para entornos locales):**
- Email: `admin@huilassikpark.local`
- Contraseña: `Admin12345*`

### Cambiar contraseña y eliminar credenciales por defecto

1. Ingresa con el usuario admin.
2. Actualiza la contraseña del usuario desde la base de datos (campo `password_hash`) usando `password_hash` en PHP.
3. Elimina el usuario por defecto o cambia su email a uno privado antes de publicar en producción.

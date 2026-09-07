# Sistema de Gestión

Aplicación web para administrar productos e inventario. Permite registrar entradas, mermas y asignaciones de tareas, además de consultar informes y un resumen en el dashboard.

## Tecnologías

- PHP `^8.3`
- Laravel `^13.17`
- MySQL 8+ (configuración local incluida) o SQLite
- Node.js y npm para compilar los recursos frontend
- Vite, Tailwind CSS, Alpine.js y Bootstrap (parte de Bootstrap se carga desde CDN)

## Requisitos

Instalar y comprobar:

```text
PHP >= 8.3 con extensiones PDO, pdo_mysql (si se usa MySQL), mbstring, OpenSSL, XML, Ctype, JSON, Tokenizer y BCMath
Composer 2.x
Node.js >= 20 y npm
MySQL 8+ o SQLite 3
```

En Windows, Laragon es una opción adecuada. El proyecto debe ejecutarse apuntando a la carpeta `public`, no a la raíz del repositorio.

## Instalación local

1. Clonar o copiar el proyecto y entrar en su directorio:

```bash
cd sistema_gestion
```

2. Instalar dependencias PHP y JavaScript:

```bash
composer install
npm install
```

3. Crear el archivo de entorno y generar la clave de Laravel:

```bash
copy .env.example .env       # Windows
# cp .env.example .env       # Linux/macOS
php artisan key:generate
```

4. Configurar la base de datos en `.env` y ejecutar las migraciones:

```bash
php artisan migrate
```

5. Compilar los recursos frontend:

```bash
npm run build
```

6. Iniciar la aplicación:

```bash
php artisan serve
```

Abrir <http://localhost:8000>.

## Configuración de base de datos

### MySQL (recomendado para el entorno actual)

Crear una base de datos vacía:

```sql
CREATE DATABASE sistema_gestion CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Configurar `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_gestion
DB_USERNAME=root
DB_PASSWORD=
```

Cambiar usuario y contraseña según la instalación local.


## Datos iniciales y acceso

El seeder incluido crea el usuario:

```text
Correo: test@example.com
Contraseña: password
```

Para cargarlo:

```bash
php artisan db:seed
```



## Uso del sistema

- **Dashboard:** totales y gráfico de entradas y mermas por producto.
- **Productos:** catálogo y stock.
- **Entradas:** registra el ingreso de cantidades y actualiza el stock.
- **Mermas:** registra pérdidas asociadas a un producto.
- **Asignaciones:** administra tareas asignadas a usuarios.
- **Informes:** filtra información por usuario, producto y tipo.
- **Perfil:** actualización de datos, contraseña y eliminación de cuenta.

Los productos deben existir antes de registrar entradas o mermas. Las unidades admitidas son `kg`, `unidad` y `litro`.

## Desarrollo frontend

Para recompilar automáticamente mientras se desarrollan cambios:

```bash
npm run dev
```

Mantener Laravel ejecutándose en otra terminal:

```bash
php artisan serve
```

Si se modifica `.env` y Laravel conserva valores anteriores, ejecutar `php artisan config:clear`.

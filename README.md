# 🎓 ITSTA Tutorías

Sistema web desarrollado con Laravel para la gestión de tutorías en el Instituto Tecnológico Superior de Tantoyuca.

##  Características principales

- Registro y gestión de tutorados y tutores
- Control de sesiones de tutoría
- Reportes académicos
- Gestión de usuarios y roles
- Diseño responsive con Bootstrap 5

##  Tecnologías utilizadas

- **Laravel** (framework PHP)
- **Bootstrap 5** (diseño frontend)
- **MySQL** (base de datos)
- **JavaScript & Blade** (frontend)
- **Composer y NPM** (gestión de paquetes)

##  Requisitos del sistema

- PHP >= 8.1
- Composer
- Node.js y NPM
- MySQL o MariaDB

## Instalación

```bash
# Clonar el repositorio
git clone https://github.com/tuusuario/itsta-tutorias.git
cd itsta-tutorias

# Instalar dependencias PHP y JavaScript
composer install
npm install && npm run dev

# Copiar archivo de entorno y configurar
cp .env.example .env
php artisan key:generate

# Configurar la base de datos en .env y ejecutar migraciones
php artisan migrate --seed

# Iniciar servidor local
php artisan serve

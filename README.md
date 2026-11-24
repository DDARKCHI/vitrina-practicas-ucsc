# Vitrina de Proyectos de Práctica UCSC

Portada del Instituto Tecnológico UCSC, sede Talcahuano. La aplicación usa Laravel 13 y Blade. Se ejecuta con PHP 8.3 o superior y sus extensiones de Laravel. El catálogo se mantiene en un archivo de configuración. Puede funcionar sin base de datos, Node.js ni cuentas de usuario. [Requisitos de Laravel 13](https://laravel.com/docs/13.x/deployment#server-requirements)

## Revisar la portada

Descomprime el ZIP en una carpeta local, por ejemplo `C:\proyectos`, y abre una terminal en la carpeta que contiene `artisan`. En PowerShell, ejecuta lo siguiente para una instalación nueva.

```powershell
Copy-Item .env.example .env
php artisan key:generate
php artisan serve --host=127.0.0.1 --port=8013
```

Abre `http://127.0.0.1:8013/`. Revisa la portada en escritorio y móvil. La ruta `http://127.0.0.1:8013/up` permite comprobar que Laravel responde. Si recibiste el código sin `vendor/`, ejecuta `composer install --no-dev --prefer-dist` antes de los comandos Artisan. Conserva el archivo `.env` y la clave generada en las actualizaciones.

## Trasladar el proyecto con GitHub

Publica el código en un repositorio privado durante la revisión. El repositorio incluye `composer.lock`, los recursos de la portada y `.env.example`. Las dependencias instaladas en `vendor/` y la configuración local en `.env` se generan en cada equipo.

En el otro computador, usa la URL HTTPS de tu repositorio. Estos comandos descargan el proyecto y preparan una vista local nueva en Windows.

```powershell
git clone https://github.com/TU-USUARIO/vitrina-practicas-ucsc.git
cd vitrina-practicas-ucsc
composer install --no-dev --prefer-dist --optimize-autoloader
Copy-Item .env.example .env
php artisan key:generate
php artisan serve --host=127.0.0.1 --port=8013
```

Si ese computador lo usarás solo para transferir el proyecto al servidor, puedes copiar el ZIP por SFTP o SCP. También puedes transferir el código clonado e instalar las dependencias con Composer directamente en Ubuntu.

## Actualizar el catálogo

Para activar los enlaces de SIDEc y SistemaHorarios, completa `PORTAL_SIDEC_URL` y `PORTAL_HORARIOS_URL` en `.env` con sus direcciones definitivas. Hasta entonces, sus fichas indican que el acceso está pendiente.

Para agregar un proyecto, copia una ficha en `config/vitrina.php` y edita `name` (nombre), `category` (categoría), `description` (descripción breve), `code` (iniciales para la tarjeta) y `url` (dirección HTTP o HTTPS, o `null` para una ficha pendiente). Puedes incluir una imagen copiándola a `public/imagenes/` y agregando `'image' => 'imagenes/mi-proyecto.webp'` a la ficha. Valida las descripciones con sus autores y comprueba cada enlace desde la red de sus visitantes. Cuando el sitio tenga una caché de configuración activa, vuelve a generarla con `php artisan config:cache` después de editar el catálogo o sus enlaces.

## Instalar en Ubuntu después de la revisión

1. Sube el ZIP por SCP o SFTP y descomprímelo en una carpeta nueva para la vitrina, por ejemplo `/var/www/vitrina-practicas-ucsc`. Verifica que `artisan` quede directamente bajo esa ruta. Si tienes Composer, ejecuta `composer check-platform-reqs --no-dev` para confirmar la compatibilidad del PHP del servidor. Si falta `vendor/`, instala las dependencias con `composer install --no-dev --prefer-dist --optimize-autoloader`.
2. En una instalación nueva, copia `.env.example` a `.env`. Ajusta `APP_ENV=production`, `APP_DEBUG=false` y `APP_URL` a la dirección final aprobada. Ejecuta `php artisan key:generate --force` una vez, con `APP_KEY` vacío. Conserva los ajustes de sesión y caché del ejemplo. Da acceso de lectura a PHP-FPM en la aplicación y a `.env`, y acceso de escritura a `storage/` y `bootstrap/cache/`. [Configuración y permisos de Laravel](https://laravel.com/docs/13.x/deployment#directory-permissions)
3. Confirma qué está sirviendo el servidor antes de elegir el sitio virtual. Puedes revisar `sudo ss -ltnp` y, si el servidor usa Nginx, `sudo nginx -T`. Los puertos 80 y 8080 se mencionaron para los proyectos anteriores y su uso actual debe comprobarse en Ubuntu.
4. Crea un sitio virtual propio de la vitrina. Usa `public/` como raíz web y dirige las rutas de Laravel a `public/index.php`. Con Nginx, el sitio puede compartir el puerto 80 mediante un `server_name` autorizado y único. Si la portada debe abrir directamente por IP y la IP ya sirve a otro proyecto, coordina primero el cambio del sitio principal y la dirección definitiva de cada aplicación. [Selección de sitio virtual en Nginx](https://nginx.org/en/docs/http/request_processing.html)

Ejemplo de bloque Nginx para una prueba HTTP interna. Sustituye `vitrina.example` por el nombre asignado y `phpX.Y-fpm.sock` por el socket del pool que corresponda. Para el acceso final, usa el HTTPS configurado por la universidad y ajusta `APP_URL` en consecuencia.

```nginx
server {
    listen 80;
    server_name vitrina.example;
    root /var/www/vitrina-practicas-ucsc/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /index.php {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $realpath_root/index.php;
        fastcgi_pass unix:/run/php/phpX.Y-fpm.sock;
    }

    location ~ /\. {
        deny all;
    }

    location ~ \.php(?:/|$) {
        return 404;
    }
}
```

En la carpeta de la aplicación, ejecuta `php artisan optimize`. Comprueba la configuración con `sudo nginx -t` antes de recargar Nginx. Verifica `/`, `/up` y los enlaces desde la red de los visitantes antes de usar la vitrina como portada principal. [Despliegue de Laravel](https://laravel.com/docs/13.x/deployment)

## Identidad UCSC

El logotipo horizontal, los colores institucionales y la tipografía Montserrat se tomaron de los recursos oficiales. La licencia de Montserrat se incluye en `public/fuentes/OFL.txt`. [Normas gráficas y recursos UCSC](https://ucsc.cl/la-universidad/normas-graficas-ucsc/)

La fotografía de la sede proviene del catálogo del Instituto Tecnológico. [Sedes del Instituto Tecnológico UCSC](https://it.ucsc.cl/sedes/)

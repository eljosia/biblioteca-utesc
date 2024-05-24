# Iniciando

Iniciando el proyecto

# Requerimientos

	- PHP >= 8.0

# Instalación

## Laravel

Instalación básica de laravel con composer

```jsx
composer upgrade && install
```

## NPM

Inicializando

- Instalación e inicialización de vistas

    ```jsx
    npm upgrade && npm install
    ```

- Se crean las vistas

## Base de datos

Solo es necesaria una base de datos con collation: **utf8mb4_unicode_ci**

Después del .env corre las migraciones con los seeders. `php artisan migrate —seed`

## ENV

Recuerda cambiar el app key (`php artisan key:generate`) y el dominio en el cual se encuentra tu aplicación., en este ejemplo es **anenscript.local**, es necesario en: APP_URL, PASSPORT_ENDPOINT.

    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:VqR94vKgnUSqpt2F9f4otJe/MOP8fPzhMqVDJKQqklo=
    APP_DEBUG=true
    APP_URL=https://metronic.local
    APP_AUTHKEY=T4dbo7bkuR63CK!9YT@7AN*b

    LOG_CHANNEL=stack
    LOG_DEPRECATIONS_CHANNEL=null
    LOG_LEVEL=debug

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=metronic
    DB_USERNAME=root
    DB_PASSWORD=

    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=file
    SESSION_LIFETIME=120

    MEMCACHED_HOST=127.0.0.1

    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

    MAIL_MAILER=smtp
    MAIL_HOST=mailhog
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="hello@example.com"
    MAIL_FROM_NAME="${APP_NAME}"

    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=
    AWS_USE_PATH_STYLE_ENDPOINT=false

    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=
    PUSHER_HOST=
    PUSHER_PORT=443
    PUSHER_SCHEME=https
    PUSHER_APP_CLUSTER=mt1

    MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

    GOOGLE_CLIENT_ID=447077588182-tnre8e7pgrbjn37f9lnhgvaf4b6n9d31.apps.googleusercontent.com
    GOOGLE_CLIENT_SECRET=p_iV57unO0h1i2OJap4dsSmI
    GOOGLE_CALLBACK_URL=http://127.0.0.1:8000/auth/redirect/google




## Testing

Lo usuarios para testing son:
```jsx
	- Admin: demo@demo.com | demo
```

La clave es la misma para todos: **adminanen**

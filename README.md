# Subsecretaría de Derechos Humanos

Plataforma web que opera un banco informático o base de datos virtual que posibilita recibir, incorporar, sistematizar, clasificar, cotejar, elaborar y archivar toda la información de la Provincia del Chubut, sobre personas de quienes se desconozca su paradero o sus datos filiatorios y/o identificatorios, así como de aquellos que posteriormente fueran localizados. Asimismo, la plataforma estará preparada para extraer y consolidar información de diferentes tipos de archivos provenientes de los distintos organismos y/o instituciones del Estado y, a la vez, proveerá servicios mediante una API a aquellas que lo precisen.

___

## Autores

| Nombre               | Contacto                      |
| -------------------- | ----------------------------- |
| Emanuel Balcazar     | <emanuelbalcazar13@gmail.com> |
| Eric Hidalgo         | <erictwo2@gmail.com>          |
| Kevin Feuerschvenger | <kfeuerschvenger@gmail.com>   |
| Tomas Musse          | <palmer1030@gmail.com>        |
___

## Preparación (única vez)

Instalar Node.js:
* `sudo apt-get install -y curl`
* `sudo apt-get remove --purge nodejs npm`
* `curl -sL https://deb.nodesource.com/setup_5.x | sudo -E bash -`
* `sudo apt-get install -y nodejs`

Instalar Grunt y Bower
* `sudo npm install -g bower grunt-cli`

Instalar driver de postgresql para php
* `sudo apt-get install php5-pgsql`

## Despliegue

1. Clonar el repositorio: `git clone fipmgit.no-ip.biz:8102/IngeSoft/core.git`
2. Cambiar directorio: `cd ddhh/`
3. Instalar Laravel: `composer install --prefer-dist`
4. Instalar modulos de Node: `npm install`
5. Instalar componentes con Bower: `bower install`
6. Cambiar las configuraciones de la base de datos `app/config/database.php`
7. Si no existe el archivo .env, crearlo y ejecutar `php artisan key:generate` para generar una nueva Application Key.
8. Migrar base de datos: `grunt migrate` o `php artisan migrate`
9. Llenar base de datos: `grunt seed` o `php artisan db:seed`
10. Tareas recurrentes
  * Comprobar dependencias, compilar, minificar, correr tests unitarios y de calidad de código, finalmente iniciar la aplicación: `grunt prod`.
  * Compilar, minificar, correr test de calidad de código, y atender cambios para automatiación de estos procesos: `grunt devel`. (De momento no se automatizó el startup del servidor, por lo que se deberá hacer manualmente por unica vez, en otra terminal).
  * Tarea por defecto: Compilar, minificar, correr tests unitarios y de calidad de código: `grunt`.
11. Iniciar servidor `grunt serve` o `php artisan serve`.
12. Visualizar aplicación en un navegador.

## Test
* Test de servidor: `grunt test`
* Test de front-end: `grunt jshint`

## Rutas Rest disponibles
* Ejecutar: `grunt routes`

___

## Estructura básica de Laravel
Todos los proyectos en Laravel 5 tienen la siguiente estructura de directorios:

```javascript
proyecto
├── app
├── bootstrap
├── config
├── database
├── node_modules *
├── public
├── resources
├── storage
├── tests
├── vendor
├── .env
├── .gitignore *
├── .jshintrc *
├── artisan
├── AUTHORS *
├── bower.json *
├── composer.json
├── composer.lock
├── Gruntfile.js *
├── package.json
├── phpunit.xml
├── README.md
└── server.php
```

Los elementos con * son adicionales en nuestro proyecto, no corresponden a elementos estandar de un proyecto laravel.

A continuación describiremos los directorios y archivos más importantes para que nos ayuden a entender más el funcionamiento del framework.

`app`: Contiene clases que puedan ofrecer funcionalidad CORE a la aplicación, archivos de configuración y más.
Tiene a su vez otros subdirectorios importantes pero uno de los más utilizados es `Http` en el cuál ubicaremos nuestros `Controllers`, `Middlewares` y `Requests` en sus carpetas correspondientes, además encontremos también el archivo `routes.php` donde escribiremos las rutas de la aplicación.
A nivel de la raíz del directorio app encontraremos la carpeta `Models`, los modelos comunmente se ubicarán dentro de ella.

`bootstrap`: Contiene algunos archivos que inicializan el framework y configuran el autoarranque, tambien un directorio `cache` que contiene algunos archivos generados por el framework para optimizacion de performance.

`config`: Como el nombre indica, contiene todos los archivos de configuracion de la aplicación.

`database`: Contiene los `migration` y `seeds`.

`public`: Dentro de este directorio colocaremos todos los recursos estáticos de nuestra aplicación, es decir, archivos css, js, imágenes y fuentes.

`resources`: Dentro de este directorio se encuentran los subdirectorios `view`, donde hubicaremos nuestros archivos .php y .php.blade. Es recomendable crear una carpeta *templates*.

`storage`: Cuando Laravel necesita escribir algo en el disco, lo hace en el directorio storage . Por este motivo, tu servidor web debe poder escribir en esta ubicación.

`test`: Aquí escribiremos los archivos de pruebas que serán ejecutadas posteriormente.

`vendor`: Contiene dependencias de Composer.

`.env`: En este archivo se configurará el modo en que se ejecuta nuestra aplicación.
___

## Estructura básica de Angular
A continuación se muestra la estructura básica propuesta por Angular, con algunas minimas modificaciones particulares de la implementación.

```javascript
public/
├── assets/
├── css/
├── fonts/
├── img/
├── js/
│   ├── app.js
│   ├── config/
│   │   └── routes.js
│   ├── controllers/
│   │   ├── controllers.js
│   │   ├── home/
│   │   │   └── HomeCtrl.js
│   │   ├── login/
│   │   │   └── LoginCtrl.js
│   │   └── navigation/
│   │       └── NavCtrl.js
│   ├── directives/
│   └── services/
│       ├── login/
│       │   └── LoginServices.js
│       ├── services.js
│       └── session/
│           └── SessionServices.js
├── lib/
└── partials/
    ├── content/
    │   ├── home/
    │   │   └── home.html
    │   └── user/
    │       └── userProfile.html
    ├── dialogs/
    ├── footer/
    │   └── footer.html
    ├── head/
    │   └── header.html
    └── navigation/
        └── navigation.html

```
`assets`: Contiene el código javascript de la aplicación web minificado. Lo mismo ocurre para los estilos utilizados. Se recomienda no modificar estos archivos manualmente, ya que se sobreescriben cada vez que se inicializa la aplicacion.

`css`: Aqui se colocan todos los archivos css, separados por funcionalidad (Ej: footer.css, navigation.css, etc).

`fonts`: Archivos de fuentes usados por bootstrap. Se recomienda no colocar codigo propio aqui, ya que se puede perder.

`img`: Imágenes a utilizar en la web.

`js`: Esta carpeta contiene todo el código fuente del front-end.

* app.js: es el punto de partida de Angular para inicializar los módulos de la aplicación, aplicar configuraciones, y otras funcionalidades.
* config: este directorio contiene el script de configuracion de rutas navegables de la web.
* controllers: contiene los scripts que interactuan con los partials de la vista. Los mismos se sub-dividen por funcionalidad.
* directives: contiene los scripts que nos permiten añadir comportamientos adicionales a elementos HTML, o la reutilización de los mismos.
* services: contiene los scripts que interactuan con los servicios REST, del back-end. Funciona como un intermediario entre el cliente y el servidor.

`lib`: Scripts reutilizables con funcionalidades particulares. Solo será necesario colocar código bajo este directorio en casos muy particulares.

`partials`: "Trozos" de código HTML, separados por funcionalidad. Los mismos serán insertados en la vista principal (views/index.php), gracias a la propiedad de angular *ng-view*

___

## Instalación completa

La instalación se basa en los siguientes tutoriales:

URL: http://tecadmin.net/install-laravel-framework-on-ubuntu

URL: https://www.howtoforge.com/tutorial/how-to-install-postgresql-95-on-ubuntu-12_04-15_10

1. Instalar Ubuntu (14.04.4-desktop-amd64)
2. Instalar PHP (5.5.34)

  - `sudo apt-get install python-software-properties`

  ```
  Esto instala:

  python-pycurl_7.19.3-0ubuntu3_amd64.deb
  python-software-properties_0.92.37.7_all.deb
  ```

  - `sudo add-apt-repository ppa:ondrej/php5`

  - `sudo apt-get update`

  - `sudo apt-get install php5 php5-mcrypt php5-gd`

  ```
  Esto instala:

  libssl1.0.2_1.0.2g-1_amd64.deb
  liblua5.1-0_5.1.5-7.1_amd64.deb
  libmcrypt4_2.5.8-3.1_amd64.deb
  libonig2_5.9.1-1_amd64.deb
  libqdbm14_1.8.78-2_amd64.deb
  apt-listchanges_2.85.13+nmu1_all.deb
  libapr1_1.5.2-3_amd64.deb
  libnghttp2-14_1.8.0-1+_amd64.deb
  php5-common_5.5.34+dfsg-1+.deb
  php5-gd_5.5.34+dfsg-1+.deb
  php5-mcrypt_5.5.34+dfsg-1+.deb
  php5-json amd64 1.3.9-1+.deb
  php5-cli amd64 5.5.34+dfsg-1+.deb
  php5-readline amd64 5.5.34+dfsg-1+.deb
  libaprutil1-dbd-sqlite3 amd64 1.5.4-1+.deb
  libaprutil1-ldap amd64 1.5.4-1+.deb
  apache2-bin amd64 2.4.18-1+.deb
  apache2-utils amd64 2.4.18-1+.deb
  apache2-data all 2.4.18-1+.deb
  apache2 amd64 2.4.18-1+.deb
  libapache2-mod-php5 amd64 5.5.34+dfsg-1+.deb
  php5 all 5.5.34+dfsg-1+.deb
  ```

3. Instalar Apache2

  - `sudo apt-get install apache2 libapache2-mod-php5`

4. Instalar Composer (1.0.0)

  - `curl -sS https://getcomposer.org/installer | php`

  - `sudo mv composer.phar /usr/local/bin/composer`

  - `sudo chmod +x /usr/local/bin/composer`

5. Instalar PostgreSQL (9.5) y pgAdmin III

  - `sudo sh -c 'echo "deb http://apt.postgresql.org/pub/repos/apt/ `lsb_release -cs    `-pgdg main" >> /etc/apt/sources.list.d/pgdg.list'`

  - `wget -q https://www.postgresql.org/media/keys/ACCC4CF8.asc -O - | sudo apt-key add -`

	- `sudo apt-get update`

	- `sudo apt-get install libpq5 pgdg-keyring postgresql postgresql-9.5 postgresql-client-9.5 libjs-jquery libjs-underscore libwxbase3.0-0 libwxgtk3.0-0 pgadmin3 pgadmin3-data pgagent`

6. Configurar usuario PostgreSQL

  - `sudo -u postgres psql`

  - `ALTER ROLE postgres PASSWORD 'developer';`

  - `\q`

  - `exit`

7. Crear proyecto Hola Mundo

  - `mkdir workspace`

  - `cd workspace`

  - `composer create-project laravel/laravel holamundo --prefer-dist` (no me funciono poniendo la version 5.1.11)

  - `php artisan serve --port=8080`

  - `Ingresar a localhost:8080`

8. Instalar Atom (1.6.2)

  - `sudo add-apt-repository ppa:webupd8team/atom`

  - `sudo apt-get update`

  - `sudo apt-get install atom`

## Instalación

####Requisitos
* PHP v. 7.3
* NODE v14.17.1 (with npm 6.14.13)


Utiliza [Laravel-sail](https://laravel.com/docs/8.x/sail)

Configurar docker-compose.yml y el archivo .env (Ojo a los puertos). Recomendado indicar también estos valores para los 
puertos externos al entorno docker:

```
APP_PORT=8091
FORWARD_DB_PORT=3309
FORWARD_REDIS_PORT=6378
FORWARD_MEILISEARCH_PORT=
FORWARD_MAILHOG_PORT=1035
FORWARD_MAILHOG_DASHBOARD_PORT=
```

Alias para el comando sail (se puede incluir en _~/.bashrc_ o en _~/.bash_aliases_) para que quede de forma permanente.

```
alias sail='bash vendor/bin/sail'
```

####Levantar entorno Docker

```
cd carpeta_de_proyecto
sail up
```

La primera vez descargará las imágenes de Docker. Después levanta el entorno en: localhost:8091 (APP_PORT indicado en .env)

##Compilar Assets (SASS + JS)

```
npm install
npm run dev
```

#####Activar modo de escucha de cambios
```
npm run watch (con sail up funcionando)
```
#####Escuchar cambios y actualizar navegador automáticamente con BrowserSync
* Crear entrada en __/etc/hosts/__
```[IP container apache de Docker sail]   dominio.ejemplo```
* Indicar en las opciones de browsersync de: _.env_: 
  * proxy url: dominio.ejemplo. 
  * puerto (P.ej 3333)
* Configurar qué elementos queremos escuchar en el fichero: _webpack.mix.js_
* Lanzar con ```npm run watch```
* Navegar: http://localhost:3333

## Gestor de ficheros Excel

Utilizamos [Laravel Excel](https://docs.laravel-excel.com/3.1/getting-started/)

```
sail composer require maatwebsite/excel
```

## Librería de gestión de ZIP

Utilizamos [Laravel ZIP](https://github.com/zanysoft/laravel-zip). Para PHP 7.4, debemos utilizar la rama **Master**.

```
sail composer require zanysoft/laravel-zip:master
```

## File Manager

Utilizamos [Laravel File Manager](https://unisharp.github.io/laravel-filemanager/installation). Debemos instalar y configurar como indica en la guía.

```
 sail composer require unisharp/laravel-filemanager
 sail artisan vendor:publish --tag=lfm_config
 sail artisan vendor:publish --tag=lfm_public
 sail artisan storage:link
```

## Extracción de Textos a PDF

Utilizamos [Spatie Pdf to Text](https://github.com/spatie/pdf-to-text)

```
composer require spatie/pdf-to-text
```


#### Requisitos


Debemos tener instalada la librería: pdftotext. Para saber si está instalada en nuestro sistema:

```
which pdftotext
```

Para instalarla:

```
apt-get install poppler-utils
```

_Si utilizamos Laravel SAIL, debemos incluir la instalación en el DockerFile._

## Generar Dummy data
https://www.positronx.io/generate-test-data-with-laravel-factory-tinker/

Lista de providers
https://github.com/fzaninotto/Faker

```
sail php artisan tinker

(prompt tinker) User::factory()->count(10)->create()

// Si no encuentra la factoría, salir de tinker (CTRL+C) y ejecutar: 
sail composer dump-autoload
```

## Links utilizados:

* Crear autenticación de usuarios: https://www.positronx.io/laravel-custom-authentication-login-and-registration-tutorial/
* Crear Roles: https://cvallejo.medium.com/autenticaci%C3%B3n-y-manejo-de-roles-de-usuarios-en-laravel-7-50aa79fa1bed

---

* Crear CRUDS con VUE: https://www.positronx.io/create-laravel-vue-js-crud-single-page-application/

---

* Dummy data con Tinker y Faker: https://www.positronx.io/generate-test-data-with-laravel-factory-tinker/
* Providers para Faker: https://github.com/fzaninotto/Faker

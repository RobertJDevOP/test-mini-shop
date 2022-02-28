<p align="center">
  <img src="public/img/escuela.jpg" alt="Logo" width="500" height="200">

<h2 align="center">Single page application mini-shop</h2>

</p>



<!-- TABLE OF CONTENTS -->
## Tabla de contenido

* [Sobre el proyecto](#sobre-el-proyecto)
* [Construido con](#construido-con)
* [Prerequisitos](#prerequisitos)
* [Instalación](#instalación)




<!-- ABOUT THE PROJECT -->
## Sobre el proyecto

En este repositorio se encuentra el código fuente del proyecto correspondiente a un single page application
de una simulación de un ecommerce utilizando la pasarela de pagos PlacetoPay de Evertec

### Construido con
* [Laravel](https://laravel.com)
* [Bulma](https://bulma.io/)
* [VueJS 3](https://vuejs.org/)

### Prerequisitos

* [MySQL](https://www.mysql.com/)
* [PHP 8](https://www.php.net/)
* [Node.js 16](https://nodejs.org/es/)
* [Composer](https://getcomposer.org/)

### Instalación

1. Clonar el repositorio
```bash 
https://github.com/RobertJDevOP/test-mini-shop.git
```

2. Instalar dependencias del backend:
```bash
$ composer install
```
3. Generar archivo .env para configuración de las variables de entorno:
```bash
$ cp .env.example .env
```

4. Generar la llave de la aplicación:
```bash
$ php artisan key:generate
```

5. Migraciones y alimentación de la base de datos:
```bash
$ php artisan migrate --seed
```
6. Dependencias del frontend y construcción de assets:
```bash
$ npm install
$ npm run dev
```
- Despliegue:
```bash
$ php artisan serve
```
- Ahora puedes ver el despliegue en la url: http://localhost:8000/


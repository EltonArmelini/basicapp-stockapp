# Basic Stock APP con PHP

Breve descripción del proyecto y su propósito principal.

## Propósito

El propósito de este proyecto es crear una aplicación en la que los usuarios puedan buscar acciones y ver su precio actual en la bolsa de valores utilizando la API ms-finance. Este proyecto se desarrolló con el objetivo de practicar y aplicar conocimientos de PHP8, programación orientada a objetos (POO) y la conexión de APIs con PHP.

## Requisitos de Instalación

Para utilizar este proyecto, es necesario tener instalado:
- Motor de Base de Datos MySQL
- PHP8
- Composer

## Herramientas y Librerías

Para instalar y ejecutar el proyecto, es necesario utilizar la librería:
- vlucas/phpdotenv (manejo de variables de entorno) mediante Composer.

## Instalación

Pasos para instalar el proyecto:

1. Clonar el repositorio
2. Ejecutar `composer install` para inicializarlo
3. Ejecutar el archivo `schema.sql` para crear la base de datos y la tabla necesarias.
4. Crear un archivo `.env` con los datos de configuración de la base de datos (DB_HOST, DB_NAME, DB_TYPE, DB_CHARSET, DB_USER, DB_PASS) y ajustarlos según sea necesario.

## Uso

Para utilizar el proyecto:

1. Identifica el ticker de la acción que deseas buscar (por ejemplo, AMAZON = AMZN).
2. Haz clic en 'Add Stock' en la interfaz de la aplicación. Esto realizará una petición a la API para obtener el precio actual de la acción especificada.


## Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo [LICENSE.md](LICENSE.md) para más detalles.

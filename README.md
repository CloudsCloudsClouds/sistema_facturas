Hola!

Este es EL proyecto de sistema de facturacion.

## Instalar el proyecto

Estos son los pasos para hacer funcionar el proyecto:

- `git clone <link del repositorio>`
- Entra al proyecto
- Instala las dependencias con `composer install`
- Configura el archivo .env para que represente tu entorno
    - Fijate en especial los campos de base de datos (inician con DB)
- Verifica la instalacion con `php artisan serve`
    - Lo mas probable es que a este momento no funcione, proba `php artisan up`

Este proyecto usa filament! Es para hacer datos y todo mas rapido.

##### Crear un nuevo usuario
- Crea un usuario de filament. Has esto usando `php artisan make:filament-user`
- Corre `php artisan serve`
- Ve al link `localhost:8000/admin`

**El sistema ya tiene un usuario incluido. EMAIL:`admin@unifranz.com` / CONTRASEÑA:`1234`**

Crear un usuario es opcional

---

Ingresa el usuario que usaras en el sistema. 

El sistema (deberia) funcionar. 

---
## ¡Sobre la base de datos!
Ya hay algunos factories and seeders puestos en marcha para crear algunos datos.
Debes correr:
    
`php artisan db:seed`

Y creara automaticamente varios datos.
Puedes borrarlo todo corriento.

`php artisan migrate:fresh`

Modificacion de esteban

## ¡Comenta cualquier cosa que no funcione!

- ¡Lee el error! Tu puedes resolver el 99% de los problemas si lees el error
    - Identifica si el error es un problema de tu instalacion de php/composer, o si es un problema del proyecto
    - Si es un problema de tu instalacion, corregi. Si es un problema del proyecto, crea un 'Issue' en la pestaña al lado de 'code'
- ¡Busca en el internet!
- Proba re-instalando el proyecto. Segui de nuevo las instrucciones de instalacion
    - A veces suceden cambios en las migraciones y base de datos, y deberas volver a hacer las migraciones
        - Es buena practica hacer migraciones frescas a la base de datos apenas abres el proyecto para trabajar.
        - `php artisan migrate:fresh`
        - `php artisan db:seed`
        - Deberia ser suficiente para poner la base de datos al dia con el resto del proyecto
    - A veces suceden conflictos porque estas trabajando en un archivo que acaba de cambiar
        - Escribeme, toma unos pasos resolverlo pero puedo ayudarte
        - [Link relacionado](https://docs.github.com/es/get-started/exploring-projects-on-github/contributing-to-a-project)


Modificacion de Karen.

# Proyecto usando enrutamiento Symfony

## Authors

-   [@AVillaraux](https://github.com/AVillaraux)

## Contribuidores

-   Jesús Misael Betanzos Betanzos ([@jesusmisael](https://github.com/jesusmisael))

## Guía de instalación

Sigue estos pasos para configurar el proyecto en tu entorno local:

1. **Clonar el repositorio**

Para comenzar a trabajar con este proyecto, lo primero que debes hacer es clonar el repositorio de GitHub a tu máquina local.

Clona el repositorio desde GitHub ejecutando el siguiente comando en tu terminal:

```bash
  git clone https://github.com/AVillaraux/rutas-symfony.git
```

Esto descargará el proyecto en tu máquina local.

2. **Acceder al directorio del proyecto**
   Una vez que hayas clonado el repositorio, necesitarás acceder al directorio del proyecto recién creado. Para ello, utiliza el comando cd seguido del nombre del directorio:

```bash
  cd rutas-symfony
```

En Windows, puedes abrir el Explorador de Archivos y navegar hasta la carpeta donde clonaste el repositorio. Luego, mantén presionada la tecla `Shift` y haz clic derecho en un espacio vacío dentro de la carpeta. Selecciona "Abrir ventana de PowerShell aquí" o "Abrir ventana de comando aquí" para abrir una ventana de línea de comandos en la ubicación del proyecto.

3. **Instalar las dependencias del proyecto utilizando Composer**

Asegúrate de tener instalado [Composer](https://getcomposer.org/), el gestor de dependencias para PHP. Si no lo tienes, puedes descargarlo desde su [sitio oficial](https://getcomposer.org/).

El proyecto está configurado por defecto para usar PHP 8.3. Sin embargo, si prefieres utilizar PHP 8.2 o PHP 8.1, puedes hacerlo fácilmente.
Solo necesitas eliminar o renombrar el archivo composer.json original, y luego renombrar el archivo composer-php-8.2.json o composer-php-8.1.json a composer.json.

Puedes hacerlo ejecutando el siguiente comando en la terminal:

```bash
  composer install
```

o, si ya tienes las dependencias instaladas y deseas actualizarlas:

```bash
    composer update
```

Al ejecutar este comando, tu proyecto descargará e instalará automáticamente todas las herramientas y librerías necesarias para funcionar, como el framework Symfony. Esta información está detallada en un archivo llamado composer.json. Además, se creará un nuevo archivo llamado .env.example, que te servirá como plantilla para configurar las variables de entorno necesarias para tu aplicación.

Este archivo te servirá como punto de partida para personalizar la configuración de tu proyecto según tus requerimientos, como las contraseñas de tu base de datos.

4. **Configuración del entorno**

Configura el entorno necesario para tu proyecto utilizando uno de los siguientes métodos:

-   **Entorno de desarrollo:**
    Renombra el archivo .env.example a .env.development, o ejecuta este comando para copiar su contenido a .env.development:

```bash
composer run env
```

-   **Entorno de producción:** Renombra el archivo .env.example a .env, o utiliza este comando para copiar su contenido a .env:

```bash
composer run env:production
```

Asegúrate de configurar correctamente las variables de entorno, como la conexión a la base de datos y las credenciales de correo electrónico.

5. **Ejecutar el proyecto**

Sigue estos pasos para ejecutar el proyecto en tu entorno local:

-   Usa un servidor web local (como Apache) o un entorno de desarrollo como XAMPP.

-   Verifica que tienes PHP 8.2 instalado ejecutando:

```bash
php -v
```

-   Abre tu navegador y accede al proyecto en http://localhost/tu_proyecto/.

Aquí te dejo una versión mejorada del texto para el README de tu proyecto en Git:

## Estructura de carpetas

La estructura de carpetas está diseñada para mantener el código organizado, modular y fácil de mantener. Cada carpeta tiene un propósito específico y alberga componentes esenciales para el correcto funcionamiento de la aplicación.

### Carpetas y archivos

- **app**:
    - **config**:
        - `App.php`: Configuración principal de la aplicación Symfony.
        - `DataBase.php`: Configuración de la base de datos.
        - `routing.yml`: Configuración de enrutamiento.
    - **Controller**:
        - `IndexController.php`: Controlador para la página de inicio.
    - **Helper**:
        - `General.php`: Funciones de ayuda generales.
    - **Integra**:
        - `Framework.php`: Integración del framework Symfony.
    - **Model**:
        - `PruebaModel.php`: Modelo de datos para la prueba.
- **resource/views**:
    - **ejemplo**:
        - `get.php`: Plantilla para la acción "GET".
        - `post.php`: Plantilla para la acción "POST".
        - `index.php`: Plantilla para la página principal.
- `.env`: Archivo de entorno con variables de configuración.
- `.gitignore`: Archivo para ignorar archivos y carpetas en Git.
- `.htaccess`: Configuración de Apache.
- `composer.json`: Archivo de configuración de dependencias de Composer.
- `composer.lock`: Archivo de bloqueo de versiones de dependencias de Composer.
- `index.php`: Punto de entrada de la aplicación.
- `README.md`: Documentación del proyecto.

### Explicación de las carpetas y archivos

- **app**: Contiene el código principal de la aplicación, como la configuración, controladores, modelos y recursos.
    - **config**: Archivos de configuración, como base de datos y enrutamiento.
    - **Controller**: Controladores que manejan las solicitudes HTTP y devuelven las respuestas.
    - **Helper**: Funciones auxiliares reutilizables en toda la aplicación.
    - **Integra**: Archivos de integración con el framework Symfony.
    - **Model**: Clases que representan la estructura y comportamiento de los datos.
- **resource/views**: Plantillas HTML que generan la interfaz de usuario.
- **.env**: Variables de configuración del entorno.
- **.gitignore**: Define qué archivos y carpetas debe ignorar Git.
- **.htaccess**: Reglas de configuración para el servidor Apache.
- **composer.json**: Especifica las dependencias del proyecto para Composer.
- **composer.lock**: Bloquea las versiones exactas de las dependencias instaladas.
- **index.php**: Archivo principal que sirve como punto de entrada a la aplicación.

## Configuración de enrutamiento

1. Abre el archivo `app/config/routes.yaml`.
2. Este archivo YAML define las rutas de tu aplicación. Aquí se incluyen ejemplos predefinidos.

```yaml
inicio:
    path: /
    controller: App\Controller\IndexController::index
    methods: GET

ejemplo_GET:
    path: /ejemplo/{variable1}/{variable2}
    controller: App\Controller\IndexController::ejemploGET
    methods: GET

ejemplo_POST:
    path: /ejemplo/
    controller: App\Controller\IndexController::ejemploPOST
    methods: POST
```

### Explicación de las rutas

- **Ruta de inicio**:
    - **URL**: `/`
    - **Controlador**: `App\Controller\IndexController::index`
    - **Método HTTP**: `GET`
    - Esta ruta carga la página principal cuando se navega a la raíz del sitio web.

- **Ruta ejemplo_GET**:
    - **URL**: `/ejemplo/{variable1}/{variable2}`
    - **Controlador**: `App\Controller\IndexController::ejemploGET`
    - **Método HTTP**: `GET`
    - Esta ruta acepta dos variables en la URL (`variable1` y `variable2`) y las pasa al controlador.

- **Ruta ejemplo_POST**:
    - **URL**: `/ejemplo/`
    - **Controlador**: `App\Controller\IndexController::ejemploPOST`
    - **Método HTTP**: `POST`
    - Esta ruta gestiona solicitudes POST, como el envío de formularios, enviando los datos al controlador.

### Explicación de las directivas

- `inicio`: Define el nombre de la ruta.
- `path`: Especifica la URL asociada a la ruta.
- `controller`: Determina el controlador y método a invocar.
- `methods`: Define los métodos HTTP permitidos para la ruta (GET, POST, etc.).

---

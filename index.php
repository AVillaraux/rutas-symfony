<?php

use App\config\App;
use App\Integra\Framework;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;

require_once './vendor/autoload.php';
try {
    // Determina el entorno (puedes usar una variable de entorno o un valor de configuración)
    // si la variable de entorno APP_ENV no está definida, se asume que la aplicación está en modo de desarrollo.
    $environment = getenv('APP_ENV') ?: 'development';

    if (getenv('APP_ENV') === 'production') {
        // Código específico para el entorno de producción
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        error_reporting(0); // Desactivar la visualización de errores
    } else {
        // Carga el archivo .env correspondiente
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__, ".env.development");
        // Código específico para otros entornos (desarrollo, staging, etc.)
        error_reporting(E_ALL); // Mostrar todos los errores
        // error_reporting(E_ERROR | E_WARNING | E_PARSE);//muestra solo errores warning o errores de sintaxis
        //error_reporting(E_ERROR | E_PARSE);//muestra todos los errores
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
    }


    $dotenv->load();

    date_default_timezone_set('America/Mexico_City');

    session_start();

    App::Config();
    define('DIR_ROOT', __DIR__);
    define('VIEW_PATH', __DIR__ . '/resource/views/');

    $request = Request::createFromGlobals();

    $options = array(
        'cache_dir' => 'cache/', //directorio donde serán cacheadas las rutas
    );
    $requestContext = new RequestContext();
    $requestContext->fromRequest(Request::createFromGlobals());
    $fileLocator = new FileLocator(array('app/config/')); // nos ubicamos en la carpeta app/config
    $loader = new YamlFileLoader($fileLocator); //creamos el loader
    $router = new Router($loader, 'routing.yml', $options, $requestContext);
    $routes = $router->getRouteCollection();
    $matcher = new UrlMatcher($routes, $requestContext);

    $controllerResolver = new ControllerResolver();
    $argumentResolver = new ArgumentResolver();

    $framework = new Framework($matcher, $controllerResolver, $argumentResolver);
    $response = $framework->handle($request);

    $response->send();

} catch (Exception $e) {
    echo 'Error cargando el archivo de entorno: ' . $e->getMessage();
}
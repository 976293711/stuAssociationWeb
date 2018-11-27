<?php
require_once '../vendor/autoload.php';
use Phalcon\Di\FactoryDefault;
date_default_timezone_set('PRC');
error_reporting(E_ALL);

if (isset($_SERVER['HTTP_ORIGIN'])) {
    $origin = $_SERVER['HTTP_ORIGIN'];
    header("Access-Control-Allow-Origin: $origin");
    header("Access-Control-Allow-Headers: origin, x-requested-with, content-type, X-XSRF-TOKEN");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: PUT, GET, POST, OPTIONS");
}

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Handle routes
     */
    include APP_PATH . '/config/router.php';

    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Handle the request
     */
    $app = new \Phalcon\Mvc\Micro($di);
    $di['app'] = $app;
    $provider = new Snowair\Debugbar\ServiceProvider('../app/config/debugbar.php');

    $provider->register();//注册
    $provider->boot(); //启动
    include APP_PATH . '/app.php';
    $app->handle();
    //echo str_replace(["\n","\r","\t"], '', $application->handle()->getContent());

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}

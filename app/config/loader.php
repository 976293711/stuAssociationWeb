<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
)->register();

$loader->registerNamespaces([
    'Controllers' => APP_PATH . '/controllers/',
    'Models'      => APP_PATH . '/models/',
    'Services'    => APP_PATH . '/services/',
    'Traits'      => APP_PATH . '/traits/',
    'Helper'      => APP_PATH . '/Helper/',
    'App\Utils'   => APP_PATH . '/libs/Utils/',
    'Services\Helper' => APP_PATH . '/services/Helper/',
    'Tasks'       => APP_PATH . '/tasks/',
]);
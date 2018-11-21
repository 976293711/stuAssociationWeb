<?php
use Phalcon\Mvc\Micro\Collection as MicroCollection;

$app->get('/', function () {
    echo '<h1>it work </h1>';
});
$orderQuery = new MicroCollection;

$orderQuery->setHandler("\Controllers\IndexController", true);
$orderQuery->setPrefix("/index");
$orderQuery->get("/test", "test");
$app->mount($orderQuery);

/**
 * Not found handler
 */
$app->notFound(function () use($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo "<h1>404 Not found</h1>";
});
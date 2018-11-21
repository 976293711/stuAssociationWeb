<?php

use Phalcon\Mvc\Micro;

$app = new Micro();

$app->get('/', function () {
    echo "<h1>Welcome wilson my friend !</h1>";
});

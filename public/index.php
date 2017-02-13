<?php

$root = realpath(dirname(__DIR__));

require $root . '/vendor/autoload.php';

use App\Application;
use App\Helper\RootPath;

$app = new Application(new RootPath($root));

$app->run();


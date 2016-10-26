<?php

use Phalcon\Loader;

$loader = new Loader();

$loader->registerDirs([
    PCL_APP_PATH . 'controllers/',
    PCL_APP_PATH . 'models/',
    PCL_APP_PATH . 'routes/',
])->register();
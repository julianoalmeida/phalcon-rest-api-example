<?php

define('PCL_BASE_PATH', __DIR__);
define('PCL_APP_PATH', __DIR__."/../app/");

try {

    include_once PCL_APP_PATH.'config/Loader.php';

    $dependencyInjection = new \Phalcon\Di\FactoryDefault();
    $dependencyInjection->set('db', function (){
        return new Phalcon\Db\Adapter\Pdo\Mysql([
            'adapter'  => 'Mysql',
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => 'root',
            'dbname'   => 'academia_s2it_phalcon'
        ]);
    });

    $app = new \Phalcon\Mvc\Micro;
    $app->setDI($dependencyInjection);

    $routes = new ApiRoutes($app);

    $app->handle();

} catch (Exception $exception) {
    die($exception->getMessage());
}
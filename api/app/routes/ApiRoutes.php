<?php

class ApiRoutes
{

    public function __construct(\Phalcon\Mvc\Micro $app)
    {
        $this->base($app);
        $this->products($app);
    }

    public function base(\Phalcon\Mvc\Micro $app)
    {
        $app->get('/', function () use ($app){
            $app->response->setStatusCode('200', 'Okie Dokie')->sendHeaders();
            return $app->response->setJsonContent('Welcome to ours API.');
        });

        $app->notFound(function () use ($app){
            $app->response->setStatusCode('404', 'Not Found')->sendHeaders();
            return $app->response->setJsonContent('This is crazy, but this page was not found');
        });
    }

    public function products(\Phalcon\Mvc\Micro $app)
    {
        $app->get('/v1/products', function () use ($app){
            $controller = new ProductsController();
            return $controller->index($app);
        });

        $app->get('/v1/products/{id:[0-9]+}', function ($id) use ($app){
            $controller = new ProductsController();
            return $controller->show($app, $id);
        });

        $app->post('/v1/products', function () use ($app){
            $controller = new ProductsController();
            return $controller->store($app);
        });

        $app->put('/v1/products/{id:[0-9]+}', function ($id) use ($app){
            $controller = new ProductsController();
            return $controller->update($app, $id);
        });

        $app->delete('/v1/products/{id:[0-9]+}', function ($id) use ($app){
            $controller = new ProductsController();
            return $controller->destroy($app, $id);
        });
    }

}
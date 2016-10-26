<?php

class ProductsController extends \Phalcon\Mvc\Controller
{

    public function index(\Phalcon\Mvc\Micro $app)
    {
        $app->response->setStatusCode('200', "Good to know");
        return $app->response->setJsonContent(Products::find()->toArray());
    }

    public function show(\Phalcon\Mvc\Micro $app, $id)
    {
        $app->response->setStatusCode('200', "Good to know");
        return $app->response->setJsonContent(Products::find($id)->toArray());
    }

    public function store(\Phalcon\Mvc\Micro $app)
    {

        $data = $app->request->get();
        $at = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

        $validation = $this->validate($data);

        if (! $validation->valid()) {
            $product = new Products();
            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->quantity = $data['quantity'];
            $product->description = $data['description'];
            $product->created_at = $at->format('Y-m-d H:i:s');
            $product->updated_at = $at->format('Y-m-d H:i:s');
            $product->save();

            $app->response->setStatusCode('200', "Good to know");
            return $app->response->setJsonContent([
                'product' => [
                    'id' => $product->id
                ]
            ]);
        }

        $app->response->setStatusCode('400', "Ooops, nigga you are wrong!");
        return $app->response->setJsonContent($validation->current()->getMessage());
    }

    public function update($app, $id)
    {
        $at = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

        $data = $app->request->get();
        $data['updated_at'] = $at->format('Y-m-d H:i:s');

        Products::findFirst($id)->update($data, ['name', 'price', 'description', 'quantity', 'updated_at']);

        $app->response->setStatusCode('200', "Good to know");
        return $app->response->setJsonContent("The product $id was successfully changed.");
    }

    public function destroy($app, $id)
    {
        Products::findFirst($id)->delete();
        $app->response->setStatusCode('200', "Good to know");
        return $app->response->setJsonContent("The product $id was deleted.");
    }

    private function validate($data)
    {
        $validation = new \Phalcon\Validation();
        $validation->add(
            "name",
            new \Phalcon\Validation\Validator\PresenceOf(
                [
                    "message" => "The name is required",
                ]
            )
        );

        $validation->add(
            "price",
            new \Phalcon\Validation\Validator\PresenceOf(
                [
                    "message" => "The price is required",
                ]
            )
        );

        $validation->add(
            "quantity",
            new \Phalcon\Validation\Validator\PresenceOf(
                [
                    "message" => "The quantity is required",
                ]
            )
        );

        return $validation->validate($data);

    }

}
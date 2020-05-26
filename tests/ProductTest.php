<?php

class ProductTest extends TestCase
{
    public function testCreateProduct()
    {
        $user = App\User::first();
        $token = Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);

        $data = factory(\App\Models\Product::class)->make()->toArray();
        
        $this->post('/api/product?token='.$token, $data);
        $this->seeStatusCode(201);
        $this->seeJson([
            'descricao' => $data['descricao'],
         ]);
    }

    public function testListProduct()
    {
        $user = App\User::first();
        $token = Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);

        $data = \App\Models\Product::first();

        $this->get('/api/product?token='.$token);
        $this->seeStatusCode(200);
        $this->seeJson([
            'descricao' => $data->descricao,
        ]);
    }

    public function testShowProduct()
    {
        $user = App\User::first();
        $token = Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);

        $product = \App\Models\Product::first();
        $this->get('/api/product/'.$product->id.'?token='.$token);
        $this->seeStatusCode(200);
        $this->seeJsonContains([
            'descricao' => $product->descricao,
        ]);
    }

    public function testUpdateProduct()
    {
        $user = App\User::first();
        $token = Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);

        $product = \App\Models\Product::first();
        $descricao = $product->descricao;
        $product->descricao = null;
        $this->put('/api/product/'.$product->id.'?token='.$token, $product->toArray());
        $this->seeStatusCode(500);

        $descricao = str_replace("-Updated", "", $descricao);

        $product->descricao = $descricao.'-Updated';
        $this->put('/api/product/'.$product->id.'?token='.$token, $product->toArray());
        $this->seeStatusCode(200);
        $this->seeJson([
            'descricao' => $product->descricao,
         ]);
    }
}
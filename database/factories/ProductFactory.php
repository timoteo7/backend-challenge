<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'codigo' => $faker->word,
        'descricao' => $faker->text,
        'unidade' => $faker->word,
        'valor' => $faker->randomFloat(),
        'sku' => $faker->word,
        'codFiscal' => $faker->word,
        'NCM' => $faker->word,
        'pesoLiquido' => $faker->randomNumber(),
        'tamanho' => $faker->word,
        'material' => $faker->word,
        'categoria' => $faker->word,
        'caracteristica' => $faker->text,
        'fabricante' => $faker->word,
        'urlImagem' => $faker->word,
        'estoqueMinimo' => $faker->randomNumber(),
    ];
});

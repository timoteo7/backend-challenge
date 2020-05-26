<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Variation::class, function (Faker $faker, $attributes) {
    if (array_key_exists('product_id', $attributes))
        $product=App\Models\Product::find($attributes['product_id']);
    else
        $product=App\Models\Product::inRandomOrder()->first();
    if(is_null($product)) $product=factory(App\Models\Product::class)->create();

    return [
        'cor' => $faker->word,
        'product_id' => $product->id,
    ];
});

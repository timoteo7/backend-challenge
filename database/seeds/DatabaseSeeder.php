<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        factory(App\User::class, 4)->create();
        factory(App\Models\Product::class, 10)->create()
            ->each(function ($product) {
                factory(App\Models\Variation::class, rand(0, 3))->create(['product_id' => $product['id'] ]);
            });

		App\User::firstOrCreate(['name' => 'Teste','email' => 'teste@teste.com'], ['password' => bcrypt('12345678'), 'updated_at' => date('Y-m-d H:i:s'), ]);
    }
}

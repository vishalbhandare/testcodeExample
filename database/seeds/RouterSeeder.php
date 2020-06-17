<?php

use Illuminate\Database\Seeder;

class RouterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($limit)
    {
        factory(App\Router::class, intval($limit))->create()->each(function ($router) {
            $router->save(factory(App\Router::class)->make()->toArray());
        });
    }
}

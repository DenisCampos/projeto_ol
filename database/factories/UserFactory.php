<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    $pais = App\Models\Pais::pluck('id')->toArray();
    $estado = App\Models\Estado::pluck('id')->toArray();
    $cidade = App\Models\Cidade::pluck('id')->toArray();

    return [
        'name' => $faker->name,
        'email' => 'admin@admin.com',
        'foto' => 'public/perfils/user1.png',
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'tipo' => 1
    ];
});

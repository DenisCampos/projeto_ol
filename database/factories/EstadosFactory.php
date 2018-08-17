<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Estado::class, function (Faker $faker) {
    $pais = App\Models\Pais::pluck('id')->toArray();
    return [
        'descricao' => $faker->state,
        'pais_id' => $faker->randomElement($pais),
    ];
});

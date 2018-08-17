<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Cidade::class, function (Faker $faker) {
    $estado = App\Models\Estado::pluck('id')->toArray();
    return [
        'descricao' => $faker->state,
        'estado_id' => $faker->randomElement($estado),
    ];
});

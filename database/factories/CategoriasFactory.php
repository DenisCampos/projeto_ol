<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Categoria::class, function (Faker $faker) {
    return [
        'descricao' => $faker->jobTitle,
    ];
});

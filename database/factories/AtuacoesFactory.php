<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Atuacao::class, function (Faker $faker) {
    return [
        'descricao' => $faker->jobTitle,
    ];
});

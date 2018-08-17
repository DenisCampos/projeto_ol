<?php

use Faker\Generator as Faker;

$factory->define(App\Models\SubAtuacao::class, function (Faker $faker) {
    $atuacao = App\Models\Atuacao::pluck('id')->toArray();
    return [
        'descricao' => $faker->jobTitle,
        'atuacao_id' => $faker->randomElement($atuacao),
    ];
});

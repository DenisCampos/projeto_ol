<?php

use Illuminate\Database\Seeder;

class SituacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Situacao::class, 1)->create([
            'descricao' => 'Criado'
        ]);
        factory(\App\Models\Situacao::class, 1)->create([
            'descricao' => 'Enviado'
        ]);
        factory(\App\Models\Situacao::class, 1)->create([
            'descricao' => 'Aceito'
        ]);
        factory(\App\Models\Situacao::class, 1)->create([
            'descricao' => 'Negado'
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class AtuacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Atuacao::class, 10)->create();
    }
}

<?php

use Illuminate\Database\Seeder;

class SubAtuacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\SubAtuacao::class, 50)->create();
    }
}

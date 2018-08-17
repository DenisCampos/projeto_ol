<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Statu::class, 1)->create([
            'descricao' => 'Despublicado'
        ]);
        factory(\App\Models\Statu::class, 1)->create([
            'descricao' => 'Publicado'
        ]);
    }
}

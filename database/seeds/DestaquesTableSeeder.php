<?php

use Illuminate\Database\Seeder;

class DestaquesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Destaque::class, 1)->create([
            'descricao' => 'Normal'
        ]);

        factory(\App\Models\Destaque::class, 1)->create([
            'descricao' => 'Destaque'
        ]);
    }
}

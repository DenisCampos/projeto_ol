<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaisesTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(CidadesTableSeeder::class);
        $this->call(CategoriasTableSeeder::class);
        $this->call(AtuacoesTableSeeder::class);
        $this->call(SubAtuacoesTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(SituacoesTableSeeder::class);
        $this->call(DestaquesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}

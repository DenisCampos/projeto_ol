<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\UsersRepository::class, \App\Repositories\UsersRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserInteressesRepository::class, \App\Repositories\UserInteressesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CategoriasRepository::class, \App\Repositories\CategoriasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProfissionaisRepository::class, \App\Repositories\ProfissionaisRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProfissionalAtuacoesRepository::class, \App\Repositories\ProfissionalAtuacoesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EmpresasRepository::class, \App\Repositories\EmpresasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EmpresaAtuacoesRepository::class, \App\Repositories\EmpresaAtuacoesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PaisesRepository::class, \App\Repositories\PaisesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EstadosRepository::class, \App\Repositories\EstadosRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CidadesRepository::class, \App\Repositories\CidadesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AtuacoesRepository::class, \App\Repositories\AtuacoesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SubAtuacoesRepository::class, \App\Repositories\SubAtuacoesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProfissionalSubAtuacoesRepository::class, \App\Repositories\ProfissionalSubAtuacoesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EmpresaSubAtuacoesRepository::class, \App\Repositories\EmpresaSubAtuacoesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PareceresRepository::class, \App\Repositories\PareceresRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EventosRepository::class, \App\Repositories\EventosRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EventoCategoriasRepository::class, \App\Repositories\EventoCategoriasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CursosRepository::class, \App\Repositories\CursosRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CursoCategoriasRepository::class, \App\Repositories\CursoCategoriasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PostsRepository::class, \App\Repositories\PostsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PostCategoriasRepository::class, \App\Repositories\PostCategoriasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StatusRepository::class, \App\Repositories\StatusRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SituacoesRepository::class, \App\Repositories\SituacoesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DestaquesRepository::class, \App\Repositories\DestaquesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ComentariosRepository::class, \App\Repositories\ComentariosRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BannersPrincipaisRepository::class, \App\Repositories\BannersPrincipaisRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProfissionalBannersRepository::class, \App\Repositories\ProfissionalBannersRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EmpresaBannersRepository::class, \App\Repositories\EmpresaBannersRepositoryEloquent::class);

    }
}

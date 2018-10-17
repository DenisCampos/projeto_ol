<?php

use Spatie\Sitemap\SitemapGenerator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('auth/login');
});*/


Auth::routes();

Route::get('/', 'SiteController@index')->name('index');
//fale conosto
Route::get('/faleconosco', 'SiteController@faleconosco')->name('faleconosco');
Route::post('/faleconoscoenviarmail', 'SiteController@faleconoscoenviarmail')->name('mails.faleconosco');
Route::get('/quemsomos', 'SiteController@quemsomos')->name('quemsomos');
Route::get('/termosprivacidade', 'SiteController@termosprivacidade')->name('termosprivacidade');

//eventos
Route::get('/eventos/posts/{categoria}', 'SiteController@eventosposts')->name('eventos.posts');
Route::get('/eventos/post/{evento}', 'SiteController@eventospost')->name('eventos.post');
//cursos
Route::get('/cursos/posts/{categoria}', 'SiteController@cursosposts')->name('cursos.posts');
Route::get('/cursos/posts/voce/{categoria}', 'SiteController@cursosvcposts')->name('cursos.vcposts');
Route::get('/cursos/posts/profissional/{categoria}', 'SiteController@cursosprofposts')->name('cursos.profposts');
Route::get('/cursos/posts/empresa/{categoria}', 'SiteController@cursosempposts')->name('cursos.empposts');
Route::get('/cursos/post/{curso}', 'SiteController@cursospost')->name('cursos.post');
//blog
Route::get('/blog/posts/{categoria}', 'SiteController@blogposts')->name('blog.posts');
Route::get('/blog/post/{post}', 'SiteController@blogpost')->name('blog.post');
//profissionais
Route::get('/profissionais/posts/{atuacoes}', 'SiteController@profposts')->name('profissionais.posts');
Route::get('/profissionais/posts/{atuacoes}/{subatuacoes}', 'SiteController@subprofposts')->name('profissionais.subposts');
Route::get('/profissionais/post/{profissional}', 'SiteController@profpost')->name('profissionais.post');
//empresas
Route::get('/empresas/posts/{atuacoes}', 'SiteController@empposts')->name('empresas.posts');
Route::get('/empresas/posts/{atuacoes}/{subatuacoes}', 'SiteController@subempposts')->name('empresas.subposts');
Route::get('/empresas/post/{empresa}', 'SiteController@emppost')->name('empresas.post');

Route::group(['middleware'=>'auth'], function () {
   
    //estados
    Route::post('/estados/pegaestados', 'EstadosController@pegaestados')->name('estados.pegaestados');

    //cidades
    Route::post('/cidades/pegacidades', 'CidadesController@pegacidades')->name('cidades.pegacidades');

    //usuario
    Route::get('/home', 'HomeController@home')->name('home');
    Route::get('/edit', 'HomeController@edit')->name('edit');
    Route::get('/password', 'HomeController@password')->name('password');
    Route::put('/passwordupdate', 'HomeController@passwordupdate')->name('passwordupdate');
    Route::put('/update', 'HomeController@update')->name('update');
    Route::get('/avisos', 'HomeController@avisos')->name('avisos');

    //usuario interesses
    Route::get('/userinteresses', 'UserInteressesController@index')->name('userinteresses.index');
    Route::post('/userinteresses/store', 'UserInteressesController@store')->name('userinteresses.store');
    Route::post('/userinteresses/destroy', 'UserInteressesController@destroy')->name('userinteresses.destroy');
    Route::get('/interesses', 'SiteController@interesses')->name('userinteresses.interesses');

    
    //usuario perfil profissional
    Route::get('/profissionais', 'ProfissionaisController@index')->name('profissionais.index');
    Route::get('/profissionais/novo', 'ProfissionaisController@create')->name('profissionais.create');
    Route::post('/profissionais/store', 'ProfissionaisController@store')->name('profissionais.store');
    Route::put('/profissionais/update/{profissional}', 'ProfissionaisController@update')->name('profissionais.update');
    Route::get('/profissionais/edit/{profissional}', 'ProfissionaisController@edit')->name('profissionais.edit');
    Route::get('/profissionais/show/{profissional}', 'ProfissionaisController@show')->name('profissionais.show');
    Route::get('/profissionais/enviar/{profissional}', 'ProfissionaisController@enviar')->name('profissionais.enviar');
    Route::get('/profissionais/destroy/{profissional}', 'ProfissionaisController@destroy')->name('profissionais.destroy');

    //usuario perfil profissional atuacoes
    Route::get('/profissionalatuacoes/{profissional}', 'ProfissionalAtuacoesController@index')->name('profissionalatuacoes.index');
    Route::post('/profissionalatuacoes/store', 'ProfissionalAtuacoesController@store')->name('profissionalatuacoes.store');
    Route::post('/profissionalatuacoes/destroy', 'ProfissionalAtuacoesController@destroy')->name('profissionalatuacoes.destroy');

    //usuario perfil profissional sub atuacoes
    Route::get('/profissionalsubatuacoes/{profissional}/{atuacao}', 'ProfissionalSubAtuacoesController@index')->name('profissionalsubatuacoes.index');
    Route::post('/profissionalsubatuacoes/store', 'ProfissionalSubAtuacoesController@store')->name('profissionalsubatuacoes.store');
    Route::post('/profissionalsubatuacoes/destroy', 'ProfissionalSubAtuacoesController@destroy')->name('profissionalsubatuacoes.destroy');

    //usuario profissional banner
    Route::get('/profissionais/{profissional}/banner', 'ProfissionalBannersController@index')->name('profissionalbanners.index');
    Route::get('/profissionais/{profissional}/banner/novo', 'ProfissionalBannersController@create')->name('profissionalbanners.create');
    Route::post('/profissionais/{profissional}/banner/store', 'ProfissionalBannersController@store')->name('profissionalbanners.store');
    Route::put('/profissionais/{profissional}/banner/update/{banner}', 'ProfissionalBannersController@update')->name('profissionalbanners.update');
    Route::get('/profissionais/{profissional}/banner/edit/{banner}', 'ProfissionalBannersController@edit')->name('profissionalbanners.edit');
    Route::get('/profissionais/{profissional}/banner/show/{banner}', 'ProfissionalBannersController@show')->name('profissionalbanners.show');
    Route::get('/profissionais/{profissional}/banner/enviar/{banner}', 'ProfissionalBannersController@enviar')->name('profissionalbanners.enviar');
    Route::get('/profissionais/{profissional}/banner/destroy/{banner}', 'ProfissionalBannersController@destroy')->name('profissionalbanners.destroy');

    //usuario perfil empresa
    Route::get('/empresas', 'EmpresasController@index')->name('empresas.index');
    Route::get('/empresas/novo', 'EmpresasController@create')->name('empresas.create');
    Route::post('/empresas/store', 'EmpresasController@store')->name('empresas.store');
    Route::put('/empresas/update/{empresa}', 'EmpresasController@update')->name('empresas.update');
    Route::get('/empresas/edit/{empresa}', 'EmpresasController@edit')->name('empresas.edit');
    Route::get('/empresas/show/{empresa}', 'EmpresasController@show')->name('empresas.show');
    Route::get('/empresas/enviar/{empresa}', 'EmpresasController@enviar')->name('empresas.enviar');
    Route::get('/empresas/destroy/{empresa}', 'EmpresasController@destroy')->name('empresas.destroy');

    //usuario perfil empresa atuacoes
    Route::get('/empresaatuacoes/{empresa}', 'EmpresaAtuacoesController@index')->name('empresaatuacoes.index');
    Route::post('/empresaatuacoes/store', 'EmpresaAtuacoesController@store')->name('empresaatuacoes.store');
    Route::post('/empresaatuacoes/destroy', 'EmpresaAtuacoesController@destroy')->name('empresaatuacoes.destroy');

    //usuario perfil empresa sub atuacoes
    Route::get('/empresasubatuacoes/{empresa}/{atuacao}', 'EmpresaSubAtuacoesController@index')->name('empresasubatuacoes.index');
    Route::post('/empresasubatuacoes/store', 'EmpresaSubAtuacoesController@store')->name('empresasubatuacoes.store');
    Route::post('/empresasubatuacoes/destroy', 'EmpresaSubAtuacoesController@destroy')->name('empresasubatuacoes.destroy');

    //usuario empresa banner
    Route::get('/empresas/{empresa}/banner', 'EmpresaBannersController@index')->name('empresabanners.index');
    Route::get('/empresas/{empresa}/banner/novo', 'EmpresaBannersController@create')->name('empresabanners.create');
    Route::post('/empresas/{empresa}/banner/store', 'EmpresaBannersController@store')->name('empresabanners.store');
    Route::put('/empresas/{empresa}/banner/update/{banner}', 'EmpresaBannersController@update')->name('empresabanners.update');
    Route::get('/empresas/{empresa}/banner/edit/{banner}', 'EmpresaBannersController@edit')->name('empresabanners.edit');
    Route::get('/empresas/{empresa}/banner/show/{banner}', 'EmpresaBannersController@show')->name('empresabanners.show');
    Route::get('/empresas/{empresa}/banner/enviar/{banner}', 'EmpresaBannersController@enviar')->name('empresabanners.enviar');
    Route::get('/empresas/{empresa}/banner/destroy/{banner}', 'EmpresaBannersController@destroy')->name('empresabanners.destroy');

    //cursos usuarios
    Route::get('/cursos', 'CursosController@index')->name('cursos.index');
    Route::get('/cursos/novo', 'CursosController@create')->name('cursos.create');
    Route::post('/cursos/store', 'CursosController@store')->name('cursos.store');
    Route::put('/cursos/update/{curso}', 'CursosController@update')->name('cursos.update');
    Route::get('/cursos/edit/{curso}', 'CursosController@edit')->name('cursos.edit');
    Route::get('/cursos/show/{curso}', 'CursosController@show')->name('cursos.show');
    Route::get('/cursos/enviar/{curso}', 'CursosController@enviar')->name('cursos.enviar');
    Route::get('/cursos/destroy/{curso}', 'CursosController@destroy')->name('cursos.destroy');

    //cursos categorias
    Route::get('/cursocategorias/{curso}', 'CursoCategoriasController@index')->name('cursocategorias.index');
    Route::post('/cursocategorias/store', 'CursoCategoriasController@store')->name('cursocategorias.store');
    Route::post('/cursocategorias/destroy', 'CursoCategoriasController@destroy')->name('cursocategorias.destroy');

    //eventos usuarios
    Route::get('/eventos', 'EventosController@index')->name('eventos.index');
    Route::get('/eventos/novo', 'EventosController@create')->name('eventos.create');
    Route::post('/eventos/store', 'EventosController@store')->name('eventos.store');
    Route::put('/eventos/update/{evento}', 'EventosController@update')->name('eventos.update');
    Route::get('/eventos/edit/{evento}', 'EventosController@edit')->name('eventos.edit');
    Route::get('/eventos/show/{evento}', 'EventosController@show')->name('eventos.show');
    Route::get('/eventos/enviar/{evento}', 'EventosController@enviar')->name('eventos.enviar');
    Route::get('/eventos/destroy/{evento}', 'EventosController@destroy')->name('eventos.destroy');

    //eventos categorias
    Route::get('/eventocategorias/{evento}', 'EventoCategoriasController@index')->name('eventocategorias.index');
    Route::post('/eventocategorias/store', 'EventoCategoriasController@store')->name('eventocategorias.store');
    Route::post('/eventocategorias/destroy', 'EventoCategoriasController@destroy')->name('eventocategorias.destroy');

    //parecer
    Route::get('/pareceres/show/{parecer}', 'PareceresController@show')->name('pareceres.show');
    Route::get('/pareceres/showall', 'PareceresController@showall')->name('pareceres.showall');
    //admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'check.permission']], function () {
        //usuarios
        Route::get('/usuarios', 'UsuariosController@index')->name('usuarios.index');
        Route::get('/usuarios/edit/{usuario}', 'UsuariosController@edit')->name('usuarios.edit');
        Route::put('/usuarios/update/{usuario}', 'UsuariosController@update')->name('usuarios.update');
        Route::post('/usuarios/tipoadmin', 'UsuariosController@tipoadmin')->name('usuarios.tipoadmin');
        Route::post('/usuarios/tipouser', 'UsuariosController@tipouser')->name('usuarios.tipouser');

        //categorias
        Route::get('/categorias', 'CategoriasController@index')->name('categorias.index');
        Route::get('/categorias/novo', 'CategoriasController@create')->name('categorias.create');
        Route::post('/categorias/store', 'CategoriasController@store')->name('categorias.store');
        Route::put('/categorias/update/{categoria}', 'CategoriasController@update')->name('categorias.update');
        Route::get('/categorias/edit/{categoria}', 'CategoriasController@edit')->name('categorias.edit');
        Route::get('/categorias/destroy/{categoria}', 'CategoriasController@destroy')->name('categorias.destroy');

        //atuacoes
        Route::get('/atuacoes', 'AtuacoesController@index')->name('atuacoes.index');
        Route::get('/atuacoes/novo', 'AtuacoesController@create')->name('atuacoes.create');
        Route::post('/atuacoes/store', 'AtuacoesController@store')->name('atuacoes.store');
        Route::put('/atuacoes/update/{atuacao}', 'AtuacoesController@update')->name('atuacoes.update');
        Route::get('/atuacoes/edit/{atuacao}', 'AtuacoesController@edit')->name('atuacoes.edit');
        Route::get('/atuacoes/destroy/{atuacao}', 'AtuacoesController@destroy')->name('atuacoes.destroy');

        //subatuacoes
        Route::get('/atuacoes/{atuacao}/subatuacoes', 'SubAtuacoesController@index')->name('subatuacoes.index');
        Route::get('/atuacoes/{atuacao}/subatuacoes/novo', 'SubAtuacoesController@create')->name('subatuacoes.create');
        Route::post('/atuacoes/{atuacao}/subatuacoes/store', 'SubAtuacoesController@store')->name('subatuacoes.store');
        Route::put('/atuacoes/{atuacao}/subatuacoes/update/{subatuacao}', 'SubAtuacoesController@update')->name('subatuacoes.update');
        Route::get('/atuacoes/{atuacao}/subatuacoes/edit/{subatuacao}', 'SubAtuacoesController@edit')->name('subatuacoes.edit');
        Route::get('/atuacoes/{atuacao}/subatuacoes/destroy/{subatuacao}', 'SubAtuacoesController@destroy')->name('subatuacoes.destroy');

        //paises
        Route::get('/paises', 'PaisesController@index')->name('paises.index');
        Route::get('/paises/novo', 'PaisesController@create')->name('paises.create');
        Route::post('/paises/store', 'PaisesController@store')->name('paises.store');
        Route::put('/paises/update/{pais}', 'PaisesController@update')->name('paises.update');
        Route::get('/paises/edit/{pais}', 'PaisesController@edit')->name('paises.edit');
        Route::get('/paises/destroy/{pais}', 'PaisesController@destroy')->name('paises.destroy');

        //estados
        Route::get('/paises/{pais}/estados', 'EstadosController@index')->name('estados.index');
        Route::get('/paises/{pais}/estados/novo', 'EstadosController@create')->name('estados.create');
        Route::post('/paises/{pais}/estados/store', 'EstadosController@store')->name('estados.store');
        Route::put('/paises/{pais}/estados/update/{estado}', 'EstadosController@update')->name('estados.update');
        Route::get('/paises/{pais}/estados/edit/{estado}', 'EstadosController@edit')->name('estados.edit');
        Route::get('/paises/{pais}/estados/destroy/{estado}', 'EstadosController@destroy')->name('estados.destroy');

        //cidades
        Route::get('/paises/{pais}/estados/{estado}/cidades', 'CidadesController@index')->name('cidades.index');
        Route::get('/paises/{pais}/estados/{estado}/cidades/novo', 'CidadesController@create')->name('cidades.create');
        Route::post('/paises/{pais}/estados/{estado}/cidades/store', 'CidadesController@store')->name('cidades.store');
        Route::put('/paises/{pais}/estados/{estado}/cidades/update/{cidade}', 'CidadesController@update')->name('cidades.update');
        Route::get('/paises/{pais}/estados/{estado}/cidades/edit/{cidade}', 'CidadesController@edit')->name('cidades.edit');
        Route::get('/paises/{pais}/estados/{estado}/cidades/destroy/{cidade}', 'CidadesController@destroy')->name('cidades.destroy');

        //usuariointeresse
        Route::get('/userinteresses/{usuario}', 'UserInteressesController@adminshow')->name('userinteresses.adminshow');

        //profissional admin
        Route::get('/usuarios/{user}/profissionais/userprofs', 'ProfissionaisController@userprofs')->name('profissionais.userprofs');
        Route::get('/usuarios/{user}/profissionais/novo', 'ProfissionaisController@create')->name('profissionais.admincreate');
        Route::post('/usuarios/{user}/profissionais/store', 'ProfissionaisController@store')->name('profissionais.adminstore');    
        Route::post('/profissionais/liberabanner', 'ProfissionaisController@liberabanner')->name('profissionais.liberabanner');
        Route::post('/profissionais/liberadestaque', 'ProfissionaisController@liberadestaque')->name('profissionais.liberadestaque');
        Route::get('/usuarios/{user}/profissionais/adminshow/{profissional}', 'ProfissionaisController@adminshow')->name('profissionais.adminshow');
        Route::get('/usuarios/{user}/profissionais/adminedit/{profissional}', 'ProfissionaisController@adminedit')->name('profissionais.adminedit');  
        Route::put('/profissionais/adminupdate/{profissional}', 'ProfissionaisController@adminupdate')->name('profissionais.adminupdate');
        Route::put('/profissionais/analise', 'ProfissionaisController@analise')->name('profissionais.analise');
        Route::get('/profissionais/enviados/', 'ProfissionaisController@enviados')->name('profissionais.enviados');
        Route::get('/profissionais/aprovados/', 'ProfissionaisController@aprovados')->name('profissionais.aprovados');
        Route::get('/profissionais/negados/', 'ProfissionaisController@negados')->name('profissionais.negados');

        //profissional banner admin
        Route::get('/usuarios/{user}/profissionais/{profissional}/banner', 'ProfissionalBannersController@bannerprofs')->name('profissionalbanners.bannerprofs');
        Route::get('/usuarios/{user}/profissionais/{profissional}/banner/{banner}', 'ProfissionalBannersController@adminshow')->name('profissionalbanners.adminshow');
        Route::put('/profissionais/{profissional}/banner/analise', 'ProfissionalBannersController@analise')->name('profissionalbanners.analise');

        //empresa admin
        Route::get('/usuarios/{user}/empresas/useremps/', 'EmpresasController@useremps')->name('empresas.useremps');
        Route::post('/empresas/liberabanner', 'EmpresasController@liberabanner')->name('empresas.liberabanner');
        Route::post('/empresas/liberadestaque', 'EmpresasController@liberadestaque')->name('empresas.liberadestaque');
        Route::get('/usuarios/{user}/empresas/adminshow/{empresa}', 'EmpresasController@adminshow')->name('empresas.adminshow');
        Route::get('/usuarios/{user}/empresas/adminedit/{empresa}', 'EmpresasController@adminedit')->name('empresas.adminedit'); 
        Route::put('/empresas/adminupdate/{empresa}', 'EmpresasController@adminupdate')->name('empresas.adminupdate');
        Route::put('/empresas/analise', 'EmpresasController@analise')->name('empresas.analise');
        Route::get('/empresas/enviados/', 'EmpresasController@enviados')->name('empresas.enviados');
        Route::get('/empresas/aprovados/', 'EmpresasController@aprovados')->name('empresas.aprovados');
        Route::get('/empresas/negados/', 'EmpresasController@negados')->name('empresas.negados');

        //empresa banner admin
        Route::get('/usuarios/{user}/empresas/{empresa}/banner', 'EmpresaBannersController@banneremps')->name('empresabanners.banneremps');
        Route::get('/usuarios/{user}/empresas/{empresa}/banner/{banner}', 'EmpresaBannersController@adminshow')->name('empresabanners.adminshow');
        Route::put('/empresas/{empresa}/banner/analise', 'EmpresaBannersController@analise')->name('empresabanners.analise');

        //cursos admin
        Route::get('/usuarios/{user}/cursos/usercursos/', 'CursosController@usercursos')->name('cursos.usercursos');
        Route::post('/cursos/liberadestaque', 'CursosController@liberadestaque')->name('cursos.liberadestaque');
        Route::get('/usuarios/{user}/cursos/adminshow/{curso}', 'CursosController@adminshow')->name('cursos.adminshow');
        Route::put('/cursos/analise', 'CursosController@analise')->name('cursos.analise');
        Route::get('/cursos/enviados/', 'CursosController@enviados')->name('cursos.enviados');
        Route::get('/cursos/aprovados/', 'CursosController@aprovados')->name('cursos.aprovados');
        Route::get('/cursos/negados/', 'CursosController@negados')->name('cursos.negados');

        //eventos admin
        Route::get('/usuarios/{user}/eventos/usereven/', 'EventosController@usereven')->name('eventos.usereven');
        Route::post('/eventos/liberadestaque', 'EventosController@liberadestaque')->name('eventos.liberadestaque');
        Route::get('/usuarios/{user}/eventos/adminshow/{evento}', 'EventosController@adminshow')->name('eventos.adminshow');
        Route::post('/usuarios/{user}/eventos/adminedit/{evento}', 'EventosController@adminedit')->name('eventos.adminedit');
        Route::put('/usuarios/{user}/eventos/adminupdate/{evento}', 'EventosController@adminupdate')->name('eventos.adminupdate');
        Route::put('/eventos/analise', 'EventosController@analise')->name('eventos.analise');
        Route::get('/eventos/enviados/', 'EventosController@enviados')->name('eventos.enviados');
        Route::get('/eventos/aprovados/', 'EventosController@aprovados')->name('eventos.aprovados');
        Route::get('/eventos/negados/', 'EventosController@negados')->name('eventos.negados');

        //posts
        Route::get('/posts', 'PostsController@index')->name('posts.index');
        Route::get('/posts/novo', 'PostsController@create')->name('posts.create');
        Route::post('/posts/store', 'PostsController@store')->name('posts.store');
        Route::put('/posts/update/{post}', 'PostsController@update')->name('posts.update');
        Route::get('/posts/edit/{post}', 'PostsController@edit')->name('posts.edit');
        Route::get('/posts/enviar/{post}', 'PostsController@enviar')->name('posts.enviar');
        Route::get('/posts/destroy/{post}', 'PostsController@destroy')->name('posts.destroy');

        //posts categorias
        Route::get('/postcategorias/{evento}', 'PostCategoriasController@index')->name('postcategorias.index');
        Route::post('/postcategorias/store', 'PostCategoriasController@store')->name('postcategorias.store');
        Route::post('/postcategorias/destroy', 'PostCategoriasController@destroy')->name('postcategorias.destroy');

        //banners principais
        Route::get('/bannersprincipais', 'BannersPrincipaisController@index')->name('bannersprincipais.index');
        Route::get('/bannersprincipais/novo', 'BannersPrincipaisController@create')->name('bannersprincipais.create');
        Route::post('/bannersprincipais/store', 'BannersPrincipaisController@store')->name('bannersprincipais.store');
        Route::put('/bannersprincipais/update/{banner}', 'BannersPrincipaisController@update')->name('bannersprincipais.update');
        Route::get('/bannersprincipais/edit/{banner}', 'BannersPrincipaisController@edit')->name('bannersprincipais.edit');
        Route::get('/bannersprincipais/destroy/{banner}', 'BannersPrincipaisController@destroy')->name('bannersprincipais.destroy');

        //fileuploud
        Route::get('/public/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
        Route::post('/public/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\UploadController@upload');

        //makeslug
        Route::get('/makeslug', 'MakeSlugController@index')->name('makeslug.index');
    });

});

Route::get('sitemap', function () {
    SitemapGenerator::create('https://www.oloyfit.com/')->writeToFile('sitemap.xml');
    return 'sitemap feito';
});

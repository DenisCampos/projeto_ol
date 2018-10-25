<?php
Breadcrumbs::for('home', function ($trail) {
     $trail->push('Home', route('home'));
});

Breadcrumbs::for('edit', function ($trail) {
    $trail->parent('home');
    $trail->push('Dados Pessoais', route('edit'));
});

Breadcrumbs::for('password', function ($trail) {
    $trail->parent('edit');
    $trail->push('Alterar Senha', route('password'));
});

Breadcrumbs::for('userinteresses.index', function ($trail) {
    $trail->parent('edit');
    $trail->push('Interesses', route('userinteresses.index'));
});


//usuario perfil profissional
Breadcrumbs::for('profissionais.index', function ($trail) {
    $trail->parent('edit');
    $trail->push('Profissional', route('profissionais.index'));
});

Breadcrumbs::for('profissionais.create', function ($trail) {
    $trail->parent('profissionais.index');
    $trail->push('Novo', route('profissionais.create'));
});

Breadcrumbs::for('profissionais.edit', function ($trail, $profissional) {
    $trail->parent('profissionais.index');
    $trail->push('Editar', route('profissionais.edit', $profissional->id));
});

Breadcrumbs::for('profissionais.show', function ($trail, $profissional) {
    $trail->parent('profissionais.index');
    $trail->push($profissional->name, route('profissionais.show', $profissional->id));
});


//usuario perfil profissional atuacoes
Breadcrumbs::for('profissionalatuacoes.index', function ($trail, $profissional) {
    $trail->parent('profissionais.edit', $profissional);
    $trail->push('Atuações', route('profissionalatuacoes.index', $profissional->id));
});


//usuario perfil profissional sub atuacoes
Breadcrumbs::for('profissionalsubatuacoes.index', function ($trail, $profissional, $atuacoes) {
    $trail->parent('profissionalatuacoes.index', $profissional);
    $trail->push('Sub Atuações', route('profissionalsubatuacoes.index', [$profissional->id, $atuacoes]));
});


//usuario profissional banner
Breadcrumbs::for('profissionalbanners.index', function ($trail, $profissional) {
    $trail->parent('profissionais.show', $profissional);
    $trail->push('Banner', route('profissionalbanners.index', $profissional->id));
});

Breadcrumbs::for('profissionalbanners.create', function ($trail, $profissional) {
    $trail->parent('profissionalbanners.index', $profissional);
    $trail->push('Novo', route('profissionalbanners.create', $profissional->id));
});

Breadcrumbs::for('profissionalbanners.edit', function ($trail, $profissional, $banner) {
    $trail->parent('profissionalbanners.index', $profissional);
    $trail->push('Editar', route('profissionalbanners.edit', [$profissional->id, $banner->id]));
});

Breadcrumbs::for('profissionalbanners.show', function ($trail, $profissional, $banner) {
    $trail->parent('profissionalbanners.index', $profissional);
    $trail->push('Detalhar', route('profissionalbanners.show', [$profissional->id, $banner->id]));
});


//usuario perfil empresa
Breadcrumbs::for('empresas.index', function ($trail) {
    $trail->parent('edit');
    $trail->push('Empresa', route('empresas.index'));
});

Breadcrumbs::for('empresas.create', function ($trail) {
    $trail->parent('empresas.index');
    $trail->push('Novo', route('empresas.create'));
});

Breadcrumbs::for('empresas.edit', function ($trail, $empresa) {
    $trail->parent('empresas.index');
    $trail->push('Editar', route('empresas.edit', $empresa->id));
});

Breadcrumbs::for('empresas.show', function ($trail, $empresa) {
    $trail->parent('empresas.index');
    $trail->push($empresa->name, route('empresas.show', $empresa->id));
});


//usuario perfil empresa atuacoes
Breadcrumbs::for('empresaatuacoes.index', function ($trail, $empresa) {
    $trail->parent('empresas.edit', $empresa);
    $trail->push('Atuações', route('empresaatuacoes.index', $empresa->id));
});

//usuario perfil empresa sub atuacoes
Breadcrumbs::for('empresasubatuacoes.index', function ($trail, $empresa, $atuacoes) {
    $trail->parent('empresaatuacoes.index', $empresa);
    $trail->push('Sub Atuações', route('empresasubatuacoes.index', [$empresa->id, $atuacoes]));
});

//usuario empresa banner
Breadcrumbs::for('empresabanners.index', function ($trail, $empresa) {
    $trail->parent('empresas.show', $empresa);
    $trail->push('Banner', route('empresabanners.index', $empresa->id));
});

Breadcrumbs::for('empresabanners.create', function ($trail, $empresa) {
    $trail->parent('empresabanners.index', $empresa);
    $trail->push('Novo', route('empresabanners.create', $empresa->id));
});

Breadcrumbs::for('empresabanners.edit', function ($trail, $empresa, $banner) {
    $trail->parent('empresabanners.index', $empresa);
    $trail->push('Editar', route('empresabanners.edit', [$empresa->id, $banner->id]));
});

Breadcrumbs::for('empresabanners.show', function ($trail, $empresa, $banner) {
    $trail->parent('empresabanners.index', $empresa);
    $trail->push('Detalhar', route('empresabanners.show', [$empresa->id, $banner->id]));
});


//cursos usuarios
Breadcrumbs::for('cursos.index', function ($trail) {
    $trail->parent('edit');
    $trail->push('Infoprodutos', route('cursos.index'));
});

Breadcrumbs::for('cursos.create', function ($trail) {
    $trail->parent('cursos.index');
    $trail->push('Novo', route('cursos.create'));
});

Breadcrumbs::for('cursos.edit', function ($trail, $curso) {
    $trail->parent('cursos.index');
    $trail->push('Editar', route('cursos.edit', $curso->id));
});

Breadcrumbs::for('cursos.show', function ($trail, $curso) {
    $trail->parent('cursos.index');
    $trail->push($curso->titulo, route('cursos.show', $curso->id));
});


//cursos categorias
Breadcrumbs::for('cursocategorias.index', function ($trail, $curso) {
    $trail->parent('cursos.edit', $curso);
    $trail->push('Categorias', route('cursocategorias.index', $curso->id));
});


//eventos usuarios
Breadcrumbs::for('eventos.index', function ($trail) {
    $trail->parent('edit');
    $trail->push('Eventos', route('eventos.index'));
});

Breadcrumbs::for('eventos.create', function ($trail) {
    $trail->parent('eventos.index');
    $trail->push('Novo', route('eventos.create'));
});

Breadcrumbs::for('eventos.edit', function ($trail, $evento) {
    $trail->parent('eventos.index');
    $trail->push('Editar', route('eventos.edit', $evento->id));
});

Breadcrumbs::for('eventos.show', function ($trail, $evento) {
    $trail->parent('eventos.index');
    $trail->push($evento->titulo, route('eventos.show', $evento->id));
});


//eventos categorias
Breadcrumbs::for('eventocategorias.index', function ($trail, $evento) {
    $trail->parent('eventos.edit', $evento);
    $trail->push('Categorias', route('eventocategorias.index', $evento->id));
});


//parecer
Breadcrumbs::for('pareceres.show', function ($trail, $parecer) {
    $trail->parent('home');
    $trail->push('Parecer', route('pareceres.show', $parecer->id));
});

Breadcrumbs::for('pareceres.showall', function ($trail) {
    $trail->parent('home');
    $trail->push('Pareceres', route('pareceres.showall'));
});


//ADMIN
//usuarios
Breadcrumbs::for('admin.usuarios.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Usuários', route('admin.usuarios.index'));
});

Breadcrumbs::for('admin.usuarios.create', function ($trail) {
    $trail->parent('admin.usuarios.index');
    $trail->push('Novo', route('admin.usuarios.create'));
});

Breadcrumbs::for('admin.usuarios.edit', function ($trail, $usuario) {
    $trail->parent('admin.usuarios.index');
    $trail->push($usuario->name, route('admin.usuarios.edit', $usuario->id));
});


//usuariointeresse
Breadcrumbs::for('admin.userinteresses.adminshow', function ($trail, $usuario) {
    $trail->parent('admin.usuarios.edit', $usuario);
    $trail->push('Interesses', route('admin.userinteresses.adminshow', $usuario->id));
});


//profissional admin
Breadcrumbs::for('admin.profissionais.userprofs', function ($trail, $usuario) {
    $trail->parent('admin.usuarios.edit', $usuario);
    $trail->push('Profissionais', route('admin.profissionais.userprofs', $usuario->id));
});

Breadcrumbs::for('admin.profissionais.admincreate', function ($trail, $usuario) {
    $trail->parent('admin.profissionais.userprofs', $usuario);
    $trail->push('Novo', route('admin.profissionais.admincreate', $usuario->id));
});

Breadcrumbs::for('admin.profissionais.adminshow', function ($trail, $usuario, $profissional) {
    $trail->parent('admin.profissionais.userprofs', $usuario);
    $trail->push($profissional->name, route('admin.profissionais.adminshow', [$usuario, $profissional->id]));
});

Breadcrumbs::for('admin.profissionais.adminedit', function ($trail, $usuario, $profissional) {
    $trail->parent('admin.profissionais.adminshow', $usuario, $profissional);
    $trail->push('Editar', route('admin.profissionais.adminedit', [$usuario->id, $profissional->id]));
});

Breadcrumbs::for('admin.profissionais.enviados', function ($trail) {
    $trail->parent('home');
    $trail->push('Enviados', route('admin.profissionais.enviados'));
});

Breadcrumbs::for('admin.profissionais.aprovados', function ($trail) {
    $trail->parent('admin.profissionais.enviados');
    $trail->push('Aprovados', route('admin.profissionais.aprovados'));
});

Breadcrumbs::for('admin.profissionais.negados', function ($trail) {
    $trail->parent('admin.profissionais.enviados');
    $trail->push('Negados', route('admin.profissionais.negados'));
});


//profissional admin atuacoes
Breadcrumbs::for('admin.profissionalatuacoes.adminindex', function ($trail, $usuario, $profissional) {
    $trail->parent('admin.profissionais.adminedit', $usuario, $profissional);
    $trail->push('Atuações', route('admin.profissionalatuacoes.adminindex',[$usuario->id, $profissional->id]));
});


//profissional admin sub atuacoes
Breadcrumbs::for('admin.profissionalsubatuacoes.adminindex', function ($trail, $usuario, $profissional, $atuacao) {
    $trail->parent('admin.profissionalatuacoes.adminindex', $usuario, $profissional);
    $trail->push('Sub Atuações', route('admin.profissionalsubatuacoes.adminindex', [$usuario->id, $profissional->id, $atuacao->id]));
});


//profissional banner admin
Breadcrumbs::for('admin.profissionalbanners.bannerprofs', function ($trail, $usuario, $profissional) {
    $trail->parent('admin.profissionais.adminshow', $usuario, $profissional);
    $trail->push('Banners', route('admin.profissionalbanners.bannerprofs', [$usuario->id, $profissional->id]));
});

Breadcrumbs::for('admin.profissionalbanners.admincreate', function ($trail, $usuario, $profissional) {
    $trail->parent('admin.profissionalbanners.bannerprofs', $usuario, $profissional);
    $trail->push('Novo', route('admin.profissionalbanners.admincreate', [$usuario->id, $profissional->id]));
});

Breadcrumbs::for('admin.profissionalbanners.adminedit', function ($trail, $usuario, $profissional, $banner) {
    $trail->parent('admin.profissionalbanners.bannerprofs', $usuario, $profissional);
    $trail->push('Editar', route('admin.profissionalbanners.adminedit', [$usuario->id, $profissional->id, $banner->id]));
});

Breadcrumbs::for('admin.profissionalbanners.adminshow', function ($trail, $usuario, $profissional, $banner) {
    $trail->parent('admin.profissionalbanners.bannerprofs', $usuario, $profissional);
    $trail->push('Detalhar', route('admin.profissionalbanners.adminshow', [$usuario->id, $profissional->id, $banner->id]));
});


//empresa admin
Breadcrumbs::for('admin.empresas.useremps', function ($trail, $usuario) {
    $trail->parent('admin.usuarios.edit', $usuario);
    $trail->push('Empresas', route('admin.empresas.useremps', [$usuario->id]));
});

Breadcrumbs::for('admin.empresas.adminshow', function ($trail, $usuario, $empresa) {
    $trail->parent('admin.empresas.useremps', $usuario);
    $trail->push($empresa->name, route('admin.empresas.adminshow', [$usuario->id, $empresa->id]));
});

Breadcrumbs::for('admin.empresas.admincreate', function ($trail, $usuario) {
    $trail->parent('admin.empresas.useremps', $usuario);
    $trail->push('Novo', route('admin.empresas.admincreate', $usuario->id));
});

Breadcrumbs::for('admin.empresas.adminedit', function ($trail, $usuario, $empresa) {
    $trail->parent('admin.empresas.adminshow', $usuario, $empresa);
    $trail->push('Editar', route('admin.empresas.adminedit', [$usuario->id, $empresa->id]));
});

Breadcrumbs::for('admin.empresas.enviados', function ($trail) {
    $trail->parent('home');
    $trail->push('Enviados', route('admin.empresas.enviados'));
});

Breadcrumbs::for('admin.empresas.aprovados', function ($trail) {
    $trail->parent('admin.empresas.enviados');
    $trail->push('Aprovados', route('admin.empresas.aprovados'));
});

Breadcrumbs::for('admin.empresas.negados', function ($trail) {
    $trail->parent('admin.empresas.enviados');
    $trail->push('Negados', route('admin.empresas.negados'));
});


//empresa admin atuacoes
Breadcrumbs::for('admin.empresaatuacoes.adminindex', function ($trail, $usuario, $empresa) {
    $trail->parent('admin.empresas.adminedit', $usuario, $empresa);
    $trail->push('Atuações', route('admin.empresaatuacoes.adminindex',[$usuario->id, $empresa->id]));
});


//empresa admin sub atuacoes
Breadcrumbs::for('admin.empresasubatuacoes.adminindex', function ($trail, $usuario, $empresa, $atuacao) {
    $trail->parent('admin.empresaatuacoes.adminindex', $usuario, $empresa);
    $trail->push('Sub Atuações', route('admin.empresasubatuacoes.adminindex', [$usuario->id, $empresa->id, $atuacao->id]));
});


//empresa banner admin
Breadcrumbs::for('admin.empresabanners.banneremps', function ($trail, $usuario, $empresa) {
    $trail->parent('admin.empresas.adminshow', $usuario, $empresa);
    $trail->push('Banners', route('admin.empresabanners.banneremps', [$usuario->id, $empresa->id]));
});

Breadcrumbs::for('admin.empresabanners.admincreate', function ($trail, $usuario, $empresa) {
    $trail->parent('admin.empresabanners.bannerprofs', $usuario, $empresa);
    $trail->push('Novo', route('admin.empresabanners.admincreate', [$usuario->id, $empresa->id]));
});

Breadcrumbs::for('admin.empresabanners.adminedit', function ($trail, $usuario, $empresa, $banner) {
    $trail->parent('admin.empresabanners.bannerprofs', $usuario, $empresa);
    $trail->push('Editar', route('admin.empresabanners.adminedit', [$usuario->id, $empresa->id, $banner->id]));
});

Breadcrumbs::for('admin.empresabanners.adminshow', function ($trail, $usuario, $empresa, $banner) {
    $trail->parent('admin.empresabanners.banneremps', $usuario, $empresa);
    $trail->push('Detalhar', route('admin.empresabanners.adminshow', [$usuario->id, $empresa->id, $banner->id]));
});


//cursos admin
Breadcrumbs::for('admin.cursos.usercursos', function ($trail, $usuario) {
    $trail->parent('admin.usuarios.edit', $usuario);
    $trail->push('Infoprodutos', route('admin.cursos.usercursos',$usuario->id));
});

Breadcrumbs::for('admin.cursos.adminshow', function ($trail, $usuario, $curso) {
    $trail->parent('admin.cursos.usercursos', $usuario);
    $trail->push('Detalhar', route('admin.cursos.adminshow', [$usuario->id, $curso->id]));
});

Breadcrumbs::for('admin.cursos.enviados', function ($trail) {
    $trail->parent('home');
    $trail->push('Enviados', route('admin.cursos.enviados'));
});

Breadcrumbs::for('admin.cursos.aprovados', function ($trail) {
    $trail->parent('admin.cursos.enviados');
    $trail->push('Aprovados', route('admin.cursos.aprovados'));
});

Breadcrumbs::for('admin.cursos.negados', function ($trail) {
    $trail->parent('admin.cursos.enviados');
    $trail->push('Negados', route('admin.cursos.negados'));
});


//eventos admin
Breadcrumbs::for('admin.eventos.usereven', function ($trail, $usuario) {
    $trail->parent('admin.usuarios.edit', $usuario);
    $trail->push('Eventos', route('admin.eventos.usereven',$usuario->id));
});

Breadcrumbs::for('admin.eventos.adminshow', function ($trail, $usuario, $evento) {
    $trail->parent('admin.eventos.usereven', $usuario);
    $trail->push('Detalhar', route('admin.eventos.adminshow', [$usuario->id, $evento->id]));
});

Breadcrumbs::for('admin.eventos.adminedit', function ($trail, $usuario, $evento) {
    $trail->parent('admin.eventos.adminshow', $usuario, $evento);
    $trail->push('Editar', route('admin.eventos.adminedit', [$usuario->id, $evento->id]));
});

Breadcrumbs::for('admin.eventos.enviados', function ($trail) {
    $trail->parent('home');
    $trail->push('Enviados', route('admin.eventos.enviados'));
});

Breadcrumbs::for('admin.eventos.aprovados', function ($trail) {
    $trail->parent('admin.eventos.enviados');
    $trail->push('Aprovados', route('admin.eventos.aprovados'));
});

Breadcrumbs::for('admin.eventos.negados', function ($trail) {
    $trail->parent('admin.eventos.enviados');
    $trail->push('Negados', route('admin.eventos.negados'));
});


//posts
Breadcrumbs::for('admin.posts.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Posts', route('admin.posts.index'));
});

Breadcrumbs::for('admin.posts.create', function ($trail) {
    $trail->parent('admin.posts.index');
    $trail->push('Novo', route('admin.posts.create'));
});

Breadcrumbs::for('admin.posts.edit', function ($trail, $post) {
    $trail->parent('admin.posts.index');
    $trail->push('Editar', route('admin.posts.edit', $post->id));
});


//posts categorias
Breadcrumbs::for('admin.postcategorias.index', function ($trail, $post) {
    $trail->parent('admin.posts.edit', $post);
    $trail->push('Categorias', route('admin.postcategorias.index', $post->id));
});


//banners principais
Breadcrumbs::for('admin.bannersprincipais.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Banners Principais', route('admin.bannersprincipais.index'));
});

Breadcrumbs::for('admin.bannersprincipais.create', function ($trail) {
    $trail->parent('admin.bannersprincipais.index');
    $trail->push('Novo', route('admin.bannersprincipais.create'));
});

Breadcrumbs::for('admin.bannersprincipais.edit', function ($trail, $banner) {
    $trail->parent('admin.bannersprincipais.index');
    $trail->push('Editar', route('admin.bannersprincipais.edit', $banner->id));
});


//categorias
Breadcrumbs::for('admin.categorias.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Categorias', route('admin.categorias.index'));
});

Breadcrumbs::for('admin.categorias.create', function ($trail) {
    $trail->parent('admin.categorias.index');
    $trail->push('Novo', route('admin.categorias.create'));
});

Breadcrumbs::for('admin.categorias.edit', function ($trail, $categoria) {
    $trail->parent('admin.categorias.index');
    $trail->push($categoria->descricao, route('admin.categorias.edit', $categoria->id));
});


//atuacoes
Breadcrumbs::for('admin.atuacoes.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Atuações', route('admin.atuacoes.index'));
});

Breadcrumbs::for('admin.atuacoes.create', function ($trail) {
    $trail->parent('admin.atuacoes.index');
    $trail->push('Novo', route('admin.atuacoes.create'));
});

Breadcrumbs::for('admin.atuacoes.edit', function ($trail, $atuacao) {
    $trail->parent('admin.atuacoes.index');
    $trail->push($atuacao->descricao, route('admin.atuacoes.edit', $atuacao->id));
});


//subatuacoes
Breadcrumbs::for('admin.subatuacoes.index', function ($trail, $atuacao) {
    $trail->parent('admin.atuacoes.edit',$atuacao);
    $trail->push('Sub Atuações', route('admin.subatuacoes.index',$atuacao->id));
});

Breadcrumbs::for('admin.subatuacoes.create', function ($trail, $atuacao) {
    $trail->parent('admin.subatuacoes.index',$atuacao);
    $trail->push('Novo', route('admin.subatuacoes.create',$atuacao->id));
});

Breadcrumbs::for('admin.subatuacoes.edit', function ($trail, $atuacao, $subatuacao) {
    $trail->parent('admin.subatuacoes.index',$atuacao);
    $trail->push($subatuacao->descricao, route('admin.subatuacoes.edit', [$atuacao->id ,$subatuacao->id]));
});


//paises
Breadcrumbs::for('admin.paises.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Países', route('admin.paises.index'));
});

Breadcrumbs::for('admin.paises.create', function ($trail) {
    $trail->parent('admin.paises.index');
    $trail->push('Novo', route('admin.paises.create'));
});

Breadcrumbs::for('admin.paises.edit', function ($trail, $pais) {
    $trail->parent('admin.paises.index');
    $trail->push($pais->descricao, route('admin.paises.edit', $pais->id));
});


//estados
Breadcrumbs::for('admin.estados.index', function ($trail, $pais) {
    $trail->parent('admin.paises.edit',$pais);
    $trail->push('Estados', route('admin.estados.index',$pais->id));
});

Breadcrumbs::for('admin.estados.create', function ($trail, $pais) {
    $trail->parent('admin.estados.index',$pais);
    $trail->push('Novo', route('admin.estados.create',$pais->id));
});

Breadcrumbs::for('admin.estados.edit', function ($trail, $pais, $estado) {
    $trail->parent('admin.estados.index',$pais);
    $trail->push($estado->descricao, route('admin.estados.edit', [$pais->id ,$estado->id]));
});


//cidades
Breadcrumbs::for('admin.cidades.index', function ($trail, $pais, $estado) {
    $trail->parent('admin.estados.edit',$pais, $estado);
    $trail->push('Cidades', route('admin.estados.index',[$pais->id, $estado->id]));
});

Breadcrumbs::for('admin.cidades.create', function ($trail, $pais, $estado) {
    $trail->parent('admin.cidades.index',$pais, $estado);
    $trail->push('Novo', route('admin.cidades.create',[$pais->id, $estado->id]));
});

Breadcrumbs::for('admin.cidades.edit', function ($trail, $pais, $estado, $cidade) {
    $trail->parent('admin.cidades.index',$pais, $estado);
    $trail->push($cidade->descricao, route('admin.cidades.edit', [$pais->id ,$estado->id, $cidade->id]));
});

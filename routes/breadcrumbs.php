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


//profissional banner admin
Breadcrumbs::for('admin.profissionalbanners.bannerprofs', function ($trail, $usuario, $profissional) {
    $trail->parent('admin.profissionais.adminshow', $usuario, $profissional);
    $trail->push('Banners', route('admin.profissionalbanners.bannerprofs', [$usuario->id, $profissional->id]));
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


//empresa banner admin
Breadcrumbs::for('admin.empresabanners.banneremps', function ($trail, $usuario, $empresa) {
    $trail->parent('admin.empresas.adminshow', $usuario, $empresa);
    $trail->push('Banners', route('admin.empresabanners.banneremps', [$usuario->id, $empresa->id]));
});

Breadcrumbs::for('admin.empresabanners.adminshow', function ($trail, $usuario, $empresa, $banner) {
    $trail->parent('admin.empresabanners.banneremps', $usuario, $empresa);
    $trail->push('Detalhar', route('admin.empresabanners.adminshow', [$usuario->id, $empresa->id, $banner->id]));
});
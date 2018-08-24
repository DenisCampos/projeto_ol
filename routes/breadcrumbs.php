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
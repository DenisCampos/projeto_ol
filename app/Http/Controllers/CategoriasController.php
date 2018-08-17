<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoriasRepository;

class CategoriasController extends Controller
{
    protected $repository;

    public function __construct(CategoriasRepository $repository){
        $this->repository = $repository;
    }

    public function index(){

        $categorias = $this->repository->orderBy('descricao')->all();
        //dd($categorias);

        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request){
        $data = $request->all();
        $this->repository->create($data);
        \Session::flash('message', ' Categoria criada com sucesso.');
        return redirect()->route('admin.categorias.index');
    }


    public function edit($id){
        $categoria = $this->repository->find($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $this->repository->update($data, $id);
        \Session::flash('message', ' Categoria atualizada com sucesso.');
        return redirect()->route('admin.categorias.index');
    }

    public function destroy($id){
        $this->repository->delete($id);
        \Session::flash('message', ' Categoria deletada com sucesso.');
        return redirect()->route('admin.categorias.index');
    }
}

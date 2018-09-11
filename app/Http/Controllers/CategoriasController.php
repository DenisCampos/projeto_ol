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
        $data['slug'] = $this->montarSlug($data['descricao'], '');
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
        $data['slug'] = $this->montarSlug($data['descricao'], $id);
        $this->repository->update($data, $id);
        \Session::flash('message', ' Categoria atualizada com sucesso.');
        return redirect()->route('admin.categorias.index');
    }

    public function destroy($id){
        $this->repository->delete($id);
        \Session::flash('message', ' Categoria deletada com sucesso.');
        return redirect()->route('admin.categorias.index');
    }

    private function montarSlug($titulo, $id){
        $slug = str_slug($titulo, '-');
        $slug_count = $this->repository->findByField('slug',$slug)->where('id', '!=', $id)->count();
        //dd($slug_count);
        if($slug_count>0){
            $vefica_slug = $slug_count;
            while($vefica_slug>0){
                $slug_count++;
                $vefica_slug = $this->repository->findByField('slug',$slug."-".$slug_count)->where('id', '!=', $id)->count();                
            }
            $slug = $slug."-".$slug_count;
        }
        return $slug;
    }
}

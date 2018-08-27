<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CursoCategoriasRepository;
use App\Repositories\CategoriasRepository;
use App\Repositories\CursosRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CursoCategoriasController extends Controller
{
    protected $repository;
    private $categoriasrepository, $cursosrepository;

    public function __construct(CursoCategoriasRepository $repository, CategoriasRepository $categoriasrepository, CursosRepository $cursosrepository){
        $this->repository = $repository;
        $this->categoriasrepository = $categoriasrepository;
        $this->cursosrepository = $cursosrepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($curso)
    {
        if($this->verificaUser($curso)==1){
            abort(403);
        }

        $categorias = DB::table('categorias')
            ->leftJoin('curso_categorias', function ($join) use ($curso) {
                $join->on('categorias.id', '=', 'curso_categorias.categoria_id')
                    ->where('curso_categorias.curso_id', '=', $curso);
            })

            ->orderBy('categorias.descricao', 'asc')
            ->select('categorias.id as categoriaid', 'categorias.descricao', 'curso_categorias.id as categoria_curso')
            ->get();

        $curso = $this->cursosrepository->find($curso);

        //dd($categorias);

        return view('cursocategorias.index', compact('categorias','curso'));
    }

    public function store(Request $request)
    {
        $data['curso_id'] = $request->idc;
        $data['categoria_id'] = $request->id;
        $this->repository->create($data);
        $even['statu_id'] = '1';
        $even['situacao_id'] = '1';
        $even['destaque_id'] = '1';
        $this->cursosrepository->update($even,$request->idc);
        return \Response::json($request->id); 
    }

    public function destroy(Request $request)
    {
        $this->repository->deleteWhere([
            'categoria_id'=>$request->id,
            'curso_id'=>$request->idc,
        ]);
        $even['statu_id'] = '1';
        $even['situacao_id'] = '1';
        $even['destaque_id'] = '1';
        $this->cursosrepository->update($even,$request->idc);
        return \Response::json($request->id); 
    }

    public function adminshow($id){
        $usuario = $id;
        $categorias = DB::table('categorias')
            ->join('curso_categorias', function ($join) use ($id) {
                $join->on('categorias.id', '=', 'curso_categorias.categoria_id')
                    ->where('curso_categorias.curso_id', '=', $id);
            })

            ->orderBy('categorias.descricao', 'asc')
            ->select('categorias.id as categoriaid', 'categorias.descricao', 'curso_categorias.id as interessesid')
            ->get();
        
        //dd($categorias);

        return view('admin.cursocategorias.adminshow', compact('categorias', 'usuario'));
    }

    private function verificaUser($curso){
        $user = Auth::user()->id;
        $curso = $this->cursosrepository->find($curso);
        if($curso->user_id != $user){
           return 1;
        }else{
            return 0;
        }
    }
}

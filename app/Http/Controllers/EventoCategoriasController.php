<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EventoCategoriasRepository;
use App\Repositories\CategoriasRepository;
use App\Repositories\EventosRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventoCategoriasController extends Controller
{

    protected $repository;
    private $categoriasrepository, $eventosrepository;

    public function __construct(EventoCategoriasRepository $repository, CategoriasRepository $categoriasrepository, EventosRepository $eventosrepository){
        $this->repository = $repository;
        $this->categoriasrepository = $categoriasrepository;
        $this->eventosrepository = $eventosrepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($evento)
    {
        if($this->verificaUser($evento)==1){
            abort(403);
        }

        $categorias = DB::table('categorias')
            ->leftJoin('evento_categorias', function ($join) use ($evento) {
                $join->on('categorias.id', '=', 'evento_categorias.categoria_id')
                    ->where('evento_categorias.evento_id', '=', $evento);
            })
            ->whereIn('categorias.tipo', [7, 8, 9, 10, 11, 12, 13,15])
            ->orderBy('categorias.descricao', 'asc')
            ->select('categorias.id as categoriaid', 'categorias.descricao', 'evento_categorias.id as categoria_evento')
            ->get();

        $evento = $this->eventosrepository->find($evento);
        //dd($categorias);

        return view('eventocategorias.index', compact('categorias','evento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['evento_id'] = $request->idv;
        $data['categoria_id'] = $request->id;
        $this->repository->create($data);
        $even['statu_id'] = '1';
        $even['situacao_id'] = '1';
        $even['destaque_id'] = '1';
        $this->eventosrepository->update($even,$request->idv);
        return \Response::json($request->id); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->repository->deleteWhere([
            'categoria_id'=>$request->id,
            'evento_id'=>$request->idv,
        ]);
        $even['statu_id'] = '1';
        $even['situacao_id'] = '1';
        $even['destaque_id'] = '1';
        $this->eventosrepository->update($even,$request->idv);
        return \Response::json($request->id); 
    }

    public function adminshow($id){
        $usuario = $id;
        $categorias = DB::table('categorias')
            ->join('evento_categorias', function ($join) use ($id) {
                $join->on('categorias.id', '=', 'evento_categorias.categoria_id')
                    ->where('evento_categorias.evento_id', '=', $id);
            })

            ->orderBy('categorias.descricao', 'asc')
            ->select('categorias.id as categoriaid', 'categorias.descricao', 'evento_categorias.id as interessesid')
            ->get();
        
        //dd($categorias);

        return view('admin.eventocategorias.adminshow', compact('categorias', 'usuario'));
    }

    private function verificaUser($evento){
        $user = Auth::user()->id;
        $evento = $this->eventosrepository->find($evento);
        if($evento->user_id != $user){
           return 1;
        }else{
            return 0;
        }
    }
}

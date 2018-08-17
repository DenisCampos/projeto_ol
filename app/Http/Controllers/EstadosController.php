<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EstadosRepository;
use Illuminate\Support\Facades\DB;

class EstadosController extends Controller
{
    protected $repository;

    public function __construct(EstadosRepository $repository){
        $this->repository = $repository;
    }

    public function index($pais)
    {
        $estados = $this->repository->orderBy('descricao')->findWhere([
            'pais_id' => $pais
        ]);
        //dd($estados);

        return view('admin.estados.index', compact('pais','estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pais)
    {
        return view('admin.estados.create', compact('pais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $pais)
    {
        $data = $request->all();
        $data['pais_id'] = $pais;
        $this->repository->create($data);
        \Session::flash('message', ' Estado criado com sucesso.');
        return redirect()->route('admin.estados.index',['pais' => $pais]);
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
    public function edit($pais,$id)
    {
        $estado = $this->repository->find($id);
        return view('admin.estados.edit', compact('pais','estado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pais, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);
        \Session::flash('message', ' Estado atualizado com sucesso.');
        return redirect()->route('admin.estados.index',['pais' => $pais]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pais, $id)
    {
        $this->repository->delete($id);
        \Session::flash('message', ' Estado deletado com sucesso.');
        return redirect()->route('admin.estados.index',['pais' => $pais]);
    }

    public function pegaestados(Request $request){

        $estados = DB::table('estados')
                     ->select('descricao','id')
                     ->where('pais_id', '=', $request->id)
                     ->orderBy('descricao')
                     ->get()
                     ->pluck('descricao','id');
        $estados->prepend('Selecione o Estado', '');
        

        return view('estados.pegaestados', compact('estados'));
    }
}

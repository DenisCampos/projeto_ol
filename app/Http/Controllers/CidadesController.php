<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PaisesRepository;
use App\Repositories\EstadosRepository;
use App\Repositories\CidadesRepository;
use Illuminate\Support\Facades\DB;

class CidadesController extends Controller
{
    protected $repository;

    public function __construct(PaisesRepository $paisesrepository, EstadosRepository $estadosrepository, CidadesRepository $repository){
        $this->repository = $repository;
        $this->estadosrepository = $estadosrepository;
        $this->paisesrepository = $paisesrepository;
    }

    public function index($pais_id, $estado_id)
    {
        $pais = $this->paisesrepository->find($pais_id);
        $estado = $this->estadosrepository->find($estado_id);
        $cidades = $this->repository->orderBy('descricao')->findWhere([
            'estado_id' => $estado->id
        ]);
        //dd($cidades);

        return view('admin.cidades.index', compact('pais','estado','cidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pais_id, $estado_id)
    {
        $pais = $this->paisesrepository->find($pais_id);
        $estado = $this->estadosrepository->find($estado_id);

        return view('admin.cidades.create', compact('pais', 'estado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $pais, $estado)
    {
        $data = $request->all();
        $data['estado_id'] = $estado;
        $this->repository->create($data);
        \Session::flash('message', ' Cidade criada com sucesso.');
        return redirect()->route('admin.cidades.index',['pais' => $pais, 'estado' => $estado]);
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
    public function edit($pais_id, $estado_id, $cidade_id)
    {
        $pais = $this->paisesrepository->find($pais_id);
        $estado = $this->estadosrepository->find($estado_id);
        $cidade = $this->repository->find($cidade_id);
        return view('admin.cidades.edit', compact('pais','estado','cidade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pais, $estado, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);
        \Session::flash('message', ' Cidade atualizada com sucesso.');
        return redirect()->route('admin.cidades.index',['pais' => $pais, 'estado' => $estado]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pais, $estado, $id)
    {
        $this->repository->delete($id);
        \Session::flash('message', ' Cidade deletada com sucesso.');
        return redirect()->route('admin.cidades.index',['pais' => $pais, 'estado' => $estado]);
    }

    public function pegacidades(Request $request){

        $cidades = DB::table('cidades')
                     ->select('descricao','id')
                     ->where('estado_id', '=', $request->id)
                     ->orderBy('descricao')
                     ->get()
                     ->pluck('descricao','id');
        $cidades->prepend('Selecione a Cidade', '');
        

        return view('cidades.pegacidades', compact('cidades'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UsersRepository;
use App\Repositories\PaisesRepository;
use App\Repositories\EstadosRepository;
use App\Repositories\CidadesRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;


class UsuariosController extends Controller
{
    protected $repository;
    private $paisesrepository, $estadosrepository, $cidadesrepository;

    public function __construct(
        UsersRepository $repository,
        PaisesRepository $paisesrepository,
        EstadosRepository $estadosrepository,
        CidadesRepository $cidadesrepository
    )
    {
        $this->repository = $repository;
        $this->paisesrepository = $paisesrepository;
        $this->estadosrepository = $estadosrepository;
        $this->cidadesrepository = $cidadesrepository; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = $this->repository->all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function tipoadmin(Request $request)
    {
        $id = $request->id;
        $data['tipo'] = '1';
        //dd($data['foto']);
        $this->repository->update($data, $id);
        return redirect()->route('admin.usuarios.index');
    }

    public function tipouser(Request $request)
    {
        $id = $request->id;
        $data['tipo'] = '0';
        //dd($data['foto']);
        $this->repository->update($data, $id);
        return redirect()->route('admin.usuarios.index');
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
        //
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
        $usuario = $this->repository->find($id);
        $paises = $this->paisesrepository->pluck('descricao','id');
        $paises->prepend('Selecione o País', '');
        $estados = $this->estadosrepository->findWhere(['pais_id' => $usuario->pais_id])->pluck('descricao','id');
        $estados->prepend('Selecione o Estado', '');
        $cidades = $this->cidadesrepository->findWhere(['estado_id' => $usuario->estado_id])->pluck('descricao','id');
        $cidades->prepend('Selecione a Cidade', '');
        return view('admin.usuarios.edit', compact('usuario', 'paises', 'estados', 'cidades'));
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
        $data = $request->all();
        if($request->hasFile('foto')){
            $extensao = $request->foto->getClientOriginalExtension();
            $file = $request->foto;
            $file->move('public/perfils', 'user'.$id.".".$extensao);
            $url = 'public/perfils/user'.$id.".".$extensao;
            $data['foto'] = $url;
        }else{
            unset($data['foto']);
        }
        //dd($data['foto']);

        $this->repository->update($data, $id);

        \Session::flash('message', ' Dados atualizados com sucesso.');

        return redirect()->route('admin.usuarios.edit',['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

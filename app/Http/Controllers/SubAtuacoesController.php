<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SubAtuacoesRepository;
use App\Repositories\AtuacoesRepository;


class SubAtuacoesController extends Controller
{

    protected $repository;
    private $atuacaorepository;

    public function __construct(SubAtuacoesRepository $repository, AtuacoesRepository $atuacaorepository){
        $this->repository = $repository;
        $this->atuacaorepository = $atuacaorepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($atuacao)
    {
        $subatuacoes = $this->repository->orderBy('descricao')->findWhere([
            'atuacao_id' => $atuacao
        ]);
        //dd($subatuacoes);

        return view('admin.subatuacoes.index', compact('atuacao','subatuacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($atuacao)
    {
        $atuacao_valor = $this->atuacaorepository->find($atuacao);
        return view('admin.subatuacoes.create', compact('atuacao','atuacao_valor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $atuacao)
    {
        $data = $request->all();
        $data['atuacao_id'] = $atuacao;
        $valor = $this->atuacaorepository->find($atuacao);
        $data['tipo'] = $valor->tipo;
        $this->repository->create($data);
        \Session::flash('message', ' SubAtuação criada com sucesso.');
        return $this->index($atuacao); 
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
    public function edit($atuacao,$id)
    {
        $subatuacao = $this->repository->find($id);
        $atuacao_valor = $this->atuacaorepository->find($atuacao);
        return view('admin.subatuacoes.edit', compact('atuacao','subatuacao','atuacao_valor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $atuacao, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);
        \Session::flash('message', ' SubAtuação atualizada com sucesso.');
        return $this->index($atuacao);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($atuacao, $id)
    {
        $this->repository->delete($id);
        \Session::flash('message', ' SubAtuação deletada com sucesso.');
        return $this->index($atuacao); 
    }
}

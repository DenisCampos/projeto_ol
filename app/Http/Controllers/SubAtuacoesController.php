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
    public function index($atuacao_id)
    {
        $subatuacoes = $this->repository->orderBy('descricao')->findWhere([
            'atuacao_id' => $atuacao_id
        ]);
        $atuacao = $this->atuacaorepository->find($atuacao_id);
        //dd($subatuacoes);

        return view('admin.subatuacoes.index', compact('atuacao','subatuacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($atuacao_id)
    {
        $atuacao = $this->atuacaorepository->find($atuacao_id);
        return view('admin.subatuacoes.create', compact('atuacao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $atuacao_id)
    {
        $data = $request->all();
        $data['atuacao_id'] = $atuacao_id;
        $data['slug'] = $this->montarSlug($data['descricao'], '');
        $atuacao = $this->atuacaorepository->find($atuacao_id);
        $data['tipo'] = $atuacao->tipo;
        $this->repository->create($data);
        \Session::flash('message', ' Sub Atuação criada com sucesso.');
        return redirect()->route('admin.subatuacoes.index', $atuacao->id); 
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
    public function edit($atuacao_id, $subatuacao_id)
    {
        $subatuacao = $this->repository->find($subatuacao_id);
        $atuacao = $this->atuacaorepository->find($atuacao_id);
        return view('admin.subatuacoes.edit', compact('subatuacao','atuacao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $atuacao_id, $subatuacao_id)
    {
        $data = $request->all();
        $data['slug'] = $this->montarSlug($data['descricao'], $subatuacao_id);
        $this->repository->update($data, $subatuacao_id);
        \Session::flash('message', ' Sub Atuação atualizada com sucesso.');
        return redirect()->route('admin.subatuacoes.index', $atuacao_id); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($atuacao_id, $subatuacao_id)
    {
        $this->repository->delete($subatuacao_id);
        \Session::flash('message', ' Sub Atuação deletada com sucesso.');
        return redirect()->route('admin.subatuacoes.index', $atuacao_id); 
    }

    private function montarSlug($titulo, $id){
        $slug = str_slug($titulo, '-');
        $slug_count = $this->repository->findByField('slug',$slug)->where('id', '!=', $id)->count();
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

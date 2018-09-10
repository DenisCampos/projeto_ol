<?php

namespace App\Http\Controllers;
use App\Repositories\AtuacoesRepository;
use App\Repositories\SubAtuacoesRepository;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AtuacoesController extends Controller
{

    protected $repository;
    private $subatuacoesrepository;

    public function __construct(AtuacoesRepository $repository, SubAtuacoesRepository $subatuacoesrepository){
        $this->repository = $repository;
        $this->subatuacoesrepository = $subatuacoesrepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atuacoes = $this->repository->orderBy('descricao')->all();
        //dd($Atuaçãos);

        return view('admin.atuacoes.index', compact('atuacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.atuacoes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = $this->montarSlug($data['descricao'],'');
        $this->repository->create($data);
        \Session::flash('message', ' Atuação criada com sucesso.');
        return redirect()->route('admin.atuacoes.index'); 
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
        $atuacao = $this->repository->find($id);
        return view('admin.atuacoes.edit', compact('atuacao'));
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
        $data['slug'] = $this->montarSlug($data['descricao'], $id);
        $this->repository->update($data, $id);
        DB::table('sub_atuacoes')
            ->where('atuacao_id', $id)
            ->update(['tipo' => $data['tipo']]);
        \Session::flash('message', ' Atuação atualizada com sucesso.');
        return redirect()->route('admin.atuacoes.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', ' Atuação deletada com sucesso.');
        return redirect()->route('admin.atuacoes.index'); 
    }

    private function montarSlug($titulo, $id){
        $slug = str_slug($titulo, '-');
        $slug_count = $this->repository->findByField('slug',$slug)->where('id', '!=', $id)->count();
        if($slug_count>0){
            $vefica_slug = $slug_count;
            while($vefica_slug>0){
                $slug_count++;
                $vefica_slug = $this->repository->findByField('slug',$slug."".$slug_count)->where('id', '!=', $id)->count();                
            }
            $slug = $slug."".$slug_count;
        }
        return $slug;
    }
}

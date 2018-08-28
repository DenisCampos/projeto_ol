<?php

namespace App\Http\Controllers;

use App\Repositories\UsersRepository;
use App\Repositories\EmpresasRepository;
use App\Repositories\EmpresaBannersRepository;
use App\Repositories\PareceresRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaBannersController extends Controller
{

    protected $repository;
    private $empresasrepository, $pareceres, $usersrepository;

    public function __construct(
        EmpresaBannersRepository $repository, 
        EmpresasRepository $empresasrepository, 
        PareceresRepository $pareceres,
        UsersRepository $usersrepository
    ){
        $this->repository = $repository;
        $this->empresasrepository = $empresasrepository;
        $this->pareceres = $pareceres;
        $this->usersrepository = $usersrepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empresa)
    {
        if($this->verificaUser($empresa)==1){
            abort(403);
        }
        $empresa = $this->empresasrepository->find($empresa);
        $banners = $this->repository->findwhere(['empresa_id' => $empresa->id]);
        return view('empresabanners.index', compact('empresa','banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($empresa)
    {
        if($this->verificaUser($empresa)==1){
            abort(403);
        }
        $empresa = $this->empresasrepository->find($empresa);
        return view('empresabanners.create', compact('empresa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $empresa)
    {
        if($this->verificaUser($empresa)==1){
            abort(403);
        }
        
        $data = $request->all();
        if($request->hasFile('banner')){
            $numero_aux = rand(1, 9999);
            $extensao = $request->banner->getClientOriginalExtension();
            $file = $request->banner;
            $file->move('public/empresas_banner', 'banner_'.$empresa."_".$numero_aux.".".$extensao);
            $url = 'public/empresas_banner/banner_'.$empresa."_".$numero_aux.".".$extensao;
            $data['banner'] = $url;
        }else{
            unset($data['banner']);
        }
        $data['empresa_id'] = $empresa;
        $data['statu_id'] = 1;
        $data['situacao_id'] = 1;

        $this->repository->create($data);
        
        \Session::flash('message', ' Banner criado com sucesso.');

        return redirect()->route('empresabanners.index',['empresa' => $empresa]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($empresa,$id)
    {
        if($this->verificaUser($empresa)==1){
            abort(403);
        }
        $banner = $this->repository->find($id);
        $empresa = $this->empresasrepository->find($empresa);
        $parecer =  $this->pareceres->scopeQuery(function($query){
            return $query->orderBy('id', 'desc');
        })->findWhere(['id_tipo'=>$id, 'tipo'=>'6'])->first();
        return view('empresabanners.show', compact('banner', 'parecer','empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($empresa, $id)
    {
        if($this->verificaUser($empresa)==1){
            abort(403);
        }
        $banner = $this->repository->find($id);
        $empresa = $this->empresasrepository->find($empresa);
        return view('empresabanners.edit', compact('banner','empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $empresa, $id)
    {
        if($this->verificaUser($empresa)==1){
            abort(403);
        }

        $data = $request->all();
        $banner = $this->repository->find($id);
        if($request->hasFile('banner')){
            @unlink($banner->banner);
            $numero_aux = rand(1, 9999);
            $extensao = $request->banner->getClientOriginalExtension();
            $file = $request->banner;
            $file->move('public/empresas_banner', 'banner_'.$empresa."_".$numero_aux.".".$extensao);
            $url = 'public/empresas_banner/banner_'.$empresa."_".$numero_aux.".".$extensao;
            $data['banner'] = $url;
        }else{
            unset($data['banner']); 
        }

        $data['statu_id'] = 1;
        $data['situacao_id'] = 1;
        $this->repository->update($data, $id);
        \Session::flash('message', ' Banner atualizados com sucesso.');

        
        return redirect()->route('empresabanners.index',['empresa' => $empresa]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($empresa, $id)
    {
        if($this->verificaUser($empresa)==1){
            abort(403);
        }

        $banner = $this->repository->find($id);

        @unlink($banner->banner);
        $this->repository->delete($id);
        \Session::flash('message', 'Banner excluida com sucesso.');

        return redirect()->route('empresabanners.index',['empresa' => $empresa]);
    }

    private function verificaUser($id){
        $user = Auth::user()->id;
        $empresa = $this->empresasrepository->find($id);
        $quantidade = $this->repository->findWhere(['empresa_id' => $id])->count();
        if($empresa->user_id != $user || $empresa->banner != 1 || $quantidade>2){
           return 1;
        }else{
            return 0;
        }
    }

    public function enviar($empresa, $id)
    {
        if($this->verificaUser($empresa)==1){
            abort(403);
        }

        $data['situacao_id'] = 2;
        $this->repository->update($data, $id);
        
        \Session::flash('message', 'Banner enviado para análise com sucesso.');

        return redirect()->route('empresabanners.index',['empresa' => $empresa]);
    }


    public function banneremps($user_id, $emp_id){
        $empresa = $this->empresasrepository->find($emp_id);
        $usuario = $this->usersrepository->find($user_id);
        $banners = $this->repository->findwhere(['empresa_id' => $empresa->id]);
        return view('admin.empresabanners.banneremps', compact('empresa','banners','usuario'));
    }

    public function adminshow($user_id, $emp_id, $banner_id)
    {
        $empresa = $this->empresasrepository->find($emp_id);
        $usuario = $this->usersrepository->find($user_id);
        $banner = $this->repository->find($banner_id);
        $parecer = $this->pareceres->scopeQuery(function($query){
            return $query->orderBy('id', 'desc');
        })->findWhere(['id_tipo'=>$empresa->id, 'tipo'=>'6'])->first();
        return view('admin.empresabanners.adminshow', compact('empresa','banner','parecer','usuario'));
    }

    public function analise(Request $request, $empresa)
    {
        $data['situacao_id'] = $request->analise;
        $data['data_inicio'] = $request->data_inicio;
        $data['data_fim'] = $request->data_fim;
        if($request->analise==3){
            $data['statu_id'] = '2';
            \Session::flash('message', 'Banner aceito e publicado.');
        }else{
            $data['statu_id'] = '1';
            \Session::flash('message', 'Banner negado e não publicado.');
        }

        $this->repository->update($data, $request->id);

        $parecer['parecer'] = $request->parecer;
        $parecer['situacao_id'] = $request->analise;
        $parecer['tipo'] = 6;
        $parecer['id_tipo'] = $request->id;
        $parecer['user_id'] = $request->user_id;
        $this->pareceres->create($parecer);

        return redirect()->route('admin.empresabanners.banneremps',['empresa' => $empresa]); 
    }
}

<?php

namespace App\Http\Controllers;

use App\Repositories\ProfissionaisRepository;
use App\Repositories\ProfissionalBannersRepository;
use App\Repositories\PareceresRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfissionalBannersController extends Controller
{
    protected $repository;
    private $profissionaisrepository, $pareceres;

    public function __construct(ProfissionalBannersRepository $repository, ProfissionaisRepository $profissionaisrepository, PareceresRepository $pareceres){
        $this->repository = $repository;
        $this->profissionaisrepository = $profissionaisrepository;
        $this->pareceres = $pareceres;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($profissional)
    {
        if($this->verificaUser($profissional)==1){
            return view('error.403');
        }
        $profissional = $this->profissionaisrepository->find($profissional);
        $banners = $this->repository->findwhere(['profissional_id' => $profissional->id]);
        return view('profissionalbanners.index', compact('profissional','banners'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($profissional)
    {
        if($this->verificaUser($profissional)==1){
            return view('error.403');
        }
        $profissional = $this->profissionaisrepository->find($profissional);
        return view('profissionalbanners.create', compact('profissional'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $profissional)
    {
        if($this->verificaUser($profissional)==1){
            return view('error.403');
        }
        
        $data = $request->all();
        if($request->hasFile('banner')){
            $numero_aux = rand(1, 9999);
            $extensao = $request->banner->getClientOriginalExtension();
            $file = $request->banner;
            $file->move('public/profissionais_banner', 'banner_'.$profissional."_".$numero_aux.".".$extensao);
            $url = 'public/profissionais_banner/banner_'.$profissional."_".$numero_aux.".".$extensao;
            $data['banner'] = $url;
        }else{
            unset($data['banner']);
        }
        $data['profissional_id'] = $profissional;
        $data['statu_id'] = 1;
        $data['situacao_id'] = 1;

        $this->repository->create($data);
        
        \Session::flash('message', ' Banner criado com sucesso.');

        return redirect()->route('profissionalbanners.index',['profissional' => $profissional]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($profissional,$id)
    {
        if($this->verificaUser($profissional)==1){
            return view('error.403');
        }
        $banner = $this->repository->find($id);
        $parecer =  $this->pareceres->scopeQuery(function($query){
            return $query->orderBy('id', 'desc');
        })->findWhere(['id_tipo'=>$id, 'tipo'=>'5'])->first();
        return view('profissionalbanners.show', compact('banner', 'parecer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($profissional,$id)
    {
        if($this->verificaUser($profissional)==1){
            return view('error.403');
        }
        $banner = $this->repository->find($id);
        return view('profissionalbanners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $profissional, $id)
    {
        if($this->verificaUser($profissional)==1){
            return view('error.403');
        }

        $data = $request->all();
        $banner = $this->repository->find($id);
        if($request->hasFile('banner')){
            @unlink($banner->banner);
            $numero_aux = rand(1, 9999);
            $extensao = $request->banner->getClientOriginalExtension();
            $file = $request->banner;
            $file->move('public/profissionais_banner', 'banner_'.$profissional."_".$numero_aux.".".$extensao);
            $url = 'public/profissionais_banner/banner_'.$profissional."_".$numero_aux.".".$extensao;
            $data['banner'] = $url;
        }else{
            unset($data['banner']); 
        }

        $data['statu_id'] = 1;
        $data['situacao_id'] = 1;
        $this->repository->update($data, $id);
        \Session::flash('message', ' Banner atualizados com sucesso.');

        
        return redirect()->route('profissionalbanners.index',['profissional' => $profissional]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($profissional, $id)
    {
        if($this->verificaUser($profissional)==1){
            return view('error.403');
        }

        $banner = $this->repository->find($id);

        @unlink($banner->banner);
        $this->repository->delete($id);
        \Session::flash('message', 'Banner excluida com sucesso.');

        return redirect()->route('profissionalbanners.index',['profissional' => $profissional]);
    }

    public function enviar($profissional, $id)
    {
        if($this->verificaUser($profissional)==1){
            return view('error.403');
        }

        $data['situacao_id'] = 2;
        $this->repository->update($data, $id);
        
        \Session::flash('message', 'Banner enviado para análise com sucesso.');

        return redirect()->route('profissionalbanners.index',['profissional' => $profissional]);
    }

    private function verificaUser($id){
        $user = Auth::user()->id;
        $profissional = $this->profissionaisrepository->find($id);
        $quantidade = $this->repository->findWhere(['profissional_id' => $id])->count();
        if($profissional->user_id != $user || $profissional->banner != 1 || $quantidade>2){
           return 1;
        }else{
            return 0;
        }
    }

    public function bannerprofs($profissional){
        $profissional = $this->profissionaisrepository->find($profissional);
        $banners = $this->repository->findwhere(['profissional_id' => $profissional->id]);
        return view('admin.profissionalbanners.bannerprofs', compact('profissional','banners'));
    }

    public function adminshow($profissional, $id)
    {
        $profissional = $this->profissionaisrepository->find($profissional);
        $banner = $this->repository->find($id);
        $parecer = $this->pareceres->scopeQuery(function($query){
            return $query->orderBy('id', 'desc');
        })->findWhere(['id_tipo'=>$profissional->id, 'tipo'=>'5'])->first();
        return view('admin.profissionalbanners.adminshow', compact('profissional','banner', 'parecer'));
    }

    public function analise(Request $request, $profissional)
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
        $parecer['tipo'] = 5;
        $parecer['id_tipo'] = $request->id;
        $parecer['user_id'] = $request->user_id;
        $this->pareceres->create($parecer);

        return redirect()->route('admin.profissionalbanners.bannerprofs',['profissional' => $profissional]); 
    }
}

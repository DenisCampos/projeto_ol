<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmpresasRepository;
use App\Repositories\EmpresaAtuacoesRepository;
use App\Repositories\EmpresaSubAtuacoesRepository;
use App\Repositories\UsersRepository;
use App\Repositories\AtuacoesRepository;
use App\Repositories\PaisesRepository;
use App\Repositories\EstadosRepository;
use App\Repositories\CidadesRepository;
use App\Repositories\PareceresRepository;
use Illuminate\Support\Facades\Auth;

class EmpresasController extends Controller
{

    protected $repository;
    private $empresaatuacoesrepository, $empresasubatuacoesrepository, $atuacoesrepository, $paisesrepository, $estadosrepository, $cidadesrepository, $usersrepository, $pareceres;

    public function __construct(
        EmpresasRepository $repository, 
        EmpresaAtuacoesRepository $empresaatuacoesrepository,
        EmpresaSubAtuacoesRepository $empresasubatuacoesrepository,
        AtuacoesRepository $atuacoesrepository, 
        PaisesRepository $paisesrepository,
        EstadosRepository $estadosrepository,
        CidadesRepository $cidadesrepository,
        UsersRepository $usersrepository,
        PareceresRepository $pareceres
    ){
        $this->repository = $repository;
        $this->empresaatuacoesrepository = $empresaatuacoesrepository;
        $this->empresasubatuacoesrepository = $empresasubatuacoesrepository;
        $this->atuacoesrepository = $atuacoesrepository;
        $this->paisesrepository = $paisesrepository;
        $this->estadosrepository = $estadosrepository;
        $this->cidadesrepository = $cidadesrepository; 
        $this->usersrepository = $usersrepository;
        $this->pareceres = $pareceres;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $empresas = $this->repository->findWhere([
            'user_id'=>$id
        ]);
        return view('empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario = $this->usersrepository->find(Auth::user()->id);
        $paises = $this->paisesrepository->pluck('descricao','id');
        $paises->prepend('Selecione o País', '');
        $estados = $this->estadosrepository->findWhere(['pais_id' => $usuario->pais_id])->pluck('descricao','id');
        $estados->prepend('Selecione o Estado', '');
        $cidades = $this->cidadesrepository->findWhere(['estado_id' => $usuario->estado_id])->pluck('descricao','id');
        $cidades->prepend('Selecione a Cidade', '');
        return view('empresas.create', compact('usuario','paises','estados','cidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $data = $request->all();
        if($data['imagem1_crop']!=""){
            $numero_aux = rand(1, 9999);
            $img = $data['imagem1_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/empresas_perfil/empresa_perfil'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/empresas_perfil/empresa_perfil'.$id."_".$numero_aux.".png";
            $data['imagem1'] = $url;
        }else{
            unset($data['imagem1']);
        }
        if($data['imagem2_crop']!=""){
            $numero_aux = rand(1, 9999);
            $img = $data['imagem2_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/empresas_perfil/empresa_foto'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/empresas_perfil/empresa_foto'.$id."_".$numero_aux.".png";
            $data['imagem2'] = $url;
        }else{
            unset($data['imagem2']);
        }
        if($data['imagem3_crop']!=""){
            $numero_aux = rand(1, 9999);
            $img = $data['imagem3_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/empresas_perfil/empresa_segunda_foto'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/empresas_perfil/empresa_segunda_foto'.$id."_".$numero_aux.".png";
            $data['imagem3'] = $url;
        }else{
            unset($data['imagem3']);
        }

        //dd($data);
        
        $data['user_id'] = $id;
        $data['statu_id'] = 1;
        $data['situacao_id'] = 1;
        $data['destaque_id'] = 1;

        $this->repository->create($data);
       
        \Session::flash('message', ' Empresa criada com sucesso.');

        $id = Auth::user()->id;
        $empresa = $this->repository->findWhere([
            'user_id'=>$id
        ])->max('id');

        return redirect()->route('empresaatuacoes.index', ['id' => $empresa]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = $this->repository->find($id);
        $atuacoes = $this->empresaatuacoesrepository->findWhere(['empresa_id'=>$empresa->id]);
        $subatuacoes = $this->empresasubatuacoesrepository->findWhere(['empresa_id'=>$empresa->id]);
        $parecer =  $this->pareceres->scopeQuery(function($query){
            return $query->orderBy('id', 'desc');
        })->findWhere(['id_tipo'=>$empresa->id, 'tipo'=>'2'])->first();
        return view('empresas.show', compact('empresa','atuacoes','subatuacoes', 'parecer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user()->id;
        $empresa = $this->repository->find($id);
        if($empresa->user_id != $user){
            abort(403);
        }
        $paises = $this->paisesrepository->pluck('descricao','id');
        $paises->prepend('Selecione o País', '');
        $estados = $this->estadosrepository->findWhere(['pais_id' => $empresa->pais_id])->pluck('descricao','id');
        $estados->prepend('Selecione o Estado', '');
        $cidades = $this->cidadesrepository->findWhere(['estado_id' => $empresa->estado_id])->pluck('descricao','id');
        $cidades->prepend('Selecione a Cidade', '');
        return view('empresas.edit', compact('empresa', 'paises', 'estados', 'cidades'));
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

        $user = Auth::user()->id;
        $empresa = $this->repository->find($id);
        if($empresa->user_id != $user){
            abort(403);
        }

        $data = $request->all();

        if($data['imagem1_crop']!=""){
            @unlink($empresa->imagem1);
            $numero_aux = rand(1, 9999);
            $img = $data['imagem1_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/empresas_perfil/empresa_perfil'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/empresas_perfil/empresa_perfil'.$id."_".$numero_aux.".png";
            $data['imagem1'] = $url;
        }else{
            unset($data['imagem1']);
        }
        if($data['imagem2_crop']!=""){
            @unlink($empresa->imagem2);
            $numero_aux = rand(1, 9999);
            $img = $data['imagem2_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/empresas_perfil/empresa_foto'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/empresas_perfil/empresa_foto'.$id."_".$numero_aux.".png";
            $data['imagem2'] = $url;
        }else{
            unset($data['imagem2']);
        }
        if($data['imagem3_crop']!=""){
            @unlink($empresa->imagem3);
            $numero_aux = rand(1, 9999);
            $img = $data['imagem3_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/empresas_perfil/empresa_segunda_foto'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/empresas_perfil/empresa_segunda_foto'.$id."_".$numero_aux.".png";
            $data['imagem2'] = $url;
        }else{
            unset($data['imagem3']);
        }

        $data['statu_id'] = 1;
        $data['situacao_id'] = 1;
        $data['destaque_id'] = 1;
        $this->repository->update($data, $id);
        \Session::flash('message', ' Dados atualizados com sucesso.');

        return redirect()->route('empresas.index'); 
    }

    public function enviar($id)
    {
        $user = Auth::user()->id;
        $empresa = $this->repository->find($id);
        if($empresa->user_id != $user){
            abort(403);
        }

        $data['situacao_id'] = 2;
        $this->repository->update($data, $id);
        
        \Session::flash('message', 'Empresa enviada para análise com sucesso.');

        return redirect()->route('empresas.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user()->id;
        $empresa = $this->repository->find($id);
        if($empresa->user_id != $user){
            abort(403);
        }
        @unlink($empresa->imagem1);
        if($empresa->imagem2!=""){
            @unlink($empresa->imagem2);
        }
        if($empresa->imagem3!=""){
            @unlink($empresa->imagem3);
        }
        $this->empresaatuacoesrepository->deleteWhere([
            'empresa_id'=>$id,
        ]);
        $this->empresasubatuacoesrepository->deleteWhere([
            'empresa_id'=>$id,
        ]);
        $this->repository->delete($id);
        \Session::flash('message', 'Empresa excluida com sucesso.');

        return redirect()->route('empresas.index'); 
    }

    public function useremps($id){
        $usuario = $id;
        $empresas = $this->repository->findWhere([
            'user_id'=>$id
        ]);
        return view('admin.empresas.useremps', compact('empresas','usuario'));
    }

    public function liberabanner(Request $request){
        $data['banner'] = $request->banner;
        $this->repository->update($data, $request->id);

        return $request->banne;
    }

    public function liberadestaque(Request $request){
        $data['destaque_id'] = $request->destaque_id;
        $this->repository->update($data, $request->id);

        return $request->banne;
    }

    public function adminshow($id)
    {
        $empresa = $this->repository->find($id);
        $atuacoes = $this->empresaatuacoesrepository->findWhere(['empresa_id'=>$empresa->id]);
        $subatuacoes = $this->empresasubatuacoesrepository->findWhere(['empresa_id'=>$empresa->id]);
        $parecer =  $this->pareceres->scopeQuery(function($query){
            return $query->orderBy('id', 'desc');
        })->findWhere(['id_tipo'=>$empresa->id, 'tipo'=>'2'])->first();
        return view('admin.empresas.adminshow', compact('empresa','atuacoes','subatuacoes', 'parecer'));
    }

    public function analise(Request $request)
    {
        $data['situacao_id'] = $request->analise;
        if($request->analise==3){
            $data['statu_id'] = '2';
            \Session::flash('message', 'Empresa aceita e publicada.');
        }else{
            $data['statu_id'] = '1';
            \Session::flash('message', 'Empresa negada e não publicada.');
        }
        //dd($id);


        $this->repository->update($data, $request->id);

        $parecer['parecer'] = $request->parecer;
        $parecer['situacao_id'] = $request->analise;
        $parecer['tipo'] = 2;
        $parecer['id_tipo'] = $request->id;
        $parecer['user_id'] = $request->user_id;
        $this->pareceres->create($parecer);

        return redirect()->route('admin.empresas.enviados'); 
    }
 
    public function enviados()
    {
        $empresas = $this->repository->findWhere([
            'situacao_id'=>'2'
        ]);
        return view('admin.empresas.enviados', compact('empresas'));
    }

    public function aprovados()
    {
        $empresas = $this->repository->findWhere([
            'situacao_id'=>'3'
        ]);
        return view('admin.empresas.aprovados', compact('empresas'));
    }

    public function negados()
    {
        $empresas = $this->repository->findWhere([
            'situacao_id'=>'4'
        ]);
        return view('admin.empresas.negados', compact('empresas'));
    }
}

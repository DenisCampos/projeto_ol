<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProfissionaisRepository;
use App\Repositories\ProfissionalAtuacoesRepository;
use App\Repositories\ProfissionalSubAtuacoesRepository;
use App\Repositories\ProfissionalBannersRepository;
use App\Repositories\UsersRepository;
use App\Repositories\AtuacoesRepository;
use App\Repositories\PaisesRepository;
use App\Repositories\EstadosRepository;
use App\Repositories\CidadesRepository;
use App\Repositories\PareceresRepository;
use Illuminate\Support\Facades\Auth;


class ProfissionaisController extends Controller
{

    protected $repository;
    private $profissionalatuacoesrepository, $profissionalsubatuacoesrepository, $profissionalbannersrepository, $atuacoesrepository, $paisesrepository, $estadosrepository, $cidadesrepository, $usersrepository, $pareceres;

    public function __construct(
        ProfissionaisRepository $repository, 
        ProfissionalAtuacoesRepository $profissionalatuacoesrepository,
        ProfissionalSubAtuacoesRepository $profissionalsubatuacoesrepository,
        ProfissionalBannersRepository $profissionalbannersrepository,
        AtuacoesRepository $atuacoesrepository, 
        PaisesRepository $paisesrepository,
        EstadosRepository $estadosrepository,
        CidadesRepository $cidadesrepository,
        UsersRepository $usersrepository,
        PareceresRepository $pareceres
    ){
        $this->repository = $repository;
        $this->profissionalatuacoesrepository = $profissionalatuacoesrepository;
        $this->profissionalsubatuacoesrepository = $profissionalsubatuacoesrepository;
        $this->profissionalbannersrepository = $profissionalbannersrepository;
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
        $profissionais = $this->repository->findWhere([
            'user_id'=>$id
        ]);
        return view('profissionais.index', compact('profissionais'));
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
        return view('profissionais.create', compact('usuario','paises','estados','cidades'));
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
        if($data['foto_crop']!=""){
            $numero_aux = rand(1, 9999);
            $img = $data['foto_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/profissionais_perfil/profissional'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/profissionais_perfil/profissional'.$id."_".$numero_aux.".png";
            $data['foto'] = $url;
        }else{
            unset($data['foto']);
        }


        $data['user_id'] = $id;
        $data['statu_id'] = 1;
        $data['situacao_id'] = 1;
        $data['destaque_id'] = 1;
        $data['slug'] = $this->montarSlug($data['name'], '');
        $this->repository->create($data);
        
        \Session::flash('message', ' Profissão criada com sucesso.');

        $id = Auth::user()->id;
        $profissional = $this->repository->findWhere([
            'user_id'=>$id
        ])->max('id');

        return redirect()->route('profissionalatuacoes.index', ['id' => $profissional]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profissional = $this->repository->find($id);
        $atuacoes = $this->profissionalatuacoesrepository->findWhere(['profissional_id'=>$profissional->id]);
        $subatuacoes = $this->profissionalsubatuacoesrepository->findWhere(['profissional_id'=>$profissional->id]);
        $parecer =  $this->pareceres->scopeQuery(function($query){
            return $query->orderBy('id', 'desc');
        })->findWhere(['id_tipo'=>$profissional->id, 'tipo'=>'1'])->first();


        //dd($parecer);

        return view('profissionais.show', compact('profissional','atuacoes', 'subatuacoes', 'parecer'));
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
        $profissional = $this->repository->find($id);
        if($profissional->user_id != $user){
            abort(403);
        }
        $paises = $this->paisesrepository->pluck('descricao','id');
        $paises->prepend('Selecione o País', '');
        $estados = $this->estadosrepository->findWhere(['pais_id' => $profissional->pais_id])->pluck('descricao','id');
        $estados->prepend('Selecione o Estado', '');
        $cidades = $this->cidadesrepository->findWhere(['estado_id' => $profissional->estado_id])->pluck('descricao','id');
        $cidades->prepend('Selecione a Cidade', '');
        return view('profissionais.edit', compact('profissional', 'paises', 'estados', 'cidades'));

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
        $profissional = $this->repository->find($id);
        if($profissional->user_id != $user){
            abort(403);
        }

        $data = $request->all();

        if($data['foto_crop']!=""){
            @unlink($profissional->foto);
            $numero_aux = rand(1, 9999);
            $img = $data['foto_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/profissionais_perfil/profissional'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/profissionais_perfil/profissional'.$id."_".$numero_aux.".png";
            $data['foto'] = $url;
        }else{
            unset($data['foto']);
        }

        $data['statu_id'] = 1;
        $data['situacao_id'] = 1;
        $data['destaque_id'] = 1;
        $data['slug'] = $this->montarSlug($data['name'], $id);
        $this->repository->update($data, $id);
        \Session::flash('message', ' Dados atualizados com sucesso.');

        
        return redirect()->route('profissionais.index');   
    }

    public function enviar($id)
    {
        $user = Auth::user()->id;
        $profissional = $this->repository->find($id);
        if($profissional->user_id != $user){
            abort(403);
        }

        $data['situacao_id'] = 2;
        $this->repository->update($data, $id);
        
        \Session::flash('message', 'Profissão enviada para análise com sucesso.');

        return redirect()->route('profissionais.index');
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
        $profissional = $this->repository->find($id);
        if($profissional->user_id != $user){
            abort(403);
        }
        @unlink($profissional->foto);
        $this->profissionalatuacoesrepository->deleteWhere([
            'profissional_id'=>$id,
        ]);
        $this->profissionalsubatuacoesrepository->deleteWhere([
            'profissional_id'=>$id,
        ]);
        $banners = $this->profissionalbannersrepository->findwhere(['profissional_id' => $profissional->id]);
        foreach($banners as $banner){
            @unlink($banner->banner);
        }
        $this->profissionalbannersrepository->deleteWhere([
            'profissional_id'=>$id,
        ]);


        $this->repository->delete($id);
        \Session::flash('message', 'Profissão excluida com sucesso.');

        return redirect()->route('profissionais.index'); 
    }

    public function userprofs($id){
        $profissionais = $this->repository->findWhere([
            'user_id'=>$id
        ]);
        $usuario = $this->usersrepository->find($id);

        return view('admin.profissionais.userprofs', compact('profissionais','usuario'));
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

    public function admincreate($user_id)
    {
        $usuario = $this->usersrepository->find($user_id);
        $paises = $this->paisesrepository->pluck('descricao','id');
        $paises->prepend('Selecione o País', '');
        $estados = $this->estadosrepository->findWhere(['pais_id' => $usuario->pais_id])->pluck('descricao','id');
        $estados->prepend('Selecione o Estado', '');
        $cidades = $this->cidadesrepository->findWhere(['estado_id' => $usuario->estado_id])->pluck('descricao','id');
        $cidades->prepend('Selecione a Cidade', '');
        return view('admin.profissionais.admincreate', compact('usuario','paises','estados','cidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminstore(Request $request, $user_id)
    {
        $data = $request->all();
        if($data['foto_crop']!=""){
            $numero_aux = rand(1, 9999);
            $img = $data['foto_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/profissionais_perfil/profissional'.$user_id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/profissionais_perfil/profissional'.$user_id."_".$numero_aux.".png";
            $data['foto'] = $url;
        }else{
            unset($data['foto']);
        }


        $data['user_id'] = $user_id;
        $data['statu_id'] = 1;
        $data['situacao_id'] = 1;
        $data['destaque_id'] = 1;
        $data['slug'] = $this->montarSlug($data['name'], '');
        $this->repository->create($data);
        
        \Session::flash('message', ' Profissão criada com sucesso.');

        $profissional = $this->repository->findWhere([
            'user_id'=>$user_id
        ])->max('id');

        $usuario = $this->usersrepository->find($user_id);

        return redirect()->route('admin.profissionalatuacoes.adminindex', [$usuario, $profissional]);
    }

    public function adminshow($user_id, $prof_id)
    {
        $profissional = $this->repository->find($prof_id);
        $usuario = $this->usersrepository->find($user_id);
        $atuacoes = $this->profissionalatuacoesrepository->findWhere(['profissional_id'=>$profissional->id]);
        $subatuacoes = $this->profissionalsubatuacoesrepository->findWhere(['profissional_id'=>$profissional->id]);
        $parecer =  $this->pareceres->scopeQuery(function($query){
            return $query->orderBy('id', 'desc');
        })->findWhere(['id_tipo'=>$profissional->id, 'tipo'=>'1'])->first();
        return view('admin.profissionais.adminshow', compact('profissional','atuacoes','subatuacoes','parecer', 'usuario'));
    }

    public function adminedit($user_id, $prof_id)
    {
        $profissional = $this->repository->find($prof_id); 
        $usuario = $this->usersrepository->find($user_id);
        $paises = $this->paisesrepository->pluck('descricao','id');
        $paises->prepend('Selecione o País', '');
        $estados = $this->estadosrepository->findWhere(['pais_id' => $profissional->pais_id])->pluck('descricao','id');
        $estados->prepend('Selecione o Estado', '');
        $cidades = $this->cidadesrepository->findWhere(['estado_id' => $profissional->estado_id])->pluck('descricao','id');
        $cidades->prepend('Selecione a Cidade', '');
        return view('admin.profissionais.adminedit', compact('profissional', 'paises', 'estados', 'cidades', 'usuario'));
    }

    public function adminupdate(Request $request, $id)
    {
        $data = $request->all();
        if($data['foto_crop']!=""){
            @unlink($profissional->foto);
            $numero_aux = rand(1, 9999);
            $img = $data['foto_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/profissionais_perfil/profissional'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/profissionais_perfil/profissional'.$id."_".$numero_aux.".png";
            $data['foto'] = $url;
        }else{
            unset($data['foto']);
        }

        $data['slug'] = $this->montarSlug($data['name'], $id);
        $this->repository->update($data, $id);
        $profissional = $this->repository->find($id); 
        $usuario = $this->usersrepository->find($profissional->user_id);
        \Session::flash('message', ' Dados atualizados com sucesso.');

        return redirect()->route('admin.profissionalatuacoes.adminindex', [$usuario, $profissional]); 
    }

    public function admindestroy($user_id, $prof_id)
    {
        $usuario = $this->usersrepository->find($user_id);
        $profissional = $this->repository->find($prof_id); 

        @unlink($profissional->foto);
        $this->profissionalatuacoesrepository->deleteWhere([
            'profissional_id'=>$profissional->id,
        ]);
        $this->profissionalsubatuacoesrepository->deleteWhere([
            'profissional_id'=>$profissional->id,
        ]);
        $banners = $this->profissionalbannersrepository->findwhere(['profissional_id' => $profissional->id]);
        foreach($banners as $banner){
            @unlink($banner->banner);
        }
        $this->profissionalbannersrepository->deleteWhere([
            'profissional_id'=>$profissional->id,
        ]);


        $this->repository->delete($profissional->id);
        \Session::flash('message', 'Profissão excluida com sucesso.');

        return redirect()->route('admin.profissionais.userprofs', [$usuario, $profissional]); 
    }

    public function analise(Request $request)
    {
        $data['situacao_id'] = $request->analise;
        if($request->analise==3){
            $data['statu_id'] = '2';
            \Session::flash('message', 'Profissão aceita e publicada.');
        }else{
            $data['statu_id'] = '1';
            \Session::flash('message', 'Profissão negada e não publicada.');
        }
        //dd($id);


        $this->repository->update($data, $request->id);

        $parecer['parecer'] = $request->parecer;
        $parecer['situacao_id'] = $request->analise;
        $parecer['tipo'] = 1;
        $parecer['id_tipo'] = $request->id;
        $parecer['user_id'] = $request->user_id;
        $this->pareceres->create($parecer);

        return redirect()->route('admin.profissionais.enviados'); 
    }

    public function enviados()
    {
        $profissionais = $this->repository->findWhere([
            'situacao_id'=>'2'
        ]);
        return view('admin.profissionais.enviados', compact('profissionais'));
    }

    public function aprovados()
    {
        $profissionais = $this->repository->findWhere([
            'situacao_id'=>'3'
        ]);
        return view('admin.profissionais.aprovados', compact('profissionais'));
    }

    public function negados()
    {
        $profissionais = $this->repository->findWhere([
            'situacao_id'=>'4'
        ]);
        return view('admin.profissionais.negados', compact('profissionais'));
    }

    private function montarSlug($titulo, $id){
        $slug = str_slug($titulo, '-');
        $slug_count = $this->repository->findByField('slug',$slug)->where('id', '!=', $id)->count();
        //dd($slug_count);
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

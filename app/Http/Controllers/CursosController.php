<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CursosRepository;
use App\Repositories\UsersRepository;
use App\Repositories\CursoCategoriasRepository;
use App\Repositories\PaisesRepository;
use App\Repositories\EstadosRepository;
use App\Repositories\CidadesRepository;
use App\Repositories\PareceresRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;;

class CursosController extends Controller
{

    protected $repository;
    private $cursocategoriasrepository, $paisesrepository, $estadosrepository, $cidadesrepository, $usersrepository, $pareceres;

    public function __construct(
        CursosRepository $repository, 
        CursoCategoriasRepository $cursocategoriasrepository, 
        PaisesRepository $paisesrepository,
        EstadosRepository $estadosrepository,
        CidadesRepository $cidadesrepository,
        UsersRepository $usersrepository,
        PareceresRepository $pareceres
    ){
        $this->repository = $repository;
        $this->cursocategoriasrepository = $cursocategoriasrepository;
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
        $cursos = $this->repository->findWhere([
            'user_id'=>$id
        ]);
        return view('cursos.index', compact('cursos'));
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
        return view('cursos.create', compact('paises','estados','cidades'));
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
        if($request->hasFile('imagem1')){
            $numero_aux = rand(1, 9999);
            $extensao = $request->imagem1->getClientOriginalExtension();
            $file = $request->imagem1;
            $file->move('public/cursos_imagens', 'curso_logo'.$id."_".$numero_aux.".".$extensao);
            $url = 'public/cursos_imagens/curso_logo'.$id."_".$numero_aux.".".$extensao;
            $data['imagem1'] = $url;
        }else{
            unset($data['imagem1']);
        }
        if($request->hasFile('imagem2')){
            $numero_aux = rand(1, 9999);
            $extensao = $request->imagem2->getClientOriginalExtension();
            $file = $request->imagem2;
            $file->move('public/cursos_imagens', 'curso_foto'.$id."_".$numero_aux.".".$extensao);
            $url = 'public/cursos_imagens/curso_foto'.$id."_".$numero_aux.".".$extensao;
            $data['imagem2'] = $url;
        }else{
            unset($data['imagem2']);
        }

        $data['user_id'] = $id;
        $data['statu_id'] = 1;
        $data['situacao_id'] = 1;
        $data['destaque_id'] = 1;

        $this->repository->create($data);
       
        \Session::flash('message', ' Infoproduto criado com sucesso.');

        $id = Auth::user()->id;
        $curso = $this->repository->findWhere([
            'user_id'=>$id
        ])->max('id');

        return redirect()->route('cursocategorias.index', ['id' => $curso]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = $this->repository->find($id);
        $categorias = $this->cursocategoriasrepository->findWhere(['curso_id'=>$curso->id]);
        $parecer =  $this->pareceres->scopeQuery(function($query){
            return $query->orderBy('id', 'desc');
        })->findWhere(['id_tipo'=>$curso->id, 'tipo'=>'3'])->first();

        if($curso->data_inicio!=""){
            $curso->data_inicio = Carbon::createFromFormat('Y-m-d H:i:s', $curso->data_inicio)->format('d/m/Y H:i:s');
        }
        if($curso->data_inicio!=""){
            $curso->data_fim = Carbon::createFromFormat('Y-m-d H:i:s', $curso->data_fim)->format('d/m/Y H:i:s');
        }
        return view('cursos.show', compact('curso','categorias', 'parecer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($this->verificaUser($id)==1){
            return view('error.403');
        }
        $user = Auth::user()->id;
        $curso = $this->repository->find($id);
        $paises = $this->paisesrepository->pluck('descricao','id');
        $paises->prepend('Selecione o País', '');
        $estados = $this->estadosrepository->findWhere(['pais_id' => $curso->pais_id])->pluck('descricao','id');
        $estados->prepend('Selecione o Estado', '');
        $cidades = $this->cidadesrepository->findWhere(['estado_id' => $curso->estado_id])->pluck('descricao','id');
        $cidades->prepend('Selecione a Cidade', '');
        if($curso->data_inicio!=""){
            $curso->data_inicio = Carbon::createFromFormat('Y-m-d H:i:s', $curso->data_inicio)->format('Y-m-d\TH:i:s');
        }
        if($curso->data_inicio!=""){
            $curso->data_fim = Carbon::createFromFormat('Y-m-d H:i:s', $curso->data_fim)->format('Y-m-d\TH:i:s');
        }
        return view('cursos.edit', compact('curso', 'paises', 'estados', 'cidades'));
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
        if($this->verificaUser($id)==1){
            return view('error.403');
        }

        $curso = $this->repository->find($id);
        $data = $request->all();
        
        if($request->hasFile('imagem1')){
            @unlink($curso->imagem1);
            $numero_aux = rand(1, 9999);
            $extensao = $request->imagem1->getClientOriginalExtension();
            $file = $request->imagem1;
            $file->move('public/cursos_imagens', 'curso_logo'.$id."_".$numero_aux.".".$extensao);
            $url = 'public/cursos_imagens/curso_logo'.$id."_".$numero_aux.".".$extensao;
            $data['imagem1'] = $url;
        }else{
            unset($data['imagem1']); 
        }

        if($request->hasFile('imagem2')){
            @unlink($curso->imagem2);
            $numero_aux = rand(1, 9999);
            $extensao = $request->imagem2->getClientOriginalExtension();
            $file = $request->imagem2;
            $file->move('public/cursos_imagens', 'curso_foto'.$id."_".$numero_aux.".".$extensao);
            $url = 'public/cursos_imagens/curso_foto'.$id."_".$numero_aux.".".$extensao;
            $data['imagem2'] = $url;
        }else{
            unset($data['imagem2']); 
        }
      
        $data['statu_id'] = 1;
        $data['situacao_id'] = 1;
        $data['destaque_id'] = 1;
        $this->repository->update($data, $id);
        \Session::flash('message', ' Dados atualizados com sucesso.');

        return redirect()->route('cursos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->verificaUser($id)==1){
            return view('error.403');
        }

        $curso = $this->repository->find($id);

        @unlink($curso->imagem1);
        if($curso->imagem2!=""){
            @unlink($curso->imagem2);
        }
        $this->cursocategoriasrepository->deleteWhere([
            'curso_id'=>$id,
        ]);
        $this->repository->delete($id);
        \Session::flash('message', 'Infoproduto excluido com sucesso.');

        return redirect()->route('cursos.index');
    }

    public function enviar($id)
    {
        if($this->verificaUser($id)==1){
            return view('error.403');
        }

        $data['situacao_id'] = 2;
        $this->repository->update($data, $id);
        
        \Session::flash('message', 'Infoproduto enviado para análise com sucesso.');

        return redirect()->route('cursos.index');
    }

    private function verificaUser($curso){
        $user = Auth::user()->id;
        $curso = $this->repository->find($curso);
        if($curso->user_id != $user){
           return 1;
        }else{
            return 0;
        }
    }

    public function liberadestaque(Request $request){
        $data['destaque_id'] = $request->destaque_id;
        $this->repository->update($data, $request->id);

        return $request->banne;
    }

    public function adminshow($id)
    {
        $curso = $this->repository->find($id);
        $categorias = $this->cursocategoriasrepository->findWhere(['curso_id'=>$curso->id]);
        $parecer =  $this->pareceres->scopeQuery(function($query){
            return $query->orderBy('id', 'desc');
        })->findWhere(['id_tipo'=>$curso->id, 'tipo'=>'3'])->first();

        if($curso->data_inicio!=""){
            $curso->data_inicio = Carbon::createFromFormat('Y-m-d H:i:s', $curso->data_inicio)->format('d/m/Y H:i:s');
        }
        if($curso->data_inicio!=""){
            $curso->data_fim = Carbon::createFromFormat('Y-m-d H:i:s', $curso->data_fim)->format('d/m/Y H:i:s');
        }

        return view('admin.cursos.adminshow', compact('curso','categorias', 'parecer'));
    }

    public function analise(Request $request)
    {
        $data['situacao_id'] = $request->analise;
        if($request->analise==3){
            $data['statu_id'] = '2';
            \Session::flash('message', 'Infoproduto aceito e publicada.');
        }else{
            $data['statu_id'] = '1';
            \Session::flash('message', 'Infoproduto negado e não publicada.');
        }
        //dd($id);


        $this->repository->update($data, $request->id);

        $parecer['parecer'] = $request->parecer;
        $parecer['situacao_id'] = $request->analise;
        $parecer['tipo'] = 3;
        $parecer['id_tipo'] = $request->id;
        $parecer['user_id'] = $request->user_id;
        $this->pareceres->create($parecer);

        return redirect()->route('admin.cursos.enviados');
    }
 
    public function enviados()
    {
        $cursos = $this->repository->findWhere([
            'situacao_id'=>'2'
        ]);
        return view('admin.cursos.enviados', compact('cursos'));
    }

    public function aprovados()
    {
        $cursos = $this->repository->findWhere([
            'situacao_id'=>'3'
        ]);
        return view('admin.cursos.aprovados', compact('cursos'));
    }

    public function negados()
    {
        $cursos = $this->repository->findWhere([
            'situacao_id'=>'4'
        ]);
        return view('admin.cursos.negados', compact('cursos'));
    }
}

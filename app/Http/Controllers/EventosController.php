<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EventosRepository;
use App\Repositories\UsersRepository;
use App\Repositories\EventoCategoriasRepository;
use App\Repositories\PaisesRepository;
use App\Repositories\EstadosRepository;
use App\Repositories\CidadesRepository;
use App\Repositories\PareceresRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class EventosController extends Controller
{

    protected $repository;
    private $eventocategoriasrepository, $paisesrepository, $estadosrepository, $cidadesrepository, $usersrepository, $pareceres;

    public function __construct(
        EventosRepository $repository, 
        EventoCategoriasRepository $eventocategoriasrepository, 
        PaisesRepository $paisesrepository,
        EstadosRepository $estadosrepository,
        CidadesRepository $cidadesrepository,
        UsersRepository $usersrepository,
        PareceresRepository $pareceres
    ){
        $this->repository = $repository;
        $this->eventocategoriasrepository = $eventocategoriasrepository;
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
        $eventos = $this->repository->findWhere([
            'user_id'=>$id
        ]);
        return view('eventos.index', compact('eventos'));
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
        return view('eventos.create', compact('paises','estados','cidades'));
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

        //dd($data);
        if($data['imagem1_crop']!=""){
            $numero_aux = rand(1, 9999);
            $img = $data['imagem1_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/eventos_imagens/evento_logo'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/eventos_imagens/evento_logo'.$id."_".$numero_aux.".png";
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
            $file = 'public/eventos_imagens/evento_foto'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/eventos_imagens/evento_foto'.$id."_".$numero_aux.".png";
            $data['imagem2'] = $url;
        }else{
            unset($data['imagem2']);
        }

        $data['user_id'] = $id;
        $data['statu_id'] = 1;
        $data['situacao_id'] = 1;
        $data['destaque_id'] = 1;

        $this->repository->create($data);
       
        \Session::flash('message', ' Evento criado com sucesso.');

        $id = Auth::user()->id;
        $evento = $this->repository->findWhere([
            'user_id'=>$id
        ])->max('id');

        return redirect()->route('eventocategorias.index', ['id' => $evento]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evento = $this->repository->find($id);
        $categorias = $this->eventocategoriasrepository->findWhere(['evento_id'=>$evento->id]);
        $parecer =  $this->pareceres->scopeQuery(function($query){
            return $query->orderBy('id', 'desc');
        })->findWhere(['id_tipo'=>$evento->id, 'tipo'=>'4'])->first();

        $evento->data_inicio = Carbon::createFromFormat('Y-m-d H:i:s', $evento->data_inicio)->format('d/m/Y H:i:s');
        $evento->data_fim = Carbon::createFromFormat('Y-m-d H:i:s', $evento->data_fim)->format('d/m/Y H:i:s');
        return view('eventos.show', compact('evento','categorias', 'parecer'));
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
            abort(403);
        }
        $user = Auth::user()->id;
        $evento = $this->repository->find($id);
        $paises = $this->paisesrepository->pluck('descricao','id');
        $paises->prepend('Selecione o País', '');
        $estados = $this->estadosrepository->findWhere(['pais_id' => $evento->pais_id])->pluck('descricao','id');
        $estados->prepend('Selecione o Estado', '');
        $cidades = $this->cidadesrepository->findWhere(['estado_id' => $evento->estado_id])->pluck('descricao','id');
        $cidades->prepend('Selecione a Cidade', '');
        $evento->data_inicio = Carbon::createFromFormat('Y-m-d H:i:s', $evento->data_inicio)->format('Y-m-d\TH:i:s');
        $evento->data_fim = Carbon::createFromFormat('Y-m-d H:i:s', $evento->data_fim)->format('Y-m-d\TH:i:s');
        return view('eventos.edit', compact('evento', 'paises', 'estados', 'cidades'));
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
            abort(403);
        }

        $evento = $this->repository->find($id);
        $data = $request->all();
        
        if($data['imagem1_crop']!=""){
            @unlink($evento->imagem1);
            $numero_aux = rand(1, 9999);
            $img = $data['imagem1_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/eventos_imagens/evento_logo'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/eventos_imagens/evento_logo'.$id."_".$numero_aux.".png";
            $data['imagem1'] = $url;
        }else{
            unset($data['imagem1']); 
        }

        if($data['imagem2_crop']!=""){
            @unlink($evento->imagem2);
            $numero_aux = rand(1, 9999);
            $img = $data['imagem2_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/eventos_imagens/evento_foto'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/eventos_imagens/evento_foto'.$id."_".$numero_aux.".png";
            $data['imagem2'] = $url;
        }else{
            unset($data['imagem2']); 
        }
      
        $data['statu_id'] = 1;
        $data['situacao_id'] = 1;
        $data['destaque_id'] = 1;
        $this->repository->update($data, $id);
        \Session::flash('message', ' Dados atualizados com sucesso.');

        return redirect()->route('eventos.index');
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
            abort(403);
        }

        $evento = $this->repository->find($id);

        @unlink($evento->imagem1);
        if($evento->imagem2!=""){
            @unlink($evento->imagem2);
        }
        $this->eventocategoriasrepository->deleteWhere([
            'evento_id'=>$id,
        ]);
        $this->repository->delete($id);
        \Session::flash('message', 'Evento excluido com sucesso.');

        return redirect()->route('eventos.index');
    }

    public function enviar($id)
    {
        if($this->verificaUser($id)==1){
            abort(403);
        }

        $data['situacao_id'] = 2;
        $this->repository->update($data, $id);
        
        \Session::flash('message', 'Evento enviado para análise com sucesso.');

        return redirect()->route('eventos.index');
    }

    private function verificaUser($evento){
        $user = Auth::user()->id;
        $evento = $this->repository->find($evento);
        if($evento->user_id != $user){
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
        $evento = $this->repository->find($id);
        $categorias = $this->eventocategoriasrepository->findWhere(['evento_id'=>$evento->id]);
        $parecer =  $this->pareceres->scopeQuery(function($query){
            return $query->orderBy('id', 'desc');
        })->findWhere(['id_tipo'=>$evento->id, 'tipo'=>'4'])->first();
        $evento->data_inicio = Carbon::createFromFormat('Y-m-d H:i:s', $evento->data_inicio)->format('d/m/Y H:i:s');
        $evento->data_fim = Carbon::createFromFormat('Y-m-d H:i:s', $evento->data_fim)->format('d/m/Y H:i:s');

        return view('admin.eventos.adminshow', compact('evento','categorias', 'parecer'));
    }

    public function adminedit(Request $request,$id)
    {
        $data = $request->all();
        $returnevent = $data['returnevent'];
        $redirect_to = $data['redirect_to'];
        $evento = $this->repository->find($id);
        $paises = $this->paisesrepository->pluck('descricao','id');
        $paises->prepend('Selecione o País', '');
        $estados = $this->estadosrepository->findWhere(['pais_id' => $evento->pais_id])->pluck('descricao','id');
        $estados->prepend('Selecione o Estado', '');
        $cidades = $this->cidadesrepository->findWhere(['estado_id' => $evento->estado_id])->pluck('descricao','id');
        $cidades->prepend('Selecione a Cidade', '');
        $evento->data_inicio = Carbon::createFromFormat('Y-m-d H:i:s', $evento->data_inicio)->format('Y-m-d\TH:i:s');
        $evento->data_fim = Carbon::createFromFormat('Y-m-d H:i:s', $evento->data_fim)->format('Y-m-d\TH:i:s');
        return view('admin.eventos.adminedit', compact('evento', 'paises', 'estados', 'cidades','returnevent', 'redirect_to'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adminupdate(Request $request, $id)
    {
        $evento = $this->repository->find($id);
        $data = $request->all();
        $returnevent = $data['returnevent'];
        if($data['imagem1_crop']!=""){
            @unlink($evento->imagem1);
            $numero_aux = rand(1, 9999);
            $img = $data['imagem1_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/eventos_imagens/evento_logo'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/eventos_imagens/evento_logo'.$id."_".$numero_aux.".png";
            $data['imagem1'] = $url;
        }else{
            unset($data['imagem1']); 
        }

        if($data['imagem2_crop']!=""){
            @unlink($evento->imagem2);
            $numero_aux = rand(1, 9999);
            $img = $data['imagem2_crop'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $arquivo = base64_decode($img);
            $file = 'public/eventos_imagens/evento_foto'.$id."_".$numero_aux.".png";
            $success = file_put_contents($file, $arquivo);
            $url = 'public/eventos_imagens/evento_foto'.$id."_".$numero_aux.".png";
            $data['imagem2'] = $url;
        }else{
            unset($data['imagem2']); 
        }
      
        $this->repository->update($data, $id);
        \Session::flash('message', ' Dados atualizados com sucesso.');

        return redirect()->route('admin.eventos.adminshow', ['id' => $evento, 'returnevent' => $returnevent]);
    }

    public function analise(Request $request)
    {
        $data['situacao_id'] = $request->analise;
        if($request->analise==3){
            $data['statu_id'] = '2';
            \Session::flash('message', 'Evento aceito e publicada.');
        }else{
            $data['statu_id'] = '1';
            \Session::flash('message', 'Evento negado e não publicada.');
        }
        //dd($id);


        $this->repository->update($data, $request->id);

        $parecer['parecer'] = $request->parecer;
        $parecer['situacao_id'] = $request->analise;
        $parecer['tipo'] = 4;
        $parecer['id_tipo'] = $request->id;
        $parecer['user_id'] = $request->user_id;
        $this->pareceres->create($parecer);

        return redirect()->route('admin.eventos.enviados');
    }
 
    public function enviados()
    {
        $eventos = $this->repository->findWhere([
            'situacao_id'=>'2'
        ]);
        return view('admin.eventos.enviados', compact('eventos'));
    }

    public function aprovados()
    {
        $eventos = $this->repository->findWhere([
            'situacao_id'=>'3'
        ]);
        return view('admin.eventos.aprovados', compact('eventos'));
    }

    public function negados()
    {
        $eventos = $this->repository->findWhere([
            'situacao_id'=>'4'
        ]);
        return view('admin.eventos.negados', compact('eventos'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Repositories\UsersRepository;
use App\Repositories\PaisesRepository;
use App\Repositories\EstadosRepository;
use App\Repositories\CidadesRepository;
use App\Repositories\ProfissionaisRepository;
use App\Repositories\EmpresasRepository;
use App\Repositories\UserInteressesRepository;
use App\Repositories\PareceresRepository;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class HomeController extends Controller
{
   
    protected $repository;
    private $paisesrepository, $estadosrepository, $cidadesrepository, $userinteressesrepository, $profissionaisrepository, $empresasrepository,$avisosrepository;



    public function __construct(
        UsersRepository $repository,
        PaisesRepository $paisesrepository,
        EstadosRepository $estadosrepository,
        CidadesRepository $cidadesrepository,
        UserInteressesRepository $userinteressesrepository,
        ProfissionaisRepository $profissionaisrepository,
        EmpresasRepository $empresasrepository,
        PareceresRepository $avisosrepository
    )
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->paisesrepository = $paisesrepository;
        $this->estadosrepository = $estadosrepository;
        $this->cidadesrepository = $cidadesrepository; 
        $this->userinteressesrepository = $userinteressesrepository;
        $this->profissionaisrepository = $profissionaisrepository;
        $this->empresasrepository = $empresasrepository;
        $this->avisosrepository = $avisosrepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $id = Auth::user()->id;
        $interessescount = $this->userinteressesrepository->findWhere(['user_id' => $id])->count();
        $profissionaiscount = $this->profissionaisrepository->findWhere(['user_id' => $id, 'statu_id' => '2'])->count();
        $empresascount = $this->empresasrepository->findWhere(['user_id' => $id, 'statu_id' => '2'])->count();
        return view('home', compact('interessescount', 'profissionaiscount' , 'empresascount'));
    }

    public function edit(){
        $id = Auth::user()->id;
        $usuario = $this->repository->find($id);
        $paises = $this->paisesrepository->pluck('descricao','id');
        $paises->prepend('Selecione o País', '');
        $estados = $this->estadosrepository->findWhere(['pais_id' => $usuario->pais_id])->pluck('descricao','id');
        $estados->prepend('Selecione o Estado', '');
        $cidades = $this->cidadesrepository->findWhere(['estado_id' => $usuario->estado_id])->pluck('descricao','id');
        $cidades->prepend('Selecione a Cidade', '');
        return view('edit', compact('usuario', 'paises', 'estados', 'cidades'));
    }

    public function update(Request $request){
        $data = $request->all();
       // dd($data);
        $id = Auth::user()->id;
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

        return redirect()->action('HomeController@edit');
    }
    
    public function password()
    {
        return view('password');
    }

    public function passwordupdate(Request $request){
        $data['password'] = bcrypt($request->password);
        $id = Auth::user()->id;

        $this->repository->update($data, $id);
        \Session::flash('message', ' Senha alterada com sucesso.');

        return redirect()->action('HomeController@home');
    }

    public function avisos()
    {
        $id = Auth::user()->id;
        $avisoscount = $this->avisosrepository->findWhere(['user_id' => $id, 'visualizou' => '0'])->count();
        $avisos = $this->avisosrepository->scopeQuery(function($query) use ($id){
            return $query->orderBy('id', 'desc')->limit(5);
        })->findWhere(['user_id' => $id])->all();
        return view('avisos', compact('avisoscount','avisos'));
    }
    
}
